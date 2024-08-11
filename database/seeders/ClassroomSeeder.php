<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classrooms')->insert([
            ['title' => 'Class 1A'],
            ['title' => 'Class 2B'],
            ['title' => 'Class 3C'],
        ]);
    }
}
