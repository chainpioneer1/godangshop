<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class faqs extends Admin_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model("faqs_m");
		$this->load->model("users_m");

		$language = $this->session->userdata('lang');
		$this->lang->load('admin', $language);
		$this->lang->load('base', $language);
		$this->load->library("pagination");
	}


	public function index(){
		$usertype = $this->session->userdata("user_type");

		if( $usertype != 1 ){
			redirect( base_url('admin/errors/error_403') );
		}

		$this->data['controller'] = $this;
		$this->data["subview"] = "admin/faqs/index";
		$this->data["subscript"] = "admin/faqs/script";
		$this->data["subcss"] = "admin/faqs/css";
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function add(){
		$usertype = $this->session->userdata("user_type");

		if( $usertype != 1 ){
			redirect( base_url('admin/errors/error_403') );
		}

		$this->data['faqs'] = $this->faqs_m->get_faq();

		if ($_POST) {
			$rules = $this->add_rules();
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == FALSE) {
				$this->data["subview"] = "admin/faqs/add";
				$this->data["subscript"] = "admin/faqs/script";
				$this->data["subcss"] = "admin/faqs/css";
				$this->load->view('admin/_layout_main', $this->data);
			} else {

				// insert
				$array = array();
				$array["faq_title_english"] = $this->input->post("faq_title_english");
				$array["faq_title_thai"] = $this->input->post("faq_title_thai");
				$array["faq_description_english"] = $this->input->post("faq_description_english");
				$array["faq_description_thai"] = $this->input->post("faq_description_thai");
				$array["faq_rank"] = $this->input->post("faq_rank");
				$array["registered_date"] = date("Y-m-d") ;
				$this->faqs_m->insert_faq( $array );

				$this->session->set_flashdata('success', $this->lang->line('create_faq_successfully'));

				redirect(base_url("admin/faqs/index"));
			}
		} else {
			$this->data["subview"] = "admin/faqs/add";
			$this->data["subscript"] = "admin/faqs/script";
			$this->data["subcss"] = "admin/faqs/css";
			$this->load->view('admin/_layout_main', $this->data);
		}
	}

	public function edit( $faq_id ){
		$usertype = $this->session->userdata("user_type");

		if( $usertype != 1 ){
			redirect( base_url('admin/errors/error_403') );
		}

		$this->data['faqs'] = $this->faqs_m->get_faq();
		$this->data['faq'] = $this->faqs_m->get_faq( $faq_id);

		if ($_POST) {
			$rules = $this->edit_rules();
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('success', $this->lang->line('please_input_information_correctly') . '    FAQ Title FAQ Rank need to unique');
				$this->data["subview"] = "admin/faqs/edit";
				$this->data["subscript"] = "admin/faqs/script";
				$this->data["subcss"] = "admin/faqs/css";
				$this->load->view('admin/_layout_main', $this->data);
			} else {

				// insert
				$array = array();
				$array["faq_title_english"] = $this->input->post("faq_title_english");
				$array["faq_title_thai"] = $this->input->post("faq_title_thai");
				$array["faq_rank"] = $this->input->post("faq_rank");
				$array["faq_description_english"] = $this->input->post("faq_description_english");
				$array["faq_description_thai"] = $this->input->post("faq_description_thai");
				$array["registered_date"] = date('Y-m-d');

				$this->faqs_m->update_faq( $array, $faq_id);

				$this->session->set_flashdata('success', $this->lang->line('update_faq_successfully'));
				redirect(base_url("admin/faqs/edit/" . $faq_id));
			}
		} else {
			$this->data["subview"] = "admin/faqs/edit";
			$this->data["subscript"] = "admin/faqs/script";
			$this->data["subcss"] = "admin/faqs/css";
			$this->load->view('admin/_layout_main', $this->data);
		}
	}

	public function delete( $faq_id ){
		$usertype = $this->session->userdata("user_type");

		if( $usertype != 1 ){
			redirect( base_url('admin/errors/error_403') );
		}


		$this->faqs_m->delete_faq($faq_id);
		$this->session->set_flashdata('success', $this->lang->line('delete_faq_successfully'));

		redirect(base_url("admin/faqs/index"));
	}


	private function add_rules() {
		$rules = array(
			array(
				'field' => 'faq_title_english',
				'label' => $this->lang->line("faq_title_english"),
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),
			array(
				'field' => 'faq_title_thai',
				'label' => $this->lang->line("faq_title_thai"),
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),
			array(
				'field' => 'faq_description_english',
				'label' => $this->lang->line("faq_description_english"),
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'faq_description_thai',
				'label' => $this->lang->line("faq_description_thai"),
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'faq_rank',
				'label' => $this->lang->line("faq_rank"),
				'rules' => 'trim|xss_clean|is_unique[faqs.faq_rank]'
			),
		);
		return $rules;
	}

	private function edit_rules() {
		$rules = array(
			array(
				'field' => 'faq_title_english',
				'label' => $this->lang->line("faq_title_english"),
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),
			array(
				'field' => 'faq_title_thai',
				'label' => $this->lang->line("faq_title_thai"),
				'rules' => 'trim|required|xss_clean|max_length[255]'
			),
			array(
				'field' => 'faq_description_english',
				'label' => $this->lang->line("faq_description_english"),
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'faq_description_thai',
				'label' => $this->lang->line("faq_description_thai"),
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'faq_rank',
				'label' => $this->lang->line("faq_rank"),
				'rules' => 'trim|xss_clean'
			),
		);
		return $rules;
	}

	public function print_faqs( $faqs){

		$output = '';
		foreach( $faqs as $faq){
			$desc_english = '';$desc_thai = '';
			if( strlen($faq->faq_description_english) > 30 ){
				$desc_english = str_split($faq->faq_description_english, 30)[0] .'&nbsp;'. '...';
			} else {
				$desc_english = $faq->faq_description_english;
			}

			if( strlen($faq->faq_description_thai) > 30 ){
				$desc_thai = str_split($faq->faq_description_thai, 30)[0] .'&nbsp;'.'...';
			} else {
				$desc_thai = $faq->faq_description_thai;
			}
//			ob_start()
			?>
			<tr class="odd gradeX">

				<td><?= $faq->faq_title_english?></td>
				<td><?= $faq->faq_title_thai?></td>
				<td><?= $faq->faq_rank ?></td>
				<td><?= $desc_english ?></td>
				<td><?= $desc_thai ?></td>
				<td><?= $faq->registered_date?></td>
				<td>
					<a style="margin: 0px 15px;" href="<?= base_url('admin/faqs/edit/' . $faq->faq_id) ?>"><?=$this->lang->line('edit');?></a>
					<a style="margin: 0px 15px;" href="<?= base_url('admin/faqs/delete/' . $faq->faq_id) ?>"><?=$this->lang->line('delete');?></a>
				</td>
			</tr>
			<?php
		}

		return $output;
	}
}


?>