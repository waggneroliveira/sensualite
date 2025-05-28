<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory(1)->create();

        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            ModelHasRoleSeeder::class,
            ClientSeeder::class,
            CompanionCategorySeeder::class,
            CompanionSeeder::class,
        ]);
    }
}
