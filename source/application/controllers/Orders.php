<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Orders extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model("categories_m");
		$this->load->model("contactus_m");
		$this->load->model("users_m");
		$this->load->model("roles_m");
		$this->load->model("products_m");
		$this->load->model("carts_m");
		$this->load->model("orders_m");
		$this->load->model("customers_m");

		$this->load->library("session");
		$language = $this->session->userdata('lang');
		$this->lang->load('products', $language);
		$this->lang->load('base', $language);
		$this->load->library("pagination");

	}


	public function index(){
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		$this->data['products_primary_categories'] = $this->categories_m->get_categories(array('parent_id'=>0));
		$this->data['primary_categories_cnt']= $this->categories_m->get_categories_cnt(array('parent_id'=>0));
		$this->data['page_banner_title'] = $this->lang->line('orders');
		$usertype = $this->session->userdata("user_type");
		if( $usertype != 2 ){
			$this->data["subview"] = "signin/login";
			$this->load->view('_layout_main', $this->data);
		}
		$user_id = $this->session->userdata('loginuserID');
		$this->data["subview"] = "myaccount/index";
		$this->load->view('_layout_customer', $this->data);
	}





}


?>