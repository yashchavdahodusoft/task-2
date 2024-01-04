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
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
        ]);
        \App\Models\Companies::factory(10)->create()->each(function($company){
            $randNumber = random_int(5,20);
            \App\Models\Employees::factory($randNumber)->for($company)->create();
        });
    }
}
