<?php

namespace modules\Students\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use modules\Admins\Interfaces\AdminInterface;
use modules\Admins\Models\Admin;
use modules\Customers\Models\Customer;
use phpDocumentor\Reflection\Types\True_;

class StudentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function allStudents(Admin $admin){
//        return $admin->hasRole('admin');
        return $admin->hasPermissionTo('view-student');
    }

//    public function updatePassword(){
//        $customer = auth('sanctum')->user();
//        if($customer) {
//            return true;
//        }
//        return false;
//
//    }

    public function createStudent(){
        $customer = auth('sanctum')->user();
        if($customer->hasPermissionTo('create-student')){
            return true;
        }
        return false;
    }


    public function updateStudent(){
        $customer = auth('sanctum')->user();
        if($customer->hasPermissionTo('edit-student')){
            return true;
        }
        return false;
    }

    public function StudentDetails(){
        $customer = auth('sanctum')->user();
        if($customer->hasPermissionTo('view-student')) {
            return true;
        }
        return false;
    }

    public function softDeleteStudent(Admin $admin){
//        return $admin->hasRole('admin');
        return $admin->hasPermissionTo('delete-student');
    }

    public function restoreStudent(Admin $admin){
//        return $admin->hasRole('admin');
        return $admin->hasPermissionTo('restore-student');
    }


}
