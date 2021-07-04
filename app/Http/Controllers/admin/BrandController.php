<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;


use App\Models\admin\brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;



class BrandController extends Controller
{
    public function brand()
    {
        $result['data']=brand::all();
        
        return view('admin/brand', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_brand(Request $request,$id='')
    {
        if($id>0){
           $arr=brand::where(['id'=>$id])->get();
          
           $result['name']=$arr[0]->name;
           $result['image']=$arr[0]->image;
            $result['id']=$arr[0]->id;

        }else{
            $result['name']='';
           $result['image']='';
           
            $result['id']=0;


        }
    
        return view('admin/manage_brand',$result);  
    }
    public function manage_brand_process(Request $request)
    {
     //return $request->post();
      
        
         $request->validate([
             'name'=>'required|unique:brands,name,'.$request->post('id'),
              'image'=>'mimes:jpg,png,jpeg'
         ]);
       
         if($request->post('id')>0){
            $model=brand::find($request->post('id'));
            $msg="brand updated";
         }else{
            $model=new brand();
            $msg="brand inserted";
         }
         if ($request->hasfile('image')) {
            if ($request->post('id') > 0) {
        $arrImage=DB::table('brands')->where(['id' => $request->post('id')])->get();
        
        if( Storage::exists('/public/media/'.$arrImage[0]->image)){
            Storage::delete('/public/media/'.$arrImage[0]->image);
        }
    }
    }
         

         if ($request->hasfile('image')) {
            $image = $request->file('image');

             
         
            
            $ext = $image->extension();
            $image_name = time() . '.' . $ext;
            $image->storeAs('/public/media', $image_name);
            $model->image = $image_name;
        }
         $model->name=$request->post('name');
        //$model->image=$request->post('image');
         


         
         $model->status=1;

        $model->save();
        $request->session()->flash('msg',$msg);
        return redirect('admin/brand');


    }
    public function delete(Request $request,$id)
    {
        $model=brand::find($id);
        $model->delete();
        $request->session()->flash('msg','brand deleted');
        return redirect('admin/brand');

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
    
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function status($type,$id)
    {
        
        $model=brand::find($id);
        $model->status=$type;
        $model->save();
        session()->flash('msg','Status updated');
       return redirect('admin/brand');
    }
}
