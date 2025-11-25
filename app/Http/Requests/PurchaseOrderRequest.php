<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseOrderRequest extends FormRequest
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
            'vendor_id' => ['required', 'exists:vendors,id'],
            'status'    => ['required', 'in:draft,diajukan,disetujui,dibatalkan'],
            'catatan'   => ['nullable', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'vendor_id.required' => 'Vendor harus dipilih',
            'vendor_id.exists'   => 'Vendor tidak ditemukan',
            'status.required'    => 'Status harus dipilih',
            'status.in'          => 'Status hanya boleh draft, diajukan, disetujui, atau dibatalkan',
            'catatan.string'     => 'Catatan harus berupa teks',
        ];
    }
}
