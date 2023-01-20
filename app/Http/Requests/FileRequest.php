<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "files" => [
                "required", "file", "max:2000", "filled",
                "mimes:png,jpeg,css,html,js,jpg"
            ],
            "files.*" => [
                "file", "max:2000", "filled",
                "mimes:png,jpeg,css,html,js,jpg"
            ]
        ];
    }
}
