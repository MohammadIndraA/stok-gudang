<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GrnRequest extends FormRequest
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
            'nomor_grn'     => 'required|string|unique:goods_receipt_notes,nomor_grn|max:50',
            'po_id'         => 'required|uuid|exists:purchase_orders,id',
            'diterima_oleh' => 'required|uuid|exists:users,id',
            'tanggal_terima'=> 'required|date',
            'catatan'       => 'nullable|string|max:500',
        ];
    }

     public function messages(): array
    {
        return [
            'nomor_grn.required' => 'Nomor GRN wajib diisi.',
            'nomor_grn.unique'   => 'Nomor GRN sudah digunakan, silakan gunakan nomor lain.',
            'nomor_grn.max'      => 'Nomor GRN maksimal 50 karakter.',
            
            'po_id.required'     => 'Purchase Order wajib dipilih.',
            'po_id.uuid'         => 'Format PO ID tidak valid.',
            'po_id.exists'       => 'Purchase Order tidak ditemukan.',

            'diterima_oleh.required' => 'Penerima wajib diisi.',
            'diterima_oleh.uuid'     => 'Format penerima tidak valid.',
            'diterima_oleh.exists'   => 'User penerima tidak ditemukan.',

            'tanggal_terima.required' => 'Tanggal penerimaan wajib diisi.',
            'tanggal_terima.date'     => 'Format tanggal penerimaan tidak valid.',

            'catatan.string' => 'Catatan harus berupa teks.',
            'catatan.max'    => 'Catatan maksimal 500 karakter.',
        ];
    }
}
