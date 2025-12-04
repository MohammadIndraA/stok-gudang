 @extends('layouts.app', ['title' => 'Form Laporan stok opname Material'])
 @section('content')
     <div class="xl:w-full  min-h-[calc(100vh-152px)] relative pb-14">
         <div class="grid md:grid-cols-12 lg:grid-cols-12 xl:grid-cols-12 gap-4 mb-4">
             <div class="sm:col-span-12 md:col-span-12 lg:col-span-8 xl:col-span-6 xl:col-start-4 ">
                 <div
                     class="bg-white dark:bg-gray-900 border border-slate-200 dark:border-slate-700/40  rounded-md w-full max-w-2xl relative mb-4">
                     <div class="border-b border-slate-200 dark:border-slate-700/40 py-3 px-4 dark:text-slate-300/70">
                         <div class="flex-none md:flex">
                             <h4 class="font-medium text-lg flex-1 self-center mb-2 md:mb-0">Form Laporan stok opname
                                 Material</h4>
                         </div>
                     </div><!--end header-title-->
                     <div class="flex-auto p-4 ">
                         <form action="{{ route('admin.stok-opname.input.update', $ipso->id) }}" method="POST">
                             @csrf
                             @if (isset($ipso))
                                 @method('PUT')
                             @endif
                             {{-- kode Matrial --}}
                             <x-input-v2 name="kode_material" readonly="true" label="Kode Matterial" :value="old('kode_material', $ipso->material->kode_material ?? '')"
                                 placeholder="Masukan Nama Material" required="true" type="text" />
                             {{-- nama Matrial --}}
                             <x-input-v2 name="nama_material" readonly="true" label="Nama Matterial" :value="old('nama_material', $ipso->material->nama_material ?? '')"
                                 placeholder="Masukan Nama Material" required="true" type="text" />
                             {{-- stok Matrial --}}
                             <x-input-v2 name="jumlah_stok" readonly="true" label="Stok" :value="old('jumlah_stok', $ipso->material->current_stock ?? '')"
                                 placeholder="Masukan Nama Material" required="true" type="text" />
                             {{-- stok Matrial --}}
                             <x-input-v2 name="jumlah_dilaporkan" label="Jumlah Di Laporkan" :value="old('jumlah_dilaporkan', $ipso->jumlah_dilaporkan ?? '')"
                                 placeholder="Masukan Nama Material" required="true" type="text" />
                             <x-textarea name="keterangan" label="Keterangan" :value="$ipso->keterangan ?? ''" :rows="2"
                                 :required="false" />
                             <x-button-modal />
                         </form>

                     </div>
                 </div>
             </div>
         </div>
     </div>
 @endsection
