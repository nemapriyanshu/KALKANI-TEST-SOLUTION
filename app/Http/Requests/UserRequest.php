<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'firstname'=>'required',
            'lastname'=>'required',
            'mobilenumber'=>[
                'required',
                'regex:/^(\+?\d{1,3}[- ]?)?\d{10}$/'
            ],
            'email'=>'required|email|unique:users',
            'address1'=>'required',
            'pincode'=>'required|min:4|max:6',
            'city'=>'required',
            'state'=>'required',
            'type'=>'required|in:Home,Office',
            'password'=>[
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
            ],
            'age' =>[
                'required', 
                'regex:/^\d+$/'
            ]
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }

    public function messages(){
        return [
            'type.required' => 'The Type Must be Home or Office',
        ];
    }
}
