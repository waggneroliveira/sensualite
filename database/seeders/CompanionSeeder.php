<?php

namespace Database\Seeders;

use App\Models\Companion;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\CompanionCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompanionSeeder extends Seeder
{

    public function run(): void
    {
        $faker = Faker::create('pt_BR');

        $categoryIds = CompanionCategory::pluck('id')->toArray();

        for ($i = 1; $i <= 24; $i++) {
            $name = $faker->firstName . ' ' . $faker->lastName;
            
            $companion = Companion::create([
                'name' => $name,
                'slug' => Str::slug($name), 
                'gender' => $faker->randomElement(['masculino', 'feminino', 'trans']),
                'description' => 'Lorem ipsum dolor sit amet consectetur. Feugiat fermentum imperdiet non in scelerisque. Metus sit sit sed tortor.', 
                'mention' => Str::replace('-', '', Str::slug(Str::lower($name))), 
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'), 
                'active' => $faker->boolean(80), // 80% de chance de ser ativo
                'top_love' => $faker->boolean(10),
                'phone' => $faker->cellphoneNumber(false, true), // Gera número de celular no formato nacional
                'go_out_with' => $faker->randomElement(['Homens', 'Mulheres', 'Ambos']),
                'age' => $faker->numberBetween(18, 45),
                'type' => $faker->randomElement(['Premium', 'Standard', 'VIP']),
                'body_type' => $faker->randomElement(['Magro', 'Atlético', 'Corpulento']),
                'height' => $faker->numberBetween(150, 190), // Altura em cm
                'weight' => $faker->numberBetween(50, 90), // Peso em kg
                'shoe_size' => $faker->numberBetween(35, 45), // Tamanho do calçado
                'eye_color' => $faker->randomElement(['Azul', 'Verde', 'Castanho', 'Preto']),
                'availability' => $faker->randomElement([
                    'Segunda a Sexta, 9h às 18h',
                    'Fim de semana, 10h às 22h',
                    'Todos os dias, 24h',
                ]),
                'meeting_places' => $faker->randomElement([
                    'Hotéis',
                    'Residências',
                    'Eventos',
                    'Hotéis e Residências',
                ]),
                'rate' => $faker->randomFloat(2, 100, 1000), // Valor entre R$ 100,00 e R$ 1000,00
                'payment_methods' => $faker->randomElement([
                    'Dinheiro',
                    'Cartão de Crédito',
                    'Pix',
                    'Dinheiro e Pix',
                ]),
                'available_for_travel' => $faker->boolean(50), // 50% de chance de aceitar viagens
            ]);

            // Seleciona até 5 categorias aleatórias para o Companion e insere na tabela pivot
            $selectedCategories = $faker->randomElements($categoryIds, rand(1, 5));
            foreach ($selectedCategories as $categoryId) {
                DB::table('companion_category_has_companions')->insert([
                    'companion_id' => $companion->id,
                    'companion_category_id' => $categoryId,
                ]);
            }
        }
    }
}
