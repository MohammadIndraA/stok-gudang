@extends('layouts.app', ['title' => 'Tahapan Pembangunan'])
@section('content')
    <div
        class="grid grid-cols-12 sm:grid-cols-12 md:grid-cols-12 lg:grid-cols-12 xl:grid-cols-12 gap-4 bg-white shadow shadow-sm dark:bg-[#06090f]">
        <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12">
            <div class="w-full relative mb-4">
                <div class="flex-auto p-0 md:p-4">
                    {{-- @can('create-Aplikator') --}}
                    <div class="flex flex-wrap gap-4 mb-3">
                        <div>
                            <a href="{{ route('admin.project-stage.create') }}"
                                class="inline-block focus:outline-none bg-brand-500 mt-1 text-white hover:bg-brand-600 hover:text-white  text-md font-medium py-2 px-4 rounded">
                                Tambah Tahapan Pembangunan
                            </a>
                        </div>
                    </div>
                    {{-- @endcan --}}
                    <div
                        class="grid
                                grid-cols-1 p-0 md:p-4 p-4 bg-white rounded-lg dark:bg-gray-900">
                        <div class="sm:-mx-6 lg:-mx-8">
                            <div class="relative overflow-x-auto block w-full sm:px-6 lg:px-8">
                                <table class="w-full" id="stTable">
                                    <thead class="bg-white dark:bg-slate-700/20">
                                        <tr>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                No
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                Nama
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                Bobot
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

            var table = $('#stTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.project-stage.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'nama_tahap',
                        name: 'nama_tahap'
                    },
                    {
                        data: 'bobot',
                        name: 'bobot'
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
