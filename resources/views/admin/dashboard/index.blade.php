@extends('layouts.app', ['title' => 'Dashboard'])
@section('content')
    <div class="container-fluid">
        <div class="grid grid-cols-12 sm:grid-cols-12 md:grid-cols-12 lg:grid-cols-12 xl:grid-cols-12 gap-4">
            <div class="col-span-12 sm:col-span-6 md:col-span-6 lg:col-span-3 xl:col-span-3">
                <div
                    class="bg-white px-3 py-2 shadow-sm dark:shadow-slate-700/10 dark:bg-gray-900  rounded-md w-full relative mb-4">
                    <div class="flex-auto p-4">
                        <div class="flex justify-between xl:gap-x-2 items-cente">
                            <div class="self-center">
                                <p class="text-gray-800 font-semibold dark:text-slate-400 text-lg uppercase">Total orders
                                </p>
                                <h3 class="my-4 font-semibold text-[30px] dark:text-slate-200">-</h3>
                            </div>
                            <div class="self-center">
                                <i data-lucide="shopping-cart" class=" h-16 w-16 stroke-primary-500/30"></i>
                            </div>
                        </div>
                    </div><!--end card-body-->
                </div> <!--end inner-grid-->
            </div><!--end col-->
            <div class="col-span-12 px-3 py-2 sm:col-span-12 md:col-span-6 lg:col-span-3 xl:col-span-3">
                <div class="bg-white shadow-sm dark:shadow-slate-700/10 dark:bg-gray-900  rounded-md w-full relative mb-4">
                    <div class="flex-auto p-4">
                        <div class="flex justify-between xl:gap-x-2 items-cente">
                            <div class="self-center">
                                <p class="text-gray-800 font-semibold dark:text-slate-400 uppercase">New customers</p>
                                <h3 class="my-4 font-semibold text-[30px] dark:text-slate-200">-</h3>
                            </div>
                            <div class="self-center">
                                <i data-lucide="users" class=" h-16 w-16 stroke-green/30"></i>
                            </div>
                        </div>
                    </div><!--end card-body-->
                </div> <!--end inner-grid-->
            </div><!--end col-->
            <div class="col-span-12 px-3 py-2 sm:col-span-12 md:col-span-6 lg:col-span-3 xl:col-span-3">
                <div class="bg-white shadow-sm dark:shadow-slate-700/10 dark:bg-gray-900  rounded-md w-full relative mb-4">
                    <div class="flex-auto p-4">
                        <div class="flex justify-between xl:gap-x-2 items-cente">
                            <div class="self-center">
                                <p class="text-gray-800 font-semibold dark:text-slate-400 uppercase">Mitra</p>
                                <h3 class="my-4 font-semibold text-[30px] dark:text-slate-200" id="mitras">
                                    {{-- {{ $mitras }}</h3> --}}
                            </div>
                            <div class="self-center">
                                <i data-lucide="hand" class=" h-16 w-16 stroke-yellow-500/30"></i>
                            </div>
                        </div>
                    </div><!--end card-body-->
                </div> <!--end inner-grid-->
            </div>
            <div class="col-span-12 px-3 py-2 sm:col-span-12 md:col-span-6 lg:col-span-3 xl:col-span-3">
                <div class="bg-white shadow-sm dark:shadow-slate-700/10 dark:bg-gray-900  rounded-md w-full relative mb-4">
                    <div class="flex-auto p-4">
                        <div class="flex justify-between xl:gap-x-2 items-cente">
                            <div class="self-center">
                                <p class="text-gray-800 font-semibold dark:text-slate-400 uppercase">Modul Pelatihan</p>
                                <h3 class="my-4 font-semibold text-[30px] dark:text-slate-200" id="modul_pelatihans">
                                    {{-- {{ $modul_pelatihans }}</h3> --}}
                            </div>
                            <div class="self-center">
                                <i data-lucide="book" class=" h-16 w-16 stroke-grey-500/30"></i>
                            </div>
                        </div>
                    </div><!--end card-body-->
                </div> <!--end inner-grid-->
            </div>
            <div class="col-span-12 px-3 py-2 sm:col-span-12 md:col-span-6 lg:col-span-3 xl:col-span-3">
                <div class="bg-white shadow-sm dark:shadow-slate-700/10 dark:bg-gray-900  rounded-md w-full relative mb-4">
                    <div class="flex-auto p-4">
                        <div class="flex justify-between xl:gap-x-2 items-cente">
                            <div class="self-center">
                                <p class="text-gray-800 font-semibold dark:text-slate-400 uppercase">Investor</p>
                                <h3 class="my-4 font-semibold text-[30px] dark:text-slate-200" id="investors">
                                    {{-- {{ $investors }}</h3> --}}
                            </div>
                            <div class="self-center">
                                <i data-lucide="circle-dollar-sign" class=" h-16 w-16 stroke-yellow-500/30"></i>
                            </div>
                        </div>
                    </div><!--end card-body-->
                </div> <!--end inner-grid-->
            </div>
            <div class="col-span-12 px-3 py-2 sm:col-span-12 md:col-span-6 lg:col-span-3 xl:col-span-3">
                <div class="bg-white shadow-sm dark:shadow-slate-700/10 dark:bg-gray-900  rounded-md w-full relative mb-4">
                    <div class="flex-auto p-4">
                        <div class="flex justify-between xl:gap-x-2 items-cente">
                            <div class="self-center">
                                <p class="text-gray-800 font-semibold dark:text-slate-400 uppercase">Produk</p>
                                <h3 class="my-4 font-semibold text-[30px] dark:text-slate-200" id="produks">
                                    {{-- {{ $produks }}</h3> --}}
                            </div>
                            <div class="self-center">
                                <i data-lucide="shopping-basket" class=" h-16 w-16 stroke-red-500/30"></i>
                            </div>
                        </div>
                    </div><!--end card-body-->
                </div> <!--end inner-grid-->
            </div>
        </div> <!--end grid-->

        {{-- <div class="grid grid-cols-12 sm:grid-cols-12 md:grid-cols-12 lg:grid-cols-12 xl:grid-cols-12 gap-4">
            <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-4">
                <div class="w-full relative mb-4">
                    <div class="flex-auto p-4">
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-12 sm:col-span-4">
                                <img src="{{ asset('design-system/assets/images/widgets/user.png') }}" alt="" class="h-auto w-full">
                            </div><!--end col-->
                            <div class="col-span-12 sm:col-span-8 self-center">
                                <h4 class="font-medium flex-1 self-center mb-2 md:mb-0 dark:text-slate-400 text-xl">A Guide
                                    to Analyze and Optimize Your Online Business</h4>
                            </div><!--end col-->
                        </div><!--end grid-->

                        <div class="border-b border-dashed border-slate-300 dark:border-slate-700/40 my-3"></div>
                        <div class="grid grid-cols-12 gap-4 mb-8">
                            <div class="col-span-12 sm:col-span-6">
                                <div id="email_report" class="apex-charts -mb-4"></div>
                            </div><!--end col-->
                            <div class="col-span-12 sm:col-span-6 self-center">
                                <ol class="list-none list-inside mb-3">
                                    <li class="mb-1 text-slate-700 dark:text-slate-400 text-sm"><i
                                            class="icofont-ui-play me-2 text-brand-500"></i> Tablet</li>
                                    <li class="mb-1 text-slate-700 dark:text-slate-400 text-sm"><i
                                            class="icofont-ui-play me-2 text-yellow-400"></i> Desktop</li>
                                    <li class="mb-1 text-slate-700 dark:text-slate-400 text-sm"><i
                                            class="icofont-ui-play me-2 text-[#13939c]"></i> Moble</li>
                                </ol>
                                <button type="button"
                                    class="inline-block shadow-sm dark:shadow-slate-700/10 focus:outline-none text-slate-600 hover:bg-brand-500 hover:text-white bg-transparent border border-slate-300 dark:bg-transparent dark:text-slate-400 dark:hover:text-white dark:border-gray-700 dark:hover:bg-brand-500  text-sm font-medium py-1 px-3 rounded">View
                                    Details <i class="mdi mdi-arrow-right"></i></button>
                            </div><!--end col-->
                        </div><!--end grid-->
                        <h6
                            class="bg-brand-400/5 shadow-sm dark:shadow-slate-700/10 border border-dashed dark:text-brand-300 border-brand dark:bg-slate-700/40 py-3 px-2 rounded-md  text-center text-brand-500 font-medium mt-3">
                            <i class="ti ti-calendar self-center text-lg mr-1"></i>
                            01 January 2023 to 31 December 2024
                        </h6>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
            <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-8 xl:col-span-8">
                <div class="w-full relative mb-4">
                    <div
                        class="border-b border-dashed border-slate-200 dark:border-slate-700 py-3 px-4 dark:text-slate-300/70">
                        <div class="flex-none md:flex">
                            <h4 class="font-medium flex-1 self-center mb-2 md:mb-0 text-xxl">Sales Report</h4>
                            <div class="dropdown inline-block">
                                <button data-fc-autoclose="both" data-fc-type="dropdown"
                                    class="dropdown-toggle px-3 py-1 text-xs font-medium text-gray-500 focus:outline-none bg-white rounded border border-gray-200 hover:bg-gray-50 hover:text-slate-800 focus:z-10 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                                    type="button">
                                    This Month
                                    <i class="fas fa-chevron-down text-xs ml-2"></i>
                                </button>
                                <!-- Dropdown menu -->
                                <div
                                    class="right-auto md:right-0 hidden z-10 w-28 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                        aria-labelledby="dropdownDefault">
                                        <li>
                                            <a href="#"
                                                class="block py-2 px-4 hover:bg-gray-50 dark:hover:bg-gray-600 dark:hover:text-white">Today</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="block py-2 px-4 hover:bg-gray-50 dark:hover:bg-gray-600 dark:hover:text-white">Last
                                                Week</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="block py-2 px-4 hover:bg-gray-50 dark:hover:bg-gray-600 dark:hover:text-white">Last
                                                Month</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="block py-2 px-4 hover:bg-gray-50 dark:hover:bg-gray-600 dark:hover:text-white">This
                                                Year</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-auto p-4">
                        <div id="crm-dash" class="apex-charts mt-5"></div>
                    </div><!--end card-body-->
                </div> <!--end inner-grid-->
            </div><!--end col-->


        </div> <!--end grid--> --}}
        <div class="grid grid-cols-12 sm:grid-cols-12 md:grid-cols-12 lg:grid-cols-12 xl:grid-cols-12 gap-4 mb-4">
            <div class="col-span-12 sm:col-span-12  md:col-span-12 lg:col-span-6 xl:col-span-6 ">
                <div class="bg-white shadow-sm dark:shadow-slate-700/10 dark:bg-gray-900   rounded-md w-full relative">
                    <div
                        class="border-b border-dashed border-slate-200 dark:border-slate-700 py-4 px-4 dark:text-slate-300/70">
                        <h4 class="font-medium flex-1 self-center mb-2 md:mb-0 text-xxl">Earnings Reports</h4>
                        <p class="text-sm text-slate-400">Earnings Reports Last Week <span
                                class="focus:outline-none text-[11px] bg-brand-500/10 text-brand-500 dark:text-brand-300 rounded font-medium py-[2px] px-2">$18532</span>
                        </p>
                    </div><!--end header-title-->
                    <div class="grid grid-cols-1 p-4">
                        <div class="sm:-mx-6 lg:-mx-8">
                            <div class="relative overflow-x-auto block w-full sm:px-6 lg:px-8">
                                <table class="w-full">
                                    <thead class="bg-brand-400/10 dark:bg-slate-700/20">
                                        <tr>
                                            <th scope="col"
                                                class="p-3 text-base font-medium tracking-wider text-start text-gray-700 uppercase dark:text-gray-400">
                                                Date
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-base font-medium tracking-wider text-start text-gray-700 uppercase dark:text-gray-400">
                                                Item Count
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-base font-medium tracking-wider text-start text-gray-700 uppercase dark:text-gray-400">
                                                Tex
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-base font-medium tracking-wider text-start text-gray-700 uppercase dark:text-gray-400">
                                                Earnings
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- 1 -->
                                        <tr
                                            class="bg-white border-b border-dashed dark:bg-gray-900 dark:border-gray-700/40">
                                            <td class="p-3 text-base  text-gray-600 whitespace-nowrap dark:text-gray-400">
                                                01 January
                                            </td>
                                            <td class="p-3 text-base text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                50
                                            </td>
                                            <td class="p-3 text-base text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                <span class="text-red-500">$70</span>
                                            </td>
                                            <td class="p-3 text-base text-gray-700 whitespace-nowrap dark:text-gray-400">
                                                <span class="font-semibold">$15,000</span>
                                            </td>
                                        </tr>
                                        <!-- 2 -->
                                        <tr
                                            class="bg-white border-b border-dashed dark:bg-gray-900 dark:border-gray-700/40">
                                            <td class="p-3 text-base  text-gray-600 whitespace-nowrap dark:text-gray-400">
                                                02 January
                                            </td>
                                            <td class="p-3 text-base text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                25
                                            </td>
                                            <td class="p-3 text-base text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                <span class="text-slate-100">-</span>
                                            </td>
                                            <td class="p-3 text-base text-gray-700 whitespace-nowrap dark:text-gray-400">
                                                <span class="font-semibold">$15,000</span>
                                            </td>
                                        </tr>
                                        <!-- 3 -->
                                        <tr
                                            class="bg-white border-b border-dashed dark:bg-gray-900 dark:border-gray-700/40">
                                            <td class="p-3 text-base  text-gray-600 whitespace-nowrap dark:text-gray-400">
                                                03 January
                                            </td>
                                            <td class="p-3 text-base text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                65
                                            </td>
                                            <td class="p-3 text-base text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                <span class="text-red-500">$115</span>
                                            </td>
                                            <td class="p-3 text-base text-gray-700 whitespace-nowrap dark:text-gray-400">
                                                <span class="font-semibold">$35,000</span>
                                            </td>
                                        </tr>
                                        <!-- 4 -->
                                        <tr
                                            class="bg-white border-b border-dashed dark:bg-gray-900 dark:border-gray-700/40">
                                            <td class="p-3 text-base  text-gray-600 whitespace-nowrap dark:text-gray-400">
                                                04 January
                                            </td>
                                            <td class="p-3 text-base text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                20
                                            </td>
                                            <td class="p-3 text-base text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                <span class="text-slate-500">-</span>
                                            </td>
                                            <td class="p-3 text-base text-gray-700 whitespace-nowrap dark:text-gray-400">
                                                <span class="font-semibold">$8,500</span>
                                            </td>
                                        </tr>
                                        <!-- 5 -->
                                        <tr
                                            class="bg-white border-b border-dashed dark:bg-gray-900 dark:border-gray-700/40">
                                            <td class="p-3 text-base  text-gray-600 whitespace-nowrap dark:text-gray-400">
                                                05 January
                                            </td>
                                            <td class="p-3 text-base text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                20
                                            </td>
                                            <td class="p-3 text-base text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                <span class="text-slate-500">-</span>
                                            </td>
                                            <td class="p-3 text-base text-gray-700 whitespace-nowrap dark:text-gray-400">
                                                <span class="font-semibold">$8,500</span>
                                            </td>
                                        </tr>
                                        <!-- 6 -->
                                        <tr class="bg-white  dark:bg-gray-900">
                                            <td class="p-3 text-base  text-gray-600 whitespace-nowrap dark:text-gray-400">
                                                06 January
                                            </td>
                                            <td class="p-3 text-base text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                40
                                            </td>
                                            <td class="p-3 text-base text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                <span class="text-red-500">$60</span>
                                            </td>
                                            <td class="p-3 text-base text-gray-700 whitespace-nowrap dark:text-gray-400">
                                                <span class="font-semibold">$12,000</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!--end card-body-->
                </div> <!--end card-->
            </div><!--end col-->
            <div class="col-span-12 sm:col-span-12  md:col-span-12 lg:col-span-6 xl:col-span-6 ">
                <div class="bg-white shadow-sm dark:shadow-slate-700/10 dark:bg-gray-900   rounded-md w-full relative">
                    <div
                        class="border-b border-dashed border-slate-200 dark:border-slate-700 py-4 px-4 dark:text-slate-300/70">
                        <h4 class="font-medium flex-1 self-center mb-2 md:mb-0 text-xxl">Most Populer Products</h4>
                        <p class="text-sm text-slate-400">New Products Last Week <span
                                class="focus:outline-none text-[11px] bg-brand-500/10 text-brand-500 dark:text-brand-300 rounded font-medium py-[2px] px-2">5</span>
                        </p>
                    </div><!--end header-title-->
                    <div class="grid grid-cols-1 p-4">
                        <div class="sm:-mx-6 lg:-mx-8">
                            <div class="relative overflow-x-auto block w-full sm:px-6 lg:px-8">
                                <table class="w-full">
                                    <thead class="bg-brand-400/10 dark:bg-slate-700/20">
                                        <tr>
                                            <th scope="col"
                                                class="p-3 text-base font-medium tracking-wider text-start text-gray-700 uppercase dark:text-gray-400">
                                                Product
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-base font-medium tracking-wider text-start text-gray-700 uppercase dark:text-gray-400">
                                                Price
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-base font-medium tracking-wider text-start text-gray-700 uppercase dark:text-gray-400">
                                                Sell
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-base font-medium tracking-wider text-start text-gray-700 uppercase dark:text-gray-400">
                                                Status
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-base font-medium tracking-wider text-start text-gray-700 uppercase dark:text-gray-400">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- 1 -->
                                        <tr
                                            class="bg-white border-b border-dashed dark:bg-gray-900 dark:border-gray-700/40">
                                            <td class="p-3 text-base font-medium whitespace-nowrap dark:text-white">
                                                <img src="{{ asset('design-system/assets/images/products/01.png') }}"
                                                    alt="" class="me-2 h-10 inline-block">Robotech Camera EDM
                                                5D(White)
                                            </td>
                                            <td class="p-3 text-base text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                $50 <del class="text-gray-400">$90</del>
                                            </td>
                                            <td class="p-3 text-base text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                450<small class="text-gray-400">(500)</small>
                                            </td>
                                            <td class="p-3 text-base text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                <span
                                                    class="focus:outline-none text-[12px] bg-green-600/10 text-green-700 dark:text-green-600 rounded font-medium py-1 px-2">Stock</span>
                                            </td>
                                            <td class="p-3 text-base text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                <a href="#"><i
                                                        class="icofont-ui-edit text-lg text-gray-500 dark:text-gray-400"></i></a>
                                                <a href="#"><i
                                                        class="icofont-ui-delete text-lg text-red-500 dark:text-red-400"></i></a>
                                            </td>
                                        </tr>
                                        <!-- 2 -->
                                        <tr
                                            class="bg-white border-b border-dashed dark:bg-gray-900 dark:border-gray-700/40">
                                            <td class="p-3 text-base font-medium whitespace-nowrap dark:text-white">
                                                <img src="{{ asset('design-system/assets/images/products/03.png') }}"
                                                    alt="" class="me-2 h-10 inline-block">Robotech VR 5D (Black)
                                            </td>
                                            <td class="p-3 text-base text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                $39 <del class="text-gray-400">$99</del>
                                            </td>
                                            <td class="p-3 text-base text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                700<small class="text-gray-400">(700)</small>
                                            </td>
                                            <td class="p-3 text-base text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                <span
                                                    class="focus:outline-none text-[12px] bg-red-500/10 text-red-700 dark:text-red-400 rounded font-medium py-1 px-2">Sold</span>
                                            </td>
                                            <td class="p-3 text-base text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                <a href="#"><i
                                                        class="icofont-ui-edit text-lg text-gray-500 dark:text-gray-400"></i></a>
                                                <a href="#"><i
                                                        class="icofont-ui-delete text-lg text-red-500 dark:text-red-400"></i></a>
                                            </td>
                                        </tr>
                                        <!-- 3 -->
                                        <tr
                                            class="bg-white border-b border-dashed dark:bg-gray-900 dark:border-gray-700/40">
                                            <td class="p-3 text-base font-medium whitespace-nowrap dark:text-white">
                                                <img src="{{ asset('design-system/assets/images/products/02.png') }}"
                                                    alt="" class="me-2 h-10 inline-block">Robotech Shoes Max-Zon
                                            </td>
                                            <td class="p-3 text-base text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                $49 <del class="text-gray-400">$88</del>
                                            </td>
                                            <td class="p-3 text-base text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                850<small class="text-gray-400">(900)</small>
                                            </td>
                                            <td class="p-3 text-base text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                <span
                                                    class="focus:outline-none text-[12px] bg-green-600/10 text-green-700 dark:text-green-600 rounded font-medium py-1 px-2">Stock</span>
                                            </td>
                                            <td class="p-3 text-base text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                <a href="#"><i
                                                        class="icofont-ui-edit text-lg text-gray-500 dark:text-gray-400"></i></a>
                                                <a href="#"><i
                                                        class="icofont-ui-delete text-lg text-red-500 dark:text-red-400"></i></a>
                                            </td>
                                        </tr>
                                        <!-- 4 -->
                                        <tr
                                            class="bg-white border-b border-dashed dark:bg-gray-900 dark:border-gray-700/40">
                                            <td class="p-3 text-base font-medium whitespace-nowrap dark:text-white">
                                                <img src="{{ asset('design-system/assets/images/products/04.png') }}"
                                                    alt="" class="me-2 h-10 inline-block">Robotech Mask N99 [ISI]
                                            </td>
                                            <td class="p-3 text-base text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                $5 <del class="text-gray-400">$9</del>
                                            </td>
                                            <td class="p-3 text-base text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                1850<small class="text-gray-400">(2000)</small>
                                            </td>
                                            <td class="p-3 text-base text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                <span
                                                    class="focus:outline-none text-[12px] bg-green-600/10 text-green-700 dark:text-green-600 rounded font-medium py-1 px-2">Stock</span>
                                            </td>
                                            <td class="p-3 text-base text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                <a href="#"><i
                                                        class="icofont-ui-edit text-lg text-gray-500 dark:text-gray-400"></i></a>
                                                <a href="#"><i
                                                        class="icofont-ui-delete text-lg text-red-500 dark:text-red-400"></i></a>
                                            </td>
                                        </tr>
                                        <!-- 5 -->
                                        <tr class="bg-white  dark:bg-gray-900">
                                            <td class="p-3 text-base font-medium whitespace-nowrap dark:text-white">
                                                <img src="{{ asset('design-system/assets/images/products/01.png') }}"
                                                    alt="" class="me-2 h-10 inline-block">Robotech Camera EDM
                                                5D(White)
                                            </td>
                                            <td class="p-3 text-base text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                $50 <del class="text-gray-400">$90</del>
                                            </td>
                                            <td class="p-3 text-base text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                450<small class="text-gray-400">(500)</small>
                                            </td>
                                            <td class="p-3 text-base text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                <span
                                                    class="focus:outline-none text-[12px] bg-red-500/10 text-red-700 dark:text-red-400 rounded font-medium py-1 px-2">Sold</span>
                                            </td>
                                            <td class="p-3 text-base text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                <a href="#"><i
                                                        class="icofont-ui-edit text-lg text-gray-500 dark:text-gray-400"></i></a>
                                                <a href="#"><i
                                                        class="icofont-ui-delete text-lg text-red-500 dark:text-red-400"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!--end card-body-->
                </div> <!--end card-->
            </div><!--end col-->
        </div><!--end inner-grid-->
    </div>
@endsection
@section('scripts')
    {{-- apex cahrt --}}
    {{-- <script src="{{ asset('design-system/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('design-system/assets/js/pages/analytics-index.init.js') }}"></script> --}}
@endsection
