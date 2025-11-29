<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermintaanMaterialRequest extends FormRequest
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
            'kapling_id' => ['required', 'exists:kaplings,id'],
            'aplikator_id' => ['required', 'exists:aplikators,id'],
            'status'    => ['required', 'in:draft,diajukan,disetujui,dibatalkan'],
            'catatan'   => ['nullable', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'kapling_id.required' => 'Kapling harus dipilih',
            'aplikator_id.required' => 'Aplikator harus dipilih',
            'kapling_id.exists'   => 'Kapling tidak ditemukan',
            'aplikator_id.exists'   => 'Aplikator tidak ditemukan',
            'status.required'    => 'Status harus dipilih',
            'status.in'          => 'Status hanya boleh draft, diajukan, disetujui, atau dibatalkan',
            'catatan.string'     => 'Catatan harus berupa teks',
        ];
    }
}
