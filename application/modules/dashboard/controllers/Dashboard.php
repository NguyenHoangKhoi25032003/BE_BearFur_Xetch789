<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

include_once APPPATH . '/modules/layout/controllers/Layout.php';

class Dashboard extends Layout {

    function __construct() {
        parent::__construct();
        $this->_data['breadcrumbs_module_name'] = 'Bảng điều khiển';
    }

    function index() {
		$this->_initialize_admin();

        $this->_plugins_css_admin[] = array(
            'folder' => 'chart/dist',
            'name' => 'Chart.min'
        );
        $this->_plugins_script_admin[] = array(
            'folder' => 'chart/dist',
            'name' => 'Chart.min'
        );
        $this->set_plugins_admin();

        $this->_modules_script[] = array(
            'folder' => 'dashboard',
            'name' => 'admin-index'
        );
        $this->set_modules();

        $get = $this->input->get();
        $this->_data['get'] = $get;

        $this->_data['num_contact_new'] = modules::run('contact/num_rows_new');
        $this->_data['num_contact'] = modules::run('contact/counts');

        $this->_data['num_pages'] = modules::run('pages/counts');
        $this->_data['num_posts'] = modules::run('posts/counts');
        $this->_data['num_shops'] = modules::run('shops/rows/counts');

        $orders_args = array();
        $orders_args['order_by'] = array(
            'shops_order.created' => 'DESC',
        );
        $this->_data['orders'] = $this->M_shops_orders->gets($orders_args, 6, 0);

        $this->_data['bestsellers_shops'] = modules::run('shops/rows/get_top_4_rows', 4);

        $years = array(
            '2019' => 2019,
            '2020' => 2020,
        );
        $groups_year = $this->M_shops_orders->gets_group_year();
        if(is_array($groups_year)){
            $years = array_column($groups_year, 'YEAR', 'YEAR');
        }
        $this->_data['years'] = $years;

        $chart = array(
            array(
                'month' => 1,
                'lable' => 'Tháng 1',
                'value' => 0,
                'background' => 'rgba(54, 162, 235, 0.2)',
                'border' => 'rgba(54, 162, 235, 1)',
            ),
            array(
                'month' => 2,
                'lable' => 'Tháng 2',
                'value' => 0,
                'background' => 'rgba(54, 162, 235, 0.2)',
                'border' => 'rgba(54, 162, 235, 1)',
            ),
            array(
                'month' => 3,
                'lable' => 'Tháng 3',
                'value' => 0,
                'background' => 'rgba(54, 162, 235, 0.2)',
                'border' => 'rgba(54, 162, 235, 1)',
            ),
            array(
                'month' => 4,
                'lable' => 'Tháng 4',
                'value' => 0,
                'background' => 'rgba(54, 162, 235, 0.2)',
                'border' => 'rgba(54, 162, 235, 1)',
            ),
            array(
                'month' => 5,
                'lable' => 'Tháng 5',
                'value' => 0,
                'background' => 'rgba(54, 162, 235, 0.2)',
                'border' => 'rgba(54, 162, 235, 1)',
            ),
            array(
                'month' => 6,
                'lable' => 'Tháng 6',
                'value' => 0,
                'background' => 'rgba(54, 162, 235, 0.2)',
                'border' => 'rgba(54, 162, 235, 1)',
            ),
            array(
                'month' => 7,
                'lable' => 'Tháng 7',
                'value' => 0,
                'background' => 'rgba(54, 162, 235, 0.2)',
                'border' => 'rgba(54, 162, 235, 1)',
            ),
            array(
                'month' => 8,
                'lable' => 'Tháng 8',
                'value' => 0,
                'background' => 'rgba(54, 162, 235, 0.2)',
                'border' => 'rgba(54, 162, 235, 1)',
            ),
            array(
                'month' => 9,
                'lable' => 'Tháng 9',
                'value' => 0,
                'background' => 'rgba(54, 162, 235, 0.2)',
                'border' => 'rgba(54, 162, 235, 1)',
            ),
            array(
                'month' => 10,
                'lable' => 'Tháng 10',
                'value' => 0,
                'background' => 'rgba(54, 162, 235, 0.2)',
                'border' => 'rgba(54, 162, 235, 1)',
            ),
            array(
                'month' => 11,
                'lable' => 'Tháng 11',
                'value' => 0,
                'background' => 'rgba(54, 162, 235, 0.2)',
                'border' => 'rgba(54, 162, 235, 1)',
            ),
            array(
                'month' => 12,
                'lable' => 'Tháng 12',
                'value' => 0,
                'background' => 'rgba(54, 162, 235, 0.2)',
                'border' => 'rgba(54, 162, 235, 1)',
            ),
        );
        $year = $this->input->get('year') && in_array($this->input->get('year'), $years) ? $this->input->get('year') : date('Y');
        $this->_data['year'] = $year;
        foreach ($chart as $key => $value) {
            $month_year = $value['month'] . "-" . $year;
            $time = strtotime("01-" . $month_year);
            $month_start = strtotime('first day of this month', $time);
            $month_end = strtotime('last day of this month', $time);
            $start_date = get_start_date(date('Y-m-d', $month_start));
            $end_date = get_end_date(date('Y-m-d', $month_end));
            $balance = $this->M_shops_orders->get_total(array(
                'transaction_status' => 1,
                'start_date_start' => $start_date,
                'start_date_end' => $end_date,
            ));
            $chart[$key]['value'] = $balance;
        }
        $this->_data['chart'] = $chart;

        $this->_data['title'] = 'Bảng điều khiển - ' . $this->_data['title'];
        $this->_data['main_content'] = 'dashboard/view_page_index';
        $this->load->view('layout/admin/view_layout', $this->_data);
    }

}