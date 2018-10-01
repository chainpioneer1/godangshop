<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Subscribers extends Admin_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model("roles_m");
		$this->load->model("users_m");
		$this->load->model("subscribers_m");

		$language = $this->session->userdata('lang');
		$this->lang->load('admin', $language);
		$this->lang->load('base', $language);
		$this->load->library("pagination");
	}


	public function index(){

		$this->data['page_banner_title'] = $this->lang->line('subscribers_list');
		$usertype = $this->session->userdata("user_type");
		$user_id = $this->session->userdata("loginuserID");
		if( $usertype != 1 ){
			redirect( base_url('admin/errors/error_403') );

		}

		$this->data['controller'] = $this;
		$this->data['subscribers'] = $this->subscribers_m->get_subscribers();

		$this->data["subview"] = "admin/subscribers/index";
		$this->data["subscript"] = "admin/subscribers/script";
		$this->data["subcss"] = "admin/subscribers/css";
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function add(){
		$this->data['page_banner_title'] = $this->lang->line('add_new_subscriber');
		$usertype = $this->session->userdata("user_type");

		if( $usertype != 1 ){
			redirect( base_url('admin/errors/error_403') );
		}

		if ($_POST) {
			$rules = $this->add_rules();
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == FALSE) {
				$this->data["subview"] = "admin/subscribers/add";
				$this->data["subscript"] = "admin/subscribers/script";
				$this->data["subcss"] = "admin/subscribers/css";
				$this->load->view('admin/_layout_main', $this->data);
			} else {

				// insert
				$array = array();
				$array["subscriber_email"] = $this->input->post("subscriber_email");
				$array["subscriber_status"] = 1;
				$array["created_at"] = date('Y-m-d');
				$this->subscribers_m->insert_subscriber( $array );
				$this->session->set_flashdata('success', $this->lang->line('add_new_subscriber'));
				redirect(base_url("admin/subscribers/index"));
			}
		} else {
			$this->data["subview"] = "admin/subscribers/add";
			$this->data["subscript"] = "admin/subscribers/script";
			$this->data["subcss"] = "admin/subscribers/css";
			$this->session->set_flashdata('success', $this->lang->line('input_correctly'));
			$this->load->view('admin/_layout_main', $this->data);
		}
	}

	public function edit( $subscriber_id ){
		$this->data['page_banner_title'] = $this->lang->line('edit_subscriber');
		$usertype = $this->session->userdata("user_type");

		if( $usertype != 1 ){
			redirect( base_url('admin/errors/error_403') );
		}

		if ($_POST) {
			$rules = $this->edit_rules();
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == FALSE) {
				$this->data["subview"] = "admin/subscribers/edit";
				$this->data["subscript"] = "admin/subscribers/script";
				$this->data["subcss"] = "admin/subscribers/css";
				$this->load->view('admin/_layout_main', $this->data);
			} else {
				$array = array();
				$array["subscriber_email"] = $this->input->post("email");
				$array["created_at"] = date('Y-m-d');
				$this->subscribers_m->update_subscriber( $array, $subscriber_id);
				$this->session->set_flashdata('success', $this->lang->line('updated_subscriber_successfully'));
				redirect(base_url("admin/subscribers/edit/" . $subscriber_id));
			}
		} else {
			$this->data['subscriber'] = $this->subscribers_m->get_subscriber( $subscriber_id );
			$this->data["subview"] = "admin/subscribers/edit";
			$this->data["subscript"] = "admin/subscribers/script";
			$this->data["subcss"] = "admin/subscribers/css";
			$this->load->view('admin/_layout_main', $this->data);
		}
	}


	public function delete( $subscriber_id ){
		$usertype = $this->session->userdata("user_type");
		$sql_arr = array();
		if( $usertype != 1 ){
			redirect( base_url('admin/errors/error_403') );
		}

		$sql_arr['subscriber_id'] = $subscriber_id;
		$this->subscribers_m->delete_subscriber($subscriber_id);
		$this->session->set_flashdata('success',  $this->lang->line('delete_subscriber_successfully'));
		redirect(base_url("admin/subscribers/index"));
	}

	public function en_desable( $subscriber_id ){
		$usertype = $this->session->userdata("user_type");
		$subscriber_sql = array();
		if( $usertype != 1 ){
			redirect( base_url('admin/errors/error_403') );
		}

		$subscriber_sql['subscriber_id'] = $subscriber_id;
		$subscriber_status = $this->subscribers_m->get_subscriber($subscriber_sql)->subscriber_status;
		if ($subscriber_status == 1 ) {
			$subscriber_sql['subscriber_status'] = 0 ;
			$this->subscribers_m->update_subscriber( $subscriber_sql, $subscriber_id);

		} else {
			$subscriber_sql['subscriber_status'] = 1 ;
			$this->subscribers_m->update_subscriber( $subscriber_sql, $subscriber_id);
		}
		$this->session->set_flashdata('success', $this->lang->line('updated_subscriber_successfully'));
		redirect(base_url("admin/subscribers/index"));
	}

	private function add_rules() {
		$rules = array(
			array(
				'field' => 'subscriber_email',
				'label' => $this->lang->line("subscriber_email"),
				'rules' => 'trim|required|xss_clean|max_length[255]|is_unique[subscribers.subscriber_email]'
			),
		);
		return $rules;
	}

	private function edit_rules() {
		$rules = array(
			array(
				'field' => 'email',
				'label' => $this->lang->line("email"),
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),
		);
		return $rules;
	}

	public function search(){
		if ($_POST) {
			$search_name = $_POST['search_name'];
			$subscribers_sql = array();
			$subscribers_sql['subscriber_email'] = $search_name;
			$search_results = $this->subscribers_m->search_subsribers($subscribers_sql);
			$message = '';
			if (!empty($search_results)){
				foreach( $search_results as $search_result){

					$message = $message.
						("<tr>
						<td>".
							$search_result->subscriber_email.
							"</td>
						<td>".
							$search_result->created_at.
							"</td>

						<td style='padding: 20px;'>
							<a style='margin:0 15px;' href='".base_url('admin/subscribers/edit/' . $search_result->subscriber_id)."'>".
							$this->lang->line('edit').
							"</a>
							<a style='margin:0 15px;' href='".base_url('admin/subscribers/delete/' . $search_result->subscriber_id)."'>".
							$this->lang->line('delete').
							"</a>
							<a style='margin:0 15px;'  href='".base_url('admin/subscribers/en_desable/' . $search_result->subscriber_id)."'>");
					if ($search_result->subscriber_status == 1){
						$message = $message.($this->lang->line('disable'));
					} else {
						$message = $message.($this->lang->line('enable')) ;
					}
					$message = $message. "</a>

						</td>
					</tr>";
				}
			} else $message = "<tr><td></td><td style='text-align: center; padding: 30px; font-size: 1.4rem; color: red;'><h2 style='text-align: center;'>".$this->lang->line('there_is_no_result')."</h2> </td><td></td></tr>";

		}
		echo $message;
	}

}


?>