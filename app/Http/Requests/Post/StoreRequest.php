<?php

namespace App\Http\Requests\Post;

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
            'email' => 'required|string|min:3|max:6000',
            'usertype' => 'required|string|min:3|max:600|',
            'password' => 'required|string|min:3|max:600|',
        ];
    }
}
