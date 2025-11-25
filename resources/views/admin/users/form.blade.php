@extends('layouts.app', ['title' => 'Form User'])
@section('styles')
    <!-- Css -->
    <link rel="stylesheet" href="{{ asset('design-system/assets/libs/vanillajs-datepicker/css/datepicker.min.css') }}">
@endsection
@section('content')
    <form action="{{ isset($user) ? route('admin.user.update', $user->id) : route('admin.user.store') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @if (isset($user))
            @method('PUT')
        @endif
        @if (session('error'))
            <div class="mb-4 px-4 py-3 rounded-md bg-red-100 text-red-700 border border-red-300">
                {{ session('error') }}
            </div>
        @endif
        <div class="grid grid-cols-12 sm:grid-cols-12 md:grid-cols-12 lg:grid-cols-12 xl:grid-cols-12 gap-4 justify-between">
            <div
                class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-4 xl:col-span-4 shadow-md bg-white dark:bg-gray-900">
                <div class="w-full relative p-4">
                    {{-- tanggal  --}}
                    <x-input-v2 name="tanggal_lahir" label="Tanggal Lahir" :value="old('tanggal_lahir', $user->tanggal_lahir ?? '')" placeholder="" required="true"
                        type="text" />
                    {{-- email --}}
                    <x-input-v2 name="email" label="Email" :value="old('email', $user->email ?? '')" placeholder="Your email" required="true"
                        type="text" />
                    {{-- Tempat Lahir --}}
                    <x-input-v2 name="no_hp" label="No HP" :value="old('no_hp', $user->no_hp ?? '')" placeholder="Tempat Lahir" required="true"
                        type="text" />
                    {{-- Tempat Lahir --}}
                    <x-input-v2 name="agama" label="Agama" :value="old('agama', $user->agama ?? '')" placeholder="Tempat Lahir" required="true"
                        type="text" />
                    <!-- Password -->
                    <x-input-v1 name="password" label="Password" :value="old('password')" placeholder="Masukan password"
                        type="password" />
                    <!-- Jenis Kelamin Radio -->
                    <div class="mb-3">
                        <label class="font-semibold text-neutral-600 text-sm">Jenis Kelamin</label>
                        <div class="flex gap-4 mt-1">
                            @php $jenis_kelamin = old('jenis_kelamin', $user->jenis_kelamin ?? 'Laki-laki'); @endphp
                            <label class="flex items-center gap-2">
                                <input type="radio" name="jenis_kelamin" value="Laki-laki"
                                    {{ $jenis_kelamin === 'Laki-laki' ? 'checked' : '' }}>
                                <span>Laki-laki</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="radio" name="jenis_kelamin" value="Perempuan"
                                    {{ $jenis_kelamin === 'Perempuan' ? 'checked' : '' }}>
                                <span>Perempuan</span>
                            </label>
                        </div>
                    </div>
                </div><!--end card-->
            </div><!--end col-->
            <div
                class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-8 xl:col-span-8 shadow-md bg-white dark:bg-gray-900">
                <div class="w-full relative mb-4">
                    <div class="flex-auto p-0 sm:p-4">

                        {{-- nama lengkap --}}
                        <x-input-v2 name="nama_lengkap" label="Nama Lengkap" :value="old('nama_lengkap', $user->nama_lengkap ?? '')"
                            placeholder="Masukan Nama Lengkap" required="true" type="text" />
                        {{-- Tempat Lahir --}}
                        <x-input-v2 name="tempat_lahir" label="Tempat Lahir" :value="old('tempat_lahir', $user->tempat_lahir ?? '')" placeholder="Tempat Lahir"
                            required="true" type="text" />
                        <!-- status_perkawinan Radio -->
                        <div class="mb-3">
                            <label class="font-semibold text-neutral-600 text-sm">Status Perkawinan</label>
                            <div class="flex gap-4 mt-1">
                                @php $status_perkawinan = old('status_perkawinan', $user->status_perkawinan ?? 'Belum Menikah'); @endphp
                                <label class="flex items-center gap-2">
                                    <input type="radio" name="status_perkawinan" value="Belum Menikah"
                                        {{ $status_perkawinan === 'Belum Menikah' ? 'checked' : '' }}>
                                    <span>Belum Menikah</span>
                                </label>
                                <label class="flex items-center gap-2">
                                    <input type="radio" name="status_perkawinan" value="Menikah"
                                        {{ $status_perkawinan === 'Menikah' ? 'checked' : '' }}>
                                    <span>Menikah</span>
                                </label>
                                <label class="flex items-center gap-2">
                                    <input type="radio" name="status_perkawinan" value="Cerai"
                                        {{ $status_perkawinan === 'Cerai' ? 'checked' : '' }}>
                                    <span>Cerai</span>
                                </label>
                            </div>
                        </div>
                        <!-- Role Select -->
                        <div class="mb-3">
                            <label for="role" class="font-medium text-sm text-slate-600 dark:text-slate-400">Pilih
                                Role</label>
                            <select name="role" id="role"
                                class="w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-[6.5px] focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700">
                                @foreach ($roles as $item)
                                    <option value="{{ $item }}"
                                        {{ old('role', $user->role ?? '') === $item ? 'selected' : '' }}>
                                        {{ $item }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- alamat --}}
                        <x-textarea name="alamat_lengkap" label="Alamat Lengkap" :value="$user->alamat_lengkap ?? ''" :rows="4"
                            :required="true" />


                        <div class="mt-5">
                            <button onclick="{{ url()->previous() }}"
                                class="px-2 py-2 lg:px-4 bg-brand  text-white text-sm  rounded hover:bg-brand-600 border border-brand-500">Kembali</button>
                            <button type="submit"
                                class="px-2 py-2 lg:px-4 bg-transparent  text-brand text-sm  rounded transition hover:bg-brand-500 hover:text-white border border-brand font-medium">Simpan
                                Data</button>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
        </div> <!--end grid-->
    </form>
@endsection
@section('scripts')
    <script src="{{ asset('design-system/assets/libs/vanillajs-datepicker/js/datepicker-full.min.js') }}"></script>

    <script>
        var elem = document.querySelector('input[name="tanggal_lahir"]');
        new Datepicker(elem, {
            format: 'yyyy-mm-dd',
        });
    </script>
@endsection
