 @extends('layouts.app', ['title' => 'Form Blok Perumahan'])
 @section('styles')
     <!-- CSS -->
     <link rel="stylesheet" href="{{ asset('design-system/assets/libs/mobius1-selectr/selectr.min.css') }}">
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
                             action="{{ isset($bloks) ? route('admin.blok.update', $bloks->id) : route('admin.blok.store') }}"
                             method="POST">
                             @csrf
                             @if (isset($bloks))
                                 @method('PUT')
                             @endif
                             {{-- Nama Blok --}}
                             <x-input-v2 name="nama" label="Nama Blok" :value="old('nama', $bloks->nama ?? '')" placeholder="Masukan Nama Blok"
                                 required="true" type="text" />
                             <x-select-search name="project_id" label="Perumahan" :options="$projects" :value="old('project_id', $projects->project_id ?? '')"
                                 selected="" placeholder="Pilih Perumahan..." />
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
     <script>
         new Selectr('#project_id');
     </script>
 @endsection
