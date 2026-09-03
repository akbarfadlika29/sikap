@extends('layouts.admin')

@section('title', 'Approval Permit')

@section('subtitle', 'Kelola proses persetujuan permit atau izin aktivitas luar pegawai dan pejabat.')

@push('styles')

    <link rel="stylesheet"
        href="https://cdn.datatables.net/1.13.11/css/jquery.dataTables.min.css">

    <style>

        /* =========================================================
           APPROVAL DATA TABLE
           ========================================================= */

        #approvalDataTable_wrapper {
            padding: 20px;
        }

        #approvalDataTable_wrapper .dataTables_length,
        #approvalDataTable_wrapper .dataTables_filter {
            margin-bottom: 20px;
        }

        #approvalDataTable_wrapper .dataTables_length label,
        #approvalDataTable_wrapper .dataTables_filter label {
            color: #6b7280;
            font-size: 0.875rem;
            font-weight: 500;
        }

        #approvalDataTable_wrapper .dataTables_length select {
            margin: 0 6px;
            padding: 8px 32px 8px 12px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            outline: none;
        }

        #approvalDataTable_wrapper .dataTables_filter input {
            margin-left: 8px;
            padding: 10px 14px;
            min-width: 240px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            outline: none;
            transition: all 0.2s ease;
        }

        #approvalDataTable_wrapper .dataTables_filter input:focus {
            border-color: #329E80;
            box-shadow: 0 0 0 3px rgba(50, 158, 128, 0.12);
        }

        #approvalDataTable_wrapper .dataTables_info {
            color: #9ca3af;
            font-size: 0.8rem;
            padding-top: 16px;
        }

        #approvalDataTable_wrapper .dataTables_paginate {
            padding-top: 12px;
        }

        #approvalDataTable_wrapper .dataTables_paginate .paginate_button {
            border: none !important;
            border-radius: 10px !important;
            margin: 0 2px;
            padding: 7px 11px !important;
            color: #6b7280 !important;
        }

        #approvalDataTable_wrapper .dataTables_paginate .paginate_button:hover {
            background: #E4F2EE !important;
            color: #1A634E !important;
            border: none !important;
        }

        #approvalDataTable_wrapper .dataTables_paginate .paginate_button.current {
            background: #22775E !important;
            color: white !important;
            border: none !important;
        }

        #approvalDataTable_wrapper .dataTables_paginate .paginate_button.disabled {
            opacity: 0.4;
        }


        /* =========================================================
           TABLE
           ========================================================= */

        #approvalDataTable {
            width: 100% !important;
            min-width: 1100px;
            border-collapse: separate !important;
            border-spacing: 0;
        }

        #approvalDataTable thead th {
            text-align: center !important;
            vertical-align: middle !important;
            background: #ffffff;
            border-bottom: 1px solid #f3f4f6 !important;
        }

        #approvalDataTable_wrapper .dataTables_scroll {
            border-top: 1px solid #f3f4f6;
        }

        #approvalDataTable_wrapper .dataTables_scrollHead {
            background: #ffffff;
        }

        #approvalDataTable_wrapper .dataTables_scrollHeadInner {
            box-sizing: content-box;
        }

        #approvalDataTable_wrapper .dataTables_scrollHeadInner table {
            margin: 0 !important;
        }

        #approvalDataTable_wrapper .dataTables_scrollBody {
            border-bottom: none;
        }

        #approvalDataTable_wrapper .dataTables_scrollHead th,
        #approvalDataTable_wrapper .dataTables_scrollBody td {
            white-space: nowrap;
            box-sizing: border-box;
        }


        /* =========================================================
           STATUS BADGE
           ========================================================= */

        .approval-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 700;
            white-space: nowrap;
        }

        .approval-status-diajukan {
            background: #fff7ed;
            color: #c2410c;
        }

        .approval-status-disetujui {
            background: #ecfdf5;
            color: #047857;
        }

        .approval-status-ditolak {
            background: #fef2f2;
            color: #dc2626;
        }


        /* =========================================================
           ACTION BUTTON
           ========================================================= */

        .approval-action-button {
            width: 38px;
            height: 38px;
            border-radius: 12px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            background: #eff6ff;
            color: #2563eb;

            transition:
                background-color 0.2s ease,
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }

        .approval-action-button:hover {
            background: #dbeafe;
            color: #1d4ed8;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.10);
        }


        /* =========================================================
           EMPTY STATE
           ========================================================= */

        .approval-empty-icon {
            width: 68px;
            height: 68px;
            border-radius: 22px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #E4F2EE;
            color: #1A634E;
        }

    </style>

