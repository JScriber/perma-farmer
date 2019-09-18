<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Class Stock extends Controller{
    public function show(Request $request){
        $stock = App\ClientSubscription::all()->all();
        return view('bags.create')->with('subscriptions', $clients);
    }

    public function edit(Request $request){
        var_dump('test');
    }

    public function add(Request $request){
        var_dump('test');
    }
}

?>