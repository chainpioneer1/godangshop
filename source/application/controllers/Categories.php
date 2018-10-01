<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Categories extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model("categories_m");
		$this->load->model("contactus_m");
		$this->load->model("users_m");
		$this->load->model("roles_m");
		$this->load->model("products_m");
		$this->load->model("carts_m");
		$this->load->model("orders_m");
		$this->load->library("session");
		$language = $this->session->userdata('lang');
		$this->lang->load('products', $language);
		$this->lang->load('base', $language);
		$this->load->library("pagination");

	}


	public function view( $cat_slug ){

	}

}


?>