<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{Category, File};
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => 'admin123',
        ]);

        // $category = Category::create([
        //     'name' => 'Surat Masuk',
        //     'slug' => str_replace(' ','',Str::lower('Surat Masuk')),
        // ]);

        // File::create([
        //     'name' => 'dummy_file_' . Str::random(5) . '.txt',
        //     'path' => 'uploads/' . $category->slug . '/dummy_file_' . Str::random(10) . '.txt',
        //     'from' => 'Source ' . Str::random(5),
        //     'to' => 'Destination ' . Str::random(5),
        //     'category_id' => $category->id,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
    }
}
