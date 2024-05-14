<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fname' => 'required|string|max:255',
            'mname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'phone' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'address' => 'required|string',
            'blood_type' => 'required|string|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'allergies' => 'required|string',
            'medical_history' => 'required|string',
            'height' => 'required|numeric|between:0,999.99',
            'weight' => 'required|numeric|between:0,999.99',
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'fname.required' => 'The first name field is required.',
            'mname.required' => 'The middle name field is required.',
            'allergies.required' => 'The allergies field is required.',
            'medical_history.required' => 'The medical history field is required.',
            'lname.required' => 'The last name field is required.',
            'gender.required' => 'The gender field is required.',
            'gender.in' => 'Please select a valid gender.',
            'phone.required' => 'The phone field is required.',
            'birthdate.required' => 'The birthdate field is required.',
            'birthdate.date' => 'The birthdate must be a valid date.',
            'address.required' => 'The address field is required.',
            'blood_type.required' => 'The blood type field is required.',
            'blood_type.size' => 'Please select a valid blood type.',
            'height.required' => 'The height field is required.',
            'height.numeric' => 'The height must be a number.',
            'height.between' => 'The height must be between 0 and 999.99.',
            'weight.required' => 'The weight field is required.',
            'weight.numeric' => 'The weight must be a number.',
            'weight.between' => 'The weight must be between 0 and 999.99.',
            'username.required' => 'The username field is required.',
            'password.required' => 'The password field is required.',
        ];
    }

}
