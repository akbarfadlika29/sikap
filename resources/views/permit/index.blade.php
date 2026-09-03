@extends('layouts.admin')

@section('title', 'Permit')

@section('subtitle', 'Kelola data permit atau izin aktivitas luar pegawai dan pejabat.')

@push('styles')

    <link rel="stylesheet"
        href="https://cdn.datatables.net/1.13.11/css/jquery.dataTables.min.css">

    <style>
        /* =========================================================
           PERMIT DATA TABLE
           ========================================================= */

        #permitDataTable_wrapper {
            padding: 20px;
        }

        #permitDataTable_wrapper .dataTables_length,
        #permitDataTable_wrapper .dataTables_filter {
            margin-bottom: 20px;
        }

        #permitDataTable_wrapper .dataTables_length label,
        #permitDataTable_wrapper .dataTables_filter label {
            color: #6b7280;
            font-size: 0.875rem;
            font-weight: 500;
        }

        #permitDataTable_wrapper .dataTables_length select {
            margin: 0 6px;
            padding: 8px 32px 8px 12px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            outline: none;
        }

        #permitDataTable_wrapper .dataTables_filter input {
            margin-left: 8px;
            padding: 10px 14px;
            min-width: 240px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            outline: none;
            transition: all 0.2s ease;
        }

        #permitDataTable_wrapper .dataTables_filter input:focus {
            border-color: #329E80;
            box-shadow: 0 0 0 3px rgba(50, 158, 128, 0.12);
        }

        #permitDataTable_wrapper .dataTables_info {
            color: #9ca3af;
            font-size: 0.8rem;
            padding-top: 16px;
        }

        #permitDataTable_wrapper .dataTables_paginate {
            padding-top: 12px;
        }

        #permitDataTable_wrapper .dataTables_paginate .paginate_button {
            border: none !important;
            border-radius: 10px !important;
            margin: 0 2px;
            padding: 7px 11px !important;
            color: #6b7280 !important;
        }

        #permitDataTable_wrapper .dataTables_paginate .paginate_button:hover {
            background: #E4F2EE !important;
            color: #1A634E !important;
            border: none !important;
        }

        #permitDataTable_wrapper .dataTables_paginate .paginate_button.current {
            background: #22775E !important;
            color: white !important;
            border: none !important;
        }

        #permitDataTable_wrapper .dataTables_paginate .paginate_button.disabled {
            opacity: 0.4;
        }

        /* =========================================================
        TABLE HEADER
        ========================================================= */

        #permitDataTable thead th {
            text-align: center !important;
            vertical-align: middle !important;
            background: #ffffff;
            border-bottom: 1px solid #f3f4f6 !important;
        }

        /* =========================================================
        MAIN TABLE WIDTH
        ========================================================= */

        #permitDataTable {
            width: 100% !important;
            min-width: 1100px;
            border-collapse: separate !important;
            border-spacing: 0;
        }

        /* =========================================================
        DATATABLES SCROLL
        ========================================================= */

        #permitDataTable_wrapper .dataTables_scroll {
            border-top: 1px solid #f3f4f6;
        }

        #permitDataTable_wrapper .dataTables_scrollHead {
            background: #ffffff;
        }

        #permitDataTable_wrapper .dataTables_scrollHeadInner {
            /* Biarkan DataTables menentukan lebar header */
            box-sizing: content-box;
        }

        #permitDataTable_wrapper .dataTables_scrollHeadInner table {
            /* Jangan paksa width: 100%.
            DataTables akan menyamakan dengan body table. */
            margin: 0 !important;
        }

        #permitDataTable_wrapper .dataTables_scrollBody {
            border-bottom: none;
        }

        /* Pastikan isi header dan body tidak melakukan wrapping
        yang menyebabkan perhitungan lebar berbeda */
        #permitDataTable_wrapper .dataTables_scrollHead th,
        #permitDataTable_wrapper .dataTables_scrollBody td {
            white-space: nowrap;
            box-sizing: border-box;
        }


        /* =========================================================
        TABLE BODY ALIGNMENT
        ========================================================= */

        /* No. */
        #permitDataTable tbody td:nth-child(1) {
            text-align: center !important;
        }

        /* Nama */
        #permitDataTable tbody td:nth-child(2) {
            text-align: left !important;
        }

        /* NIP */
        #permitDataTable tbody td:nth-child(3),

        /* Jenis Aktivitas */
        #permitDataTable tbody td:nth-child(4),

        /* Tanggal & Waktu Keluar */
        #permitDataTable tbody td:nth-child(5),

        /* Posisi */
        #permitDataTable tbody td:nth-child(6),

        /* Status Verifikasi */
        #permitDataTable tbody td:nth-child(7) {
            text-align: center !important;
            vertical-align: middle !important;
        }

        /* Dibuat Pada */
        #permitDataTable tbody td:nth-child(8),

        /* Aksi */
        #permitDataTable tbody td:nth-child(9) {
            text-align: center !important;
            vertical-align: middle !important;
        }

        /* =========================================================
        DELETE PERMIT LOADING OVERLAY
        ========================================================= */

        #permitDeleteLoading {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 9999;
            background: rgba(255, 255, 255, 0.55);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            align-items: center;
            justify-content: center;
        }

        #permitDeleteLoading.active {
            display: flex;
        }

        .permit-delete-spinner {
            width: 55px;
            height: 55px;
            border: 5px solid rgba(50, 158, 128, 0.25);
            border-top-color: #329E80;
            border-radius: 50%;
            animation: permitDeleteSpin 0.8s linear infinite;
        }

        @keyframes permitDeleteSpin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>

