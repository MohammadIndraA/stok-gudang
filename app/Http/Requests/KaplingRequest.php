<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KaplingRequest extends FormRequest
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
            'nama' => 'unique:kaplings,nama|required',
            'blok_id' => ['required', 'exists:bloks,id'],
        ];
    }

    public function messages()
    {
        return [
            'nama.required'      => 'Nama wajib diisi.',
            'nama.unique'        => 'Nama sudah digunakan.',
            'blok_id.required' => 'Perumahan harus dipilih',

        ];
    }
}
