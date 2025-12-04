@extends('layouts.app', ['title' => 'Periode Stok Opname'])
@section('styles')
    <link href="{{ asset('design-system/assets/libs/prismjs/themes/prism-twilight.min.css') }}" type="text/css"
        rel="stylesheet">
@endsection
@section('content')
    <div
        class="grid grid-cols-12 sm:grid-cols-12 md:grid-cols-12 lg:grid-cols-12 xl:grid-cols-12 gap-4 bg-white shadow shadow-sm dark:bg-[#06090f]">
        <div class="col-span-12 lg:col-span-6 p-4">
            <table class="min-w-full border border-slate-200 dark:border-slate-700 rounded-md overflow-hidden">
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    <tr>
                        <td class="px-4 py-2 font-medium">Periode</td>
                        <td class="px-4 py-2">: {{ $dataPeriode->periode }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-medium">Jumlah barang</td>
                        <td class="px-4 py-2">: {{ $dataPeriode->jumlah_barang ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-medium">Jumlah barang sesuai</td>
                        <td class="px-4 py-2">: {{ $dataPeriode->jumlah_barang_sesuai ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-medium">Jumlah barang selisih</td>
                        <td class="px-4 py-2">: {{ $dataPeriode->jumlah_barang_selisih ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-medium">Status kerja</td>
                        <td class="px-4 py-2">: {{ $dataPeriode->is_active ? 'Aktif' : 'Tidak Aktif' }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-medium">Pelapor stok</td>
                        <td class="px-4 py-2">: {{ $dataPeriode->is_completed ? 'Lengap' : 'Belum Lengap' }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-medium">Opname</td>
                        <td class="px-4 py-2">: {{ $dataPeriode->diajukan_oleh ?? '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12">
            <div class="w-full relative mb-4">
                <div class="flex-auto p-0 md:p-4">
                    <div class="flex flex-wrap gap-4 mb-3">
                        <div>
                            <a href="{{ route('admin.project.create') }}"
                                class="inline-block focus:outline-none bg-brand-500 mt-1 text-white hover:bg-brand-600 hover:text-white  text-md font-medium py-2 px-4 rounded">
                                Update data stok
                            </a>
                        </div>
                    </div>
                    <div
                        class="grid
                                grid-cols-1 p-0 md:p-4 p-4 bg-white rounded-lg dark:bg-gray-900">
                        <div class="sm:-mx-6 lg:-mx-8">
                            <div class="relative overflow-x-auto block w-full sm:px-6 lg:px-8">
                                <table class="w-full" id="isoTable">
                                    <thead class="bg-white dark:bg-slate-700/20">
                                        <tr>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                No
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                CODE MATERIAL
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                NAMA
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                STOK
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                JUMLAH DI LAPORKAN
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                STATUS
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                KETERANGAN
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                PETUGAS
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
    <script src="{{ asset('js/alert.js') }}"></script>

    <script type="text/javascript">
        $(function() {

            var table = $('#isoTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.stok-opname.input.index') }}",
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
                        data: 'material',
                        name: 'material'
                    },
                    {
                        data: 'stok',
                        name: 'stok'
                    },
                    {
                        data: 'jumlah_dilaporkan',
                        name: 'jumlah_dilaporkan'
                    },
                    {
                        data: 'status',
                        name: 'status',
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    {
                        data: 'petugas',
                        name: 'petugas'
                    },
                ]
            });
        });
    </script>
    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }
    </script>
@endsection
