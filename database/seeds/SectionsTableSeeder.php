<?php

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->delete();

        $classrooms = [1,2,3,4,5,6];

        $Grades = [1,2,3];


        $Sections = [
            ['en' => 'a', 'ar' => 'ا'],
            ['en' => 'b', 'ar' => 'ب'],
            ['en' => 'c', 'ar' => 'ج'],
            ['en' => 'd', 'ar' => 'د'],
        ];

//        foreach ($Sections as $section) {
//            Section::create([
//                'Name_Section' => $section,
//                'Status' => 1,
//                'Grade_id' => Grade::all()->unique()->random()->id,
//                'Class_id' => ClassRoom::all()->unique()->random()->id
//            ]);
//        }

        foreach ($Grades as $Grade) {
            foreach ($classrooms as $classroom) {
                foreach ($Sections as $section) {
                    Section::create([
                       'Name_Section' => $section,
                        'Status' => 1,
                        'Grade_id' => $Grade,
                        'Class_id' => $classroom
                    ]);


                }
            }
        }


    }
}
