<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use modules\Admins\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RoleAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => "Admin",
            'email' =>'admin@gmail.com',
            'password' =>Hash::make('123456'),
        ]);


        Role::create(['name'=>'admin', 'guard_name' => 'admin']);
        Role::create(['name'=>'student', 'guard_name' => 'student']);

        DB::table('model_has_roles')->insert([
            'role_id' => 1,
            'model_id' => 1,
            'model_type' => 'modules\Admins\Models\Admin'
        ]);



        $permissions = [
            'create-admin', 'edit-admin', 'view-admin', 'delete-admin', 'restore-admin',
            'create-student', 'edit-student', 'delete-student', 'view-student', 'restore-student',
            'create-school', 'edit-school', 'view-school', 'delete-school', 'restore-school',
        ];

//        $adminPermissions = ['create-admin', 'edit-admin', 'view-admin', 'delete-admin', 'restore-admin',
//            'create-customer', 'edit-customer', 'delete-customer', 'view-customer', 'restore-customer',
//            'create-product', 'edit-product', 'delete-product', 'restore-product',
//            'view-order', 'create-user', 'edit-user', 'delete-user', 'view-user', 'restore-user'];

//        $customerPermissions = ['view-order', 'create-order', 'edit-order', 'delete-order', 'restore-order',
//            'edit-customer', 'view-customer'];
//
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'admin']);
        }
//
//        foreach ($customerPermissions as $permission) {
//            Permission::create(['name' => $permission, 'guard_name' => 'customer']);
//        }

        $admin = Admin::get()->first();
        $admin->assignRole('admin');

        $roleAdmin = Role::first();
        $roleAdmin->givePermissionTo($permissions);

//        $roleUser = Role::findById(3);
//        $roleUser->givePermissionTo(['create-product', 'edit-product', 'view-product', 'delete-product', 'restore-product',
//            'create-customer', 'edit-customer', 'view-customer', 'view-order', 'edit-user', 'view-user']);



    }
}
