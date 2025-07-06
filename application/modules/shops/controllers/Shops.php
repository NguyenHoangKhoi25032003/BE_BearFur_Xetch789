<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Shops extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('shops/m_shops_rows', 'M_shops_rows');
        $this->load->model('shops/m_shops_cat', 'M_shops_cat');
    }

    public function index() {
        $category = $this->input->get('category');
        $type = $this->input->get('type');

        $data = array();

        if ($category) {
            $data['products'] = $this->M_shops_rows->get_by_category($category, $type);
            $data['category'] = $category;
            $data['type'] = $type;
        } else {
            $data['products'] = $this->M_shops_rows->get_all();
        }

        $data['categories'] = $this->M_shops_cat->get_all();

        // Load layout BearFur
        $this->load->view('shops/product_list', $data);
    }

    public function detail($id) {
        $data['product'] = $this->M_shops_rows->get_by_id($id);
        $data['related_products'] = $this->M_shops_rows->get_related($id, 4);

        if (!$data['product']) {
            show_404();
        }

        // Load layout BearFur
        $this->load->view('shops/product_detail', $data);
    }

    public function search() {
        $keyword = $this->input->get('q');
        $data['products'] = $this->M_shops_rows->search($keyword);
        $data['keyword'] = $keyword;

        // Load layout BearFur
        $this->load->view('shops/search_results', $data);
    }

    public function api_products() {
        $type = $this->input->get('type');
        $products = array();

        switch ($type) {
            case 'bestseller':
                $products = $this->M_shops_rows->get_bestseller(8);
                break;
            case 'new':
                $products = $this->M_shops_rows->get_new(8);
                break;
            default:
                $products = $this->M_shops_rows->get_all(8);
        }

        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($products));
    }

    public function product() {
        $this->load->model('shops/m_shops_rows', 'M_shops_rows');
        $args = array('status' => 1);
        $products = $this->M_shops_rows->gets($args, 20, 0); // lấy 20 sản phẩm đầu tiên
        $data['products'] = $products;
        $data['content'] = $this->load->view('../../layout/views/site/pages/product', $data, true);
        $data['show_home_blocks'] = false;
        $this->load->view('../../layout/views/site/layout_bearfur', $data);
    }
}
