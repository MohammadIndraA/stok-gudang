@extends('layouts.app', ['title' => 'Stok ' . request()->segment(2)])
@section('styles')
    <!-- Css -->
    <link rel="stylesheet" href="{{ asset('design-system/assets/libs/vanillajs-datepicker/css/datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('design-system/assets/libs/mobius1-selectr/selectr.min.css') }}">
@endsection
@section('content')
    <div
        class="grid grid-cols-12 sm:grid-cols-12 md:grid-cols-12 lg:grid-cols-12 xl:grid-cols-12 gap-4 bg-white shadow shadow-sm dark:bg-[#06090f]">
        <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12">
            <div class="w-full relative mb-4">
                <div class="flex-auto p-0 md:p-4">
                    <div class="grid grid-cols-12 gap-4 mb-4">
                        {{-- tanggal mulai --}}
                        <div class="col-span-3 mt-2">
                            <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="w-full border p-2 rounded">
                        </div>

                        {{-- tanggal akhir + tombol reset --}}
                        <div class="col-span-3 flex items-center gap-2">
                            <input type="date" id="tanggal_akhir" name="tanggal_akhir" class="w-full border p-2 rounded">
                            <button type="button" id="btnReset"
                                class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600 flex items-center gap-2">
                                <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
                                Reset
                            </button>

                        </div>
                    </div>

                    <div
                        class="grid
                                grid-cols-1 p-0 md:p-4 p-4 bg-white rounded-lg dark:bg-gray-900">
                        <div class="sm:-mx-6 lg:-mx-8">
                            <div class="relative overflow-x-auto block w-full sm:px-6 lg:px-8">
                                <table class="w-full" id="stokTable">
                                    <thead class="bg-white dark:bg-slate-700/20">
                                        <tr>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                No
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                Material
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                Satuan
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                Referensi
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                Jumlah
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                Stok Akhir
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                Waktu
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                Catatan
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                Petugas
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div><!--end div-->
                        </div><!--end div-->
                    </div><!--end grid-->
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
    </div> <!--end grid-->
@endsection
@section('scripts')
    <script src="{{ asset('design-system/assets/js/pages/form-advanced.init.js') }}"></script>
    <script src="{{ asset('design-system/assets/libs/vanillajs-datepicker/js/datepicker-full.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {

            var segments = window.location.pathname.split('/');
            var afterAdmin = segments[2]; // contoh: /admin/keluar → "keluar"

            let url = "";
            if (afterAdmin === "masuk") {
                url = "{{ route('admin.masuk.index') }}";
            } else {
                url = "{{ route('admin.keluar.index') }}"; // harus ada assignment
            }

            var table = $('#stokTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: url,
                    data: function(d) {
                        d.tanggal_mulai = $('#tanggal_mulai').val();
                        d.tanggal_akhir = $('#tanggal_akhir').val();
                        console.log('Filter dikirim:', d);
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'material_id',
                        name: 'material_id'
                    },
                    {
                        data: 'satuan',
                        name: 'satuan'
                    },
                    {
                        data: 'referensi_jenis',
                        name: 'referensi_jenis'
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah'
                    },
                    {
                        data: 'stok_setelah_transaksi',
                        name: 'stok_setelah_transaksi'
                    },
                    {
                        data: 'waktu',
                        name: 'waktu'
                    },
                    {
                        data: 'catatan',
                        name: 'catatan'
                    },
                    {
                        data: 'dibuat_oleh',
                        name: 'dibuat_oleh'
                    },
                ]
            });

            $('#tanggal_mulai, #tanggal_akhir').on('change', function() {
                console.log('Reload tabel...');
                table.ajax.reload(null, false); // false = jangan reset paging
            });

            // Reset button
            $('#btnReset').on('click', function() {
                $('#tanggal_mulai').val('');
                $('#tanggal_akhir').val('');
                table.ajax.reload(); // reload tanpa filter
            });
        });
    </script>
@endsection
