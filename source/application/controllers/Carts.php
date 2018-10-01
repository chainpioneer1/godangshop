<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Carts extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model("categories_m");
        $this->load->model("contactus_m");
        $this->load->model("users_m");
        $this->load->model("roles_m");
        $this->load->model("products_m");
        $this->load->model("carts_m");
        $this->load->model("orders_m");
        $this->load->model("Seller_orders_m");
        $this->load->model("faqs_m");

        $this->load->library("session");
        $language = $this->session->userdata('lang');
        $this->lang->load('products', $language);
        $this->lang->load('base', $language);
        $this->lang->load('signin', $language);
        $this->load->library("pagination");

        $this->data['products_primary_categories'] = $this->categories_m->get_categories(array('parent_id' => 0));
        $this->data['primary_categories_cnt'] = $this->categories_m->get_categories_cnt(array('parent_id' => 0));
    }


    public function index()
    {
        $this->data['contactus_data'] = $this->contactus_m->get_contactus();
        $this->data['page_banner_title'] = $this->lang->line('cart');
        $this->data["subview"] = "carts/index";
        $this->data["controller"] = $this;
        $cartdata = $this->session->userdata('cartdata');
        if (isset($cartdata)) {
            $this->data["cartsInfo"] = $cartdata;
        } else {
            $cartdata = array();
            $this->session->set_userdata('cartdata',$cartdata);
            $this->session->set_userdata('cartNum', 0);
            $this->data["cartsInfo"] = $cartdata;
        }

        $this->load->view('_layout_main', $this->data);
    }

    public function view($faq_id)
    {

        $this->data['contactus_data'] = $this->contactus_m->get_contactus();
        $this->data["subview"] = "carts/index";
        $this->load->view('_layout_main', $this->data);
    }

    public function add_to_cart()
    {
        $this->data['contactus_data'] = $this->contactus_m->get_contactus();
        $param = explode(':', $_POST['info']);
        $user_id = $this->session->userdata("loginuserID");
        //$flag=$this->carts_m->addProduct2Cart($param,$user_id);
        $tmp = array();
        $tmp['product_id'] = $param[0];
        $tmp['product_qty'] = $param[1];
        $tmp['product_sellerId'] = $param[2];
        $userData = $this->session->userdata;
        $tt = $userData['cartdata'];
        $catNum = $userData['cartNum'];
        if (!isset($tt)) {
            $tt = array();
            $catNum = 0;
        }
        array_push($tt, $tmp);
        $catNum += $tmp['product_qty'];
        $flag = $this->session->set_userdata('cartdata', $tt);
        $this->session->set_userdata('cartNum', $catNum);
        if ($flag == true) {
            $result = 'success';

        } else {
            $result = 'fail';
        }
        echo $result;
    }


    public function print_cart_products()
    {

        if (($this->session->userdata('lang')) == '' ){
            $lang_tmp = 'english';
        } else {
            $lang_tmp = $this->session->userdata('lang');
        }
        $tmp1 = 'name_'.$lang_tmp;
        $tmp2 = 'product_name_'.$lang_tmp;
        $output = '';
        $customerId = $this->session->userdata('loginuserID');
        /*$temps = $this->carts_m->getCartInfo($customerId);*/
        $temps = $this->session->userdata['cartdata'];
        $index = 0;

        foreach ($temps as $temp) {

            $product_id = $temp['product_id'];
            $product_qty = $temp['product_qty'];
            $sql = array();
            $sql['product_id'] = $product_id;
            $product = $this->products_m->get_single_product($sql);
            $tmp_id = $this->lang->line('not_found');
            $tmp_img = $this->lang->line('not_found');
            $tmp_name = $this->lang->line('not_found');
            $tmp_price = $this->lang->line('not_found');
            $tmp_total = $this->lang->line('not_found');
            if (!empty($product)) {
                $tmp_id = $product->product_id;
                $tmp_img = $product->img_url;
                $tmp_name = $product->$tmp2;
                $tmp_price = $product->regular_price;
                $tmp_total = intval($tmp_price) * intval($product_qty);
                $tmp_shipping = intval($product->shipping);
                $tmp_shipping_total = intval($tmp_price) * $tmp_shipping / 100 * intval($product_qty);
            }
            ob_start()
            ?>
            <tr class="odd gradeX itbh-sellers-products-tbl" id="product-item-<?= $tmp_id; ?>">
                <td style="display: none;"><?= $index ?></td>
                <td style="display: none;"><?= $tmp_id ?></td>
                <td><a href="<?= base_url('products/view/' . $tmp_id) ?>"><img
                            class="itbh-sellers-products-singlie-item"
                            src="<?= site_url('uploads/images/' . '/' . $tmp_img) ?>"></a></td>
                <td style="padding: 20px;"><?= $tmp_name ?></td>
                <td style="padding: 20px;"><?= $tmp_price ?></td>
                <td style="padding: 20px;"><input type="number" min="1" max="<?= $product->quantity ?>"
                                                  value="<?= $product_qty ?>"></td>
                <td style="padding: 20px;"><?= $tmp_total ?></td>
                <td style="padding: 20px;">
                    <span style="font-size: 36px; color: #888;"
                          class="glyphicon glyphicon-remove itbh-sellers-products-price-remove"></span>
                </td>


            </tr>
            <?php
            $index++;
        }

    }

    public function removeCart()
    {

        $index = $_POST['index'];
        $tmp = $this->session->userdata['cartdata'];
        if (count($tmp) == 1) {
            $flag = $this->session->unset_userdata('cartdata');
            $tt = array();
            $flag = $this->session->set_userdata('cartdata', $tt);
            $this->session->set_userdata('cartNum', 0);
        } else {
            $cart = $tmp[$index];
            $tt = array_splice($tmp, $index-1, 1);
            //$this->session->unset_userdata('cartdata');
            $flag = $this->session->set_userdata('cartdata', $tt);
            $ncarts = $this->session->userdata('cartNum');
            $this->session->set_userdata('cartNum', (int)$ncarts - (int)$cart['product_qty']);
        }

        if ($flag == true) {
            $result = 'success';
        } else {
            $result = 'fail';
        }
        return $result;
    }

    public function updataCartList()
    {

        $qttyList = explode(',', $_POST['qttyList']);
        $tmp = $this->session->userdata['cartdata'];
        $cartNum = 0;
        for ($i = 0; $i < count($qttyList); $i++) {
            $tmp[$i]['product_qty'] = $qttyList[$i];
            $cartNum += $qttyList[$i];
        }
        $flag = $this->session->set_userdata('cartdata', $tmp);
        $this->session->set_userdata('cartNum', $cartNum);
        if ($flag == true) {
            $result = 'success';
        } else {
            $result = 'fail';
        }
        return $result;
    }

    function checkout()
    {
        $this->data['contactus_data'] = $this->contactus_m->get_contactus();
        $this->data['page_banner_title'] = $this->lang->line('check_out');
        $this->data["subview"] = "carts/checkout";
        $this->data["controller"] = $this;
        $cartdata = $this->session->userdata('cartdata');
        if (isset($cartdata)) {
            $this->data["cartsInfo"] = $cartdata;
        } else {
            $cartdata = array();
            $this->session->set_userdata('cartdata', $cartdata);
            $this->session->set_userdata('cartNum', 0);
            $this->data["cartsInfo"] = $cartdata;
        }
        $this->load->view('_layout_main', $this->data);

    }

    public function print_checkout_products()
    {
        if (($this->session->userdata('lang')) == '' ){
            $lang_tmp = 'english';
        } else {
            $lang_tmp = $this->session->userdata('lang');
        }
        $tmp1 = 'name_'.$lang_tmp;
        $tmp2 = 'product_name_'.$lang_tmp;
        $output = '';
        $customerId = $this->session->userdata('loginuserID');
        /*$temps = $this->carts_m->getCartInfo($customerId);*/
        $temps = $this->session->userdata['cartdata'];
        $index = 0;

        $subtotal = 0;
        $shippingtotal = 0;
        $ordertotal = 0;

        foreach ($temps as $temp) {

            $product_id = $temp['product_id'];
            $product_qty = $temp['product_qty'];
            $sql = array();
            $sql['product_id'] = $product_id;
            $product = $this->products_m->get_single_product($sql);
            $tmp_id = $this->lang->line('not_found');
            $tmp_name = $this->lang->line('not_found');
            $tmp_price = $this->lang->line('not_found');
            $tmp_total = $this->lang->line('not_found');
            if (!empty($product)) {
                $tmp_id = $product->product_id;
                $tmp_name = $product->$tmp2;
                $tmp_price = $product->regular_price;
                $tmp_total = intval($tmp_price) * intval($product_qty);
                $subtotal += $tmp_total;
                $tmp_shipping = intval($product->shipping);
                $tmp_shipping_total = intval($tmp_price) * $tmp_shipping / 100 * intval($product_qty);
                $shippingtotal += $tmp_shipping_total;
            }
            ob_start();
            ?>
            <tr class="odd gradeX itbh-sellers-products-tbl" id="product-item-<?= $tmp_id; ?>">
                <td style="padding: 20px;"><?= $tmp_name ?></td>
                <td style="padding: 20px;"><?= $product_qty ?></td>
                <td style="padding: 20px;"><?= $tmp_total ?></td>
            </tr>

            <?php
            $index++;
            $ordertotal=$subtotal+$shippingtotal;
        } ?>
        <tr class="odd gradeX itbh-sellers-products-tbl">
            <td style="padding: 20px;"><?= $this->lang->line('cart_subtotal') ?></td>
            <td></td>
            <td style="padding: 20px;"><?= $subtotal ?></td>
        </tr>
        <tr class="odd gradeX itbh-sellers-products-tbl">
            <td style="padding: 20px;"><?= $this->lang->line('shipping') ?></td>
            <td></td>
            <td style="padding: 20px;"><?= $shippingtotal ?></td>
        </tr>
        <tr class="odd gradeX itbh-sellers-products-tbl">
            <td style="padding: 20px;"><?= $this->lang->line('ordertotal') ?></td>
            <td></td>
            <td style="padding: 20px; color: #fc960d;"><?= $ordertotal ?></td>
        </tr>
        <?php

    }

    public function print_sub_info()
    {

    }

    public function placeorder()
    {
        $this->data['contactus_data'] = $this->contactus_m->get_contactus();
        //$ordername=$_GET['ordername'];
        if (($this->session->userdata('lang')) == '' ){
            $lang_tmp = 'english';
        } else {
            $lang_tmp = $this->session->userdata('lang');
        }
        $tmp1 = 'name_'.$lang_tmp;
        $tmp2 = 'product_name_'.$lang_tmp;
        $logged_userId = $this->session->userdata('loginuserID');
        $orderNote=$_GET['note'];
        $this->data['page_banner_title'] = $this->lang->line('thank_you');
        $this->data["subview"] = "carts/thanks";
        $cartdatas = $this->session->userdata('cartdata');
        $buf = array();
        $param=array();
        //$param['order_name']=$ordername;
        $param['user_id']= $logged_userId;
        $param['total']=0;
        $param['shipping']=0;
        $param['order_total']=0;
        $sellerIdList=array();
        $seller_order=array();
        foreach ($cartdatas as $data) {
            array_push($sellerIdList, $data['product_sellerId']);
            $tmp=array();
            $tmp['product_id'] = $data['product_id'];
            $product = $this->products_m->get_single_product( array('product_id'=>$data['product_id']));
            $tmp['product_name']=$product->$tmp2;
            $tmp['product_qty']=$data['product_qty'];
            $tmp['product_subtotal']=(int)$product->regular_price*(int)$data['product_qty'];
            $param['total']+=$tmp['product_subtotal'];

            $each_shipping=intval($product->regular_price) * intval($product->shipping)/ 100 * intval($data['product_qty']);
            $param['shipping']+=$each_shipping;
            $tmp['warehouse_id']=$product->warehouse_id;
            array_push($buf,$tmp);
        }
        $param['order_total']=$param['total']+$param['shipping'];
        $products=json_encode($buf);
        $param['products']=$products;
        $param['notes']=$orderNote;
        $param['order_status']='waiting';
        $param['registered_date']=date('Y-m-d');
        $orderid=$this->orders_m->insert_order($param);

        //seller_orders --- insert --------------

        $uniqSellerList=array_unique($sellerIdList);
        foreach($uniqSellerList as $SellerId)
        {
            $buf=array();
            $param=array();
            $param['order_id']=$orderid;
            //$param['order_name']=$ordername;
            $param['user_id']=$logged_userId;
            $param['total']=0;
            $param['shipping']=0;
            $param['order_total']=0;
            $param['seller_id']=$SellerId;

            foreach($cartdatas as $data)
            {
                if($data['product_sellerId']==$SellerId)
                {
                    $tmp=array();
                    $tmp['product_id'] = $data['product_id'];
                    $product = $this->products_m->get_single_product( array('product_id'=>$data['product_id']));
                    $tmp['product_name']=$product->$tmp2;
                    $tmp['product_qty']=$data['product_qty'];
                    $tmp['product_subtotal']=(int)$product->regular_price*(int)$data['product_qty'];
                    $param['total']+=$tmp['product_subtotal'];

                    $each_shipping=intval($product->regular_price) * intval($product->shipping)/ 100 * intval($data['product_qty']);
                    $param['shipping']+=$each_shipping;
                    $tmp['warehouse_id']=$product->warehouse_id;
                    array_push($buf,$tmp);
                }
            }
            $param['order_total']=$param['total']+$param['shipping'];
            $products=json_encode($buf);
            $param['products']=$products;
            $param['notes']=$orderNote;
            $param['order_status']='waiting';
            $param['registered_date']=date('Y-m-d');
            $this->Seller_orders_m->insert_order($param);
        }
        $this->session->set_userdata('cartNum',0);
        $this->data['order_number']=$orderid;
        $this->data['date']=date('Y-m-d');
        $this->data['total']=$param['total'];


        log_message('info' , var_export($this->session->userdata('cartdata') , true));
        $blank  = array();
        $this->session->set_userdata('cartdata' , $blank);
        log_message('info' , var_export($this->session->userdata('cartdata') , true));
        $this->load->view('_layout_main', $this->data);
    }

}


?>