<?php

use  App\College;
use Illuminate\Database\Seeder;

class CollegesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        College::create([
            'college_name'=> 'Faculty of Sacred Theology'
        ]);

        College::create([
            'college_name'=> 'Faculty of Philosophy'
        ]);

        College::create([
            'college_name'=> 'Faculty of Canon Law'
        ]);

        College::create([
            'college_name'=> 'Faculty of Civil Law'
        ]);

        College::create([
            'college_name'=> 'Faculty of Medicine and Surgery'
        ]);

        College::create([
            'college_name'=> 'Faculty of Pharmacy'
        ]);

        College::create([
            'college_name'=> 'Faculty of Arts and Letters'
        ]);

        College::create([
            'college_name'=> 'Faculty of Engineering'
        ]);

        College::create([
            'college_name'=> 'College of Education'
        ]);

        College::create([
            'college_name'=> 'College of Science'
        ]);

        College::create([
            'college_name'=> 'College of Architecture'
        ]);

        College::create([
            'college_name'=> 'College of Commerce and Business Administration'
        ]);

        College::create([
            'college_name'=> 'Conservatory of Music'
        ]);

        College::create([
            'college_name'=> 'College of Nursing'
        ]);

        College::create([
            'college_name'=> 'College of Rehabilitation Sciences'
        ]);

        College::create([
            'college_name'=> 'College of Fine Arts & Design'
        ]);

        College::create([
            'college_name'=> 'Alfredo M. Velayo College of Accountancy'
        ]);

        College::create([
            'college_name'=> 'College of Tourism and Hospitality Management'
        ]);

        College::create([
            'college_name'=> 'Institute of Physical Education and Athletics'
        ]);
        
        College::create([
            'college_name'=> 'Institute of Information and Computing Sciences'
        ]);




    }
}
