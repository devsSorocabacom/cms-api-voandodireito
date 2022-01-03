<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResultRequest extends FormRequest
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
            'phone' => 'required|min:8',
            'email' => 'required|email|unique:results',
            'name' => 'required',
            'results' => 'required|array'
        ];
    }

    public function messages()
    {
        return [
            'phone.required'=>'Campo de telefone é obrigatório',
            'phone.min'=>'Campo de telefone é inválido',
            'email.required'=>'Campo de email é obrigatório',
            'email.unique'=>'Este email já foi cadastrado',
            'email.email'=>'Este email não é válido',
            'name.required'=>'Campo de nome é obrigatório',
            'results.required'=>'Campo de resultados é obrigatório',
            'results.array'=>'Campo de resultados precisa ser um array',
        ];
    }
}
