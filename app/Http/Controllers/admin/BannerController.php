<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use App\Models\admin\banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function banner()
    {
        $result['data']=banner::all();
        
        return view('admin/banner', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_banner(Request $request,$id='')
    {
        if($id>0){
           $arr=banner::where(['id'=>$id])->get();
          
           $result['btn_txt']=$arr[0]->btn_txt;
           $result['btn_link']=$arr[0]->btn_link;
           $result['image']=$arr[0]->image;
            $result['id']=$arr[0]->id;

        }else{
            $result['btn_txt']='';
           $result['btn_link']='';
           $result['image']='';
           
            $result['id']=0;


        }
    
        return view('admin/manage_banner',$result);  
    }
    public function manage_banner_process(Request $request)
    {
     //return $request->post();
      
        
         $request->validate([
            
              'image'=>'mimes:jpg,png,jpeg'
         ]);
       
         if($request->post('id')>0){
            $model=banner::find($request->post('id'));
            $msg="banner updated";
         }else{
            $model=new banner();
            $msg="banner inserted";
         }
         if ($request->hasfile('image')) {
            if ($request->post('id') > 0) {
        $arrImage=DB::table('banners')->where(['id' => $request->post('id')])->get();
        
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
         $model->btn_txt=$request->post('btn_txt');
         $model->btn_link=$request->post('btn_link');

        //$model->image=$request->post('image');
         


         
         $model->status=1;
      


        $model->save();
        $request->session()->flash('msg',$msg);
        return redirect('admin/banner');


    }
    public function delete(Request $request,$id)
    {
        $model=banner::find($id);
        $model->delete();
        $request->session()->flash('msg','banner deleted');
        return redirect('admin/banner');

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
        
        $model=banner::find($id);
        $model->status=$type;
        $model->save();
        session()->flash('msg','Status updated');
       return redirect('admin/banner');
    }
}
