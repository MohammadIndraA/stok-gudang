<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

      protected function isUpdate(): bool
    {
        return $this->isMethod('put') || $this->isMethod('patch');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'nama_lengkap'      => 'required|string|max:255|unique:users,nama_lengkap',
            'tempat_lahir'      => 'required|string|max:255',
            'tanggal_lahir'     => 'required|date|before:today',
            'jenis_kelamin'     => 'required|in:Laki-laki,Perempuan',
            'agama'             => 'required|string|max:50',
            'status_perkawinan' => 'required|in:Belum Menikah,Menikah,Cerai',
            'alamat_lengkap'    => 'required|string',
            'no_hp'             => 'required|string|regex:/^[0-9]{10,15}$/',
            'email'             => $this->isUpdate() ? 'required|email':'required|email|unique:users,email',
            'password'          =>  $this->isUpdate()
                ? 'nullable|min:6|string' :'required|string|min:6',
        ];
    }

     public function messages()
    {
        return [
            'nama_lengkap.required'      => 'Nama lengkap wajib diisi.',
            'nama_lengkap.unique'        => 'Nama lengkap sudah digunakan.',
            'tempat_lahir.required'      => 'Tempat lahir wajib diisi.',
            'tanggal_lahir.required'     => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date'         => 'Format tanggal lahir tidak valid (YYYY-MM-DD).',
            'tanggal_lahir.before'       => 'Tanggal lahir harus sebelum hari ini.',
            'jenis_kelamin.required'     => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in'           => 'Jenis kelamin hanya boleh Laki-laki atau Perempuan.',
            'agama.required'             => 'Agama wajib diisi.',
            'status_perkawinan.required' => 'Status perkawinan wajib dipilih.',
            'status_perkawinan.in'       => 'Status perkawinan hanya boleh Belum Menikah, Menikah, atau Cerai.',
            'alamat_lengkap.required'    => 'Alamat lengkap wajib diisi.',
            'no_hp.required'             => 'Nomor HP wajib diisi.',
            'no_hp.regex'                => 'Nomor HP harus berupa angka 10-15 digit.',
            'email.required'             => 'Email wajib diisi.',
            'email.email'                => 'Format email tidak valid.',
            'email.unique'               => 'Email sudah digunakan.',
            'password.required'          => 'Password wajib diisi.',
            'password.min'               => 'Password minimal 8 karakter.',
            'password.confirmed'         => 'Konfirmasi password tidak sesuai.',
        ];
    }
}
