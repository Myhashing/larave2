<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Image;
use App\Remark;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productList    =   Product::get();
        $supplierList   =   Supplier::get();
        $categoriesList =   Category::get();
        /*TODO: Set validation for the all lists*/
        return view('products.index',['productList'=> $productList,'supplierList'=>$supplierList,'categoriesList'=>$categoriesList]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //add product
        $product= new Product;
        $product->name= $request->name;
        $product->supplier_id= $request->supplier[0];
        $product->web_link = $request->web_link;
        $product->sample = $request->sample;
        $product->price = $request->price;
        $product->moq = $request->moq;
        $product->save();
        //add categories
        foreach ($request->categories as $category){
            $cat = Category::find($category);
            $product->categories()->save($cat);
        }
        //add remaks
        $remark = new Remark;
        $remark->product_id=$product->id;
        $remark->remark = $request->remarks;
        $remark->save();
        //multiple uploads
        $files=Input::file('images');
        $file_count = count($files);
        $upload_count = 0;
        foreach ($files as $file){
            $image = new Image;
            $rules = array('file' => 'required');
            $validator = Validator::make(array('file' => $file),$rules);
            if($validator->passes()){
                $destination_path = 'uploads/';
                $filename = str_random(6).'_'.$file->getClientOriginalName();
                $upload_success = $file->move($destination_path,$filename);
                $image->file = $destination_path.$filename;
                $image->product_id=$product->id;
                $image->save();
                $upload_count ++;
            }
        }
        if ($upload_count==$file_count){
            Session::flash('success','upload successfully');
            return Redirect::to('/products');
        }else{
            return Redirect::to('/products')->withInput()->withErrors($validator);
        }

    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=Product::findOrFail($id);
        $supplier= Supplier::findOrFail($product->supplier_id);
        return view('products.show',['product'=>$product,'supplier'=>$supplier]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product        = Product::findOrFail($id);
        $supplierList   = Supplier::get();
        $categoriesList = Category::get();
        $selcSupplier   = Supplier::findOrFail($product->supplier_id);
        return view('products.edit',[
            'product'=>$product,
            'supplierList'=>$supplierList,
            'categoriesList'=>$categoriesList,
            'selcSupplier'=>$selcSupplier
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->name= $request->name;
        $product->supplier_id= $request->supplier[0];
        $product->web_link = $request->web_link;
        $product->sample = $request->sample;
        $product->price = $request->price;
        $product->moq = $request->moq;
        /*TODO; Edit supplier*/
        $product->save();
        //multiple uploads
        $files=Input::file('images');
        $file_count = count($files);
        $upload_count = 0;
        if ($file_count>0){
        foreach ($files as $file){
            $image = new Image;
            $rules = array('file' => 'required');
            $validator = Validator::make(array('file' => $file),$rules);
            if($validator->passes()){
                $destination_path = 'uploads/';
                $filename = str_random(6).'_'.$file->getClientOriginalName();
                $upload_success = $file->move($destination_path,$filename);
                $image->file = $destination_path.$filename;
                $image->product_id=$product->id;
                $image->caption = "yes";
                $image->description = "yes yes";
                $image->save();
                $upload_count ++;
            }
        }}
        if ($upload_count==$file_count){
            Session::flash('success','upload successfully');
            return Redirect::to('/products/edit/'.$id);
        }else{
            return Redirect::to('/products/eidt/'.$id)->withInput()->withErrors($validator);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::find($id);
        foreach ($product->images()->get() as $image){
            File::delete($image->file);
        }
        $product->images()->delete();
        $product->delete();

        return redirect('/products');
    }
}
