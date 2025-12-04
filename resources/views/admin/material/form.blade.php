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
                             action="{{ isset($material) ? route('admin.material.update', $material->id) : route('admin.material.store') }}"
                             method="POST">
                             @csrf
                             @if (isset($material))
                                 @method('PUT')
                             @endif
                             {{-- nama Matrial --}}
                             <x-input-v2 name="nama_material" label="Nama Matterial" :value="old('nama_material', $material->nama_material ?? '')"
                                 placeholder="Masukan Nama Material" required="true" type="text" />
                             {{-- Satuan --}}
                             <x-input-v2 name="satuan" label="Satuan" :value="old('satuan', $material->satuan ?? '')" placeholder="sak, m3"
                                 required="true" type="text" />
                             {{-- Stok Sekarang --}}
                             <x-input-v2 name="current_stock" label="Stok Sekarang" :value="old('current_stock', $material->current_stock ?? '')"
                                 placeholder="Stok Sekarang" required="true" type="number" />
                             {{-- Stok Minimun --}}
                             <x-input-v2 name="stok_minimum" label="Stok Minimun" :value="old('stok_minimum', $material->stok_minimum ?? '')"
                                 placeholder="Stok Minimun" required="true" type="number" />
                             {{-- Berat --}}
                             <x-input-v2 name="berat_per_satuan" label="Berat Per Satuan" :value="old('berat_per_satuan', $material->berat_per_satuan ?? '')"
                                 placeholder="Satuan" required="" type="text" />
                             <!-- is_rakitan Radio -->
                             <div class="mb-3">
                                 <label class="font-semibold text-neutral-600 text-sm">Rakitan</label>
                                 <div class="flex gap-4 mt-1">
                                     @php $is_rakitan = old('is_rakitan', $aplikator->is_rakitan ?? 'Ya'); @endphp
                                     <label class="flex items-center gap-2">
                                         <input type="radio" name="is_rakitan" value="1"
                                             {{ $is_rakitan === '1' ? 'checked' : '' }}>
                                         <span>Ya</span>
                                     </label>
                                     <label class="flex items-center gap-2">
                                         <input type="radio" name="is_rakitan" value="0"
                                             {{ $is_rakitan === '0' ? 'checked' : '' }}>
                                         <span>Tidak</span>
                                     </label>
                                 </div>
                             </div>
                             {{-- Harga Satuan --}}
                             <x-input-v2 name="harga_satuan" label="Harga Satuan" :value="old('harga_satuan', $material->harga_satuan ?? '')" placeholder="10000"
                                 required="true" type="number" />


                             <x-button-modal />
                         </form>

                     </div>
                 </div>
             </div>
         </div>
     </div>
 @endsection
