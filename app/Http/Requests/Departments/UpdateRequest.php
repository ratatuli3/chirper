<?php

namespace App\Http\Requests\Departments;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        // dont' forget to set this as true
        return true;
    }

    public function rules(): array
    {
        // make all of the fields required, set featured image to accept only images
        return [
            'name' => 'required|string|min:3|max:250',
            'description' => 'required|string|min:3|max:6000',
        ];
    }
}
