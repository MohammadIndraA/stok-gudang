<div>
    <label for="{{ $name }}" class="block text-sm font-medium mb-1">
        {{ $label }}
    </label>

    @php
        // Ambil attributes sebagai array biasa, tapi buang item yang bernilai array
        $safeAttributes = [];
        // getAttributes() harus tersedia; jika tidak, ganti dengan (array) $attributes
        foreach ($attributes->getAttributes() as $key => $value) {
            if (!is_array($value)) {
                $safeAttributes[$key] = $value;
            }
        }
        // class default yang ingin kita pakai
        $class =
            'form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500 dark:hover:border-slate-700';
    @endphp

    <select name="{{ $name }}" id="{{ $name }}" class="{{ $class }}"
        @foreach ($safeAttributes as $k => $v) {{ $k }}="{{ $v }}" @endforeach>
        @if ($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif

        @foreach ($options as $value => $label)
            <option value="{{ $value }}" @selected(in_array($value, (array) old($name, $selected)))>
                {{ $label }}
            </option>
        @endforeach
    </select>
</div>
