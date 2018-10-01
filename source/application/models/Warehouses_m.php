<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Warehouses_m extends MY_Model {

    protected $_table_name = 'warehouses';
    protected $_primary_key = 'warehouse_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "warehouse_id asc";

    function __construct() {
        parent::__construct();
    }

    function get_warehouse($array=NULL, $signal=FALSE) {
        $query = parent::get($array, $signal);
        return $query;
    }

    function get_warehouse_byseller_id($seller_id) {
        $array = array();
        $array['seller_id'] = $seller_id;
        $query = parent::get_where($array, false);
        return $query;
    }

    function get_order_by_warehouse($array=NULL) {
        $query = parent::get_order_by($array);
        return $query;
    }

    function get_single_warehouse($array) {
        $query = parent::get_single($array);
        return $query;
    }

    function insert_warehouse($array) {
        $error = parent::insert($array);
        return TRUE;
    }

    function update_warehouse($data, $id = NULL) {
        parent::update($data, $id);
        return $id;
    }

    function delete_warehouse($id){
        parent::delete($id);
    }

    function hash($string) {
        return parent::hash($string);
    }

    public function record_count() {
        return $this->db->count_all("warehouses");
    }

    public function fetch_warehouses($limit, $start , $warehouse_status) {
        $this->db->limit($limit, $start);
        $query = $this->db->where("warehouse_status" , $warehouse_status);
        $query = $this->db->get("warehouses");

        $data = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return $data;
    }

    function search_warehouses($array = NULL, $signal = FALSE)
    {
        if(!empty($array)){

            $this->db->select()->from('warehouses')->like($array);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        }
        return NULL;

    }

    

}

?>