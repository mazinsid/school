<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
    
        'file' => 'max:10',

        ];
    }
    public function messages()
{
    return [
        'type.required' => 'A title is required',
 
    ];
}
}
