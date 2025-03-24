<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $division = ['prorammer', 'ui_ux', 'admin', 'project manager', 'konten kreator'];
        foreach ($division as $div) {
            \App\Models\Division::create([
                'name' => $div,
                'slug' => Str::slug($div)
            ]);
        }
    }
}