@endpush

@section('content')
    {{-- =========================================================
        DELETE PERMIT LOADING OVERLAY
        ========================================================= --}}

    <div
        id="permitDeleteLoading"
        aria-hidden="true"
    >

        <div class="flex flex-col items-center gap-4">

            <div class="permit-delete-spinner"></div>

            <p class="text-sm font-semibold text-[#1D6751]">
                Menghapus permit...
            </p>

        </div>

    </div>

    {{-- =========================================================
         HEADER
         ========================================================= --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5 mb-8">

        <div>
            <div class="flex items-center gap-3 mb-2">
                <div class="w-11 h-11 rounded-2xl bg-[#E4F2EE] flex items-center justify-center text-[#1A634E]">
                    <i class="fa-solid fa-file-signature text-lg"></i>
                </div>

                <div>
                    <h3 class="text-xl font-bold text-gray-800">
                        Daftar Permit / Izin
                    </h3>

                    <p class="text-sm text-gray-500 mt-0.5">
                        Data aktivitas luar pegawai dan pejabat.
                    </p>
                </div>
            </div>
        </div>

        <a href="{{ route('permit.create') }}"
            class="inline-flex items-center justify-center gap-2
                   bg-gradient-to-r from-[#36A282] to-[#22775E]
                   hover:from-[#2c876b] hover:to-[#1a5e4a]
                   text-white px-5 py-3 rounded-xl
                   font-semibold text-sm shadow-lg
                   hover:shadow-xl hover:-translate-y-0.5
                   transition-all duration-200">

            <i class="fa-solid fa-plus"></i>
            Tambah Permit
        </a>

    </div>


    {{-- =========================================================
         TABLE CARD
         ========================================================= --}}
    <div class="border border-gray-100 rounded-3xl overflow-hidden">

        {{-- Table Header --}}
        <div class="px-6 py-5 bg-gray-50/70 border-b border-gray-100">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>
                    <h4 class="font-bold text-gray-800">
                        Data Permit
                    </h4>

                    <p class="text-xs text-gray-500 mt-1">
                        Gunakan pencarian untuk menemukan data permit.
                    </p>
                </div>

                <div class="text-sm text-gray-500">
                    Total:
                    <span class="font-bold text-[#1A634E]">
                        {{ $aktivitasLuar->count() }}
                    </span>
                    data
                </div>

            </div>

        </div>


        {{-- Table --}}
        

            <table id="permitDataTable"
                class="text-sm">

                <thead>
                    <tr class="bg-white border-b border-gray-100">

                        <th class="px-5 py-4 text-center font-bold text-gray-600 whitespace-nowrap">
                            No.
                        </th>

                        <th class="px-5 py-4 text-center font-bold text-gray-600 whitespace-nowrap">
                            No. Permit
                        </th>

                        <th class="px-5 py-4 text-center font-bold text-gray-600 whitespace-nowrap">
                            Nama
                        </th>

                        <th class="px-5 py-4 text-center font-bold text-gray-600 whitespace-nowrap">
                            NIP
                        </th>

                        <th class="px-5 py-4 text-center font-bold text-gray-600 whitespace-nowrap">
                            Jenis Aktivitas
                        </th>

                        <th class="px-5 py-4 text-center font-bold text-gray-600 whitespace-nowrap">
                            Tanggal & Waktu Keluar
                        </th>

                        <th class="px-5 py-4 text-center font-bold text-gray-600 whitespace-nowrap">
                            Posisi
                        </th>

                        <th class="px-5 py-4 text-center font-bold text-gray-600 whitespace-nowrap">
                            Status Permit
                        </th>

                        <th class="px-5 py-4 text-center font-bold text-gray-600 whitespace-nowrap">
                            Dibuat Pada
                        </th>

                        <th class="px-5 py-4 text-center font-bold text-gray-600 whitespace-nowrap">
                            Aksi
                        </th>

                    </tr>
                </thead>

                <tbody>

                    @forelse($aktivitasLuar as $aktivitas)

                        <tr class="border-b border-gray-50 hover:bg-[#F4F9F7] transition-colors">

                            {{-- No --}}
                            <td class="px-5 py-4 text-center text-gray-500 font-medium">
                                {{ $loop->iteration }}
                            </td>

                            {{-- No. Permit --}}
                            <td class="px-5 py-4 text-center">
                                <span class="font-semibold text-[#22775E] whitespace-nowrap">
                                    {{ $aktivitas->nomor_permit }}
                                </span>
                            </td>

                            {{-- Nama --}}
                            <td class="px-5 py-4 text-left">
                                <span class="font-semibold text-gray-800 whitespace-nowrap">
                                    {{ $aktivitas->user->nama ?? '-' }}
                                </span>
                            </td>


                            {{-- NIP --}}
                            <td class="px-5 py-4 text-center text-gray-600 whitespace-nowrap">
                                {{ $aktivitas->user->nip ?? '-' }}
                            </td>


                            {{-- Jenis Aktivitas --}}
                            <td class="px-5 py-4 text-center">

                                <span class="font-medium text-gray-700 whitespace-nowrap">
                                    {{ $aktivitas->jenisAktivitasLuar->nama_jenis_aktivitas_luar ?? '-' }}
                                </span>

                            </td>


                            {{-- Tanggal & Waktu --}}
                            <td class="px-5 py-4 text-center whitespace-nowrap">

                                <div>
                                    <p class="font-semibold text-gray-700">
                                        {{ \Carbon\Carbon::parse($aktivitas->tanggal_keluar)->translatedFormat('d M Y') }}
                                    </p>

                                    <p class="text-xs text-gray-500 mt-0.5">
                                        <i class="fa-regular fa-clock mr-1"></i>
                                        {{ \Carbon\Carbon::parse($aktivitas->waktu_keluar)->format('H:i') }}
                                    </p>
                                </div>

                            </td>


                            {{-- Posisi --}}
                            <td class="px-5 py-4 text-center">

                                @if($aktivitas->posisi_di_kantor)

                                    <span class="inline-flex items-center gap-1.5
                                                 px-3 py-1.5 rounded-full
                                                 bg-green-50 text-green-700
                                                 text-xs font-bold whitespace-nowrap">

                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                        Di Kantor

                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1.5
                                                 px-3 py-1.5 rounded-full
                                                 bg-orange-50 text-orange-700
                                                 text-xs font-bold whitespace-nowrap">

                                        <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span>
                                        Di Luar

                                    </span>

                                @endif

                            </td>


                            {{-- Status Verifikasi --}}
                            <td class="px-5 py-4 text-center">

                                @if($aktivitas->status_permit === 'draft')

                                    <span class="inline-flex items-center gap-1.5
                                                px-3 py-1.5 rounded-full
                                                bg-gray-100 text-gray-600
                                                text-xs font-bold whitespace-nowrap">

                                        <i class="fa-solid fa-file"></i>
                                        Draft

                                    </span>

                                @elseif($aktivitas->status_permit === 'diajukan')

                                    <span class="inline-flex items-center gap-1.5
                                                px-3 py-1.5 rounded-full
                                                bg-yellow-50 text-yellow-700
                                                text-xs font-bold whitespace-nowrap">

                                        <i class="fa-solid fa-clock"></i>
                                        Diajukan

                                    </span>

                                @elseif($aktivitas->status_permit === 'disetujui')

                                    <span class="inline-flex items-center gap-1.5
                                                px-3 py-1.5 rounded-full
                                                bg-green-50 text-green-700
                                                text-xs font-bold whitespace-nowrap">

                                        <i class="fa-solid fa-circle-check"></i>
                                        Disetujui

                                    </span>

                                @elseif($aktivitas->status_permit === 'ditolak')

                                    <span class="inline-flex items-center gap-1.5
                                                px-3 py-1.5 rounded-full
                                                bg-red-50 text-red-700
                                                text-xs font-bold whitespace-nowrap">

                                        <i class="fa-solid fa-circle-xmark"></i>
                                        Ditolak

                                    </span>

                                @endif

                            </td>


                            {{-- Dibuat Pada --}}
                            <td class="px-5 py-4 text-center whitespace-nowrap">

                                <p class="text-gray-700 font-medium">
                                    {{ $aktivitas->created_at->translatedFormat('d M Y') }}
                                </p>

                                <p class="text-xs text-gray-400 mt-0.5">
                                    {{ $aktivitas->created_at->format('H:i') }}
                                </p>

                            </td>


                            {{-- Aksi --}}
                            <td class="px-5 py-4">

                                <div class="flex items-center justify-center gap-2">

                                    {{-- =====================================================
                                        DETAIL
                                        ===================================================== --}}
                                    <a href="{{ route('permit.show', $aktivitas->id) }}"
                                        title="Lihat Detail"
                                        class="w-9 h-9 rounded-xl
                                            bg-blue-50 text-blue-600
                                            hover:bg-blue-100
                                            flex items-center justify-center
                                            transition-colors">

                                        <i class="fa-solid fa-eye text-xs"></i>

                                    </a>


                                    {{-- =====================================================
                                        EDIT & DELETE
                                        HANYA JIKA BELUM DIVERIFIKASI
                                        ===================================================== --}}
                                    @if($aktivitas->status_permit === 'draft')

                                        {{-- Edit --}}
                                        <a href="{{ route('permit.edit', $aktivitas->id) }}"
                                            title="Edit Permit"
                                            class="w-9 h-9 rounded-xl
                                                bg-amber-50 text-amber-600
                                                hover:bg-amber-100
                                                flex items-center justify-center
                                                transition-colors">

                                            <i class="fa-solid fa-pen text-xs"></i>

                                        </a>


                                        {{-- Delete --}}
                                        <button type="button"
                                            title="Hapus Permit"
                                            class="delete-permit w-9 h-9 rounded-xl
                                                bg-red-50 text-red-600
                                                hover:bg-red-100
                                                flex items-center justify-center
                                                transition-colors"
                                            data-id="{{ $aktivitas->id }}"
                                            data-nama="{{ $aktivitas->user->nama ?? '-' }}">

                                            <i class="fa-solid fa-trash text-xs"></i>

                                        </button>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="10" class="px-6 py-16 text-center">

                                <div class="flex flex-col items-center">

                                    <div class="w-16 h-16 rounded-2xl bg-[#E4F2EE]
                                                flex items-center justify-center
                                                text-[#1A634E] mb-4">

                                        <i class="fa-solid fa-file-circle-xmark text-2xl"></i>

                                    </div>

                                    <h4 class="font-bold text-gray-700">
                                        Belum Ada Data Permit
                                    </h4>

                                    <p class="text-sm text-gray-400 mt-1">
                                        Belum terdapat data aktivitas luar yang tersimpan.
                                    </p>

                                    <a href="{{ route('permit.create') }}"
                                        class="mt-5 inline-flex items-center gap-2
                                               text-sm font-semibold text-[#22775E]
                                               hover:text-[#1A634E]">

                                        <i class="fa-solid fa-plus"></i>
                                        Tambah Permit

                                    </a>

                                </div>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

    </div>

@endsection

@push('scripts')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.11/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {

            $('#permitDataTable').DataTable({

                pageLength: 10,

                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, 'Semua']
                ],

                ordering: true,
                searching: true,
                info: true,
                paging: true,

                /*
                |--------------------------------------------------------------------------
                | Table Scroll
                |--------------------------------------------------------------------------
                | Header tetap freeze ketika vertical scroll.
                | Horizontal scroll hanya pada area tabel.
                */
                scrollY: '55vh',
                scrollX: true,
                scrollCollapse: true,

                /*
                |--------------------------------------------------------------------------
                | Auto Width
                |--------------------------------------------------------------------------
                | Biarkan DataTables menghitung lebar kolom agar
                | header dan body tetap sinkron.
                */
                autoWidth: true,

                columnDefs: [

                    // No. & Aksi
                    {
                        targets: [0, 9],
                        orderable: false,
                        searchable: false
                    },

                    // No.
                    {
                        targets: 0,
                        className: 'dt-center',
                        width: '60px'
                    },

                    // No. Permit
                    {
                        targets: 1,
                        className: 'dt-center',
                        width: '130px'
                    },

                    // Nama
                    {
                        targets: 2,
                        className: 'dt-left',
                        width: '220px'
                    },

                    // NIP
                    {
                        targets: 3,
                        className: 'dt-center',
                        width: '170px'
                    },

                    // Jenis Aktivitas
                    {
                        targets: 4,
                        className: 'dt-center',
                        width: '180px'
                    },

                    // Tanggal & Waktu Keluar
                    {
                        targets: 5,
                        className: 'dt-center',
                        width: '180px'
                    },

                    // Posisi
                    {
                        targets: 6,
                        className: 'dt-center',
                        width: '120px'
                    },

                    // Status Permit
                    {
                        targets: 7,
                        className: 'dt-center',
                        width: '140px'
                    },

                    // Dibuat Pada
                    {
                        targets: 8,
                        className: 'dt-center',
                        width: '150px'
                    },

                    // Aksi
                    {
                        targets: 9,
                        className: 'dt-center',
                        width: '110px'
                    }
                ],

                language: {
                    search: '',
                    searchPlaceholder: 'Cari permit...',
                    lengthMenu: 'Tampilkan _MENU_ data',
                    info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
                    infoEmpty: 'Tidak ada data',
                    zeroRecords: 'Data permit tidak ditemukan',
                    emptyTable: 'Belum ada data permit',

                    paginate: {
                        first: 'Awal',
                        last: 'Akhir',
                        next: '›',
                        previous: '‹'
                    }
                },

                order: [
                    [8, 'desc']
                ]

            });

        });

        document.addEventListener('DOMContentLoaded', function () {

            @if(session('permit_success'))

                Swal.fire({
                    icon: 'success',
                    title: 'Permit Berhasil Disimpan',
                    text: @json(session('permit_success')),
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#22775E',
                    timer: 3000,
                    timerProgressBar: true,
                    allowOutsideClick: true,
                    allowEscapeKey: true
                });

            @endif

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

    const deleteButtons =
        document.querySelectorAll('.delete-permit');

    const deleteLoading =
        document.getElementById('permitDeleteLoading');

            deleteButtons.forEach(function (button) {

                button.addEventListener('click', function () {

                    const permitId = button.dataset.id;
                    const nama = button.dataset.nama || '-';

                    Swal.fire({

                        icon: 'warning',

                        title: 'Hapus Permit?',

                        html:
                            'Permit milik <strong>' + nama + '</strong> ' +
                            'yang masih berstatus draft akan dihapus secara permanen.',

                        showCancelButton: true,

                        confirmButtonText: 'Ya, Hapus',

                        cancelButtonText: 'Batal',

                        confirmButtonColor: '#dc3545',

                        cancelButtonColor: '#6c757d',

                        reverseButtons: true,

                        allowOutsideClick: true,

                        allowEscapeKey: true

                    }).then(function (result) {

                        if (!result.isConfirmed) {
                            return;
                        }

                        deleteLoading.classList.add('active');

                        button.disabled = true;

                        button.classList.add(
                            'opacity-75',
                            'cursor-not-allowed'
                        );

                        const form =
                            document.createElement('form');

                        form.method = 'POST';

                        form.action = "{{ url('/permit') }}/" + permitId + "/destroy";

                        const csrf =
                            document.createElement('input');

                        csrf.type = 'hidden';
                        csrf.name = '_token';
                        csrf.value = "{{ csrf_token() }}";

                        const method =
                            document.createElement('input');

                        method.type = 'hidden';
                        method.name = '_method';
                        method.value = 'DELETE';

                        form.appendChild(csrf);
                        form.appendChild(method);

                        document.body.appendChild(form);

                        form.submit();

                    });

                });

            });

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            @if(session('delete_permit_success'))

                Swal.fire({

                    icon: 'success',

                    title: 'Permit Berhasil Dihapus',

                    text: @json(session('delete_permit_success')),

                    confirmButtonText: 'OK',

                    confirmButtonColor: '#22775E',

                    timer: 2500,

                    timerProgressBar: true,

                    allowOutsideClick: false,

                    allowEscapeKey: false

                });

            @endif


            @if(session('delete_permit_error'))

                Swal.fire({

                    icon: 'error',

                    title: 'Permit Gagal Dihapus',

                    text: @json(session('delete_permit_error')),

                    confirmButtonText: 'OK',

                    confirmButtonColor: '#22775E',

                    timer: 4000,

                    timerProgressBar: true,

                    allowOutsideClick: true,

                    allowEscapeKey: true

                });

            @endif

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            @if(session('update_permit_success'))

                Swal.fire({
                    icon: 'success',
                    title: 'Permit Berhasil Diperbarui',
                    text: @json(session('update_permit_success')),
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#22775E',
                    timer: 2500,
                    timerProgressBar: true,
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then(function () {

                    window.location.href =
                        @json(route('permit.index'));

                });

            @endif

            @if(session('update_permit_error'))

                Swal.fire({
                    icon: 'error',
                    title: 'Permit Gagal Diperbarui',
                    text: @json(session('update_permit_error')),
                    confirmButtonText: 'Coba Lagi',
                    confirmButtonColor: '#22775E',
                    timer: 4000,
                    timerProgressBar: true,
                    allowOutsideClick: true,
                    allowEscapeKey: true
                });

            @elseif($errors->any())

                Swal.fire({
                    icon: 'warning',
                    title: 'Data Belum Lengkap',
                    text: @json($errors->first()),
                    confirmButtonText: 'Periksa Kembali',
                    confirmButtonColor: '#22775E',
                    timer: 4000,
                    timerProgressBar: true,
                    allowOutsideClick: true,
                    allowEscapeKey: true
                });

            @endif

        });
    </script>
@endpush