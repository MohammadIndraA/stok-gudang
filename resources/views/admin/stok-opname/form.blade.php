 @extends('layouts.app', ['title' => 'Form Blok Perumahan'])
 @section('styles')
     <!-- CSS -->
     <link rel="stylesheet" href="{{ asset('design-system/assets/libs/mobius1-selectr/selectr.min.css') }}">
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
                             <h4 class="font-medium text-lg flex-1 self-center mb-2 md:mb-0">Form Blok Perumahan</h4>
                         </div>
                     </div><!--end header-title-->
                     <div class="flex-auto p-4 ">
                         <form
                             action="{{ isset($periode) ? route('admin.stok-opname.periode.update', $periode->id) : route('admin.stok-opname.periode.store') }}"
                             method="POST">
                             @csrf
                             @if (isset($periode))
                                 @method('PUT')
                             @endif
                             {{-- Tanggal Mulai --}}
                             <x-input-v2 name="tanggal_mulai" label="Tanggal Mulai" :value="old('tanggal_mulai', $periode->tanggal_mulai ?? '')"
                                 placeholder="Tanggal Mulai" required="true" type="text" />
                             {{-- Tanggal Selesai --}}
                             <x-input-v2 name="tanggal_selesai" label="Tanggal Selesai" :value="old('tanggal_selesai', $periode->tanggal_selesai ?? '')"
                                 placeholder="Tanggal Selesai" required="true" type="text" />
                             <!-- is Active -->
                             <div class="mb-3">
                                 <label class="font-semibold text-neutral-600 text-sm">Status</label>
                                 <div class="flex gap-4 mt-1">
                                     @php $is_active = old('is_active', $periode->is_active ?? 0); @endphp

                                     <label class="flex items-center gap-2">
                                         <input type="radio" name="is_active" value="1"
                                             {{ $is_active == 1 ? 'checked' : '' }}>
                                         <span>Aktif</span>
                                     </label>

                                     <label class="flex items-center gap-2">
                                         <input type="radio" name="is_active" value="0"
                                             {{ $is_active == 0 ? 'checked' : '' }}>
                                         <span>Tidak Aktif</span>
                                     </label>
                                 </div>
                             </div>

                             {{ isset($periode) ? 'Jika Tidak di aktif kan maka tidak dapat melakukan stok opname' : 'Pastikan Periode sebleumnya sudah selesai sebelum mengektifkan periode ini ' }}
                             <div class="mb-4"></div>
                             <x-button-modal />
                         </form>

                     </div>
                 </div>
             </div>
         </div>
     </div>
 @endsection
 @section('scripts')
     <script src="{{ asset('design-system/assets/libs/mobius1-selectr/selectr.min.js') }}"></script>
     <script src="{{ asset('design-system/assets/js/pages/form-advanced.init.js') }}"></script>
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
     <script>
         new Selectr('#project_id');
     </script>
 @endsection
