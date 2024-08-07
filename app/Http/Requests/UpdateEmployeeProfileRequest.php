<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeProfileRequest extends FormRequest
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
            'employee_id' => 'required|exists:employees,id',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female',
            'position' => 'required|string|max:255',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_relationship' => 'required|string|max:255',
            'emergency_contact_number' => 'required|string|max:15',
            'emergency_contact_address' => 'required|string|max:255',
        ];
    }
    public function messages()
    {
        return [
            'employee_id.required' => 'Employee ID is required.',
            'employee_id.exists' => 'Employee does not exist.',
            // Define other custom messages if needed
        ];
    }
}
