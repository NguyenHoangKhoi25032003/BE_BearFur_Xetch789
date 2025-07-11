<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
include_once APPPATH . '/modules/layout/controllers/Layout.php';

class Orders extends Layout {

	private $_module_slug = 'orders';

	function __construct() {
		parent::__construct();
		$this->_data['module_slug'] = $this->_module_slug;
		$this->_data['breadcrumbs_module_name'] = 'Đơn đặt hàng';
	}

	function admin_confirm_ajax() {
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}
		$message = array();
		$message['status'] = 'error';
		$message['content'] = null;
		$message['message'] = 'Kiểm tra thông tin nhập';
		$post = $this->input->post();
		if (!empty($post)) {
			$this->_initialize_admin();
			$time = time();
			$id = (int) $this->input->post('id');
			$row = $this->get($id);
			if (!(is_array($row) && !empty($row))) {
				$message['status'] = 'error';
				$message['content'] = null;
				$message['message'] = show_alert_danger('Đơn hàng không tồn tại!');
				echo json_encode($message);
				exit();
			}
			//update
			$status = (int) $this->input->post('status');
			$status_bool = ($status == 1);
			$status_name = ($status_bool ? 'Xác nhận' : 'Hủy');
			if ($row['transaction_status'] == 0) {
				$verify_by = $this->_data['userid'];
				$data = array(
					'transaction_status' => $status,
					'modified' => $time,
				);
				if ($this->M_shops_orders->update($id, $data)) {
					//update hoa hồng
					$args = array(
						'order_id' => $id,
						'in_action' => array('SUB_BUY', 'SUB_BUY_REFERRED_ROOT', 'SUB_BUY_REFERRED'),
					);
					$data_commission = array(
						'note' => $status_name . ' hoa hồng mua hàng từ giao diện xem đơn hàng',
						'status' => $status,
						'verified' => $time,
						'verify_by' => $verify_by,
					);
					modules::run('users/users_commission/update', $args, $data_commission);
				}

				$message['status'] = 'success';
				$message['content'] = null;
				$message['message'] = show_alert_success($status_name . ' đơn hàng thành công!');
			} else {
				$message['status'] = 'error';
				$message['content'] = null;
				$message['message'] = show_alert_danger('Có lỗi xảy ra! Vui lòng thực hiện lại!');
			}
		}
		echo json_encode($message);
		exit();
	}

	function cart() {
		$this->_initialize();

		$this->_breadcrumbs[] = array(
			'url' => current_url(),
			'name' => 'Giỏ hàng',
		);
		$this->_data['breadcrumbs'] = $this->_breadcrumbs;

		$this->_data['title_seo'] = 'Giỏ hàng' . ' - ' . $this->_data['title_seo'];
		$this->_data['main_content'] = 'layout/site/pages/cart';
		$this->load->view('layout/site/layout', $this->_data);
	}

	function site_history() {
        $this->_initialize();
        modules::run('users/require_logged_in');

        $this->output->cache(true);
        $_module_slug = 'don-dat-hang';
        $user_id = $this->_data['userid'];

        $get = $this->input->get();
        $this->_data['get'] = $get;

        $args = $this->default_args();
        $args['customer_id'] = $user_id;
        if (isset($get['q']) && trim($get['q']) != '') {
            $args['q'] = $get['q'];
        }

        $total = $this->M_shops_orders->counts($args);
        $perpage = 20;
        $segment = 2;

        $this->load->library('pagination');
        $config['total_rows'] = $total;
        $config['per_page'] = $perpage;
        $config['num_links'] = $this->config->item('num_links');
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

        $config['base_url'] = base_url($_module_slug);
        $config['first_url'] = site_url($_module_slug);
        $config['uri_segment'] = $segment;

        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
        $this->_data['pagination'] = $pagination;

        $offset = ($this->uri->segment($segment) == '') ? 0 : $this->uri->segment($segment);
        $rows = $this->M_shops_orders->gets($args, $perpage, $offset);
        $this->_data['rows'] = $rows;

        $this->_breadcrumbs[] = array(
            'url' => current_url(),
            'name' => 'Đơn đặt hàng',
        );
        $this->set_breadcrumbs();

        $this->_data['title_seo'] = 'Đơn đặt hàng - ' . $this->_data['title_seo'];
        $this->_data['main_content'] = 'layout/site/pages/user-order-history';
        $this->load->view('layout/site/layout', $this->_data);
    }

	function site_ref_history() {
        $this->_initialize();
        modules::run('users/require_logged_in');

        $this->output->cache(true);
        $_module_slug = 'don-hang-gioi-thieu';
        $user_id = $this->_data['userid'];

        $get = $this->input->get();
        $this->_data['get'] = $get;

        $args = $this->default_args();
        $args['user_ref_id'] = $user_id;
        if (isset($get['q']) && trim($get['q']) != '') {
            $args['q'] = $get['q'];
        }

        $total = $this->M_shops_orders->counts($args);
        $perpage = 20;
        $segment = 2;

        $this->load->library('pagination');
        $config['total_rows'] = $total;
        $config['per_page'] = $perpage;
        $config['num_links'] = $this->config->item('num_links');
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

        $config['base_url'] = base_url($_module_slug);
        $config['first_url'] = site_url($_module_slug);
        $config['uri_segment'] = $segment;

        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
        $this->_data['pagination'] = $pagination;

        $offset = ($this->uri->segment($segment) == '') ? 0 : $this->uri->segment($segment);
        $rows = $this->M_shops_orders->gets($args, $perpage, $offset);
        $this->_data['rows'] = $rows;

        $this->_breadcrumbs[] = array(
            'url' => current_url(),
            'name' => 'Đơn hàng giới thiệu',
        );
        $this->set_breadcrumbs();

        $this->_data['title_seo'] = 'Đơn hàng giới thiệu - ' . $this->_data['title_seo'];
        $this->_data['main_content'] = 'layout/site/pages/user-ref-history';
        $this->load->view('layout/site/layout', $this->_data);
    }

    function site_details() {
		$this->_initialize();
		modules::run('users/require_logged_in');

        $this->output->cache(true);
        $_module_slug = 'don-hang-gioi-thieu';
        $user_id = $this->_data['userid'];

        $this->_plugins_script[] = array(
			'folder' => 'bootbox',
			'name' => 'bootbox',
		);
		$this->_plugins_script[] = array(
			'folder' => 'jQuery-Plugin-To-Print-Any-Part-Of-Your-Page-Print',
			'name' => 'jQuery.print',
		);
		$this->set_plugins();

		$this->_modules_script[] = array(
			'folder' => 'shops',
			'name' => 'site-order-details',
		);
		$this->set_modules();

		$segment = 2;
		$order_id = ($this->uri->segment($segment ) == '') ? 0 : $this->uri->segment($segment );
		$order = $this->get($order_id);
		if(!(is_array($order) && !empty($order))){
			redirect(site_url($_module_slug));
		}
		$this->_data['order'] = $order;

		$customer = modules::run('users/get', $order["order_customer_id"]);
		$this->_data['customer'] = $customer;

		$order_items = modules::run('shops/order_details/get_data_in_order_id', $order_id);

		$products = array();
		foreach ($order_items as $value) {
			$arr = modules::run('shops/rows/get', $value['product_id']); // lấy thông tin chi tiết các sản phẩm có trong giỏ hàng
			$arr['name'] = (isset($arr['title']) && trim($arr['title']) != '') ? $arr['title'] : $value["name"];
			$arr['quantity'] = $value["quantity"];
			$arr['price'] = $value["price"];
			$arr['promotion_price'] = $value["promotion_price"];
			$arr['percent_discount'] = $value["percent_discount"];
			$arr['monetized'] = $value["monetized"];
			$products[] = $arr;
		}
		$this->_data['products'] = $products;

		$this->_data['title_seo'] = 'Xem đơn hàng' . ' ' . $order['order_code'] . ' - ' . $this->_data['title_seo'];
		$this->_data['main_content'] = 'layout/site/pages/user-order-details';
		$this->load->view('layout/site/layout', $this->_data);
	}

	function site_add($args) {
		return $this->M_shops_orders->add($args);
	}

	function site_order_success() {
		$this->_initialize();

		$segment = 2;
		$order_id = ($this->uri->segment($segment) == '') ? 0 : (int) $this->uri->segment($segment);
		$order = $this->get($order_id);
		if (!is_array($order) || empty($order)) {
			redirect(base_url());
		}
		$this->_data['order'] = $order;

		$customer = modules::run('users/get', $order["order_customer_id"]); // lấy thông tin khách hàng
		$this->_data['customer'] = $customer;

		$order_items = modules::run('shops/order_details/get_data_in_order_id', $order_id); // lấy các sản phẩm có id giỏ hàng

		$products = array();
		foreach ($order_items as $value) {
			$arr = modules::run('shops/rows/get', $value['product_id']); // lấy thông tin chi tiết các sản phẩm có trong giỏ hàng
			$arr['name'] = (isset($arr['title']) && trim($arr['title']) != '') ? $arr['title'] : $value["name"];
			$arr['quantity'] = $value["quantity"];
			$arr['price'] = $value["price"];
			$arr['promotion_price'] = $value["promotion_price"];
			$arr['percent_discount'] = $value["percent_discount"];
			$arr['monetized'] = $value["monetized"];
			$products[] = $arr;
		}
		$this->_data['products'] = $products;

		$this->_breadcrumbs[] = array(
			'url' => site_url('ket-qua-thanh-toan'),
			'name' => 'Kết quả thanh toán',
		);
		$this->set_breadcrumbs();

		$this->_data['title_seo'] = 'Kết quả thanh toán' . ' - ' . $this->_data['title_seo'];
		$this->_data['main_content'] = 'layout/site/pages/checkout-result';
		$this->load->view('layout/site/layout', $this->_data);
	}

	function admin_view() {
		$this->_initialize_admin();
		$this->redirect_admin();

		$this->load->module('users');
		$this->_message_success = 'Xác nhận thanh toán thành công!';
		$this->_message_danger = 'Lỗi kỹ thuật, vui lòng kiểm tra lại!';
		$this->_message_warning = 'Đơn hàng này không tồn tại!';
		$this->_message_banned = 'Bạn không có quyền truy cập vào khu vực này!';
		if ($this->users->validate_admin_logged_in() == TRUE) {
			$post = $this->input->post();

			$this->_plugins_script_admin[] = array(
				'folder' => 'bootbox',
				'name' => 'bootbox',
			);
			$this->_plugins_script_admin[] = array(
				'folder' => 'jQuery-Plugin-To-Print-Any-Part-Of-Your-Page-Print',
				'name' => 'jQuery.print',
			);
			$this->set_plugins_admin();

			$this->_modules_script[] = array(
				'folder' => 'shops',
				'name' => 'admin-order-view',
			);
			$this->set_modules();

			$order_id = ($this->uri->segment(4) == '') ? 0 : $this->uri->segment(4); # Lấy id giỏ hàng
			$order = $this->get($order_id); //lấy thông tin giỏ hàng
			if(!(is_array($order) && !empty($order))){
				redirect(get_admin_url('orders'));
			}
			$this->_data['order'] = $order;
			// $history_current = isset($order['history']) ? @unserialize($order['history']) : array();
			// echo "<pre>";
			// print_r($history_current);
			// echo "</pre>";
			// die();

			$customer = modules::run('users/get', $order["order_customer_id"]); // lấy thông tin khách hàng
			$this->_data['customer'] = $customer;

			$order_items = modules::run('shops/order_details/get_data_in_order_id', $order_id); // lấy các sản phẩm có id giỏ hàng

			$products = array();

			foreach ($order_items as $value) {
				$arr = modules::run('shops/rows/get', $value['product_id']); // lấy thông tin chi tiết các sản phẩm có trong giỏ hàng
				$arr['name'] = (isset($arr['title']) && trim($arr['title']) != '') ? $arr['title'] : $value["name"];
				$arr['quantity'] = $value["quantity"];
				$arr['price'] = $value["price"];
				$arr['promotion_price'] = $value["promotion_price"];
				$arr['percent_discount'] = $value["percent_discount"];
				$arr['monetized'] = $value["monetized"];
				$products[] = $arr;
			}
			$this->_data['products'] = $products;
			$this->_data['breadcrumbs_module_func'] = 'Xem đơn hàng';
			$this->_data['title'] = 'Xem đơn hàng' . ' ' . $order['order_code'] . ' - ' . $this->_data['title'] . ' Admin';

			if (!empty($post)) {
				if ($this->input->post('ajax') == '1') {
					if ($this->input->post('get_data') == '1') {
						$this->load->view('shops/admin/view_page_order_view', $this->_data);
					} else {
						$id = (int) $this->input->post('id');
						$order = $this->get($id);
						if($id == 0 || !(is_array($order) && !empty($order))){
							$this->_status = "danger";
							$this->_message = 'Đơn hàng không tồn tại! Vui lòng kiểm tra lại!';
						}else{
							$verify_by = isset($order['order_customer_id']) ? $order['order_customer_id'] : NULL;
							$time = time();
							$status = (int) $this->input->post('status');
							if($status == 1){
								$data_order = array(
									'transaction_status' => $status,
									'modified' => $time
								);
								if ($this->M_shops_orders->update($id, $data_order)) {
									$data_commission = array(
										'status' => $status,
										'verified' => $time,
										'verify_by' => $verify_by
									);
									$this->M_users_commission->update(array('order_id' => $id), $data_commission);
									$this->_status = "success";
									$this->_message = 'Thanh toán đơn hàng thành công!';
								} else {
									$this->_status = "danger";
									$this->_message = 'Chưa thể thực hiện thanh toán đơn hàng! Vui lòng thực hiện lại!';
								}
							}else{
								$data_order = array(
									'transaction_status' => $status,
									'modified' => $time
								);
								if ($this->M_shops_orders->update($id, $data_order)) {
									$data_commission = array(
										'status' => $status,
										'verified' => $time,
										'verify_by' => $verify_by
									);
									$this->M_users_commission->update(array('order_id' => $id), $data_commission);

									$this->_status = "success";
									$this->_message = 'Hủy đơn hàng thành công!';
								} else {
									$this->_status = "danger";
									$this->_message = 'Chưa thể thực hiện hủy đơn hàng! Vui lòng thực hiện lại!';
								}
							}
						}
						$this->set_json_encode();
						$this->load->view('layout/json_data', $this->_data);
					}
				} else {
					$order_id = $this->input->post('order_id');
					if ($order_id != 0) {
						$data = array(
							'transaction_status' => 4,
						);
						if ($this->M_shops_order->update($order_id, $data)) {

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
					redirect(get_admin_url('shops/or_view/' . $order_id));
				}
			} else {
				if (isset($order['order_viewed']) && $order['order_viewed'] != 1) {
					$this->M_shops_orders->update($order['order_id'], array('order_viewed' => 1, 'view_time' => time()));
				}
				$this->_data['main_content'] = 'shops/admin/view_page_order_view';
				$this->load->view('layout/admin/view_layout', $this->_data);
			}
		} else {
			if ($this->input->post('ajax') == '1') {
				$this->_status = "danger";
				$this->_message = $this->_message_banned;

				$this->set_json_encode();
				$this->load->view('layout/json_data', $this->_data);
			} else {
				$notify_type = 'danger';
				$notify_content = $this->_message_banned;
				$this->set_notify_admin($notify_type, $notify_content);
				redirect(get_admin_url('orders'));
			}
		}
	}

	function site_html_or_view($order_id = 0) {
		$order = $this->get($order_id); //lấy thông tin giỏ hàng
		$this->_data['order'] = $order;

		$customer = modules::run('users/get', $order["order_customer_id"]); // lấy thông tin khách hàng
		$this->_data['customer'] = $customer;

		$order_items = modules::run('shops/order_details/get_data_in_order_id', $order_id); // lấy các sản phẩm có id giỏ hàng

		$products = array();

		foreach ($order_items as $value) {
			$arr = modules::run('shops/rows/get', $value['product_id']); // lấy thông tin chi tiết các sản phẩm có trong giỏ hàng
			$arr['name'] = (isset($arr['title']) && trim($arr['title']) != '') ? $arr['title'] : $value["name"];
			$arr['quantity'] = $value["quantity"];
			$arr['price'] = $value["price"];
			$arr['promotion_price'] = $value["promotion_price"];
			$arr['percent_discount'] = $value["percent_discount"];
			$arr['monetized'] = $value["monetized"];
			$products[] = $arr;
		}
		$this->_data['products'] = $products;
		return $this->load->view('layout/site/partial/html-template-order', $this->_data, true);
	}

	function default_args() {
		$order_by = array(
			'shops_order.created' => 'DESC',
		);
		$args = array();
		$args['order_by'] = $order_by;

		return $args;
	}

	function gets($options = array()) {
		$default_args = $this->default_args();

		if (is_array($options) && !empty($options)) {
			$args = array_merge($default_args, $options);
		} else {
			$args = $default_args;
		}
		return $this->M_shops_orders->gets($args);
	}

	function counts($options = array()) {
		$default_args = $this->default_args();

		if (is_array($options) && !empty($options)) {
			$args = array_merge($default_args, $options);
		} else {
			$args = $default_args;
		}

		return $this->M_shops_orders->counts($args);
	}

	function get($order_id) {
		return $this->M_shops_orders->get($order_id);
	}

	function get_by($options = array()) {
		$default_args = $this->default_args();

		if (is_array($options) && !empty($options)) {
			$args = array_merge($default_args, $options);
		} else {
			$args = $default_args;
		}
		return $this->M_shops_orders->get_by($args);
	}

	function check_order_code_availablity($order_code = '') {
		return $this->M_shops_orders->check_order_code_availablity($order_code);
	}

	function get_code($id) {
		$code = $this->get_max_code();
		while (!$this->M_shops_orders->check_code_availablity($code, $id)) {
			$code = $this->get_max_code();
		}

		return $code;
	}

	function get_max_code() {
		$args = $this->default_args();
		$order_by = array(
			'order_code' => 'DESC',
		);
		$args['order_by'] = $order_by;
		$rows = $this->M_shops_orders->gets($args, 1, 0);
		$code = (int) (isset($rows[0]['order_code']) ? filter_var($rows[0]['order_code'], FILTER_SANITIZE_NUMBER_INT) : 0) + 1;
		return ORDER_CODE_PREFIX . str_pad($code, ORDER_CODE_LENGHT, "0", STR_PAD_LEFT);
	}

	function check_code_availablity() {
		$post = $this->input->post();
		$this->_message_success = 'true';
		$this->_message_danger = 'false';

		if (!empty($post)) {
			$code = $this->input->post('code');
			$id = $this->input->post('id');
			if ($this->input->post('ajax') == '1') {
				if ($this->M_shops_orders->check_code_availablity($code, $id)) {
					$this->_status = "success";
					$this->_message = $this->_message_success;
				} else {
					$this->_status = "danger";
					$this->_message = $this->_message_danger;
				}

				$this->set_json_encode();
				$this->load->view('layout/json_data', $this->_data);
			} else {
				if ($this->M_shops_orders->check_code_availablity($code, $id)) {
					return TRUE;
				} else {
					return FALSE;
				}
			}
		} else {
			redirect(base_url());
		}
	}

	function check_code_format() {
		$post = $this->input->post();
		$this->_message_success = 'true';
		$this->_message_danger = 'false';

		if (!empty($post)) {
			if ($this->input->post('ajax') == '1') {
				$code = $this->input->post('code');
				if ($this->is_code_format($code)) {
					$this->_status = "success";
					$this->_message = $this->_message_success;
				} else {
					$this->_status = "danger";
					$this->_message = $this->_message_danger;
				}

				$this->set_json_encode();
				$this->load->view('layout/json_data', $this->_data);
			} else {
				$code = $this->input->post('code');
				if ($this->is_code_format($code)) {
					return TRUE;
				} else {
					return FALSE;
				}
			}
		} else {
			redirect(base_url());
		}
	}

	function is_code_format($code = '') {
		$result = preg_match("/" . ORDER_CODE_PREFIX . "[0-9]{" . ORDER_CODE_LENGHT . "," . ORDER_CODE_LENGHT . "}$/", $code);
		return ($result == 1) ? TRUE : FALSE;
	}

	function admin_content_ajax() {
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}

		$post = $this->input->post();
		if (!empty($post)) {
			$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
			$this->form_validation->set_rules('customer_id', 'Khách hàng', 'required');
			$message = array();
			$message['status'] = 'error';
			$message['content'] = null;
			$message['message'] = 'Kiểm tra thông tin nhập';

			if ($this->form_validation->run($this)) {
				$this->_initialize_admin();
				$this->redirect_admin();
				$err = FALSE;
				$time = time();
				$id = (int) $this->input->post('id');
				$order_total = 0;
				$current_consignments = array();
				$consignments = array();
				$tblAppendGrid = 'tblAppendGrid_';
				$rowOrder = explode(',', $this->input->post($tblAppendGrid . 'rowOrder'));
				if (is_array($rowOrder) && !empty($rowOrder)) {
					foreach ($rowOrder as $i) {
						$product_id = $this->input->post($tblAppendGrid . 'product_id' . '_' . $i);
						$quantity = $this->input->post($tblAppendGrid . 'quantity' . '_' . $i);
						$unit_price = filter_var($this->input->post($tblAppendGrid . 'unit_price' . '_' . $i), FILTER_SANITIZE_NUMBER_FLOAT);
						$monetized = filter_var($this->input->post($tblAppendGrid . 'monetized' . '_' . $i), FILTER_SANITIZE_NUMBER_FLOAT);
						$order_total += $monetized;

						$consignments[] = array(
							'product_id' => $product_id,
							'quantity' => $quantity,
							'unit_price' => $unit_price,
							'monetized' => $monetized
						);
					}
					if (!empty($consignments)) {
						$current_page = $this->input->post('current_page');

						$customer_id = $this->input->post('customer_id');
						$customer = modules::run('users/get', $customer_id);

						$data_order_args = array(
							'order_customer_id' => $customer_id,
							'order_amount' => $order_total,
							'order_email' => $customer['email'],
							'order_ship_full_name' => $customer['full_name'],
							'order_ship_address' => $customer['address'],
							'order_phone' => $customer['phone'],
							'order_note' => $this->input->post('note'),
						);

						if ($id != 0) {
							$data_order_args['modified'] = time();
							if (!$this->M_shops_orders->update($id, $data_order_args)) {
								$err = TRUE;
							} else {
								$this->M_shops_order_details->delete($id);
							}
							$order_id = $id;
						} else {
							$order_code = $this->get_max_code();
							if (!$this->check_order_code_availablity($order_code)) {
								$order_code = $this->get_max_code();
							}
							$data_order_args['order_code'] = $order_code;
							$data_order_args['admin_id'] = $this->_data['userid'];
							$data_order_args['transaction_status'] = 0;
							$data_order_args['post_ip'] = ip2long($this->input->ip_address());
							$data_order_args['expiry_time'] = time() + 3600 * 24 * 3;
							$data_order_args['created'] = time();
							$order_id = $this->M_shops_orders->add($data_order_args);
						}

						if ($order_id != 0) {
							$order = $this->M_shops_orders->get($order_id);
							$history_container = array();
							$history_current = isset($order['history']) ? @unserialize($order['history']) : array();
							foreach ($consignments as $value) {
								$product_id = $value['product_id'];
								$F0 = $F1 = $F2 = $F3 = $F4 = $F5 = $F6 = $F3 = $F7 = $F8 = $F9 = $F10 = 0;
								$name = NULL;
								$product = modules::run('shops/rows/get', $product_id);
								if(is_array($product) && !empty($product)){
									$F0 = $product['F0'];
									$F1 = $quantity * $product['F1'];
									$F2 = $quantity * $product['F2'];
									$F3 = $quantity * $product['F3'];
									$F4 = $quantity * $product['F4'];
									$F5 = $quantity * $product['F5'];
									$F6 = $quantity * $product['F6'];
									$F7 = $quantity * $product['F7'];
									$F8 = $quantity * $product['F8'];
									$F9 = $quantity * $product['F9'];
									$F10 = $quantity * $product['F10'];
									$name = $product['title'];
								}
								$price = $value['unit_price'];
								$promotion_price = $price * (100 - $F0) / 100;
								$quantity = $value['quantity'];
								$monetized = $value['monetized'];
								$order_detail_args = array(
									'order_id' => $order_id,
									'name' => $name,
									'product_id' => $product_id,
									'price' => $price,
									'promotion_price' => $promotion_price,
									'percent_discount' => $F0,
									'quantity' => $quantity,
									'monetized' => $monetized,
								);
								$bool = modules::run('shops/order_details/site_add', $order_detail_args);
								if (!$bool) {
									$err = TRUE;
								}elseif($id == 0){
									$history = array();
									$action = 'SELL';
									$value_cost = $quantity * $price;
				        			// $percent = $F0;
				        			// $value = $monetized;
									$value = $monetized;
									$percent = 100 * $monetized/$value_cost;
									$user_id = $this->_data['userid'];
									$data_commission = array(
										'order_id' => $order_id,
										'product_id' => $product_id,
										'user_id' => $user_id,
										'extend_by' => NULL,
										'action' => $action,
										'value_cost' => $value_cost,
										'percent' => $percent,
										'value' => $value,
										'message' => 'Người dùng bán hàng',
										'status' => 0,
										'created' => $time
									);
									modules::run('users/users_commission/add', $data_commission);
									$history[] = $data_commission;

									$action = 'BUY';
									$value_cost = (-1) * $quantity * $price;
				        			// $percent = $F0;
				        			// $value = (-1) * $monetized;
									$value = (-1) * $monetized;
									$percent = abs(100 * $monetized/$value_cost);
									$data_commission = array(
										'order_id' => $order_id,
										'product_id' => $product_id,
										'user_id' => $customer_id,
										'extend_by' => NULL,
										'action' => $action,
										'value_cost' => $value_cost,
										'percent' => $percent,
										'value' => $value,
										'message' => 'Người dùng mua sản phẩm',
										'status' => 0,
										'created' => $time
									);
									modules::run('users/users_commission/add', $data_commission);
									$history[] = $data_commission;

									$args = modules::run('users/default_args');
									$users = $this->M_users->gets($args);
									$data = get_data_parent_level($users, $customer_id);
									$root = $data['root'];
									$subs = $data['subs'];

									if($root != 0){
										$action = 'SUB_BUY_ROOT';
										$value_cost = $quantity * $price;
										// $percent = $F1;
										// $value = $quantity * $price * $percent / 100;
										$value = $F1;
										$percent =  100 * $value/$value_cost;
										$data_commission = array(
											'order_id' => $order_id,
											'product_id' => $product_id,
											'user_id' => $root,
											'extend_by' => $customer_id,
											'action' => $action,
											'value_cost' => $value_cost,
											'percent' => $percent,
											'value' => $value,
											'message' => 'Người dùng được hưởng hoa hồng từ người dùng cấp dưới trực tiếp mua sản phẩm',
											'status' => 0,
											'created' => $time
										);
										modules::run('users/users_commission/add', $data_commission);
										$history[] = $data_commission;
									}
									if(is_array($subs) && !empty($subs)){
										$arr_subs_percent = array($F2, $F3, $F4, $F5, $F6, $F7, $F8, $F9, $F10);
										$i = 0;
										foreach ($subs as $sub) {
											$action = 'SUB_BUY';
											$value_cost = $quantity * $price;
											// $percent = $F2;
											// $value = $quantity * $price * $percent / 100;
											$value = isset($arr_subs_percent[$i]) ? $arr_subs_percent[$i] : 0;
											$i++;
											$percent = 100 * $value/$value_cost;
											$data_commission = array(
												'order_id' => $order_id,
												'product_id' => $product_id,
												'user_id' => $sub,
												'extend_by' => $customer_id,
												'action' => $action,
												'value_cost' => $value_cost,
												'percent' => $percent,
												'value' => $value,
												'message' => 'Người dùng được hưởng hoa hồng từ người dùng cấp dưới mua sản phẩm',
												'status' => 0,
												'created' => $time
											);
											modules::run('users/users_commission/add', $data_commission);
											$history[] = $data_commission;
										}
									}
									$history_container[] = $history;
								}else{
									modules::run('users/users_commission/delete', array(
										'order_id' => $order_id,
										'not_in_product_id' => array_column($consignments, 'product_id'),
									));

									$history = array();
									$action = 'SELL';
									$value_cost = $quantity * $price;
									$percent = $F0;
									$value = $monetized;
									$user_id = $this->_data['userid'];
									$data_commission = array(
										'order_id' => $order_id,
										'product_id' => $product_id,
										'user_id' => $user_id,
										'extend_by' => NULL,
										'action' => $action,
										'value_cost' => $value_cost,
										'percent' => $percent,
										'value' => $value,
										'message' => 'Người dùng bán hàng',
										'status' => 0,
										'created' => $time
									);
									$args_commission_exist = array(
										'order_id' => $order_id,
										'product_id' => $product_id,
										'action' => $action,
									);
									$row_commission = modules::run('users/users_commission/get', $args_commission_exist);
									if(isset($row_commission['id'])){
										modules::run('users/users_commission/update', array('id' => $row_commission['id']), $data_commission);
									}else{
										modules::run('users/users_commission/add', $data_commission);
									}
									$history[] = $data_commission;

									$action = 'BUY';
									$value_cost = (-1) * $quantity * $price;
									$percent = $F0;
									$value = (-1) * $monetized;
									$data_commission = array(
										'order_id' => $order_id,
										'product_id' => $product_id,
										'user_id' => $customer_id,
										'extend_by' => NULL,
										'action' => $action,
										'value_cost' => $value_cost,
										'percent' => $percent,
										'value' => $value,
										'message' => 'Người dùng mua sản phẩm',
										'status' => 0,
										'created' => $time
									);
									$args_commission_exist = array(
										'order_id' => $order_id,
										'product_id' => $product_id,
										'action' => $action,
									);
									$row_commission = modules::run('users/users_commission/get', $args_commission_exist);
									if(isset($row_commission['id'])){
										modules::run('users/users_commission/update', array('id' => $row_commission['id']), $data_commission);
									}else{
										modules::run('users/users_commission/add', $data_commission);
									}
									$history[] = $data_commission;

									$args = modules::run('users/default_args');
									$users = $this->M_users->gets($args);
									$data = get_data_parent_level($users, $customer_id);
									$root = $data['root'];
									$subs = $data['subs'];

									if($root != 0){
										$action = 'SUB_BUY_ROOT';
										$value_cost = $quantity * $price;
										$percent = $F1;
										$value = $quantity * $price * $percent / 100;
										$data_commission = array(
											'order_id' => $order_id,
											'product_id' => $product_id,
											'user_id' => $root,
											'extend_by' => $customer_id,
											'action' => $action,
											'value_cost' => $value_cost,
											'percent' => $percent,
											'value' => $value,
											'message' => 'Người dùng được hưởng hoa hồng từ người dùng cấp dưới trực tiếp mua sản phẩm',
											'status' => 0,
											'created' => $time
										);
										$args_commission_exist = array(
											'order_id' => $order_id,
											'product_id' => $product_id,
											'action' => $action,
										);
										$row_commission = modules::run('users/users_commission/get', $args_commission_exist);
										if(isset($row_commission['id'])){
											modules::run('users/users_commission/update', array('id' => $row_commission['id']), $data_commission);
										}else{
											modules::run('users/users_commission/add', $data_commission);
										}
										$history[] = $data_commission;
									}
									if(is_array($subs) && !empty($subs)){
										foreach ($subs as $sub) {
											$action = 'SUB_BUY';
											$value_cost = $quantity * $price;
											$percent = $F2;
											$value = $quantity * $price * $percent / 100;
											$data_commission = array(
												'order_id' => $order_id,
												'product_id' => $product_id,
												'user_id' => $sub,
												'extend_by' => $customer_id,
												'action' => $action,
												'value_cost' => $value_cost,
												'percent' => $percent,
												'value' => $value,
												'message' => 'Người dùng được hưởng hoa hồng từ người dùng cấp dưới mua sản phẩm',
												'status' => 0,
												'created' => $time
											);
											$args_commission_exist = array(
												'order_id' => $order_id,
												'product_id' => $product_id,
												'action' => $action,
											);
											$row_commission = modules::run('users/users_commission/get', $args_commission_exist);
											if(isset($row_commission['id'])){
												modules::run('users/users_commission/update', array('id' => $row_commission['id']), $data_commission);
											}else{
												modules::run('users/users_commission/add', $data_commission);
											}
											$history[] = $data_commission;
										}
									}
									$history_container[] = $history;
								}
							}
							$history_current[] = $history_container;
							$history_bool = $this->M_shops_orders->update($order_id, array('history' => serialize($history_current)));
						} else {
							$err = TRUE;
						}
					}

					if ($err === FALSE) {
						$message['status'] = 'success';
						$message['content'] = array('data' => (isset($order_id) && $order_id > 0) ? get_admin_url($this->_module_slug . '/view/' . $order_id) : get_admin_url($this->_module_slug));
						$message['message'] = 'Hóa đơn bán hàng đã lưu!';
					} else {
						$message['status'] = 'error';
						$message['content'] = null;
						$message['message'] = 'Có lỗi xảy ra! Vui lòng thực hiện lại!';
					}
				} else {
					$message['status'] = 'error';
					$message['content'] = null;
					$message['message'] = 'Chưa chọn gói sản phẩm! Vui lòng chọn lại gói sản phẩm và thực hiện lại!';
				}
			}
			echo json_encode($message);
		}
	}

	function admin_content() {
		$this->_initialize_admin();
		$this->redirect_admin();

		$get = $this->input->get();
		$this->_data['get'] = $get;

		$max_code = $this->get_max_code();
		$this->_data['max_code'] = $max_code;

		$user_id = $this->_data['userid'];
		$user = modules::run('users/get', $user_id);
		$this->_data['user'] = $user;

		$customers = modules::run('users/gets', array('role' => 'AGENCY'));
		if (is_array($customers) && !empty($customers)) {
			foreach ($customers as $key => $value) {
				$customers[$key]['full_name'] = $value['full_name'] . (trim($value['phone']) != '' ? ' - ' . $value['phone'] : '');
			}
		}
		$this->_data['customers'] = $customers;

		$is_admin = (isset($this->_data['role']) && in_array($this->_data['role'], array('ADMIN')));

		$title = 'Hóa đơn bán hàng - ' . $this->_data['breadcrumbs_module_name'] . ' - ' . $this->_data['title'];
		$segment = 4;
		$id = ($this->uri->segment($segment) == '') ? 0 : $this->uri->segment($segment);
		$row = $this->get($id);
		if ($id != 0 && is_array($row) && !empty($row)) {
			if ($row['transaction_status'] != 0) {
				$notify_type = 'warning';
				$notify_content = " Đơn đặt hàng này không thể cập nhật!";
				$this->set_notify_admin($notify_type, $notify_content);
				redirect(get_admin_url('orders'));
			}
			$this->_data['current_page'] = (int) $this->input->get('current_page');
			$row['items'] = modules::run('shops/order_details/get_data_in_order_id', $id);
			$this->_data['row'] = $row;
			$title = 'Cập nhật hóa đơn bán hàng - ' . $this->_data['breadcrumbs_module_name'] . ' - ' . $this->_data['title'];
		}
		$this->_plugins_css_admin[] = array(
			'folder' => 'jquery.appendGrid',
			'name' => 'jquery-ui.structure.min',
		);
		$this->_plugins_css_admin[] = array(
			'folder' => 'jquery.appendGrid',
			'name' => 'jquery-ui.theme.min',
		);
		$this->_plugins_script_admin[] = array(
			'folder' => 'jquery.appendGrid',
			'name' => 'jquery-ui-1.11.1.min',
		);
		$this->_plugins_css_admin[] = array(
			'folder' => 'jquery.appendGrid',
			'name' => 'jquery.appendGrid-1.6.2',
		);
		$this->_plugins_script_admin[] = array(
			'folder' => 'jquery.appendGrid',
			'name' => 'jquery.appendGrid-1.6.2',
		);

		$this->_plugins_css_admin[] = array(
			'folder' => 'bootstrap-datepicker/css',
			'name' => 'bootstrap-datepicker',
		);
		$this->_plugins_css_admin[] = array(
			'folder' => 'bootstrap-datepicker/css',
			'name' => 'bootstrap-datepicker3',
		);
		$this->_plugins_script_admin[] = array(
			'folder' => 'bootstrap-datepicker/js',
			'name' => 'bootstrap-datepicker',
		);
		$this->_plugins_script_admin[] = array(
			'folder' => 'bootstrap-datepicker/locales',
			'name' => 'bootstrap-datepicker.vi.min',
		);
		$this->_plugins_script_admin[] = array(
			'folder' => 'bootstrap-datepicker',
			'name' => 'app.editinfo',
		);
		$this->_plugins_script_admin[] = array(
			'folder' => 'jquery-validation',
			'name' => 'jquery.validate',
		);
		$this->_plugins_script_admin[] = array(
			'folder' => 'jquery-validation/localization',
			'name' => 'messages_vi',
		);

		$this->_plugins_script_admin[] = array(
			'folder' => 'jquery-mask',
			'name' => 'jquery.mask',
		);

		$this->_plugins_css_admin[] = array(
			'folder' => 'chosen',
			'name' => 'chosen',
		);
		$this->_plugins_script_admin[] = array(
			'folder' => 'chosen',
			'name' => 'chosen.jquery',
		);

		$this->set_plugins_admin();

		$this->_modules_script[] = array(
			'folder' => 'shops',
			'name' => 'admin-order-validate',
		);
		$this->set_modules();

		$products = modules::run('shops/rows/gets');
		$this->_data['products'] = $products;

		$this->_data['title'] = $title;
		$this->_data['main_content'] = 'shops/admin/view_page_order_content';
		$this->load->view('layout/admin/view_layout', $this->_data);
	}

	function fix(){
		$args = $this->default_args();
		$rows = $this->M_shops_orders->gets($args);
		echo $this->get_max_code();
		echo "<pre>";
		print_r($rows);
		echo "</pre>";
		die;
		foreach ($rows as $value) {
			$this->M_shops_orders->update($value['order_id'], array(
				'order_code' => str_replace('HKOL', 'CBS', $value['order_code'])
			));
		}
	}

	function index() {
		$this->_initialize_admin();
		$this->redirect_admin();

		$this->_plugins_css_admin[] = array(
			'folder' => 'bootstrap-datepicker/css',
			'name' => 'bootstrap-datepicker',
		);
		$this->_plugins_css_admin[] = array(
			'folder' => 'bootstrap-datepicker/css',
			'name' => 'bootstrap-datepicker3',
		);
		$this->_plugins_script_admin[] = array(
			'folder' => 'bootstrap-datepicker/js',
			'name' => 'bootstrap-datepicker',
		);
		$this->_plugins_script_admin[] = array(
			'folder' => 'bootstrap-datepicker/locales',
			'name' => 'bootstrap-datepicker.vi.min',
		);

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
			'name' => 'admin-order',
		);
		$this->set_modules();

		$get = $this->input->get();
		$this->_data['get'] = $get;

		$this->_module_slug = 'orders';
		$args = $this->default_args();

		if (isset($get['q']) && trim($get['q']) != '') {
			$args['q'] = $get['q'];
		}

		//theo ngay
		if (isset($get['fromday']) && trim($get['fromday']) != '') {
			$args['start_date_start'] = get_start_date($get['fromday']);
		}
		if (isset($get['today']) && trim($get['today']) != '') {
			$args['start_date_end'] = get_end_date($get['today']);
		}

		if (isset($get['transaction_status']) && trim($get['transaction_status']) != '') {
			$args['transaction_status'] = (int) $get['transaction_status'];
		}

		// echo "<pre>";
		// print_r($args);
		// echo "</pre>";
		// die;

		$total = $this->counts($args);
		$perpage = isset($get['per_page']) ? $get['per_page'] : $this->config->item('per_page');
		$segment = 3;

		$this->load->library('pagination'); # Tải bộ thư viện Pagination Class của CodeIgniter
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

		$config['next_link'] = $this->lang->line('next_page') . ' &rarr;';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '&larr; ' . $this->lang->line('prev_page');
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
		} else {
			$config['base_url'] = get_admin_url($this->_module_slug);
		}
		$config['uri_segment'] = $segment;
		$this->pagination->initialize($config);

		$pagination = $this->pagination->create_links();
		$offset = ($this->uri->segment($segment) == '') ? 0 : $this->uri->segment($segment);

		$this->_data['rows'] = $this->M_shops_orders->gets($args, $perpage, $offset);
		$this->_data['pagination'] = $pagination;

		$this->_data['breadcrumbs_module_func'] = 'Danh sách đơn đặt hàng';
		$this->_data['title'] = 'Đơn đặt hàng' . ' - ' . $this->_data['title'];
		$this->_data['main_content'] = 'shops/admin/view_page_order';
		$this->load->view('layout/admin/view_layout', $this->_data);
	}

	function update_transaction_status($order_id, $transaction_status) {
		$data = array(
			'transaction_status' => $transaction_status,
		);

		return $this->M_shops_orders->update($order_id, $data);
	}

	function delete() {
		$this->_initialize_admin();
		$this->redirect_admin();

		$segment = 4;
		$id = ($this->uri->segment($segment) == '') ? 0 : $this->uri->segment($segment);
		$row = $this->get($id);
		if (is_array($row) && !empty($row)) {
			/*
			if ($this->M_shops_orders->delete($id)) {
				$order_id = $row["order_id"];
				modules::run('shops/order_details/admin_delete', $order_id); // xóa chi tiết đơn hàng
				$this->M_users_commission->delete(array('order_id' => $order_id)); // xóa giao dịch
				$notify_type = 'success';
				$notify_content = "Đã xóa đơn đặt hàng!";
			} else {
				$notify_type = 'danger';
				$notify_content = " Đơn đặt hàng chưa được xóa!";
			}
			*/
			if ($row['transaction_status'] == 0) {
				if ($this->M_shops_orders->delete($id)) {
					$order_id = $row["order_id"];
					modules::run('shops/order_details/admin_delete', $order_id); // xóa chi tiết đơn hàng
					$args = array(
						'order_id' => $order_id,
						'in_action' => array('SUB_BUY'),
					);
					modules::run('users/users_commission/delete', $args);//xóa chi tiết giao dịch
					$notify_type = 'success';
					$notify_content = "Đã xóa đơn đặt hàng!";
				} else {
					$notify_type = 'danger';
					$notify_content = " Đơn đặt hàng chưa được xóa!";
				}
			} else {
				$notify_type = 'danger';
				$notify_content = 'Không thể xóa đơn hàng này!';
			}
		} else {
			$notify_type = 'warning';
			$notify_content = " Đơn đặt hàng này không tồn tại!";
		}
		$this->set_notify_admin($notify_type, $notify_content);
		redirect(get_admin_url('orders'));
	}

}

/* End of file Orders.php */
/* Location: ./application/modules/shops/controllers/Orders.php */
