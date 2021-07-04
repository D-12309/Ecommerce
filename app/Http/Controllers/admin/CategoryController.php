<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;


use App\Models\admin\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function category()
    {
        $result['data']=category::all();
        return view('admin/category', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_category(Request $request,$id='')
    {
        
        
        if($id>0){
           $arr=category::where(['id'=>$id])->get();
          
           $result['category_name']=$arr[0]->category_name;
            $result['category_slug']=$arr[0]->category_slug;
            $result['parent_category']=$arr[0]->parent_category;
            $result['image']=$arr[0]->image;
            $result['is_check']=$arr[0]->is_check;
            $result['is_select']='';

            if($arr[0]->is_check==1){
                $result['is_select']='checked';
            }

            $result['id']=$arr[0]->id;
        $result['category'] = DB::table('categories')->where('id','!=',$id)->where(['status' => 0])->get();


        }else{
            $result['category_name']='';
            $result['category_slug']='';
            $result['parent_category']='';
            $result['image']='';
            $result['is_check']='';
            $result['is_select']='';
            $result['id']=0;
            
            $result['category'] = DB::table('categories')->where(['status' => 0])->get();


        }
    
        return view('admin/manage_category',$result);  
    }
    public function manage_category_process(Request $request)
    {
        
         $request->validate([
             'category_name'=>'required',
             'category_slug'=>'required|unique:categories,category_slug,'.$request->post('id'),
         ]);
       
         if($request->post('id')>0){
            $model=category::find($request->post('id'));
            $msg="category updated";
         }else{
            $model=new category();
            $msg="category inserted";
         }
         if ($request->hasfile('image')) {
            if ($request->post('id') > 0) {
        $arrImage=DB::table('categories')->where(['id' => $request->post('id')])->get();
        
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
         $model->category_name=$request->post('category_name');
         $model->category_slug=$request->post('category_slug');
         $model->parent_category=$request->post('parent_category');
         $model->is_check=0;

        if($request->post('is_check')!=null){
            $model->is_check=1;
        }
         $model->status=1;

        $model->save();
        $request->session()->flash('msg',$msg);
        return redirect('admin/category');


    }
    public function delete(Request $request,$id)
    {
        $model=category::find($id);
        $model->delete();
        $request->session()->flash('msg','category deleted');
        return redirect('admin/category');

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
    public function status(category $category,$type,$id)
    {
        
        $model=category::find($id);
        $model->status=$type;
        $model->save();
        session()->flash('msg','Status updated');
       return redirect('admin/category');
    }
}
