<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Whatsgodang extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library("session");
		$language = $this->session->userdata('lang');
		$this->lang->load('base', $language);
		$this->load->library("pagination");
		$this->load->model("categories_m");
		$this->load->model("contactus_m");
		$this->load->model("whats_m");

	}


	public function index(){
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		$this->data['page_banner_title'] = $this->lang->line('what_is_godang');
		$this->data['whats_data'] = $this->whats_m->get_whats();
		$this->data["subview"] = "whatsgodang/index";
		$this->load->view('_layout_main', $this->data);
	}



}


?>