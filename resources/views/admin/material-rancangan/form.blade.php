 @extends('layouts.app', ['title' => 'Form Material Rakitan'])
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
                     <h4 class="font-medium text-lg flex-1 self-center mb-2 md:mb-0">Form Material Rakitan</h4>
                 </div>
             </div><!--end header-title-->
             <form class="grid grid-cols-12 gap-6 p-6 m-4" id="form-material-rancangan-item">
                 <div class="col-span-12 md:col-span-6 ms-3">
                     <x-select-search name="material_nama_id" label="Material" :options="$materials" :selected="$purchaseOrder->material_id ?? null"
                         placeholder="Pilih material..." />
                 </div>
                 <div class="col-span-12 md:col-span-6 ms-3">
                     <x-textarea name="keterangan" label="Keterangan / Nama Rakitan" :value="$vendor->keterangan ?? ''" :rows="2"
                         :required="false" />
                 </div>
                 <div class="col-span-12 md:col-span-4 ms-3">
                     <x-select-search name="material_id" label="Material" :options="$materials" :selected="$purchaseOrder->material_id ?? null"
                         placeholder="Pilih material..." />
                 </div>
                 <div class="col-span-12 md:col-span-3 ms-3">
                     <x-input-v2 name="jumlah" label="Jumlah" :value="old('jumlah', $vendor->jumlah ?? '')" placeholder="Masukan Jumlah"
                         required="false" type="number" />
                 </div>
                 <div class="col-span-12 md:col-span-2 ms-3">
                     <x-input-v2 name="satuan" label="satuan" :value="old('satuan', $vendor->satuan ?? '')" placeholder="kg, stell" required="false"
                         type="text" />
                 </div>
                 <div class="col-span-12 md:col-span-3 ms-3">
                     <button id="btn-material-rancangan-item" type="submit"
                         class="px-2 py-2.5 mt-6 lg:px-4 bg-slate-900 w-full mx-4 text-white text-sm  rounded-full transition hover:bg-slate-800 border border-slate-900 font-medium">Tambahkan
                         Item Rancangan / Bahan</button>
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
                                 Jumlah
                             </th>
                             <th scope="col"
                                 class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                 Satuan
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
                                 <form action="" id="form-material-submit">
                                     <button type="submit"
                                         class="inline-block focus:outline-none bg-brand-500 mt-1 text-white hover:bg-brand-600 hover:text-white  text-md font-medium py-2 px-4 rounded">
                                         Simpan Material Rakitan
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
         new Selectr('#material_nama_id');
         new Selectr('#material_id');

         // format rupiah
         const numberFormat = new Intl.NumberFormat('id-ID', {
             style: 'currency',
             currency: 'IDR'
         });

         let selectMaterial = [];

         // form add material
         $('#form-material-rancangan-item').on("submit", function(e) {
             e.preventDefault();
             let jumlah = parseInt($('#jumlah').val());
             let material_id = $('#material_id').val();
             let keterangan = $('#keterangan').val();
             let satuan = $('#satuan').val();

             // alert
             if (!jumlah || !material_id) {
                 Swal.fire({
                     icon: 'warning',
                     title: 'Perhatian',
                     text: 'Input belum lengkap',
                     timer: 3000,
                 });
                 return;
             }

             let existingMaterial = selectMaterial.find(item => item.material_id === material_id);
             const materialId = document.getElementById('material_id').value;
             const materialNama = materialOptions[materialId] || '—';

             if (existingMaterial) {
                 existingMaterial.jumlah += jumlah;
             } else {
                 selectMaterial.push({
                     keterangan: keterangan,
                     material_id: material_id,
                     material_nama: materialNama,
                     jumlah: jumlah,
                     satuan: satuan,
                 });
             }

             // reset form
             $('#keterangan').val('');
             $('#material_id').val(null).trigger('change');
             $('#jumlah').val('');
             $('#satuan').val('');

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
                        <td class="text-left ps-2">${item.jumlah}</td>
                        <td class="text-left ps-2">${item.satuan}</td>
                        <td class="text-left pl-4" data-material_id="${item.material_id}" id="btn-delete"><i class="far fa-trash-alt bg-red-500 text-white p-2 rounded"></i></td>
                    </tr>
                `;
                 tableBody.append(row);
             });
         }

         renderTable();

         $('#form-material-submit').on("submit", function(e) {
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
             let ket = document.getElementById('keterangan').value;
             let material_nama_id = $('#material_nama_id').val();
             let satuan = $('#satuan').val();
             if (!ket || ket.trim() === '') {
                 Swal.fire({
                     icon: 'warning',
                     title: 'Perhatian',
                     text: 'Keterangan atau nama rakitan harus diisi',
                     timer: 3000,
                 });
                 return;
             }


             $.ajax({
                 method: "POST",
                 data: {
                     _token: "{{ csrf_token() }}",
                     items: selectMaterial,
                     material_id: material_nama_id,
                     keterangan: ket,
                     satuan: satuan,
                 },
                 url: "{{ route('admin.material-rakitan.store') }}",
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
