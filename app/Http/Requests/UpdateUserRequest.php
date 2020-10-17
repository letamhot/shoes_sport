<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\MatchOldPassword;


class UpdateUserRequest extends FormRequest
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
            'current_password' => ['required', new MatchOldPassword],
            'name' => ['string', 'min: 5', 'max:255'],
            'phone' => ['numeric', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:9', \Illuminate\Validation\Rule::unique('users')->ignore($this->user()->id)],
            'address' => ['max:255', 'min: 5'],
            'image' => ['image', 'mimes:png,jpg,jpeg', 'max:8000'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return    array
     */
    public function messages()
    {
        return [];
    }
}