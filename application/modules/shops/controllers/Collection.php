<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
include_once APPPATH . '/modules/layout/controllers/Layout.php';

class Collection extends Layout {

	private $_module_slug = 'shops/collection';

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->_data['module_slug'] = $this->_module_slug;
		$this->_data['breadcrumbs_module_name'] = 'Bộ sưu tập';
	}

	function ajax_get() {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $message = array();
        $message['status'] = 'warning';
        $message['content'] = null;
        $message['message'] = 'Kiểm tra thông tin nhập';

        $post = $this->input->post();
        if (!empty($post)) {
            $id = $this->input->post('id');
            $row = modules::run('shops/cat/get', $id);
			$cat_collection = explode(',', $row['collection']);
			$in_collection_id = array(-1);
			if(is_array($cat_collection) && !empty($cat_collection)){
				$in_collection_id = $cat_collection;
			}
			$args_collection = array('in_id' => $in_collection_id);
			$collection = modules::run('shops/collection/gets', $args_collection);
			$message['status'] = 'success';
			$message['content'] = display_option_select($collection, 'id', 'name', 0);
			$message['message'] = 'Đã xử lý dữ liệu thành công!';
        }
        echo json_encode($message);
        exit();
    }

	function default_args() {
		$order_by = array(
			'name' => 'ASC',
		);
		$args = array();
		$args['order_by'] = $order_by;

		return $args;
	}

	function counts($options = array()) {
		$default_args = $this->default_args();

		if (is_array($options) && !empty($options)) {
			$args = array_merge($default_args, $options);
		} else {
			$args = $default_args;
		}
		return $this->M_shops_collection->counts($args);
	}

	function gets($options = array()) {
		$default_args = $this->default_args();

		if (is_array($options) && !empty($options)) {
			$args = array_merge($default_args, $options);
		} else {
			$args = $default_args;
		}

		return $this->M_shops_collection->gets($args);
	}

	function get($id) {
		return $this->M_shops_collection->get($id);
	}

	function get_max_order() {
		$args = $this->default_args();
		$order_by = array(
			'order' => 'DESC',
		);
		$args['order_by'] = $order_by;
		$rows = $this->M_shops_collection->gets($args);
		$max_order = isset($rows[0]['order']) ? $rows[0]['order'] : 0;

		return (int) $max_order;
	}

	function re_order() {
		$args = $this->default_args();
		$order_by = array(
			'order' => 'ASC',
		);
		$args['order_by'] = $order_by;
		$rows = $this->gets($args);
		if (is_array($rows) && !empty($rows)) {
			$i = 0;
			foreach ($rows as $value) {
				$i++;
				$data = array(
					'order' => $i,
				);
				$this->M_shops_collection->update($value['id'], $data);
			}
		}
	}

    function is_auth($id = 0){
        $bool = FALSE;
        $current_user_id = get_current_user_id();
        if($current_user_id != 0){
            $row = $this->get($id);
            if(isset($row['user_id']) && $row['user_id'] == $current_user_id){
                $bool = TRUE;
            }
        }
        return $bool;
    }

	function site_index() {
        $this->_initialize();
		modules::run('users/require_logged_in');

        // echo get_current_user_id(); die;

		$this->output->cache(true);
		$this->_module_slug = 'quan-ly-bo-suu-tap';
		$user_id = $this->_data['userid'];
        $shop_status = get_user_shop_status($user_id);
        if($shop_status == NULL || $shop_status != 1){
            redirect(site_url());
        }

        $this->_modules_script[] = array(
            'folder' => 'shops',
            'name' => 'site-collection',
        );
        $this->set_modules();

        $title_seo = 'Quản lý bộ sưu tập';
        $keywords = '';//$data['keywords'];
        $description = '';//$data['description'];

        if (trim($title_seo) != '') {
            $this->_data['title_seo'] = $title_seo . ' - ' . $this->_data['title_seo'];
        }
        if (trim($keywords) != '') {
            $this->_data['keywords'] = $keywords;
        }
        if (trim($description) != '') {
            $this->_data['description'] = $description;
        }
        $get = $this->input->get();
        $this->_data['get'] = $get;

        $args = $this->default_args();
        $args['user_id'] = $user_id;

        //sort
        $sort = isset($get['sort']) ? $get['sort'] : '';
        $sort_data = array_keys($this->config->item('sort', 'filter_shops'));
        if (($sort != 'default') && in_array($sort, $sort_data)) {
            switch ($sort) {
                case 'title_ascending':
                    $order_by = array(
                        'title' => 'ASC',
                    );
                    $args['order_by'] = $order_by;
                    break;

                case 'title_descending':
                    $order_by = array(
                        'title' => 'DESC',
                    );
                    $args['order_by'] = $order_by;
                    break;

                case 'price_ascending':
                    $order_by = array(
                        'product_price' => 'ASC',
                    );
                    $args['order_by'] = $order_by;
                    break;

                case 'price_descending':
                    $order_by = array(
                        'product_price' => 'DESC',
                    );
                    $args['order_by'] = $order_by;
                    break;
                case 'addtime_descending':
                    $order_by = array(
                        'created' => 'DESC',
                    );
                    $args['order_by'] = $order_by;
                    break;
                case 'addtime_ascending':
                    $order_by = array(
                        'created' => 'ASC',
                    );
                    $args['order_by'] = $order_by;
                    break;
                default:
                    break;
            }
        }

        //price
        $price = $this->input->get('price');
        $in_prices = NULL;
        if(trim($price) != ''){
            $in_prices = array($price);
            $arr_price = explode('_', $price);            
            if(isset($arr_price[0]) && (int) $arr_price[0] > 0){
                $args['price_start'] = (int) $arr_price[0];
            }
            if(isset($arr_price[1]) && (int) $arr_price[1] > 0){
                $args['price_end'] = (int) $arr_price[1];
            }
        }
        $this->_data['in_prices'] = $in_prices;

        $total = $this->counts($args);
        $perpage = 12;

        $this->load->library('pagination');
        $config['total_rows'] = $total;
        $config['per_page'] = $perpage;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['first_link'] = '&larr;';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = '&rarr;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';

        $segment = 2;
        if (!empty($get)) {
            $config['base_url'] = base_url($this->config->item('url_shops_cat') . '/' . $cat_alias);
            $config['suffix'] = '?' . http_build_query($get, '', "&");
            $config['first_url'] = site_url($this->config->item('url_shops_cat') . '/' . $cat_alias . '?' . http_build_query($get, '', "&"));
        } else {
            $config['base_url'] = base_url($this->config->item('url_shops_cat') . '/' . $cat_alias);
            $config['first_url'] = site_url($this->config->item('url_shops_cat') . '/' . $cat_alias);
        }
        $config['uri_segment'] = $segment;

        $this->pagination->initialize($config);

        $pagination = $this->pagination->create_links();
        $this->_data['pagination'] = $pagination;

        $offset = ($this->uri->segment($segment) == '') ? 0 : $this->uri->segment($segment);
        $rows = $this->M_shops_collection->gets($args, $perpage, $offset);
        
        $this->_data['rows'] = $rows;

        $this->_breadcrumbs[] = array(
            'url' => site_url($this->config->item('url_shops_rows')),
            'name' => 'Quản lý bộ sưu tập'
        );
        $this->set_breadcrumbs();

        $this->_data['main_content'] = 'layout/site/pages/user-shops-collection';
        $this->load->view('layout/site/layout', $this->_data);
    }

    function site_content() {
        $this->_initialize();
		modules::run('users/require_logged_in');

		$this->output->cache(true);
		$this->_module_slug = 'quan-ly-bo-suu-tap';
        $user_id = $this->_data['userid'];
        $shop_status = get_user_shop_status($user_id);
        if($shop_status == NULL || $shop_status != 1){
            redirect(site_url());
        }

        $segment = 2;
        $id = ($this->uri->segment($segment) == '') ? 0 : (int) $this->uri->segment($segment);
        if($id > 0){
            if(!$this->is_auth($id)){
                $notify_type = 'danger';
                $notify_content = 'Không thể truy cập!';
                $this->set_notify($notify_type, $notify_content);
                redirect(site_url($this->_module_slug));
            }
        }

        $keywords = '';//$data['keywords'];
        $description = '';//$data['description'];

        if (trim($keywords) != '') {
            $this->_data['keywords'] = $keywords;
        }
        if (trim($description) != '') {
            $this->_data['description'] = $description;
        }
        
        $this->_plugins_script[] = array(
        	'folder' => 'jquery-validation',
        	'name' => 'jquery.validate',
        );
        $this->_plugins_script[] = array(
        	'folder' => 'jquery-validation/localization',
        	'name' => 'messages_vi',
        );

        $this->set_plugins();

        $this->_modules_script[] = array(
        	'folder' => 'shops',
        	'name' => 'admin-collection-validate',
        );
        $this->set_modules();

        $post = $this->input->post();
        if (!empty($post)) {
        	$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
        	$this->form_validation->set_rules('name', 'Nhập tên bộ sưu tập', 'trim|required|xss_clean');
        	if ($this->form_validation->run($this)) {
        		if ($id != 0) {
        			if ($this->admin_update($id)) {
        				$notify_type = 'success';
        				$notify_content = 'Cập nhật thông tin thành công!';
        				$this->set_notify($notify_type, $notify_content);
        				redirect(site_url($this->_module_slug));
        			} else {
        				$notify_type = 'danger';
        				$notify_content = 'Có lỗi xảy ra!';
        				$this->set_notify($notify_type, $notify_content);
        			}
        		} else {
        			$insert_id = $this->admin_add();
        			if ($insert_id != 0) {
        				$notify_type = 'success';
        				$notify_content = 'Đã thêm bộ sưu tập!';
        				$this->set_notify($notify_type, $notify_content);
        				redirect(site_url($this->_module_slug));
        			} else {
        				$notify_type = 'danger';
        				$notify_content = 'Có lỗi xảy ra!';
        				$this->set_notify($notify_type, $notify_content);
        			}
        		}
        	}
        }
        $title_seo = 'Thêm bộ sưu tập - ' . $this->_data['title_seo'];
        if ($id != 0) {
        	$row = $this->get($id);
        	$this->_data['row'] = $row;
        	$title_seo = 'Cập nhật bộ sưu tập - ' . $this->_data['title_seo'];
        }

        $this->_data['title_seo'] = $title_seo;
        $this->_data['main_content'] = 'layout/site/pages/user-shops-collection-content';
        $this->load->view('layout/site/layout', $this->_data);
    }

    function site_delete() {
        $this->_initialize();
        modules::run('users/require_logged_in');
        
        $user_id = $this->_data['userid'];
        $shop_status = get_user_shop_status($user_id);
        if($shop_status == NULL || $shop_status != 1){
            redirect(site_url());
        }

        $this->_module_slug = 'quan-ly-bo-suu-tap';
        $id = (int) $this->input->get('id');
        if(!$this->is_auth($id)){
            $notify_type = 'danger';
            $notify_content = 'Không thể xóa bộ sưu tập này!';
            $this->set_notify($notify_type, $notify_content);
            redirect(site_url($this->_module_slug));
        }
        
        $row = $this->get($id);
        if (is_array($row) && !empty($row)) {
            if ($this->M_shops_collection->delete($id)) {
                $notify_type = 'success';
                $notify_content = 'Đã xóa bộ sưu tập!';
            } else {
                $notify_type = 'danger';
                $notify_content = 'Lỗi! Chưa xóa bộ sưu tập! Vui lòng thực hiện lại!';
            }
        } else {
            $notify_type = 'warning';
            $notify_content = 'Bộ sưu tập này không tồn tại!';
        }
        $this->set_notify($notify_type, $notify_content);
        redirect(site_url($this->_module_slug));
    }

	function site_details() {
		$this->_initialize();

        $segment = 2;
        $uri = explode("-", ($this->uri->segment($segment) == '') ? '' : $this->uri->segment($segment));
        if (count($uri) <= 1) {
            show_404();
        }
        $id = (int) end($uri);
        array_pop($uri);
        $alias = implode("-", $uri);
        if ($id == 0 || $alias == '') {
            show_404();
        }
        $row = $this->get($id);

        if (!empty($row)) {
            $title_seo = trim($row['title_seo']) != '' ? $row['title_seo'] : $row['name'];
            $keywords = $row['keywords'];
            $description = $row['description'];
            $other_seo = $row['other_seo'];
            $h1_seo = $row['h1_seo'];
            if (trim($title_seo) != '') {
                $this->_data['title_seo'] = $title_seo . ' - ' . $this->_data['title_seo'];
            }
            if (trim($keywords) != '') {
                $this->_data['keywords'] = $keywords;
            }
            if (trim($description) != '') {
                $this->_data['description'] = $description;
            }
            if (trim($other_seo) != '') {
                $this->_data['other_seo'] = $other_seo;
            }
            if (trim($h1_seo) != '') {
                $this->_data['h1_seo'] = $h1_seo;
            }
        } else {
            show_404();
        }
        $this->_data['row'] = $row;

        $args = modules::run('shops/rows/default_args');
        $collection_id = $id;
		//collection
		$data_collection_details = modules::run('shops/collection_details/gets', array('collection_id' => $collection_id));
		$in_id = array(-1);
		if(is_array($data_collection_details) && !empty($data_collection_details)){
			$in_id = array_column($data_collection_details, 'product_id');
		}
		$args['in_id'] = $in_id;
        $total = modules::run('shops/rows/counts', $args);
        $perpage = 12;

        $this->load->library('pagination');
        $config['total_rows'] = $total;
        $config['per_page'] = $perpage;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul><!--pagination-->';

        $config['first_link'] = '&larr;';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = '&rarr;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';

        $segment++;
        $config['base_url'] = base_url('thuong-hieu' . '/' . $alias . '-' . $id);
        $config['uri_segment'] = $segment;
        $config['first_url'] = site_url('thuong-hieu' . '/' . $alias . '-' . $id);

        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
        $offset = ($this->uri->segment($segment) == '') ? 0 : $this->uri->segment($segment);

        $rows = $this->M_shops_rows->gets($args, $perpage, $offset);
        $this->_data['pagination'] = $pagination;

        $partial = array();
        $partial['data'] = modules::run('shops/rows/_parse_params', $rows);
        $this->_data['rows'] = $this->load->view('layout/site/partial/product', $partial, true);

        $this->_breadcrumbs[] = array(
            'url' => current_url(),
            'name' => $row['name']
        );
        $this->set_breadcrumbs();

        $this->_data['main_content'] = 'layout/site/pages/collection-shops';
        $this->load->view('layout/site/layout', $this->_data);
    }

	function admin_index() {
		$this->_initialize_admin();
		$this->redirect_admin();
		$this->_plugins_css_admin[] = array(
			'folder' => 'bootstrap3-dialog/css',
			'name' => 'bootstrap-dialog',
		);
		$this->_plugins_script_admin[] = array(
			'folder' => 'bootstrap3-dialog/js',
			'name' => 'bootstrap-dialog',
		);
		$this->set_plugins_admin();

		$this->_modules_script[] = array(
			'folder' => 'shops',
			'name' => 'admin-collection-items',
		);
		$this->set_modules();

		$get = $this->input->get();
		$this->_data['get'] = $get;

		$args = $this->default_args();
		$args['deleted'] = 0;

		if (isset($get['q']) && trim($get['q']) != '') {
			$args['q'] = $get['q'];
		}

		$total = $this->counts($args);
		$perpage = isset($get['per_page']) ? $get['per_page'] : $this->config->item('per_page');
		$segment = 3;

		$this->load->library('pagination');
		$config['total_rows'] = $total;
		$config['per_page'] = $perpage;
		$config['full_tag_open'] = '<ul class="pagination no-margin pull-right">';
		$config['full_tag_close'] = '</ul><!--pagination-->';

		$config['first_link'] = '&laquo;';
		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = '&raquo;';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = 'Trang trước &rarr;';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '&larr; Trang sau';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';

		if (!empty($get)) {
			$config['base_url'] = get_admin_url($this->_module_slug);
			$config['suffix'] = '?' . http_build_query($get, '', "&");
			$config['first_url'] = get_admin_url($this->_module_slug . '?' . http_build_query($get, '', "&"));
			$config['uri_segment'] = $segment;
		} else {
			$config['base_url'] = get_admin_url($this->_module_slug);
			$config['uri_segment'] = $segment;
		}

		$this->pagination->initialize($config);

		$pagination = $this->pagination->create_links();
		$offset = ($this->uri->segment($segment) == '') ? 0 : $this->uri->segment($segment);

		$this->_data['rows'] = $this->M_shops_collection->gets($args, $perpage, $offset);
		$this->_data['pagination'] = $pagination;

		$this->_data['title'] = 'Danh sách bộ sưu tập - ' . $this->_data['title'];
		$this->_data['main_content'] = 'shops/admin/view_page_collection_index';
		$this->load->view('layout/admin/view_layout', $this->_data);
	}

	function admin_content() {
		$this->_initialize_admin();
		$this->redirect_admin();

		$this->_plugins_script_admin[] = array(
			'folder' => 'jquery-validation',
			'name' => 'jquery.validate',
		);
		$this->_plugins_script_admin[] = array(
			'folder' => 'jquery-validation/localization',
			'name' => 'messages_vi',
		);

		$this->_plugins_css_admin[] = array(
			'folder' => 'bootstrap-fileinput/css',
			'name' => 'fileinput',
		);
		$this->_plugins_script_admin[] = array(
			'folder' => 'bootstrap-fileinput/js',
			'name' => 'fileinput.min',
		);

		$this->set_plugins_admin();

		$this->_modules_script[] = array(
			'folder' => 'shops',
			'name' => 'admin-collection-validate',
		);
		$this->set_modules();

		$post = $this->input->post();
		if (!empty($post)) {
			$this->load->helper('language');
			$this->lang->load('form_validation', 'vietnamese');

			$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
			$this->form_validation->set_rules('name', 'Nhập tên bộ sưu tập', 'trim|required|xss_clean');

			if ($this->form_validation->run($this)) {
				if ($this->input->post('id')) {
					//update
					$err = FALSE;
					$id = $this->input->post('id');
					if (!$this->admin_update($id)) {
						$err = TRUE;
					}

					if ($err === FALSE) {
						$this->_upload_images($id, 'image');
						$notify_type = 'success';
						$notify_content = 'Cập nhật thông tin thành công!';
						$this->set_notify_admin($notify_type, $notify_content);

						redirect(get_admin_url($this->_module_slug));
					} else {
						$notify_type = 'danger';
						$notify_content = 'Có lỗi xảy ra!';
						$this->set_notify_admin($notify_type, $notify_content);
					}
				} else {
					//add
					$err = FALSE;
					$insert_id = $this->admin_add();
					if ($insert_id == 0) {
						$err = TRUE;
					}

					if ($err === FALSE) {
						$this->_upload_images($insert_id, 'image');
						$notify_type = 'success';
						$notify_content = 'Thông tin đã được thêm!';
						$this->set_notify_admin($notify_type, $notify_content);

						redirect(get_admin_url($this->_module_slug));
					} else {
						$notify_type = 'danger';
						$notify_content = 'Có lỗi xảy ra!';
						$this->set_notify_admin($notify_type, $notify_content);
					}
				}
			}
		}
		$this->load->library('ckeditor', array('instanceName' => 'CKEDITOR1', 'basePath' => base_url() . "ckeditor/", 'outPut' => true));

		$title = 'Thêm thông tin - ' . $this->_data['breadcrumbs_module_name'] . ' - ' . $this->_data['title'];
		$segment = 5;
		$id = ($this->uri->segment($segment) == '') ? 0 : $this->uri->segment($segment);
		if ($id != 0) {
			$row = $this->get($id);
			$this->_data['row'] = $row;
			$title = 'Cập nhật thông tin - ' . $this->_data['breadcrumbs_module_name'] . ' - ' . $this->_data['title'];
		}

		$this->_data['title'] = $title;
		$this->_data['main_content'] = 'shops/admin/view_page_collection_content';
		$this->load->view('layout/admin/view_layout', $this->_data);
	}

	function admin_main() {
		$this->_initialize_admin();
		$this->redirect_admin();
		$post = $this->input->post();
		if (!empty($post)) {
			$action = $this->input->post('action');
			if ($action == 'update') {
				$this->_message_success = 'Đã cập nhật bộ sưu tập!';
				$this->_message_warning = 'Không có bộ sưu tập nào để cập nhật!';
				$ids = $this->input->post('ids');
				$orders = $this->input->post('order');
				$count = count($orders);
				if (!empty($ids) && !empty($orders)) {
					for ($i = 0; $i < $count; $i++) {
						$data = array(
							'order' => $orders[$i],
						);
						$id = $ids[$i];
						if ($this->M_shops_collection->update($id, $data)) {
							$notify_type = 'success';
							$notify_content = $this->_message_success;
						} else {
							$notify_type = 'danger';
							$notify_content = $this->_message_danger;
						}
					}
				} else {
					$notify_type = 'warning';
					$notify_content = $this->_message_warning;
				}
				$this->set_notify_admin($notify_type, $notify_content);
				redirect(get_admin_url($this->_module_slug));
			} elseif ($action == 'delete') {
				$this->_message_success = 'Đã xóa các bộ sưu tập được chọn!';
				$this->_message_warning = 'Bạn chưa chọn bộ sưu tập nào!';
				$ids = $this->input->post('idcheck');

				if (is_array($ids) && !empty($ids)) {
					foreach ($ids as $id) {
						$row = $this->get($id);
						if (!empty($row) && $this->M_shops_collection->delete($id)) {
							$notify_type = 'success';
							$notify_content = $this->_message_success;
						} else {
							$notify_type = 'danger';
							$notify_content = $this->_message_danger;
						}
					}
					$this->re_order();
				} else {
					$notify_type = 'warning';
					$notify_content = $this->_message_warning;
				}
				$this->set_notify_admin($notify_type, $notify_content);
				redirect(get_admin_url($this->_module_slug));
			} elseif ($action == 'content') {
				redirect(get_admin_url($this->_module_slug . '/content'));
			}
		} else {
			redirect(get_admin_url($this->_module_slug));
		}
	}

	function admin_add() {
		$data = array(
			'user_id' => $this->_data['userid'],
			'name' => $this->input->post('name'),
			'status' => 1,
			'created' => time(),
			'modified' => 0,
		);

		return $this->M_shops_collection->add($data);
	}

	function admin_update($id) {
		$data = array(
			'name' => $this->input->post('name'),
			'modified' => time(),
		);
		return $this->M_shops_collection->update($id, $data);
	}

	function admin_delete() {
		$this->_initialize_admin();
		$this->redirect_admin();

		$this->_message_success = 'Đã xóa thông tin!';
		$this->_message_warning = 'Thông tin này không tồn tại!';
		$id = $this->input->get('id');
		if ($id != 0) {
			$row = $this->get($id);
			if ($this->M_shops_collection->delete($id)) {
				$notify_type = 'success';
				$notify_content = $this->_message_success;
			} else {
				$notify_type = 'danger';
				$notify_content = $this->_message_danger;
			}
		} else {
			$notify_type = 'warning';
			$notify_content = $this->_message_warning;
		}
		$this->set_notify_admin($notify_type, $notify_content);
		redirect(get_admin_url($this->_module_slug));
	}
}

/* End of file Collection.php */
/* Location: ./application/modules/shops/controllers/Collection.php */