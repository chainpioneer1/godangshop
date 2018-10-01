<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Aboutus_m extends MY_Model {

    protected $_table_name = 'aboutus';
    protected $_primary_key = 'aboutus_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "aboutus_id asc";

    function __construct() {
        parent::__construct();
    }

    function get_aboutus($array=NULL) {
        $data = NULL;

        $this->db->select()
            ->from('aboutus');
        $query = $this->db->get();
        if ($query->num_rows() > 0)    {
            return $query->row();
        }

        return NULL;
    }


    function insert_aboutus($array) {
        $error = parent::insert($array);
        return TRUE;
    }

    function update_aboutus($data) {
        $this->db->update('aboutus',  $data);
        return true;
    }

    function delete_aboutus($id){
        parent::delete($id);
    }

}

?>