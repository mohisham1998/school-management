<?php

use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassroomTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('classrooms')->delete();
        $classrooms = [
            ['en'=> 'First grade', 'ar'=> 'الصف الاول'],
            ['en'=> 'Second grade', 'ar'=> 'الصف الثاني'],
            ['en'=> 'Third grade', 'ar'=> 'الصف الثالث'],
            ['en'=> 'Fourth grade', 'ar'=> 'الصف الرابع'],
            ['en'=> 'Fifth grade', 'ar'=> 'الصف الخامس'],
            ['en'=> 'Sixth grade', 'ar'=> 'الصف السادس'],
        ];

        $Grades = [1,2,3];

        foreach ($Grades as $Grade) {
            foreach ($classrooms as $classroom) {
                Classroom::create([
                   'Name_Class' => $classroom,
                    'Grade_id' => $Grade
                ]);
            }
        }


//            Classroom::create([
//            'Name_Class' => $classrooms[0],
//            'Grade_id' => 1
//            ]);
//
//        Classroom::create([
//            'Name_Class' => $classrooms[1],
//            'Grade_id' => 2
//        ]);
//
//        Classroom::create([
//            'Name_Class' => $classrooms[2],
//            'Grade_id' => 3
//        ]);

    }
}
