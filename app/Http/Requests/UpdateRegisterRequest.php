<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateRegisterRequest extends FormRequest
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
        $passwordRules = Password::min(6)->letters()->numbers()->mixedCase()->symbols()->uncompromised();

        return [
            'email' => 'required|email|email:dns|max:255',
            'name' => 'required|max:255',
            'password' => ['required', 'confirmed', $passwordRules]
        ];
    }

    public function withInput()
    {
        return true;
    }
}
