<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Categories extends Admin_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model("roles_m");
		$this->load->model("categories_m");$this->load->model("contactus_m");
		$this->load->model("users_m");


		$language = $this->session->userdata('lang');
		$this->lang->load('admin', $language);
		$this->lang->load('base', $language);
		$this->load->library("pagination");
	}


	public function index(){
		$this->data['page_banner_title'] = "Categories";
		$usertype = $this->session->userdata("user_type");

		if( $usertype != 1 ){
			redirect( base_url('admin/errors/error_403') );
		}

		$this->data['controller'] = $this;

		$this->data["subview"] = "admin/categories/index";
		$this->data["subscript"] = "admin/categories/script";
		$this->data["subcss"] = "admin/categories/css";
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function add(){
		$usertype = $this->session->userdata("user_type");

		if( $usertype != 1 ){
			redirect( base_url('admin/errors/error_403') );
		}

		$this->data['categories'] = $this->categories_m->get_category();

		if ($_POST) {
			$rules = $this->add_rules();
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == FALSE) {
				$this->data["subview"] = "admin/categories/add";
				$this->data["subscript"] = "admin/categories/script";
				$this->data["subcss"] = "admin/categories/css";
				$this->load->view('admin/_layout_main', $this->data);
			} else {

				// insert
				$array = array();
				$array["name_english"] = $this->input->post("name_english");
				$array["name_thai"] = $this->input->post("name_thai");
				$array["slug"] = $this->input->post("slug");
				$array["description"] = $this->input->post("description");
				$array["parent_id"] = $this->input->post("parent_id");
				$array["registered_date"] = date('Y-m-d');
				$this->categories_m->insert_category( $array );

				$this->session->set_flashdata('success', $this->lang->line('add_category_successfully'));

				redirect(base_url("admin/categories/index"));
			}
		} else {
			$this->data["subview"] = "admin/categories/add";
			$this->data["subscript"] = "admin/categories/script";
			$this->data["subcss"] = "admin/categories/css";
			$this->load->view('admin/_layout_main', $this->data);
		}
	}

	public function edit( $cat_id ){
		$usertype = $this->session->userdata("user_type");

		if( $usertype != 1 ){
			redirect( base_url('admin/errors/error_403') );
		}

		$this->data['categories'] = $this->categories_m->get_category();
		$this->data['category'] = $this->categories_m->get_category( $cat_id );

		if ($_POST) {
			$rules = $this->edit_rules();
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == FALSE) {
				$this->data["subview"] = "admin/categories/edit";
				$this->data["subscript"] = "admin/categories/script";
				$this->data["subcss"] = "admin/categories/css";
				$this->load->view('admin/_layout_main', $this->data);
			} else {

				// insert
				$array = array();
				$array["name_english"] = $this->input->post("name_english");
				$array["name_thai"] = $this->input->post("name_thai");
				$array["slug"] = $this->input->post("slug");
				$array["description"] = $this->input->post("description");
				$array["parent_id"] = $this->input->post("parent_id");
				$array["updated_date"] = date('Y-m-d');
				$this->categories_m->update_category( $array, $cat_id );

				$this->session->set_flashdata('success', $this->lang->line('update_category_successfully'));
				redirect(base_url("admin/categories/edit/" . $cat_id));
			}
		} else {
			$this->data["subview"] = "admin/categories/edit";
			$this->data["subscript"] = "admin/categories/script";
			$this->data["subcss"] = "admin/categories/css";
			$this->load->view('admin/_layout_main', $this->data);
		}
	}

	public function delete( $cat_id ){
		$usertype = $this->session->userdata("user_type");

		if( $usertype != 1 ){
			redirect( base_url('admin/errors/error_403') );
		}


		$this->categories_m->delete_category($cat_id);
		$this->session->set_flashdata('success', $this->lang->line('delete_category_successfully'));

		redirect(base_url("admin/categories/index"));
	}


	private function add_rules() {
		$rules = array(
			array(
				'field' => 'name_english',
				'label' => $this->lang->line("name_english"),
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),
			array(
				'field' => 'name_thai',
				'label' => $this->lang->line("name_thai"),
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),
			array(
				'field' => 'slug',
				'label' => $this->lang->line("slug"),
				'rules' => 'trim|required|xss_clean|max_length[255]|is_unique[categories.slug]'
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
				'field' => 'name_english',
				'label' => $this->lang->line("name_english"),
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),
			array(
				'field' => 'name_thai',
				'label' => $this->lang->line("name_thai"),
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),
			array(
				'field' => 'description',
				'label' => $this->lang->line("description"),
				'rules' => 'trim|xss_clean'
			),
		);
		return $rules;
	}


	public function print_cats( $cats, $level ){

		$output = '';
		foreach( $cats as $cat ){
			$desc = '';
			if( strlen($cat->description) > 30 ){
				$desc = substr($cat->description, 30) . '...';
			} else {
				$desc = $cat->description;
			}

			$prefix = '';
			for( $i=0; $i<$level; $i++ ){
				$prefix .= '&#8212;&nbsp;&nbsp;';
			}

			$prefix .='&nbsp;';
			ob_start()
			?>
			<tr class="odd gradeX">

				<td><?= $prefix . ucfirst($cat->name_english) ?></td>
				<td><?= $prefix . ucfirst($cat->name_thai) ?></td>
				<td><?= $cat->slug ?></td>
				<td><?= $desc ?></td>
				<td>
					<a style="margin: 0 15px;" href="<?= base_url('admin/categories/edit/' . $cat->cat_id) ?>"><?php echo($this->lang->line('edit'));?></a>
					<a style="margin: 0 15px;" href="<?= base_url('Products/getProductByCatId/?curCartId=' . $cat->cat_id) ?>"><?php echo($this->lang->line('view'));?></a>
					<a style="margin: 0 15px;" href="<?= base_url('admin/categories/delete/' . $cat->cat_id) ?>"><?php echo($this->lang->line('delete'));?></a>
				</td>
			</tr>
			<?php
			$output .= ob_get_clean();
			$child_cats = $this->categories_m->get_where( array('parent_id'=>$cat->cat_id) );
			if( count($child_cats) > 0 )
				$output .= $this->print_cats( $child_cats, $level+1 );
		}

		return $output;
	}




	public function search(){
		if ($_POST) {
			$search_name = $_POST['search_name'];
			$categories_sql = array();
			$categories_sql['name'] = $search_name;
			$search_results = $this->categories_m->search_categories($categories_sql);
			$message = '';
			if (!empty($search_results)){
				foreach( $search_results as $search_result){

					$message = $message.
						("<tr>
						<td>".
							$search_result->name_english.
							"</td>
							<td>".
							$search_result->name_thai.
							"</td>
						<td>".
							$search_result->slug.
							"</td>
							<td>".
							$search_result->description.
							"</td>
						<td style='padding: 20px;'>
							<a style='margin:0 15px;' href='".base_url('admin/categories/edit/' . $search_result->cat_id)."'>".
							$this->lang->line('edit').
							"</a><a style='margin:0 15px;'  href='".base_url('Products/getProductByCatId/?curCartId=' . $search_result->cat_id)."'>".
							$this->lang->line('view')."</a>
							<a style='margin:0 15px;'  href='".base_url('admin/categories/delete/' . $search_result->cat_id)."'>".
							$this->lang->line('delete')."</a>
						</td>
					</tr>");
				}
			} else $message = "<tr><td></td><td style='text-align: center; padding: 30px; font-size: 1.4rem; color: red;'><h2 style='text-align: center;'>".$this->lang->line('there_is_no_result')."</h2> </td><td></td></tr>";

		}
		echo $message;
	}



}


?>