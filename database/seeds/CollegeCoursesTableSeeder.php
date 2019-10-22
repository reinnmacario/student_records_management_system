<?php
use App\CollegeCourse;
use Illuminate\Database\Seeder;

class CollegeCoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CollegeCourse::create([
        	'college_id' => 1,
            'course_name'=> 'Doctor of Sacred Theology'
        ]);

        CollegeCourse::create([
            'college_id' => 1,
            'course_name'=> 'Licentiate in Sacred Theology'
        ]);

        CollegeCourse::create([
            'college_id' => 1,
            'course_name'=> 'Bachelor of Sacred Theology'
        ]);


        CollegeCourse::create([
            'college_id' => 2,
            'course_name'=> 'Doctor of Philosophy'
        ]);

        CollegeCourse::create([
            'college_id' => 2,
            'course_name'=> 'Licentiate in Philosophy'
        ]);

        CollegeCourse::create([
            'college_id' => 2,
            'course_name'=> 'Bachelor of Philosophy (Classical)'
        ]);

        CollegeCourse::create([
            'college_id' => 3,
            'course_name'=> 'Doctor of Canon Law'
        ]);

        CollegeCourse::create([
            'college_id' => 3,
            'course_name'=> 'Licentiate in Canon Law'
        ]);

        CollegeCourse::create([
            'college_id' => 3,
            'course_name'=> 'Bachelor of Canon Law'
        ]);

        CollegeCourse::create([
            'college_id' => 4,
            'course_name'=> 'Bachelor of Laws'
        ]);

        CollegeCourse::create([
            'college_id' => 5,
            'course_name'=> 'Doctor of Medicine'
        ]);

        CollegeCourse::create([
            'college_id' => 5,
            'course_name'=> 'Master in Clinical Audiology'
        ]);

        CollegeCourse::create([
            'college_id' => 5,
            'course_name'=> 'Master in Pain Management'
        ]);


        CollegeCourse::create([
            'college_id' => 6,
            'course_name'=> 'Bachelor of Science in Pharmacy'
        ]);

        CollegeCourse::create([
            'college_id' => 6,
            'course_name'=> 'Bachelor of Science in Clinical Pharmacy'
        ]);

        CollegeCourse::create([
            'college_id' => 6,
            'course_name'=> 'Bachelor of Science in Medical Technology'
        ]);

        CollegeCourse::create([
            'college_id' => 6,
            'course_name'=> 'Bachelor of Science in Biochemistry'
        ]);



    }
}
