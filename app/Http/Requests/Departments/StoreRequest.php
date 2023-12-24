<?php

namespace App\Http\Requests\Departments;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        // dont' forget to set this as true
        return true;
    }

    public function rules(): array
    {
        // make all of the fields required
        return [
            'name' => 'required|string|min:3|max:250',
            'description' => 'required|string|min:3|max:6000',
            'parent_id' => 'int|nullable'
        ];
    }
}
