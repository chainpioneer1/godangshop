<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Roles_m extends MY_Model {

    protected $_table_name = 'roles';
    protected $_primary_key = 'role_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "role_id asc";

    function __construct() {
        parent::__construct();
    }

    function get_roles($array=NULL, $signal=FALSE) {
        $query = parent::get($array, $signal);
        return $query;
    }

    function get_order_by_roles($array=NULL) {
        $query = parent::get_order_by($array);
        return $query;
    }

    function get_single_roles($array) {
        $query = parent::get_single($array);
        return $query;
    }

    function insert_roles($array) {
        $error = parent::insert($array);
        return TRUE;
    }

    function update_roles($data, $id = NULL) {
        parent::update($data, $id);
        return $id;
    }

    function delete_roles($id){
        parent::delete($id);
    }

    function hash($string) {
        return parent::hash($string);
    }
}

?>