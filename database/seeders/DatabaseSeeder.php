<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'is_admin' => 1, // admin user
        ]);

        User::factory()->create([
            'name' => 'User',
            'email' => 'user@admin.com',
            'password' => bcrypt('password'),
            'is_admin' => 0, // normal user
        ]);

        Setting::create([
            'midtrans_server_key' => 'SB-Mid-server-UA0LQbY4aALV0CfLLX1v7xs8',
            'midtrans_client_key' => 'SB-Mid-client-xqqkspzoZOM10iUG',
            'midtrans_merchant_id' => 'G561244367',
            'site_name' => 'Situs Jual Tiket Konser',
            'ticket_price' => '15000',
            'is_open_order' => Setting::OPEN_ORDER,
        ]);
    }
}
