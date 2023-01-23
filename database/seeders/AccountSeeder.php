<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Account::create([
            'acount_num' => 1,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'balance' => 100
        ]);

        Account::create([
            'acount_num' => 2,
            'first_name' => 'James',
            'last_name' => 'Smith',
            'balance' => 0
        ]);

        Account::create([
            'acount_num' => 3,
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'balance' => 2000
        ]);
    }
}
