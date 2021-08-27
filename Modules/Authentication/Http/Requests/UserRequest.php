<?php

namespace Authentication\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('user');
        return [
            'name' => "required|max:255",
            'email' => [
                "required",
                'max:255',
                Rule::unique('users', 'email')->ignore($id)
            ],
//            'cpf' => [
//                "required",
//                "max:255",
//                "cpf",
//                Rule::unique('users', 'cpf')->ignore($id)
//            ],
            'password' => 'nullable|string|min:6|confirmed',
            'roles.*' => 'nullable|exists:roles,id'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function all($keys = null)
    {
        $all = parent::all($keys);
//        if (isset($all['cpf'])) {
//            $all['cpf'] = str_numbers($all['cpf']);
//        }
        $all['ativo'] = isset($all['ativo']);
        if (isset($all['roles'])) {
            $all['roles'] = array_filter($all['roles']);
        }
        return $all;
    }
}
