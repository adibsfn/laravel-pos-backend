<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(9)->create();
        \App\Models\Category::factory(4)->create();
        \App\Models\Product::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Adib Shofiudin',
            'email' => 'adibshofiudin@gmail.com',
            'password' => bcrypt('adib123123'),
            'phone' => '087774649640',
            'roles' => 'ADMIN',
        ]);
    }
}
