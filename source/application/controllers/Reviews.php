<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Reviews extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model("categories_m");
		$this->load->model("contactus_m");
		$this->load->model("reviews_m");
		$this->load->model("users_m");
		$this->load->model("warehouses_m");
		$this->load->library("session");
		$language = $this->session->userdata('lang');
		$this->lang->load('base', $language);
		$this->load->library("pagination");
	}

	public function index(){
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		$this->data['products_primary_categories'] = $this->categories_m->get_categories(array('parent_id'=>0));
		$this->data['primary_categories_cnt']= $this->categories_m->get_categories_cnt(array('parent_id'=>0));
		$this->data['page_banner_title'] = $this->lang->line('reviews');
		$reviews = $this->reviews_m->get_where();
		$this->data['reviews'] = $reviews;
		$this->data["subview"] = "reviews/index";
		$this->load->view('_layout_main', $this->data);
	}

	public function view( $warehouse_id ){
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		$this->data['page_banner_title'] = $this->lang->line('review');
		$reviews = $this->reviews_m->get_where( array('warehouse_id'=>$warehouse_id) );
		$this->data['reviews'] = $reviews;
		$this->data["subview"] = "reviews/view";
		$this->load->view('_layout_main', $this->data);
	}

	public function add(){
		$this->data['contactus_data'] = $this->contactus_m->get_contactus();
		if(empty($_POST))
		{
			$message = $this->lang->line('failed');
		}
		else
		{
			$review = array();
			$warehouse_id = $_POST['warehouse_id'];
			$review_title= $_POST['review_title'];
			$review_content= $_POST['review_content'];
			$rating= $_POST['rating'];
			$usertype = $this->session->userdata("user_type");
			$user_id = $this->session->userdata('loginuserID');
			$review['warehouse_id'] = $warehouse_id;
			$review['user_id'] = $user_id;
			$review['review_title'] = $review_title;
			$review['review_content'] = $review_content;
			$review['rating'] = intval($rating);
			$this->reviews_m->insert_review($review);
			// after insert please calculate review ratings and update warehouse rating

			$reviews = $this->reviews_m->get_reviewsbywarehouse_id($warehouse_id);

			$review_rating = 0.0 ;

			$review_sql = array();
			$review_sql['warehouse_id'] = $warehouse_id;
			$review_cnt = $this->reviews_m->get_reviews_cnt($review_sql);
			foreach ($reviews as $review) {
				$review_rating = $review_rating + $review->rating;
			}
			if ($review_cnt != 0) {
				$tt = $review_rating / $review_cnt;
				$review_rating = round($tt * 100) / 100;
			}
			$warehouse_sql = array();

			$warehouse_sql['warehouse_id'] = $warehouse_id;
			$warehouse_sql['warehouse_rating'] = $review_rating;
			$this->warehouses_m->update_warehouse($warehouse_sql , $warehouse_id);
			$message = $this->lang->line('add_review_successfully');


		}
		echo $message;
	}





}


?>