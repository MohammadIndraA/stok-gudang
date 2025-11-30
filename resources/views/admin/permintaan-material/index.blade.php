@extends('layouts.app', ['title' => 'Permintaan Material'])
@section('content')
    <div
        class="grid grid-cols-12 sm:grid-cols-12 md:grid-cols-12 lg:grid-cols-12 xl:grid-cols-12 gap-4 bg-white shadow shadow-sm dark:bg-[#06090f]">
        <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12">
            <div class="w-full relative mb-4">
                <div class="flex-auto p-0 md:p-4">
                    <div class="flex p-3 mb-4 bg-green-100 rounded-lg dark:bg-green-200 p-6" role="alert">
                        <i class="fas fa-triangle-exclamation flex-shrink-0 text-green-700 self-center"></i>
                        <div class="ml-3 text-sm font-medium text-green-700 dark:text-green-800">
                            Klik Detail Untuk menyetujui
                            Mengeluarkan Material
                            Sesuai dengan kebutuhan ataupun permintaan.
                        </div>
                        <button type="button"
                            class="justify-center items-center ml-auto -mx-1.5 -my-1.5 bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-green-200 dark:text-green-600 dark:hover:bg-green-300 alert-hidden">

                            <i class="icofont-close"></i>
                        </button>
                    </div>
                    {{-- @can('create-Aplikator') --}}
                    <div class="flex flex-wrap gap-4 mb-3">
                        <div>
                            <a href="{{ route('admin.permintaan-material.create') }}"
                                class="inline-block focus:outline-none bg-brand-500 mt-1 text-white hover:bg-brand-600 hover:text-white  text-md font-medium py-2 px-4 rounded">
                                Tambah Permintaan Material
                            </a>
                        </div>
                    </div>
                    {{-- @endcan --}}
                    <div
                        class="grid
                                grid-cols-1 p-0 md:p-4 p-4 bg-white rounded-lg dark:bg-gray-900">
                        <div class="sm:-mx-6 lg:-mx-8">
                            <div class="relative overflow-x-auto block w-full sm:px-6 lg:px-8">
                                <table class="w-full" id="PermintaanMaterialTable">
                                    <thead class="bg-white dark:bg-slate-700/20">
                                        <tr>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                No
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                Kapling
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                Aplikator
                                            </th>
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                Pengaju
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                Status
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                Tanggal Permintaan
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                Tanggal Terpenuhi
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
    <script type="text/javascript">
        $(function() {

            var table = $('#PermintaanMaterialTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.permintaan-material.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'kapling_id',
                        name: 'kapling_id'
                    },
                    {
                        data: 'aplikator_id',
                        name: 'aplikator_id'
                    },
                    {
                        data: 'diajukan_oleh',
                        name: 'diajukan_oleh'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'tanggal_permintaan',
                        name: 'tanggal_permintaan'
                    },
                    {
                        data: 'tanggal_dipenuhi',
                        name: 'tanggal_dipenuhi'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endsection
