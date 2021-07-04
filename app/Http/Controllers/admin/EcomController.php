<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use App\Models\admin\ecom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class EcomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->session()->has('ADMIN_LOGIN')){
            return redirect('admin/dashboard');

        }else{
            return view('admin.login');
        }
        return view('admin.login'); 
    }
 
    public function auth(Request $r)
    {
        
         $email=$r->post('email');
         $password=$r->post('password');
         //$result=ecom::where(['email'=>$email,'password'=>$password])->get();
         $result=ecom::where(['email'=>$email])->first();
         if($result){
             if(Hash::check($r->post('password'),$result->password)){
                $r->session()->put('ADMIN_LOGIN',true);
                $r->session()->put('ADMIN_ID',$result->id);
                return redirect('admin/dashboard');
             }else{
                $r->session()->flash('msg','please valid  password');
            return redirect('admin'); 
             }
           
          } else{
            $r->session()->flash('msg','please valid email ');
            return redirect('admin');
             }
        
      
        
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function updatepassword(){
        $r=Ecom::find(1);
        $r->password=Hash::Make('admin');
        $r->save();
    }


}
