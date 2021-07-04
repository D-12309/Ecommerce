<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\admin\size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function size()
    {
        $result['data']=size::all();
        return view('admin/size', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_size(Request $request,$id='')
    {
        if($id>0){
           $arr=size::where(['id'=>$id])->get();
           $result['size']=$arr[0]->size;
            

            $result['id']=$arr[0]->id;

        }else{
            $result['size']='';
           
            $result['id']=0;


        }
    
        return view('admin/manage_size',$result);  
    }
    public function manage_size_process(Request $request)
    {
        
         $request->validate([
             'size'=>'required|unique:sizes,size,'.$request->post('id'),
         ]);
       
         if($request->post('id')>0){
            $model=size::find($request->post('id'));
            $msg="size updated";
         }else{
            $model=new size();
            $msg="size inserted";
         }
         $model->size=$request->post('size');
         
         $model->status=1;

        $model->save();
        $request->session()->flash('msg',$msg);
        return redirect('admin/size');


    }
    public function delete(Request $request,$id)
    {
        $model=size::find($id);
        $model->delete();
        $request->session()->flash('msg','size deleted');
        return redirect('admin/size');

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
        
        $model=size::find($id);
        $model->status=$type;
        $model->save();
        session()->flash('msg','Status updated');
       return redirect('admin/size');
    }
}
