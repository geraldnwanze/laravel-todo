<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
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
            'email' => 'required|email|max:255',
            'password' => 'required|max:255',
            'g-recaptcha-response' => 'required'
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = $this->only(['email', 'password']);
        return $data;
    }

    public function messages()
    {
        return [
            'g-recaptcha-response.required' => 'Please verify that you are human'
        ];
    }

    public function withInput()
    {
        return true;
    }

}
