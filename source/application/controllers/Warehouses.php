<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Warehouses extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model("warehouses_m");
		$this->load->model("categories_m");
		$this->load->model("contactus_m");
		$this->load->model("products_m");
		$this->load->model("reviews_m");
		$this->load->model("users_m");
		$this->load->model("roles_m");
		$this->load->library("session");
		$language = $this->session->userdata('lang');
		$this->lang->load('warehouses', $language);
		$this->lang->load('base', $language);
		$this->load->library("pagination");
	}


	public function index(){
		$this->data['page_banner_title'] = $this->lang->line('warehouses');
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();

		// itbh comment :  pagination function
		$config = array();
		$config['base_url'] = base_url('warehouses/index');
		$total_row = $this->warehouses_m->record_count();
		$config["total_rows"] = $total_row;
		$config["per_page"] = 6;
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] = $total_row;
		$config['cur_tag_open'] = '&nbsp;<a class="current"><b>';
		$config['cur_tag_close'] = '</b></a>';
		$config['next_link'] = '&gt;';
		$config['prev_link'] = '&lt;';

		$this->pagination->initialize($config);
		if($this->uri->segment(3)){
			$page = ($this->uri->segment(3) -1)  * $config["per_page"] ;
		}
		else{
			$page = 0;
		}
		$this->data["warehouses"] = $this->warehouses_m->fetch_warehouses($config["per_page"], $page , 1);
		$str_links = $this->pagination->create_links();
		$this->data["links"] = explode('&nbsp;',$str_links );

		$this->data["subview"] = "warehouses/index";
		$this->load->view('_layout_main', $this->data);
	}



	public function view( $warehouse_id ){
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		$this->data['page_banner_title'] = $this->lang->line('warehouse_detail');
		$review_sql = array();
		$review_sql['warehouse_id'] = $warehouse_id;
		$reviews = $this->reviews_m->get_review($review_sql);
		$review_cnt = $this->reviews_m->get_reviews_cnt($review_sql);
		$this->data['review_cnt'] = $review_cnt;
		$warehouse_sql = array();
		$warehouse_sql['warehouse_id'] = $warehouse_id;
		$warehouse = $this->warehouses_m->get_single_warehouse( $warehouse_sql);

		// get warehouses category
		//$seller_id = $this->warehouses_m->get_single_warehouse(array('warehouse_id' => $warehouse_id)) ->seller_id;

		$products = $this->products_m->get_all_productsby_warehouseid($warehouse_id);
		$this->data['products'] = $products;
		$this->data['warehouse'] = $warehouse;
		$this->data['reviews'] = $reviews;
		$this->data["subview"] = "warehouses/view";
		$this->load->view('_layout_main', $this->data);
	}

}

?>