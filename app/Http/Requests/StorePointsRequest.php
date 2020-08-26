<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePointsRequest extends FormRequest
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
            'action' => 'required|string|in:increment,decrement',
        ];
    }

    /**
     * Custom Messages
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'action.required' => 'The points increment/ decrement input not provided',
            'action.string' => 'The points action must be a string',
            'action.in' => 'This action can only be an increment or decrement',
        ];
    }

    /**
     * Handling failed validation
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
