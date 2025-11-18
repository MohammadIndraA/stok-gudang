@extends('auth.layouts.app')
@section('content')
    <div
        class="w-full  m-auto bg-white dark:bg-slate-800/60 rounded shadow-lg ring-2 ring-slate-300/50 dark:ring-slate-700/50 lg:max-w-md">
        <div class="text-center p-6 bg-slate-900 rounded-t">
            <a href="index.html"><img src="{{ asset('design-system/assets/images/logo-sb-v2.png') }}" alt=""
                    class="w-14 h-14 mx-auto mb-2"></a>
            <h3 class="font-semibold text-white text-xl mb-1">Reset Password For IS-3</h3>
            <p class="text-xs text-slate-400">Enter your Email and instructions will be sent to you!</p>
        </div>
        @if (session('error'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('error') }}
            </div>
        @endif
        <form class="p-6" action="{{ route('forgot-password') }}" method="POST">
            @csrf
            <div>
                <label for="email" class="font-medium text-sm text-slate-600 dark:text-slate-400">Email</label>
                <input type="email" id="email" name="email"
                    class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-2 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700  @error('email') border-red-500 @enderror"
                    value="{{ old('email') }}" placeholder="Your Email" required>
                @error('email')
                    <div class="alert text-red-500 mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mt-4">
                <button type="submit"
                    class="w-full px-2 py-2 tracking-wide text-white transition-colors duration-200 transform bg-brand-500 rounded hover:bg-brand-600 focus:outline-none focus:bg-brand-600">
                    Reset
                </button>
            </div>
        </form>
        </p>
    </div>
@endsection
