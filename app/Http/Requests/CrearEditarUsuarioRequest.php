<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearEditarUsuarioRequest extends FormRequest
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
        $usuario = $this->route()->parameter('usuario');

        return [
            'name'=>'required|max:191',
            'password'=> is_null($usuario) ? 'required' : '',
            'email'=>'required|max:191|unique:users,email,'.(is_null($usuario)?'':$usuario->id),
            'cai_id'=>'array'.(is_null($usuario)?'|required':''),
            'cai_id.*'=>'integer',
            'activo'=>'integer|nullable',
            'role_id'=>'required|integer'
        ];
    }
}