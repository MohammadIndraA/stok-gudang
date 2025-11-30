<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaterialRancanganRequest extends FormRequest
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
            // kode_material otomatis generate → tidak perlu divalidasi saat create
            'nama_material' => ['required', 'string', 'max:255', 'unique:material_rancangans,nama_material'],
            'satuan'        => ['required', 'string', 'max:50'],
            'kategori'      => ['nullable', 'string', 'max:100'],
            'stok_minimum'  => ['required', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_material.required' => 'Nama material wajib diisi.',
            'nama_material.unique' => 'Nama material Sudah Ada.',
            'nama_material.string'   => 'Nama material harus berupa teks.',
            'nama_material.max'      => 'Nama material maksimal 255 karakter.',

            'satuan.required'        => 'Satuan wajib diisi (contoh: sak, m³, buah).',
            'satuan.string'          => 'Satuan harus berupa teks.',
            'satuan.max'             => 'Satuan maksimal 50 karakter.',

            'kategori.string'        => 'Kategori harus berupa teks.',
            'kategori.max'           => 'Kategori maksimal 100 karakter.',

            'stok_minimum.required'  => 'Stok minimum wajib diisi.',
            'stok_minimum.integer'   => 'Stok minimum harus berupa angka.',
            'stok_minimum.min'       => 'Stok minimum tidak boleh kurang dari 0.',
        ];
    }
}
