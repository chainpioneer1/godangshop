<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groups_m extends MY_Model {

    protected $_table_name = 'groups';
    protected $_primary_key = 'group_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "group_id asc";

    function __construct() {
        parent::__construct();
    }

    function get_group($array=NULL, $signal=FALSE) {
        $query = parent::get($array, $signal);
        return $query;
    }

    function get_order_by_group($array=NULL) {
        $query = parent::get_order_by($array);
        return $query;
    }

    function get_single_group($array) {
        $query = parent::get_single($array);
        return $query;
    }

    function insert_group($array) {
        $error = parent::insert($array);
        return TRUE;
    }

    function update_group($data, $id = NULL) {
        parent::update($data, $id);
        return $id;
    }

    function delete_group($id){
        parent::delete($id);
    }

    function hash($string) {
        return parent::hash($string);
    }

    public function record_count() {
        return $this->db->count_all("groups");
    }

    public function fetch_groups($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get("groups");

        $data = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return $data;
    }


    function search_groups($array = NULL, $signal = FALSE)
    {
        if(!empty($array)){

            $this->db->select()->from('groups')->like($array);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        }
        return NULL;

    }

    

}

?>