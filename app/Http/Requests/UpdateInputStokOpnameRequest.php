<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInputStokOpnameRequest extends FormRequest
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
            'nama_material' => 'required',
            'kode_material' => 'required',
            'jumlah_dilaporkan' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_material.required'     => 'Nama material wajib diisi.',
            'kode_material.required'     => 'Kode material wajib diisi.',
            'jumlah_dilaporkan.required' => 'Jumlah dilaporkan wajib diisi.',
            'jumlah_dilaporkan.numeric'  => 'Jumlah dilaporkan harus berupa angka.',
            'jumlah_dilaporkan.min'      => 'Jumlah dilaporkan tidak boleh kurang dari 0.',
        ];
    }
}
