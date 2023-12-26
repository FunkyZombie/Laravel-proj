<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use App\Enums\NewsStatus;


class Update extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'categories'    => ['required', 'array'],
            'categories.*'  => ['exists:categories,id'],
            'title'         => ['required', 'string', 'min:7', 'max:200'],
            'author'        => ['required', 'string', 'min:3', 'max:50'],
            'image'         => ['sometimes', 'image', 'mimes:jpg,bmp,png'],
            'status'        => ['required', new Enum(NewsStatus::class)],
            'description'   => ['nullable', 'string', 'max:3000']
        ];
    }

    public function getCategories(): array
    {
        return $this->validated('categories');
    }
}
