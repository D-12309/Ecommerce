<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use App\Models\admin\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function product()
    {

        $result['data'] = product::all();
        // echo "<pre>";
        // print_r($result);
        // die();
        return view('admin/product', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_product(Request $request, $id = '')
    {
        if ($id > 0) {
            $arr = product::where(['id' => $id])->get();
            $result['name'] = $arr[0]->name;
            $result['brand'] = $arr[0]->brand;
            $result['image'] = $arr[0]->image;
            $result['lead_time'] = $arr[0]->lead_time;
            $result['tax'] = $arr[0]->tax;
            $result['tax_type'] = $arr[0]->tax_type;
            $result['is_promo'] = $arr[0]->is_promo;
            $result['is_featured'] = $arr[0]->is_featured;
            $result['is_discounted'] = $arr[0]->is_discounted;
            $result['id_tranding'] = $arr[0]->id_tranding;


            $result['desc'] = $arr[0]->desc;
            $result['short_desc'] = $arr[0]->short_desc;
            $result['model'] = $arr[0]->model;
            $result['technical_specification'] = $arr[0]->technical_specification;
            $result['keywords'] = $arr[0]->keywords;
            $result['category_id'] = $arr[0]->category_id;
            $result['warranty'] = $arr[0]->warranty;
            $result['uses'] = $arr[0]->uses;
            $result['slug'] = $arr[0]->slug;
            $result['id'] = $arr[0]->id;
            //   echo "<pre>";
            // print_r($result);
            // die();


            $result['productattrArr'] = DB::table('product_attr')->where(['product_id' => $id])->get();
            $productimagesArr = DB::table('product_images')->where(['product_id' => $id])->get();
          
            if(!isset($productimagesArr[0])){
                $result['productimagesArr'][0]['images'] ='';
            $result['productimagesArr'][0]['id'] ='';
            }else{
                
              
                $result['productimagesArr']=$productimagesArr;
               

            }
           
           
        } else {
            $result['name'] = '';
            $result['brand'] = '';
            $result['image'] = '';
            $result['lead_time'] = '';
            $result['tax'] = '';;
            $result['tax_type'] = '';
            $result['is_promo'] = '';
            $result['is_featured'] ='';
            $result['is_discounted'] = '';
            $result['id_tranding'] = '';
            $result['desc'] = '';
            $result['short_desc'] = '';
            $result['model'] = '';
            $result['technical_specification'] = '';
            $result['keywords'] = '';
            $result['category_id'] = '';
            $result['warranty'] = '';
            $result['uses'] = '';
            $result['slug'] = '';
            $result['id'] = 0;

            $result['productattrArr'][0]['product_id'] = '';
            $result['productattrArr'][0]['image_attr'] = '';
            $result['productattrArr'][0]['size_id'] = '';
            $result['productattrArr'][0]['color_id'] = '';
            $result['productattrArr'][0]['sku'] = '';
            $result['productattrArr'][0]['mrp'] = '';
            $result['productattrArr'][0]['price'] = '';
            $result['productattrArr'][0]['qty'] = '';
            $result['productattrArr'][0]['id'] = '';
            $result['productimagesArr'][0]['images'] ='';
            $result['productimagesArr'][0]['id'] ='';
        }
        //  echo "<pre>";
        //      print_r($result);
        //  die();
        $result['category'] = DB::table('categories')->where(['status' => 0])->get();
        $result['brands'] = DB::table('brands')->where(['status' => 0])->get();

        $result['size'] = DB::table('sizes')->where(['status' => 0])->get();
        $result['color'] = DB::table('colors')->where(['status' => 0])->get();


        return view('admin/manage_product', $result);
    }
    public function manage_product_process(Request $request)
    {
        //  echo "<pre>";
        //  print_r( $request->post());
        // die();
        if ($request->post('id') > 0) {
            $image_validation = "mimes:jpeg,png,jpg";
        } else {
            $image_validation = "required|mimes:jpeg,png,jpg";
        }
        $request->validate([
            'name' => 'required',
            'image' => $image_validation,
            'slug' => 'required|unique:products,slug,' . $request->post('id'),
            'image_attr.*'=>"mimes:jpeg,png,jpg"
        ]);
            // product attr 
        $skuArr = $request->post('sku');
        $paidArr = $request->post('paid');
        $priceArr = $request->post('price');
        $qtyArr = $request->post('qty');
        $size_idArr = $request->post('size_id');
        $color_idArr = $request->post('color_id');
        $mrpArr = $request->post('mrp');
        
        foreach($skuArr as $key=>$val) {
            $check=DB::table('product_attr')->where('sku','=',$skuArr[$key])->where('id','!=',$paidArr[$key])->get();
            if(isset($check[0])){
                $request->session()->flash('msg','already used');
                return redirect(request()->headers->get('referer'));
            }
        }

  // end product attr 

        // only product 
        if ($request->post('id') > 0) {
            $model = product::find($request->post('id'));
            $msg = "product updated";
        } else {
            $model = new product();
            $msg = "product inserted";
        }
        if ($request->hasfile('image')) {
            if ($request->post('id') > 0) {
        $arrImage=DB::table('products')->where(['id' => $request->post('id')])->get();
        
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
        $model->name = $request->post('name');
        $model->category_id = $request->post('category_id');
        $model->brand = $request->post('brand');
        $model->lead_time = $request->post('lead_time');
        $model->tax = $request->post('tax');
        $model->tax_type = $request->post('tax_type');
        $model->is_promo = $request->post('is_promo');
        $model->is_featured = $request->post('is_featured');
        $model->is_discounted = $request->post('is_discounted');
        $model->id_tranding = $request->post('id_tranding');
        // echo $model->is_featured ;
        // echo $model->is_discounted;
        // echo $model->id_tranding;
        // die();


      
        $model->desc = $request->post('desc');
        $model->short_desc = $request->post('short_desc');
        $model->slug = $request->post('slug');
        $model->model = $request->post('model');
        $model->technical_specification = $request->post('technical_specification');
        $model->keywords = $request->post('keywords');
        $model->warranty = $request->post('warranty');
        $model->uses = $request->post('uses');
        $model->model = $request->post('model');

        $model->status = 1;
       
        
        $model->save();
        $pid = $model->id;
        
        // end only product 
        // product attr 
        foreach($skuArr as $key=>$val) {
          
            $productattrArr['product_id'] =$pid ;
            $productattrArr['sku'] = $skuArr[$key];
            $productattrArr['price'] = $priceArr[$key];
            $productattrArr['qty'] = $qtyArr[$key];
            $productattrArr['mrp'] = $mrpArr[$key];

            

            if ($request->hasfile("image_attr.$key")) {
                if ($paidArr[$key] != '') {
                    $arrImage=DB::table('product_attr')->where(['id' => $paidArr[$key]])->get();
                    // echo "<pre>";
                    // print_r($arrImage);
                    // die();
                    if( Storage::exists('/public/media/'.$arrImage[0]->image_attr)){
                        Storage::delete('/public/media/'.$arrImage[0]->image_attr);
                    }
                }
                $image_attr = $request->file("image_attr.$key");
                $ext = $image_attr->extension();
                $image_name = rand() . '.' . $ext;
                $request->file("image_attr.$key")->storeAs('/public/media', $image_name);
                $productattrArr['image_attr'] = $image_name;

            }
            if ($size_idArr[$key] == '') {
                $productattrArr['size_id'] = 0;
            } else {
                $productattrArr['size_id'] = $size_idArr[$key];
            }
            if ($color_idArr[$key] == '') {
                $productattrArr['color_id'] = 0;
            } else {
                $productattrArr['color_id'] = $color_idArr[$key];
            }
            if ($paidArr[$key] != '') {
                DB::table('product_attr')->where(['id' => $paidArr[$key]])->update($productattrArr);
            } else {
                DB::table('product_attr')->insert($productattrArr);
            }
        }//end product attr
        //start the product images
        $piidArr = $request->post('piid');
        foreach($piidArr as $key=>$val) {
            $productimgesrArr['product_id'] =$pid ;

            if ($request->hasfile("images.$key")) {
                if ($piidArr[$key] != '') {
                    $arrImage=DB::table('product_images')->where(['id' => $piidArr[$key]])->get();
        if(Storage::exists('/public/media/'.$arrImage[0]->images)){
            Storage::delete('/public/media/'.$arrImage[0]->images);
        }
                }

                $rand=rand('111111111','999999999');
                $image_attr = $request->file("images.$key");
                $ext = $image_attr->extension();
                $image_name = $rand . '.' . $ext;
                $request->file("images.$key")->storeAs('/public/media', $image_name);
                $productimgesrArr['images'] = $image_name;

            }
            if ($piidArr[$key] != '') {
                DB::table('product_images')->where(['id' => $piidArr[$key]])->update($productimgesrArr);
            } else {
                DB::table('product_images')->insert($productimgesrArr);
            }
        }



        $request->session()->flash('msg', $msg);
        return redirect('admin/product');
    }
    public function delete(Request $request, $id)
    {
        $model = product::find($id);
        $model->delete();
        $request->session()->flash('msg', 'product deleted');
        return redirect('admin/product');
    }

    public function product_attr_delete(Request $request, $paid, $pid)
    {
        $arrImage=DB::table('product_attr')->where(['id' => $paid])->get();
        // echo "<pre>";
        // print_r($arrImage);
        // die();
        if( Storage::exists('/public/media/'.$arrImage[0]->image_attr)){
            Storage::delete('/public/media/'.$arrImage[0]->image_attr);
        }
        DB::table('product_attr')->where(['id' => $paid])->delete();
        return redirect('admin/product/manage_product/' . $pid);
    }
    public function product_images_delete(Request $request, $piid, $pid)
    {
        $arrImage=DB::table('product_images')->where(['id' => $piid])->get();
        if(Storage::exists('/public/media/'.$arrImage[0]->images)){
            Storage::delete('/public/media/'.$arrImage[0]->images);
        }
     
        DB::table('product_images')->where(['id' => $piid])->delete();
        return redirect('admin/product/manage_product/' . $pid);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function status(product $product, $type, $id)
    {

        $model = product::find($id);
        $model->status = $type;
        $model->save();
        session()->flash('msg', 'Status updated');
        return redirect('admin/product');
    }
}
