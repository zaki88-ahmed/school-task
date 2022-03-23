<?php

namespace App\Http\Controllers;

use App\Mail\ContactResponseMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use modules\Schools\Models\School;
use modules\Schools\Resources\SchoolResource;
use modules\Students\Models\Student;

class SampleController extends Controller
{
    //

    public function sendMail()
    {

        $admin = auth('sanctum')->user();
        $schools = School::orderBy('id', 'DESC')->with('students')->get();
        $students = Student::orderBy('id', 'DESC')->with('schools')->get();
//        $reOrderedStudents = SchoolResource:: collection($schools);


        Mail::to($admin->email)->send(
            new ContactResponseMail($admin, $schools)
        );

        echo "<h3>" . 'Mail Sent Successfully' . "</h3>";
    }
}
