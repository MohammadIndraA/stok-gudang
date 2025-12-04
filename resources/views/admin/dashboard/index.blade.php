@extends('layouts.app', ['title' => 'Dashboard'])
@section('content')
    <div class="container-fluid">
        @foreach ($minStok as $item)
            <div class="flex p-3 mb-4 bg-red-100 rounded-lg dark:bg-red-200 p-6" role="alert">
                <i class="fas fa-triangle-exclamation flex-shrink-0 text-red-700 self-center"></i>
                <div class="ml-3 text-sm font-medium text-red-700 dark:text-red-800">
                    Material {{ $item->nama_material }} Mencapai Minimal Stok
                </div>
                <button type="button"
                    class="justify-center items-center ml-auto -mx-1.5 -my-1.5 bg-red-100 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-red-200 dark:text-red-600 dark:hover:bg-red-300 alert-hidden">

                    <i class="icofont-close"></i>
                </button>
            </div>
        @endforeach
        <p>dashboard</p>
    </div>
@endsection
@section('scripts')
    {{-- apex cahrt --}}
    {{-- <script src="{{ asset('design-system/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('design-system/assets/js/pages/analytics-index.init.js') }}"></script> --}}
@endsection
