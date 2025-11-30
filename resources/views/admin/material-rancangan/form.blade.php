 @extends('layouts.app', ['title' => 'Form Material'])
 @section('content')
     <div class="xl:w-full  min-h-[calc(100vh-152px)] relative pb-14">
         <div class="grid md:grid-cols-12 lg:grid-cols-12 xl:grid-cols-12 gap-4 mb-4">
             <div class="sm:col-span-12 md:col-span-12 lg:col-span-8 xl:col-span-6 xl:col-start-4 ">
                 <div
                     class="bg-white dark:bg-gray-900 border border-slate-200 dark:border-slate-700/40  rounded-md w-full max-w-2xl relative mb-4">
                     <div class="border-b border-slate-200 dark:border-slate-700/40 py-3 px-4 dark:text-slate-300/70">
                         <div class="flex-none md:flex">
                             <h4 class="font-medium text-lg flex-1 self-center mb-2 md:mb-0">Form Material</h4>
                         </div>
                     </div><!--end header-title-->
                     <div class="flex-auto p-4 ">
                         <form
                             action="{{ isset($bom) ? route('admin.material-rancangan.update', $bom->id) : route('admin.material-rancangan.store') }}"
                             method="POST">
                             @csrf
                             @if (isset($bom))
                                 @method('PUT')
                             @endif
                             {{-- nama Matrial --}}
                             <x-input-v2 name="nama_material" label="Nama Matterial" :value="old('nama_material', $bom->nama_material ?? '')"
                                 placeholder="Masukan Nama Material" required="true" type="text" />
                             {{-- Satuan --}}
                             <x-input-v2 name="satuan" label="Satuan" :value="old('satuan', $bom->satuan ?? '')" placeholder="Satuan"
                                 required="true" type="text" />
                             {{-- Stok Minimum --}}
                             <x-input-v2 name="stok_minimum" label="Stok Minimum" :value="old('stok_minimum', $bom->stok_minimum ?? '')" placeholder="200"
                                 required="true" type="number" />

                             <x-button-modal />
                         </form>

                     </div>
                 </div>
             </div>
         </div>
     </div>
 @endsection
