<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\User;
use App\Models\Prodcut;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
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
        \App\Models\Category::factory(50)->create();
        \App\Models\SubCategory::factory(50)->create();
        \App\Models\Prodcut::factory(50)->create();
        \App\Models\User::factory(50)->has(Prodcut::factory(10), 'wishlist')->create();
    }
}
