<?php

namespace modules\Admins\Repositories;

use Exception;
use Carbon\Carbon;
use modules\Admins\Interfaces\AdminInterface;
use modules\Admins\Requests\AdminFormRequest;
use modules\BaseRepository;
use modules\Admins\Models\Admin;
use App\Http\Traits\ApiDesignTrait;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use modules\Admins\Requests\StoreAdminRequest;
use modules\Admins\Requests\UpdateAdminRequest;
use modules\Admins\Requests\LoginAdminRequest;

class AdminRepository extends BaseRepository implements AdminInterface
{
    use ApiDesignTrait;



    public function login ($request)
    {
        $data = $request->all();
        return $this->auth('admin', $data);
    }



    public function index()
    {
        try {
            $admins = Admin::get();
            return $this->ApiResponse(Response::HTTP_OK, 'message',Null,$admins);
        } catch (Exception $e) {
            return $this->ApiResponse(Response::HTTP_NO_CONTENT,null, 'No data provided');
        }
    }


    public function register($request)
    {
        $data = $request->all();
        try{
            $admin = Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            ]);
            $admin->assignRole('admin');

        } catch (Exception $e) {
            return $this->ApiResponse(Response::HTTP_NO_CONTENT, 'Validation Problem');
        }
        return $this->ApiResponse(Response::HTTP_OK,'Admin Created Successfully',null,$admin);
    }



    public function logout()
    {
        $admin = auth('sanctum')->user();
        $admin->tokens()->where('id', $admin->currentAccessToken()->id)->delete();
        return $this->ApiResponse(Response::HTTP_OK, 'Admin logged out', null);
    }


}
