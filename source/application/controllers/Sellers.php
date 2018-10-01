<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Sellers extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model("roles_m");
		$this->load->model("users_m");
		$this->load->model("sellers_m");
		$this->load->model("products_m");
		$this->load->model("categories_m");
		$this->load->model("contactus_m");
		$this->load->model("seller_orders_m");
		$this->load->model("customers_m");
		$this->load->model("reviews_m");
		$this->load->model("warehouses_m");
		$this->load->library("session");
		$language = $this->session->userdata('lang');
		$this->lang->load('products', $language);
		$this->lang->load('myaccount', $language);
		$this->lang->load('base', $language);
		$this->load->library("pagination");
		$this->load->helper('security');
		$this->load->library('form_validation');
	}
	private function account_rules() {
		$rules = array(

			array(
				'field' => 'email',
				'label' => $this->lang->line("email"),
				'rules' => 'valid_email|required|xss_clean|max_length[255]'
			),

			array(
				'field' => 'new_password',
				'label' => $this->lang->line("new_password"),
				'rules' => 'trim|required|xss_clean|max_length[255]|'
			),

			array(
				'field' => 'new_password',
				'label' => $this->lang->line("new_password"),
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),
			array(
				'field' => 'confirm_password',
				'label' => $this->lang->line("confirm_password"),
				'rules' => 'trim|xss_clean|matches[new_password]'
			),
		);
		return $rules;
	}

	private function warehouse_rules() {
		$rules = array(

			array(
				'field' => 'warehouse_name',
				'label' => $this->lang->line("company"),
				'rules' => 'required|xss_clean|max_length[255]'
			),
			array(
				'field' => 'warehouse_country',
				'label' => $this->lang->line("country"),
				'rules' => 'required|xss_clean|max_length[255]'
			),
			array(
				'field' => 'warehouse_address1',
				'label' => $this->lang->line("address"),
				'rules' => 'required|xss_clean|max_length[255]'
			),
			array(
				'field' => 'warehouse_town',
				'label' => $this->lang->line("town_city"),
				'rules' => 'required|xss_clean|max_length[255]'
			),
			array(
				'field' => 'warehouse_state',
				'label' => $this->lang->line("state_country"),
				'rules' => 'required|xss_clean|max_length[255]'
			),

			array(
				'field' => 'warehouse_email',
				'label' => $this->lang->line("email_address"),
				'rules' => 'valid_email|required|xss_clean|max_length[255]'
			),

			array(
				'field' => 'warehouse_phone1',
				'label' => $this->lang->line("phone1"),
				'rules' => 'required|xss_clean|max_length[255]'
			),

			array(
				'field' => 'warehouse_contact_first',
				'label' => $this->lang->line("first_name"),
				'rules' => 'required|xss_clean|max_length[255]'
			),
		);
		return $rules;
	}


	private function add_product_rules() {
		$rules = array(

			array(
				'field' => 'sku',
				'label' => $this->lang->line("sku"),
				'rules' => 'trim|required|xss_clean|max_length[255]|is_unique[products.sku]'
			),

			array(
				'field' => 'product_name',
				'label' => $this->lang->line("product_id"),
				'rules' => 'trim|required|xss_clean|max_length[255]|is_unique[products.product_name]'
			),
		);
		return $rules;
	}

	public function index(){
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		$this->data['page_banner_title'] = $this->lang->line('seller');
		$usertype = $this->session->userdata("user_type");
		if( $usertype != 2 ){
			redirect(base_url('signin/index'));
		} elseif ($usertype == 2) {
			$user_id = $this->session->userdata('loginuserID');
			$sql = array();
			$sql['user_id']= $user_id;
			$seller_id = $this->sellers_m->get_single_seller(array('user_id' =>$user_id))->seller_id;
			$warehouse_sql = array();
			$warehouse_sql['seller_id'] = $seller_id;
			$tt = $this->warehouses_m->get_single_warehouse($warehouse_sql);
			$this->data["warehouse"] = $tt;
			$sql_review = array();
			$yyy = $this->warehouses_m->get_single_warehouse($warehouse_sql);
			$seller_reviews_cnt = 0;
			$seller_reviews = array();
			if (!empty($yyy)){
				$sql_review['warehouse_id'] = $yyy->warehouse_id;
				$seller_reviews = $this->reviews_m->get_review($sql_review);
				if (!empty($this->reviews_m->get_reviews_cnt($sql_review))){
					$seller_reviews_cnt = $this->reviews_m->get_reviews_cnt($sql_review);
				}
			}
			$this->data["seller_reviews_cnt"] = $seller_reviews_cnt;
			$this->data["seller_reviews"] = $seller_reviews;
			// get seller data
			$products_primary_categories = $this->categories_m->get_categories(array('parent_id'=>0));
			$primary_categories_cnt= $this->categories_m->get_categories_cnt(array('parent_id'=>0));
			$this->data["products_primary_categories"] = $products_primary_categories;

			$this->data["seller_data"] = $this->sellers_m->get_seller($seller_id);
			$this->data["seller_id"] = $seller_id;
			$this->data["user_id"] = $user_id;
			$this->data["subview"] = "sellers/index";
			$this->load->view('_layout_sellers', $this->data);
		} else{
			$this->data["subview"] = "signin/login";
			$this->load->view('_layout_main', $this->data);
		}
	}

	private function edit_product_rules() {
		$rules = array(

			array(
				'field' => 'sku',
				'label' => $this->lang->line("sku"),
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),

			array(
				'field' => 'product_name_english',
				'label' => $this->lang->line("product_name_english"),
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),
			array(
				'field' => 'product_name_thai',
				'label' => $this->lang->line("product_name_thai"),
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),
		);
		return $rules;
	}



	public function my_warehouse(){
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		$this->data['page_banner_title'] = $this->lang->line('my_warehouse');;
		$usertype = $this->session->userdata("user_type");
		if( $usertype != 2 ){
			redirect(base_url('signin/index'));
		}
		$user_id = $this->session->userdata('loginuserID');
		$seller_id = $this->sellers_m->get_seller_idbyuser_id($user_id);
		$warehouse_sql = array();
		$warehouse_sql['seller_id'] = $seller_id;
		$seller_warehouse = $this->warehouses_m->get_single_warehouse($warehouse_sql);
		$this->data["my_warehouse"] = $seller_warehouse;

		// get category names
		$categories = $this->categories_m->get_categories();
		$products_info = array();
		foreach($categories as $category){
			if (($this->session->userdata('lang')) == '' ){
				$lang_tmp = 'english';
			} else {
				$lang_tmp = $this->session->userdata('lang');
			}
			$tmp1 = 'name_'.$lang_tmp;
			$tmp2 = 'product_name_'.$lang_tmp;
			$category_id = $category->cat_id;
			$sql_product = array();
			$sql_product['category_id'] = $category_id;
			$products_bycategory_id_cnt = $this->products_m->get_products_cnt($sql_product);
			$tmp = array();
			$tmp['category_name'] = $category->$tmp1;
			$tmp['category_id'] = $category_id;
			$tmp['category_info'] = $category;
			$tmp['products_cnt'] = $products_bycategory_id_cnt;

			array_push($products_info , $tmp);

		}
		$this->data["products_info"] = $products_info;
		$this->data["subview"] = "sellers/my_warehouse";
		$this->load->view('_layout_sellers', $this->data);
	}

	public function edit_warehouse(){
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		$this->data['page_banner_title'] = $this->lang->line('edit_warehouse');
		$usertype = $this->session->userdata("user_type");
		if( $usertype != 2 ){
			redirect(base_url('signin/index'));
		}
		$user_id = $this->session->userdata('loginuserID');
		$seller_id = $this->sellers_m->get_seller_idbyuser_id($user_id);
		$warehouse_sql = array();
		$warehouse_sql['seller_id'] = $seller_id;
		$this->data['my_warehouse'] = $this->warehouses_m->get_single_warehouse($warehouse_sql);

		if ($_POST) {
			$rules = $this->warehouse_rules();
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('success', $this->lang->line('input_information_correctly'));
				$this->data["subview"] = "sellers/edit_warehouse";
				$this->load->view('_layout_sellers', $this->data);
			} else {

				// insert
				$array = array();
				$array["warehouse_name"] = $this->input->post("warehouse_name");

				$config_logo['upload_path']="./uploads/warehouse_logo/";
				$config_logo['allowed_types']='bmp|gif|jpg|png';
				$this->load->library('upload',$config_logo);
				if(isset($_FILES["warehouse_logo"]["name"])){
					if($this->upload->do_upload('warehouse_logo'))
					{
						$data = $this->upload->data();
						$array["warehouse_logo"] = $data["file_name"];
					}
				}

				$array["warehouse_slogan"] = $this->input->post("warehouse_slogan");

				$array["warehouse_description"] = $this->input->post("warehouse_description");
				$array["warehouse_country"] = $this->input->post("warehouse_country");
				$array["warehouse_address1"] = $this->input->post("warehouse_address1");

				$array["warehouse_address2"] = $this->input->post("warehouse_address2");
				$array["warehouse_town"] = $this->input->post("warehouse_town");
				$array["warehouse_state"] = $this->input->post("warehouse_state");

				$array["warehouse_email"] = $this->input->post("warehouse_email");
				$array["warehouse_phone1"] = $this->input->post("warehouse_phone1");
				$array["warehouse_phone2"] = $this->input->post("warehouse_phone2");

				$array["warehouse_fax"] = $this->input->post("warehouse_fax");
				$array["warehouse_map_x"] = $this->input->post("warehouse_map_x");
				$array["warehouse_map_y"] = $this->input->post("warehouse_map_y");
				$array["warehouse_line"] = $this->input->post("warehouse_line");

				$array["warehouse_facebook"] = $this->input->post("warehouse_facebook");
				$array["warehouse_google"] = $this->input->post("warehouse_google");
				$array["warehouse_twitter"] = $this->input->post("warehouse_twitter");

				$array["warehouse_ig"] = $this->input->post("warehouse_ig");
				$array["warehouse_contact_first"] = $this->input->post("warehouse_contact_first");
				$array["warehouse_contact_last"] = $this->input->post("warehouse_contact_last");
				$payment_methods_content = $_POST['payment_methods_content'];
				if (!empty($payment_methods_content)){
					$payments_cnt = count($payment_methods_content);
					$payments_content = array();
					for($i = 0; $i < $payments_cnt; $i++ ) {
						$payment_tmp = array('payment_method' => $payment_methods_content[$i]);
						array_push($payments_content , $payment_tmp);
					}
					$array["payment_methods"] = json_encode($payments_content);
				}

				$array["registered_date"] = date('Y-m-d');
				$warehouse_id = $this->input->post("warehouse_id");
				$this->warehouses_m->update_warehouse( $array, $warehouse_id);

				$this->session->set_flashdata('success', $this->lang->line('update_warehouse_successfully'));
				redirect(base_url("sellers/edit_warehouse/"));
			}
		} else {

			$this->data["subview"] = "sellers/edit_warehouse";
			$this->load->view('_layout_sellers', $this->data);
		}
	}

	public function add_warehouse(){
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		$this->data['page_banner_title'] = $this->lang->line('add_warehouse');
		$usertype = $this->session->userdata("user_type");
		if( $usertype != 2 ){
			redirect(base_url('signin/index'));
		}
		$user_id = $this->session->userdata('loginuserID');
		$seller_id = $this->sellers_m->get_seller_idbyuser_id($user_id);
		$warehouse_sql = array();
		$warehouse_sql['seller_id'] = $seller_id;
		$this->data['my_warehouse'] = $this->warehouses_m->get_single_warehouse($warehouse_sql);

		if ($_POST) {
			$rules = $this->warehouse_rules();
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('success', $this->lang->line('input_information_correctly'));
				$this->data["subview"] = "sellers/edit_warehouse";
				$this->load->view('_layout_sellers', $this->data);
			} else {

				// insert
				$array = array();
				$array["seller_id"] = $seller_id;
				$array["warehouse_name"] = $this->input->post("warehouse_name");


				$config_logo['upload_path']="./uploads/warehouse_logo/";
				$config_logo['allowed_types']='bmp|gif|jpg|png';
				$this->load->library('upload',$config_logo);
				if(isset($_FILES["warehouse_logo"]["name"])){
					if($this->upload->do_upload('warehouse_logo'))
					{
						$data = $this->upload->data();
						$array["warehouse_logo"] = $data["file_name"];
					}
				}

				$array["warehouse_slogan"] = $this->input->post("warehouse_slogan");

				$array["warehouse_description"] = $this->input->post("warehouse_description");
				$array["warehouse_country"] = $this->input->post("warehouse_country");
				$array["warehouse_address1"] = $this->input->post("warehouse_address1");

				$array["warehouse_address2"] = $this->input->post("warehouse_address2");
				$array["warehouse_town"] = $this->input->post("warehouse_town");
				$array["warehouse_state"] = $this->input->post("warehouse_state");

				$array["warehouse_email"] = $this->input->post("warehouse_email");
				$array["warehouse_phone1"] = $this->input->post("warehouse_phone1");
				$array["warehouse_phone2"] = $this->input->post("warehouse_phone2");

				$array["warehouse_fax"] = $this->input->post("warehouse_fax");
				$array["warehouse_map_x"] = $this->input->post("warehouse_map_x");
				$array["warehouse_map_y"] = $this->input->post("warehouse_map_y");
				$array["warehouse_line"] = $this->input->post("warehouse_line");

				$array["warehouse_facebook"] = $this->input->post("warehouse_facebook");
				$array["warehouse_google"] = $this->input->post("warehouse_google");
				$array["warehouse_twitter"] = $this->input->post("warehouse_twitter");

				$array["warehouse_ig"] = $this->input->post("warehouse_ig");
				$array["warehouse_contact_first"] = $this->input->post("warehouse_contact_first");
				$array["warehouse_contact_last"] = $this->input->post("warehouse_contact_last");

				$array["registered_date"] = date('Y-m-d');
				$warehouse_id = $this->input->post("warehouse_id");
				$this->warehouses_m->insert_warehouse( $array);

				$this->session->set_flashdata('success', $this->lang->line('update_warehouse_successfully'));
				redirect(base_url("sellers/edit_warehouse/"));
			}
		} else {

			$this->data["subview"] = "sellers/edit_warehouse";
			$this->load->view('_layout_sellers', $this->data);
		}
	}

	public function my_products(){
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		$this->data['page_banner_title'] = $this->lang->line('my_products');
		$usertype = $this->session->userdata("user_type");
		if( $usertype == 2 ){
			$user_id = $this->session->userdata('loginuserID');
			$sql = array();
			$sql['user_id']= $user_id;
			$seller_id = $this->sellers_m->get_single_seller($sql)->seller_id;
			$products_primary_categories = $this->categories_m->get_categories(array('parent_id'=>0));
			$primary_categories_cnt= $this->categories_m->get_categories_cnt(array('parent_id'=>0));
			$this->data["products_primary_categories"] = $products_primary_categories;
			$this->data["seller_id"] = $seller_id;
			$this->data["controller"] = $this;
			$this->data["subview"] = "sellers/my_products";
			$this->load->view('_layout_sellers', $this->data);
		} else {
			redirect(base_url('signin/index'));
		}
	}

	public function add_product(){
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		$this->data['products_categories'] = $this->categories_m->get_categories();
		$this->data['page_banner_title'] = $this->lang->line('add_product');
		$usertype = $this->session->userdata("user_type");
		if( $usertype != 2 ){
			redirect(base_url('signin/index'));
		}
		$products_primary_categories = $this->categories_m->get_categories(array('parent_id'=>0));
		$primary_categories_cnt= $this->categories_m->get_categories_cnt(array('parent_id'=>0));
		$this->data["products_primary_categories"] = $products_primary_categories;
		$user_id = $this->session->userdata('loginuserID');
		$sql = array();
		$sql['user_id']= $user_id;
		$seller_id = $this->sellers_m->get_single_seller($sql)->seller_id;
		$warehouse_sql = array();
		$warehouse_sql['seller_id'] = $seller_id;
		$warehouse_id = $this->warehouses_m->get_single_warehouse($warehouse_sql)->warehouse_id;
		$warehouse_id_tmp = (int)$warehouse_id;
		// itbh comment : get primary categories and all categories
		if($_POST){
			$product_arr = array();
			$rules = $this->add_product_rules();
			$this->form_validation->set_rules($rules);
			if($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('success', $this->lang->line('input_information_correctly'));
				$this->data["subview"] = "sellers/add_product";
				$this->load->view('_layout_sellers', $this->data);
			} else {
				// add product to product table and warehouse
				$config_photo['upload_path']="./uploads/images/";
				$config_photo['allowed_types']='bmp|gif|jpg|png';
				$this->load->library('upload',$config_photo);
				$photo_url = '';
				if(isset($_FILES["photo"]["name"])){
					if($this->upload->do_upload('photo'))
					{
						$data = $this->upload->data();
						$product_arr['img_url'] = $data["file_name"];
					}
				}

				$documents_url = array();
				if (isset($_FILES['documents']['name'])) {
					$number_of_files = sizeof($_FILES['documents']['name']);

					$files = $_FILES['documents'];

					for ($i = 0; $i < $number_of_files; $i++)
					{
						$config_document['upload_path'] = "./uploads/documents/";
						$config_document['allowed_types'] = 'pdf|doc|docx|xls';
						$this->load->library('upload', $config_document);
						$_FILES['document']['name'] = $files['name'][$i];
						$_FILES['document']['tmp_name'] = $files['tmp_name'][$i];
						$_FILES['document']['type'] = $files['type'][$i];
						$_FILES['document']['size'] = $files['size'][$i];

						//now we initialize the upload library
						$this->upload->initialize($config_document);
						if ($this->upload->do_upload('document'))
						{
							$documents_url[$i] = $this->upload->data();
						}
					}
					$product_arr['document_url'] = json_encode($documents_url);
				}

				$product_arr['category_id'] = $_POST['parent_category'];
				$product_arr['sub_category_id'] = $_POST['sub_category'];
				$product_arr['product_name_thai'] = $_POST['product_name_thai'];
				$product_arr['product_name_english'] = $_POST['product_name_english'];
				$product_arr['description'] = $_POST['description'];
				$product_arr['sku'] = $_POST['sku'];
				$product_arr['regular_price'] = $_POST['regular_price'];
				$product_arr['market_price'] = $_POST['market_price'];
				$product_arr['quantity'] = $_POST['stock'];
				$product_arr['warehouse_status'] = 1;


				$product_arr['registered_date'] = date('Y-m-d');
				$product_arr['shipping'] = 0;
				$product_arr['seller_id'] = $seller_id;
				$product_arr['warehouse_id'] = $warehouse_id_tmp;
				$product_prices = array();
				$specifications = array();
				$volumes_tmp = $_POST['product_volume'];
				$prices_tmp = $_POST['product_price'];
				$prices_cnt = count($volumes_tmp);
				for($i = 0; $i < $prices_cnt; $i++ ) {
					$product_price_tmp = array('volume' => $volumes_tmp[$i] , 'price'=>$prices_tmp[$i]);
					array_push($product_prices , $product_price_tmp);
				}
				$titles_tmp = $_POST['specification_title'];
				$contents_tmp = $_POST['specification_content'];
				$specifications_cnt = count($titles_tmp);
				for($i = 0; $i < $specifications_cnt; $i++ ) {
					$product_specification_tmp = array('title' => $titles_tmp[$i] , 'content'=>$contents_tmp[$i]);
					array_push($specifications , $product_specification_tmp);
				}
				$product_arr['prices'] = json_encode($product_prices);
				$product_arr['specification'] = json_encode($specifications);
				$this->products_m->insert_product($product_arr);
				$this->session->set_flashdata('success', $this->lang->line('add_product_successfully'));
				redirect(base_url("sellers/add_product"));
			}
		}
		$products_primary_categories = $this->categories_m->get_categories(array('parent_id'=>0));
		$primary_categories_cnt= $this->categories_m->get_categories_cnt(array('parent_id'=>0));
		$this->data["products_primary_categories"] = $products_primary_categories;
		$this->data["subview"] = "sellers/add_product";
		$this->load->view('_layout_sellers', $this->data);
	}

	public function delete_product($product_id){
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		$this->data['page_banner_title'] = $this->lang->line('delete_product');
		$usertype = $this->session->userdata("user_type");
		if( $usertype != 2 ){
			redirect(base_url('signin/index'));
		}
		$this->products_m->delete_product($product_id);

		$this->session->set_flashdata('success', $this->lang->line('delete_product_successfully'));
		redirect(base_url("sellers/my_products"));

	}



	public function edit_product($product_id){
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		$this->data['products_categories'] = $this->categories_m->get_categories();
		$this->data['page_banner_title'] = $this->lang->line('edit_product');
		$product_data = $this->products_m->get_product(array('product_id' => $product_id));
		$usertype = $this->session->userdata("user_type");
		if( $usertype != 2 ){
			redirect(base_url('signin/index'));
		}
		$user_id = $this->session->userdata('loginuserID');
		$sql = array();
		$sql['user_id']= $user_id;
		$seller_id = $this->sellers_m->get_single_seller($sql)->seller_id;
		$warehouse_sql = array();
		$warehouse_sql['seller_id'] = $seller_id;
		$warehouse_tmp = $this->warehouses_m->get_single_warehouse($warehouse_sql);
		if (!empty($warehouse_tmp)) {
			$warehouse_id = $this->warehouses_m->get_single_warehouse($warehouse_sql)->warehouse_id;
			$warehouse_id_tmp = (int)$warehouse_id;
		}

		$products_primary_categories = $this->categories_m->get_categories(array('parent_id'=>0));
		$primary_categories_cnt= $this->categories_m->get_categories_cnt(array('parent_id'=>0));
		$this->data["products_primary_categories"] = $products_primary_categories;
		$this->data["product_data"] = $this->products_m->get_product($product_id);
		if($_POST){
			$product_arr = array();
			$rules = $this->edit_product_rules();
			$this->form_validation->set_rules($rules);
			if($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('success', $this->lang->line('input_information_correctly'));
				redirect(base_url('sellers/edit_product'));
			} else {
				// add product to product table and warehouse
				$config_photo['upload_path']="./uploads/images/";
				$config_photo['allowed_types']='bmp|gif|jpg|png';
				$this->load->library('upload',$config_photo);

				if(isset($_FILES["photo"]["name"])){
					if($this->upload->do_upload('photo'))
					{
						$data = $this->upload->data();
						$product_arr['img_url'] = $data["file_name"];
					}

				}


				if (($_FILES['documents']['name'][0]) != '') {
					$documents_url = array();
					$number_of_files = sizeof($_FILES['documents']['name']);

					$files = $_FILES['documents'];

					for ($i = 0; $i < $number_of_files; $i++)
					{
						$config_document['upload_path'] = "./uploads/documents/";
						$config_document['allowed_types'] = 'pdf|doc|docx|xls';
						$this->load->library('upload', $config_document);
						$_FILES['document']['name'] = $files['name'][$i];
						$_FILES['document']['tmp_name'] = $files['tmp_name'][$i];
						$_FILES['document']['type'] = $files['type'][$i];
						$_FILES['document']['size'] = $files['size'][$i];

						//now we initialize the upload library
						$this->upload->initialize($config_document);
						if ($this->upload->do_upload('document'))
						{
							$documents_url[$i] = $this->upload->data();
						}
					}
					$product_arr['document_url'] = json_encode($documents_url);

				}

				$product_arr['category_id'] = $_POST['parent_category'];
				$product_arr['sub_category_id'] = $_POST['sub_category'];
				$product_arr['product_name_english'] = $_POST['product_name_english'];
				$product_arr['product_name_thai'] = $_POST['product_name_thai'];
				$product_arr['description'] = $_POST['description'];
				$product_arr['sku'] = $_POST['sku'];
				$product_arr['regular_price'] = $_POST['regular_price'];
				$product_arr['market_price'] = $_POST['market_price'];
				$product_arr['quantity'] = $_POST['stock'];
				$product_arr['warehouse_status'] = 1;

				$product_arr['registered_date'] = date('Y-m-d');
				$product_arr['shipping'] = 0;
				$product_arr['seller_id'] = $seller_id;
				$product_arr['warehouse_id'] = $warehouse_id_tmp;
				$product_prices = array();
				$specifications = array();

				if (isset($_POST['product_volume'])){
					$volumes_tmp = $_POST['product_volume'];
					$prices_tmp = $_POST['product_price'];
					$prices_cnt = count($volumes_tmp);
					for($i = 0; $i < $prices_cnt; $i++ ) {
						$product_price_tmp = array('volume' => $volumes_tmp[$i] , 'price'=>$prices_tmp[$i]);
						array_push($product_prices , $product_price_tmp);
					}
					$product_arr['prices'] = json_encode($product_prices);
				} else $product_arr['prices'] = $this->data["product_data"]->prices;
				if (isset($_POST['specification_title'])){
					$titles_tmp = $_POST['specification_title'];
					$contents_tmp = $_POST['specification_content'];
					$specifications_cnt = count($titles_tmp);
					for($i = 0; $i < $specifications_cnt; $i++ ) {
						$product_specification_tmp = array('title' => $titles_tmp[$i] , 'content'=>$contents_tmp[$i]);
						array_push($specifications , $product_specification_tmp);
					}
					$product_arr['specification'] = json_encode($specifications);
				} else $product_arr['specification'] = $this->data["product_data"]->specification;

				$this->products_m->update_product($product_arr , $product_id);
				$this->session->set_flashdata('success', $this->lang->line('update_product_successfully'));

				redirect(base_url("sellers/edit_product/".$product_id));
			}
		}
		$this->data["subview"] = "sellers/edit_product";
		$this->load->view('_layout_sellers', $this->data);
	}


	public function get_sub_categories(){
		if($_POST['category_id'] == "")
		{
			$message = "failed";
		}
		else
		{
			if (($this->session->userdata('lang')) == '' ){
				$lang_tmp = 'english';
			} else {
				$lang_tmp = $this->session->userdata('lang');
			}
			$tmp = 'name_'.$lang_tmp;
			$tmp2 = 'product_name_'.$lang_tmp;
			$primary_category_id = $_POST['category_id'];
			$sub_categories = $this->categories_m->get_categories(array('parent_id'=>$primary_category_id));
			$message = '';
			foreach( $sub_categories as $cat ){
				$message = $message. "<option  value='".$cat->cat_id."'>".$cat->$tmp."</option>";
			}
		}

		echo $message;
	}

	public function search_product(){

		if(empty($_POST))
		{
			$message = "failed";
		}
		else
		{
			if (($this->session->userdata('lang')) == '' ){
				$lang_tmp = 'english';
			} else {
				$lang_tmp = $this->session->userdata('lang');
			}
			$tmp = 'name_'.$lang_tmp;
			$tmp2 = 'product_name_'.$lang_tmp;
			$product_sql = array();
			$category_id = $_POST['category_id'];
			$sub_category_id = $_POST['sub_category_id'];
			$search_product_name = $_POST['search_product_name'];
			if(!empty($category_id)){
				$product_sql['category_id'] = intval($category_id);
			}
			if(!empty($sub_category_id)){
				$product_sql['sub_category_id'] = intval($sub_category_id);
			}
			if(!empty($search_product_name)){
				$product_sql['product_name'] = $search_product_name;
			}

			$search_results = $this->products_m->search_products($product_sql);
			$message = '';
			if (!empty($search_results)){
				foreach( $search_results as $product){
					$message = $message.("<tr class='odd gradeX itbh-sellers-products-tbl' id='product-item-'".$product->product_id."'>
						<td style='display: none;'>".".$product->product_id ?></td>
						<td><a href='".base_url('products/view/' . $product->product_id)."' >
							   <img   class='itbh-sellers-products-singlie-item' src='".site_url('uploads/images/'.'/'.$product->img_url)."'>
							</a>
						</td>
						<td style='padding: 45px;'>".
							$product->$tmp2.
						"</td>
						<td style='padding: 45px;'>".
							$product->regular_price.
						"</td>
						<td style='padding: 45px;'>".
							$product->quantity.
						"</td>
						<td style='padding: 45px;'>
							<a class='btn btn-sm btn-success' href='".base_url('products/view/' . $product->product_id)."'>".
							$this->lang->line('view').
							"</a>
							<a class='btn btn-sm btn-warning' href='".base_url('sellers/edit_product/' . $product->product_id)."'>".
							$this->lang->line('edit')."</a>
							<a class='btn btn-sm btn-danger' href='".base_url('sellers/delete_product/' . $product->product_id)."'>".
							$this->lang->line('delete')."</a>
						</td>
					</tr>");
				}
			} else $message = "<tr class='odd gradeX itbh-sellers-products-tbl'><td style='text-align: center; padding: 30px; font-size: 1.4rem; color: red;'>there is no result</td></tr>";

		}
		echo $message;
	}

	public function print_products( $products){

		$output = '';
		foreach( $products as $product){
			if (($this->session->userdata('lang')) == '' ){
				$lang_tmp = 'english';
			} else {
				$lang_tmp = $this->session->userdata('lang');
			}
			$tmp = 'name_'.$lang_tmp;
			$tmp2 = 'product_name_'.$lang_tmp;
			$desc = '';
			ob_start()
			?>
			<tr class="odd gradeX itbh-sellers-products-tbl" id="product-item-<?=$product->product_id;?>">

				<td style="display: none;"><?= $product->product_id ?></td>
				<td><a href="<?= base_url('products/view/' . $product->product_id)?>" ><img   class="itbh-sellers-products-singlie-item" src="<?=site_url('uploads/images/'.$product->img_url)?>"></a></td>
				<td style="padding: 45px;"><?= $product->$tmp2?></td>
				<td style="padding: 45px;"><?= $product->regular_price?></td>
				<td style="padding: 45px;"><?= $product->quantity?></td>
				<td style="padding: 45px;">
					<a  style="margin: 0px 15px;" href="<?= base_url('products/view/' . $product->product_id)?>"><?=$this->lang->line('view')?></a>
					<a  style="margin: 0px 15px;" href="<?= base_url('sellers/edit_product/' . $product->product_id) ?>"><?=$this->lang->line('edit');?></a>
					<a  style="margin: 0px 15px;" href="<?= base_url('sellers/delete_product/' . $product->product_id) ?>"><?=$this->lang->line('delete');?></a>
				</td>
			</tr>
			<?php
		}

		return $output;
	}

	public function account_detail(){
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		$this->data['page_banner_title'] = $this->lang->line('account_detail');
		$usertype = $this->session->userdata("user_type");
		if ($usertype != 2) {
			redirect(base_url('signin/index'));
		}
		$user_id = $this->session->userdata('loginuserID');
		$sql = array();
		$sql['user_id']= $user_id;
		$seller_id = $this->sellers_m->get_single_seller($sql)->seller_id;
		$seller_data = $this->sellers_m->get_seller($seller_id);

		$user_data = $this->users_m->get_user($user_id);
		$this->data['controller'] = $this;
		$this->data['seller_data'] = $seller_data;
		$this->data['user_data'] = $user_data;
		$this->data["subview"] = "sellers/accountdetail";
		$this->load->view('_layout_sellers', $this->data);
	}

	public function update_account( ){
		$this->data['page_banner_title'] = $this->lang->line('update_account');
		$usertype = $this->session->userdata("user_type");
		if ($usertype != 2) {
			redirect(base_url('signin/index'));
		}
		$user_id = $this->session->userdata('loginuserID');
		$sql = array();
		$sql['user_id']= $user_id;
		$seller_id = $this->sellers_m->get_single_seller($sql)->seller_id;
		$this->data['user_data'] = $this->users_m->get_user($user_id);
		$this->data['seller_data'] = $this->sellers_m->get_seller($seller_id);
		if ($_POST) {
			$rules = $this->account_rules();
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('success', $this->lang->line('input_information_correctly'));
				$this->data["subview"] = "sellers/accountdetail";
				$this->load->view('_layout_sellers', $this->data);
			} else {
				$seller_arr = array();
				$new_email = $this->input->post("email");
				$seller_arr["email"] = $new_email;
				// compare password with current password
				$current_password = $this->data['user_data']->password;
				$current_password0 = $_POST['current_password'];
				$new_password0 = $_POST['new_password'];
				$confirm_password0 = $_POST['confirm_password'];
				if($confirm_password0 != $new_password0){

					$this->session->set_flashdata('success', $this->lang->line('password_not_matching'));
					$this->data["subview"] = "sellers/accountdetail";
					$this->load->view('_layout_sellers', $this->data);
				} else {
					$current_password_hashed = $this->users_m->hash($current_password0);
					$new_password = $this->users_m->hash($new_password0);
					if ($current_password_hashed == $current_password){
						$arr = array();
						$arr['password'] = $new_password;
						$arr['email'] = $new_email;
						$this->users_m->update_user( $arr, $user_id );
						$this->sellers_m->update_seller( $seller_arr, $seller_id );
						$this->session->set_flashdata('success', $this->lang->line('update_successfully'));
						$this->data["subview"] = "sellers/accountdetail";
						$this->load->view('_layout_sellers', $this->data);
					} else {
						$this->session->set_flashdata('success', $this->lang->line('input_current_pass_correctly'));
						$this->data["subview"] = "sellers/accountdetail";
						$this->load->view('_layout_sellers', $this->data);
					}

				}

			}
		} else {
			$this->data["subview"] = "sellers/accountdetail";
			$this->load->view('_layout_sellers', $this->data);
		}
	}

	public function order_managements(){
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		$this->data['page_banner_title'] = $this->lang->line('order_management');
		$usertype = $this->session->userdata("user_type");
		if( $usertype != 2 ){
			redirect(base_url('signin/index'));
		}
		$user_id = $this->session->userdata('loginuserID');
		$seller_id = $this->sellers_m->get_seller_idbyuser_id($user_id);
		$order_sql = array();
		$order_sql['seller_id'] = $seller_id;
		$orders = $this->seller_orders_m->get_order('order_sql');
		$this->data["orders"] = $orders;
		$this->data["seller_id"] = $seller_id;
		$this->data["controller"] = $this;
		$this->data["subview"] = "sellers/my_orders";
		$this->load->view('_layout_sellers', $this->data);
	}

	public function view_order($order_id){
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		$this->data['page_banner_title'] = $this->lang->line('view_order');
		$usertype = $this->session->userdata("user_type");
		if( $usertype != 2 ){
			redirect(base_url('signin/index'));
		}
		$user_id = $this->session->userdata('loginuserID');
		$seller_id = $this->sellers_m->get_seller_idbyuser_id($user_id);
		$customer_id = $this->seller_orders_m->get_customerid_byorder_id($order_id);
		$customer_data = $this->customers_m->get_customer($customer_id);
		$order_data = $this->seller_orders_m->get_order($order_id);
		$products_data = json_decode($order_data->products);
		$order_products = array();
		if(!empty($products_data)){
			foreach($products_data as $product_data){
				$product_id = $product_data->product_id;
				$product_qty = $product_data->product_qty;
				$product_subtotal = $product_data->product_subtotal;
				$warehouse_id = $product_data->warehouse_id;
				$temp['product_name'] = $product_data->product_name;
				$temp['product_id'] = $product_id;
				$temp['product_qty'] = $product_qty;
				$temp['product_subtotal'] = $product_subtotal;
				$temp['warehouse_id'] = $warehouse_id;
				array_push($order_products , $temp );

			}
		}
		$this->data['order_products'] = $order_products;
		$this->data['order_data'] = $order_data;
		$this->data["seller_id"] = $seller_id;
		$this->data["customer_data"] = $customer_data;
		$this->data["controller"] = $this;
		$this->data["subview"] = "sellers/view_order";
		$this->load->view('_layout_sellers', $this->data);
	}

	public function delete_order($order_id){
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		$usertype = $this->session->userdata("user_type");
		if( $usertype != 2 ){
			redirect(base_url('signin/index'));
		}
		$this->seller_orders_m->delete_order($order_id);

		$this->session->set_flashdata('success', $this->lang->line('delete_order_successfully'));
		redirect(base_url("sellers/order_managements"));

	}

	public function search_order(){
		if(empty($_POST))
		{
			$message = "failed";
		}
		else
		{
			$order_sql = array();
			$registered_date = $_POST['order_date'];
			$order_status = $_POST['order_status'];
			$order_name = $_POST['order_name'];
			if(!empty($registered_date)){
				$order_sql['registered_date'] = $registered_date;
			}
			if(!empty($order_status)){
				$order_sql['order_status'] = $order_status;
			}
			if(!empty($order_name)){
				$order_sql['order_name'] = $order_name;
			}

			$search_results = $this->seller_orders_m->search_orders($order_sql);
			$message = '';
			if (!empty($search_results)){
				foreach( $search_results as $order){
					$message = $message.("<tr class='odd gradeX itbh-sellers-products-tbl'>
						<td style='padding: 20px;'><a href='".base_url('sellers/view_order/' . $order->seller_order_id)."' >".$order->seller_order_id."
							</a>
						</td>
						<td style='padding: 20px;'>");

					$customer_id = $this->seller_orders_m->get_customerid_byorder_id($order->seller_order_id);
					$sql = array();
					$sql['customer_id'] = $customer_id;
					if (!empty($this->customers_m->get_single_customer($sql))){
						$message = $message.$this->customers_m->get_single_customer($sql)->fullname;
					} else $message = $message. $this->lang->line('not_found');

					$message = $message.
						("</td>
						<td style='padding: 20px;'>".
							$order->total.
							"</td>
						<td style='padding: 20px;'>".
							$order->registered_date.
							"</td>

						<td style='padding: 20px;'>".
							$order->order_status.
							"</td>

						<td style='padding: 20px;'>
							<a class='btn btn-sm btn-success' href='".base_url('sellers/view_order/' . $order->$order->seller_order_id)."'>".
							$this->lang->line('view').
							"</a>

							<a class='btn btn-sm btn-danger' href='".base_url('sellers/delete_order/' . $order->$order->seller_order_id)."'>".
							$this->lang->line('delete')."</a>
						</td>
					</tr>");
				}
			} else $message = "<tr class='odd gradeX itbh-sellers-products-tbl'><td style='text-align: center; padding: 30px; font-size: 1.4rem; color: red;'>there is no result</td></tr>";

		}
		echo $message;

	}



	public function get_customername_byorder_id($order_id){
		$this->data['primary_categories_cnt']= $this->categories_m->get_categories_cnt(array('parent_id'=>0));
		$customerid = $this->seller_orders_m->get_customerid_byorder_id($order_id);

		$customername = $this->customers_m->get_customer($customerid) ->fullname;
		return $customername;
	}

	public function print_orders( $orders){

		$output = '';
		foreach( $orders as $order){
			$desc = '';
			ob_start()
			?>
			<tr class="odd gradeX itbh-sellers-products-tbl">

				<td style="padding: 20px;"><a href="<?= base_url('sellers/view_order/' . $order->seller_order_id)?>" ><?= $order->seller_order_id?></a></td>
				<td style="padding: 20px;"><?php
						$customer_id = $this->seller_orders_m->get_customerid_byorder_id($order->seller_order_id);
						$sql = array();
						$sql['customer_id'] = $customer_id;
						if (!empty($this->customers_m->get_single_customer($sql))){
						echo $this->customers_m->get_single_customer($sql)->fullname;
					} else echo $this->lang->line('not_found');
					?></td>
				<td style="padding: 20px;"><?= $order->total?></td>
				<td style="padding: 20px;"><?= $order->registered_date?></td>
				<td style="padding: 20px;"><?= $order->order_status?></td>
				<td style="padding: 20px;">
					<a  style="margin: 0px 15px;" href="<?= base_url('sellers/view_order/' . $order->seller_order_id)?>"><?=$this->lang->line('view')?></a>
					<a  style="margin: 0px 15px;"  href="<?= base_url('sellers/delete_order/' . $order->seller_order_id) ?>"><?=$this->lang->line('delete');?></a>
				</td>
			</tr>
			<?php
		}

		return $output;
	}

	public function group_buying(){
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		$this->data['primary_categories_cnt']= $this->categories_m->get_categories_cnt(array('parent_id'=>0));
		$this->data['page_banner_title'] = $this->lang->line('my_group_buying');
		$usertype = $this->session->userdata("user_type");
		if( $usertype != 2 ){
			redirect(base_url('signin/index'));
		}
		$user_id = $this->session->userdata('loginuserID');
		$this->data["subview"] = "sellers/index";
		$this->load->view('_layout_sellers', $this->data);
	}




}


?>