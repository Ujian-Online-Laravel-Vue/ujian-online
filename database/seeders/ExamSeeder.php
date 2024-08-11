<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exams')->insert([
            [
                'school_id' => 1,
                'lesson_id' => 1,
                'classroom_id' => 1,
                'title' => 'Mathematics Exam',
                'duration' => 60,
                'description' => 'Final exam for Mathematics',
                'random_question' => 'Y',
                'random_answer' => 'Y',
                'show_answer' => 'N',
            ],
            [
                'school_id' => 2,
                'lesson_id' => 2,
                'classroom_id' => 2,
                'title' => 'Science Exam',
                'duration' => 45,
                'description' => 'Midterm exam for Science',
                'random_question' => 'Y',
                'random_answer' => 'Y',
                'show_answer' => 'N',
            ],
        ]);
    }
}
