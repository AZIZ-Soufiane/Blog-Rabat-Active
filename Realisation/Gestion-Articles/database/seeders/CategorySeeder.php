<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      
         $categories = [
            ['name' => 'Technology', 'slug' => 'technology'],
            ['name' => 'Business', 'slug' => 'business'],
            ['name' => 'Lifestyle', 'slug' => 'lifestyle'],
            ['name' => 'Education', 'slug' => 'education'],
            ['name' => 'Health & Fitness', 'slug' => 'health-fitness'],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(
                ['slug' => $cat['slug']], 
                ['name' => $cat['name']]
            );
        }
        
       
    }

}