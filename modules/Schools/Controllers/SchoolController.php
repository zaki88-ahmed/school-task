<?php


namespace modules\Schools\Controllers;

use App\Http\Traits\ApiDesignTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Hash, Validator
};
use modules\BaseController;
use modules\Customers\Interfaces\CustomerInterface;
use modules\Customers\Models\Customer;
use modules\Customers\Requests\CustomerFormRequest;
use modules\Customers\Requests\OrderFormRequest;
use modules\Customers\Requests\LoginRequest;
use modules\Customers\Requests\RegisterRequest;
use modules\Customers\Requests\UpdateCustomerRequest;
use modules\Customers\Requests\UpdatePasswordRequest;
use modules\Schools\Interfaces\SchoolInterface;
use modules\Schools\Models\School;
use modules\Schools\Requests\SchoolFormRequest;


class SchoolController extends BaseController
{
    use ApiDesignTrait;

    private $schoolInterface;

    public function __construct(SchoolInterface $schoolInterface)
    {
        $this->schoolInterface = $schoolInterface;
    }


    public function createSchool(SchoolFormRequest $request){
        $this->authorize('create-school', School::class);
        return $this->schoolInterface->createSchool($request);
    }



    public function allSchools(){
        $this->authorize('allSchools', School::class);
        return $this->schoolInterface->allSchools();
//        return('sss');
    }


    public function schoolDetails(SchoolFormRequest $request){
        $this->authorize('schoolDetails', School::class);
        return $this->schoolInterface->schoolDetails($request);
    }


    public function updateSchool(SchoolFormRequest $request){
        $this->authorize('updateSchool', School::class);
        return $this->schoolInterface->updateSchool($request);
    }



    public function softDeleteSchool(SchoolFormRequest $request){
        $this->authorize('softDeleteSchool', School::class);
        return $this->schoolInterface->softDeleteSchool($request);
    }


    public function restoreSchool(SchoolFormRequest $request){
        $this->authorize('restoreSchool', School::class);
        return $this->schoolInterface->restoreSchool($request);
    }


}
