<?php

use Illuminate\Database\Seeder;

class SocialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('socials')->insert([
            'title' => 'fb',
            'url' => 'https://www.facebook.com/miguel.huerta.73'
        ]);
        
        DB::table('socials')->insert([
            'title' => 'link',
            'url' => 'https://www.linkedin.com/in/miguel-huerta-83b59b59'
        ]);
        
        DB::table('socials')->insert([
            'title' => 'google',
            'url' => 'https://plus.google.com/u/0/112932328586384869869/about'
        ]);
        
        DB::table('socials')->insert([
            'title' => 'git',
            'url' => 'https://github.com/MiguelHuerta88'
        ]);
    }
}