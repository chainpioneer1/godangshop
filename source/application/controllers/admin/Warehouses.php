<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Warehouses extends Admin_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model("roles_m");
		$this->load->model("warehouses_m");
		$this->load->model("users_m");

		$language = $this->session->userdata('lang');
		$this->lang->load('admin', $language);
		$this->lang->load('base', $language);
		$this->load->library("pagination");
	}
	private function add_rules() {
		$rules = array(
			array(
				'field' => 'name',
				'label' => $this->lang->line("name"),
				'rules' => 'trim|required|xss_clean|max_length[255]|is_unique[warehouses.warehouse_name]'
			),
			array(
				'field' => 'email',
				'label' => $this->lang->line("email"),
				'rules' => 'valid_email|required|is_unique[warehouses.warehouse_email]'
			),
			array(
				'field' => 'description',
				'label' => $this->lang->line("description"),
				'rules' => 'trim|xss_clean'
			),
		);
		return $rules;
	}
	private function edit_rules() {
		$rules = array(
			array(
				'field' => 'name',
				'label' => $this->lang->line("name"),
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),
			array(
				'field' => 'email',
				'label' => $this->lang->line("email"),
				'rules' => 'valid_email|required'
			),
			array(
				'field' => 'description',
				'label' => $this->lang->line("description"),
				'rules' => 'trim|xss_clean'
			),
		);
		return $rules;
	}

	public function index(){
		$this->data['page_banner_title'] = "Warehouses";
		$usertype = $this->session->userdata("user_type");

		if( $usertype != 1 ){
			redirect( base_url('admin/errors/error_403') );
		}

		$this->data['controller'] = $this;

		$this->data["subview"] = "admin/warehouses/index";
		$this->data["subscript"] = "admin/warehouses/script";
		$this->data["subcss"] = "admin/warehouses/css";
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function add(){
		$this->data['page_banner_title'] = "Add Warehouse";
		$usertype = $this->session->userdata("user_type");

		if( $usertype != 1 ){
			redirect( base_url('admin/errors/error_403') );
		}

		$this->data['warehouses'] = $this->warehouses_m->get_warehouse();

		if ($_POST) {
			$rules = $this->add_rules();
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == FALSE) {
				$this->data["subview"] = "admin/warehouses/add";
				$this->data["subscript"] = "admin/warehouses/script";
				$this->data["subcss"] = "admin/warehouses/css";
				$this->load->view('admin/_layout_main', $this->data);
			} else {

				// insert
				$array = array();
				$array["warehouse_name"] = $this->input->post("name");
				$array["warehouse_email"] = $this->input->post("email");
				$array["warehouse_description"] = $this->input->post("description");
				$this->warehouses_m->insert_warehouse( $array );

				$this->session->set_flashdata('success', 'Add warehouse successfully!');
				redirect(base_url("admin/warehouses/index"));
			}
		} else {
			$this->data["subview"] = "admin/warehouses/add";
			$this->data["subscript"] = "admin/warehouses/script";
			$this->data["subcss"] = "admin/warehouses/css";
			$this->load->view('admin/_layout_main', $this->data);
		}
	}

	public function edit( $warehouse_id ){
		$this->data['page_banner_title'] = "Edit Warehouse";
		$usertype = $this->session->userdata("user_type");

		if( $usertype != 1 ){
			redirect( base_url('admin/errors/error_403') );
		}

		$this->data['warehouses'] = $this->warehouses_m->get_warehouse();
		$this->data['warehouse'] = $this->warehouses_m->get_warehouse( $warehouse_id );


		if ($_POST) {
			$rules = $this->edit_rules();
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == FALSE) {

				$this->data["subview"] = "admin/warehouses/edit";
				$this->data["subscript"] = "admin/warehouses/script";
				$this->data["subcss"] = "admin/warehouses/css";
				$this->load->view('admin/_layout_main', $this->data);
			} else {

				// insert
				$array = array();
				$array["warehouse_name"] = $this->input->post("name");
				$array["warehouse_email"] = $this->input->post("email");
				$array["warehouse_description"] = $this->input->post("description");
				$array["registered_date"] = date('Y-m-d');
				$this->warehouses_m->update_warehouse( $array, $warehouse_id );

				$this->session->set_flashdata('success', $this->lang->line('update_warehouse_successfully'));
				redirect(base_url("admin/warehouses/edit/" . $warehouse_id));
			}
		} else {
			$this->data["subview"] = "admin/warehouses/edit";
			$this->data["subscript"] = "admin/warehouses/script";
			$this->data["subcss"] = "admin/warehouses/css";
			$this->load->view('admin/_layout_main', $this->data);
		}
	}

	public function delete( $warehouse_id ){
		$this->data['page_banner_title'] = "Delete Warehouse";
		$usertype = $this->session->userdata("user_type");

		if( $usertype != 1 ){
			redirect( base_url('admin/errors/error_403') );
		}


		$this->warehouses_m->delete_warehouse($warehouse_id);

		$this->session->set_flashdata('success', 'Delete warehouse successfully!');

		redirect(base_url("admin/warehouses/index"));
	}

	public function print_warehouses( $warehouses ){

		$output = '';
		foreach( $warehouses as $warehouse){
			$desc = '';
			if( strlen($warehouse->warehouse_description) > 30 ){
				$desc = substr($warehouse->warehouse_description, 30) . '...';
			} else {
				$desc = $warehouse->warehouse_description;
			}
			ob_start()
			?>
			<tr class="odd gradeX">

				<td style="width: 20%;"><?= $warehouse->warehouse_name ?></td>
				<td style="width: 30%;"><?= $warehouse->warehouse_email ?></td>
				<td style="width: 20%;"> <?= $warehouse->registered_date ?></td>
				<td style="width: 30%;">
					<a style="margin-right: 20px;" href="<?= base_url('warehouses/view/' . $warehouse->warehouse_id)?>">View</a> <!-- paipai -->
					<!---<a style="margin-right: 20px;" href="<?= base_url('admin/warehouses/edit/' . $warehouse->warehouse_id) ?>">Edit</a> -->
					<!---<a style="margin-right: 20px;" href="<?= base_url('admin/warehouses/delete/' . $warehouse->warehouse_id) ?>">Delete</a>  -->
				</td>
			</tr>
			<?php
		}

		return $output;
	}

	public function search(){
		if ($_POST) {
			$search_name = $_POST['search_name'];
			$warehouse_sql = array();
			$warehouse_sql['warehouse_name'] = $search_name;
			$search_results = $this->warehouses_m->search_warehouses($warehouse_sql);
			$message = '';
			if (!empty($search_results)){
				foreach( $search_results as $search_result){

					$message = $message.
						("<tr>
						<td>".
							$search_result->warehouse_name.
							"</td>
						<td>".
							$search_result->warehouse_email.
							"</td>

						<td>".
							$search_result->registered_date.
							"</td>

						<td style='padding: 20px;'>
							<a class='btn btn-sm btn-success' href='".base_url('warehouses/view/' . $search_result->warehouse_id)."'>".
							$this->lang->line('view').
							"</a>
							<a class='btn btn-sm btn-warning' href='".base_url('admin/warehouses/edit/' . $search_result->warehouse_id)."'>".
							$this->lang->line('edit')."</a>
							<a class='btn btn-sm btn-danger' href='".base_url('admin/warehouses/delete/' . $search_result->warehouse_id)."'>".
							$this->lang->line('delete')."</a>
						</td>
					</tr>");
				}
			} else $message = "<tr class='odd gradeX itbh-sellers-products-tbl'><td style='text-align: center; padding: 30px; font-size: 1.4rem; color: red;'>there is no result</td></tr>";

		}
		echo $message;
		}
	}



?>