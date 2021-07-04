<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use App\Models\admin\customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function customer()
    {
        $result['data']=customer::all();
        return view('admin/customer', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function customer_show(Request $request,$id='')
    {
        
           $arr=customer::where(['id'=>$id])->get();
           $result['cutomerList']=$arr[0];
           
            

    
        return view('admin/customer_show',$result);  
    }
   
  
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function status($type,$id)
    {
        
        $model=customer::find($id);
        $model->status=$type;
        $model->save();
        session()->flash('msg','Status updated');
       return redirect('admin/customer');
    }
}
