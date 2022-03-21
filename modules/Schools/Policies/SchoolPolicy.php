<?php

namespace modules\Schools\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use modules\Admins\Interfaces\AdminInterface;
use modules\Admins\Models\Admin;
use modules\Customers\Models\Customer;
use phpDocumentor\Reflection\Types\True_;

class SchoolPolicy
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

    public function allSchools(Admin $admin){
//        return $admin->hasRole('admin');
        return $admin->hasPermissionTo('view-school');
    }


    public function createSchool(){
        $customer = auth('sanctum')->user();
        if($customer->hasPermissionTo('create-school')){
            return true;
        }
        return false;
    }

    public function updateSchool(){
        $customer = auth('sanctum')->user();
        if($customer->hasPermissionTo('edit-school')){
            return true;
        }
        return false;
    }

    public function SchoolDetails(){
        $customer = auth('sanctum')->user();
        if($customer->hasPermissionTo('view-school')) {
            return true;
        }
        return false;
    }

    public function softDeleteSchool(Admin $admin){
//        return $admin->hasRole('admin');
        return $admin->hasPermissionTo('delete-school');
    }

    public function restoreSchool(Admin $admin){
//        return $admin->hasRole('admin');
        return $admin->hasPermissionTo('restore-school');
    }

}
