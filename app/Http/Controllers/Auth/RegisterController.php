<?php

namespace App\Http\Controllers\Auth;

use App\Bag;
use App\Http\Controllers\Controller;
use App\Subscription;
use App\User;
use App\UserSubscription;
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
    protected $redirectTo = '/home';

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
            'card_expiration_date' => ['required', 'string', 'date']
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
        $user = User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'pro_account' => $data['account_type'] == 'pro',
            'credit_card_id' => 1
        ]);

        $this->create_subscription($user, $data['subscription']);

        return $user;
    }

    /**
     * Creates the subscription of the client.
     * @param $user
     * @param $subscription_id
     */
    protected function create_subscription($user, $subscription_id)
    {
        // Find an available bag.
        $bag = Bag::listAvailable()->first();

        if ($bag != null) {

            $subscription = UserSubscription::create([
                'subscription_id' => $subscription_id,
                'user_id' => $user->id,
                'bag_id' => $bag->id
            ]);

            DB::table('bags')
                ->where('id', $bag->id)
                ->update(['user_subscription_id' => $subscription->id]);
        }
    }
}
