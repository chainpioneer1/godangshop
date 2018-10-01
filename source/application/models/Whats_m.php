<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Whats_m extends MY_Model {

    protected $_table_name = 'whats';
    protected $_primary_key = 'whats_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "whats_id asc";

    function __construct() {
        parent::__construct();
    }

    function get_whats() {
        $data = NULL;

        $this->db->select()
            ->from('whats');
        $query = $this->db->get();
        if ($query->num_rows() > 0)    {
            return $query->row();
        }

        return NULL;
    }



    function insert_whats($array) {
        $error = parent::insert($array);
        return TRUE;
    }

    function update_whats($data) {
        $this->db->update('whats',  $data);
        return true;
    }

    function delete_whats($id){
        parent::delete($id);
    }

}

?>