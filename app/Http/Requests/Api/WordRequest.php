<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class WordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'firstname' => 'required',
            'word' => ['required', File::types(['mimetypes:application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/octet-stream'])]
        ];
    }
}
