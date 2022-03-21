<?php

namespace modules\Schools\Repositories;

use App\Http\Traits\ApiDesignTrait;
use Carbon\Carbon;
use Carbon\Traits\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use modules\BaseRepository;

use modules\Schools\Interfaces\SchoolInterface;
use modules\Schools\Models\School;

class SchoolRepository extends BaseRepository implements SchoolInterface
{

    use ApiDesignTrait;

    public function createSchool($request)
    {
        $validator = Validator::make($request->all(), [
            'name'                  => 'required',
            'status'                 => 'required|in:0, 1',
        ]);
        if($validator->fails()) {
            return $this->ApiResponse(400, 'Validation Errors', $validator->errors());
        }
        $school = School::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return $this->ApiResponse(200, 'School Is Created', null,  $school);
    }



    public function allSchools()
    {
        // TODO: Implement allVendors() method.
        $schools = School::orderBy('id', 'DESC')->get();
        return $this->ApiResponse(200, 'All Schools', null, $schools);
    }



    public function schoolDetails($request)
    {
        // TODO: Implement vendorDetails() method.
        $validator = Validator::make($request->all(), [
            'school_id'      => 'required|exists:schools,id',
        ]);
        if($validator->fails()) {
            return $this->ApiResponse(400, 'Validation Errors', $validator->errors());
        }

        $school = School::find($request->school_id);
        if (is_null($school)) {
            return $this->ApiResponse(400, 'No School Found');
        }

        return $this->ApiResponse(200, 'Student details', null, $school);
    }

    public function updateSchool($request)
    {
        // TODO: Implement updateVendor() method.

        $validator = Validator::make($request->all(), [

            'school_id'      => 'required|exists:schools,id',
            'name'                  => 'required',
            'status'                 => 'required|in:0, 1',
        ]);
        if($validator->fails()) {
            return $this->ApiResponse(400, 'Validation Errors', $validator->errors());
        }

        $school = School::find($request->school_id);
        if (is_null($school)) {
            return $this->ApiResponse(400, 'No School Found');
        }
        $school->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);
        return $this->apiResponse(200, 'School updated successfully', null, $school);
    }


    public function softDeleteSchool($request)
    {
        // TODO: Implement softDeleteVendor() method.
        $school = School::find($request->school_id);
        if (is_null($school)) {
            return $this->ApiResponse(400, 'No School Found');
        }
        $school->delete();
        return $this->apiResponse(200,'School deleted successfully');
    }


    public function restoreSchool($request)
    {

        // TODO: Implement restoreVendor() method.
        $school = School::withTrashed()->find($request->school_id);

        if (!is_null($school->deleted_at)) {
            $school->restore();
            return $this->ApiResponse(200,'School restored successfully');
        }
        return $this->ApiResponse(200,'School already restored');
    }



}
