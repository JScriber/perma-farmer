<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Role;

Class StockController extends Controller{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function show(Request $request){

        $request->user()->authorizeRole(Role::adminRole());
        $product =Product::latest()->paginate(10);
        return view('stock.show',[
            "stock"=>$product
        ])->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function edit(Request $request){

        $product = Product::where("id", $request->id)->first();

        return view('stock.edit')->with('product',$product);
    }


    public function validEdit(Request $request){


        $data = array("name" => $request->nom,"weight" => $request->poids, "quantity"=> $request->quantite);

        Product::where("id", $request->id)->update($data);


        $request->user()->authorizeRole(Role::adminRole());
        $product =Product::latest()->paginate(10);
        return view('stock.show',[
            "stock"=>$product
        ])->with('i', (request()->input('page', 1) - 1) * 10);
    }


    public function add(Request $request){
        return view('stock.add');
    }

    public function validAdd(Request $request){

        $data = array("name" => $request->nom,"weight" => $request->poids, "quantity"=> $request->quantite, "reserved_quantity"=>"0");

        Product::create($data);

        $request->user()->authorizeRole(Role::adminRole());
        $product =Product::latest()->paginate(10);
        return view('stock.show',[
            "stock"=>$product
        ])->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function delete(Request $request){

        Product::where("id","=",$request->id)->delete();
        
        $request->user()->authorizeRole(Role::adminRole());
        $product =Product::latest()->paginate(10);
        return view('stock.show',[
            "stock"=>$product
        ])->with('i', (request()->input('page', 1) - 1) * 10);
    }
}

?>
