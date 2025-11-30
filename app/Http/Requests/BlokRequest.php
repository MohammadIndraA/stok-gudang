<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlokRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'unique:bloks,nama|required',
            'project_id' => ['required', 'exists:projects,id'],

        ];
    }

    public function messages()
    {
        return [
            'nama.required'      => 'Nama wajib diisi.',
            'nama.unique'        => 'Nama sudah digunakan.',
            'project_id.required' => 'Perumahan harus dipilih',

        ];
    }
}
