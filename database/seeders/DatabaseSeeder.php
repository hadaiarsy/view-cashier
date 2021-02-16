<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\UserLevel::factory(1)->create();
        \App\Models\UserLevel::create([
            'name' => 'kasir'
        ]);
        \App\Models\User::factory(1)->create();
        \App\Models\User::create([
            'id' => 'U-210114002',
            'level' => 2,
            'name' => 'kasir',
            'email' => 'kasir@mail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('passwordzz'), // password
            'remember_token' => Str::random(10),
        ]);
        // \App\Models\Member::factory(1)->create();
        // \App\Models\Barang::factory(1)->create();
        // \App\Models\SatuanBarang::factory(1)->create();
        // \App\Models\Transaksi::factory(1)->create();
        // \App\Models\DetailTransaksi::factory(1)->create();
    }
}
