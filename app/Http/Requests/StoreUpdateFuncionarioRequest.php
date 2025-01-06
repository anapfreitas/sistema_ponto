<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateFuncionarioRequest extends FormRequest
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
        $funcionarioId = $this->route('funcionario')?->id ?? 'NULL';

        return [
            'nome' => 'required|string|max:255',
            'cpf' => "required|string|unique:funcionarios,cpf,{$funcionarioId},id",
            'cargo' => 'required|string|max:100',
            'salario' => 'required|numeric|min:0',
        ];
    }
}
