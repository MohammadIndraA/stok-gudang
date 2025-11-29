 @extends('layouts.app', ['title' => 'Detail Permintaan Barang'])
 @section('content')
     <div class="grid grid-cols-12 gap-4 bg-white shadow-sm dark:bg-[#06090f] p-6 rounded-md">
         <!-- Header -->
         <div class="col-span-12 mb-8">
             <h1 class="text-3xl font-bold text-slate-900 dark:text-slate-100">Permintaan Barang</h1>
             <p class="text-slate-600 dark:text-slate-400 mt-2">permintaan material oleh aplikator ke gudang</p>
         </div>

         <!-- Table Info Vendor -->
         <div class="col-span-12 lg:col-span-5">
             <table class="min-w-full border border-slate-200 dark:border-slate-700 rounded-md overflow-hidden">
                 <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                     <tr>
                         <td class="px-4 py-2 font-medium">Nomor Permintaan</td>
                         <td class="px-4 py-2">: {{ $kapling->nomor_permintaan }}</td>
                         <input type="hidden" id="id_pm" value="{{ $kapling->id }}">
                     </tr>
                     <tr>
                         <td class="px-4 py-2 font-medium">Kapling</td>
                         <td class="px-4 py-2">: {{ $kapling->kapling->nama ?? '-' }}</td>
                     </tr>
                     <tr>
                         <td class="px-4 py-2 font-medium">Aplikator</td>
                         <td class="px-4 py-2">: {{ $kapling->aplikator->nama_lengkap ?? '-' }}</td>
                     </tr>
                     <tr>
                         <td class="px-4 py-2 font-medium">Diajukan</td>
                         <td class="px-4 py-2">: {{ $kapling->diajukan_oleh ?? '-' }}</td>
                     </tr>
                     <tr>
                         <td class="px-4 py-2 font-medium">Tanggal Permintaan</td>
                         <td class="px-4 py-2">: {{ $kapling->tanggal_permintaan ?? '-' }}</td>
                     </tr>
                     <tr>
                         <td class="px-4 py-2 font-medium">Tanggal Dipenuhi</td>
                         <td class="px-4 py-2">: {{ $kapling->tanggal_dipenuhi ?? '-' }}</td>
                     </tr>
                     <tr>
                         <td class="px-4 py-2 font-medium">Status</td>
                         <td class="px-4 py-2">: {{ $kapling->status ?? '-' }}</td>
                     </tr>
                     <tr>
                         <td class="px-4 py-2 font-medium">Catatan</td>
                         <td class="px-4 py-2">: {{ $kapling->catatan ?? '-' }}</td>
                     </tr>
                 </tbody>
             </table>
         </div>

         <!-- Form Penerimaan Material -->
         <div class="col-span-12 mt-6 p-6">
             <form id="form-permintaan-material"
                 class="p-6 m-4 border border-collapse border-slate-200 dark:border-slate-700 rounded-md bg-slate-50 dark:bg-slate-900">

                 <div class="overflow-x-auto mt-6">
                     <table class="min-w-full" id="tablePm">
                         <thead class="bg-gray-50 dark:bg-gray-600/20">
                             <tr>
                                 <th scope="col"
                                     class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                     No
                                 </th>
                                 <th scope="col"
                                     class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                     Material
                                 </th>
                                 <th scope="col"
                                     class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                     JUmlah di Minta
                                 </th>
                                 <th scope="col"
                                     class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                     Jumlah di Keluarkan
                                 </th>
                             </tr>
                         </thead>
                         <tbody id="tablePmBody" class="divide-y divide-slate-200 dark:divide-slate-700"></tbody>

                         </tbody>
                     </table>
                     <!-- Button -->
                     <div class="flex justify-end mt-4">
                         <button type="submit"
                             class="focus:outline-none bg-brand-500 text-white hover:bg-brand-600 text-md font-medium py-2 px-6 rounded">
                             Konfirmasi pengeluaran
                         </button>
                     </div>
                 </div>
             </form>
         </div>
     </div>
 @endsection

 @section('scripts')
     <script src="{{ asset('design-system/assets/libs/vanillajs-datepicker/js/datepicker-full.min.js') }}"></script>
     <script>
         $(function() {
             const numberFormat = new Intl.NumberFormat('id-ID', {
                 style: 'currency',
                 currency: 'IDR'
             });

             //  nilai hasil yang diterima
             const grouped = {};

             let dikeluarkan = parseInt($('#jumlah_dikeluarkan').val(), 10);

             // Ambil semua item dari PO (server-side)
             let kapling = @json($kapling['items']).map(i => ({
                 id: i.id,
                 material_id: i.material_id,
                 material_nama: i.material ? i.material.nama_material : '-',
                 jumlah_diminta: Number(i.jumlah_diminta) || 0,
                 jumlah_dikeluarkan: dikeluarkan || 0,

             }));


             renderTable();

             function renderTable() {
                 const tbody = $('#tablePmBody');
                 tbody.empty();

                 kapling.forEach((item, index) => {
                     const row = `
                <tr data-row-id="${item.id}">
                    <td class="px-3 py-2">${index + 1}</td>
                    <td class="px-3 py-2">${item.material_nama}</td>
                    <td class="px-3 py-2">${item.jumlah_diminta}</td>
                     <td class="px-3 py-2">
                  <input type="number" 
       class="jumlah_dikeluarkan w-24 border rounded p-1"
       data-id="${item.id}"
       min="0"
       placeholder="${item.jumlah_diminta}"
       value="${item.jumlah_diminta}">
                    </td>
                </tr>
            `;
                     tbody.append(row);
                 });
             }
             console.log();


             $('#form-permintaan-material').on("submit", function(e) {
                 e.preventDefault();

                 kapling.forEach(item => {
                     const inputVal = parseInt($(`.jumlah_dikeluarkan[data-id="${item.id}"]`).val(),
                         10);
                     item.jumlah_dikeluarkan = isNaN(inputVal) ? 0 : inputVal;
                 });

                 // validasi
                 for (let item of kapling) {
                     if (item.jumlah_dikeluarkan > item.jumlah_diminta) {
                         Swal.fire({
                             icon: 'warning',
                             title: 'Perhatian',
                             text: `Jumlah dikeluarkan untuk ${item.material_nama} melebihi jumlah diminta`,
                             timer: 3000,
                         });
                         return;
                     }
                 }

                 if (kapling.length === 0) {
                     Swal.fire({
                         icon: 'warning',
                         title: 'Perhatian',
                         text: 'Minimal 1 material',
                         timer: 3000,
                     });
                     return;
                 }

                 // kirim ajax
                 $.ajax({
                     method: "POST",
                     url: "{{ route('admin.permintaan-material-item.store') }}",
                     data: {
                         _token: "{{ csrf_token() }}",
                         items: kapling,
                         id: $('#id_pm').val(),
                         catatan: $('#catatan').val(),
                     },
                     dataType: "JSON",
                     success: function(response) {
                         if (response.success) {
                             Swal.fire({
                                 icon: 'success',
                                 title: 'Perhatian',
                                 text: 'Input berhasil disimpan!',
                                 timer: 2000,
                                 showConfirmButton: false
                             }).then(() => {
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


         });
     </script>
 @endsection
