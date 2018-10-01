<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signin_m extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->load->model("roles_m");
    }

    public function signin() {

        $lang = 'english';
        $username = $this->input->post('username');
        $password = $this->hash($this->input->post('password'));
        $userdata = '';
        $this->db->where("email = '$username' or username = '$username'");
        $this->db->where('password',$password);
        $this->db->where('user_status', 1);
        $query=$this->db->get('users');
        $userdata = $query->row();

        if( !empty($userdata) ){
            $data = array(
                "loginuserID" => $userdata->user_id,
                "user_type" => $userdata->user_type,
                "username" => $userdata->username,
                "userstatus" => $userdata->user_status,
                "lang" => $lang,
                "loggedin" => TRUE
            );
            $this->session->set_userdata($data);
            return TRUE;
        } else {
            return FALSE;
        }

    }

    public function signout() {
        $this->session->sess_destroy();

    }

    public function loggedin() {
        return (bool) $this->session->userdata("loggedin");
    }

}

/* End of file signin_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/signin_m.php */
