<?php

namespace modules\Students\Requests;

use Illuminate\Foundation\Http\FormRequest;
use modules\Customers\Rules\MatchOldPassword;

class StudentFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

            return $this->getStudentRules($this->input('class'));

    }



    public function getStudentRules($class)
    {
        $rules = [];
        switch($class){
            case "createStudent":
                $rules = [
                    'name'                  => 'required',
                    'status'                 => 'required|in:0, 1',
                    'order'              => 'required|Integer',
                    'school_id'      => 'required|exists:schools,id'
                ];
                break;
//            case "login":
//                $rules = [
//                    'email' => 'required|email|exists:customers,email',
//                    'password' =>  'required',
//                ];
//                break;
//            case "updatePassword":
//                $rules = [
//                    'old_password' => ['required', new MatchOldPassword],
//                    'new_password' =>  'required',
//                ];

            case "updateStudent":
                $rules = [
                    'student_id'      => 'required|exists:students,id',
                    'name'                  => 'required',
                    'status'                 => 'required|in:0, 1',
                    'order'              => 'required|Integer',
                    'school_id'      => 'required|exists:schools,id'
                ];
                break;
            case "studentDetails":
                $rules = [
                    'student_id' => 'required|exists:students,id'
                ];
                break;
            case "softDeleteStudent":
                $rules = [
                    'student_id' => 'required|exists:students,id'
                ];
                break;
            case "restoreStudent":
                $rules = [
                    'student_id' => 'required|exists:students,id'
                ];
                break;

        }
        return $rules;
    }
}
