 @extends('layouts.app', ['title' => 'Form Vendor'])
 @section('content')
     <div class="xl:w-full  min-h-[calc(100vh-152px)] relative pb-14">
         <div class="grid md:grid-cols-12 lg:grid-cols-12 xl:grid-cols-12 gap-4 mb-4">
             <div class="sm:col-span-12 md:col-span-12 lg:col-span-8 xl:col-span-6 xl:col-start-4 ">
                 <div
                     class="bg-white dark:bg-gray-900 border border-slate-200 dark:border-slate-700/40  rounded-md w-full max-w-2xl relative mb-4">
                     <div class="border-b border-slate-200 dark:border-slate-700/40 py-3 px-4 dark:text-slate-300/70">
                         <div class="flex-none md:flex">
                             <h4 class="font-medium text-lg flex-1 self-center mb-2 md:mb-0">Form Vendor</h4>
                         </div>
                     </div><!--end header-title-->
                     <div class="flex-auto p-4 ">
                         <form
                             action="{{ isset($vendor) ? route('admin.vendor.update', $vendor->id) : route('admin.vendor.store') }}"
                             method="POST">
                             @csrf
                             @if (isset($vendor))
                                 @method('PUT')
                             @endif
                             {{-- nama lengkap --}}
                             <x-input-v2 name="nama" label="Nama Lengkap" :value="old('nama', $vendor->nama ?? '')"
                                 placeholder="Masukan Nama Lengkap" required="true" type="text" />
                             {{-- Kontak Person --}}
                             <x-input-v2 name="kontak_person" label="Kontak Person" :value="old('kontak_person', $vendor->kontak_person ?? '')"
                                 placeholder="Kontak Person" required="true" type="text" />
                             {{-- Telepon --}}
                             <x-input-v2 name="telepon" label="No Handphone" :value="old('telepon', $vendor->telepon ?? '')" placeholder="0982123456789"
                                 required="true" type="number" />
                             {{-- email --}}
                             <x-input-v2 name="email" label="Email" :value="old('email', $vendor->email ?? '')" placeholder="Your email"
                                 required="true" type="email" />
                             {{-- alamat --}}
                             <x-textarea name="alamat" label="Alamat Lengkap" :value="$vendor->alamat ?? ''" :rows="4"
                                 :required="true" />

                             <x-button-modal />
                         </form>

                     </div>
                 </div>
             </div>
         </div>
     </div>
 @endsection
