<?php

namespace App\Http\Controllers;

use App\Basket;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

/**
 * Class ReceptionController
 * @package App\Http\Controllers
 */
class ReceptionController extends Controller
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

        return view('reception.index', [
            'baskets' => Basket::all()->where("validated","=","1")
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     * @throws ValidationException
     */
    public function send(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);

        $basket = Basket::all()->find($request->id);

        // Detach the basket from the user.
        $userSubscription = $basket->userSubscription;
        $userSubscription->basket_id = null;
        $userSubscription->save();

        // Detach the basket products.
        foreach($basket->basketProducts as $basketProduct)
        {
            $basketProduct->delete();
        }

        // Eventually delete the basket.
        $basket->delete();

        return redirect()->route("reception");
    }
}
