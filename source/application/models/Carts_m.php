<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Carts_m extends MY_Model {

    protected $_table_name = 'carts';
    protected $_primary_key = 'cart_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "cart_id asc";

    function __construct() {
        parent::__construct();
    }

    function get_cart($array=NULL, $signal=FALSE) {
        $query = parent::get($array, $signal);
        return $query;
    }

    function get_order_by_cart($array=NULL) {
        $query = parent::get_order_by($array);
        return $query;
    }

    function get_single_cart($array) {
        $query = parent::get_single($array);
        return $query;
    }

    function insert_cart($array) {
        $error = parent::insert($array);
        return TRUE;
    }

    function update_cart($data, $id = NULL) {
        parent::update($data, $id);
        return $id;
    }

    function delete_cart($id){
        parent::delete($id);
    }

    function hash($string) {
        return parent::hash($string);
    }

    public function record_count() {
        return $this->db->count_all("carts");
    }

    public function fetch_carts($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get("carts");

        $data = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return $data;
    }
//=================itbh comment :  smile ========================
    public function addProduct2Cart($param,$cid)
    {

        $data = array(
            'customer_id'=>$cid,
          'product_data'=>$param,
        );

        return $this->db->insert('carts',$data);
    }

    public function getCartInfo($cid)
    {
        $query = $this->db->get_where('carts',array('customer_id'=>$cid));
        return $query->result();
    }

    function search_carts($array = NULL, $signal = FALSE)
    {
        if(!empty($array)){

            $this->db->select()->from('carts')->like($array);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        }
        return NULL;

    }
}

?>