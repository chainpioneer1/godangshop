<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Groupbuying extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model("categories_m");
		$this->load->model("contactus_m");
		$this->load->model("users_m");
		$this->load->model("faqs_m");

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
		$faqs = $this->faqs_m->get_where();
		$this->data['page_banner_title'] = $this->lang->line('group_buying');
		$this->data['faqs'] = $faqs;
		$this->data["subview"] = "faqs/index";
		$this->load->view('_layout_main', $this->data);
	}

	public function view( $faq_id ){
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		$this->data['products_primary_categories'] = $this->categories_m->get_categories(array('parent_id'=>0));
		$this->data['primary_categories_cnt']= $this->categories_m->get_categories_cnt(array('parent_id'=>0));
		$this->data['page_banner_title'] = $this->lang->line('group_buying_detail');
		$faq = $this->faqs_m->get_where( array('faq_id'=>$faq_id) );
		$this->data['faq'] = $faq;
		$this->data["subview"] = "faqs/view";
		$this->load->view('_layout_main', $this->data);
	}


}


?>