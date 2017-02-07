<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $orders = Order::get();
        $products = Product::get();
        return view('order.index', ['orders' => $orders, 'products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View|\Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('order.create', ['product' => Product::find($id)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $order = new Order;
        $order->product_id = $id;
        $order->order_date = $request->order_date;
        $order->quantity = $request->quantity;
        $order->save();
        Session::flash('success', 'Order added successfully');
        return Redirect::to('/orders    ');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Redirect
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect('/orders');

    }
}
