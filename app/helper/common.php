<?php
use Illuminate\Support\Facades\DB;
function prx($arr){
    echo "<pre>";
    print_r($arr);
    die();
}

function getTopNavCat(){
    $result=DB::table('categories')->where(['status'=>0])->get();
 
    $arr=[];
    foreach($result as $row){
        $arr[$row->id]['category_name']=$row->category_name;
        $arr[$row->id]['parent_id']=$row->parent_category;
        $arr[$row->id]['category_slug']=$row->category_slug;


    }
    $html=buildTreeView($arr,0);
    return $html;      
}
$html='';
function buildTreeView($arr,$parent,$level=0,$prelevel=-1){
    global $html;
    foreach($arr as $id=>$data){
        if($parent==$data['parent_id']){
            if($level>$prelevel){
                if($html==''){
                    $html.='<ul class="nav navbar-nav">';
                }else{
                    $html.='<ul class="dropdown-menu"> ';
                }
            }
            if($level==$prelevel){
                $html.='</li>';
            }
            $html.='<li><a href="/category/'.$data['category_slug'].'">'.$data['category_name'].'<span class="caret"></span></a>';
            if($level>$prelevel){
                $prelevel=$level;
            }
            $level++;
            buildTreeView($arr,$id,$level,$prelevel);
            $level--;
        }
    }
    if($level==$prelevel){
        $html.='</li></ul>';
    }
    return $html;
}

function getUserTempId(){
    if(!session()->has('USER_TEMP_ID')){
        $rand=rand(111111111,999999999);
        session()->put('USER_TEMP_ID',$rand);
        return $rand;
    }else{
        return session()->get('USER_TEMP_ID');
    }
}
function getCartTotal(){
    
    if (session()->has('FRONT_USER_LOGIN')) {
        $uid = session()->get('FRONT_USER_Id');
        $user_type = "Reg";
    } else {
        $uid = getUserTempId();
        $user_type = "Non-Reg";
    }
    $result= DB::table('cart')->leftJoin('products', 'products.id', '=', 'cart.product_id')
    ->leftJoin('product_attr', 'product_attr.id', '=', 'cart.product_attr_id')
    ->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')      ->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')->select('products.name','products.id as pid','products.image','colors.color','sizes.size','product_attr.price','cart.qty','product_attr.id as attr_id')->
    where(['user_id' => $uid])->where(['user_type' => $user_type])->get();
    return $result;
}
function apply_coupon_code($coupon_code){
    $result = DB::table('coupons')->where(['code' => $coupon_code])->get();

    $dis_val=0;

    $total = 0;
    $coupon_value='';
    // echo $total;
    // print_r($getCartTotal);
    // die();
    if (isset($result[0])) {
        if ($result[0]->status == 0) {

            if ($result[0]->is_one_time == 1) {
                $staus='error';
                $msg=' coupon code already applied ';
             

             //   return response()->json(['status' => '', 'msg' => '']);
            } else {
                $coupon_val = $result[0]->value;
                $coupon_type = $result[0]->type;
                if ($result[0]->min_order_amt > 0) {
                    $min_order = $result[0]->min_order_amt;
                    $getCartTotal = getCartTotal();
                    $total = 0;
                    //                 echo "<pre>";
                    // print_r($getCartTotal);
                    // die();
                    foreach ($getCartTotal as $list) {
                        $total = $total + ($list->price * $list->qty);
                    }

                    // echo $min_order;
                    // die();
                
                    if ($total > $min_order) {
                        if ($coupon_type == 'value') {
                            $ctotal = $total - $coupon_val;
                            $dis_val=$coupon_val;
                        }
                        if ($coupon_type == 'per') {
                            // echo $coupon_val;
                            $new_price = round(($coupon_val * $total) / 100);
                            $dis_val=$new_price;
                            // echo $total;
                            // die();
                            $ctotal = $total - $new_price;
                        }
                        // echo $total;
                        $staus='success';
                        $msg=' coupon code applied ';
                        $coupon_value=$ctotal;
                       // return response()->json(['status' => '', 'msg' => 'coupon code applied ', 'coupon_value' => $ctotal]);
                    } else {
                        $staus='error';
                        $msg='Your Total Must be Grater ';
                      //  return response()->json(['status' => 'error', 'msg' => 'Your Total Must be Grater']);
                    }
                } else {
                    $staus='success';
                    $msg='coupon code applied ';
                 //   return response()->json(['status' => 'success', 'msg' => 'coupon code applied ']);
                }
            }
        } else {
            $staus='error';
            $msg=' coupon code experied ';
           // return response()->json(['status' => 'error', 'msg' => ' coupon code experied ']);
        }
        //return response()->json(['status' => 'success', 'msg' => 'coupon code applied '])
    } else {
        $staus='error';
        $msg='Please Valid coupon code ';
      //  return response()->json(['status' => 'error', 'msg' => 'Please Valid coupon code ']);
    }
    return json_encode(['status' => $staus, 'msg' => $msg,'coupon_value'=>$coupon_value,'dis_val'=>$dis_val]);


}

?>
