@props([
    'closeText' => 'Close',
    'saveText' => 'Save',
    'saveId' => 'btn-save',
    'closeClass' => '',
    'saveClass' => '',
])

<div
    {{ $attributes->merge(['class' => 'flex flex-wrap shrink-0 justify-end p-3  rounded-b border-t border-dashed dark:border-gray-700 gap-3']) }}>
    <button type="button" onclick="history.back()"
        class="inline-block focus:outline-none text-red-500 hover:bg-red-500 hover:text-white bg-transparent border border-gray-200 dark:bg-transparent dark:text-red-500 dark:hover:text-white dark:border-gray-700 dark:hover:bg-red-500 text-sm font-medium py-1 px-3 rounded btn-close">Keluar</button>

    <button type="submit" id="{{ $saveId }}"
        class="inline-block focus:outline-none text-primary-500 hover:bg-primary-500 hover:text-white bg-transparent border border-gray-200 dark:bg-transparent dark:text-primary-500 dark:hover:text-white dark:border-gray-700 dark:hover:bg-primary-500 text-sm font-medium py-1 px-3 rounded ">
        {{ $saveText }}
    </button>
</div>
