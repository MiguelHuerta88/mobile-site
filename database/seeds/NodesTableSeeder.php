<?php

use Illuminate\Database\Seeder;

class NodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nodes')->insert([
            'type' => 'about',
            'title' => 'About'
        ]);
        
        DB::table('nodes')->insert([
            'type' => 'project',
            'title' => 'Projects'
        ]);
        
        DB::table('nodes')->insert([
            'type' => 'download',
            'title' => 'Downloads'
        ]);
    }
}