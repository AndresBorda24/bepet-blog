<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Support\Str;

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
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->title),
        ]);
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'slug.unique' => 'Please change the title :3',
        ];
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
            'slug' => 'unique:posts,slug,' . $this->route('post')->id,
            'extract' => 'required|max:255',
            'body' => 'required|min:500',
            'category_id' => 'required|integer',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png',
            'tags' => 'array'
        ];
    }
}
