<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        /*
            Create Category
        */
        \App\Models\Category::create([
            'name' => 'Sepak Bola',
            'slug' => 'sepak-bola',
        ]);

        \App\Models\Category::create([
            'name' => 'Anggar',
            'slug' => 'anggar',
        ]);

        \App\Models\Category::create([
            'name' => 'Basket',
            'slug' => 'basket',
        ]);

        \App\Models\Category::create([
            'name' => 'Volley',
            'slug' => 'volley',
        ]);

        /*
            Create Articles
        */
        // \App\Models\Article::factory(10)->create();

        /*
            Create Events
        */
        // \App\Models\Event::factory(10)->create();

        /*
            Create Locations
        */
        // \App\Models\Location::factory(10)->create();
    }
}
