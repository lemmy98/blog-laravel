<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorearticleRequest extends FormRequest
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
            "title" => "required|unique:articles,title",
            "body" => "required",
            "published_at" => "required",
        ];
    }

    public function messages()
    {
       return [
           "title.unique" => "There is an article with the same title, please provide another title"
       ];
    }
}
