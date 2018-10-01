<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Customers extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->model("categories_m");
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


	public function index()
	{
		$this->data['products_primary_categories'] = $this->categories_m->get_categories(array('parent_id'=>0));
		$this->data['primary_categories_cnt']= $this->categories_m->get_categories_cnt(array('parent_id'=>0));
//		$faqs = $this->faqs_m->get_where();
//		$this->data['faqs'] = $faqs;
		$this->data['page_banner_title'] = $this->lang->line('customers');
		$this->data["subview"] = "faqs/index";
		$this->load->view('_layout_main', $this->data);
	}

	public function view($faq_id)
	{
		$this->data['products_primary_categories'] = $this->categories_m->get_categories(array('parent_id'=>0));
		$this->data['primary_categories_cnt']= $this->categories_m->get_categories_cnt(array('parent_id'=>0));
		$this->data['page_banner_title'] = $this->lang->line('customer_detail');
		$faq = $this->faqs_m->get_where(array('faq_id' => $faq_id));
		$this->data['faq'] = $faq;
		$this->data["subview"] = "faqs/view";
		$this->load->view('_layout_main', $this->data);
	}
}



?>