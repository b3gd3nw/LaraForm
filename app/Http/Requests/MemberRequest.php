<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
        return [
            'firstname' => 'required|max:20|alpha',
            'lastname' => 'required|max:20|regex:/^[a-zA-Z]+$/u',
            'birthdate' => 'required|date',
            'reportsubject' => 'required|max:100',
            'countryId' => 'required',
            'email' => 'required|regex:/^[^@\s]+@[^@\s]+\.[^@\s]+$/',
            'phone' => 'required',
            'company' => 'max:100',
            'position' => 'max:100',
            'aboutme' => 'max:500',
            'photo' => 'max:2048 | mimes:jpeg,jpg,png | image'
        ];
    }
}
