<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Users extends Admin_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model("roles_m");
		$this->load->model("users_m");
		$this->load->model("customers_m");
		$this->load->model("sellers_m");
		$this->load->model("warehouses_m");
		$this->load->model("contactus_m");

		$language = $this->session->userdata('lang');
		$this->lang->load('admin', $language);
		$this->lang->load('base', $language);
		$this->load->library("pagination");
	}


	public function index(){

		$this->data['page_banner_title'] = $this->lang->line('users');
		$usertype = $this->session->userdata("user_type");
		$user_id = $this->session->userdata("loginuserID");
		if( $usertype != 1 ){
			redirect( base_url('admin/errors/error_403') );

		}
		$this->data['controller'] = $this;
		$this->data['users'] = $this->users_m->get_other_users($user_id);
		$this->data["subview"] = "admin/users/index";
		$this->data["subscript"] = "admin/users/script";
		$this->data["subcss"] = "admin/users/css";
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function add(){
		$this->data['page_banner_title'] = $this->lang->line('add_new_user');
		$usertype = $this->session->userdata("user_type");

		if( $usertype != 1 ){
			redirect( base_url('admin/errors/error_403') );
		}

		$this->data['roles'] = $this->roles_m->get_roles();

		if ($_POST) {
			$rules = $this->rules();
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == FALSE) {
				$this->data["subview"] = "admin/users/add";
				$this->data["subscript"] = "admin/users/script";
				$this->data["subcss"] = "admin/users/css";
				$this->load->view('admin/_layout_main', $this->data);
			} else {

				// insert
				$add_usertype = $this->input->post("user_type");
				$array = array();
				$fullname = $this->input->post("fullname");
				$email = $this->input->post("email");
				$array["fullname"] = $fullname;
				$array["username"] = $this->input->post("username");
				$array["password"] = $this->users_m->hash($this->input->post("password"));
				$array["email"] = $email;
				$array["user_type"] = $this->input->post("user_type");
				$array["register_date"] = date('Y-m-d');

				$this->users_m->insert_user( $array );
				$user_id = $this->db->insert_id();
				$seller_arr = array();
				$customer_arr = array();

				if ($add_usertype == 2){
					$seller_arr['user_id'] = $user_id;
					$seller_arr['fullname'] = $fullname;
					$seller_arr['email'] = $email;
					$this->sellers_m->insert_seller($seller_arr);


				} elseif($add_usertype == 3){
					$customer_arr['user_id'] = $user_id;
					$customer_arr['fullname'] = $fullname;
					$customer_arr['email'] = $email;
					$this->customers_m->insert_customer($customer_arr);
				}
				$admin_email = $this->contactus_m->get_contactus()->email;
				$to = $email;
				$subject = $this->lang->line('your_account_registered');
				$message = "<h1>".$this->lang->line('from_godung')."</h1>";
				$header = "From:".$admin_email." \r\n";
				$header .= "MIME-Version: 1.0\r\n";
				$header .= "Content-type: text/html\r\n";
				$retval = mail ($to,$subject,$message,$header);

				if( $retval == true ) {
					$this->session->set_flashdata('success', 'Add user successfully! ,  Message sent successfully...');
				}else {
					$this->session->set_flashdata('success', 'Add user successfully! , but Message could not be sent...');
				}
				redirect(base_url("admin/users/index"));
			}
		} else {
			$this->data["subview"] = "admin/users/add";
			$this->data["subscript"] = "admin/users/script";
			$this->data["subcss"] = "admin/users/css";
			$this->load->view('admin/_layout_main', $this->data);
		}
	}

	public function edit( $user_id ){
		$this->data['page_banner_title'] = $this->lang->line('edit_user');
		$usertype = $this->session->userdata("user_type");

		if( $usertype != 1 ){
			redirect( base_url('admin/errors/error_403') );
		}

		$this->data['user'] = $this->users_m->get_user( $user_id );
		$this->data['roles'] = $this->roles_m->get_roles();

		if ($_POST) {
			$rules = $this->edit_rules();
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == FALSE) {
				$this->data["subview"] = "admin/users/edit";
				$this->data["subscript"] = "admin/users/script";
				$this->data["subcss"] = "admin/users/css";
				$this->load->view('admin/_layout_main', $this->data);
			} else {
				$add_usertype = $this->input->post("user_type");
				$array = array();
				$fullname = $this->input->post("fullname");
				$email = $this->input->post("email");
				$array["fullname"] = $fullname;
				$array["username"] = $this->input->post("username");
				$array["password"] = $this->users_m->hash($this->input->post("password"));
				$array["email"] = $email;
				$array["user_type"] = $add_usertype;
				$array["register_date"] = date('Y-m-d');
				$this->users_m->update_user( $array, $user_id );

				$seller_arr = array();
				$customer_arr = array();
				$sql_arr = array();

				if ($add_usertype == 2){
					// if seller
					$sql_arr['user_id'] = $user_id;
					$seller_id = $this->sellers_m->get_single_seller($sql_arr)->seller_id;
					$seller_arr['fullname'] = $fullname;
					$seller_arr['email'] = $email;
					$this->sellers_m->update_seller($seller_arr , $seller_id);
				} elseif($add_usertype == 3){
					$sql_arr['user_id'] = $user_id;
					$customer_id  = $this->customers_m->get_single_customer($sql_arr)->customer_id;
					$customer_arr['fullname'] = $fullname;
					$customer_arr['email'] = $email;
					$this->customers_m->update_customer($customer_arr , $customer_id);


				}

				$admin_email = $this->contactus_m->get_contactus()->email;
				$to = $email;
				$subject = $this->lang->line('your_account_updated');
				$message = "<h1>".$this->lang->line('from_godung')."</h1>";
				$header = "From:".$admin_email." \r\n";
				$header .= "MIME-Version: 1.0\r\n";
				$header .= "Content-type: text/html\r\n";
				$retval = mail ($to,$subject,$message,$header);

				if( $retval == true ) {
					$this->session->set_flashdata('success', 'Edit user successfully! ,  Message sent successfully...');
				}else {
					$this->session->set_flashdata('success', 'Edit user successfully! , but Message could not be sent...');
				}
				redirect(base_url("admin/users/edit/" . $user_id));
			}
		} else {
			$this->data["subview"] = "admin/users/edit";
			$this->data["subscript"] = "admin/users/script";
			$this->data["subcss"] = "admin/users/css";
			$this->load->view('admin/_layout_main', $this->data);
		}
	}


	public function en_desable( $user_id ){
		$usertype = $this->session->userdata("user_type");
		$user_sql = array();
		$seller_sql = array();
		$customer_sql = array();

		if( $usertype != 1 ){
			redirect( base_url('admin/errors/error_403') );
		}
		$admin_email = $this->contactus_m->get_contactus()->email;
		$user_sql['user_id'] = $user_id;
		$user_status = $this->users_m->get_single_user($user_sql)->user_status;
		$user_type = $this->users_m->get_single_user($user_sql)->user_type;
		$user_email = $this->users_m->get_single_user($user_sql)->email;
		if ($user_status == 1 ) {
			$user_sql['user_status'] = 0 ;
			if ($user_type == 2) {
				$seller_sql = array('user_id' => $user_id);
				$seller_id = $this->sellers_m->get_single_seller($seller_sql)->seller_id;
				$seller_sql['seller_status'] = 0;
				$this->sellers_m->update_seller( $seller_sql, $seller_id );
				$warehouse_sql = array('seller_id' => $seller_id);
				$warehouse_id = $this->warehouses_m->get_single_warehouse($warehouse_sql)->warehouse_id;
				$warehouse_sql['warehouse_status'] = 0;
				$this->warehouses_m->update_warehouse($warehouse_sql,$warehouse_id);
			} elseif ($user_type == 3) {
				$customer_sql = array('user_id' => $user_id);
				$customer_id = $this->customers_m->get_single_customer($customer_sql)->customer_id;
				$customer_sql['customer_status'] = 0;
				$this->customers_m->update_customer( $customer_sql, $customer_id);
			}

			$this->users_m->update_user( $user_sql, $user_id );

			$to = $user_email;
			$subject = $this->lang->line('your_account_updated');
			$message = "<h1>".$this->lang->line('from_godung')."</h1>";
			$header = "From:".$admin_email." \r\n";
			$header .= "MIME-Version: 1.0\r\n";
			$header .= "Content-type: text/html\r\n";
			$retval = mail ($to,$subject,$message,$header);

			if( $retval == true ) {
				$this->session->set_flashdata('success', $this->lang->line('your_account_disabled'). 'Message sent successfully...');
			}else {
				$this->session->set_flashdata('success', $this->lang->line('your_account_disabled').' , but Message could not be sent...');
			}

		} else {

			if ($user_type == 2) {
				$seller_id = $this->sellers_m->get_single_seller($user_sql)->seller_id;
				$seller_sql['seller_status'] = 1;
				$this->sellers_m->update_seller( $seller_sql, $seller_id );
//				$warehouse_sql = array('seller_id'=> $seller_id);
//				$warehouse_id = $this->warehouses_m->get_single_warehouse($warehouse_sql)->warehouse_id;
//				$warehouse_sql['warehouse_status'] = 1;
//				$this->warehouses_m->update_warehouse($warehouse_sql,$warehouse_id);
			} elseif ($user_type == 3) {
				$customer_sql = array('user_id' => $user_id);
				$customer_id = $this->customers_m->get_single_customer($customer_sql)->customer_id;
				$customer_sql['customer_status'] = 1;
				$this->customers_m->update_customer( $customer_sql, $customer_id);
			}
			$user_sql['user_status'] = 1 ;
			$this->users_m->update_user( $user_sql, $user_id );
			$to = $user_email;
			$subject = $this->lang->line('your_account_updated');
			$message = "<h1>".$this->lang->line('from_godung')."</h1>";
			$header = "From:".$admin_email." \r\n";
			$header .= "MIME-Version: 1.0\r\n";
			$header .= "Content-type: text/html\r\n";
			$retval = mail ($to,$subject,$message,$header);

			if( $retval == true ) {
				$this->session->set_flashdata('success', $this->lang->line('your_account_enabled'). 'Message sent successfully...');
			}else {
				$this->session->set_flashdata('success', $this->lang->line('your_account_enabled').' , but Message could not be sent...');
			}
		}
		redirect(base_url("admin/users/index"));
	}

	public function delete( $user_id ){
		$usertype = $this->session->userdata("user_type");
		$sql_arr = array();
		if( $usertype != 1 ){
			redirect( base_url('admin/errors/error_403') );
		}
		$user_sql['user_id'] = $user_id;
		$user_type_tmp = $this->users_m->get_single_user($user_sql)->user_type;
		$user_email = $this->users_m->get_single_user($user_sql)->email;
		$sql_arr['user_id'] = $user_id;
		if ($user_type_tmp == 2 ) {
			// check users type and if user is seller then delete user , delete seller , delete his warehouse
			$seller_id = $this->sellers_m->get_single_seller($sql_arr)->seller_id;
			$warehouse_sql = array('seller_id'=> $seller_id);
			$warehouse_id = $this->warehouses_m->get_single_warehouse($warehouse_sql)->warehouse_id;
			$this->sellers_m->delete_seller($seller_id);
			$this->warehouses_m->delete_warehouse($warehouse_id);


		} elseif ($user_type_tmp == 3) {
			// delete customer
			$customer_id  = $this->customers_m->get_single_customer($sql_arr)->customer_id;
			$this->customers_m->delete_customer($customer_id);
		}
		$this->users_m->delete_user($user_id);
		// maile sending part
		$admin_email = $this->contactus_m->get_contactus()->email;
		$to = $user_email;
		$subject = $this->lang->line('your_account_updated');
		$message = "<h1>".$this->lang->line('from_godung')."</h1>";
		$header = "From:".$admin_email." \r\n";
		$header .= "MIME-Version: 1.0\r\n";
		$header .= "Content-type: text/html\r\n";
		$retval = mail ($to,$subject,$message,$header);

		if( $retval == true ) {
			$this->session->set_flashdata('success', $this->lang->line('your_account_deleted'). 'Message sent successfully...');
		}else {
			$this->session->set_flashdata('success', $this->lang->line('your_account_deleted'). ' , but Message could not be sent...');
		}
		redirect(base_url("admin/users/index"));
	}

	public function change_pwd( $user_id ){
		$this->data['page_banner_title'] = $this->lang->line('change_password');
		$usertype = $this->session->userdata("user_type");
		$user_sql['user_id'] = $user_id;
		$user_email = $this->users_m->get_single_user($user_sql)->email;
		if( $usertype != 1 ){
			redirect( base_url('admin/errors/error_403') );
		}

		$this->data['user'] = $this->users_m->get_user( $user_id );
		$this->data['roles'] = $this->roles_m->get_roles();

		if ($_POST) {
			$rules = $this->password_rules();
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == FALSE) {
				$this->data["subview"] = "admin/users/edit";
				$this->data["subscript"] = "admin/users/script";
				$this->data["subcss"] = "admin/users/css";
				$this->load->view('admin/_layout_main', $this->data);
			} else {
				$array = array();
				$array["password"] = $this->users_m->hash($this->input->post("password"));
				// maile sending part
				$admin_email = $this->contactus_m->get_contactus()->email;
				$to = $user_email;
				$subject = $this->lang->line('your_account_updated');
				$message = "<h1>".$this->lang->line('from_godung')."</h1>";
				$header = "From:".$admin_email." \r\n";
				$header .= "MIME-Version: 1.0\r\n";
				$header .= "Content-type: text/html\r\n";
				$retval = mail ($to,$subject,$message,$header);
				$this->users_m->update_user( $array, $user_id );
				if( $retval == true ) {
					$this->session->set_flashdata('success', $this->lang->line('change_password_successfully'). 'Message sent successfully...');
				}else {
					$this->session->set_flashdata('success', $this->lang->line('change_password_successfully'). ' , but Message could not be sent...');
				}

				redirect(base_url("admin/users/edit/" . $user_id));
			}
		} else {
			$this->data["subview"] = "admin/users/edit";
			$this->data["subscript"] = "admin/users/script";
			$this->data["subcss"] = "admin/users/css";
			$this->load->view('admin/_layout_main', $this->data);
		}
	}

	private function rules() {
		$rules = array(
			array(
				'field' => 'fullname',
				'label' => $this->lang->line("fullname"),
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),
			array(
				'field' => 'username',
				'label' => $this->lang->line("username"),
				'rules' => 'trim|required|xss_clean|max_length[255]|is_unique[users.username]'
			),
			array(
				'field' => 'password',
				'label' => $this->lang->line("password"),
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),
			array(
				'field' => 'confirm_pwd',
				'label' => $this->lang->line("confirm_pwd"),
				'rules' => 'trim|required|xss_clean|max_length[255]|matches[password]'
			),
			array(
				'field' => 'email',
				'label' => $this->lang->line("email"),
				'rules' => 'trim|required|xss_clean|max_length[255]|is_unique[users.email]'
			),
			array(
				'field' => 'user_type',
				'label' => $this->lang->line("user_type"),
				'rules' => 'trim|xss_clean|integer'
			),
		);
		return $rules;
	}

	private function edit_rules() {
		$rules = array(
			array(
				'field' => 'fullname',
				'label' => $this->lang->line("fullname"),
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),
			array(
				'field' => 'username',
				'label' => $this->lang->line("username"),
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),
			array(
				'field' => 'email',
				'label' => $this->lang->line("email"),
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),
			array(
				'field' => 'user_type',
				'label' => $this->lang->line("user_type"),
				'rules' => 'trim|xss_clean|integer'
			),
		);
		return $rules;
	}

	private function password_rules() {
		$rules = array(
			array(
				'field' => 'password',
				'label' => $this->lang->line("password"),
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),
			array(
				'field' => 'confirm_pwd',
				'label' => $this->lang->line("confirm_pwd"),
				'rules' => 'trim|required|xss_clean|max_length[255]|matches[password]'
			),
		);
		return $rules;
	}


	public function search(){
		if ($_POST) {
			$search_name = $_POST['search_name'];
			$users_sql = array();
			$users_sql['email'] = $search_name;
			$search_results = $this->users_m->search_users($users_sql);
			$message = '';
			if (!empty($search_results)){
				foreach( $search_results as $search_result){

					$message = $message.
						("<tr>
						<td>".
							$search_result->username.
							"</td>
						<td>".
							$search_result->email.
							"</td>
						<td>".
							$search_result->register_date.
							"</td>

						<td style='padding: 20px;'>
							<a style='margin:0 15px;' href='".base_url('admin/users/edit/' . $search_result->user_id)."'>".
							$this->lang->line('edit').
							"</a>
							<a style='margin:0 15px;'  href='".base_url('admin/users/delete/' . $search_result->user_id)."'>".
							$this->lang->line('delete')."</a>
							<a style='margin:0 15px;'  href='".base_url('admin/users/en_desable/' . $search_result->user_id)."'>");
					if ($search_result->user_status == 1){
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