<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contactus_m extends MY_Model {

    protected $_table_name = 'contactus';
    protected $_primary_key = 'contactus_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "contactus_id asc";

    function __construct() {
        parent::__construct();
    }

    function get_contactus() {
        $data = NULL;

        $this->db->select()
            ->from('contactus');
        $query = $this->db->get();
        if ($query->num_rows() > 0)    {
            return $query->row();
        }

        return NULL;
    }


    function insert_contactus($array) {
        $error = parent::insert($array);
        return TRUE;
    }

    function update_contactus($data) {
        $this->db->update('contactus',  $data);
        return true;
    }

    function delete_contactus($id){
        parent::delete($id);
    }


}

?>