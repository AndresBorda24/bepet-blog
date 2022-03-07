<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->id === $this->route('post')->user_id || auth()->user()->role_id === \App\Models\Role::IS_ADMIN;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:posts,title,' . $this->route('post')->id,
            'extract' => 'required|max:255',
            'body' => 'required|min:500',
            'category_id' => 'required|integer',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png',
            'tags' => 'array'
        ];
    }
}
