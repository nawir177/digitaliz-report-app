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
    //    call
        $this->call([
          RoleSeeder::class,
          DivisionSeeder::class,
          UserSeeder::class,
          ProjectSeeder::class
        ]);
    }
}
