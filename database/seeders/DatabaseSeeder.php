<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Balance;
use App\Models\Transaction;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory(10)->create()->each(function ($user) {
            Balance::create(['user_id' => $user->id, 'amount' => rand(100, 10000)]);
            Transaction::factory(5)->create(['user_id' => $user->id]);
        });
    }
}
