@props([
    'routeEdit' => '',
    'routeDelete' => '',
    'routeShow' => '',
    'id' => '',
    'dataTable' => '',
    'model' => '',
])

<div {{ $attributes->merge(['class' => 'flex justify-end gap-1']) }}>
    <!-- Tombol Edit -->
    @if ($routeEdit != null)
        @can('edit-role', $model)
            <a href="{{ route($routeEdit, $id) }}"
                class="inline-block px-3 py-1 text-sm font-medium text-blue-600 border border-blue-300 rounded hover:bg-blue-600 hover:text-white dark:text-blue-400 dark:border-blue-600 dark:hover:bg-blue-700">
                Edit
            </a>
        @endcan
    @endif

    @if ($routeShow != null)
        @can('edit-role', $model)
            <a href="{{ route($routeShow, $id) }}"
                class="inline-block px-3 py-1 text-sm font-medium text-gray-600 border border-gray-300 rounded hover:bg-gray-600 hover:text-white dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700">
                <i class="icofont-read-book size-2.5"></i>
            </a>
        @endcan
    @endif

    @if ($routeDelete != null)
        <!-- Tombol Delete dengan SweetAlert -->
        @can('delete-role', $model)
            <button type="button" onclick="confirmDelete('{{ route($routeDelete, $id) }}')"
                class="inline-block px-3 py-1 text-sm font-medium text-red-600 border border-red-300 rounded hover:bg-red-600 hover:text-white dark:text-red-400 dark:border-red-600 dark:hover:bg-red-700">
                Hapus
            </button>
        @endcan
    @endif

</div>


<!-- Template SweetAlert -->
<template id="delete-template">
    <swal-title>Yakin ingin menghapus data ini?</swal-title>
    <swal-icon type="warning" color="red"></swal-icon>
    <swal-button type="confirm">Ya, hapus</swal-button>
    <swal-button type="cancel">Batal</swal-button>
    <swal-param name="allowEscapeKey" value="false" />
    <swal-param name="customClass" value='{ "popup": "my-popup" }' />
</template>

<!-- Script SweetAlert -->
<script>
    function confirmDelete(url) {
        Swal.fire({
            template: '#delete-template'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE'
                    },
                    success: function(response) {
                        showAlert('success', response.message);
                        $('#{{ $dataTable }}').DataTable().ajax.reload(null,
                            false); // redraw tanpa reload
                    },
                    error: function(xhr) {
                        const message = xhr.responseJSON?.message || 'Gagal menghapus data';
                        showAlert('danger', message);
                    }
                });
            }
        });
    }
</script>
