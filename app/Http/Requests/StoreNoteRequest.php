<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNoteRequest extends FormRequest
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
            'title'=>'required|max:100|unique:notes,title',
            'description'=>'required|max:500',
            'tags'=>'sometimes|array|exists:tags,id',
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
            'title.required' => 'Title is required',
            'title.unique' => 'Duplicate titles are not allowed',
            'title.max' => 'Titles cannot be more than 100 characters',
            'tags.array'=>'Tags must be an array of ids.',
            'tags.exists'=>'Tags must exist in the tags table to be associated'
        ];
    }

}
