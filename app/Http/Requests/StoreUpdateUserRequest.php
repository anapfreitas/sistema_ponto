<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateUserRequest extends FormRequest
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
     */
    public function rules(): array
    {
        $userId = $this->route('user'); 

        return [
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$userId},id",
            'password' => $this->isMethod('post') ? 'required|min:4' : 'nullable|min:4', 
            'role' => 'required|string|in:admin,funcionario',
        ];
    }
}
