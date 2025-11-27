@extends('layouts.app', ['title' => 'Purchase Order'])
@section('styles')
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('design-system/assets/libs/mobius1-selectr/selectr.min.css') }}">
@endsection
@section('content')
    <div
        class="grid grid-cols-12 sm:grid-cols-12 md:grid-cols-12 lg:grid-cols-12 xl:grid-cols-12 gap-4 bg-white shadow shadow-sm dark:bg-[#06090f]">
        <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12">
            <div id="alert-box-error"></div>
            <form class="grid grid-cols-12 gap-6 p-6 m-4" id="form-material-item">
                <div class="col-span-12 md:col-span-6">
                    {{-- vendor --}}
                    <x-select-search name="vendor_id" label="Vendor" :options="$vendors" :value="old('vendor_id', $vendor->vendor_id ?? '')" selected=""
                        placeholder="Pilih vendor..." />
                </div>
                {{-- status --}}
                @php
                    $status = [
                        (object) ['id' => 'draft', 'nama' => 'draft'],
                        (object) ['id' => 'diajukan', 'nama' => 'diajukan'],
                        (object) ['id' => 'disetujui', 'nama' => 'disetujui'],
                        (object) ['id' => 'dibatalkan', 'nama' => 'dibatalkan'],
                    ];
                @endphp
                <div class="col-span-12 md:col-span-6 ms-3">
                    <x-select name="status" label="Status" :options="$status" :value="isset($program_yayasans) ? $program_yayasans->status : null" :required="false" />
                </div>
                {{-- catatan --}}
                <div class="col-span-12 md:col-span-12">
                    <x-textarea name="catatan" label="Catatan" :value="$vendor->catatan ?? ''" :rows="2" :required="false" />
                </div>

                {{-- material --}}
                <div class="col-span-12 md:col-span-5 me-4">
                    <x-select-search name="material_id" label="Material" :value="old('material_id', $vendor->material_id ?? '')" placeholder="Pilih material..."
                        :options="$materials" />
                </div>
                {{-- Jumlah Diminta --}}
                <div class="col-span-12 md:col-span-2 me-4">
                    <x-input-v2 name="jumlah_diminta" label="Jumlah Diminta" :value="old('jumlah_diminta', $vendor->jumlah_diminta ?? '')"
                        placeholder="Masukan Jumlah Diminta" required="false" type="number" />
                </div>
                {{-- Harga Satuan --}}
                <div class="col-span-12 md:col-span-3 me-4">
                    <x-input-v2 name="harga_satuan" label="Harga Satuan" :value="old('harga_satuan', $vendor->harga_satuan ?? '')"
                        placeholder="Masukan Harga Satuan" required="false" type="number" />
                </div>
                <div class="col-span-12 md:col-span-2 end-0">
                    <button id="btn-material-item" type="submit"
                        class="px-2 py-2.5 mt-6 lg:px-4 bg-slate-900 w-full mx-4 text-white text-sm  rounded-full transition hover:bg-slate-800 border border-slate-900 font-medium">Tambahkan</button>
                </div>
            </form>

            {{-- tabel purchase order item --}}

            <div class="card p-4">
                <table class="min-w-full" id="table-material">
                    <thead class="bg-gray-50 dark:bg-gray-600/20">
                        <tr>
                            <th scope="col"
                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400"
                                style="width: 5%">
                                No
                            </th>
                            <th scope="col"
                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                Material
                            </th>
                            <th scope="col"
                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                Qty
                            </th>
                            <th scope="col"
                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                Harga Satuan
                            </th>
                            <th scope="col"
                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                SUB TOTAL
                            </th>
                            <th scope="col"
                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400"
                                style="width: 10%">
                                Option
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot class="bg-gray-10">
                        <tr>
                            <th colspan="5" class="text-right px-4 py-2 font-semibold text-gray-700">
                                Grand Total
                            </th>
                            <th id="grand-total" class="px-4 py-2 text-gray-900 mt-3 bg-gray-400 font-bold">0</th>
                        </tr>
                        <tr>
                            <th colspan="6" class="text-right px-4 py-3">
                                <form action="" id="form-purchase-order">
                                    <button type="submit"
                                        class="inline-block focus:outline-none bg-brand-500 mt-1 text-white hover:bg-brand-600 hover:text-white  text-md font-medium py-2 px-4 rounded">
                                        Simpan Purchase Order
                                    </button>
                                </form>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            {{-- emd --}}
            <div class="w-full relative mt-8">
                <div class="flex-auto p-0 md:p-4">
                    <div
                        class="grid
                                grid-cols-1 p-0 md:p-4 p-4 bg-white rounded-lg dark:bg-gray-900">
                        <div class="sm:-mx-6 lg:-mx-8">
                            <div class="relative overflow-x-auto block w-full sm:px-6 lg:px-8">
                                <table class="w-full" id="poTable">
                                    <thead class="bg-white dark:bg-slate-700/20">
                                        <tr>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                No
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                Nomor PO
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                Vendor
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                Status
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                Diajukan Oleh
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 dark:text-gray-400 uppercase">
                                                Catatan
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-center text-xs font-medium tracking-wider text-gray-700 dark:text-gray-400 uppercase"
                                                style="width: 8%">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div><!--end div-->
                        </div><!--end div-->
                    </div><!--end grid-->
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
    </div> <!--end grid-->
