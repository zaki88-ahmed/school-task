<?php

namespace modules\Admins\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use modules\Admins\Interfaces\AdminInterface;
use modules\Admins\Models\Admin;
use modules\Customers\Models\Customer;
use phpDocumentor\Reflection\Types\True_;

class AdminsPolicy
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

    public function allAdmins(Admin $admin){
//        return $admin->hasRole('admin');
        return $admin->hasPermissionTo('view-admin');
    }


    public function restoreAdmin(Admin $admin){
//        return $admin->hasRole('admin');
        return $admin->hasPermissionTo('restore-admin');
    }


}
