<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use modules\Customers\Models\Customer;
use modules\Students\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Student::create([
            'name' => 'ali',
            'status' => 1,
            'order' => 2,
            'school_id' => 1,
        ]);

    }
}
