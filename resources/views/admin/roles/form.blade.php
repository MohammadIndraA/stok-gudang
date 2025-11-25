@extends('layouts.app', ['title' => 'Form Roles'])

@section('content')
    <div class="xl:w-full min-h-[calc(100vh-152px)] relative pb-14">
        <div class="grid md:grid-cols-12 lg:grid-cols-12 xl:grid-cols-12 gap-4 mb-4">
            <div class="sm:col-span-12 md:col-span-12 lg:col-span-8 xl:col-span-6 xl:col-start-4">
                <div
                    class="bg-white dark:bg-gray-900 border border-slate-200 dark:border-slate-700/40 rounded-md w-full max-w-2xl relative mb-4">
                    <div class="border-b border-slate-200 dark:border-slate-700/40 py-3 px-4 dark:text-slate-300/70">
                        <div class="flex-none md:flex">
                            <h4 class="font-medium text-lg flex-1 self-center mb-2 md:mb-0">Form role</h4>
                        </div>
                    </div><!--end header-title-->
                    <div class="flex-auto p-4">
                        <form
                            action="{{ isset($role) ? route('admin.role.update', $role->uuid) : route('admin.role.store') }}"
                            method="POST">
                            @csrf
                            @if (isset($role))
                                @method('PUT')
                            @endif

                            <x-input-v1 name="name" label="Name" :value="old('name', $role->name ?? '')" placeholder="Your Name"
                                required="true" type="text" />

                            <div class="mb-4">
                                <div class="grid sm:grid-cols-1 md:grid-cols-4 grid-cols-4 gap-y-4 mt-5">
                                    @foreach ($permissions as $item)
                                        <label for="permission-{{ $item->uuid }}"
                                            class="flex items-center gap-2 cursor-pointer">
                                            <input type="checkbox" name="permissions[]" id="permission-{{ $item->uuid }}"
                                                value="{{ $item->name }}"
                                                class="peer w-5 h-5 text-primary-600 bg-white border-gray-300 rounded-md focus:ring-primary-500 focus:ring-2"
                                                {{ isset($role) && $role->hasPermissionTo($item->name) ? 'checked' : '' }}>
                                            <span
                                                class="peer-checked:text-primary-600 peer-checked:font-semibold text-sm font-medium text-neutral-700">
                                                {{ $item->name }}
                                            </span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <x-button-modal />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
