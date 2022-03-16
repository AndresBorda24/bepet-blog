<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'slug' => Str::slug($this->name),
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
            'slug.unique' => 'Please change the name :3',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (request()->isMethod('POST')) {
            return [
                'name' => ['required', 'unique:categories,name', 'max:50', "min:3"],
                'slug' => ['required', 'unique:categories,slug']
            ];
        }

        if (request()->isMethod('PUT')) {
            return [
                'name' => ['required', 'unique:categories,name,' . $this->route('category')->id, 'max:50', "min:3"],
                'slug' => ['required', 'unique:categories,slug,' . $this->route('category')->id]
            ];
        }
    }
}
