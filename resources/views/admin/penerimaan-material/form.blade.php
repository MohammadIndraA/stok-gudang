 @extends('layouts.app', ['title' => 'Form Penerimaan Barang'])
 @section('styles')
     <!-- Css -->
     <link rel="stylesheet" href="{{ asset('design-system/assets/libs/vanillajs-datepicker/css/datepicker.min.css') }}">
 @endsection
 @section('content')
     <div class="grid grid-cols-12 gap-4 bg-white shadow-sm dark:bg-[#06090f] p-6 rounded-md">
         <!-- Header -->
         <div class="col-span-12 mb-8">
             <h1 class="text-3xl font-bold text-slate-900 dark:text-slate-100">Penerimaan Barang</h1>
             <p class="text-slate-600 dark:text-slate-400 mt-2">Catat material masuk dari vendor ke gudang</p>
         </div>

         <!-- Table Info Vendor -->
         <div class="col-span-12 lg:col-span-4">
             <table class="min-w-full border border-slate-200 dark:border-slate-700 rounded-md overflow-hidden">
                 <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                     <tr>
                         <td class="px-4 py-2 font-medium" data-po-id="{{ $grn->id }}">Nomor Purchase Order</td>
                         <td class="px-4 py-2">: {{ $grn->nomor_po }}</td>
                     </tr>
                     <tr>
                         <td class="px-4 py-2 font-medium">Vendor</td>
                         <td class="px-4 py-2">: {{ $grn->vendor->nama ?? '-' }}</td>
                     </tr>
                     <tr>
                         <td class="px-4 py-2 font-medium">Kontak Person</td>
                         <td class="px-4 py-2">: {{ $grn->vendor->kontak_person ?? '-' }}</td>
                     </tr>
                     <tr>
                         <td class="px-4 py-2 font-medium">Telepon</td>
                         <td class="px-4 py-2">: {{ $grn->vendor->telepon ?? '-' }}</td>
                     </tr>
                     <tr>
                         <td class="px-4 py-2 font-medium">Email</td>
                         <td class="px-4 py-2">: {{ $grn->vendor->email ?? '-' }}</td>
                     </tr>
                     <tr>
                         <td class="px-4 py-2 font-medium">Alamat</td>
                         <td class="px-4 py-2">: {{ $grn->alamat ?? '-' }}</td>
                     </tr>
                     <tr>
                         <td class="px-4 py-2 font-medium">Diajukan</td>
                         <td class="px-4 py-2">: {{ $grn->diajukan_oleh ?? '-' }}</td>
                     </tr>
                     <tr>
                         <td class="px-4 py-2 font-medium">Catatan</td>
                         <td class="px-4 py-2">: {{ $grn->catatan ?? '-' }}</td>
                     </tr>
                 </tbody>
             </table>
         </div>

         <!-- Form Penerimaan Material -->
         <div class="col-span-12 mt-6">
             <form id="form-penerimaan-material"
                 class="p-6 m-4 border border-slate-200 dark:border-slate-700 rounded-md bg-slate-50 dark:bg-slate-900">

                 <div class="overflow-x-auto mt-6">
                     <table id="poTable" class="min-w-full border border-slate-200 dark:border-slate-700 rounded-md">
                         <thead class="bg-slate-100 dark:bg-slate-700/20" id="tableGrn">
                             <tr>
                                 <th class="p-3 text-xs font-medium text-left">No</th>
                                 <th class="p-3 text-xs font-medium text-left">Material</th>
                                 <th class="p-3 text-xs font-medium text-left">Jumlah diminta</th>
                                 <th class="p-3 text-xs font-medium text-left">Jumlah diterima</th>
                                 @if ($poSelesai)
                                     {{-- kalau sudah selesai, mungkin tidak perlu kolom tambahan --}}
                                     <th class="p-3 text-xs font-medium text-left">Status</th>
                                 @elseif ($poSudahDiterima)
                                     {{-- kalau sudah pernah ada penerimaan tapi belum selesai --}}
                                     <th class="p-3 text-xs font-medium text-left">Jumlah sisa</th>
                                 @endif
                                 <th class="p-3 text-xs font-medium text-left">Harga satuan</th>
                                 <th class="p-3 text-xs font-medium text-left">Total harga</th>
                                 <th class="p-3 text-xs font-medium text-center w-24">Action</th>
                             </tr>
                         </thead>
                         <tbody id="poTableBody" class="divide-y divide-slate-200 dark:divide-slate-700"></tbody>
                     </table>
                 </div>

                 <div class="grid grid-cols-12 gap-4 mt-4">
                     <!-- Textarea -->
                     <div class="col-span-8">
                         <x-textarea name="catatan" label="Catatan" :value="$vendor->catatan ?? ''" :rows="2" :required="true" />
                     </div>
                     <!-- Grand Total -->
                     <div class="col-span-4 flex items-center justify-end">
                         <span class="font-bold text-lg">
                             Grand Total: <span id="grand-total">Rp 0</span>
                         </span>
                     </div>


                 </div>


                 <!-- Button -->
                 <div class="flex justify-end mt-4">
                     @if ($poSelesai)
                         {{-- kalau sudah selesai, jangan tampilkan tombol --}}
                     @else
                         <button type="submit"
                             class="focus:outline-none bg-brand-500 text-white hover:bg-brand-600 text-md font-medium py-2 px-6 rounded">
                             @if ($poSudahDiterima)
                                 Konfirmasi Penerimaan Selanjutnya
                             @else
                                 Konfirmasi Penerimaan
                             @endif
                         </button>
                     @endif
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

             // Ambil semua item dari PO (server-side)
             let itemPO = @json($itemPO).map(i => ({
                 id: i.id,
                 material_id: i.material_id,
                 material_nama: i.material_nama ?? '-',
                 jumlah_diminta: Number(i.jumlah_diminta) || 0,
                 jumlah_diterima: Number(i.jumlah_diterima) || 0, // total sudah diterima
                 jumlah_sisa: Number(i.jumlah_sisa) || 0, // default untuk input baru
                 harga_satuan: Number(i.harga_satuan) || 0,
                 total_harga: Number(i.jumlah_sisa) * Number(i.harga_satuan)
             }));

             renderTable();
             updateGrandTotal();

             function renderTable() {
                 const tbody = $('#poTableBody');
                 tbody.empty();

                 if (itemPO.length === 0) {
                     tbody.append(`<tr><td colspan="7" class="text-center p-6">Tidak ada data material</td></tr>`);
                     $("#grand-total").text(numberFormat.format(0));
                     return;
                 }

                 itemPO.forEach((item, index) => {
                     const row = `
                <tr data-row-id="${item.id}">
                    <td class="px-3 py-2">${index + 1}</td>
                    <td class="px-3 py-2">${item.material_nama}</td>
                    <td class="px-3 py-2">${item.jumlah_diminta}</td>
                    <td class="px-3 py-2">
                        <input type="number"
                               class="jumlah-diterima w-24 border rounded p-1"
                               data-id="${item.id}"
                               min="0"
                               value="${item.jumlah_diterima}">
                    </td>
               @if ($poSelesai)
                <td class="px-3 py-2">
                    <span class="bg-green-500/10 text-green-500 text-[11px] font-medium mr-1 px-2.5 py-0.5 rounded">
                        selesai
                    </span>
                </td>
            @elseif ($poSudahDiterima)
                <td class="px-3 py-2">
                    <input type="number"
                        class="jumlah-diterima w-24 border rounded p-1"
                        data-id="${item.id}"
                        min="0"
                        value="${item.jumlah_sisa}">
                </td>

                    @endif
                    <td class="px-3 py-2">
                        <input type="number"
                               class="harga-satuan w-28 border rounded p-1"
                               data-id="${item.id}"
                               min="0"
                               value="${item.harga_satuan}">
                    </td>
                    <td class="px-3 py-2 total-cell" data-id="${item.id}">
                        ${numberFormat.format(item.total_harga)}
                    </td>
                    <td class="px-3 py-2 text-center">
                        <button type="button"
                                class="btn-delete bg-red-500 text-white py-1 px-3 rounded text-sm"
                                data-id="${item.id}">
                            Hapus
                        </button>
                    </td>
                </tr>
            `;
                     tbody.append(row);
                 });
             }

             // Update per-row total dan grand total ketika jumlah/harga berubah
             $(document).on('input', '.jumlah-diterima, .harga-satuan', function() {
                 const id = $(this).data('id');
                 const jumlah = parseFloat($(`.jumlah-diterima[data-id="${id}"]`).val()) || 0;
                 const harga = parseFloat($(`.harga-satuan[data-id="${id}"]`).val()) || 0;

                 const item = itemPO.find(i => i.id === id);
                 if (!item) return;

                 item.jumlah_diterima = jumlah;
                 item.harga_satuan = harga;
                 item.total_harga = jumlah * harga;

                 $(`.total-cell[data-id="${id}"]`).text(numberFormat.format(item.total_harga));
                 updateGrandTotal();
             });

             // Hapus baris item
             $(document).on('click', '.btn-delete', function() {
                 const id = $(this).data('id');
                 itemPO = itemPO.filter(i => i.id !== id);
                 renderTable();
                 updateGrandTotal();
             });

             // Hitung total keseluruhan
             function updateGrandTotal() {
                 const grandTotal = itemPO.reduce((sum, i) => sum + (Number(i.total_harga) || 0), 0);
                 $("#grand-total").text(numberFormat.format(grandTotal));
             }
             $('#form-penerimaan-material').on("submit", function(e) {
                 e.preventDefault();

                 if (itemPO.length === 0) {
                     Swal.fire({
                         icon: 'warning',
                         title: 'Perhatian',
                         text: 'Minimal 1 material',
                         timer: 3000,
                     });
                     return; // stop submit
                 }

                 let invalid = false;

                 for (const item of itemPO) {
                     if (
                         item.jumlah_diterima > item.jumlah_diminta ||
                         (item.jumlah_sisa != null && item.jumlah_diterima > item.jumlah_sisa)
                     ) {
                         Swal.fire({
                             icon: 'warning',
                             title: 'Perhatian',
                             text: 'Jumlah diterima terlalu banyak',
                             timer: 3000,
                         });
                         invalid = true;
                         break; // keluar loop
                     }
                 }

                 if (invalid) {
                     return; // stop submit, jangan lanjut ke AJAX
                 }

                 var poId = $('td.px-4.py-2.font-medium').data('po-id');

                 $.ajax({
                     method: "POST",
                     data: {
                         _token: "{{ csrf_token() }}",
                         items: itemPO,
                         po_id: poId,
                         catatan: $('#catatan').val(),
                     },
                     url: "{{ route('admin.penerimaan-material.store') }}",
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
