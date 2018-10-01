<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Frontsettings extends Admin_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model("roles_m");
		$this->load->model("users_m");
		$this->load->model("whats_m");
		$this->load->model("aboutus_m");
		$this->load->model("contactus_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('base', $language);
		$this->lang->load('admin', $language);

	}


	public function index(){
		$this->data['page_banner_title'] = $this->lang->line('front_page_settings');
		$usertype = $this->session->userdata("user_type");
		$user_id = $this->session->userdata("loginuserID");
		if( $usertype != 1 ){
			redirect( base_url('admin/errors/error_403') );
		}

		$this->data['about_data'] = $this->aboutus_m->get_aboutus();
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		$this->data['whats_data'] = $this->whats_m->get_whats();
		$this->data['controller'] = $this;
		$this->data["subview"] = "admin/frontsettings/index";
		$this->data["subscript"] = "admin/frontsettings/script";
		$this->data["subcss"] = "admin/frontsettings/css";
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function updategalleries(){
		$usertype = $this->session->userdata("user_type");
		if ($usertype != 1) {
			redirect(base_url('admin/signin/index'));
		}
		$user_id = $this->session->userdata('loginuserID');
		if($_POST) {
			$rules = $this->aboutusrules();
			$this->form_validation->set_rules($rules);
			if($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('success', $this->lang->line('input_correctly'));
				redirect(base_url('admin/sitesettings/index'));
			} else{
				$arr = array();
				$arr['title_thai'] = $this->input->post('about_page_title_thai');
				$arr['title_english'] = $this->input->post('about_page_title_english');
				$arr['content_english'] = $this->input->post('about_page_content_english');
				$arr['content_thai'] = $this->input->post('about_page_content_thai');
				$arr['registered_date'] = date('Y-m-d');
				$this->aboutus_m->update_aboutus($arr);
				$this->session->set_flashdata('success', $this->lang->line('update_aboutus_successfully'));
				redirect(base_url('admin/sitesettings/index'));
			}

		} else {
			redirect(base_url('admin/sitesettings/index'));
		}

	}

	public function updatebanks(){
		$usertype = $this->session->userdata("user_type");
		if ($usertype != 1) {
			redirect(base_url('admin/signin/index'));
		}
		$user_id = $this->session->userdata('loginuserID');
		if($_POST) {
			$rules = $this->whatsrules();
			$this->form_validation->set_rules($rules);
			if($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('success', $this->lang->line('input_correctly'));
				redirect(base_url('admin/sitesettings/index'));
			} else{
				$arr = array();
				$arr['title_thai'] = $this->input->post('what_page_title_thai');
				$arr['title_english'] = $this->input->post('what_page_title_english');
				$arr['content_english'] = $this->input->post('what_page_content_english');
				$arr['content_thai'] = $this->input->post('about_page_content_thai');
				$arr['registered_date'] = date('Y-m-d');
				$this->whats_m->update_whats($arr , 1);
				$this->session->set_flashdata('success', $this->lang->line('update_whats_successfully'));
				redirect(base_url('admin/sitesettings/index'));
			}

		} else {
			redirect(base_url('admin/sitesettings/index'));
		}
	}

	public function contactus(){
		$usertype = $this->session->userdata("user_type");
		if ($usertype != 1) {
			redirect(base_url('admin/signin/index'));
		}
		$user_id = $this->session->userdata('loginuserID');
		if($_POST) {
			$rules = $this->contactusrules();
			$this->form_validation->set_rules($rules);
			if($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('success', $this->lang->line('input_correctly'));
				redirect(base_url('admin/sitesettings/index'));
			} else{
				$arr = array();
				$arr['address1'] = $this->input->post('address1');
				$arr['address2'] = $this->input->post('address2');
				$arr['tel'] = $this->input->post('tel');
				$arr['fax'] = $this->input->post('fax');
				$arr['email'] = $this->input->post('email');
				$arr['line_id'] = $this->input->post('line_id');
				$arr['facebook'] = $this->input->post('facebook');
				$arr['google'] = $this->input->post('google');
				$arr['twitter'] = $this->input->post('twitter');
				$arr['location_x'] = $this->input->post('location_x');
				$arr['location_y'] = $this->input->post('location_y');
				$arr['registered_date'] = date('Y-m-d');
				$this->contactus_m->update_contactus($arr , 1);
				$this->session->set_flashdata('success', $this->lang->line('update_aboutus_successfully'));
				redirect(base_url('admin/sitesettings/index'));
			}

		} else {
			redirect(base_url('admin/sitesettings/index'));
		}
	}

	// itbh comment : create a customized  rule
	private function aboutusrules() {
		$rules = array(
			array(
				'field' => 'about_page_title_english',
				'label' => $this->lang->line("about_page_title_english"),
				'rules' => 'trim|required'
			),
			array(
				'field' => 'about_page_title_thai',
				'label' => $this->lang->line("about_page_title_thai"),
				'rules' => 'trim|required'
			),
			array(
				'field' => 'about_page_content_english',
				'label' => $this->lang->line("about_page_content_english"),
				'rules' => 'trim|required'
			),
			array(
				'field' => 'about_page_content_thai',
				'label' => $this->lang->line("about_page_content_thai"),
				'rules' => 'trim|required'
			),
		);
		return $rules;
	}


	private function whatsrules() {
		$rules = array(
			array(
				'field' => 'what_page_title_english',
				'label' => $this->lang->line("what_page_title_english"),
				'rules' => 'trim|required'
			),
			array(
				'field' => 'what_page_title_thai',
				'label' => $this->lang->line("what_page_title_thai"),
				'rules' => 'trim|required'
			),
			array(
				'field' => 'what_page_content_english',
				'label' => $this->lang->line("what_page_content_english"),
				'rules' => 'trim|xss_clean'
			),
			array(
				'field' => 'what_page_content_thai',
				'label' => $this->lang->line("what_page_content_thai"),
				'rules' => 'trim|xss_clean'
			),
		);
		return $rules;
	}



	private function contactusrules() {
		$rules = array(
			array(
				'field' => 'address1',
				'label' => $this->lang->line("address1"),
				'rules' => 'trim|required'
			),
			array(
				'field' => 'tel',
				'label' => $this->lang->line("tel"),
				'rules' => 'trim|required'
			),

			array(
				'field' => 'email',
				'label' => $this->lang->line("what_page_title"),
				'rules' => 'trim|required'
			),
		);
		return $rules;
	}

}


?>