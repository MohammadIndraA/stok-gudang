@extends('layouts.app', ['title' => 'Input Laporan Stok Opname'])
@section('styles')
    <link href="{{ asset('design-system/assets/libs/prismjs/themes/prism-twilight.min.css') }}" type="text/css"
        rel="stylesheet">
@endsection
@section('content')
    <div
        class="grid grid-cols-12 sm:grid-cols-12 md:grid-cols-12 lg:grid-cols-12 xl:grid-cols-12 gap-4 bg-white shadow shadow-sm dark:bg-[#06090f]">
        <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12">
            <div class="w-full relative mb-4">
                <div class="flex-auto p-0 md:p-4">
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
                                            <th scope="col"
                                                class="p-3 text-center text-xs font-medium tracking-wider text-gray-700 dark:text-gray-400 uppercase"
                                                style="width: 8%">
                                                Action
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
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                    }
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
