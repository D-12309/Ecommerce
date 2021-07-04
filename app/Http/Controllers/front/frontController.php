<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Crypt;
use Mail;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\Environment\Console;

class frontController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $result['home_category'] = DB::table('categories')->where(['status' => 0])->where(['is_check' => 1])->get();
        $result['brand'] = DB::table('brands')->where(['status' => 0])->get();
        // echo "<pre>";
        // print_r($result);
        // die();

        foreach ($result['home_category'] as $list) {
            $result['home_category_product'][$list->id] = DB::table('products')->where(['status' => 0])->where(['category_id' => $list->id])->get();


            foreach ($result['home_category_product'][$list->id] as $list1) {
                $result['home_product_attr'][$list1->id] = DB::table('product_attr')->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')->where(['product_attr.product_id' => $list1->id])->get();
            }
            //

        }


        $result['home_category_feature'][$list->id] = DB::table('products')->where(['status' => 0])->where(['is_featured' => 1])->get();


        foreach ($result['home_category_feature'][$list->id] as $list1) {
            $result['home_product_attr'][$list1->id] = DB::table('product_attr')->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')->where(['product_attr.product_id' => $list1->id])->get();
        }

        $result['home_category_discount'][$list->id] = DB::table('products')->where(['status' => 0])->where(['is_discounted' => 1])->get();


        foreach ($result['home_category_discount'][$list->id] as $list1) {
            $result['home_product_attr'][$list1->id] = DB::table('product_attr')->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')->where(['product_attr.product_id' => $list1->id])->get();
        }
        $result['home_category_trading'][$list->id] = DB::table('products')->where(['status' => 0])->where(['id_tranding' => 1])->get();
        // echo "<pre>";
        // print_r($result);
        // die();

        foreach ($result['home_category_trading'][$list->id] as $list1) {
            $result['home_product_attr'][$list1->id] = DB::table('product_attr')->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')->where(['product_attr.product_id' => $list1->id])->get();
        }
        // echo "<pre>";
        // print_r($result);
        // die();
        $result['banner'] = DB::table('banners')->where(['status' => 0])->get();
        // echo "<pre>";
        // print_r($result['banner']);
        // die();


        return view('front.index', $result);
    }
    public function product(Request $request, $id)
    {
        $result['product'] = DB::table('products')->where(['status' => 0])->where(['id' => $id])->get();
        foreach ($result['product'] as $list1) {
            $result['home_product_attr'][$list1->id] = DB::table('product_attr')->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')->where(['product_attr.product_id' => $list1->id])->get();
        }
        foreach ($result['product'] as $list1) {
            $result['image_attr'][$list1->id] = DB::table('product_images')->where(['product_images.product_id' => $list1->id])->get();
        }
        // echo "<pre>";
        // print_r($result);
        // die();



        $result['related_product'] = DB::table('products')->where(['status' => 0])->where('id', '!=', $id)->get();



        foreach ($result['related_product'] as $list1) {
            $result['related_product_attr'][$list1->id] = DB::table('product_attr')->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')->where(['product_attr.product_id' => $list1->id])->get();
        }
        $result['show_rating']=DB::table('rating')->select('customers.name','rating.rating','rating.review','rating.added_on')->leftJoin('customers', 'customers.id', '=', 'rating.customer_id')->where(['product_id'=>$id])->get();

        // echo "<pre>";
        //     print_r($result);
        //     die();
        // //     // 
        return view('front.product', $result);
    }

    public function add_to_cart(Request $request)
    {
        // echo "<pre>";
        // print_r($_POST);
        if ($request->session()->has('FRONT_USER_LOGIN')) {
            $uid = $request->session()->get('FRONT_USER_Id');
            $user_type = "Reg";
        } else {
            $uid = getUserTempId();
            $user_type = "Non-Reg";
        }
        $size_id = $request->post('size_id');
        $color_id = $request->post('color_id');
        $product_id = $request->post('product_id');
        $qty = $request->post('qty');
        $result = DB::table('product_attr')->select('product_attr.id')->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')->where(['product_id' => $product_id])->where(['sizes.size' => $size_id])->where(['colors.color' => $color_id])->get();

        $product_attr_id = $result[0]->id;
        $check = DB::table('cart')->where(['user_id' => $uid])->where(['user_type' => $user_type])->where(['product_id' => $product_id])->where(['product_attr_id' => $product_attr_id])->get();
        if (isset($check[0])) {
            $update_id = $check[0]->id;
            if ($qty == 0) {
                DB::table('cart')->where(['id' => $update_id])->delete();
                $msg = "deleted";
            } else {
                DB::table('cart')->where(['id' => $update_id])->update(['qty' => $qty]);
                $msg = "update";
            }
        } else {
            $id = DB::table('cart')->insertGetId([
                'user_id' => $uid,
                'user_type' => $user_type,
                'product_id' => $product_id,
                'product_attr_id' => $product_attr_id,
                'qty' => $qty,
                'added_on' => date('Y-m-d h:i:s')
            ]);
            $msg = "added";
        }
        $result = DB::table('cart')->leftJoin('products', 'products.id', '=', 'cart.product_id')
            ->leftJoin('product_attr', 'product_attr.id', '=', 'cart.product_attr_id')
            ->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')->select('products.name', 'products.id as pid', 'products.image', 'colors.color', 'sizes.size', 'product_attr.price', 'cart.qty', 'product_attr.id as attr_id')->where(['user_id' => $uid])->where(['user_type' => $user_type])->get();
        return response()->json(['msg' => $msg, 'data' => $result, 'totalcount' => count($result)]);
    }
    public function cart(Request $request)
    {
        if ($request->session()->has('FRONT_USER_LOGIN')) {
            $uid = $request->session()->get('FRONT_USER_Id');
            $user_type = "Reg";
        } else {
            $uid = getUserTempId();
            $user_type = "Non-Reg";
        }
        $result['list'] = DB::table('cart')->leftJoin('products', 'products.id', '=', 'cart.product_id')
            ->leftJoin('product_attr', 'product_attr.id', '=', 'cart.product_attr_id')
            ->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')->select('products.name', 'products.id as pid', 'products.image', 'colors.color', 'sizes.size', 'product_attr.price', 'cart.qty', 'product_attr.id as attr_id')->where(['user_id' => $uid])->where(['user_type' => $user_type])->get();

        // echo "<pre>";
        // print_r($result);
        // die();
        return view('front.cart', $result);
    }
    public function category(Request $request, $slug)
    {

        $sort = $request->get('sort');
        $lower_price = '';
        $upper_price = '';

        $query = DB::table('products');
        $query = $query->leftJoin('categories', 'categories.id', '=', 'products.category_id');
        $query = $query->leftJoin('product_attr', 'product_attr.product_id', '=', 'products.id');
        if ($sort == 'name') {
            $query = $query->orderBy('products.name', 'asc');
        }
        if ($sort == 'price_asc') {
            $query = $query->orderBy('product_attr.price', 'asc');
        }
        if ($request->get('price_lower_filter') != '' && $request->get('price_upper_filter') != '') {
            $query = $query->whereBetween('product_attr.price', [$request->get('price_lower_filter'), $request->get('price_upper_filter')]);
            $lower_price = $request->get('price_lower_filter');
            $upper_price = $request->get('price_upper_filter');
        }
        if ($sort == 'price_desc') {
            $query = $query->orderBy('product_attr.price', 'desc');
        }
        if ($sort == 'date') {
            $query = $query->orderBy('products.id', 'desc');
        }
        $query = $query->where(['products.status' => 0]);
        $query = $query->where(['categories.category_slug' => $slug]);
        $query = $query->distinct()->select('products.*', 'product_attr.price');
        $query = $query->get();

        $result['product'] = $query;
        $result['price_lower_filter'] = $lower_price;
        $result['price_upper_filter'] = $upper_price;
        $result['slug'] = $slug;

        //  echo "<pre>";
        // print_r($result['product']);
        // die();

        foreach ($result['product'] as $list) {
            $result['home_attr'][$list->id] = DB::table('product_attr')->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')->where(['product_attr.product_id' => $list->id])->get();
        }
        $result['category_left'] = DB::table('categories')->where(['status' => 0])->get();

        // echo "<pre>";
        // print_r($result);
        // die();
        return view('front.category', $result);
    }
    public function search(Request $request, $str)
    {
        $query = DB::table('products');




        $query = $query->where(['status' => 0]);
        $query = $query->where(['name' => $str]);

        $query = $query->get();

        $result['product'] = $query;


        //  echo "<pre>";
        // print_r($result['product']);
        // die();

        foreach ($result['product'] as $list) {
            $result['home_attr'][$list->id] = DB::table('product_attr')->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')->where(['product_attr.product_id' => $list->id])->get();
        }
        //  echo "<pre>";
        //  print_r($result);
        //  die();
        return view('front.search', $result);
    }
    public function registration(Request $request)

    {
        return view('front.registration');
    }
    public function registration_process(Request $request)

    {
        $valid = validator::make($request->all(), [
            "name" => 'required',
            "email" => 'required|email|unique:customers,email',
            "password" => 'required',
            "phone" => 'required|numeric|digits:10',
        ]);
        if (!$valid->passes()) {
            return response()->json(['status' => 'error', 'error' => $valid->errors()->toArray()]);
        } else {
            $rand = rand(111111111, 999999999); 
            $arr = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Crypt::encrypt($request->password),
                'status' => 1,
                'is_verify' => 0,
                'rand_id' => $rand,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ];
            $query = DB::table('customers')->insert($arr);
            if ($query) {
                $data = ['name' => $request->name, 'rand_id' => $rand];
                $user['to'] = $request->email;
                Mail::send('front/email_verification', $data, function ($message) use ($user) {
                    $message->to($user['to']);
                    $message->subject('Email Id Verification');
                });
                return response()->json(['status' => 'success', 'msg' => 'successfully and Verify your Email ']);
            }
        }
    }

    public function login_process(Request $request)

    {
        if ($request->login_email != null) {
            $db_email = DB::table('customers')->where(['email' => $request->login_email])->get();

            if (isset($db_email[0])) {
                $db_pwd = Crypt::decrypt($db_email[0]->password);
                // echo $db_pwd;
                // die();
                if ($db_pwd == $request->login_pwd) {
                    $status = $db_email[0]->status;
                    $verify = $db_email[0]->is_verify;
                    if ($status == 0) {
                        return response()->json(['status' => 'error', 'error' => 'Your Account has been Deactivated']);
                    }
                    if ($verify == 0) {
                        return response()->json(['status' => 'error', 'error' => 'Please Verify Your Email']);
                    }




                    if ($request->rememberme === null) {
                        setcookie('login_email', $request->login_email, 100);
                        setcookie('login_password', $request->login_pwd, 100);
                    } else {
                        setcookie('login_email', $request->login_email, time() + 60 * 60 * 24 * 100);
                        setcookie('login_password', $request->login_pwd, time() + 60 * 60 * 24 * 100);
                    }

                    $request->session()->put('FRONT_USER_LOGIN', true);
                    $request->session()->put('login_email', $request->login_email);
                    $request->session()->put('login_password', $request->login_pwd);
                    $request->session()->put('FRONT_USER_Id', $db_email[0]->id);
                    $getUserTempId = getUserTempId();
                    DB::table('cart')->where(['user_id' => $getUserTempId, 'user_type' => 'Non-Reg'])->update(['user_id' => $db_email[0]->id, 'user_type' => 'Reg']);
                    return response()->json(['status' => 'success', 'msg' => 'sucess']);
                } else {
                    return response()->json(['status' => 'error', 'error' => 'Please enter the valid password ']);
                }
            } else {
                return response()->json(['status' => 'error', 'error' => 'Please enter the valid email Id']);
            }
        } else {
            return response()->json(['status' => 'error', 'error' => 'Please enter the  email Id and Password']);
        }
    }
    public function verification(Request $request, $id)
    {

        $result = DB::table('customers')->where(['rand_id' => $id])->get();

        if (isset($result[0])) {
            DB::table('customers')->where(['id' => $result[0]->id])->update(['is_verify' => 1, 'rand_id' => '']);
            return view('front/verification');
        } else {
            return redirect('/');
        }
    }

    public function forgot_password_process(Request $request)
    {
        $result = DB::table('customers')->where(['email' => $request->forgot_email])->get();

        $rand = rand(111111111, 999999999);
        if (isset($result[0])) {
            DB::table('customers')->where(['email' => $request->forgot_email])->update(['is_forgot' => 1, 'rand_id' => $rand]);

            $data = ['name' => $result[0]->name, 'rand_id' => $rand];
            $user['to'] = $request->forgot_email;
            Mail::send('front/forgot_password_verification', $data, function ($message) use ($user) {
                $message->to($user['to']);
                $message->subject('Email Id Verification');
            });

            return response()->json(['status' => 'error', 'error' => 'successfully and Forgot your Email ']);
        } else {
            return response()->json(['status' => 'error', 'error' => 'your Email Id is not Register ']);
        }
    }
    public function forgot_password_change(Request $request, $id)
    {
        $result = DB::table('customers')->where(['rand_id' => $id])->where(['is_forgot' => 1])->get();


        if (isset($result[0])) {
            $request->session()->put('FORGOT_USER_ID', $result[0]->id);
            return view('front/forgot_password_change');
        } else {
            return redirect('/');
        }
    }
    public function update_password(Request $request)
    {
        $result = DB::table('customers')->where(['id' => $request->session()->get('FORGOT_USER_ID')])->update(['password' => Crypt::encrypt($request->forgot_password), 'is_forgot' => 0, 'rand_id' => '']);
        return response()->json(['status' => 'error', 'error' => 'updated']);
    }
    public function checkout(Request $request)
    {
        $result['cart_data'] = getCartTotal();

        if (isset($result['cart_data'][0])) {
            if (session()->has('FRONT_USER_LOGIN')) {
                $uid = session()->get('FRONT_USER_Id');





                $result['customer_info'] = DB::table('customers')->where(['id' => $uid])->get();


                $result['customer_info']['name'] = $result['customer_info'][0]->name;
                $result['customer_info']['email'] = $result['customer_info'][0]->email;
                $result['customer_info']['address'] = $result['customer_info'][0]->address;
                $result['customer_info']['state'] = $result['customer_info'][0]->state;
                $result['customer_info']['city'] = $result['customer_info'][0]->city;
                $result['customer_info']['zip'] = $result['customer_info'][0]->zip;
                $result['customer_info']['phone'] = $result['customer_info'][0]->phone;
            } else {
                $result['customer_info']['name'] = '';
                $result['customer_info']['email'] = '';
                $result['customer_info']['address'] = '';
                $result['customer_info']['state'] = '';
                $result['customer_info']['city'] = '';
                $result['customer_info']['zip'] = '';
                $result['customer_info']['phone'] = '';
            }
            return view('front/checkout', $result);
        } else {
            return redirect('/');
        }
    }

    public function apply_coupon_code(Request $request)

    {
        $arr = apply_coupon_code($request->coupon_code);
        $arr = json_decode($arr, true);
        //    print_r($arr);
        return response()->json(['status' => $arr['status'], 'msg' => $arr['msg'], 'coupon_value' => $arr['coupon_value'], 'dis_val' => $arr['dis_val']]);

        // return response()->json(['status' => 'price', 'msg' => 'coupon code applied', 'coupon_value' => $total]);
    }

    public function remove_coupon_code(Request $request)

    {
        // $result = DB::table('coupons')->where(['code' => $request->coupon_code])->get();
        $getCartTotal = getCartTotal();
        // print_r($getCartTotal);
        // die();

        $total = 0;

        foreach ($getCartTotal as $list) {
            $total = $total + ($list->price * $list->qty);
        }
        // echo $total;
        // die();
        return response()->json(['status' => 'success', 'msg' => 'Please Valid coupon code ', 'value' => $total]);
    }
    public function order_placed(Request $request)

    {
        $payment_url='';
      
        $coupon_dis_val=0;
        if (session()->has('FRONT_USER_LOGIN')) {
            $uid = session()->get('FRONT_USER_Id');
            if ($request->coupon_code != '') {
                $arr1 = apply_coupon_code($request->coupon_code);
                $arr1 = json_decode($arr1, true);
                $coupon_dis_val=$arr1['dis_val'];
                if ($arr1['status'] == 'success') {
                } else {
                    return response()->json(['status' => 'error', 'msg' => 'Please Apply valid coupon ']);
                }
            }

            $getCartTotal = getCartTotal();
            $total = 0;

            foreach ($getCartTotal as $list) {
                $total = $total + ($list->price * $list->qty);
            }
       
            $arr = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' =>  $request->city,
                'zip' =>  $request->pincode,
                'customer_id' => $uid,
                'state' => $request->state,

                'coupon_code' => $request->coupon_code,
                'coupon_value' => $coupon_dis_val,
                'order_status' => 'placed',
                'payment_status' => 'pending',
                'payment_type' => $request->payment_type,
                'total_amt' => $total,
                'payment_type' =>  $request->payment_type,
                'added_on' => date('Y-m-d h:i:s'),

            ];
            $order_id = DB::table('orders')->insertGetId($arr);
            $request->session()->put('ORDER_ID', $order_id);
            //  echo $order_id;
            $getCartTotal = getCartTotal();
            //  $i=0;
            foreach ($getCartTotal as $list) {
                $Arr['product_id'] = $list->pid;

                $Arr['qty'] = $list->qty;
                $Arr['attr_id'] = $list->attr_id;
                $Arr['order_id'] = $order_id;
                $Arr['add_on'] = date('Y-m-d h:i:s');
                DB::table('order_info')->insert($Arr);

              
            }
            if ($request->payment_type == 'prepaid') {
                $val=$total-$coupon_dis_val;
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
                curl_setopt($ch, CURLOPT_HEADER, FALSE);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
                curl_setopt(
                    $ch,
                    CURLOPT_HTTPHEADER,
                    array(
                        "X-Api-Key:test_0d64034ae6431f13cdd25c53c41",
                        "X-Auth-Token:test_0223de82e6e19ba4aa88760b6e8"
                    )
                );
                $payload = array(
                    'purpose' => 'Product Purpose',
                    'amount' => $val,
                    'phone' => $request->phone,
                    'buyer_name' => $request->name,
                    'redirect_url' =>  'http://127.0.0.1:8000/instamojo_redirect',
                    'send_email' => true,
             
                    'send_sms' => true,
                    'email' => $request->email,
                    'allow_repeated_payments' => false
                );
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
                $response = curl_exec($ch);
                curl_close($ch);
                $response=json_decode($response);
                // echo "<pre>";
                // print_r($response->message);
            
              
                if(isset($response->payment_request->id)){
                    $txt_id=$response->payment_request->id;
                    $payment_url=$response->payment_request->longurl;
                    DB::table('orders')->where(['id' => $order_id])->update(['txt_id' => $txt_id]);

                }else{
                    $msg='';
                    foreach($response->message as $key=>$val){
                        $msg.=$key.''.$val[0].'<br>';
                    }
                    return response()->json(['status' => 'error','msg'=>$msg,'payment_url'=>'']);
                }
                DB::table('cart')->where(['user_id' => $uid])->delete();
                return response()->json(['status' => 'success','payment_url'=>$payment_url]);

                
                //echo $payment_url;
            }
            DB::table('cart')->where(['user_id' => $uid])->delete();

            return response()->json(['status' => 'success','payment_url'=>$payment_url]);

        } else {
            return response()->json(['status' => 'error', 'msg' => 'Please after sometime place the order ']);
        }
    }
    public function order(Request $request)

    {
        if ($request->session()->has('ORDER_ID')) {
            session()->forget('ORDER_ID');
            return view('front.order');
        } else {
            return redirect('/');
        }
    }
    public function instamojo_redirect(Request $request)

    {
        if($request->get('payment_id')!='' && $request->get('payment_status')!='' && $request->get('payment_request_id')!=''){
            if($request->get('payment_status')=='Credit'){
                $status='success';
                $redirect_url='/order';
            }else{
                $status='failed';
                $redirect_url='/fail_order';
            }
            //$request->session()->put('ORDER_STATUS',$status);
            DB::table('orders')->where(['txt_id' =>$request->get('payment_request_id')])->update(['payment_status' => $status,'payment_id' => $request->get('payment_id')]);
            return redirect($redirect_url);
        }else{
            die('something went to wrong');
        }
    }
    public function my_order(Request $request)

    {
        $result['orders'] = DB::table('orders')->where(['customer_id' =>  $request->session()->get('FRONT_USER_Id')])->get();
        // echo "<pre>";
        // print_r($result);
        // die();
       return view('front.my_order',$result);
    }
    public function my_order_detail(Request $request,$id)

    {
        $result['order_detail'] = DB::table('order_info')->leftJoin('products', 'products.id', '=', 'order_info.product_id')->leftJoin('orders', 'orders.id', '=', 'order_info.order_id')->where(['order_info.order_id' =>$id ])->select('orders.txt_id','orders.coupon_value','orders.coupon_code','products.name','order_info.qty','orders.total_amt')->get();
     //  
        //  echo "<pre>";
        // print_r($result);
        // die();
    //    
    return view('front.my_order_detail',$result);
    }

    
    public function rating_review_process(Request $request)

    {
        if ($request->session()->has('FRONT_USER_LOGIN')) {
            $uid = $request->session()->get('FRONT_USER_Id');
            $arr = [

                'product_id' => $request->product_id,
                'customer_id' => $uid,
                'status' => 1,
                'rating' => $request->rating,
                'review' => $request->review,
                'added_on' => date('Y-m-d h:i:s')
            ];
            $result=DB::table('rating')->where(['product_id'=>$request->product_id,'customer_id'=>$uid])->get();
            if(isset($result[0])){
                return response()->json(['status' =>"error", 'msg' => "your rating already exits"]);
            }
//  echo "<pre>";
//         print_r($result);
//         die();
            DB::table('rating')->insert($arr);

            $status="success";
            $msg="successfully add the rating";
            
            // return view('front.product',$result);
        //     echo "<pre>";
        // print_r($result['show_rating']);
        // die();
        } else {
            $status="error";
            $msg="please login and add the rating";
        }

       return response()->json(['status' => $status, 'msg' => $msg]);
     //  
        
    //    
    
    }
    
}
