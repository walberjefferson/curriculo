<?php

namespace Authentication\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Authentication\Models\Role;
use Authentication\Repositories\RoleRepository;

class RoleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('role');
        return [
            'name' => [
                "required",
                "max:255",
                Rule::unique('roles', 'name')->ignore($id)
            ],
            'description' => 'max:255'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $role = Role::query()->where('name', config('authentication.acl.role_admin'))->first();
        return $this->route('role') != $role->id;
    }
}
