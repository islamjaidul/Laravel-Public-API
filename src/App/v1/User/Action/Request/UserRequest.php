<?php

namespace App\v1\User\Action\Request;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'email'         => 'required|email',
            'firstname'     => 'required',
            'lastname'      => 'required',
            'mobile'        => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required'        => 'The email field is required',
            'email.email'           => 'The email address is invalid',
            'firstname.required'    => 'The first name field is required',
            'lastname.required'     => 'The last name field is required',
            'mobile.required'       => 'The mobile field is required'
        ];
    }
}
