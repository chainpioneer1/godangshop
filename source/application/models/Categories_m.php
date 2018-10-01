<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories_m extends MY_Model {

    protected $_table_name = 'categories';
    protected $_primary_key = 'cat_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "cat_id asc";

    function __construct() {
        parent::__construct();
    }

    function get_category($array=NULL, $signal=FALSE) {
        $query = parent::get($array, $signal);
        return $query;
    }

    function get_categories($array=NULL, $signal=FALSE) {
        $query = parent::get_where($array, $signal);
        return $query;
    }

    function get_categories_cnt($array=NULL, $signal=FALSE) {
        $query = parent::get_where($array, $signal);
        if (!empty($query)){
            return count($query);
        } else return 0;
    }

    function get_order_by_category($array=NULL) {
        $query = parent::get_order_by($array);
        return $query;
    }

    function get_single_category($array) {
        $query = parent::get_single($array);
        return $query;
    }


    function insert_category($array) {
        $error = parent::insert($array);
        return TRUE;
    }

    function update_category($data, $id = NULL) {
        parent::update($data, $id);
        return $id;
    }

    function delete_category($id){
        parent::delete($id);
    }

    function hash($string) {
        return parent::hash($string);
    }

    public function record_count() {
        return $this->db->count_all("categories");
    }

    public function fetch_categories($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get("categories");

        $data = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return $data;
    }


    public function get_category_name_by_category_id ($category_id){
        $sql = array();
        $sql['cat_id'] = $category_id;
        return $this->get_single_category($sql)->name;
    }

    function search_categories($array = NULL, $signal = FALSE)
    {
        if(!empty($array)){

            $this->db->select()->from('categories')->like($array);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        }
        return NULL;

    }

}

?>