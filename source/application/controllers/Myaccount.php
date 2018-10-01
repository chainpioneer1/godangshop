<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Myaccount extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model("roles_m");
		$this->load->model("users_m");
		$this->load->model("customers_m");
		$this->load->model("products_m");
		$this->load->model("categories_m");
		$this->load->model("contactus_m");
		$this->load->model("orders_m");
		$this->load->library("pagination");
		$this->load->helper('security');
		$this->load->library('form_validation');
		$this->load->library("session");
		$language = $this->session->userdata('lang');
		$this->lang->load('myaccount', $language);
		$this->lang->load('base', $language);

	}


	public function index(){
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		$this->data['products_primary_categories'] = $this->categories_m->get_categories(array('parent_id'=>0));
		$this->data['primary_categories_cnt']= $this->categories_m->get_categories_cnt(array('parent_id'=>0));
		$this->data['page_banner_title'] = $this->lang->line('my_account');
		$usertype = $this->session->userdata("user_type");
		if( $usertype != 2 && $usertype != 3 ){
			session_destroy();
			$this->data["subview"] = "signin/login";
			$this->load->view('_layout_main', $this->data);
		}
		$user_id = $this->session->userdata('loginuserID');
		$user_data = $this->users_m->get_user($user_id);
		$this->data['controller'] = $this;
		$this->data['user_data'] = $user_data;
		if ($usertype == 3) {
			$sql = array();
			$sql['user_id']= $user_id;
			$customer_id = $this->customers_m->get_customerid_byuser_id($user_id);
			$customer_id = intval($customer_id);
			$custom_data = $this->customers_m->get_customer($customer_id);

			// get orders by custom id
			$orders_data = $this->orders_m->get_ordersbyuser_id($user_id);

			$this->data['controller'] = $this;
			$this->data['customer_data'] = $custom_data;
			$this->data['orders_data'] = $orders_data;
			$this->data["subview"] = "myaccount/myorders";
			$this->load->view('_layout_customer', $this->data);
			$this->data['controller'] = $this;
			$this->data['customer_data'] = $custom_data;
			$this->data['orders_data'] = $orders_data;
			$this->data["subview"] = "myaccount/myorders";
			$this->load->view('_layout_customer', $this->data);
			$this->load->view('_layout_customer', $this->data);
		} elseif ($usertype == 2) {
			$this->data["subview"] = "sellers/index";
			$this->load->view('_layout_sellers', $this->data);
		}
	}



	public function groupbuying(){
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		$this->data['page_banner_title'] = $this->lang->line('my_group_buying');
		$usertype = $this->session->userdata("user_type");
		if ($usertype != 3) {
			$this->data["subview"] = "products/index";
			$this->load->view('_layout_main', $this->data);
		}
		$custom_data = $this->customers_m->get_where();
		$this->data['custom_data'] = $custom_data;
		$this->data["subview"] = "myaccount/groupbuying";
		$this->load->view('_layout_customer', $this->data);
	}


	public function accountdetail(){
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		$this->data['products_primary_categories'] = $this->categories_m->get_categories(array('parent_id'=>0));
		$this->data['primary_categories_cnt']= $this->categories_m->get_categories_cnt(array('parent_id'=>0));
		$this->data['page_banner_title'] = $this->lang->line('my_account_detail');
		$usertype = $this->session->userdata("user_type");
		if ($usertype != 3) {
			$this->data["subview"] = "products/index";
			$this->load->view('_layout_main', $this->data);
		}
		$user_id = $this->session->userdata('loginuserID');
		$sql = array();
		$sql['user_id']= $user_id;
		$customer_id = $this->customers_m->get_single_customer($sql)->customer_id;
		$custom_data = $this->customers_m->get_customer($customer_id);
		$user_data = $this->users_m->get_user($user_id);
		$this->data['controller'] = $this;
		$this->data['customer_data'] = $custom_data;
		$this->data['user_data'] = $user_data;
		$this->data["subview"] = "myaccount/accountdetail";
		$this->load->view('_layout_customer', $this->data);
	}




    // itbh comment : about order

	public function orders(){
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		$this->data['page_banner_title'] = $this->lang->line('my_orders');
		$usertype = $this->session->userdata("user_type");
		if ($usertype != 3) {
			redirect(base_url('site/index'));
		}
		$user_id = $this->session->userdata('loginuserID');
		$sql = array();
		$sql['user_id']= $user_id;
		$customer_id = $this->customers_m->get_customerid_byuser_id($user_id);
		$customer_id = intval($customer_id);
		$custom_data = $this->customers_m->get_customer($customer_id);
		// get orders by custom id
		$orders_data = $this->orders_m->get_ordersbyuser_id($user_id);

		$this->data['controller'] = $this;
		$this->data['customer_data'] = $custom_data;
		$this->data['orders_data'] = $orders_data;
		$this->data["subview"] = "myaccount/myorders";
		$this->load->view('_layout_customer', $this->data);
	}

	public function view_order($order_id){
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		$this->data['page_banner_title'] = $this->lang->line('order_detail');
		$usertype = $this->session->userdata("user_type");
		if ($usertype != 3) {
			$this->data["subview"] = "products/index";
			$this->load->view('_layout_main', $this->data);
		}
		$order_data = $this->orders_m->get_order($order_id);
		$products_data = json_decode($order_data->products);
		$order_products = array();
		if(!empty($products_data)){
			foreach($products_data as $product_data){
				$product_id = $product_data->product_id;
				$product_qty = $product_data->product_qty;
				$product_subtotal = $product_data->product_subtotal;
				$warehouse_id = $product_data->warehouse_id;
				$sql = array();
				$temp = array();
				$temp['product_qty'] = $product_qty;
				$temp['product_subtotal'] = $product_subtotal;
				$temp['warehouse_id'] = $warehouse_id;
				$sql['product_id'] = $product_id;
				/***
				$product = $this->products_m->get_single_product(array('product_id'=>$product_id));
				if($product){
					$temp['product_name'] = $product->product_name;
				} else $temp['product_name'] =$this->lang->line('not_found');
				*****/
				$temp['product_name'] = $product_data->product_name;


				array_push($order_products , $temp );
			}
		}

		$this->data['controller'] = $this;
		$this->data['order_data'] = $order_data;
		$this->data['order_products'] = $order_products;
		$this->data["subview"] = "myaccount/orderdetail";
		$this->load->view('_layout_customer', $this->data);
	}

	public function edit_order( $order_id ){
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		$this->data['products_primary_categories'] = $this->categories_m->get_categories(array('parent_id'=>0));
		$this->data['primary_categories_cnt']= $this->categories_m->get_categories_cnt(array('parent_id'=>0));
		$this->data['page_banner_title'] = $this->lang->line('edit_order');
		$usertype = $this->session->userdata("user_type");

		if( $usertype != 3 ){
			redirect( base_url('products/index') );
		}

		$this->data['orders'] = $this->orders_m->get_order();
		$this->data['order'] = $this->orders_m->get_order( $order_id);
	}

	public function delete_order( $order_id ){
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		$this->data['products_primary_categories'] = $this->categories_m->get_categories(array('parent_id'=>0));
		$this->data['primary_categories_cnt']= $this->categories_m->get_categories_cnt(array('parent_id'=>0));
		$this->data['page_banner_title'] = $this->lang->line('delete_order');
		$usertype = $this->session->userdata("user_type");

		if( $usertype != 3 ){
			redirect( base_url('products/index') );
		}

		$this->orders_m->delete_order($order_id);
		$this->session->set_flashdata('success', $this->lang->line('delete_order_successfully'));
		redirect(base_url("myaccount/orders"));
	}


	public function print_orders( $orders){
		$usertype = $this->session->userdata("user_type");
		if ($usertype != 3) {
			$this->data["subview"] = "products/index";
			$this->load->view('_layout_main', $this->data);
		}
		$output = '';
		if(!empty($orders)) {
			foreach ($orders as $order) {
				$desc = '';
				if (strlen($order->notes) > 30) {
					$desc = substr($order->notes, 30) . '...';
				} else {
					$desc = $order->notes;
				}
				ob_start()
				?>
				<tr class="odd gradeX">

					<td><?= $order->order_id ?></td>
					<td><?= $order->registered_date ?></td>
					<td><?= $order->total ?></td>
					<td><?= $order->order_status ?></td>
					<td>
						<a style="margin: 0 15px;"
						   href="<?= base_url('myaccount/view_order/' . $order->order_id) ?>"><?= $this->lang->line('view') ?></a>
						<!-- paipai -->
						<a style="margin: 0 15px;"
						   href="<?= base_url('myaccount/delete_order/' . $order->order_id) ?>"><?= $this->lang->line('delete') ?></a>

					</td>
				</tr>
				<?php
			}
		} else {
			$output = '<tr><td><h1 style="color: #ff5f2a;text-align: center; ">'.$this->lang->line('there_is_no_result').'</h1></td></tr>';
		}

		return $output;


	}


	//	itbh comment : this is for address tab ////


	public function address(){
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		$this->data['products_primary_categories'] = $this->categories_m->get_categories(array('parent_id'=>0));
		$this->data['primary_categories_cnt']= $this->categories_m->get_categories_cnt(array('parent_id'=>0));
		$this->data['page_banner_title'] = $this->lang->line('my_address');
		$usertype = $this->session->userdata("user_type");
		if ($usertype != 3) {
			$this->data["subview"] = "products/index";
			$this->load->view('_layout_main', $this->data);
		}
		$user_id = $this->session->userdata('loginuserID');
		$sql = array();
		$sql['user_id']= $user_id;
		$customer_id = $this->customers_m->get_single_customer($sql)->customer_id;
		$custom_data = $this->customers_m->get_customer($customer_id);
		// get orders by custom id
		$this->data['controller'] = $this;
		$this->data['customer_data'] = $custom_data;
		$this->data["subview"] = "myaccount/address";
		$this->load->view('_layout_customer', $this->data);
	}


	public function edit_billing_address( ){
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		$this->data['products_primary_categories'] = $this->categories_m->get_categories(array('parent_id'=>0));
		$this->data['primary_categories_cnt']= $this->categories_m->get_categories_cnt(array('parent_id'=>0));
		$this->data['page_banner_title'] = $this->lang->line('billing_address');;
		$usertype = $this->session->userdata("user_type");
		if ($usertype != 3) {
			$this->data["subview"] = "products/index";
			$this->load->view('_layout_main', $this->data);
		}
		$user_id = $this->session->userdata('loginuserID');
		$sql = array();
		$sql['user_id']= $user_id;
		$customer_id = $this->customers_m->get_single_customer($sql)->customer_id;
		$this->data['customer_data'] = $this->customers_m->get_customer($customer_id);
		if ($_POST) {
			$rules = $this->rules();
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('success', $this->lang->line('input_information_correctly'));
				$this->data["subview"] = "myaccount/address";
				$this->load->view('_layout_customer', $this->data);
			} else {

				// insert
				$array = array();
				$array["bill_first_name"] = $this->input->post("first_name");
				$array["bill_last_name"] = $this->input->post("last_name");
				$array["bill_company_name"] = $this->input->post("company_name");
				$array["bill_country"] = $this->input->post("country");
				$array["bill_address1"] = $this->input->post("address1");
				$array["bill_address2"] = $this->input->post("address2");
				$array["bill_town"] = $this->input->post("town_city");
				$array["bill_state"] = $this->input->post("state_country");
				$array["bill_postcode"] = $this->input->post("postcode_zip");
				$array["bill_email"] = $this->input->post("email");
				$array["bill_phone1"] = $this->input->post("phone1");
				$array["bill_phone2"] = $this->input->post("phone2");
				$array["bill_phone3"] = $this->input->post("phone3");
				$array["bill_fax"] = $this->input->post("fax");
				$array["bill_line"] = $this->input->post("line_id");

				$this->customers_m->update_customer( $array, $customer_id );

				$this->session->set_flashdata('success', $this->lang->line('update_customer_successfully'));
				redirect(base_url("myaccount/address/"));
			}
		} else {
			$this->data["subview"] = "myaccount/address";
			$this->load->view('_layout_customer', $this->data);
		}
	}


	public function edit_shipping_address( ){
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		$this->data['products_primary_categories'] = $this->categories_m->get_categories(array('parent_id'=>0));
		$this->data['primary_categories_cnt']= $this->categories_m->get_categories_cnt(array('parent_id'=>0));
		$this->data['page_banner_title'] = $this->lang->line('shipping_address');
		$usertype = $this->session->userdata("user_type");
		if ($usertype != 3) {
			$this->data["subview"] = "products/index";
			$this->load->view('_layout_main', $this->data);
		}
		$user_id = $this->session->userdata('loginuserID');
		$sql = array();
		$sql['user_id']= $user_id;
		$customer_id = $this->customers_m->get_single_customer($sql)->customer_id;
		$this->data['customer_data'] = $this->customers_m->get_customer($customer_id);
		if ($_POST) {
			$rules = $this->rules();
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('success', $this->lang->line('input_information_correctly'));
				$this->data["subview"] = "myaccount/address";
				$this->load->view('_layout_customer', $this->data);
			} else {

				// insert
				$array = array();
				$array["shipping_first_name"] = $this->input->post("first_name");
				$array["shipping_last_name"] = $this->input->post("last_name");
				$array["shipping_company_name"] = $this->input->post("company_name");
				$array["shipping_country"] = $this->input->post("country");
				$array["shipping_address1"] = $this->input->post("address1");
				$array["shipping_address2"] = $this->input->post("address2");
				$array["shipping_town"] = $this->input->post("town_city");
				$array["shipping_state"] = $this->input->post("state_country");
				$array["shipping_postcode"] = $this->input->post("postcode_zip");
				$array["shipping_email"] = $this->input->post("email");
				$array["shipping_phone1"] = $this->input->post("phone1");
				$array["shipping_phone2"] = $this->input->post("phone2");
				$array["shipping_phone3"] = $this->input->post("phone3");
				$array["shipping_fax"] = $this->input->post("fax");
				$array["shipping_line"] = $this->input->post("line_id");

				$this->customers_m->update_customer( $array, $customer_id );
				$this->session->set_flashdata('success', $this->lang->line('update_customer_successfully'));
				redirect(base_url("myaccount/address/"));
			}
		} else {
			$this->data["subview"] = "myaccount/address";
			$this->load->view('_layout_customer', $this->data);
		}
	}

	public function update_account( ){
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		$this->data['products_primary_categories'] = $this->categories_m->get_categories(array('parent_id'=>0));
		$this->data['primary_categories_cnt']= $this->categories_m->get_categories_cnt(array('parent_id'=>0));
		$this->data['page_banner_title'] = $this->lang->line('update_account');
		$usertype = $this->session->userdata("user_type");
		if ($usertype != 3) {
			$this->data["subview"] = "products/index";
			$this->load->view('_layout_main', $this->data);
		}
		$user_id = $this->session->userdata('loginuserID');
		$sql = array();
		$sql['user_id']= $user_id;
		$customer_id = $this->customers_m->get_single_customer($sql)->customer_id;
		$this->data['user_data'] = $this->users_m->get_user($user_id);
		$this->data['customer_data'] = $this->customers_m->get_customer($customer_id);
		if ($_POST) {
			$rules = $this->account_rules();
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('success', $this->lang->line('input_information_correctly'));
				$this->data["subview"] = "myaccount/accountdetail";
				$this->load->view('_layout_customer', $this->data);
			} else {
				// insert
				$user_arr = array();
				$customer_arr = array();
				$customer_arr["customer_first_name"] = $this->input->post("first_name");
				$customer_arr["customer_last_name"] = $this->input->post("last_name");
				$customer_arr["email"] = $this->input->post("company_name");
				// compare password with current password
				$current_password = $this->data['user_data']->password;
				$current_password0 = $_POST['current_password'];
				$new_password0 = $_POST['new_password'];
				$confirm_password0 = $_POST['confirm_password'];
				if($confirm_password0 != $new_password0){
					$this->session->set_flashdata('success', $this->lang->line('password_not_matching'));
					redirect('admin/settings/index');
				} else {
					$current_password_post = $this->users_m->hash($current_password0);
					$new_password = $this->users_m->hash($new_password0);
					if ($current_password_post == $current_password){
						$arr = array();
						$arr['password'] = $new_password;
						$this->users_m->update_user( $arr, $user_id );
						$this->customers_m->update_customer( $customer_arr, $customer_id );
						$this->session->set_flashdata('success', $this->lang->line('update_customer_successfully'));
						redirect(base_url("myaccount/accountdetail/"));
					} else {
						$this->session->set_flashdata('success', $this->lang->line('please_input_information_correctly'));
						redirect('myaccount/accountdetail');
					}

				}

			}
		} else {
			$this->data["subview"] = "myaccount/address";
			$this->load->view('_layout_customer', $this->data);
		}
	}

	private function rules() {
		$rules = array(
			array(
				'field' => 'first_name',
				'label' => $this->lang->line("first_name"),
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),
			array(
				'field' => 'last_name',
				'label' => $this->lang->line("last_name"),
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),
			array(
				'field' => 'country',
				'label' => $this->lang->line("country"),
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),

			array(
				'field' => 'address1',
				'label' => $this->lang->line("address1"),
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),

			array(
				'field' => 'town_city',
				'label' => $this->lang->line("town_city"),
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),
			array(
				'field' => 'state_country',
				'label' => $this->lang->line("state_country"),
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),

			array(
				'field' => 'postcode_zip',
				'label' => $this->lang->line("postcode_zip"),
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),

			array(
				'field' => 'email',
				'label' => $this->lang->line("email"),
				'rules' => 'valid_email|required|xss_clean|max_length[255]'
			),

			array(
				'field' => 'phone1',
				'label' => $this->lang->line("phone1"),
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),
			array(
				'field' => 'phone1',
				'label' => $this->lang->line("phone1"),
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),
			array(
				'field' => 'phone1',
				'label' => $this->lang->line("phone1"),
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),
			array(
				'field' => 'phone1',
				'label' => $this->lang->line("phone1"),
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),
		);
		return $rules;
	}

	private function account_rules() {
		$rules = array(
			array(
				'field' => 'first_name',
				'label' => $this->lang->line("first_name"),
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),
			array(
				'field' => 'last_name',
				'label' => $this->lang->line("last_name"),
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),
			array(
				'field' => 'email',
				'label' => $this->lang->line("email"),
				'rules' => 'valid_email|required|xss_clean|max_length[255]'
			),

			array(
				'field' => 'new_password',
				'label' => $this->lang->line("new_password"),
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),
		);
		return $rules;
	}

}


?>