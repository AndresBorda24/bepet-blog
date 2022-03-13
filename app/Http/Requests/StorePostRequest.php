<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Support\Str;

class StorePostRequest extends FormRequest
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
            'title' => ['required', 'unique:posts', 'min:10','max:255', 'regex:/[a-zA-Z0-9]{3,}/i', 'not_regex:/^[\s{}.+$]/i'],
            'slug' => ['unique:posts'],
            'extract' => ['required', 'max:255'],
            'body' => ['required', 'min:255'],
            'category_id' => ['required', 'integer'],
            'cover' => ['required', 'image', 'mimes:jpg,jpeg,png'],
            'tags' => ['array']
        ];
    }
}
