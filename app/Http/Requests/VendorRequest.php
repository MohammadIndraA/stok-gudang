<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
            'nama'          => ['required', 'string', 'max:255'],
            'kontak_person' => ['nullable', 'string', 'max:255'],
            'telepon'       => ['nullable', 'string', 'max:20'],
            'email'         => ['nullable', 'email', 'max:255'],
            'alamat'        => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required'          => 'Nama wajib diisi.',
            'nama.string'            => 'Nama harus berupa teks.',
            'nama.max'               => 'Nama maksimal 255 karakter.',

            'kontak_person.string'   => 'Kontak person harus berupa teks.',
            'kontak_person.max'      => 'Kontak person maksimal 255 karakter.',

            'telepon.string'         => 'Nomor telepon harus berupa teks.',
            'telepon.max'            => 'Nomor telepon maksimal 20 karakter.',

            'email.email'            => 'Format email tidak valid.',
            'email.max'              => 'Email maksimal 255 karakter.',

            'alamat.string'          => 'Alamat harus berupa teks.',
        ];
    }
}
