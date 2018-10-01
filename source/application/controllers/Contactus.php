<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Contactus extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library("session");
		$language = $this->session->userdata('lang');
		$this->lang->load('base', $language);
		$this->load->library("pagination");
		$this->load->model("categories_m");
		$this->load->model("contactus_m");

	}

	public function index(){
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		$this->data['page_banner_title'] = $this->lang->line('contact_us');
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		$this->data["subview"] = "contactus/index";
		$this->load->view('_layout_main', $this->data);
	}

	public function send_message(){
		if ($_POST) {
			$contact_user_name = $this->input->post('contact_user_name');
			$contact_user_email = $this->input->post('contact_user_email');
			$contact_title = $this->input->post('contact_title');
			$contact_content = $this->input->post('contact_content');
			$created_at = date('Y-m-d');

			$admin_email = $this->contactus_m->get_contactus()->email;
			$to = $admin_email;
			$subject = $this->lang->line('your_account_updated');
			$message = "<h1>".$contact_title."</h1>";
			$message .= "<p>".$contact_content."</p>";
			$message .= "<p>".$created_at.$contact_user_name."</p>";
			$header = "From:".$contact_user_email." \r\n";
			$header .= "MIME-Version: 1.0\r\n";
			$header .= "Content-type: text/html\r\n";
			$retval = mail ($to,$subject,$message,$header);

			if( $retval == true ) {
				$this->session->set_flashdata('success', $this->lang->line('mail_sent_successfully'));
			}else {
				$this->session->set_flashdata('success', $this->lang->line('mail_not_sent_successfully'));
			}
			redirect(base_url('contactus/index'));
		}
	}


}


?>