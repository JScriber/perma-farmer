<?php

namespace App\Http\Controllers\Auth;

use App\Bag;
use App\CreditCard;
use App\Http\Controllers\Controller;
use App\Role;
use App\Subscription;
use App\User;
use App\UserSubscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        // Subscription choice.
        $subscriptions = Subscription::all()->all();

        return view('auth.register', [
            'subscriptions' => $subscriptions,
            'cards' => [
                'MasterCard',
                'Visa',
                'American Express'
            ]
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'account_type' => ['required', 'string'],
            'subscription' => ['required'],

            'card_owner' => ['required', 'string', 'min:2'],
            'card_type' => ['required', 'string'],
            'card_number' => ['required', 'string', 'max:16', 'min:16'],
            'card_crypto' => ['required', 'string', 'max:3', 'min:3'],
            'card_expiration_date' => ['required', 'string', 'date', 'after:' . Carbon::now()]
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // Create the credit card.
        $creditCard = CreditCard::create([
            'owner' => $data['card_owner'],
            'card_number' => $data['card_number'],
            'crypto' => $data['card_crypto'],
            'type' => $data['card_type'],
            'expiration_date' => $data['card_expiration_date'],
        ]);

        // Create the user.
        $user = User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'credit_card_id' => $creditCard->id,
            'role_id' => Role::clientRole()->id
        ]);

        $creditCard = CreditCard::all()->find(1);
        $creditCard->user()->associate($user);
        $creditCard->save();


        $pro_account = $data['account_type'] == 'pro';

        $this->create_subscription($user, $data['subscription'], $pro_account);

        return $user;
    }

    /**
     * Creates the subscription of the client.
     * @param $user
     * @param $subscription_id
     * @param $pro_account
     */
    protected function create_subscription($user, $subscription_id, $pro_account)
    {
        // Find an available bag.
        $bag = Bag::all()->where('user_subscription_id', "=", null)->first();
        $subscription = Subscription::all()->find($subscription_id);

        if ($bag != null) {

            $userSubscription = new UserSubscription();

            $userSubscription->pro_account = $pro_account;
            $userSubscription->subscription()->associate($subscription);
            $userSubscription->user()->associate($user);
            $userSubscription->save();

            $bag->userSubscription()->associate($userSubscription);
            $bag->save();
        }
    }
}
