<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use modules\Cities\Models\City;
use modules\Countries\Models\Country;
use modules\Schools\Interfaces\SchoolInterface;
use modules\Vendors\Models\Customer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RoleAndPermissionsSeeder::class);
        $this->call(SchoolSeeder::class);
        $this->call(StudentSeeder::class);
    }
}
