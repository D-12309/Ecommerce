<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class orderController extends Controller
{
    public function order(){
            
        $result['orders'] = DB::table('orders')->select('orders.*','customers.name','products.name as pname','order_info.product_id','orders.total_amt','orders.coupon_code')->leftJoin('customers', 'customers.id', '=', 'orders.customer_id')->leftJoin('order_info', 'order_info.order_id', '=', 'orders.id')->leftJoin('products', 'products.id', '=', 'order_info.product_id')->get();
       return view('admin.order',$result);
    }
    
    public function order_detail(Request $request,$id)        
     {
        $result['order_detail'] = DB::table('order_info')->leftJoin('products', 'products.id', '=', 'order_info.product_id')->leftJoin('orders', 'orders.id', '=', 'order_info.order_id')->where(['order_info.order_id' =>$id ])->select('orders.txt_id','orders.coupon_value','orders.coupon_code','products.name','order_info.qty','orders.total_amt','orders.txt_id','orders.payment_status','orders.order_status','orders.id')->get();
        // echo "<pre>";
        // print_r($result['order_detail']);
        // die();
        $result['payment_status']=['pending','success','failed'];
       return view('admin.order_detail',$result);
    }
    
    public function update_payment_status(Request $request,$status,$id)        
    {
        DB::table('orders')->where(['id' => $id])->update(['payment_status' => $status]);
        return redirect('/admin/order_detail/'.$id);
   }
}

