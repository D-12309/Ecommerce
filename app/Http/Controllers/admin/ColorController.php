<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\admin\color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
         /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function color()
    {
        $result['data']=color::all();
        return view('admin/color', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_color(Request $request,$id='')
    {
        if($id>0){
           $arr=color::where(['id'=>$id])->get();
           $result['color']=$arr[0]->color;
            

            $result['id']=$arr[0]->id;

        }else{
            $result['color']='';
           
            $result['id']=0;


        }
    
        return view('admin/manage_color',$result);  
    }
    public function manage_color_process(Request $request)
    {
        
         $request->validate([
             'color'=>'required|unique:colors,color,'.$request->post('id'),
         ]);
       
         if($request->post('id')>0){
            $model=color::find($request->post('id'));
            $msg="color updated";
         }else{
            $model=new color();
            $msg="color inserted";
         }
         $model->color=$request->post('color');
         
         $model->status=1;

        $model->save();
        $request->session()->flash('msg',$msg);
        return redirect('admin/color');


    }
    public function delete(Request $request,$id)
    {
        $model=color::find($id);
        $model->delete();
        $request->session()->flash('msg','color deleted');
        return redirect('admin/color');

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
        
        $model=color::find($id);
        $model->status=$type;
        $model->save();
        session()->flash('msg','Status updated');
       return redirect('admin/color');
    }
}
