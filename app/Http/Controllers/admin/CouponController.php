<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use App\Models\admin\coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function coupon()
    {
        $result['data']=coupon::all();
        return view('admin/coupon', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_coupon(Request $request,$id='')
    {
        if($id>0){
           $arr=coupon::where(['id'=>$id])->get();
           $result['title']=$arr[0]->title;
            $result['code']=$arr[0]->code;
            $result['value']=$arr[0]->value;
            $result['type']=$arr[0]->type;
            $result['min_order_amt']=$arr[0]->min_order_amt;
            $result['is_one_time']=$arr[0]->is_one_time;
            $result['id']=$arr[0]->id;

        }else{
            $result['title']='';
            $result['code']='';
            $result['value']='';
            $result['type']='';
            $result['min_order_amt']='';
            $result['is_one_time']='';

            $result['id']=0;


        }
    
        return view('admin/manage_coupon',$result);  
    }
    public function manage_coupon_process(Request $request)
    {
        
         $request->validate([
             'title'=>'required',
             'value'=>'required',
             'code'=>'required|unique:coupons,code,'.$request->post('id'),
         ]);
       
         if($request->post('id')>0){
            $model=coupon::find($request->post('id'));
            $msg="coupon updated";
         }else{
            $model=new coupon();
            $msg="coupon inserted";
         }
         $model->title=$request->post('title');
         $model->code=$request->post('code');
         $model->value=$request->post('value');
         $model->type=$request->post('type');
         $model->min_order_amt=$request->post('min_order_amt');
         $model->is_one_time=$request->post('is_one_time');


        $model->save();
        $request->session()->flash('msg',$msg);
        return redirect('admin/coupon');


    }
    public function delete(Request $request,$id)
    {
        $model=coupon::find($id);
        $model->delete();
        $request->session()->flash('msg','coupon deleted');
        return redirect('admin/coupon');

    }
    public function status(coupon $category,$type,$id)
    {
        
        $model=coupon::find($id);
        $model->status=$type;
        $model->save();
        session()->flash('msg','Status updated');
       return redirect('admin/coupon');
    }
   
    
    

    
   
}
