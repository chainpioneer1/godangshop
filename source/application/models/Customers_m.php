<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customers_m extends MY_Model {

    protected $_table_name = 'customers';
    protected $_primary_key = 'customer_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "customer_id asc";

    function __construct() {
        parent::__construct();
    }


    public function get_customername_bycustomer_id($customer_id){
        $sql = array();
        $sql['customer_id']= $customer_id;
        return $this->get_single_customer($sql)->fullname;
    }

    public function get_customerid_byuser_id($user_id){
        $sql = array();
        $sql['user_id']= $user_id;
        return $this->get_single_customer($sql)->customer_id;
    }


    function get_customer($array=NULL, $signal=FALSE) {
        $query = parent::get($array, $signal);
        return $query;
    }

    function get_order_by_customer($array=NULL) {
        $query = parent::get_order_by($array);
        return $query;
    }

    function get_single_customer($array) {
        $query = parent::get_single($array);
        return $query;
    }

    function insert_customer($array) {
        $error = parent::insert($array);
        return TRUE;
    }

    function update_customer($data, $id = NULL) {
        parent::update($data, $id);
        return $id;
    }

    function delete_customer($id){
        parent::delete($id);
    }

    function hash($string) {
        return parent::hash($string);
    }

    public function record_count() {
        return $this->db->count_all("customers");
    }

    public function fetch_customers($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get("customers");

        $data = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return $data;
    }

    function search_customers($array = NULL, $signal = FALSE)
    {
        if(!empty($array)){

            $this->db->select()->from('customers')->like($array);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        }
        return NULL;

    }

}

?>