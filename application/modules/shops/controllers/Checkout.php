<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
include_once APPPATH . '/modules/layout/controllers/Layout.php';

class Checkout extends Layout {

	function __construct() {
		parent::__construct();
		$this->_data['breadcrumbs_module_name'] = 'Giỏ hàng';
	}

	function site_index() {
		$this->_initialize();
		// modules::run('users/require_logged_in');
		$cart = $this->cart->contents();
		if (!$cart) {
			redirect(site_url('gio-hang'));
		}
		// $ref = $this->get_ref();
		// echo "<pre>";
		// print_r($ref);
		// print_r($cart);
		// echo "</pre>";
		// die;

		$user_id = 0;
        $user = NULL;
        $logged_in = FALSE;
        if(isset($this->_data['userid'])){
            $user_id = (int) $this->_data['userid'];
            $user = modules::run('users/get', $user_id);
            $logged_in = TRUE;
        }

		$post = $this->input->post();
		if (!empty($post)) {
			$order_total = $this->cart->total();
			$customer = $user;
            $customer_id = $user_id;
			$time = time();

			if($logged_in){
				$address_id = (int) $this->input->post('address_id');
				$address_args = array(
					'id' => $address_id,
					'user_id' => $user_id,
				);
				$row_address = modules::run('users/users_address/get', $address_args);
				if(!(is_array($row_address) && !empty($row_address))){
		        	$notify_type = 'danger';
		        	$notify_content = 'Địa chỉ không tồn tại!';
		        	$this->set_notify($notify_type, $notify_content);
		        	redirect(current_url());
	            }
	            $email = isset($customer['email']) ? $customer['email'] : '';
	        }else{
	        	$email = $this->input->post('email');
	        	$province_id = $this->input->post('province_id');
	        	$district_id = $this->input->post('district_id');
	        	$commune_id = $this->input->post('commune_id');

	        	$row_province = modules::run('provinces/provinces/get', $province_id);
	        	$row_district = modules::run('provinces/districts/get', $district_id);
	        	$row_commune = modules::run('provinces/communes/get', $commune_id);

	        	$cost = 0;
            	if(isset($row_district['cost']) && $row_district['cost'] > 0){
            		$cost = $row_district['cost'];
            	}elseif(isset($row_province['cost'])){
        			$cost = $row_province['cost'];
            	}

	        	$row_address = array(
	        		'province_id' => $province_id,
	        		'district_id' => $district_id,
	        		'commune_id' => $commune_id,
	        		'province_name' => isset($row_province['pNameVi']) ? $row_province['pNameVi'] : '',
	        		'district_name' => isset($row_district['dName']) ? $row_district['dName'] : '',
	        		'commune_name' => isset($row_commune['name']) ? $row_commune['name'] : '',
	        		'place_of_receipt' => $this->input->post('place_of_receipt'),
	        		'cost' => $cost,
	        		'full_name' => $this->input->post('address_full_name'),
	        		'phone' => $this->input->post('address_phone'),
	        	);
	        }

			$order_code = $this->get_max_code();
			if (!modules::run('shops/orders/check_order_code_availablity', $order_code)) {
				$order_code = $this->get_max_code();
			}

			$province = $row_address['province_id'];
			$district = $row_address['district_id'];
			$commune = $row_address['commune_id'];
			$no = $row_address['place_of_receipt'];
			$order_shipping = isset($row_address['cost']) ? $row_address['cost'] : 0;
			$address = get_full_address($row_address);
			//echo $order_shipping; die;
			
			$customer_full_name = $row_address['full_name'];
			$customer_phone = $row_address['phone'];
			$is_checkout_with_other_info = filter_var($this->input->post('is_checkout_with_other_info'), FILTER_VALIDATE_BOOLEAN);
			if($is_checkout_with_other_info){
				$customer_full_name = $this->input->post('full_name');
				$customer_phone = $this->input->post('phone');
			}

			$ref = $this->get_ref();
			$user_ref = null;
			if(trim($ref) != ''){
				$user_ref = $this->M_users->get_by(array('refer_key' => $ref));
			}
			$user_ref_id = isset($user_ref['userid']) ? (int) $user_ref['userid'] : 0;

			$order_args = array(
				'admin_id' => $customer_id,
				'user_ref_id' => $user_ref_id,
				'order_customer_id' => $customer_id,
				'order_code' => $order_code,
				'order_amount' => $order_total,
				'coupon_code' => NULL,
				'coupon' => 0,
				'order_monetized' => $order_total + $order_shipping,
				'customer_full_name' => $customer_full_name,
				'customer_phone' => $customer_phone,
				'order_full_name' => $row_address['full_name'],
				'order_email' => $email,
				'order_phone' => $row_address['phone'],
				'order_note' => $this->input->post('order_note'),
				'order_province' => $province,
				'order_district' => $district,
				'order_commune' => $commune,
				'order_no' => $no,
				'order_address' => $address,
				'order_shipping' => $order_shipping,
				'forms_of_payment' => $this->input->post('forms_of_payment'),
				'post_ip' => $this->input->ip_address(),
				'transaction_status' => 0,
				'viewed' => 0,
				'created' => $time,
				'modified' => 0,
			);
			// echo "<pre>";
			// print_r($order_args);
			// echo "</pre>";
			// die;
			$order_id = modules::run('shops/orders/site_add', $order_args); // thêm đơn hàng

			if ($order_id != 0) {
				if($customer_id != 0){
        			$users = modules::run('users/gets');
        			$data = get_data_parent_level($users, $customer_id);
        			$root = $data['root'];
        			$subs = $data['subs'];
        		}

				$history_container = array();
				$history_current = array();
				foreach ($cart as $item) {
					$product_id = $item['id'];
					$name = $item['name'];
					$price = $item['unit_price'];
					$promotion_price = $item['price'];
					$quantity = $item['qty'];
					$monetized = $item['subtotal'];

					$commission = 0;
					$commission_price = 0;
					/*
					if($this->cart->has_options($item['rowid'])){
						$product_options = $this->cart->product_options($item['rowid']);
						if(isset($product_options['user_id'])){
							$row_product = modules::run('shops/rows/get', $product_id);
							if(isset($row_product['commission']) && $row_product['commission'] != 0){
								$commission = (float) $row_product['commission'];
							}
							$commission_price = $monetized * $commission / 100;
						}
					}
					*/
					/*
					if($user_ref_id != 0){
						$row_product = modules::run('shops/rows/get', $product_id);
						if(isset($row_product['commission']) && $row_product['commission'] != 0){
							$commission = (float) $row_product['commission'];
							$commission_price = $monetized * $commission / 100;
						}
					}
					*/
					$row_product = modules::run('shops/rows/get', $product_id);
					if(isset($row_product['commission']) && $row_product['commission'] != 0){
						$commission = (float) $row_product['commission'];
						$commission_price = $monetized * $commission / 100;
					}
					
					$order_detail_args = array(
						'order_id' => $order_id,
						'name' => $name,
						'product_id' => $product_id,
						'price' => $price,
						'promotion_price' => $promotion_price,
						'quantity' => $quantity,
						'monetized' => $monetized,
						'commission' => $commission,
						'commission_price' => $commission_price,
						'user_id' => $user_ref_id,
					);
					$bool = modules::run('shops/order_details/site_add', $order_detail_args);
					if ($bool != 0 && $commission != 0) {
						$history = array();
						$extend_by = ($customer_id != 0) ? $customer_id : NULL;

						if($user_ref_id != 0){
		        			$payment = 'CREDIT_CARD';
		        			$action = 'SUB_BUY';
		        			$value_cost = $monetized;
		        			$percent = $commission;
		        			$value = $commission_price;
							$data_commission = array(
								'order_id' => $order_id,
								'product_id' => $product_id,
							    'user_id' => $user_ref_id,
							    'extend_by' => $extend_by,
							    'action' => $action,
								'payment' => $payment,
								'value_cost' => $value_cost,
								'percent' => $percent,
								'value' => $value,
							    'message' => 'Người dùng được hưởng hoa hồng khi khách hàng mua sản phẩm',
							    'status' => 0,
							    'created' => $time
							);
							modules::run('users/users_commission/add', $data_commission);
							$history[] = $data_commission;
							$history_container[] = $history;
						}

	        			if($customer_id != 0){
		        			if($root != 0){
		        				$payment = 'CREDIT_CARD';
		        				$action = 'SUB_BUY_REFERRED_ROOT';
		        				$value_cost = $commission_price;
		        				$percent = 10;
		        				$value = $value_cost * $percent / 100;
		        				$data_commission = array(
		        				    'order_id' => $order_id,
		        				    'product_id' => $product_id,
		        				    'user_id' => $root,
		        				    'extend_by' => $extend_by,
		        				    'action' => $action,
		        				    'payment' => $payment,
		        				    'value_cost' => $value_cost,
		        				    'percent' => $percent,
		        				    'value' => $value,
		        				    'message' => 'Người dùng được hưởng hoa hồng từ người dùng cấp dưới trực tiếp mua sản phẩm',
		        				    'status' => 0,
							    	'created' => $time
		        				);
		        				modules::run('users/users_commission/add', $data_commission);
		        				$history[] = $data_commission;
								$history_container[] = $history;
		        			}
		        			if(is_array($subs) && !empty($subs)){
		        				$count = 0;
		        				foreach ($subs as $sub) {
		        					$count++;
		        					if($count <= 1){
		        						$payment = 'CREDIT_CARD';
			        					$action = 'SUB_BUY_REFERRED';
			        					$value_cost = $commission_price;
				        				$percent = 5;
				        				$value = $value_cost * $percent / 100;
			        					$data_commission = array(
			        						'order_id' => $order_id,
			        						'product_id' => $product_id,
			        					    'user_id' => $sub,
			        					    'extend_by' => $extend_by,
			        					    'action' => $action,
			        					    'payment' => $payment,
			        					    'value_cost' => $value_cost,
			        					    'percent' => $percent,
			        					    'value' => $value,
			        					    'message' => 'Người dùng được hưởng hoa hồng từ người dùng cấp dưới mua sản phẩm',
			        					    'status' => 0,
							    			'created' => $time
			        					);
			        					modules::run('users/users_commission/add', $data_commission);
			        					$history[] = $data_commission;
										$history_container[] = $history;
			        				}else{
			        					break;
			        				}
		        				}
		        			}
		        		}
					}
				}
				$history_current[] = $history_container;
				$history_bool = $this->M_shops_orders->update($order_id, array('history' => serialize($history_current)));

				$site_name = $this->_data['site_name'];
				$subject = "Thông tin mua hàng - " . $this->_data['site_name'];

				$partial = array();
				$partial['order'] = $order_args;
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
				$partial['products'] = $products;
				$message = $this->load->view('layout/site/partial/html-template-order', $partial, true);

				//$message = modules::run('shops/orders/site_html_or_view', $order_id);
				$receiver_email = array($email, $this->_data['email'], 'lenhan10th@gmail.com');
				if(isset($user_ref['email'])){
					$receiver_email[] = $user_ref['email'];
				}
				$data_sendmail = array(
					'sender_email' => $this->_data['email'],
					'sender_name' => $site_name,
					'receiver_email' => $receiver_email,
					'subject' => $subject,
					'message' => $message,
				);
				modules::run('emails/send_mail', $data_sendmail); // gửi mail

				//unset session cart
				$this->cart->destroy();
				redirect(site_url('ket-qua-thanh-toan/' . $order_id));
			} else {
				$notify_type = 'danger';
				$notify_content = '<strong>Có lỗi xảy ra!</strong> Vui lòng thực hiện lại!';
				$this->set_notify($notify_type, $notify_content);
			}
		}
		$this->_data['provinces'] = modules::run('provinces/provinces/gets');

		$address_args = array();
		$address_args['user_id'] = $user_id;
		$order_by = array(
			'is_default' => 'DESC',
			'created' => 'ASC',
			'modified' => 'DESC',
		);
		$address_args['order_by'] = $order_by;
		$address = modules::run('users/users_address/gets', $address_args);

		$partial = array();
		$partial['data'] = $address;
		$this->_data['address_items'] = $this->load->view('layout/site/partial/address-checkout', $partial, true);

		$fee = 0;
		if(isset($address[0]['district_cost']) && $address[0]['district_cost'] > 0){
            $fee = $address[0]['district_cost'];
        }elseif(isset($address[0]['cost'])){
			$fee = $address[0]['cost'];
		}
		$this->_data['fee'] = $fee;

		$this->_breadcrumbs[] = array(
			'url' => site_url('thanh-toan'),
			'name' => 'Thanh toán',
		);
		$this->set_breadcrumbs();

		$this->_data['title_seo'] = 'Thanh toán' . ' - ' . $this->_data['title_seo'];
		$this->_data['main_content'] = 'layout/site/pages/checkout';
		$this->load->view('layout/site/layout', $this->_data);
	}

	function get_max_code() {
		return modules::run('shops/orders/get_max_code');
	}

}
/* End of file Checkout.php */
/* Location: ./application/modules/shops/controllers/Checkout.php */