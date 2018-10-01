<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $language = $this->session->userdata('lang');
        $this->lang->load('admin', $language);
        $this->lang->load('base', $language);
    }

    public function index(){
        $this->data['page_banner_title'] = "Dashboard";
        $usertype = $this->session->userdata("user_type");
        $user_id = $this->session->userdata("loginuserID");

        $this->data["subview"] = "admin/dashboard/index";
        $this->data["subscript"] = "admin/dashboard/script";
        $this->data["subcss"] = "admin/dashboard/css";
        $this->data["body_class"] = 'home';
        $this->load->view('admin/_layout_main', $this->data);
    }

}

?>