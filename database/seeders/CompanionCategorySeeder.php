<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Models\CompanionCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompanionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Namoradinha', 'Dançarina', 'BDSM', 'Sugar Baby', 'Despedida de Solteiro', 
            'Cam Girls', 'Massagem', 'Tatuadas', 'Ménage à trois', 'Exóticas'
        ];

        foreach ($categories as $category) {
            CompanionCategory::create([
                'title' => $category,
                'slug' => Str::slug($category), 
                'active' => 1,
                'sorting' => 0,
            ]);
        }
    }
}
