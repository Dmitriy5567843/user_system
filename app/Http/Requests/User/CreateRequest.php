<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'name' => ['required' ,'max:255','unique:users,name'],
            'email' => ['required','email','unique:users,email', 'min:6','max:255'],
            'description' => ['max:255'],
            'password' => ['required','min:6', 'max:20' ],
            'role' => ['required','in:admin,user'],
            'image' => ['image','mimes:jpeg,png,jpg','max:2048']
        ];
    }
}