@endsection
@section('scripts')
    <!-- JS -->
    <script src="{{ asset('design-system/assets/libs/mobius1-selectr/selectr.min.js') }}"></script>
    <script src="{{ asset('design-system/assets/js/pages/form-advanced.init.js') }}"></script>
    <script>
        const materialOptions = @json($materials);
    </script>
    <script type="text/javascript">
        new Selectr('#status');
        new Selectr('#vendor_id');
        new Selectr('#material_id');
        $(function() {

            var table = $('#poTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.purchase-order.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'nomor_po',
                        name: 'nomor_po'
                    },
                    {
                        data: 'vendor_id',
                        name: 'vendor_id'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'diajukan_oleh',
                        name: 'diajukan_oleh'
                    },
                    {
                        data: 'catatan',
                        name: 'catatan'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });


            // format rupiah
            const numberFormat = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            });

            let selectMaterial = [];

            // form add material
            $('#form-material-item').on("submit", function(e) {
                e.preventDefault();
                let jumlah_diminta = parseInt($('#jumlah_diminta').val());
                let harga_satuan = parseInt($('#harga_satuan').val());
                let material_id = $('#material_id').val();
                let vendor_id = $('#vendor_id').val();
                let status = $('#status').val();
                let catatan = $('#catatan').val();

                // alert
                if (!jumlah_diminta || !harga_satuan || !material_id) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian',
                        text: 'Input belum lengkap',
                        timer: 3000,
                    });
                    return;
                }

                if (Number.isNaN(jumlah_diminta) || Number.isNaN(harga_satuan) || jumlah_diminta < 1 ||
                    harga_satuan < 100) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Perhatian',
                        text: 'Qty atau harga tidak boleh kurang dari 1',
                        timer: 3000,
                    });
                    return;
                }

                let subTotal = jumlah_diminta * harga_satuan;
                let existingMaterial = selectMaterial.find(item => item.material_id === material_id);
                const materialId = document.getElementById('material_id').value;
                const materialNama = materialOptions[materialId] || '—';

                if (existingMaterial) {
                    existingMaterial.jumlah_diminta += jumlah_diminta;
                    existingMaterial.harga_satuan += harga_satuan;
                    existingMaterial.total_harga += subTotal;
                } else {
                    selectMaterial.push({
                        vendor_id: vendor_id,
                        status: status,
                        catatan: catatan,
                        material_id: material_id,
                        material_nama: materialNama,
                        jumlah_diminta: jumlah_diminta,
                        harga_satuan: harga_satuan,
                        total_harga: subTotal,
                    });
                }


                // reset form
                $('#vendor_id').val(null).trigger('change');
                $('#status').val('');
                $('#catatan').val('');
                $('#material_id').val(null).trigger('change');
                $('#jumlah_diminta').val('');
                $('#harga_satuan').val('');
                $('#total_harga').val('');

                renderTable();
            });

            function renderTable() {
                let tableBody = $('#table-material tbody');
                tableBody.empty(); // clear dulu

                $(document).on('click', '#btn-delete', function() {
                    let materialId = $(this).data('material_id');
                    selectMaterial = selectMaterial.filter(item => item.material_id !== materialId);
                    renderTable();
                });

                if (selectMaterial.length === 0) {
                    tableBody.append(
                        `<tr><td colspan="6" class="text-center p-6">Tidak ada data material</td></tr>`
                    );
                    $("#grand-total").text(numberFormat.format(0));
                    return;
                }

                selectMaterial.forEach((item, index) => {
                    let row = `
                    <tr>
                        <td class="text-left ps-2">${index + 1}</td>
                        <td class="text-left ps-2">${item.material_nama}</td>
                        <td class="text-left ps-2">${item.jumlah_diminta}</td>
                        <td class="text-left ps-2">${numberFormat.format(item.harga_satuan)}</td>
                        <td class="text-left ps-2">${numberFormat.format(item.total_harga)}</td>
                        <td class="text-left ps-1/2" data-material_id="${item.material_id}" id="btn-delete"><i class="far fa-trash-alt bg-red-500 text-white p-2 rounded"></i></td>
                    </tr>
                `;
                    tableBody.append(row);
                });

                // grand total
                let grandTotal = selectMaterial.reduce((total, item) => total + item.total_harga, 0);
                $("#grand-total").text(numberFormat.format(grandTotal));
            }

            renderTable();

            $('#form-purchase-order').on("submit", function(e) {
                e.preventDefault();
                if (selectMaterial.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian',
                        text: 'Minimal 1 material',
                        timer: 3000,
                    });
                    return;
                }

                $.ajax({
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        items: selectMaterial,
                        vendor_id: $('#vendor_id').val(),
                        status: $('#status').val(),
                        catatan: $('#catatan').val(),
                    },
                    url: "{{ route('admin.purchase-order.store') }}",
                    dataType: "JSON",
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Perhatian',
                                text: 'Input berhasil disimpan!',
                                timer: 3000,
                                showConfirmButton: false
                            }).then(() => {
                                // redirect setelah alert selesai / ditutup
                                window.location.href = response.redirect;
                            });

                        }
                    },
                    error: function(xhr) {
                        const errors = xhr.responseJSON?.errors;
                        if (errors) {
                            renderErrors(errors);
                            console.log(errors);
                        }
                    }
                });
            });

            function renderErrors(errors) {
                // Gabungkan semua pesan error jadi satu string
                let allMessages = '';

                for (const [field, messages] of Object.entries(errors)) {
                    messages.forEach(message => {
                        allMessages += `• ${message}\n`;
                    });
                }

                // Tampilkan dengan SweetAlert2
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal',
                    text: allMessages, // kalau mau line break pakai pre-line
                    customClass: {
                        popup: 'text-left'
                    }
                });
            }



        });
    </script>
@endsection
