<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendToAll;
use App\Jobs\ProcessProducts;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $data = ['products' => $products];


        return view('dashboard.products.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $data = ['users' => $users];
        return view('dashboard.products.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->get('name');
        $price = $request->get('price');
        $user_id = $request->get('user_id');


        $product = Product::create([
            'name' => $name,
            'price' => $price,
            'user_id' => $user_id
        ]);

        $users = User::all();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new SendToAll($product));
        }


        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::where('id', '=', $id)->first();

        $data = ['product' => $product];

        return view('dashboard.products.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::Find($id);

        $input = $request->all();


        $product->fill($input)->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::Find($id);
        $product->delete();

        return redirect()->back();
    }


    public function trigerJob()
    {
        $products = Product::all();
        foreach ($products as $product) {
            ProcessProducts::dispatch($product)->delay(10);
        }

        return response()->json(['success' => true, 200]);
    }
}
