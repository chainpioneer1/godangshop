<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signin extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model("signin_m");
        $this->load->model("users_m");
        $this->load->model("customers_m");
        $this->load->model("sellers_m");
        $this->load->model("categories_m");
        $this->load->model("contactus_m");
        $this->load->model("products_m");
        $this->load->model("warehouses_m");
        $this->load->model("Subscribers_m");

        $this->load->helper('language');
        $this->load->helper('date');
        $this->load->helper('form');
        $this->load->helper('security');
        $this->load->library('form_validation');

        $this->load->library("session");
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

    protected function signup_rules() {
        $rules = array(
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
                'field' => 'useremail',
                'label' => $this->lang->line("useremail"),
                'rules' => 'trim|required|xss_clean|max_length[255]|is_unique[users.email]'
            ),
        );
        return $rules;
    }

    protected function subscribe_rules() {
        $rules = array(
            array(
                'field' => 'your_mail',
                'label' => $this->lang->line("email"),
                'rules' => 'trim|required|xss_clean|max_length[255]|is_unique[subscribers.subscriber_email]'
            )
        );
        return $rules;
    }


    public function index() {
        $this->data['contactus_data'] = $this->contactus_m->get_contactus();
        $this->data['page_banner_title'] = $this->lang->line('sign_in');
        if ($this->signin_m->loggedin() == true){
            $user_id = $this->session->userdata("loginuserID");
            $usertype = $this->session->userdata("user_type");
            if ($usertype == 3) {
                redirect(base_url('myaccount/index'));
            } elseif ($usertype == 2) {
                redirect(base_url('sellers/index'));
            } else {
                redirect(base_url('site/index'));
            }
        }

        if($_POST) {
            $rules = $this->rules();
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == FALSE) {
                $this->data['form_validation'] = validation_errors();
                $this->data["subview"] = "signin/login";
                $this->load->view('_layout_signin', $this->data);
            } else {
                if($this->signin_m->signin() == TRUE) {
                    $user_id = $this->session->userdata("loginuserID");
                    $usertype = $this->session->userdata("user_type");
                    if ($usertype == 3){
                        $arr = array();
                        $arr['login_date'] = date('Y-m-d');
                        $this->users_m->update_user( $arr, $user_id );
                        redirect(base_url('myaccount/index'));
                    } elseif ($usertype == 2){

                        redirect(base_url('sellers/index'));
                    }

                } else {
                    $this->session->set_flashdata("errors", "That user does not signin");
                    $this->data['login_result'] = $this->lang->line('Username_or_password_incorrect');
                    $this->data["subview"] = "signin/login";
                    $this->load->view('_layout_main', $this->data);
                }
            }
        } else {
            $this->data["subview"] = "signin/login";
            $this->load->view('_layout_main', $this->data);
        }
    }

    public function subscribe(){
        $this->data['contactus_data'] = $this->contactus_m->get_contactus();
        if(!empty($_POST['your_mail'])) {
            $your_mail = $_POST['your_mail'];
            $rules = $this->subscribe_rules();
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == FALSE) {
                echo ($this->lang->line('mail_exist'));
                return;
            }
            $data = array();
            $data['subscriber_email'] = $your_mail;
            $data['subscriber_status'] = 1;
            $data['created_at'] = date('Y-m-d');
            $this->Subscribers_m->insert_subscriber($data);
            echo ($this->lang->line('add_subscriber_successfully'));
            return;
        } else {
            echo ($this->lang->line('error'));
        }
    }
    public function signup() {
        $this->data['contactus_data'] = $this->contactus_m->get_contactus();
        $this->data['page_banner_title'] = $this->lang->line('sign_up');

        if($_POST) {
            $rules = $this->signup_rules();
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == FALSE) {
                $this->data['form_validation'] = validation_errors();
                $this->data["subview"] = "signin/login";
                $this->load->view('_layout_main', $this->data);
            } else {
                // itbh comment : insert new customer data // user type : 3 => he is customer , 2 => seller , 1 => admin  default => 3 , user_status : 0 : disable , he can not login
                // 1 : enable
                $arr = array();
                $username_tmp = $this->input->post('username');
                $userpassword_tmp = $this->users_m->hash($this->input->post('password'));
                $userrole_tmp = $this->input->post('user_role');
                $useremail_tmp = $this->input->post('useremail');
                $arr['username'] = $username_tmp;
                $arr['password'] = $userpassword_tmp;
                $arr['user_type'] = $userrole_tmp;
                $arr['email'] = $useremail_tmp;
                $arr['user_status'] = 0;
                $arr['register_date'] = date('Y-m-d');
                $this->users_m->insert_user( $arr );
                $user_id = $this->db-> insert_id();

                // if user type is 3 , then it is customer  customer array   :
                if ($arr['user_type'] == '3') {
                    $customer_arr = array();
                    $customer_arr['customer_status'] = 0;
                    $customer_arr['user_id'] = $user_id;
                    $customer_arr['email'] = $useremail_tmp;
                    $this->customers_m->insert_customer($customer_arr);
                    $this->data['form_validation'] = $this->lang->line('add_customer_successfully');
                    $this->data["subview"] = "signin/login";
                    $this->load->view('_layout_main', $this->data);
                } elseif ($arr['user_type'] == '2') {
                    $seller_arr = array();
                    $seller_arr['seller_status'] = 0;
                    $seller_arr['user_id'] = $user_id;
                    $seller_arr['email'] = $useremail_tmp;
                    $this->sellers_m->insert_seller($seller_arr);
                    $seller_id = $this->db->insert_id();
                    $warehouse_arr = array();
                    $warehouse_arr['seller_id'] = $seller_id;
                    $warehouse_arr['warehouse_status'] = 0;
                    $warehouse_arr['warehouse_email'] = $useremail_tmp;
                    $warehouse_arr['registered_date'] = date('Y-m-d');
                    $this->warehouses_m->insert_warehouse($warehouse_arr);
                    $this->data["subview"] = "signin/login";
                    $this->data['form_validation'] = $this->lang->line('add_seller_successfully');
                    $this->load->view('_layout_main', $this->data);
                }

            }
        } else {
            $this->data["subview"] = "signin/login";
            $this->load->view('_layout_main', $this->data);
        }
    }

    public function signout() {
        $this->data['contactus_data'] = $this->contactus_m->get_contactus();
        $this->signin_m->signout();
        $tt = array();
        $this->session->set_userdata('cartdata' , $tt);
        redirect(base_url("signin/index"));
    }
    public function checkout_register(){


        $info = explode(',',$_POST['info']);
        $arr = array();
        $arr['fullname'] = $info[0];
        $arr['username'] = $info[1];
        $arr['password'] = $this->users_m->hash($info[2]);
        $arr['email'] = $info[3];
        $arr['user_type'] = 3;
        $arr['user_status'] = 0;
        $arr['register_date'] = date('Y-m-d');
        $flag1=$this->users_m->insert_user( $arr );
        $user_id = $this->db-> insert_id();

        // customer array   :
        $customer_arr = array();
        $customer_arr['customer_status'] = 0;
        $customer_arr['fullname'] = $info[0];;
        $customer_arr['user_id'] = $user_id;
        $customer_arr['email'] = $info[3];
        $flag2=$this->customers_m->insert_customer($customer_arr);
        if($flag1==true && $flag2==true)
        {
            $this->session->set_userdata('loginuserID',$user_id);
            return true;
        }else{

            return false;
        }
    }

}


?>