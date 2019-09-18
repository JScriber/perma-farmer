<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'firstname' => 'Jean',
            'lastname' => 'Dupont',
            'password' => bcrypt('password'),
            'email' => 'jean.dupont@gmail.com',
            'pro_account' => false,
            'credit_card_id' => 1
        ]);

        // Attach the credit card to the client.
        $creditCard = App\CreditCard::all()->find(1);
        $creditCard->user_id = App\User::all()->where('firstname', '=', 'Jean')->first()->id;

        $creditCard->save();
    }
}
