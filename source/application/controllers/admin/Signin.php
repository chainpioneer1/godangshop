<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signin extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("signin_m");
        $language = $this->session->userdata('lang');
        $this->lang->load('base', $language);
        $this->lang->load('signin', $language);
    }


    protected function rules() {
        $rules = array(
            array(
                'field' => 'username',
                'label' => "Username",
                'rules' => 'trim|required|max_length[30]'
            ),
            array(
                'field' => 'password',
                'label' => "Password",
                'rules' => 'trim|required|max_length[30]'
            )
        );
        return $rules;
    }

    public function index() {
        $this->data['page_banner_title'] = "Signin";
        $this->signin_m->loggedin() == FALSE || redirect(base_url('admin/warehouses'));
        $this->data['form_validation'] = 'No';

        if($_POST) {
            $rules = $this->rules();
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == FALSE) {
                $this->data['form_validation'] = validation_errors();
                $this->load->view('admin/_layout_signin', $this->data);
            } else {
                if($this->signin_m->signin() == TRUE) {
                    $user_id = $this->session->userdata("loginuserID");
                    $arr = array();
                    $arr['login_date'] = date('Y-m-d');
                    $this->users_m->update_user( $arr, $user_id );


                    redirect(base_url('admin/warehouses/index'));
                } else {
                    $this->session->set_flashdata("errors", "That user does not signin");
                    $this->data['form_validation'] = "Incorrect Signin";
                    $this->load->view('admin/_layout_signin', $this->data);
                }
            }
        } else {
            $this->data["subview"] = "admin/signin/index";
            $this->load->view('admin/_layout_signin', $this->data);
            //$this->session->sess_destroy();
        }
    }

    private function is_expired( $id ){
        $user = $this->users_m->get_user( $id );

        if( $user->expire_date < date('Y-m-d') ){
            return true;
        }

        return false;
    }
    public function cpassword() {
        $this->load->library("session");
        if($_POST) {
            $rules = $this->rules_cpassword();
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == FALSE) {
                $this->data["subview"] = "admin/signin/cpassword";
                $this->load->view('admin/_layout_main', $this->data);
            } else {
                redirect(base_url('admin/signin/cpassword'));
            }
        } else {
            $this->data["subview"] = "admin/signin/cpassword";
            $this->load->view('admin/_layout_main', $this->data);
        }
    }

    public function signout() {
        $this->signin_m->signout();
        redirect(base_url("admin/signin/index"));
    }

}


?>