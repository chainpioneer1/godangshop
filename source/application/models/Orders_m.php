<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders_m extends MY_Model {

    protected $_table_name = 'orders';
    protected $_primary_key = 'order_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "order_id asc";

    function __construct() {
        parent::__construct();
    }

    function get_order($array=NULL, $signal=FALSE) {
        $query = parent::get($array, $signal);
        return $query;
    }

    function get_order_by_order($array=NULL) {
        $query = parent::get_order_by($array);
        return $query;
    }

    function get_single_order($array) {
        $query = parent::get_single($array);
        return $query;
    }

    function insert_order($array) {
        $orderID = parent::insert($array);
        return $orderID;
    }

    function update_order($data, $id = NULL) {
        parent::update($data, $id);
        return $id;
    }

    function delete_order($id){
        parent::delete($id);
    }

    function hash($string) {
        return parent::hash($string);
    }

    public function record_count() {
        return $this->db->count_all("orders");
    }




    public function get_customerid_byorder_id($order_id){
        $sql = array();
        $sql['order_id']= $order_id;
        return $this->get_single_order($sql)->customer_id;

    }

    function search_orders($array = NULL, $signal = FALSE)
    {
        if(!empty($array)){

            $this->db->select()->from('orders')->like($array);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        }
        return NULL;

    }

    public function fetch_orders($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get("orders");

        $data = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return $data;
    }

    // itbh comment : add 6-24
    public function record_my_order_count($customer_id) {
        $array = array('customer_id' => $customer_id);
        $query = parent::get_where($array);
        return count($query);
    }

    public function fetch_my_orders($limit, $start , $customer_id) {

        $query = $this->db->get_where("orders" , array('customer_id'=>$customer_id));

        $data = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return $data;
    }

    //
    public function get_ordersbyuser_id($user_id){
        $this->db->where('user_id' , $user_id);
        $query = $this->db->get('orders')->result();
        if (count($query) > 0){
            return $query;
        } else return false;
    }
    

}

?>