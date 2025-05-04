<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $students = [];
        // $schools = [1, 2, 3]; // Daftar ID sekolah
        // $classrooms = [1, 2, 3]; // Daftar ID kelas

        // foreach ($schools as $schoolId) {
        //     foreach ($classrooms as $classroomId) {
        //         for ($i = 1; $i <= 20; $i++) {
        //             $students[] = [
        //                 'classroom_id' => $classroomId,
        //                 'school_id' => $schoolId,
        //                 'nisn' => $schoolId . $classroomId . str_pad($i, 4, '0', STR_PAD_LEFT), // NISN unik
        //                 'name' => 'Student ' . $schoolId . $classroomId . $i,
        //                 'password' => 'password',
        //                 'gender' => $i % 2 == 0 ? 'L' : 'P', // Ganti gender untuk setiap siswa
        //                 'created_at' => now(),
        //                 'updated_at' => now(),
        //             ];
        //         }
        //     }
        // }

        $students = [
            'classroom_id' => 1,
            'school_id' => 1,
            'nisn' => '12345678',
            'name' => 'Andhika Wijaya',
            'password' => 'password',
            'gender' => 'L',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table('students')->insert($students);
    }
}
