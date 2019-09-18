<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('clients')->insert([
            'firstname' => 'Jean',
            'lastname' => 'Dupont',
            'password' => bcrypt('password'),
            'email_address' => 'jean.dupont@gmail.com',
            'pro_account' => false,
            'credit_card_id' => 1
        ]);

        // Attach the credit card to the client.
        $creditCard = App\CreditCard::all()->find(1);
        $creditCard->client_id = App\Client::all()->where('firstname', '=', 'Jean')->first()->id;

        $creditCard->save();
    }
}
