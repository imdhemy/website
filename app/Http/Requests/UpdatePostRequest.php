<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required','string','max:100'],
            'body' => ['required'],
        ];
    }
    public function  getTitle(): string
    {
        return $this->input('title');
    }
    public function  getBody(): string
    {
        return $this->input('body');
    }
}
