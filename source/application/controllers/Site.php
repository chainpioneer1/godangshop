<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Site extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model("categories_m");
		$this->load->model("contactus_m");
		$this->load->model("users_m");
		$this->load->model("products_m");
		$this->load->model("warehouses_m");
		$this->load->library("pagination");
		$this->load->library("session");
		$language = $this->session->userdata('lang');
		$this->lang->load('base', $language);

	}


	public function index(){
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		$this->data['page_banner_title'] = $this->lang->line('home');
		$tt = array();
		$this->session->set_userdata('cartdata' , $tt);

		$products = $this->products_m->get_product();
		$warehouses = $this->warehouses_m->get_warehouse();
		$latest_products = $this->products_m->get_latest_stock(4);
		$best_sellers = $this->products_m->get_best_sellers(6);
		$this->data["latest_products"] = $latest_products;
		$this->data["best_sellers"] = $best_sellers;
		$this->data["products"] = $products;
		$this->data["warehouses"] = $warehouses;
		$this->data["subview"] = "home/index";
		$this->load->view('_layout_home', $this->data);
	}

	public function language(){
		if($_POST['lang'] == "")
		{
			$message = "english";
		}
		else
		{
			$message = $_POST['lang'];
			$userdata = array('lang'=>$message);
			$this->session->set_userdata($userdata);

		}

		echo $message;
	}


	public function search(){
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		if ($_POST) {
			$search_str = $this->input->post("search_str");
			$category = $this->input->post("category");

			$this->data['results'] = $this->extensions_m->search( $search_str, $category );

			$this->data["subview"] = "extensions/search";
			$this->load->view('_layout_main', $this->data);
		} else {
			$this->data['results'] = array();
			$this->data["subview"] = "extensions/search";
			$this->load->view('_layout_main', $this->data);
		}
	}

}


?>