<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Aboutus extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->library("session");
		$language = $this->session->userdata('lang');
		$this->lang->load('base', $language);

		$this->load->library("pagination");
		$this->load->model("categories_m");
		$this->load->model("contactus_m");
		$this->load->model("aboutus_m");
	}


	public function index(){
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		$this->data['about_data'] = $this->aboutus_m->get_aboutus();
		$this->data['page_banner_title'] = $this->lang->line('about_us');
		$this->data["subview"] = "aboutus/index";
		$this->load->view('_layout_main', $this->data);
	}

}


?>