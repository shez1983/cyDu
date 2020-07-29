<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = (int) $this->route()->parameter('company');

        return [
            'name' => [
                'required',
                Rule::unique('companies', 'name')->ignore($id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('companies', 'email')->ignore($id),
            ],
            'website' => 'required|url',
            'logo' => 'image|max:1024|dimensions:min_width=100,min_height=100',
        ];
    }
}
