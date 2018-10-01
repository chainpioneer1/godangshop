<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Products extends CI_Controller
{
    public $categories = array();
    private $categoryCnt = 0;
    private $dept = 0;
    private $maxCatNo = 0;

    function __construct()
    {
        parent::__construct();

        $this->load->model("categories_m");
        $this->load->model("contactus_m");
        $this->load->model("products_m");
        $this->load->model("sellers_m");
        $this->load->model("users_m");
        $this->load->model("roles_m");

        $this->load->library("session");
        $language = $this->session->userdata('lang');
        $this->lang->load('products', $language);
        $this->lang->load('base', $language);
        $this->load->library("pagination");

        $this->load->library('Ajax_pagination');
        $this->perPage = 6;

        $this->data['products_primary_categories'] = $this->categories_m->get_categories(array('parent_id' => 0));
        $this->data['primary_categories_cnt'] = $this->categories_m->get_categories_cnt(array('parent_id' => 0));
        $this->categories = $this->categories_m->get_categories();
        $this->categoryCnt = $this->categories_m->get_categories_cnt();
        $this->maxCatNo = $this->categories[$this->categoryCnt - 1]->cat_id;
    }



    public function index()
    {
        $data = array();
        $data['contactus_data'] = $this->contactus_m->get_contactus();
        $this->session->unset_userdata('curCartId');
        $this->session->unset_userdata('activedCatList');
        $sortby=$this->session->userdata('product_sortBy');
        if(!isset($sortby)){
        $sortby='regular_price';
        }

        //total rows count
        $totalRec = count($this->products_m->getRows(array('sub_category_id'=>0)));

        //pagination configuration
        $config['target'] = '#productContent';
        $config['base_url'] = base_url() . 'Products/ajaxPaginationData';
        $config['total_rows'] = $totalRec;
        $config['per_page'] = $this->perPage;
        $this->ajax_pagination->initialize($config);

        //get the posts data
        $data['products'] = $this->products_m->getRows(array('sub_category_id'=>0,'limit' => $this->perPage,'sortby'=>$sortby));
        $data['sortby']=$sortby;

        //  $data['products'] = $this->products_m->get_product();
        $data['page_banner_title'] = $this->lang->line('products');
        $data["subview"] = "products/index";
        $data["controller"] = $this;
        $data["categories"] = $this->categories_m->get_categories();

        $itemList = $this->makeTreeData($this->categories);
        $data['categoryView'] = $this->loadCategoryTree($itemList, 0);
        $this->load->view('_layout_product', $data);
    }

    public function ajaxPaginationData()
    {
        $data['contactus_data'] = $this->contactus_m->get_contactus();
        $sortby=$this->session->userdata('product_sortBy');
        if(!isset($sortby)){
        $sortby='regular_price';
        }
        $page = $this->input->post('page');
        if (!$page) {
            $offset = 0;
        } else {
            $offset = $page;
        }

        //total rows count

        $totalRec = count($this->products_m->getRows());

        //pagination configuration
        $config['target'] = '#productContent';

        $config['base_url'] = base_url() . 'products/ajaxPaginationData';


        $config['total_rows'] = $totalRec;
        $config['per_page'] = $this->perPage;
        $this->ajax_pagination->initialize($config);

        //get the posts data
        $data['products'] = $this->products_m->getRows(array('sortby'=>$sortby,'start' => $offset, 'limit' => $this->perPage));

        $data["controller"] = $this;
        $data['sortby']=$sortby;

        $itemList = $this->makeTreeData($this->categories);

        $data['categoryView'] = $this->loadCategoryTree($itemList, 0);
        $this->load->view('products/index', $data);
    }

    public function ajaxPaginationEachCartData()
    {
        $sortby=$this->session->userdata('product_sortBy');
        if(!isset($sortby)){
        $sortby='regular_price';
        }
        $page = $this->input->post('page');

        if (!$page) {
            $offset = 0;
        } else {
            $offset = $page;
        }

        //total rows count
        $curCartId=$this->session->userdata('curCartId');

        $totalRec = count($this->products_m->getRows(array('sub_category_id'=>$curCartId)));

        //pagination configuration
        $config['target'] = '#productContent';

        $config['base_url'] = base_url() . 'products/ajaxPaginationEachCartData';


        $config['total_rows'] = $totalRec;
        $config['per_page'] = $this->perPage;
        $this->ajax_pagination->initialize($config);

        //get the posts data
        $data['products'] = $this->products_m->getRows(array('sortby'=>$sortby,'sub_category_id'=>$curCartId,'start' => $offset, 'limit' => $this->perPage));

        $data["controller"] = $this;
        $data['sortby']=$sortby;

        $itemList = $this->makeTreeData($this->categories);
        $data['contactus_data'] = $this->contactus_m->get_contactus();
        $data['categoryView'] = $this->loadCategoryTree($itemList, 0);
        $this->load->view('products/index', $data);
    }

    public function view($product_id)
    {
        $itemList = $this->makeTreeData($this->categories);

        $this->data['categoryView'] = $this->loadCategoryTree($itemList, 0);
        $this->data['contactus_data'] = $this->contactus_m->get_contactus();
        $this->data['page_banner_title'] = $this->lang->line('product_detail');
        $product = $this->products_m->get_single_product(array('product_id' => $product_id));
        $category_id = $product->category_id;
        $this->data['related_products'] = $this->products_m->get_related_products($product_id, $category_id);
        $seller_id = $product->seller_id;
        $this->data['seller'] = $this->sellers_m->get_single_seller(array('seller_id' => $seller_id));
        $this->data['product'] = $product;
        $this->data['controller'] = $this;
        $this->data["subview"] = "products/view";
        $this->load->view('_layout_product', $this->data);
    }

    public function makeTreeData($itemlist)
    {
        $refs = array();
        $list = array();
        foreach ($itemlist as $item) {
            if (($this->session->userdata('lang')) == '' ){
                $lang_tmp = 'english';
            } else {
                $lang_tmp = $this->session->userdata('lang');
            }
            $tmp = 'name_'.$lang_tmp;
            $thisref = &$refs[$item->cat_id];
            $thisref['menu_parent_id'] = $item->parent_id;
            $thisref['menu_item_name'] = $item->$tmp;
            $thisref['menu_item_id'] = $item->cat_id;
            if ($item->parent_id == 0) {
                $list[$item->cat_id] =& $thisref;
            } else {
                $refs[$item->parent_id]['children'][$item->cat_id] =& $thisref;
            }
        }
        return $list;
    }

    public function loadCategoryTree($itemlist, $level)
    {
        $activedCatList=$this->session->userdata('activedCatList');
        $paddingVal = 30 * (int)$level;
        if ($this->dept == 0) {
            $html = '<ul class="nav" id="side-menu" style="padding-left:' . $paddingVal . 'px">';
        } else {
            $html = '<ul class="nav" style="padding-left:' . $paddingVal . 'px">';
        }
        foreach ($itemlist as $key => $v) {

            if (array_key_exists('children', $v)) {
                if(isset($activedCatList) && in_array($v["menu_item_id"],$activedCatList)){
                    $html .= '<li class="active">';
                    }else{
                    $html .= '<li>';
                    }
                $html .= '<a style="color: #333;" href="#">' . $v["menu_item_name"] . '<span class="caret" style="float:right; margin-top:10px;"></span></a>';
                $html .= $this->loadCategoryTree($v['children'], (int)$level + 1);
                $html .= "</li>\n";
            } else {

                    if(isset($activedCatList) && in_array($v["menu_item_id"],$activedCatList)){
                    $html .= '<li class="active">';
                    }else{
                    $html .= '<li>';
                    }
                    $html .= "<a style='color: #333;' href='javascript: getProduct(" . $v['menu_item_id'] . ")'>" . $v["menu_item_name"] . "</a></li>\n";

            }
        }
        $this->dept++;
        return $html . "</ul>\n";
    }

    public function getProductByCatId()
    {
       $sortby=$this->session->userdata('product_sortBy');
        if(!isset($sortby)){
        $sortby='regular_price';
        }

        $data = array();
        //total rows count
        $cartId=$_GET['curCartId'];
        $category=$this->categories_m->get_single_category(array('cat_id'=>$cartId));
        $pCartId=$category->parent_id;
        $activedCatList=array();
        array_push($activedCatList,$cartId);
        while(intval($pCartId)!=0){
            array_push($activedCatList,$pCartId);
            $category=$this->categories_m->get_single_category(array('cat_id'=>$pCartId));
            if(empty($category)) break;
            $pCartId=$category->parent_id;
        }
        $prevList=$this->session->userdata('activedCatList');
        if(isset($prevList)){
        $this->session->unset_userdata('activedCatList');
        }
        $this->session->set_userdata('activedCatList', $activedCatList);
        $this->session->set_userdata('curCartId',$cartId);

        $totalRec = count($this->products_m->getRows(array('sub_category_id'=>$cartId)));

        //pagination configuration
        $config['target'] = '#productContent';
        $config['base_url'] = base_url() . 'Products/ajaxPaginationEachCartData';

        $config['total_rows'] = $totalRec;
        $config['per_page'] = $this->perPage;
        $this->ajax_pagination->initialize($config);

        //get the posts data
        $data['contactus_data'] = $this->contactus_m->get_contactus();
        $data['curCartId']=$cartId;
        $data['products'] = $this->products_m->getRows(array('sortby'=>$sortby,'limit' => $this->perPage,'sub_category_id'=>$cartId));

        $data["subview"] = "products/index";
        $data["controller"] = $this;
        $data['sortby']=$sortby;
        $itemList = $this->makeTreeData($this->categories);
        $data['page_banner_title'] = $this->lang->line('products');
        $data['categoryView'] = $this->loadCategoryTree($itemList, 0);
        $data["categories"] = $this->categories_m->get_categories();
        $this->load->view('_layout_product', $data);
    }


    // itbh comment : print products
    public function print_products($products)
    {
        $output = '';
        $i = 0;
        ?>


        <?php
        if (!empty($products)){
            foreach ($products as $product) {
                if (($this->session->userdata('lang')) == '' ){
                    $lang_tmp = 'english';
                } else {
                    $lang_tmp = $this->session->userdata('lang');
                }
                $tmp = 'name_'.$lang_tmp;
                $tmp2 = 'product_name_'.$lang_tmp;
                ob_start();
                ?>
                    <div class="col-lg-4  col-md-4 col-sm-4 col-xs-6 product-elem">
                        <div class="thumbnail" style="height: 300px;">
                            <a href="<?= base_url('products/view/') . '/' . $product['product_id']; ?> "><img style="width: 125px; height: 125px; padding: 5px; "
                                    src="<?= site_url("uploads/images/") . '/' . $product['img_url'] ?>"></a>

                            <div class="caption" style="text-align: center; padding: 10px; overflow-y: hidden;overflow-x: hidden; ">
                                <p><a style="color: black;" href="<?= base_url('products/view/') . '/' . $product['product_id']; ?> "
                                       class="product-elem-name"><?= $product[$tmp2]; ?></a></p>

                                <p class="product-elem-category"><?php
                                    $category = $this->categories_m->get_category(array('category_id' => $product['category_id']));
                                    if (!empty($category)) {
                                    if (($this->session->userdata('lang')) == '' ){
                                        $lang_tmp = 'english';
                                    } else {
                                        $lang_tmp = $this->session->userdata('lang');
                                    }
                                        $tmp = 'name_'.$lang_tmp;
                                        echo $category->$tmp;
                                    }
                                    ?></p>

                                <p class="product-item-price">
                                    <span><?= $product['regular_price'] ?></span><?= $this->lang->line('currency'); ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <?php
                }
                ?>

                <div class="row">
        <div class="col-lg-offset-8 col-lg-4 col-md-offset-8 col-md-4 col-sm-offset-6 col-sm-6 col-xs-offset-4 col-xs-8" style="float: right; font-weight: bold; font-size: larger">
        <?php echo $this->ajax_pagination->create_links(); ?></div>
            </div>
<?php




        } else echo ('<tr><td colspan="3"><h2 style="text-align: center;color: #ff5f2a;">'.$this->lang->line('no_exist_product').'</h2></td></tr>');
        ?></div>

        <?php
        return $output;
    }

    public function getProductBySort()
    {
        $sortBy=$_POST['sortBy'];

        $flag=$this->session->set_userdata('product_sortBy',$sortBy);
        return $flag;
    }

    public function products_list(){
        $this->data['contactus_data'] = $this->contactus_m->get_contactus();
        $this->data['page_banner_title'] = $this->lang->line('list');
        $this->data["test"] = $this->products_m->get_latest_stock(4);
        $this->data["categories"] = $this->categories_m->get_categories();
        $this->data["controller"] = $this;
        $this->data["subview"] = "products/products_list";
        $this->load->view('_layout_main', $this->data);

    }


    public function products_bank(){
        $this->data['contactus_data'] = $this->contactus_m->get_contactus();
        $this->data['page_banner_title'] = $this->lang->line('list');
        $this->data["categories"] = $this->categories_m->get_categories();
        $this->data["controller"] = $this;
        $this->data["subview"] = "products/products_bank";
        $this->load->view('_layout_main', $this->data);

    }

    public function get_products_list(){
        $this->data['contactus_data'] = $this->contactus_m->get_contactus();
        if (($this->session->userdata('lang')) == '' ){
            $lang_tmp = 'english';
        } else {
            $lang_tmp = $this->session->userdata('lang');
        }
        $tmp1 = 'name_'.$lang_tmp;
        $tmp2 = 'product_name_'.$lang_tmp;
        if($_POST['category_id'] == "")
		{
			$message = "failed";
		}
		else
		{
			$category_id = $_POST['category_id'];
			$products = $this->products_m->get_all_productsby_categoryid($category_id);
			$message = '';
			if (!empty($products)) {
			    foreach( $products as $product ){

			        $message = $message."<tr style='border-bottom: solid 1px #ddd;'>".
                        "<td style='text-align:center; min-width: 60px; padding: 5px;'>"."<a href='".base_url('products/view/').'/'.$product->product_id."'>".
                        "<img class='' style='width: 75px; height: 75px; padding:3px;'
                        src = '".site_url("uploads/images/").'/'.$product->img_url.
                        "'
                        />"."</a>".
                        "</td>".
                        "<td style='text-align: center;'><a href='".(base_url('products/view/').'/'.$product->product_id)."'><p><span class='home-product-tbl-span' >".$product->$tmp2."</span></p></a></td>".
                        "<td style='text-align: center; margin: 8px auto;'>".
                        "<p><span class='home-product-tbl-span'>".$product->market_price."</span></p>".
                        "</td>".
                        "<td style='text-align: center; margin: 8px auto;'>".
                        "<p><span class='home-product-tbl-span'>".$product->regular_price."</span></p>".
                        "</td>".
                        "<td style='text-align: center; margin: 8px auto;'>".
                        "<p><span class='home-product-tbl-span' style='color: #67b20d; '>";

                        $market = $product->market_price;
                        $regular = $product->regular_price;
                        if ($market > 0){
                            $pp = ($market - $regular) / $market * 100;
                            $message = $message.round($pp).'<span>&percnt;</span>';
                        } else $message = $message. ($this->lang->line('not_found'));
                        $message = $message."</span></p></td></span></p> ".
                        "</td>".
			        "</tr>";
			    }
			    echo $message;
            }else {

            echo ('<tr><td colspan="5"><h2 style="text-align: center;color: #ff5f2a;">'.$this->lang->line('no_exist_product').'</h2></td></tr>');
            }
        }
    }

    public function get_products_bank(){
    if (($this->session->userdata('lang')) == '' ){
            $lang_tmp = 'english';
        } else {
            $lang_tmp = $this->session->userdata('lang');
        }
    $tmp1 = 'name_'.$lang_tmp;
        $tmp2 = 'product_name_'.$lang_tmp;

    if($_POST['category_id'] == "")
		{
			$message = "failed";
		}
		else
		{
			$category_id = $_POST['category_id'];
			$products = $this->products_m->get_all_productsby_categoryid($category_id);
			$message = '';
			if (!empty($products)) {
			    $message = '';
                foreach( $products as $product){
                    $desc = '';
                    ob_start()
                    ?>
                    <tr style="border-bottom: solid 1px #ddd;">
                        <td style="padding: 0 30px;"><a href="<?=base_url('products/view/').'/'.$product->product_id;?> ">
                            <img class="home-lastest-product-item-img" style="width: 72px; height: 72px; padding: 5px;" src="<?=site_url("uploads/images/").'/'.$product->img_url?>"></a></td>
                        <td style="text-align: center;"><a href="<?=base_url('products/view/').'/'.$product->product_id;?>"><p><span class="home-product-tbl-span" ><?=$product->$tmp2; ?></span></p></a></td>
                        <td style="text-align: center;"><p><span class="home-product-tbl-span"><?=$product->regular_price; ?></span></p></td>
                        <td style="text-align: center;">
                                <img src="<?= site_url('assets/images/icons/8_save_product.png') ?>"
                                     style="width: 30px; height: 30px; display: inline-block;">

                                <p style="display: inline-block" )"><span>8</span> &percnt; Finance for 6 Month</p>
                                <div class="clearfix"></div>
                                <img src="<?= site_url('assets/images/icons/12_save_product.png') ?>"
                                     style="width: 30px; height: 30px; display: inline-block;">

                                <p style="display: inline-block" )"><span>12</span> &percnt; Finance for 12 Month</p>
                        </td>
                        <td style="text-align: center;"><p><span class="home-product-tbl-span" style="color: #67b20d; ">
                            <a style="padding: auto; " class="btn btn-primary" href="<?=base_url('products/view/').'/'.$product->product_id;?> "><?=$this->lang->line('add_to_cart')?></a>
                        </td>
                    </tr>
                    <?php
                }   echo $message;
            }else {
                echo ('<tr><td colspan="5"><h2 style="text-align: center;color: #ff5f2a;">'.$this->lang->line('no_exist_product').'</h2></td></tr>');
            }
        }
    }

    public function print_products_list($products){
        $output = '';
        if (($this->session->userdata('lang')) == '' ){
            $lang_tmp = 'english';
        } else {
            $lang_tmp = $this->session->userdata('lang');
        }
        $tmp1 = 'name_'.$lang_tmp;
        $tmp2 = 'product_name_'.$lang_tmp;
		foreach( $products as $product){
			$desc = '';
			ob_start()
			?>
			<tr style="border-bottom: solid 1px #ddd;">
                <td style="text-align:center; min-width: 60px; padding: 5px;"><a href="<?=base_url('products/view/').'/'.$product->product_id;?> ">
                    <img class="home-lastest-product-item-img" style="width: 72px; height: 72px;" src="<?=site_url("uploads/images/").'/'.$product->img_url?>"></a></td>
                <td style="text-align: center;"><a style="color: #333; text-decoration: none;" href="<?=base_url('products/view/').'/'.$product->product_id;?>"><p><span class="home-product-tbl-span" ><?=$product->$tmp2; ?></span></p></a></td>
                <td style="text-align: center;"><p><span class="home-product-tbl-span"><?=$product->market_price; ?></span></p></td>
                <td style="text-align: center;"><p><span class="home-product-tbl-span" style="color: #fc960d; "><?=$product->regular_price; ?></span></p></td>
                <td style="text-align: center;color: #67b20d;">
                <p>
                    <span class="home-product-tbl-span" style="color: #67b20d; ">
                        <?php
                            $regular =$product->regular_price;
                            $market = $product->market_price;
                            if ($market > 0){
                                $pp = ($market - $regular) / $market * 100;
                                echo (round($pp));
                                echo('<span>&percnt;</span>');
                            } else echo ($this->lang->line('not_found'));

                        ?>
                    </span>
                    </p>
                </td>
            </tr>
			<?php
		}

		return $output;
    }

    public function print_products_bank($products){
        $output = '';
        if (($this->session->userdata('lang')) == '' ){
            $lang_tmp = 'english';
        } else {
            $lang_tmp = $this->session->userdata('lang');
        }
        $tmp1 = 'name_'.$lang_tmp;
        $tmp2 = 'product_name_'.$lang_tmp;
		foreach( $products as $product){
			$desc = '';
			ob_start()
			?>
			<tr style="border-bottom: solid 1px #ddd;">
                <td style="padding: 0 30px;"><a href="<?=base_url('products/view/').'/'.$product->product_id;?> ">
                    <img class="home-lastest-product-item-img" style="width: 72px; height: 72px; padding: 5px;" src="<?=site_url("uploads/images/").'/'.$product->img_url?>"></a></td>
                <td style="text-align: center;"><a href="<?=base_url('products/view/').'/'.$product->product_id;?>"><p><span class="home-product-tbl-span" ><?=$product->$tmp2; ?></span></p></a></td>
                <td style="text-align: center;"><p><span class="home-product-tbl-span"><?=$product->regular_price; ?></span></p></td>
                <td style="text-align: center;">
                        <img src="<?= site_url('assets/images/icons/8_save_product.png') ?>"
                             style="width: 30px; height: 30px; display: inline-block;">

                        <p style="display: inline-block" )"><span>8</span> &percnt; Finance for 6 Month</p>
                        <div class="clearfix"></div>
                        <img src="<?= site_url('assets/images/icons/12_save_product.png') ?>"
                             style="width: 30px; height: 30px; display: inline-block;">

                        <p style="display: inline-block" )"><span>12</span> &percnt; Finance for 12 Month</p>
                </td>
                <td style="text-align: center;"><p><span class="home-product-tbl-span" style="color: #67b20d; ">
                    <a style="padding: auto; background-color: #fc960d; " class="btn btn-warning" href="<?=base_url('products/view/').'/'.$product->product_id;?> "><?=$this->lang->line('add_to_cart')?></a>
                </td>
            </tr>
			<?php
		}

		return $output;
    }


}

?>