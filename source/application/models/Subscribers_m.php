<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscribers_m extends MY_Model {

    protected $_table_name = 'subscribers';
    protected $_primary_key = 'subscriber_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "subscriber_id asc";

    function __construct() {
        parent::__construct();
    }
    function get_subscriber($array=NULL, $signal=FALSE) {
        $query = parent::get($array, $signal);
        return $query;
    }

    function get_subscribers() {
        $this->db->select("*")
            ->from('subscribers');
        $query = $this->db->get();
        if ($query->num_rows() > 0)    {
            return $query->result();
        }

        return NULL;
    }


    function insert_subscriber($array) {
        $error = parent::insert($array);
        return TRUE;
    }

    function update_subscriber($data , $id = null) {
        parent::update($data,  $id);
        return true;
    }

    function delete_subscriber($id){
        parent::delete($id);
    }

    function search_subsribers($array = NULL, $signal = FALSE)
    {
        if(!empty($array)){

            $this->db->select()->from('subscribers')->like($array);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        }
        return NULL;

    }

}

?>