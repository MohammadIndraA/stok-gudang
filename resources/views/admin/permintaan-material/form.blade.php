 @extends('layouts.app', ['title' => 'Form Material'])
 @section('styles')
     <!-- CSS -->
     <link rel="stylesheet" href="{{ asset('design-system/assets/libs/mobius1-selectr/selectr.min.css') }}">
 @endsection
 @section('content')
     <div
         class="grid grid-cols-12 sm:grid-cols-12 md:grid-cols-12 lg:grid-cols-12 xl:grid-cols-12 gap-4 bg-white shadow shadow-sm dark:bg-[#06090f]">
         <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12">
             <div class="border-b border-slate-200 dark:border-slate-700/40 py-3 px-4 dark:text-slate-300/70">
                 <div class="flex-none md:flex">
                     <h4 class="font-medium text-lg flex-1 self-center mb-2 md:mb-0">Form Material</h4>
                 </div>
             </div><!--end header-title-->
             <form class="grid grid-cols-12 gap-6 p-6 m-4" id="form-material-item">
                 {{-- Kapling --}}
                 <div class="col-span-12 md:col-span-4">
                     <x-select-search name="kapling_id" label="Kapling" :options="$kaplings" :value="old('kapling_id', $kaplings->kapling_id ?? '')" selected=""
                         placeholder="Pilih kapling..." />
                 </div>
                 {{-- Aplikator --}}
                 <div class="col-span-12 md:col-span-4 ms-3">
                     <x-select-search name="aplikator_id" label="Aplikator" :options="$aplikators" :value="old('aplikator_id', $aplikators->aplikator_id ?? '')"
                         selected="" placeholder="Pilih Aplikator..." />
                 </div>
                 {{-- status --}}
                 @php
                     $status = [
                         (object) ['id' => 'draft', 'nama' => 'draft'],
                         (object) ['id' => 'diajukan', 'nama' => 'diajukan'],
                         (object) ['id' => 'disetujui', 'nama' => 'disetujui'],
                         (object) ['id' => 'ditolak', 'nama' => 'ditolak'],
                     ];
                 @endphp
                 <div class="col-span-12 md:col-span-4 ms-3">
                     <x-select name="status" label="Status" :options="$status" :value="isset($at) ? $at->status : null" :required="false" />
                 </div>
                 {{-- catatan --}}
                 <div class="col-span-12 md:col-span-12">
                     <x-textarea name="catatan" label="Catatan" :value="$vendor->catatan ?? ''" :rows="2" :required="false" />
                 </div>

                 {{-- material --}}
                 <div class="col-span-12 md:col-span-5 me-4">
                     <x-select-search name="material_id" label="Material" :value="old('material_id', $vendor->material_id ?? '')" placeholder="Pilih material..."
                         :options="$materials" />
                 </div>

                 {{-- Jumlah Diminta --}}
                 <div class="col-span-12 md:col-span-2 me-4">
                     <x-input-v2 name="jumlah_diminta" label="Jumlah Diminta" :value="old('jumlah_diminta', $vendor->jumlah_diminta ?? '')"
                         placeholder="Masukan Jumlah Diminta" required="false" type="number" />
                 </div>
                 {{-- Stok Tersedia --}}
                 <div class="col-span-12 md:col-span-3 me-4">
                     <x-input-v2 name="stok_tersedia" label="Stok Tersedia" readonly="true"
                         placeholder="Masukan Stok Tersedia" required="false" type="number" />
                 </div>
                 <div class="col-span-12 md:col-span-2 end-0">
                     <button id="btn-material-item" type="submit"
                         class="px-2 py-2.5 mt-6 lg:px-4 bg-slate-900 w-full mx-4 text-white text-sm  rounded-full transition hover:bg-slate-800 border border-slate-900 font-medium">Tambahkan</button>
                 </div>
             </form>

             {{-- tabel purchase order item --}}

             <div class="card p-4">
                 <table class="min-w-full" id="table-material">
                     <thead class="bg-gray-50 dark:bg-gray-600/20">
                         <tr>
                             <th scope="col"
                                 class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400"
                                 style="width: 5%">
                                 No
                             </th>
                             <th scope="col"
                                 class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                 Material
                             </th>
                             <th scope="col"
                                 class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                 Qty
                             </th>
                             <th scope="col"
                                 class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400"
                                 style="width: 10%">
                                 Option
                             </th>
                         </tr>
                     </thead>
                     <tbody>
                     </tbody>
                     <tfoot class="bg-gray-10">
                         <tr>
                             <th colspan="6" class="text-right px-4 py-3">
                                 <form action="" id="form-penerimaan-material">
                                     <button type="submit"
                                         class="inline-block focus:outline-none bg-brand-500 mt-1 text-white hover:bg-brand-600 hover:text-white  text-md font-medium py-2 px-4 rounded">
                                         Simpan Purchase Order
                                     </button>
                                 </form>
                             </th>
                         </tr>
                     </tfoot>
                 </table>
             </div>
         </div>
     </div>
 @endsection
 @section('scripts')
     <script src="{{ asset('design-system/assets/libs/mobius1-selectr/selectr.min.js') }}"></script>
     <script src="{{ asset('design-system/assets/js/pages/form-advanced.init.js') }}"></script>
     <script>
         const materialOptions = @json($materials);
     </script>
     <script type="text/javascript">
         new Selectr('#status');
         new Selectr('#kapling_id');
         new Selectr('#aplikator_id');

         // init selectr
         const selectr = new Selectr('#material_id');

         // ambil elemen asli <select>
         const materialSelect = document.querySelector('#material_id');
         const stokInput = document.querySelector('input[name="stok_tersedia"]');

         // listen event change
         materialSelect.addEventListener('change', function() {
             let materialId = this.value;
             if (materialId) {
                 fetch(`/admin/materials/${materialId}/stok`)
                     .then(res => res.json())
                     .then(data => {
                         stokInput.value = data.stok;
                     });
             } else {
                 stokInput.value = '';
             }
         });
         // format rupiah
         const numberFormat = new Intl.NumberFormat('id-ID', {
             style: 'currency',
             currency: 'IDR'
         });

         let selectMaterial = [];

         // form add material
         $('#form-material-item').on("submit", function(e) {
             e.preventDefault();
             let jumlah_diminta = parseInt($('#jumlah_diminta').val());
             let material_id = $('#material_id').val();
             let aplikator_id = $('#aplikator_id').val();
             let kapling_id = $('#kapling_id').val();
             let status = $('#status').val();
             let stok_tersedia = $('#stok_tersedia').val();
             let catatan = $('#catatan').val();

             console.log(stok_tersedia);


             // alert
             if (!jumlah_diminta || !material_id) {
                 Swal.fire({
                     icon: 'warning',
                     title: 'Perhatian',
                     text: 'Input belum lengkap',
                     timer: 3000,
                 });
                 return;
             }

             if (Number.isNaN(jumlah_diminta) || jumlah_diminta < 1) {
                 Swal.fire({
                     icon: 'error',
                     title: 'Perhatian',
                     text: 'Qty atau harga tidak boleh kurang dari 1',
                     timer: 3000,
                 });
                 return;
             }

             if (stok_tersedia) {
                 if (Number.isNaN(jumlah_diminta) > stokInput) {
                     Swal.fire({
                         icon: 'error',
                         title: 'Perhatian',
                         text: 'Jumlah Material Melebihi Stok',
                         timer: 3000,
                     });
                     return;

                 }

             }


             let existingMaterial = selectMaterial.find(item => item.material_id === material_id);
             const materialId = document.getElementById('material_id').value;
             const materialNama = materialOptions[materialId] || '—';

             if (existingMaterial) {
                 existingMaterial.jumlah_diminta += jumlah_diminta;
             } else {
                 selectMaterial.push({
                     aplikator_id: aplikator_id,
                     kapling_id: kapling_id,
                     status: status,
                     catatan: catatan,
                     material_id: material_id,
                     material_nama: materialNama,
                     jumlah_diminta: jumlah_diminta,
                 });
             }

             // reset form
             $('#aplikator_id').val(null).trigger('change');
             $('#kapling_id').val(null).trigger('change');
             $('#status').val('');
             $('#catatan').val('');
             $('#material_id').val(null).trigger('change');
             $('#jumlah_diminta').val('');

             renderTable();
         });

         function renderTable() {
             let tableBody = $('#table-material tbody');
             tableBody.empty(); // clear dulu

             $(document).on('click', '#btn-delete', function() {
                 let materialId = $(this).data('material_id');
                 selectMaterial = selectMaterial.filter(item => item.material_id !== materialId);
                 renderTable();
             });

             if (selectMaterial.length === 0) {
                 tableBody.append(
                     `<tr><td colspan="6" class="text-center p-6">Tidak ada data material</td></tr>`
                 );
                 $("#grand-total").text(numberFormat.format(0));
                 return;
             }

             selectMaterial.forEach((item, index) => {
                 let row = `
                    <tr>
                        <td class="text-left ps-2">${index + 1}</td>
                        <td class="text-left ps-2">${item.material_nama}</td>
                        <td class="text-left ps-2">${item.jumlah_diminta}</td>
                        <td class="text-left pl-4" data-material_id="${item.material_id}" id="btn-delete"><i class="far fa-trash-alt bg-red-500 text-white p-2 rounded"></i></td>
                    </tr>
                `;
                 tableBody.append(row);
             });
         }

         renderTable();

         $('#form-penerimaan-material').on("submit", function(e) {
             e.preventDefault();
             if (selectMaterial.length === 0) {
                 Swal.fire({
                     icon: 'warning',
                     title: 'Perhatian',
                     text: 'Minimal 1 material',
                     timer: 3000,
                 });
                 return;
             }

             $.ajax({
                 method: "POST",
                 data: {
                     _token: "{{ csrf_token() }}",
                     items: selectMaterial,
                     aplikator_id: $('#aplikator_id').val(),
                     kapling_id: $('#kapling_id').val(),
                     status: $('#status').val(),
                     catatan: $('#catatan').val(),
                 },
                 url: "{{ route('admin.permintaan-material.store') }}",
                 dataType: "JSON",
                 success: function(response) {
                     if (response.success) {
                         Swal.fire({
                             icon: 'success',
                             title: 'Perhatian',
                             text: 'Input berhasil disimpan!',
                             timer: 3000,
                             showConfirmButton: false
                         }).then(() => {
                             // redirect setelah alert selesai / ditutup
                             window.location.href = response.redirect;
                         });

                     }
                 },
                 error: function(xhr) {
                     const errors = xhr.responseJSON?.errors;
                     if (errors) {
                         renderErrors(errors);
                         console.log(errors);
                     }
                 }
             });
         });

         function renderErrors(errors) {
             // Gabungkan semua pesan error jadi satu string
             let allMessages = '';

             for (const [field, messages] of Object.entries(errors)) {
                 messages.forEach(message => {
                     allMessages += `• ${message}\n`;
                 });
             }

             // Tampilkan dengan SweetAlert2
             Swal.fire({
                 icon: 'error',
                 title: 'Validasi Gagal',
                 text: allMessages, // kalau mau line break pakai pre-line
                 customClass: {
                     popup: 'text-left'
                 }
             });
         }
     </script>
 @endsection
