<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'academic_year' => [
                'required',
                'in:Year 1 (Freshman),Year 2 (Sophomore),Year 3 (Junior),Year 4 (Senior),Postgraduate',
            ],
            'allowance_baseline' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
            'savings_goal' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
        ];
    }
}
