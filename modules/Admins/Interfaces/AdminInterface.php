<?php
namespace modules\Admins\Interfaces;


use modules\Admins\Models\Admin;
use modules\Admins\Requests\AdminFormRequest;
use modules\Admins\Requests\LoginAdminRequest;
use modules\Admins\Requests\StoreAdminRequest;
use modules\Admins\Requests\UpdateAdminRequest;

interface AdminInterface {

    public function login ($request);

    public function index();



    public function register ($request);


    public function logout ();
}
