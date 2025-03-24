<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = ['hulutalent','hulutarget','Website Digitaliz', 'TNII','WEBSITE GIBS'];

        foreach($projects as $val){
            Project::create([
                'name'=>$val,
                'description'=> 'Lorem ipsum dolor sit amet consectetur adipiscing elit, diam vehicula iaculis arcu facilisi conubia ultrices, euismod risus himenaeos velit duis ne' 
            ]);
        }
    }
}
