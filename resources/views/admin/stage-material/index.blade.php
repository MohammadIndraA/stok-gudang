@extends('layouts.app', ['title' => 'Tahapan Pembangunan'])
@section('content')
    <div
        class="grid grid-cols-12 sm:grid-cols-12 md:grid-cols-12 lg:grid-cols-12 xl:grid-cols-12 gap-4 bg-white shadow shadow-sm dark:bg-[#06090f]">
        <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12">
            <div class="w-full relative mb-4">
                <div class="flex-auto p-0 md:p-4">
                    <!-- Table Info Vendor -->
                    <div class="grid grid-cols-12 gap-4 bg-white shadow-sm dark:bg-[#06090f] p-6 rounded-md">
                        <div class="col-span-12 lg:col-span-5">
                            <table
                                class="min-w-full border border-slate-200 dark:border-slate-700 rounded-md overflow-hidden">
                                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                                    <tr>
                                        <td class="px-4 py-2 font-medium">Nomor Tahapan</td>
                                        <td class="px-4 py-2">: {{ $ps->nama_tahap ?? '-' }}</td>

                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2 font-medium">Bobot</td>
                                        <td class="px-4 py-2">: {{ $ps->bobot ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2 font-medium">Jumlah Bahan</td>
                                        <td class="px-4 py-2">: {{ $ps->items->count() ?? '-' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <table class="min-w-full">
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
                                    Total Kebutuhan
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- 1 -->
                            @foreach ($ps->items as $item)
                                <tr
                                    class="bg-white border-b border-dashed dark:bg-gray-900 dark:border-gray-700/40 hover:bg-slate-50 dark:hover:bg-slate-900/30">
                                    <td class="p-3 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="p-3 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                        {{ $item->material->nama_material ?? '-' }}
                                    </td>
                                    <td class="p-3 text-sm text-red-500 whitespace-nowrap dark:text-red-400">
                                        {{ $item->kebutuhan_total }}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
    </div> <!--end grid-->
@endsection
