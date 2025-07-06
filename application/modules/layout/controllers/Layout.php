<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Layout extends MX_Controller {
	protected $_data = array();
	protected $_status = '';
	protected $_message = '';
	protected $_message_success = '';
	protected $_message_warning = '';
	protected $_message_danger = 'Rất tiếc! Có lỗi kỹ thuật!';
	protected $_message_banned = 'Không có quyền truy cập vào khu vực này!';
	protected $_breadcrumbs = array();
	protected $_breadcrumbs_admin = array();
	protected $_add_css = array();
	protected $_add_js = array();
	protected $_plugins_css = array();
	protected $_plugins_script = array();
	protected $_plugins_css_admin = array();
	protected $_plugins_script_admin = array();
	protected $_modules_css = array();
	protected $_modules_script = array();

	function __construct() {
		parent::__construct();
	}

	public function error404(){
		$this->output->set_status_header('404');
		$this->_initialize();
		// $data = array();
		// $segment = 1;
  //       $action = ($this->uri->segment($segment) == '') ? 0 : $this->uri->segment($segment);
  //       $data['action'] = $action;
		// $this->load->view('error404', $data);
		$this->load->view('error404', $this->_data);
	}

	public function _initialize_global($configs) {
		$this->config->set_item('url_posts_cat', modules::run('menu/menu_type/get_values_type', 'post_categories'));
		$this->config->set_item('url_posts_rows', modules::run('menu/menu_type/get_values_type', 'posts'));
		$this->config->set_item('url_contact', modules::run('menu/menu_type/get_values_type', 'contact'));
		$this->config->set_item('url_shops_cat', modules::run('menu/menu_type/get_values_type', 'categories'));
		$this->config->set_item('url_shops_rows', modules::run('menu/menu_type/get_values_type', 'products'));

		$parse = parse_url(base_url());
		$this->_data['host'] = $parse['host'];

		$this->_data['site_name'] = $configs['site_name'];
		$this->_data['title'] = $configs['site_name'];
		$this->_data['title_seo'] = $configs['title_seo'];
		$this->_data['other_seo'] = $configs['other_seo'];
		$this->_data['h1_seo'] = $configs['h1_seo'];
		$this->_data['h2_seo'] = $configs['h2_seo'];
		$this->_data['description'] = $configs['site_description'];
		$this->_data['keywords'] = $configs['site_keywords'];
		$this->_data['site_icon'] = $configs['site_icon'];
		$this->_data['email'] = $configs['site_email'];
		$forms_of_payment = array();
		$forms_of_payment['cod'] = @unserialize($configs['cod']);
		$forms_of_payment['bacs'] = @unserialize($configs['bacs']);
		//$forms_of_payment['cheque'] = @unserialize($configs['cheque']);
		//var_dump($forms_of_payment); die;
		$this->config->set_item('forms_of_payment', $forms_of_payment);
		$this->_initialize_user();
	}

	public function _initialize_user() {
		$this->_data['logged_in'] = FALSE;
		if ($this->session->has_userdata('logged_in')) {
			$this->_data['logged_in'] = TRUE;
			$session_data = $this->session->userdata('logged_in');
			$this->_data['userid'] = $session_data['userid'];
			$this->_data['username'] = $session_data['username'];
			$this->_data['full_name'] = $session_data['full_name'];
			$this->_data['photo'] = $session_data['photo'];
			$this->_data['role'] = isset($session_data['role']) ? $session_data['role'] : '';
			$this->_data['created'] = isset($session_data['created']) ? $session_data['created'] : '';
			$this->_data['ref'] = isset($session_data['ref']) ? $session_data['ref'] : '';
		}
		if ($this->session->has_userdata('logged_in_by')) {
			$this->_data['logged_in'] = TRUE;
			$session_data = $this->session->userdata('logged_in_by');
			$this->_data['userid'] = $session_data['userid'];
			$this->_data['username'] = $session_data['username'];
			$this->_data['full_name'] = $session_data['full_name'];
			$this->_data['photo'] = $session_data['photo'];
			$this->_data['role'] = isset($session_data['role']) ? $session_data['role'] : '';
			$this->_data['created'] = isset($session_data['created']) ? $session_data['created'] : '';
			$this->_data['ref'] = isset($session_data['ref']) ? $session_data['ref'] : '';
		}
	}

	public function _initialize() {
		$configs = $this->get_configs();
		$this->_initialize_global($configs);

		/*
		$shops_cat = modules::run('shops/cat/gets');
		$this->_data['shops_cat_list'] = $shops_cat['data_list']; //mang chua quan he cha con
		$this->_data['shops_cat_data'] = $shops_cat['data_input']; // mang chua du lieu tat ca cat (có link)
		$this->_data['shops_cat_input'] = $shops_cat['data_input']; // mang chua du lieu tat ca cat (không link chi co gia tri va ten de dung cho input)

		$this->_data['postcat_list'] = modules::run('posts/postcat/get_menu_list');
		$this->_data['postcat_data'] = modules::run('posts/postcat/get_data');
		$this->_data['postcat_input'] = modules::run('posts/postcat/get_input');
		*/

		/*
		$main = 'Main';
		$this->_data['menu_main_list'] = modules::run('menu/get_menu_list', $main);
		$this->_data['menu_main_data'] = modules::run('menu/get_data', $main);
		$this->_data['menu_main_input'] = modules::run('menu/get_input', $main);

		$bottom = 'Bottom';
		$this->_data['menu_bottom_list'] = modules::run('menu/get_menu_list', $bottom);
		$this->_data['menu_bottom_data'] = modules::run('menu/get_data', $bottom);
		$this->_data['menu_bottom_input'] = modules::run('menu/get_input', $bottom);

		$left = 'Left';
		$this->_data['menu_left_list'] = modules::run('menu/get_menu_list', $left);
		$this->_data['menu_left_data'] = modules::run('menu/get_data', $left);
		$this->_data['menu_left_input'] = modules::run('menu/get_input', $left);

		$right = 'Right';
		$this->_data['menu_right_list'] = modules::run('menu/get_menu_list', $right);
		$this->_data['menu_right_data'] = modules::run('menu/get_data', $right);
		$this->_data['menu_right_input'] = modules::run('menu/get_input', $right);
		*/

		$this->_breadcrumbs[] = array(
			'url' => base_url(),
			'name' => 'Trang chủ',
		);
		$this->set_breadcrumbs();

		$this->_data['analytics_UA_code'] = $configs['analytics_UA_code'];
		$this->_data['display_copyright_developer'] = $configs['display_copyright_developer'];

		$this->_data['site_hotline'] = $configs['site_hotline'];
		$this->_data['site_address'] = $configs['site_address'];
		$this->_data['site_phone'] = $configs['site_phone'];

		$this->_data['favicon'] = $configs['favicon'];
		$this->_data['site_logo'] = $configs['site_logo'];
		$this->_data['site_logo_footer'] = $configs['site_logo_footer'];

		$this->_data['fb_page'] = $configs['fb_page'];
		$this->_data['iframe_map'] = $configs['iframe_map'];
		$this->_data['site_content_contact'] = $configs['site_content_contact'];
		$this->_data['iframe_video'] = $configs['iframe_video'];

		$this->_data['facebook_fanpage'] = $configs['facebook_fanpage'];
		$this->_data['google_plus'] = $configs['google_plus'];
		$this->_data['instagram_page'] = $configs['instagram_page'];
		$this->_data['youtube_page'] = $configs['youtube_page'];
		$this->_data['twitter_page'] = $configs['twitter_page'];
		$this->_data['skype_page'] = $configs['skype_page'];
		$this->_data['linkedin_page'] = $configs['linkedin_page'];

		$this->_load_menu_main();
		$this->_data['html_menu_bottom'] = $this->_load_menu('Bottom');
		$this->_load_category_product();
		$this->_load_category_search();

		//search
		$this->_data['q'] = $this->input->get('q');
		$ref = $this->input->get('ref');
        if (trim($ref) != '') {
            $cookie_user_id = $this->get_cookie_user_id();
            if (isset($_COOKIE[$cookie_user_id])) {
                delete_cookie($cookie_user_id);
            }
            $parse = parse_url(base_url());
            $cookie = array(
                'name' => $cookie_user_id,
                'value' => $ref,
                'expire' => 86400 * 1,
                'domain' => $parse['host'],
                'path' => '/',
            );
            set_cookie($cookie);
        }

		$this->_plugins_script[] = array(
            'folder' => 'clipboard.js/dist',
            'name' => 'clipboard',
        );
        $this->_plugins_script[] = array(
            'folder' => 'clipboard.js',
            'name' => 'app',
        );

		$this->_modules_script[] = array(
			'folder' => 'shops',
			'name' => 'cart',
		);

		$this->_modules_script[] = array(
			'folder' => 'newsletter',
			'name' => 'newsletter',
		);

		//hotline
		$info_hotline_none = modules::run('info/get_by_type', 'hotline', TRUE);
		$this->_data['info_hotline_none'] = $info_hotline_none;

		//email
		$info_email_none = modules::run('info/get_by_type', 'email', TRUE);
		$this->_data['info_email_none'] = $info_email_none;

		//address
		$info_address_none = modules::run('info/get_by_type', 'address', TRUE);
		$this->_data['info_address_none'] = $info_address_none;

		//contact_footer
		$info_contact_footer_none = modules::run('info/get_by_type', 'contact_footer', TRUE);
		$this->_data['info_contact_footer_none'] = $info_contact_footer_none;

		//name_company_footer
		$info_name_company_footer_none = modules::run('info/get_by_type', 'name_company_footer', TRUE);
		$this->_data['info_name_company_footer_none'] = $info_name_company_footer_none;

		//timework
		$info_timework_none = modules::run('info/get_by_type', 'timework', TRUE);
		$this->_data['info_timework_none'] = $info_timework_none;

		//hotline_dt
		$info_hotline_dt_none = modules::run('info/get_by_type', 'hotline_dt', TRUE);
		$this->_data['info_hotline_dt_none'] = $info_hotline_dt_none;

		//copyright
		$info_copyright_none = modules::run('info/get_by_type', 'copyright', TRUE);
		$this->_data['info_copyright_none'] = $info_copyright_none;

		//about_us
		$info_about_us_none = modules::run('info/get_by_type', 'about_us', TRUE);
		$this->_data['info_about_us_none'] = $info_about_us_none;

		//infomation
		$info_infomation_none = modules::run('info/get_by_type', 'infomation', TRUE);
		$this->_data['info_infomation_none'] = $info_infomation_none;

		//video_footer
		$info_video_footer_none = modules::run('info/get_by_type', 'video_footer', TRUE);
		$this->_data['info_video_footer_none'] = $info_video_footer_none;

		//newsletter
		$info_newsletter_none = modules::run('info/get_by_type', 'newsletter', TRUE);
		$this->_data['info_newsletter_none'] = $info_newsletter_none;

		//contact
		$info_contact_none = modules::run('info/get_by_type', 'contact', TRUE);
		$this->_data['info_contact_none'] = $info_contact_none;

		//introduce
		$info_introduce_none = modules::run('info/get_by_type', 'introduce', TRUE);
		$this->_data['info_introduce_none'] = $info_introduce_none;

		//connect_us
		$info_connect_us_none = modules::run('info/get_by_type', 'connect_us', TRUE);
		$this->_data['info_connect_us_none'] = $info_connect_us_none;

		//support
		$info_support_none = modules::run('info/get_by_type', 'support', TRUE);
		$this->_data['info_support_none'] = $info_support_none;

		//Catalog Product
		$catalog_product_none = modules::run('images/get_by_type', 'catalog_product', TRUE);
		$this->_data['catalog_product_none'] = $catalog_product_none;

		//Introdues Content
		$introdues_content_none = modules::run('images/get_by_type', 'introdues_content');
		$this->_data['introdues_content_none'] = $introdues_content_none;

		//Breadcrumb
		$breadcrumb_none = modules::run('images/get_by_type', 'breadcrumb', TRUE);
		$this->_data['breadcrumb_none'] = $breadcrumb_none;

		//Introdues
		$introdues_none = modules::run('images/get_by_type', 'introdues', TRUE);
		$this->_data['introdues_none'] = $introdues_none;

		//images_dmca
		$images_dmca_none = modules::run('images/get_by_type', 'images_dmca', TRUE);
		$this->_data['images_dmca_none'] = $images_dmca_none;

		//images_qr
		$images_qr_none = modules::run('images/get_by_type', 'images_qr', TRUE);
		$this->_data['images_qr_none'] = $images_qr_none;

		//Advertise
		$advertise_none = modules::run('images/get_by_type', 'advertise');
		$this->_data['advertise_none'] = $advertise_none;

		//Payment Methods
		$payment_methods_none = modules::run('images/get_by_type', 'payment_methods', TRUE);
		$this->_data['payment_methods_none'] = $payment_methods_none;

		//Partner
		$partner_none = modules::run('images/get_by_type', 'partner');
		$this->_data['partner_none'] = $partner_none;

		//service
		$service_none = modules::run('images/get_by_type', 'service');
		$this->_data['service_none'] = $service_none;

		//folder_images
		$folder_images_none = modules::run('images/get_by_type', 'folder_images');
		$this->_data['folder_images_none'] = $folder_images_none;

		//products bestseller
		$products_bestseller = modules::run('shops/rows/gets_item_field', 'is_bestseller', 0);
		$partial = array();
		$partial['data'] = $products_bestseller;
		$this->_data['products_bestseller'] = $this->load->view('layout/site/partial/product_bestseller', $partial, true);

		//products bestview
		$products_bestview = modules::run('shops/rows/gets_item_field', 'is_bestview', 0);
		$partial = array();
		$partial['data'] = $products_bestview;
		$this->_data['products_bestview'] = $this->load->view('layout/site/partial/product_bestview', $partial, true);

		//posts featured
		$posts_featured = modules::run('posts/gets_item_field', 'is_featured', 0);
		$partial = array();
		$partial['data'] = $posts_featured;
		$this->_data['posts_featured'] = $this->load->view('layout/site/partial/post_featured', $partial, true);

		//products featured
		$products_featured = modules::run('shops/rows/gets_item_field', 'is_featured', 0);
		$partial = array();
		$partial['data'] = $products_featured;
		$this->_data['products_featured'] = $this->load->view('layout/site/partial/product_featured', $partial, true);

		//products cat home
		// $products_cat_home = modules::run('shops/cat/gets_inhome', 0);
		// if (is_array($products_cat_home) && !empty($products_cat_home)) {
		// 	foreach ($products_cat_home as $key => $value) {
		// 		$products_cat_home[$key]['items'] = modules::run('shops/rows/get_items_in_cat_id', $value['id'], 8);
		// 	}
		// }
		// $partial = array();
		// $partial['data'] = $products_cat_home;
		// $this->_data['products_cat_home'] = $this->load->view('layout/site/partial/product_cat_home', $partial, true);

		//posts new
		$posts_new = modules::run('posts/gets_item_field', 'is_new', 0);
		$partial = array();
		$partial['data'] = $posts_new;
		$this->_data['posts_new'] = $this->load->view('layout/site/partial/post_new', $partial, true);

		//hotline none
		//$hotline_none = modules::run('images/get_by_type', 'hotline', TRUE);
		//$this->_data['hotline_none'] = $hotline_none;
		if (!is_home()) {

		}

		//set all css, js, plugins
		$this->add_css();
		$this->add_js();
		$this->set_plugins();
		$this->set_modules();
	}

	public function _initialize_admin() {
		$configs = $this->get_configs();
		$this->_initialize_global($configs);
		//$this->_initialize_user();

		$this->_data['breadcrumbs_module_name'] = '';
		$this->_data['breadcrumbs_module_func'] = '';

		$this->_breadcrumbs_admin[] = array(
			'url' => '',
			'name' => '<i class="fa fa-dashboard"></i> Admin',
		);
		$this->set_breadcrumbs_admin();

		$this->_plugins_css_admin[] = array(
			'folder' => 'iCheck',
			'name' => 'all',
		);
		$this->_plugins_script_admin[] = array(
			'folder' => 'iCheck',
			'name' => 'icheck',
		);
		$this->_plugins_script_admin[] = array(
			'folder' => 'iCheck',
			'name' => 'app.icheck',
		);
		//set all css, js, plugins
		$this->set_plugins_admin();
		$this->set_modules();

		$this->_data['num_rows_contact'] = modules::run('contact/num_rows_new');
		$this->_data['num_rows_order'] = modules::run('shops/orders/counts', array('viewed' => 0));

		$this->_data['menu_admin_active'] = ($this->uri->segment(2) == '') ? '' : $this->uri->segment(2);
	}

	function get_cookie_user_id() {
        return md5(base64_encode($this->config->item('ledu_user_id')));
    }

    function get_ref(){
    	$ref = '';
        $cookie_user_id = $this->get_cookie_user_id();
        if (isset($_COOKIE[$cookie_user_id])) {
            $ref = get_cookie($cookie_user_id);
        }

        return $ref;
    }

	public function _load_category_product($parent = 0, $current_page = '') {
		if(trim($current_page) == ''){
			$current_page = current_url();
		}
		$data_category_product = modules::run('shops/cat/gets_data', array('parent' => $parent));
		$html_category_product = '';
		if (is_array($data_category_product) && !empty($data_category_product)) {
			$id = 0;
			foreach ($data_category_product as $key => $value) {
				$id++;
				$is_second = FALSE;
				$data_category_product_1 = modules::run('shops/cat/gets_data', array('parent' => $key));
				if (is_array($data_category_product_1) && !empty($data_category_product_1)) {
					$is_second = TRUE;
				}
				$html_category_product .= '<li>';
					$html_category_product .= '<h3 class="title" data-toggle="collapse" href="#list-'. $id . '"><a href="' . $value['lurl'] . '">' . $value['lname'] . '</a><span class="plus--icon"><i class="fas fa-plus"></i></span></h3>';
					if ($is_second) {
						$html_category_product .= '<ul id="list-'. $id . '" class="collapse" data-parent=".block-list-categories--content">';
							foreach ($data_category_product_1 as $key1 => $value1) {
								$html_category_product .= '<li><a href="' . $value1['lurl'] . '">' . $value1['lname'] . '</a></li>';
							}
						$html_category_product .= '</ul>';
					}
				$html_category_product .= "</li>";
			}
		}
		$this->_data['html_category_product'] = $html_category_product;
	}

	public function _load_category_search() {
		$search_param = 'all';
		$get = $this->input->get();
		if (isset($get['search_param']) && $get['search_param'] != 'all') {
			$search_param = $get['search_param'];
		}
		$data_category_search = modules::run('shops/cat/gets_data', array('parent' => 0));
		$html_category_search = '';
		if (is_array($data_category_search) && !empty($data_category_search)) {
			foreach ($data_category_search as $key => $value) {
				$html_category_search .= '<a href="#' . $value['lid'] . '" class="dropdown-item">' . $value['lname'] . '</a>';
			}
		}
		$this->_data['html_category_search'] = $html_category_search;
	}

	function _load_menu_main() {
		$main = 'Main';
		$data_menu_main = modules::run('menu/gets', $main, 0);
		$html_menu_main = '';
		if (is_array($data_menu_main) && !empty($data_menu_main)) {
			foreach ($data_menu_main as $key => $value) {
				$is_second = FALSE;
				$data_menu_main_1 = modules::run('menu/gets', $main, $key);
				if (is_array($data_menu_main_1) && !empty($data_menu_main_1)) {
					$is_second = TRUE;
				}
				$html_menu_main .= "<li><a" . ($value['lurl'] == current_url() ? " class=\"active\"" : '') . " href=\"" . $value['lurl'] . "\">" . $value['lname'] . ($is_second ? " <i class=\"fas fa-caret-down\"></i>" : '') . "</a>";
				if ($is_second) {
					if($value['ldisplay'] == 'mega'){
						$i = 0;
						$data_menu = array();
						foreach ($data_menu_main_1 as $key1 => $value1) {
							$data_menu_sub = array();
							$data_menu_sub[] = $value1;
							$i++;
							$data_menu_main_2 = modules::run('menu/gets', $main, $key1);

							if (is_array($data_menu_main_2) && !empty($data_menu_main_2)) {
								foreach ($data_menu_main_2 as $value2) {
									$data_menu_sub[] = $value2;
								}
							}
							$data_menu[$i] = $data_menu_sub;
						}

						if (isset($data_menu) && is_array($data_menu) && !empty($data_menu)) {
							$html_menu_main .= '<div class="wsmegamenu clearfix">
					                               <div class="container">
														<div class="row row-0px">
					                                        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12">
																<div class="row">';
																foreach ($data_menu as $data_mn) {
																	if (isset($data_mn) && is_array($data_mn) && !empty($data_mn)) {
																		$html_menu_main .= '<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 link-list">
																		<ul>';
																		$title = 0;
																		foreach ($data_mn as $menu) {
																			$title++;
																			if($title == 1){
																				$html_menu_main .='<h3 class="title"><a href="' . $menu['lurl'] . '">' . $menu['lname'] . '</a></h3>';
																			}
																			$html_menu_main .= '<li><a href="' . $menu['lurl'] . '">' . $menu['lname'] . '</a></li>';
																		}
																		$html_menu_main .= '</ul>
																		</div>';
																	}
																}
											$html_menu_main .= '</div>
														</div>
														<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
															<img src="'.(isset($value['limg'])?$value['limg']:'').'" alt="./images/banner_menu_1.jpg"
																class="img-fluid">
														</div>
													</div>
												</div>
											</div>';
						}
					} else {
						$html_menu_main .= '<ul class="sub-menu">';
						foreach ($data_menu_main_1 as $key1 => $value1) {
							$html_menu_main .= '<li><a href="' . $value1['lurl'] . '">' . $value1['lname'] . '</a></li>';
						}
						$html_menu_main .= '</ul>';
					}
				}
				$html_menu_main .= "</li>";
			}
		}
		$this->_data['html_menu_main'] = $html_menu_main;
	}

	function _load_menu($position = 'Main') {
		$data_menu = modules::run('menu/gets', $position, 0);
		$html_menu = '';
		if (is_array($data_menu) && !empty($data_menu)) {
			foreach ($data_menu as $key => $value) {
				$html_menu .= '<li><a href="' . $value['lurl'] . '">' . $value['lname'] . '</a></li>';
			}
		}
		return $html_menu;
	}

	function _init_fancybox() {
		$this->_plugins_css_admin[] = array(
			'folder' => 'fancy-box/source',
			'name' => 'jquery.fancybox',
		);
		$this->_plugins_script_admin[] = array(
			'folder' => 'fancy-box/source',
			'name' => 'jquery.fancybox',
		);
		$this->_plugins_script_admin[] = array(
			'folder' => 'fancy-box/source',
			'name' => 'jquery.fancybox.pack',
		);
		$this->_plugins_script_admin[] = array(
			'folder' => 'fancy-box/lib',
			'name' => 'jquery.mousewheel-3.0.6.pack',
		);
		$this->_plugins_script_admin[] = array(
			'folder' => 'fancy-box',
			'name' => 'jquery-apps',
		);
		$this->set_plugins_admin();
	}

	function index_admin() {
		$this->load->module('users');
		$this->users->admin_index();
	}

	protected function set_breadcrumbs() {
		$this->_data['breadcrumbs'] = $this->_breadcrumbs;
	}

	protected function set_breadcrumbs_admin() {
		$this->_data['breadcrumbs_admin'] = $this->_breadcrumbs_admin;
	}

	protected function set_plugins() {
		$this->_data['plugins_css'] = $this->_plugins_css;
		$this->_data['plugins_script'] = $this->_plugins_script;
	}

	protected function set_plugins_admin() {
		$this->_data['plugins_css_admin'] = $this->_plugins_css_admin;
		$this->_data['plugins_script_admin'] = $this->_plugins_script_admin;
	}

	protected function set_modules() {
		$this->_data['modules_css'] = $this->_modules_css;
		$this->_data['modules_script'] = $this->_modules_script;
	}

	protected function add_css() {
		$this->_data['add_css'] = $this->_add_css;
	}

	protected function add_js() {
		$this->_data['add_js'] = $this->_add_js;
	}

	protected function get_configs() {
		$configs = $this->M_configs->get_configs();
		return $this->set_configs($configs);
	}

	private function set_configs($data) {
		$configs = array();
		if (is_array($data) && !empty($data)) {
			foreach ($data as $value) {
				$configs[$value['config_name']] = $value['config_value'];
			}
		}
		return $configs;
	}

	function index() {
		$this->_initialize();

		// Lấy tất cả sản phẩm (không lọc khuyến mãi)
		$promo_products = modules::run('shops/rows/gets', array('status' => 1), 8, 0);
		$this->_data['promo_products'] = $promo_products;

		// Lấy sản phẩm bán chạy
		$top_products = modules::run('shops/rows/gets_item_field', 'is_featured', 8);
		$this->_data['top_products'] = $top_products;

		// Lấy sản phẩm đồ trang trí (lấy tất cả sản phẩm có status = 1)
		$decor_products = modules::run('shops/rows/gets', array('status' => 1), 8, 0);
		$this->_data['decor_products'] = $decor_products;

		// Lấy sản phẩm khuyến mãi cho product_sales (is_promotion = 1)
		$product_sales = modules::run('shops/rows/gets_item_field', 'is_promotion', 8);
		$this->_data['product_sales'] = $product_sales;

		// Set title và meta
		$this->_data['title'] = 'BearFur - Nội thất cao cấp hàng đầu Việt Nam';
		$this->_data['description'] = 'Chuyên cung cấp đồ nội thất cao cấp, đèn trang trí và thiết bị vệ sinh chất lượng cao.';
		$this->_data['keywords'] = 'nội thất, đèn trang trí, thiết bị vệ sinh, đồ trang trí, BearFur';

		// Load trang chủ BearFur
		$this->_data['content'] = $this->load->view('layout/site/home_bearfur', $this->_data, true);
		$this->load->view('layout/site/layout_bearfur', $this->_data);
	}

	// Method test BearFur layout
	function test_bearfur() {
		$this->_initialize();

		// Lấy sản phẩm khuyến mãi
		$promo_products = modules::run('shops/rows/gets_item_field', 'is_promo', 8);
		$this->_data['promo_products'] = $promo_products;

		// Lấy sản phẩm bán chạy
		$top_products = modules::run('shops/rows/gets_item_field', 'is_featured', 8);
		$this->_data['top_products'] = $top_products;

		// Lấy sản phẩm đồ trang trí (lấy tất cả sản phẩm có status = 1)
		$decor_products = modules::run('shops/rows/gets', array('status' => 1), 8, 0);
		$this->_data['decor_products'] = $decor_products;

		// Lấy sản phẩm khuyến mãi cho product_sales
		$product_sales = modules::run('shops/rows/gets_item_field', 'is_promotion', 8);
		$this->_data['product_sales'] = $product_sales;

		// Set title và meta
		$this->_data['title'] = 'BearFur - Nội thất cao cấp hàng đầu Việt Nam';
		$this->_data['description'] = 'Chuyên cung cấp đồ nội thất cao cấp, đèn trang trí và thiết bị vệ sinh chất lượng cao.';
		$this->_data['keywords'] = 'nội thất, đèn trang trí, thiết bị vệ sinh, đồ trang trí, BearFur';

		// Load trang chủ BearFur
		$this->_data['content'] = $this->load->view('layout/site/home_bearfur', $this->_data, true);
		$this->load->view('layout/site/layout_bearfur', $this->_data);
	}

	protected function logged_in() {
		if ($this->session->userdata('logged_in')) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	protected function redirect_register() {
		if (!$this->logged_in()) {
			redirect(site_url('register'));
		}
	}

	protected function redirect_login() {
		if (!$this->logged_in()) {
			redirect(site_url('login'));
		}
	}

	protected function redirect_admin() {
		if (!$this->session->userdata('logged_in')) {
            redirect(get_admin_url() . '?redirect_page=' . base64_encode(current_full_url()));
        } else {
            $access_role = $this->access_role();
            if ($access_role < 4) {
                redirect(base_url());
            }
        }
	}

	protected function access_role() {
		$this->load->model('users/m_groups_users', 'M_groups_users');
		$userid = isset($this->_data['userid']) ? $this->_data['userid'] : 0;
		$result = $this->M_groups_users->get_group_id($userid);
		return isset($result['group_id']) ? (int) $result['group_id'] : 2;
	}

	protected function set_notify($notify_type, $notify_content) {
		//set notify
		$sess_array = array(
			'notify_type' => $notify_type,
			'notify_content' => $notify_content,
		);
		$this->session->set_userdata('notify_current', $sess_array);
	}

	protected function set_notify_admin($notify_type, $notify_content) {
		//set notify
		$sess_array = array(
			'notify_type' => $notify_type,
			'notify_content' => $notify_content,
		);
		$this->session->set_userdata('notify_current_admin', $sess_array);
	}

	protected function set_message_success() {
		$sess_array = array(
			'notify_type' => 'success',
			'notify_content' => $this->_message_success,
		);
		$this->session->set_userdata('notify_current_admin', $sess_array);
	}

	protected function set_message_warning() {
		$sess_array = array(
			'notify_type' => 'warning',
			'notify_content' => $this->_message_warning,
		);
		$this->session->set_userdata('notify_current_admin', $sess_array);
	}

	protected function set_message_danger() {
		$sess_array = array(
			'notify_type' => 'danger',
			'notify_content' => $this->_message_danger,
		);
		$this->session->set_userdata('notify_current_admin', $sess_array);
	}

	protected function set_message_banned() {
		$sess_array = array(
			'notify_type' => 'danger',
			'notify_content' => $this->_message_banned,
		);
		$this->session->set_userdata('notify_current_admin', $sess_array);
	}

	protected function set_json_encode() {
		$this->_data['json_encode'] = array(
			'status' => $this->_status,
			'message' => $this->_message,
		);
	}

	function get_alias() {
		$str = $this->input->post('title');
		$this->_data['str'] = $str;
		$this->load->view('layout/admin/view_alias', $this->_data);
	}

	protected function show_message() {
		$this->_data['box'] = array(
			'status' => $this->input->post('status'),
			'message' => $this->input->post('message'),
		);
		$this->load->view('layout/message', $this->_data);
	}

	function load_language() {
		$this->lang->load('admin', $this->language);
		$this->lang->load('site', $this->language);
	}

	function set_current_url($url) {
		$this->session->set_userdata('url', base64_encode($url));
	}

	function redirect_after() {
		if ($this->session->userdata('url')) {
			$url = base64_decode($this->session->userdata('url'));
			$this->session->unset_userdata('url');
		} else {
			$url = base_url();
		}
		redirect($url);
	}
function db_backup() {
		//date_default_timezone_set('Asia/Calcutta');
		// Load the DB utility class
		$this->load->dbutil();
		$prefs = array('format' => 'zip', // gzip, zip, txt
			'filename' => 'backup_' . date('d_m_Y_H_i_s') . '.sql',
			// File name - NEEDED ONLY WITH ZIP FILES
			'add_drop' => TRUE,
			// Whether to add DROP TABLE statements to backup file
			'add_insert' => TRUE,
			// Whether to add INSERT data to backup file
			'newline' => "\n",
			// Newline character used in backup file
		);
		// Backup your entire database and assign it to a variable
		$backup = &$this->dbutil->backup($prefs);
		// Load the file helper and write the file to your server
		$this->load->helper('file');
		write_file('./uploads/' . 'dbbackup_' . date('d_m_Y_H_i_s') . '.zip', $backup);
		// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		force_download('dbbackup_' . date('d_m_Y_H_i_s') . '.zip', $backup);
	}

	// Method để cập nhật sản phẩm thành khuyến mãi
	function update_promo_products() {
		// Cập nhật sản phẩm ID 1, 2, 3, 4 thành khuyến mãi
		$this->db->where_in('id', array(1, 2, 3, 4));
		$this->db->update('shops', array(
			'is_promo' => 1,
			'product_sales_price' => 1000000, // Giá khuyến mãi 1 triệu
			'product_discount_percent' => 20
		));

		echo "Đã cập nhật sản phẩm thành khuyến mãi!";
	}

			/**
	 * Trang tất cả sản phẩm - lấy toàn bộ sản phẩm từ database
	 */
	public function product() {
		$this->_initialize();
		// Lấy tất cả sản phẩm có status = 1
		$all_products = modules::run('shops/rows/gets', array('status' => 1), 1000, 0);
		$this->_data['all_products'] = $all_products;
		$this->_data['title'] = 'Tất cả sản phẩm';
		$this->_data['description'] = 'Danh sách tất cả sản phẩm';
		$this->_data['keywords'] = 'sản phẩm, nội thất, BearFur';

		// Thêm CSS và JS cho trang product
		$this->_data['add_css'] = array(
			'assets/css/product/product.css',
			'assets/vendor/bootstrap-icons/bootstrap-icons.css'
		);
		$this->_data['add_js'] = array(
			'assets/js/product/product.js',
			'assets/js/product/listproduct.js'
		);

		// Load nội dung trang sản phẩm vào biến content
		$this->_data['content'] = $this->load->view('layout/site/pages/product', $this->_data, true);

		// Load layout BearFur với header và footer
		$this->load->view('layout/site/layout_bearfur', $this->_data);
	}

		/**
	 * Trang hệ thống cửa hàng
	 */
	public function system() {
		$this->_initialize();
		$this->_data['title'] = 'Hệ thống cửa hàng';
		$this->_data['description'] = 'Hệ thống cửa hàng BearFur';
		$this->_data['keywords'] = 'hệ thống, cửa hàng, BearFur';

		// Thêm CSS và JS cho trang system
		$this->_data['add_css'] = array(
			'assets/css/system/index.css'
		);
		$this->_data['add_js'] = array(
			'assets/js/system/system.js'
		);

		// Load nội dung trang hệ thống vào biến content
		$this->_data['content'] = $this->load->view('layout/site/pages/system', $this->_data, true);

		// Load layout BearFur với header và footer
		$this->load->view('layout/site/layout_bearfur', $this->_data);
	}
}
/* End of file Layout.php */
/* Location: ./application/modules/layout/controllers/Layout.php */
