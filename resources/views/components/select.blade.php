@props([
    'name' => '',
    'label' => '',
    'options' => [],
    'value' => null,
    'multiple' => false,
    'disabledOption' => 'Pilih Jenis',
    'required' => false,
    'class' =>
        'w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-2 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500 dark:hover:border-slate-700',
])

<div class="mb-2">
    <label for="{{ $name }}" class="font-medium text-sm text-slate-600 dark:text-slate-400">
        {{ $label }}
        @if ($required)
            <span class="text-red-500">*</span>
        @endif
    </label>

    <select {{ $attributes->merge(['class' => $class]) }} id="{{ $name }}"
        name="{{ $multiple ? $name . '[]' : $name }}" @if ($multiple) multiple @endif
        @if ($required) required @endif>
        @if ($disabledOption)
            <option value="" disabled selected>{{ $disabledOption }}</option>
        @endif

        @foreach ($options as $option)
            <option class="dark:text-slate-700" value="{{ $option->id }}"
                @if ($value) @if ($multiple)
                        {{ in_array($option->id, (array) $value) ? 'selected' : '' }}
                    @else
                        {{ $option->id == $value ? 'selected' : '' }} @endif
                @endif
                >
                {{ $option->nama ?? $option->name }}
            </option>
        @endforeach
    </select>

    @error($name)
        <div class="text-red-500 text-sm mt-1">
            {{ $message }}
        </div>
    @enderror
</div>
