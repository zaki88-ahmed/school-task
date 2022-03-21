<?php


namespace modules\Students\Controllers;

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
use modules\Students\Interfaces\StudentInterface;
use modules\Students\Models\Student;
use modules\Students\Requests\StudentFormRequest;


class StudentController extends BaseController
{
    use ApiDesignTrait;

    private $studentInterface;

    public function __construct(StudentInterface $studentInterface)
    {
        $this->studentInterface = $studentInterface;
    }



    public function createStudent(StudentFormRequest $request){
        $this->authorize('create-student', Student::class);
        return $this->studentInterface->createStudent($request);
    }



    public function allStudents(){
        $this->authorize('allStudents', Student::class);
        return $this->studentInterface->allStudents();
//        return('sss');
    }


    public function studentDetails(StudentFormRequest $request){
        $this->authorize('studentDetails', Student::class);
        return $this->studentInterface->studentDetails($request);
    }


    public function updateStudent(StudentFormRequest $request){
        $this->authorize('updateStudent', Student::class);
        return $this->studentInterface->updateStudent($request);
    }



    public function softDeleteStudent(StudentFormRequest $request){
        $this->authorize('softDeleteStudent', Student::class);
        return $this->studentInterface->softDeleteStudent($request);
    }


    public function restoreStudent(StudentFormRequest $request){
        $this->authorize('restoreStudent', Student::class);
        return $this->studentInterface->restoreStudent($request);
    }

//    public function verify(Request $request, $id){
////        $this->authorize('restoreVendor', Customer::class);
//        return $this->studentInterface->verify($request, $id);
//    }


    public function orderStudents(){
        $this->authorize('allStudents', Student::class);
        return $this->studentInterface->orderStudents();
    }


}
