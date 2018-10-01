<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sellers_m extends MY_Model {

    protected $_table_name = 'sellers';
    protected $_primary_key = 'seller_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "seller_id asc";

    function __construct() {
        parent::__construct();
    }

    function get_seller($array=NULL, $signal=FALSE) {
        $query = parent::get($array, $signal);
        return $query;
    }

    function get_order_by_seller($array=NULL) {
        $query = parent::get_order_by($array);
        return $query;
    }

    function get_single_seller($array) {
        $query = parent::get_single($array);
        return $query;
    }

    function insert_seller($array) {
        $error = parent::insert($array);
        return TRUE;
    }

    function update_seller($data, $id = NULL) {
        parent::update($data, $id);
        return $id;
    }

    function delete_seller($id){
        parent::delete($id);
    }

    function hash($string) {
        return parent::hash($string);
    }

    public function record_count() {
        return $this->db->count_all("sellers");
    }


    public function get_seller_idbyuser_id($user_id){
        $sql = array();
        $sql['user_id']= $user_id;
        return $this->get_single_seller($sql)->seller_id;
    }

    public function get_user_idbyseller_id($seller_id){
        $sql = array();
        $sql['seller_id']= $seller_id;
        return $this->get_single_seller($sql)->user_id;
    }

    public function fetch_sellers($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get("seller");

        $data = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return $data;
    }

    function search_sellers($array = NULL, $signal = FALSE)
    {
        if(!empty($array)){

            $this->db->select()->from('sellers')->like($array);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        }
        return NULL;

    }



    

}

?>