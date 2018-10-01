<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reviews_m extends MY_Model
{

    protected $_table_name = 'reviews';
    protected $_primary_key = 'review_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "review_id asc";

    function __construct()
    {
        parent::__construct();
    }

    function get_review($array = NULL, $signal = FALSE)
    {
        $query = parent::get($array, $signal);
        return $query;
    }

    function get_reviewsbywarehouse_id($warehouse_id)
    {
        $array = array('warehouse_id' => $warehouse_id);
        $query = parent::get_where($array);
        return $query;
    }

    function get_reviews_cnt($array = NULL, $signal = FALSE)
    {
        $query = parent::get_where($array, $signal);
        return count($query);
    }

    function get_order_by_review($array = NULL)
    {
        $query = parent::get_order_by($array);
        return $query;
    }

    function get_single_review($array)
    {
        $query = parent::get_single($array);
        return $query;
    }

    function insert_review($array)
    {
        $error = parent::insert($array);
        return TRUE;
    }

    function update_review($data, $id = NULL)
    {
        parent::update($data, $id);
        return $id;
    }

    function delete_review($id)
    {
        parent::delete($id);
    }

    function hash($string)
    {
        return parent::hash($string);
    }

    public function record_count()
    {
        return $this->db->count_all("extensions");
    }

    public function fetch_reviews($limit, $start)
    {
        $this->db->limit($limit, $start);
        $query = $this->db->get("reviews");

        $data = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return $data;
    }


    function bulk_update($data, $ids)
    {
        $this->db->set($data);
        $this->db->where_in($this->_primary_key, $ids);
        $this->db->update($this->_table_name);
    }

    function bulk_delete($ids)
    {
        $this->db->where_in($this->_primary_key, $ids);
        $this->db->delete($this->_table_name);
    }

    function search_reviews($array = NULL, $signal = FALSE)
    {
        if(!empty($array)){

            $this->db->select()->from('reviews')->like($array);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        }
        return NULL;

    }

}


?>