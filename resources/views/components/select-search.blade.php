<div>
    <label for="{{ $name }}" class="block text-sm font-medium mb-1">
        {{ $label }}
    </label>

    <select name="{{ $name }}" id="{{ $name }}"
        {{ $attributes->merge([
            'class' => 'form-input w-full rounded-md mt-1 border border-slate-300/60
                                dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1
                                focus:outline-none focus:ring-0 placeholder:text-slate-400/70
                                placeholder:font-normal placeholder:text-sm hover:border-slate-400
                                focus:border-primary-500 dark:focus:border-primary-500
                                dark:hover:border-slate-700',
        ]) }}>

        @if ($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif

        @foreach ($options as $value => $label)
            <option value="{{ $value }}" @selected(collect(old($name, $selected))->contains($value))>
                {{ $label }}
            </option>
        @endforeach
    </select>
</div>
