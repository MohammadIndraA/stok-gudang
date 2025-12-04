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
    public function rules()
    {
        return [
            'material_id' => 'required|uuid|unique:material_rakitans,material_id',
            'keterangan'  => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'material_id.required' => 'Material rakitan wajib dipilih.',
            'material_id.uuid'     => 'Format ID material tidak valid.',
            'material_id.unique'   => 'Material rakitan ini sudah terdaftar.',

            'keterangan.string'    => 'Keterangan harus berupa teks.',
            'keterangan.max'       => 'Keterangan maksimal 255 karakter.',
        ];
    }
}
