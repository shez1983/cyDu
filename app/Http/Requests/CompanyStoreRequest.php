<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyStoreRequest extends FormRequest
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
        return [
            'name' => 'required|unique:companies,name',
            'email' => 'required|email|unique:companies,email',
            'website' => 'required|url',
            'logo' => 'required|image|max:1024|dimensions:min_width=100,min_height=100',
        ];
    }
}
