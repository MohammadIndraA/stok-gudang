<!DOCTYPE html>
<html lang="en" class="scroll-smooth group" data-sidebar="brand" dir="ltr">

<head>
    <meta charset="utf-8" />
    <title>{{ $title ?? config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta content="Tailwind Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="Mannatthemes" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('design-system/assets/images/logo-polda-1.png') }}" />

    <!-- Css -->
    <!-- Main Css -->
    <link rel="stylesheet" href="{{ asset('design-system/assets/libs/icofont/icofont.min.css') }}">
    <link href="{{ asset('design-system/assets/libs/flatpickr/flatpickr.min.css') }}" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('design-system/assets/css/tailwind.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    {{-- sweetalert --}}
    <link rel="stylesheet" href="{{ asset('design-system/assets/libs/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('design-system/assets/libs/animate.css/animate.min.css') }}">
    <style>
        /* Search input & Length dropdown */
        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #d1d5db;
            border-radius: 6px;
            padding: 6px 12px;
            font-size: 14px;
            outline: none;
            margin-bottom: 15px;
        }

        /* Pagination buttons */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 6px 12px;
            margin: 0 2px;
            font-size: 13px;
            border-radius: 4px;
            background-color: #f3f4f6;
            color: #374151;
            border: none;
            cursor: pointer;
        }
    </style>
    @yield('styles')
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

</head>

<body data-layout-mode="light" data-sidebar-size="default" data-theme-layout="vertical"
    class="bg-[#EEF0FC] dark:bg-gray-900">

    <!-- leftbar-tab-menu -->

    <div class="min-h-full z-[99]  fixed inset-y-0 print:hidden dark:bg-[#06090f] main-sidebar duration-300 bg-white">
        <div
            class=" text-center border-b bg-[#06090f] border-r bg-white h-[64px] flex justify-center items-center brand-logo dark:bg-[#06090f] dark:border-slate-700/40">
            <a href="index.html" class="logo">
                <span>
                    <img src="{{ asset('design-system/assets/images/logo-polda.png') }}" alt="logo-small"
                        class="logo-sm h-8 align-middle inline-block">
                </span>
                <span>
                    <img src="{{ asset('design-system/assets/images/text-polda.png') }}" alt="logo-large"
                        class="logo-lg h-[28px] logo-light hidden dark:inline-block ms-1 group-data-[sidebar=dark]:inline-block group-data-[sidebar=brand]:inline-block">
                    <img src="{{ asset('design-system/assets/images/text-polda.png') }}" alt="logo-large"
                        class="logo-lg h-[28px] logo-dark inline-block dark:hidden ms-1 group-data-[sidebar=dark]:hidden group-data-[sidebar=brand]:hidden">
                </span>
            </a>
        </div>
        <div class="border-r pb-14 h-[100vh] dark:bg-[#06090f] dark:border-slate-700/40 group-data-[sidebar=dark]:border-slate-700/40 group-data-[sidebar=brand]:border-slate-700/40"
            data-simplebar>
            <div class="p-4 block">
                @include('layouts.sidebar')
            </div>
        </div>
    </div>


    {{-- navbar --}}
    @include('layouts.navbar')
    {{-- end navbar --}}


    <div class="ltr:flex flex-1 rtl:flex-row-reverse">
        <div
            class="page-wrapper bg-gray-50 dark:bg-[#06090f] relative ltr:ml-auto rtl:mr-auto rtl:ml-0 w-[calc(100%-260px)] px-4 pt-[64px] duration-300">
            <div class="xl:w-full">
                <div class="flex flex-wrap">
                    <div class="flex items-center py-4 w-full">
                        <div class="w-full">
                            <div class="flex flex-wrap justify-between">
                                <div class="items-center ">
                                    <h1 class="font-medium text-3xl block dark:text-slate-100">{{ $title }}</h1>
                                    <ol class="list-reset flex text-sm">
                                        <li><a href="#"
                                                class="text-gray-500 dark:text-slate-400">{{ $title }}</a>
                                        </li>
                                        <li><span class="text-gray-500 dark:text-slate-400 mx-2">/</span></li>
                                        <li class="text-gray-500 dark:text-slate-400">Pages</li>
                                        {{-- <li><span class="text-gray-500 dark:text-slate-400 mx-2">/</span></li> --}}
                                        {{-- <li class="text-primary-500 hover:text-primary-600 dark:text-primary-400">
                                            {{ $subTitle }}</li> --}}
                                    </ol>
                                </div><!--end /div-->
                                <div class="flex items-center">
                                    <div
                                        class="today-date leading-5 mt-2 lg:mt-0 form-input w-auto rounded-md border inline-block border-primary-500/60 dark:border-primary-500/60 text-primary-500 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-primary-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700">
                                        <input type="text"
                                            class="dash_date border-0 focus:border-0 focus:outline-none" readonly
                                            required="">
                                    </div>
                                </div><!--end /div-->
                            </div><!--end /div-->
                        </div><!--end /div-->
                    </div><!--end /div-->
                </div><!--end /div-->
            </div><!--end container-->

            <div class="xl:w-full  min-h-[calc(100vh-152px)] relative pb-14">
                @yield('content')
                <!-- footer -->
                <div
                    class="absolute bottom-0 -left-4 -right-4 block print:hidden border-t p-4 h-[52px] dark:border-slate-700/40">
                    <div class="container">
                        <!-- Footer Start -->
                        <footer
                            class="footer bg-transparent  text-center  font-medium text-slate-600 dark:text-slate-400 md:text-left ">
                            &copy;
                            <script>
                                var year = new Date();
                                document.write(year.getFullYear());
                            </script>
                            Robotech
                            <span class="float-right hidden text-slate-600 dark:text-slate-400 md:inline-block">Crafted
                                with <i class="ti ti-heart text-red-500"></i> by
                                Mannatthemes</span>
                        </footer>
                        <!-- end Footer -->
                    </div>
                </div>

            </div><!--end container-->
        </div><!--end page-wrapper-->
    </div><!--end /div-->


    <!-- JAVASCRIPTS -->
    @include('layouts.scripts')
    <!-- JAVASCRIPTS -->
</body>

</html>
