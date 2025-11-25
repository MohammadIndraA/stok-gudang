@props([
    'name' => '',
    'label' => '',
    'value' => '',
    'rows' => 6,
    'placeholder' => 'Deskripsi ...',
    'required' => false,
    'class' =>
        'form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500 dark:hover:border-slate-700',
])

<div class="mb-2">
    <label for="{{ $name }}" class="font-medium text-sm text-slate-600 dark:text-slate-400">
        {{ $label }}
        @if ($required)
            <span class="text-red-500">*</span>
        @endif
    </label>

    <textarea {{ $attributes->merge(['class' => $class]) }} id="{{ $name }}" name="{{ $name }}"
        rows="{{ $rows }}" placeholder="{{ $placeholder }}" @if ($required) required @endif>{{ old($name, $value) }}</textarea>

    @error($name)
        <div class="text-red-500 text-sm mt-1">
            {{ $message }}
        </div>
    @enderror
</div>
