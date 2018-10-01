<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products_m extends MY_Model
{

    protected $_table_name = 'products';
    protected $_primary_key = 'product_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "product_id asc";

    function __construct()
    {
        parent::__construct();
    }

    function get_product($array = NULL, $signal = FALSE)
    {
        $query = parent::get($array, $signal);
        return $query;
    }


    function get_other_products($product_id) {
        $array = array('product_id !=' => $product_id);
        $query = parent::get_where($array);
        return $query;
    }

    function get_all_productsby_sellerid($seller_id) {
        $array = array('seller_id' => $seller_id);
        $query = parent::get_where($array);
        return $query;
    }

    function get_all_productsby_warehouseid($warehouse_id) {
        $array = array('warehouse_id' => $warehouse_id);
        $query = parent::get_where($array);
        return $query;
    }


    function get_all_productsby_categoryid($category_id) {
        $array = array('category_id' => $category_id);
        $query = parent::get_where($array);
        return $query;
    }

    function get_related_products($product_id , $category_id) {
        $array = array('product_id !=' => $product_id  , 'category_id' =>$category_id);
        $query = parent::get_where($array);
        return $query;
    }

    function get_products_cnt($array = NULL, $signal = FALSE)
    {
        $query = parent::get_where($array, $signal);
        return count($query);
    }

    function search_products($array = NULL, $signal = FALSE)
    {
        if(!empty($array)){

            $this->db->select()->from('products')->like($array);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        }
        return NULL;

    }
    function get_order_by_product($array = NULL)
    {
        $query = parent::get_order_by($array);
        return $query;
    }

    function get_single_product($array)
    {
        $query = parent::get_single($array);
        return $query;
    }

    function insert_product($array)
    {
        $error = parent::insert($array);
        return TRUE;
    }

    function update_product($data, $id = NULL)
    {
        parent::update($data, $id);
        return $id;
    }

    function delete_product($id)
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

    public function fetch_products($limit, $start)
    {
        $this->db->limit($limit, $start);
        $query = $this->db->get("extensions");

        $data = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return $data;
    }


    // itbh comment : fix !!!
    function search($search_str, $type)
    {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->like('product_name', $search_str);
        $this->db->where_in('category_id', $type);
        $query = $this->db->get();

        return $query->result();
    }

    // itbh comment : fix !!!
    function get_related_product($relate_arr)
    {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where_in('id', $relate_arr);
        $query = $this->db->get();

        return $query->result();
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

    // itbh comment : add 6-23
    function get_latest_stock($num){
        $this->db->select('*');
        $this->db->from('products');
        $this->db->order_by('registered_date', 'DESC');
        $query = $this->db->get();
        $result = $query->result();
        $res = array();

        for($i = 0 ; $i < $num ; $i ++) {
            array_push($res , $result[$i]);
        }
        return $res;
    }

    function get_best_sellers($num){
        $this->db->select('*');
        $this->db->from('products');
        $this->db->order_by('sold_qty', 'DESC');
        $query = $this->db->get();
        $result = $query->result();
        $res = array();

        for($i = 0 ; $i < $num ; $i ++) {
            array_push($res , $result[$i]);
        }
        return $res;
    }
	

    // itbh comment : smile
    function getProductListByCatId($catId)
    {

        $query=$this->db->get_where('products',array('sub_category_id'=>$catId));
        return $query->result();
    }

    public function get_data($where,$fields,$limit,$start)
    {
        $this->getPaginateInfo($where,$fields,$limit,$start);
    }

    public function count_data()
    {

        return $this->count();
    }

    function getRows($params = array())
    {
        $this->db->select('*');
        $this->db->from('products');
        if(isset($params['sortby'])){
            $this->db->order_by($params['sortby'],'desc');
        }else{
            $this->db->order_by('regular_price','desc');
        }
        if(isset($params['sub_category_id'])&&$params['sub_category_id']>0){
            $this->db->where('sub_category_id',$params['sub_category_id']);
        }

        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }

        $query = $this->db->get();

        return ($query->num_rows() > 0)?$query->result_array():FALSE;
    }

}


?>