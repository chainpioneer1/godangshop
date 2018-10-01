<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Settings extends Admin_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model("roles_m");
		$this->load->model("users_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('base', $language);
		$this->lang->load('admin', $language);

	}


	public function index(){
		$this->data['page_banner_title'] = $this->lang->line('setting');
		$usertype = $this->session->userdata("user_type");
		$user_id = $this->session->userdata("loginuserID");
		if( $usertype != 1 ){
			redirect( base_url('admin/errors/error_403') );
		}
		$user_data = $this->users_m->get_user($user_id);
		$this->data['user_data'] = $user_data;
		$this->data['controller'] = $this;
		$this->data["subview"] = "admin/settings/index";
		$this->data["subscript"] = "admin/categories/script";
		$this->data["subcss"] = "admin/categories/css";
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function edit( $user_id ){
		$this->data['page_banner_title'] = $this->lang->line('edit_setting');
		$usertype = $this->session->userdata("user_type");
		if( $usertype != 1 ){
			redirect( base_url('admin/errors/error_403') );
		}

		$this->data['user'] = $this->users_m->get_user( $user_id);
		if ($_POST) {
			$rules = $this->rules();
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('success', $this->lang->line('please_input_information_correctly'));
				$user_data = $this->users_m->get_user($user_id);
				$this->data['user_data'] = $user_data;
				$this->data["subview"] = "admin/settings/index";
				$this->data["subscript"] = "admin/settings/script";
				$this->data["subcss"] = "admin/settings/css";
				$this->load->view('admin/_layout_main', $this->data);
			} else {
				$current_password = $this->data['user']->password;
				$current_password0 = $_POST['current_password'];
				$new_password0 = $_POST['new_password'];
				$new_email = $_POST['email_address'];
				$confirm_password0 = $_POST['confirm_password'];
				if($confirm_password0 != $new_password0){
					$user_data = $this->users_m->get_user($user_id);
					$this->data['user_data'] = $user_data;
					$this->session->set_flashdata('success', $this->lang->line('password_not_matching'));
					redirect('admin/settings/index');
				} else {
					$current_password_post = $this->users_m->hash($current_password0);
					$new_password = $this->users_m->hash($new_password0);
					if ($current_password_post == $current_password){
						$arr = array();
						$arr['password'] = $new_password;
						$arr['email'] = $new_email;
						$this->users_m->update_user( $arr, $user_id );
						$this->session->set_flashdata('success', $this->lang->line('updated_user_successfully'));
						redirect('admin/settings/index');
					} else {
						$user_data = $this->users_m->get_user($user_id);
						$this->data['user_data'] = $user_data;
						$this->session->set_flashdata('success', $this->lang->line('please_input_information_correctly'));
						redirect('admin/settings/index');
					}

				}

			}
		} else {
			$this->data["subview"] = "admin/categories/edit";
			$this->data["subscript"] = "admin/categories/script";
			$this->data["subcss"] = "admin/categories/css";
			$this->load->view('admin/_layout_main', $this->data);
		}
	}


	// itbh comment : create a customized  rule
	private function rules() {
		$rules = array(
			array(
				'field' => 'current_password',
				'label' => $this->lang->line("current_password"),
				'rules' => 'trim|required'
			),
			array(
				'field' => 'new_password',
				'label' => $this->lang->line("new_password"),
				'rules' => 'trim|required'
			),
			array(
				'field' => 'confirm_password',
				'label' => $this->lang->line("confirm_password"),
				'rules' => 'trim|xss_clean|matches[new_password]'
			),
		);
		return $rules;
	}

}


?>