<?php

namespace modules\Admins\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminFormRequest extends FormRequest
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

            return $this->getAdminRules($this->input('class'));

    }



    public function getAdminRules($class)
    {
        $rules = [];
        switch($class){
            case "register":
                $rules = [
                    'name' =>  'required',
                    'email' => 'required|email|unique:admins,email',
                    'password' =>  'required',
                ];
                break;
            case "login":
                $rules = [
                    'email' => 'required|email|exists:admins,email',
                    'password' =>  'required',
                ];
                break;

        }
        return $rules;
    }
}
