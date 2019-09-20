<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Basket;
use App\User;
use App\Role;
use Illuminate\Http\Response;

/**
 * Class OrderController
 * @package App\Http\Controllers
 */
class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRole(Role::adminRole());

        $tab = Array();
        $products = Array();

        $orders = Basket::all()->where("validated","=","0");

        foreach($orders as $order){


            foreach($order->basketProducts as $product){
                array_push($products,Array("num" => $product->quantity, "label" => $product->product->name));
            }

            array_push($tab,Array(
                "id" => $order->id,
                "firstname" => $order->userSubscription->user->firstname,
                "lastname" => $order->userSubscription->user->lastname,
                "basket" => $order->userSubscription->subscription->name,
                "products" => $products
            ));
        }

        return view('order.index')->with("orders", $tab);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function valid(Request $request)
    {
        Basket::find($request->id)->update(Array("validated" => "1"));

        return redirect()->route("order");
    }
}
