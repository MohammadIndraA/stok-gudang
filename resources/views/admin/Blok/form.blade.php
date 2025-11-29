 @extends('layouts.app', ['title' => 'Form Perumahan'])
 @section('styles')
     <!-- Css -->
     <link rel="stylesheet" href="{{ asset('design-system/assets/libs/vanillajs-datepicker/css/datepicker.min.css') }}">
 @endsection
 @section('content')
     <div class="xl:w-full  min-h-[calc(100vh-152px)] relative pb-14">
         <div class="grid md:grid-cols-12 lg:grid-cols-12 xl:grid-cols-12 gap-4 mb-4">
             <div class="sm:col-span-12 md:col-span-12 lg:col-span-8 xl:col-span-6 xl:col-start-4 ">
                 <div
                     class="bg-white dark:bg-gray-900 border border-slate-200 dark:border-slate-700/40  rounded-md w-full max-w-2xl relative mb-4">
                     <div class="border-b border-slate-200 dark:border-slate-700/40 py-3 px-4 dark:text-slate-300/70">
                         <div class="flex-none md:flex">
                             <h4 class="font-medium text-lg flex-1 self-center mb-2 md:mb-0">Form Perumahan</h4>
                         </div>
                     </div><!--end header-title-->
                     <div class="flex-auto p-4 ">
                         <form
                             action="{{ isset($vendor) ? route('admin.project.update', $vendor->id) : route('admin.project.store') }}"
                             method="POST">
                             @csrf
                             @if (isset($vendor))
                                 @method('PUT')
                             @endif
                             {{-- Nama Perumahan --}}
                             <x-input-v2 name="nama_proyek" label="Nama Perumahan" :value="old('nama_proyek', $vendor->nama_proyek ?? '')"
                                 placeholder="Masukan Nama Perumahan" required="true" type="text" />
                             {{-- Tanggal Mulai --}}


                             <x-button-modal />
                         </form>

                     </div>
                 </div>
             </div>
         </div>
     </div>
 @endsection
 @section('scripts')
     <script src="{{ asset('design-system/assets/libs/vanillajs-datepicker/js/datepicker-full.min.js') }}"></script>

     <script>
         var elem = document.querySelector('input[name="tanggal_mulai"]');
         new Datepicker(elem, {
             format: 'yyyy-mm-dd',
         });
         var elem = document.querySelector('input[name="tanggal_selesai"]');
         new Datepicker(elem, {
             format: 'yyyy-mm-dd',
         });
     </script>
 @endsection
