<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePontoRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'exists:users,id',
            'data_entrada' => 'nullable|date',
            'hora_entrada' => 'nullable|date_format:H:i',
            'data_saida' => 'nullable|date',
            'hora_saida' => 'nullable|date_format:H:i|after:hora_entrada',
        ];
    }
}
