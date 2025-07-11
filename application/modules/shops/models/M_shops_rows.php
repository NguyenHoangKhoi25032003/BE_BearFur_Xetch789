<?php
class M_shops_rows extends CI_Model {

    public $_table_name = 'shops_rows';

    public function __construst() {
        parent::__construst();
    }

    private function generate_where($args) {
        if (isset($args['q'])) {
            $this->db->group_start();
            $this->db->like($this->_table_name . ".title", $args['q']);
            $this->db->or_like($this->_table_name . ".hometext", $args['q']);
			$this->db->group_end();
        }

        if (isset($args['search'])) {
            $this->db->group_start();
            $this->db->like($this->_table_name . ".title", $args['search']);
            $this->db->or_like($this->_table_name . ".product_code", $args['search']);
            $this->db->group_end();
        }

        if (isset($args['user_id'])) {
            $this->db->where($this->_table_name . ".user_id", $args['user_id']);
        }

        if (isset($args['cat_id'])) {
            $this->db->where($this->_table_name . ".listcatid", $args['cat_id']);
        }

        if (isset($args['not_in_id'])) {
            $this->db->where_not_in($this->_table_name . ".id", $args['not_in_id']);
        }
        if (isset($args['in_filter_id'])) {
            $this->db->where_in($this->_table_name . ".filter_id", $args['in_filter_id']);
        }
        if (isset($args['in_id'])) {
            $this->db->where_in($this->_table_name . ".id", $args['in_id']);
        }

        if (isset($args['in_cat_id'])) {
            $this->db->where_in($this->_table_name . ".listcatid", $args['in_cat_id']);
        }

        if (isset($args['price_start']) && isset($args['price_end'])) {//tu 5tr - 7tr
            $this->db->group_start();
            $this->db->where($this->_table_name . ".product_price >=", $args['price_start']);
            $this->db->where($this->_table_name . ".product_price <=", $args['price_end']);
            $this->db->group_end();
        }elseif(isset($args['price_start'])){//tren 5tr
            $this->db->where($this->_table_name . ".product_price >=", $args['price_start']);
        }elseif(isset($args['price_end'])){//duoi 5tr
            $this->db->where($this->_table_name . ".product_price <=", $args['price_end']);
        }

        if (isset($args['collection_id'])) {
            $this->db->where($this->_table_name . ".collection_id", $args['collection_id']);
        }

        if (isset($args['status'])) {
            $this->db->where($this->_table_name . ".status", $args['status']);
        }

		if (isset($args['is_bestseller'])) {
            $this->db->where($this->_table_name . ".is_bestseller", $args['is_bestseller']);
        }

        if (isset($args['is_featured'])) {
            $this->db->where($this->_table_name . ".is_featured", $args['is_featured']);
        }

		if (isset($args['is_new'])) {
            $this->db->where($this->_table_name . ".is_new", $args['is_new']);
        }

		if (isset($args['is_promotion'])) {
            $this->db->where($this->_table_name . ".is_promotion", $args['is_promotion']);
        }

		if (isset($args['is_bestview'])) {
            $this->db->where($this->_table_name . ".is_bestview", $args['is_bestview']);
        }
    }

    private function generate_order_by($args) {
        $allow_sort = array("DESC", "ASC", "RANDOM");

        if (isset($args['order_by']) && is_array($args['order_by']) && !empty($args['order_by'])) {
            foreach ($args['order_by'] as $key => $value) {
                $sort = in_array($value, $allow_sort) ? $value : "DESC";
                $this->db->order_by($this->_table_name . '.' . $key, $sort);
            }
        }
    }

    public function gets($args, $perpage = 5, $offset = -1) {
        $this->db->select($this->_table_name . '.*,' . 'shops_rows.product_price as price, shops_cat.alias as cat_alias, shops_cat.name as cat_name, users.full_name as full_name');
        $this->db->from($this->_table_name);
        $this->db->join('shops_cat', 'shops_cat.id = ' . $this->_table_name . '.listcatid', 'left');
        $this->db->join('users', 'users.userid = ' . $this->_table_name . '.user_id', 'left');

        $this->generate_where($args);
        $this->generate_order_by($args);
        if ($offset >= 0) {
            $this->db->limit($perpage, $offset);
        }
        $query = $this->db->get();

        return $query->result_array();
    }

