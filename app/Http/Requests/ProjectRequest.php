<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'nama_proyek'     => ['required', 'string', 'max:255'],
            'lokasi'          => ['nullable', 'string', 'max:255'],
            'tanggal_mulai'   => ['nullable', 'date'],
            'tanggal_selesai' => ['nullable', 'date', 'after_or_equal:tanggal_mulai'],
            'status'          => ['required', 'in:aktif,selesai,dibatalkan'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_proyek.required'     => 'Nama proyek wajib diisi.',
            'nama_proyek.string'       => 'Nama proyek harus berupa teks.',
            'nama_proyek.max'          => 'Nama proyek maksimal 255 karakter.',

            'lokasi.string'            => 'Lokasi harus berupa teks.',
            'lokasi.max'               => 'Lokasi maksimal 255 karakter.',

            'tanggal_mulai.date'       => 'Tanggal mulai harus berupa tanggal yang valid.',
            'tanggal_selesai.date'     => 'Tanggal selesai harus berupa tanggal yang valid.',
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai tidak boleh lebih awal dari tanggal mulai.',

            'status.required'          => 'Status proyek wajib diisi.',
            'status.in'                => 'Status proyek hanya boleh: aktif, selesai, atau dibatalkan.',
        ];
    }
}
