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
        $catid = $this->input->get('catid');
        $data = array();
        $args = array('status' => 1);

        if ($catid) {
            $cat = $this->M_shops_cat->get($catid);
            if ($cat) {
                if ($cat['parent'] == 0) {
                    // Là danh mục cha, lấy tất cả loại con
                    $type_rows = $this->M_shops_cat->gets(array('parent' => $catid));
                    $type_ids = array_column($type_rows, 'id');
                    if (!empty($type_ids)) {
                        $args['in_cat_id'] = $type_ids;
                    } else {
                        $args['in_cat_id'] = [-1];
                    }
                    $data['category'] = $cat['name'];
                } else {
                    // Là loại con, lấy sản phẩm thuộc loại này
                    $args['cat_id'] = $catid;
                    $data['type'] = $cat['name'];
                    // Lấy tên danh mục cha
                    $parent_cat = $this->M_shops_cat->get($cat['parent']);
                    if ($parent_cat) {
                        $data['category'] = $parent_cat['name'];
                    }
                }
            } else {
                $args['cat_id'] = -1; // Không tìm thấy danh mục
            }
            $data['products'] = $this->M_shops_rows->gets($args, 100, 0);
            $data['catid'] = $catid;
        } else {
            $data['products'] = $this->M_shops_rows->gets(array('status' => 1), 100, 0);
        }

        $data['categories'] = $this->M_shops_cat->gets(array('parent' => 0));
        $data['content'] = $this->load->view('../../layout/views/site/pages/product', $data, true);
        $data['show_home_blocks'] = false;
        $this->load->view('../../layout/views/site/layout_bearfur', $data);
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
        $this->load->model('shops/m_shops_cat', 'M_shops_cat');

        $category = $this->input->get('category');
        $type = $this->input->get('type');
        $args = array('status' => 1);

        if ($type) {
            // Lấy id loại sản phẩm theo tên
            $type_row = $this->M_shops_cat->gets(array('name' => $type));
            if (!empty($type_row)) {
                $args['cat_id'] = $type_row[0]['id'];
            }
        } elseif ($category) {
            // Lấy id danh mục cha
            $cat_row = $this->M_shops_cat->gets(array('name' => $category, 'parent' => 0));
            if (!empty($cat_row)) {
                // Lấy tất cả id loại sản phẩm con
                $type_rows = $this->M_shops_cat->gets(array('parent' => $cat_row[0]['id']));
                $type_ids = array_column($type_rows, 'id');
                if (!empty($type_ids)) {
                    $args['in_cat_id'] = $type_ids;
                }
            }
        }

        $products = $this->M_shops_rows->gets($args, 20, 0); // lấy 20 sản phẩm đầu tiên
        $data['products'] = $products;
        $data['categories'] = $this->M_shops_cat->gets(array('parent' => 0));
        $data['content'] = $this->load->view('../../layout/views/site/pages/product', $data, true);
        $data['show_home_blocks'] = false;
        $this->load->view('../../layout/views/site/layout_bearfur', $data);
    }
}
