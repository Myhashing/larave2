<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class SupplierController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers=Supplier::get();
        return view('suppliers.index',['suppliers'=>$suppliers]);
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
        $supplier = new Supplier;
        $supplier->name     = $request->name;
        $supplier->web      = $request->web;
        $supplier->person   = $request->person;
        $supplier->phone    = $request->phone;
        $supplier->email    = $request->email;
        $supplier->save();
        return redirect('/suppliers/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier=Supplier::findOrFail($id);
        return view('suppliers.show',['supplier'=>$supplier]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier   = Supplier::findOrFail($id);
        return view('suppliers.edit',['supplier'=>$supplier]);
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
        $supplier = Supplier::findOrFail($id);
        $supplier->name     = $request->name;
        $supplier->web      = $request->web;
        $supplier->person   = $request->person;
        $supplier->phone    = $request->phone;
        $supplier->email    = $request->email;
        $supplier->save();
        return redirect('/suppliers/edit/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier= Supplier::find($id);
        foreach ($supplier->products()->get() as $product){
            foreach ($product->images()->get() as $image){
                $file=$image->file;
                File::delete($file);
            }
            $product->images()->delete();
        }
        $supplier->products()->delete();
        $supplier->delete();
        return redirect('/suppliers');
    }
}
