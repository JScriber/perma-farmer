<?php

use App\CreditCard;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Client. */
        $this->genClient();

        /* Admin. */
        $this->genAdmin();
    }

    /**
     * Generates an administrator.
     */
    private function genAdmin() {
        $admin = new User();

        $admin->firstname = 'root';
        $admin->lastname = 'root';
        $admin->email = 'root.root@gmail.com';
        $admin->password = Hash::make('password');
        $admin->role()->associate(Role::adminRole());

        $admin->save();
    }

    /**
     * Generates a client.
     */
    private function genClient() {
        $simpleUser = new User();

        $simpleUser->firstname = 'client';
        $simpleUser->lastname = 'client';
        $simpleUser->email = 'client.client@gmail.com';
        $simpleUser->password = Hash::make('password');
        $simpleUser->role()->associate(Role::clientRole());
        $simpleUser->credit_card_id = 1;

        $simpleUser->save();

        $creditCard = CreditCard::all()->find(1);
        $creditCard->user()->associate($simpleUser);
        $creditCard->save();
    }
}
