<?php

namespace modules\Students\Repositories;

use App\Events\ReorderEventMail;
use App\Http\Traits\ApiDesignTrait;
use App\Mail\ContactResponseMail;
use Carbon\Carbon;
use Carbon\Traits\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use modules\BaseRepository;
use modules\Schools\Models\School;
use modules\Schools\Resources\SchoolResource;
use modules\Students\Interfaces\StudentInterface;
use modules\Students\Models\Student;
use modules\Students\Resources\StudentResource;

class StudentRepository extends BaseRepository implements StudentInterface
{

    use ApiDesignTrait;



    public function createStudent($request)
    {
        $validator = Validator::make($request->all(), [
            'name'                  => 'required',
            'status'                 => 'required|in:0, 1',
            'order'              => 'required|Integer',
            'school_id'      => 'required|exists:schools,id'
        ]);
        if($validator->fails()) {
            return $this->ApiResponse(400, 'Validation Errors', $validator->errors());
        }
        $student = Student::create([
            'name' => $request->name,
            'status' => $request->status,
            'order' => $request->order,
            'school_id' => $request->school_id,

        ]);

        $student->assignRole('student');
        return $this->ApiResponse(200, 'Student Is Created', null,  new StudentResource($student));
    }






    public function allStudents()
    {
        // TODO: Implement allVendors() method.
        $students = Student::orderBy('id', 'DESC')->get();
        return $this->ApiResponse(200, 'All Students', null,  StudentResource:: collection($students));
    }



    public function studentDetails($request)
    {
        // TODO: Implement vendorDetails() method.
        $validator = Validator::make($request->all(), [
            'student_id'      => 'required|exists:students,id',
        ]);
        if($validator->fails()) {
            return $this->ApiResponse(400, 'Validation Errors', $validator->errors());
        }

        $student = Student::find($request->student_id);
        if (is_null($student)) {
            return $this->ApiResponse(400, 'No Student Found');
        }

        return $this->ApiResponse(200, 'Student details', null, new StudentResource($student));
    }

    public function updateStudent($request)
    {
        // TODO: Implement updateVendor() method.

        $validator = Validator::make($request->all(), [

            'student_id'      => 'required|exists:students,id',
            'name'                  => 'required',
            'status'                 => 'required|in:0, 1',
            'order'              => 'required|Integer',
            'school_id'      => 'required|exists:schools,id'
        ]);
        if($validator->fails()) {
            return $this->ApiResponse(400, 'Validation Errors', $validator->errors());
        }

        $student = Student::find($request->student_id);
        if (is_null($student)) {
            return $this->ApiResponse(400, 'No Student Found');
        }
        $student->update([
            'name' => $request->name,
            'status' => $request->status,
            'order' => $request->order,
            'school_id' => $request->school_id,
        ]);
        return $this->apiResponse(200, 'Student updated successfully', null, new StudentResource($student));
    }


    public function softDeleteStudent($request)
    {
        // TODO: Implement softDeleteVendor() method.
        $student = Student::find($request->student_id);
        if (is_null($student)) {
            return $this->ApiResponse(400, 'No Student Found');
        }
        $student->delete();
        return $this->apiResponse(200,'Student deleted successfully');
    }


    public function restoreStudent($request)
    {

        // TODO: Implement restoreVendor() method.
        $student = Student::withTrashed()->find($request->student_id);

        if (!is_null($student->deleted_at)) {
            $student->restore();
            return $this->ApiResponse(200,'Student restored successfully');
        }
        return $this->ApiResponse(200,'Student already restored');
    }



    public function orderStudents()
    {

        $admin = auth('sanctum')->user();
        $schools = School::orderBy('id', 'DESC')->with('students')->get();
        $students = Student::orderBy('id', 'DESC')->with('schools')->get();
//        $reOrderedStudents = SchoolResource:: collection($schools);


        Mail::to($admin->email)->send(
            new ContactResponseMail($admin, $schools)
        );
        return $this->ApiResponse(200, 'Students Ordered By Schools', null, SchoolResource:: collection($schools));
    }
}