@endpush


@section('content')

    {{-- =========================================================
         HEADER
         ========================================================= --}}

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5 mb-8">

        <div>

            <div class="flex items-center gap-3 mb-2">

                <div class="w-11 h-11 rounded-2xl
                            bg-[#E4F2EE]
                            flex items-center justify-center
                            text-[#1A634E]">

                    <i class="fa-solid fa-file-circle-check text-lg"></i>

                </div>

                <div>

                    <h3 class="text-xl font-bold text-gray-800">
                        Approval Permit
                    </h3>

                    <p class="text-sm text-gray-500 mt-0.5">
                        Kelola dan pantau proses persetujuan permit pegawai.
                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         SUMMARY CARD
         ========================================================= --}}

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">

        {{-- Diajukan --}}
        <div class="bg-white border border-gray-100 rounded-2xl p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">
                        Menunggu Approval
                    </p>

                    <p class="text-2xl font-bold text-gray-800 mt-1">

                        {{ $aktivitasLuar->where('status_permit', 'diajukan')->count() }}

                    </p>

                </div>

                <div class="w-11 h-11 rounded-xl
                            bg-orange-50 text-orange-600
                            flex items-center justify-center">

                    <i class="fa-solid fa-clock"></i>

                </div>

            </div>

        </div>


        {{-- Disetujui --}}
        <div class="bg-white border border-gray-100 rounded-2xl p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">
                        Disetujui
                    </p>

                    <p class="text-2xl font-bold text-gray-800 mt-1">

                        {{ $aktivitasLuar->where('status_permit', 'disetujui')->count() }}

                    </p>

                </div>

                <div class="w-11 h-11 rounded-xl
                            bg-green-50 text-green-600
                            flex items-center justify-center">

                    <i class="fa-solid fa-circle-check"></i>

                </div>

            </div>

        </div>


        {{-- Ditolak --}}
        <div class="bg-white border border-gray-100 rounded-2xl p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">
                        Ditolak
                    </p>

                    <p class="text-2xl font-bold text-gray-800 mt-1">

                        {{ $aktivitasLuar->where('status_permit', 'ditolak')->count() }}

                    </p>

                </div>

                <div class="w-11 h-11 rounded-xl
                            bg-red-50 text-red-600
                            flex items-center justify-center">

                    <i class="fa-solid fa-circle-xmark"></i>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         TABLE CARD
         ========================================================= --}}

    <div class="border border-gray-100 rounded-3xl overflow-hidden bg-white">


        {{-- Table Header --}}

        <div class="px-6 py-5 bg-gray-50/70 border-b border-gray-100">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>

                    <h4 class="font-bold text-gray-800">
                        Daftar Permit
                    </h4>

                    <p class="text-xs text-gray-500 mt-1">
                        Permit yang telah diajukan dan sedang atau telah melalui proses persetujuan.
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


        {{-- =====================================================
             TABLE
             ===================================================== --}}

        <table id="approvalDataTable"
            class="text-sm">

            <thead>

                <tr class="bg-white border-b border-gray-100">

                    <th class="px-5 py-4 text-center font-bold text-gray-600">
                        No.
                    </th>

                    <th class="px-5 py-4 text-center font-bold text-gray-600">
                        No. Permit
                    </th>

                    <th class="px-5 py-4 text-center font-bold text-gray-600">
                        Nama
                    </th>

                    <th class="px-5 py-4 text-center font-bold text-gray-600">
                        NIP
                    </th>

                    <th class="px-5 py-4 text-center font-bold text-gray-600">
                        Jenis Aktivitas
                    </th>

                    <th class="px-5 py-4 text-center font-bold text-gray-600">
                        Tanggal & Waktu Keluar
                    </th>

                    <th class="px-5 py-4 text-center font-bold text-gray-600">
                        Posisi
                    </th>

                    <th class="px-5 py-4 text-center font-bold text-gray-600">
                        Status
                    </th>

                    <th class="px-5 py-4 text-center font-bold text-gray-600">
                        Diajukan Pada
                    </th>

                    <th class="px-5 py-4 text-center font-bold text-gray-600">
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($aktivitasLuar as $aktivitas)

                    <tr class="border-b border-gray-50
                               hover:bg-[#F4F9F7]
                               transition-colors">


                        {{-- No. --}}

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


                        {{-- Status --}}

                        <td class="px-5 py-4 text-center">

                            @if($aktivitas->status_permit === 'diajukan')

                                <span class="approval-status approval-status-diajukan">

                                    <i class="fa-solid fa-clock"></i>

                                    Diajukan

                                </span>

                            @elseif($aktivitas->status_permit === 'disetujui')

                                <span class="approval-status approval-status-disetujui">

                                    <i class="fa-solid fa-circle-check"></i>

                                    Disetujui

                                </span>

                            @elseif($aktivitas->status_permit === 'ditolak')

                                <span class="approval-status approval-status-ditolak">

                                    <i class="fa-solid fa-circle-xmark"></i>

                                    Ditolak

                                </span>

                            @endif

                        </td>


                        {{-- Diajukan Pada --}}

                        <td class="px-5 py-4 text-center whitespace-nowrap">

                            <p class="text-gray-700 font-medium">

                                {{ $aktivitas->created_at->translatedFormat('d M Y') }}

                            </p>

                            <p class="text-xs text-gray-400 mt-0.5">

                                {{ $aktivitas->created_at->format('H:i') }}

                            </p>

                        </td>


                        {{-- Aksi --}}

                        <td class="px-5 py-4 text-center">

                            <a href="{{ route('approval.show', $aktivitas->id) }}"
                                title="Lihat Detail Approval"
                                class="approval-action-button">

                                <i class="fa-solid fa-eye text-xs"></i>

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="10" class="px-6 py-16 text-center">

                            <div class="flex flex-col items-center">

                                <div class="approval-empty-icon mb-4">

                                    <i class="fa-solid fa-file-circle-check text-2xl"></i>

                                </div>

                                <h4 class="font-bold text-gray-700">
                                    Belum Ada Permit untuk Approval
                                </h4>

                                <p class="text-sm text-gray-400 mt-1">
                                    Belum terdapat permit yang diajukan untuk proses persetujuan.
                                </p>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

@endsection


@push('scripts')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.11/js/jquery.dataTables.min.js"></script>

    <script>

        $(document).ready(function () {

            $('#approvalDataTable').DataTable({

                pageLength: 10,

                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, 'Semua']
                ],

                ordering: true,

                searching: true,

                info: true,

                paging: true,

                scrollY: '55vh',

                scrollX: true,

                scrollCollapse: true,

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

                    // Tanggal & Waktu
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

                    // Status
                    {
                        targets: 7,
                        className: 'dt-center',
                        width: '130px'
                    },

                    // Diajukan Pada
                    {
                        targets: 8,
                        className: 'dt-center',
                        width: '150px'
                    },

                    // Aksi
                    {
                        targets: 9,
                        className: 'dt-center',
                        width: '90px'
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

                // Permit terbaru berada di atas
                order: [
                    [8, 'desc']
                ]

            });

        });

    </script>

@endpush