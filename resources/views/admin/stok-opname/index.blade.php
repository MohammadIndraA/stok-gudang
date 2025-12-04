@extends('layouts.app', ['title' => 'Periode'])
@section('content')
    <div
        class="grid grid-cols-12 sm:grid-cols-12 md:grid-cols-12 lg:grid-cols-12 xl:grid-cols-12 gap-4 bg-white shadow shadow-sm dark:bg-[#06090f]">
        <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12">
            <div class="w-full relative mb-4">
                <div class="flex-auto p-0 md:p-4">
                    <div id="alert-4" class="flex p-3 mb-4 bg-yellow-100 rounded-full dark:bg-yellow-200" role="alert">
                        <i class="fas fa-triangle-exclamation flex-shrink-0 text-yellow-700 self-center"></i>
                        <div class="ml-3 text-sm font-medium text-yellow-700 dark:text-yellow-800">
                            Data Yang maish aktif tidak bisa di hapus , dan sebelum menambahkan periode stok optname
                            pastikan yang sebelum nya sudah selesai
                        </div>
                        <button type="button"
                            class="justify-center items-center ml-auto -mx-1.5 -my-1.5 bg-yellow-100 text-yellow-500 rounded-lg focus:ring-2 focus:ring-yellow-400 p-1.5 hover:bg-yellow-200 inline-flex h-8 w-8 dark:bg-yellow-200 dark:text-yellow-600 dark:hover:bg-yellow-300 alert-hidden"
                            data-dismiss-target="#alert-4" aria-label="Close">
                            <i class="icofont-close"></i>
                        </button>
                    </div>
                    {{-- @can('create-Aplikator') --}}
                    <div class="flex flex-wrap gap-4 mb-3">
                        <div>
                            <a href="{{ route('admin.stok-opname.periode.create') }}"
                                class="inline-block focus:outline-none bg-brand-500 mt-1 text-white hover:bg-brand-600 hover:text-white  text-md font-medium py-2 px-4 rounded">
                                Tambah Periode
                            </a>
                        </div>
                    </div>
                    {{-- @endcan --}}
                    <div
                        class="grid
                                grid-cols-1 p-0 md:p-4 p-4 bg-white rounded-lg dark:bg-gray-900">
                        <div class="sm:-mx-6 lg:-mx-8">
                            <div class="relative overflow-x-auto block w-full sm:px-6 lg:px-8">
                                <table class="w-full" id="periodeTable">
                                    <thead class="bg-white dark:bg-slate-700/20">
                                        <tr>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                No
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                Periode
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                Jumlah Barang
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                Jumlah Barang Sesuai
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                Jumlah Barang Selisih
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                Status Kerja
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                Pelapor Stok Opname
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

            var table = $('#periodeTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.stok-opname.periode.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'periode',
                        name: 'periode'
                    },
                    {
                        data: 'jumlah_barang',
                        name: 'jumlah_barang'
                    },
                    {
                        data: 'jumlah_barang_sesuai',
                        name: 'jumlah_barang_sesuai'
                    },
                    {
                        data: 'jumlah_barang_selisih',
                        name: 'jumlah_barang_selisih'
                    },
                    {
                        data: 'is_active',
                        name: 'is_active'
                    },
                    {
                        data: 'is_completed',
                        name: 'is_completed'
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
