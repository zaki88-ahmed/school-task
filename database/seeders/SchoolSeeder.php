<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use modules\Customers\Models\Customer;
use modules\Schools\Models\School;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        School::create([
            'name' => 'SchoolName',
            'status' => 1,
        ]);

    }
}
