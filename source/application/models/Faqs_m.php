<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faqs_m extends MY_Model {

    protected $_table_name = 'faqs';
    protected $_primary_key = 'faq_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "faq_id asc";

    function __construct() {
        parent::__construct();
    }

    function get_faq($array=NULL, $signal=FALSE) {
        $query = parent::get($array, $signal);
        return $query;
    }

    function get_order_by_faq($array=NULL) {
        $query = parent::get_order_by($array);
        return $query;
    }

    function get_single_faq($array) {
        $query = parent::get_single($array);
        return $query;
    }

    function insert_faq($array) {
        $error = parent::insert($array);
        return TRUE;
    }

    function update_faq($data, $id = NULL) {
        parent::update($data, $id);
        return $id;
    }

    function delete_faq($id){
        parent::delete($id);
    }

    function hash($string) {
        return parent::hash($string);
    }

    public function record_count() {
        return $this->db->count_all("faqs");
    }

    public function fetch_faqs($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get("faqs");

        $data = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return $data;
    }

    public function get_ranked_faqs(){
        $this->db->from('faqs');
        $this->db->order_by('faq_rank' , 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    function search_faqs($array = NULL, $signal = FALSE)
    {
        if(!empty($array)){

            $this->db->select()->from('faqs')->like($array);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        }
        return NULL;

    }

    

}

?>