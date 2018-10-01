<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_m extends MY_Model {

    protected $_table_name = 'users';
    protected $_primary_key = 'user_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "user_id asc";

    function __construct() {
        parent::__construct();
    }

    function get_user($array=NULL, $signal=FALSE) {
        $query = parent::get($array, $signal);
        return $query;
    }

    function get_other_users($user_id) {
        $array = array('user_id !=' => $user_id);
        $query = parent::get_where($array);
        return $query;
    }

    function get_order_by_user($array=NULL) {
        $query = parent::get_order_by($array);
        return $query;
    }

    function get_single_user($array) {
        $query = parent::get_single($array);
        return $query;
    }

    function insert_user($array) {
        $error = parent::insert($array);
        return TRUE;
    }

    function update_user($data, $id = NULL) {
        parent::update($data, $id);
        return $id;
    }

    function delete_user($id){
        parent::delete($id);
    }

    function hash($string) {
        return parent::hash($string);
    }


    function search_users($array = NULL, $signal = FALSE)
    {
        if(!empty($array)){

            $this->db->select()->from('users')->like($array);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        }
        return NULL;

    }

}

?>