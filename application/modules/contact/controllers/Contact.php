<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
include_once APPPATH . '/modules/layout/controllers/Layout.php';

class Contact extends Layout {

    private $_module_slug = 'contact';

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->_data['module_slug'] = $this->_module_slug;
        $this->load->model('contact/m_contact', 'M_contact');
        $this->_data['breadcrumbs_module_name'] = 'Liên hệ';
    }

    function default_args() {
        $order_by = array(
            'is_view' => 'ASC',
            'add_time' => 'DESC',
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
        $this->load->model('contact/m_contact', 'M_contact');
        return $this->M_contact->gets($args);
    }

    function counts($options = array()) {
        $default_args = $this->default_args();

        if (is_array($options) && !empty($options)) {
            $args = array_merge($default_args, $options);
        } else {
            $args = $default_args;
        }
        $this->load->model('contact/m_contact', 'M_contact');
        return $this->M_contact->counts($args);
    }

    function get($id) {
        $this->load->model('contact/m_contact', 'M_contact');
        return $this->M_contact->get($id);
    }

    function index() {
        $this->_initialize();
        $data = $this->_data;
        $data['content'] = $this->load->view('../../layout/views/site/pages/contact', [], true);
        $data['show_home_blocks'] = false;
        $this->load->view('../../layout/views/site/layout_bearfur', $data);
    }

    function admin_main() {
        $this->_initialize_admin();
        $this->redirect_admin();

        $post = $this->input->post();
        if (!empty($post)) {
            $action = $this->input->post('action');
            if ($action == 'delete') {
                $this->_message_success = 'Đã xóa các liên hệ được chọn!';
                $this->_message_warning = 'Bạn chưa chọn liên hệ nào!';
                $ids = $this->input->post('idcheck');
                if (is_array($ids) && !empty($ids)) {
                    foreach ($ids as $id) {
                        if ($this->M_contact->delete($id)) {
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
            } else{
                redirect(get_admin_url($this->_module_slug));
            }
        } else {
            redirect(get_admin_url($this->_module_slug));
        }
    }

    function admin_index() {
        $this->_initialize_admin();
        $this->redirect_admin();

        $args = $this->default_args();
        $total = $this->counts($args);
        $perpage = $this->config->item('per_page');
        $segment = 3;

        $this->load->library('pagination');

        $config['total_rows'] = $total;
        $config['per_page'] = $perpage;
        $config['full_tag_open'] = '<ul class="pagination">';
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

        $config['base_url'] = get_admin_url('contact');
        $config['uri_segment'] = $segment;
        $this->pagination->initialize($config);

        $pagination = $this->pagination->create_links();
        $offset = ($this->uri->segment($segment) == '') ? 0 : $this->uri->segment($segment);

        $this->_data['rows'] = $this->M_contact->gets($args, $perpage, $offset);
        $this->_data['pagination'] = $pagination;
        $this->_data['title'] = 'Liên hệ - ' . $this->_data['title'];
        $this->_data['breadcrumbs'] = $this->_breadcrumbs;

        if ($this->input->post('ajax') == 1) {
            $this->load->view('contact/admin/view_index', $this->_data);
        } else {
            $this->_plugins_css_admin[] = array(
                'folder' => 'bootstrap3-dialog/css',
                'name' => 'bootstrap-dialog'
            );
            $this->_plugins_script_admin[] = array(
                'folder' => 'bootstrap3-dialog/js',
                'name' => 'bootstrap-dialog'
            );
            $this->set_plugins_admin();

            $this->_modules_script[] = array(
                'folder' => 'contact',
                'name' => 'contact-delete'
            );
            $this->set_modules();
            $this->_data['main_content'] = 'contact/admin/view_page_index';
            $this->load->view('layout/admin/view_layout', $this->_data);
        }
    }

    function admin_view() {
		$this->_initialize_admin();
        $this->redirect_admin();

        $id = $this->input->get('id');
        if ($id != 0) {
            $this->_data['breadcrumbs_module_func'] = 'Xem liên hệ';
            $row = $this->get($id);

            if ($row == NULL) {
                $this->redirect_admin();
            }

            if ($row['is_view'] == 0) {
                $data = array(
                    'is_view' => 1
                );
                if ($this->M_contact->update($id, $data)) {
                    $this->_data['num_rows_contact'] = $this->num_rows_new();
                }
            }

            $this->_data['row'] = $row;
            $this->_data['title'] = 'Liên hệ - ' . $this->_data['title'];
            $this->_data['main_content'] = 'contact/admin/view_page_detail';
            $this->load->view('layout/admin/view_layout', $this->_data);
        } else {
            redirect(get_admin_url($this->_module_slug));
        }
    }

    function num_rows_new() {
        $args['is_view'] = 0;
        return $this->counts($args);
    }

    function admin_delete() {
        $this->_initialize_admin();
        $this->redirect_admin();

        $this->_message_success = 'Đã xóa liên hệ!';
        $this->_message_danger = 'Rất tiếc! Có lỗi kỹ thuật!';
        $this->_message_warning = 'Liên hệ không tồn tại!';

		$id = $this->input->get('id');
		if ($id != 0) {
			if ($this->M_contact->delete($id)) {
				$this->set_message_success();
			} else {
				$this->set_message_danger();
			}
		} else {
			$this->set_message_warning();
		}
		redirect(get_admin_url($this->_module_slug));
    }

}

/* End of file contact.php */
/* Location: ./application/modules/contact/controllers/contact.php */
