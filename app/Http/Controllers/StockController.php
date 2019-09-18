<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

Class StockController extends Controller{
    public function show(Request $request){
        
        $stock = Product::all()->all();
         
        return view('stock.show')->with('stock',$stock);
    }

    public function edit(Request $request){

        $product = Product::where("id", $request->id)->first();

        // var_dump($product);


        return view('stock.edit')->with('product',$product);

        // var_dump($request->id);
    }


    public function validEdit(Request $request){

        $data = array("name" => $request->nom,"weight" => $request->poids, "quantity"=> $request->quantite);

        Product::where("id", $request->id)->update($data);
 
        return view('stock.show')->with('stock',Product::all()->all());
    }


    public function add(Request $request){
        return view('stock.add');

        // var_dump($request);
    }

    public function validAdd(Request $request){

        $data = array("name" => $request->nom,"weight" => $request->poids, "quantity"=> $request->quantite, "reserved_quantity"=>"0");

        Product::create($data);
 
        return view('stock.show')->with('stock',Product::all()->all());
    }

    public function delete(Request $request){

        Product::where("id","=",$request->id)->delete();
        
        return view('stock.show')->with('stock',Product::all()->all());

        // var_dump($request->id);

        // var_dump($request);
    }
}

?>