<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'unique:posts', 'min:10','max:255', 'regex:/[a-zA-Z0-9]{3,}/i', 'not_regex:/^[\s{}.+$]/i'],
            'extract' => ['required', 'max:255'],
            'body' => ['required', 'min:255'],
            'category_id' => ['required', 'integer'],
            'cover' => ['required', 'image', 'mimes:jpg,jpeg,png'],
            'tags' => ['array']
        ];
    }
}