    public function gets_rows() {
        $this->db->select();
        $this->db->from('shops_rows_1');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function gets_cat() {
        $this->db->select();
        $this->db->from('shops_cat_1');
        $query = $this->db->get();

        return $query->result_array();
    }

    function search($args) {
        // $this->db->select('id, CONCAT(title," - ", product_code) as text'); // nối chuỗi
        // $this->db->select('id, LEFT(CONCAT(title," - ", product_code), char_length(CONCAT(title," - ", product_code)) - 3) as text');// cắt chuỗi nối 3 kí tự, cuối chuỗi
        $this->db->select('id, TRIM(TRAILING " - " FROM CONCAT(title," - ", product_code)) as text');// thay chuỗi nối bằng kí tự, cuối chuỗi TRAILING
        $this->db->from($this->_table_name);

        $this->generate_where($args);
        $this->generate_order_by($args);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function counts($args) {
        $this->db->select('*');
        $this->db->from($this->_table_name);

        $this->generate_where($args);

        $query = $this->db->get();

        return $query->num_rows();
    }

    public function get($id, $alias = '') {
        $this->db->select($this->_table_name . '.*,' . 'shops_rows.product_price as price, shops_cat.alias as cat_alias, shops_cat.id as cat_id, shops_cat.name as cat_name, users.full_name as full_name, users.username as username, users.shop_id as shop_id, users.shop_name as shop_name, users.shop_logo as shop_logo');
        $this->db->from($this->_table_name);
        $this->db->join('shops_cat', 'shops_cat.id = ' . $this->_table_name . '.listcatid', 'left');
        $this->db->join('users', 'users.userid = ' . $this->_table_name . '.user_id', 'left');
        $this->db->where($this->_table_name . '.id', $id);
        if (trim($alias) != '') {
            $this->db->where($this->_table_name . '.alias', $alias);
        }
        $query = $this->db->get();
        return $query->row_array();
    }

    function check_product_code_availablity($product_code) {
        if (trim($product_code) == '') {
            return false;
        }

        $this->db->select();
        $this->db->where('product_code', $product_code);
        $this->db->from($this->_table_name);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return false;
        } else {
            return true;
        }
    }

    function check_current_product_code_availablity($product_code, $id = 0) {
        if (trim($product_code) == '') {
            return false;
        }

        $this->db->select();
        if ($id != 0) {
            $this->db->where('id', $id);
            $this->db->or_where('product_code', $product_code);
        } else {
            $this->db->where('product_code', $product_code);
        }

        $this->db->from($this->_table_name);

        $query = $this->db->get();

        if ($id != 0) {
            if ($query->num_rows() == 1) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            if ($query->num_rows() > 0) {
                return false;
            } else {
                return true;
            }
        }
    }

    public function add($data = array()) {
        if (empty($data)) {
            return 0;
        }
        $query = $this->db->insert($this->_table_name, $data);
        $insert_id = $this->db->insert_id();
        return (isset($query)) ? $insert_id : 0;
    }

    public function update($id, $data) {
        if (empty($data)) {
            return FALSE;
        }
        $this->db->where('id', $id);
        $query = $this->db->update($this->_table_name, $data);

        return (isset($query)) ? true : false;
    }

    public function delete($id) {
        $this->db->where('id', $id);
        $query = $this->db->delete($this->_table_name);

        return (isset($query)) ? true : false;
    }

    public function delete_in_users($user_id) {
        $this->db->where('user_id', $user_id);
        $query = $this->db->delete($this->_table_name);

        return (isset($query)) ? true : false;
    }

    /*public function get_pagination_admin($filter = null, $perpage, $offset) {
        $this->db->select($this->_table_name . '.*,' . 'shops_catalogs.alias as cat_alias');
        $this->db->from($this->_table_name);
        $this->db->join('shops_catalogs', 'shops_catalogs.catid = ' . $this->_table_name . '.listcatid', 'left');

        if (isset($filter['catid']) && (!empty($filter['catid']))) {
            $this->db->where_in($this->_table_name . '.listcatid', $filter['catid']);
        }

        if (isset($filter['stype'])) {
            if (trim($filter['stype']) != '') {
                if (isset($filter['q']) && trim($filter['q']) != '') {
                    $this->db->like($this->_table_name . '.' . $filter['stype'], $filter['q']);
                }
            } else {
                if (isset($filter['q']) && trim($filter['q']) != '') {
                    $this->db->like($this->_table_name . '.product_code', $filter['q']);
                    $this->db->or_like($this->_table_name . '.title', $filter['q']);
                    $this->db->or_like($this->_table_name . '.bodytext', $filter['q']);
                    $this->db->or_like($this->_table_name . '.user_id', $filter['q']);
                }
            }
        } else {
            if (isset($filter['q']) && trim($filter['q']) != '') {
                $this->db->like($this->_table_name . '.product_code', $filter['q']);
                $this->db->or_like($this->_table_name . '.title', $filter['q']);
                $this->db->or_like($this->_table_name . '.bodytext', $filter['q']);
                $this->db->or_like($this->_table_name . '.user_id', $filter['q']);
            }
        }

        $this->db->limit($perpage, $offset);
        $records = $this->db->get();

        return $records->result_array();
    }

    public function get_total_admin($filter = null) {
        $this->db->select();
        $this->db->from($this->_table_name);

        if (isset($filter['catid']) && (!empty($filter['catid']))) {
            $this->db->where_in($this->_table_name . '.listcatid', $filter['catid']);
        }

        if (isset($filter['stype'])) {
            if (trim($filter['stype']) != '') {
                if (isset($filter['q']) && trim($filter['q']) != '') {
                    $this->db->like($this->_table_name . '.' . $filter['stype'], $filter['q']);
                }
            } else {
                if (isset($filter['q']) && trim($filter['q']) != '') {
                    $this->db->like($this->_table_name . '.product_code', $filter['q']);
                    $this->db->or_like($this->_table_name . '.title', $filter['q']);
                    $this->db->or_like($this->_table_name . '.bodytext', $filter['q']);
                    $this->db->or_like($this->_table_name . '.user_id', $filter['q']);
                }
            }
        } else {
            if (isset($filter['q']) && trim($filter['q']) != '') {
                $this->db->like($this->_table_name . '.product_code', $filter['q']);
                $this->db->or_like($this->_table_name . '.title', $filter['q']);
                $this->db->or_like($this->_table_name . '.bodytext', $filter['q']);
                $this->db->or_like($this->_table_name . '.user_id', $filter['q']);
            }
        }

        $records = $this->db->get();

        return $records->num_rows();
    }*/

    /*function search($filter = null, $terms, $perpage, $offset) {
        $this->db->select($this->_table_name . '.*,' . 'shops_catalogs.alias as cat_alias');
        $this->db->from($this->_table_name);
        $this->db->join('shops_catalogs', 'shops_catalogs.catid = ' . $this->_table_name . '.listcatid', 'left');
        $this->db->like($this->_table_name . '.title', $terms);
        $this->db->or_like('shops_catalogs.title', $terms);

        if (isset($filter['sort'])) {
            if ($filter['sort'] == 'NAZ') {
                $this->db->order_by($this->_table_name . '.title', 'ASC');
            } elseif ($filter['sort'] == 'NZA') {
                $this->db->order_by($this->_table_name . '.title', 'DESC');
            }
        }

        $this->db->limit($perpage, $offset);
        $records = $this->db->get();

        return $records->result_array();
    }

    public function get_total_search($terms) {
        $this->db->select();
        $this->db->from($this->_table_name);
        $this->db->join('shops_catalogs', 'shops_catalogs.catid = ' . $this->_table_name . '.listcatid', 'left');
        $this->db->like($this->_table_name . '.title', $terms);
        $this->db->or_like('shops_catalogs.title', $terms);

        $query = $this->db->get();
        return $query->num_rows();
    }

    function advanced_search($advanced_search = null, $perpage, $offset) {
        $this->db->select($this->_table_name . '.*,' . 'shops_catalogs.alias as cat_alias');
        $this->db->from($this->_table_name);
        $this->db->join('shops_catalogs', 'shops_catalogs.catid = ' . $this->_table_name . '.listcatid', 'left');
        //theo tên
        if (trim($advanced_search['product_name']) != '') {
            $this->db->like($this->_table_name . '.title', $advanced_search['product_name']);
        }
        //theo mã
        if (trim($advanced_search['product_code']) != '') {
            $this->db->where($this->_table_name . '.product_code', $advanced_search['product_code']);
        }
        //theo giá
        if (trim($advanced_search['product_price_s']) != '' && trim($advanced_search['product_price_f']) != '') {
            $product_price = $this->_table_name . '.product_price BETWEEN  ' . $advanced_search['product_price_s'] . ' AND  ' . $advanced_search['product_price_f'];
            $this->db->where($product_price);
        }

        //theo loại
        if (trim($advanced_search['catid']) != 0) {
            $this->db->where($this->_table_name . '.listcatid', $advanced_search['catid']);
        }

        if (isset($advanced_search['sort'])) {
            if ($advanced_search['sort'] == 'NAZ') {
                $this->db->order_by($this->_table_name . '.title', 'ASC');
            } elseif ($advanced_search['sort'] == 'NZA') {
                $this->db->order_by($this->_table_name . '.title', 'DESC');
            }
        }

        $this->db->limit($perpage, $offset);
        $records = $this->db->get();
        //$str = $this->db->last_query();
        //echo $str;
        return $records->result_array();
    }

    public function get_total_advanced_search($advanced_search = null) {
        $this->db->select();
        $this->db->from($this->_table_name);
        $this->db->join('shops_catalogs', 'shops_catalogs.catid = ' . $this->_table_name . '.listcatid', 'left');
        //theo tên
        if (trim($advanced_search['product_name']) != '') {
            $this->db->like($this->_table_name . '.title', $advanced_search['product_name']);
        }
        //theo mã
        if (trim($advanced_search['product_code']) != '') {
            $this->db->where($this->_table_name . '.product_code', $advanced_search['product_code']);
        }
        //theo giá
        if (trim($advanced_search['product_price_s']) != '' && trim($advanced_search['product_price_f']) != '') {
            $product_price = $this->_table_name . '.product_price BETWEEN  ' . $advanced_search['product_price_s'] . ' AND  ' . $advanced_search['product_price_f'];
            $this->db->where($product_price);
        }
        //theo loại
        if (trim($advanced_search['catid']) != 0) {
            $this->db->where($this->_table_name . '.listcatid', $advanced_search['catid']);
        }

        $query = $this->db->get();
        return $query->num_rows();
    }*/

    public function get_by_category($category, $type = null) {
        $args = array('status' => 1);
        $CI =& get_instance();
        $CI->load->model('shops/m_shops_cat');
        if ($type) {
            $type_row = $CI->m_shops_cat->gets(array('name' => $type));
            if (!empty($type_row)) {
                $args['cat_id'] = $type_row[0]['id'];
            }
        } elseif ($category) {
            $cat_row = $CI->m_shops_cat->gets(array('name' => $category, 'parent' => 0));
            if (!empty($cat_row)) {
                $type_rows = $CI->m_shops_cat->gets(array('parent' => $cat_row[0]['id']));
                $type_ids = array_column($type_rows, 'id');
                if (!empty($type_ids)) {
                    $args['in_cat_id'] = $type_ids;
                }
            }
        }
        return $this->gets($args, 20, 0);
    }

}

/* End of file M_shops_rows.php */
/* Location: ./application/modules/shops/models/M_shops_rows.php */
