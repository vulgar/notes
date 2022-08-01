<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTagRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // HERE IS WHERE YOU WOULD CHECK FOR WHETHER THE USER IS AUTHENTICATED
        // IF NOT IT WOULD RETURN FALSE
        // AS THIS IS A SIMPLIFIED APPLICATION, I WILL ALWAYS RETURN TRUE
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required|unique:tags|max:100'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Blank tags are not allowed',
            'name.unique' => 'Duplicate tags are not allowed',
            'name.max' => 'Tags cannot be more than 100 characters',
        ];
    }
}
