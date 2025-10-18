<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VacancyStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:100'],
            'work_schedule' => ['required', 'string', 'min:10'],
            'salary' => ['required', 'string', 'max:50'],
            'numberOfSpecialist' => ['required', 'int'],
            'gender' => ['required', 'string', 'max:30'],
            'experience' => ['required', 'string', 'max:100'],
            'responsibilities' => ['required', 'string', 'min:10'],
            'conditions' => ['required', 'string', 'min:10'],
            'addInformation' => ['nullable', 'string', 'min:10']
        ];
    }
}
