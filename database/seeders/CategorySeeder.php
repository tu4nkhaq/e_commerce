<?php

namespace Database\Seeders;

use App\Models\Categories;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categories::create([
            'name' => 'Computer',
            'slug'=>'dell'
        ]);
        Categories::create([
            'name' => 'Phone',
            'slug'=>'dell'
        ]);
        Categories::create([
            'name' => 'Watch',
            'slug'=>'dell'
        ]);
    }
}
