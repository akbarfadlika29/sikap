@extends('layouts.admin')

@section('title', 'Detail Permit')

@section('subtitle', 'Detail data permit atau izin aktivitas luar pegawai dan pejabat.')

@push('styles')

<style>
    /* =========================================================
       SHOW PERMIT
       ========================================================= */

    .permit-show {
        max-width: 1100px;
        margin: 0 auto;
    }

    /* =========================================================
       BREADCRUMB
       ========================================================= */

    .permit-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 20px;
        font-size: 13px;
    }

    .permit-breadcrumb a {
        color: #22775E;
        text-decoration: none;
        font-weight: 600;
    }

    .permit-breadcrumb a:hover {
        color: #1A634E;
    }

    .permit-breadcrumb i {
        color: #9ca3af;
        font-size: 10px;
    }

    .permit-breadcrumb span {
        color: #6b7280;
    }

    /* =========================================================
       MAIN CARD
       ========================================================= */

    .permit-detail-card {
        background: #ffffff;
        border: 1px solid #eef0f2;
        border-radius: 24px;
        overflow: hidden;
    }

    /* =========================================================
       HEADER
       ========================================================= */

    .permit-detail-header {
        padding: 26px 30px;
        background: linear-gradient(
            135deg,
            #f7fbf9 0%,
            #ffffff 100%
        );
        border-bottom: 1px solid #eef0f2;
    }

    .permit-detail-header-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .permit-detail-title {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .permit-detail-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: #E4F2EE;
        color: #1A634E;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .permit-detail-title h3 {
        margin: 0;
        font-size: 19px;
        font-weight: 700;
        color: #1f2937;
    }

    .permit-detail-title p {
        margin: 4px 0 0;
        font-size: 13px;
        color: #6b7280;
    }

    /* =========================================================
       STATUS
       ========================================================= */

    .permit-status {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 8px 13px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .permit-status-draft {
        background: #f3f4f6;
        color: #6b7280;
    }

    .permit-status-diajukan {
        background: #fff7ed;
        color: #c2410c;
    }

    .permit-status-disetujui {
        background: #ecfdf5;
        color: #047857;
    }

    .permit-status-ditolak {
        background: #fef2f2;
        color: #dc2626;
    }

    /* =========================================================
       BODY
       ========================================================= */

    .permit-detail-body {
        padding: 30px;
    }

    /* =========================================================
       SECTION
       ========================================================= */

    .permit-section {
        margin-bottom: 32px;
    }

    .permit-section:last-child {
        margin-bottom: 0;
    }

    .permit-section-heading {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    .permit-section-number {
        width: 28px;
        height: 28px;
        border-radius: 9px;
        background: #E4F2EE;
        color: #22775E;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 800;
        flex-shrink: 0;
    }

    .permit-section-heading h4 {
        margin: 0;
        font-size: 15px;
        font-weight: 700;
        color: #374151;
    }

    .permit-section-heading p {
        margin: 2px 0 0;
        font-size: 12px;
        color: #9ca3af;
    }

    /* =========================================================
       INFO GRID
       ========================================================= */

    .permit-info-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 1px;
        background: #eef0f2;
        border: 1px solid #eef0f2;
        border-radius: 14px;
        overflow: hidden;
    }

    .permit-info-item {
        background: #ffffff;
        padding: 16px 18px;
    }

    .permit-info-label {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 6px;
        font-size: 11px;
        font-weight: 600;
        color: #9ca3af;
    }

    .permit-info-label i {
        width: 14px;
        text-align: center;
    }

    .permit-info-value {
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        line-height: 1.5;
    }

    .permit-info-value.muted {
        color: #9ca3af;
        font-weight: 500;
    }

    /* =========================================================
       NOMOR PERMIT
       ========================================================= */

    .permit-number-box {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 16px 18px;
        background: #f7fbf9;
        border: 1px solid #dceee7;
        border-radius: 14px;
        margin-bottom: 24px;
    }

    .permit-number-label {
        font-size: 11px;
        font-weight: 600;
        color: #6b7280;
        margin-bottom: 4px;
    }

    .permit-number-value {
        font-size: 17px;
        font-weight: 800;
        color: #1A634E;
        letter-spacing: .2px;
    }

    /* =========================================================
       DESCRIPTION
       ========================================================= */

    .permit-description {
        padding: 16px 18px;
        background: #fafbfb;
        border: 1px solid #eef0f2;
        border-radius: 14px;
        font-size: 13px;
        line-height: 1.7;
        color: #4b5563;
        white-space: pre-line;
    }

    /* =========================================================
       POSITION
       ========================================================= */

    .permit-position {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
    }

    .permit-position.out {
        background: #fff7ed;
        color: #c2410c;
    }

    .permit-position.in {
        background: #ecfdf5;
        color: #047857;
    }

    /* =========================================================
       DOCUMENT
       ========================================================= */

    .permit-document {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 15px 16px;
        border: 1px solid #eef0f2;
        border-radius: 14px;
        background: #ffffff;
    }

    .permit-document-info {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    .permit-document-icon {
        width: 40px;
        height: 40px;
        border-radius: 11px;
        background: #fef2f2;
        color: #dc2626;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .permit-document-name {
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        word-break: break-all;
    }

    .permit-document-description {
        margin-top: 2px;
        font-size: 11px;
        color: #9ca3af;
    }

    .permit-document-button {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 8px 13px;
        border-radius: 9px;
        background: #E4F2EE;
        color: #22775E;
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
        transition: all .2s ease;
    }

    .permit-document-button:hover {
        background: #d5ebe3;
        color: #1A634E;
    }

    /* =========================================================
       REJECTION
       ========================================================= */

    .permit-rejection {
        padding: 16px 18px;
        border: 1px solid #fecaca;
        background: #fef2f2;
        border-radius: 14px;
    }

    .permit-rejection-heading {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 7px;
        color: #b91c1c;
        font-size: 12px;
        font-weight: 700;
    }

    .permit-rejection-text {
        font-size: 13px;
        line-height: 1.6;
        color: #7f1d1d;
        white-space: pre-line;
    }

    /* =========================================================
       DIVIDER
       ========================================================= */

    .permit-divider {
        height: 1px;
        background: #f0f1f2;
        margin: 30px 0;
    }

    /* =========================================================
       FOOTER
       ========================================================= */

    .permit-detail-footer {
        padding: 18px 30px;
        background: #fafbfb;
        border-top: 1px solid #eef0f2;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .permit-footer-info {
        font-size: 11px;
        color: #9ca3af;
    }

    .permit-footer-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .permit-btn {
        min-height: 42px;
        padding: 9px 17px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
        transition: all .2s ease;
    }

    .permit-btn-back {
        border: 1px solid #dfe4e8;
        background: #ffffff;
        color: #6b7280;
    }

    .permit-btn-back:hover {
        background: #f5f6f7;
        color: #374151;
    }

    .permit-btn-edit {
        border: 1px solid #22775E;
        background: linear-gradient(
            135deg,
            #36A282,
            #22775E
        );
        color: #ffffff;
        box-shadow: 0 4px 10px rgba(34, 119, 94, .15);
    }

    .permit-btn-edit:hover {
        transform: translateY(-1px);
        color: #ffffff;
        box-shadow: 0 6px 14px rgba(34, 119, 94, .20);
    }

    /* =========================================================
    AJUKAN PERMIT
    ========================================================= */

    .permit-btn-submit {
        border: 1px solid #2563eb;
        background: linear-gradient(
            135deg,
            #3b82f6,
            #2563eb
        );
        color: #ffffff;
        box-shadow: 0 4px 10px rgba(37, 99, 235, .15);
        cursor: pointer;
    }

    .permit-btn-submit:hover {
        transform: translateY(-1px);
        color: #ffffff;
        box-shadow: 0 6px 14px rgba(37, 99, 235, .20);
    }

    .permit-btn-submit:disabled {
        opacity: .65;
        cursor: not-allowed;
        transform: none;
    }

    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (max-width: 767.98px) {

        .permit-detail-header {
            padding: 20px;
        }

        .permit-detail-header-inner {
            align-items: flex-start;
            flex-direction: column;
        }

        .permit-detail-body {
            padding: 20px;
        }

        .permit-info-grid {
            grid-template-columns: 1fr;
        }

        .permit-number-box {
            align-items: flex-start;
            flex-direction: column;
        }

        .permit-document {
            align-items: flex-start;
            flex-direction: column;
        }

        .permit-document-button {
            width: 100%;
            justify-content: center;
        }

        .permit-detail-footer {
            padding: 16px 20px;
            flex-direction: column;
            align-items: stretch;
        }

        .permit-footer-info {
            display: none;
        }

        .permit-footer-actions {
            width: 100%;
        }

        .permit-footer-actions > * {
            flex: 1;
        }
    }

    /* =========================================================
    AJUKAN PERMIT LOADING OVERLAY
    ========================================================= */

    #permitSubmitLoading {
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

    #permitSubmitLoading.active {
        display: flex;
    }

    .permit-submit-spinner {
        width: 55px;
        height: 55px;
        border: 5px solid rgba(50, 158, 128, 0.25);
        border-top-color: #329E80;
        border-radius: 50%;
        animation: permitSubmitSpin 0.8s linear infinite;
    }

    @keyframes permitSubmitSpin {
        to {
            transform: rotate(360deg);
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const submitButton =
            document.getElementById('submitPermitButton');

        const submitForm =
            document.getElementById('submitPermitForm');

        const submitLoading =
            document.getElementById('permitSubmitLoading');


        if (!submitButton || !submitForm || !submitLoading) {
            return;
        }


        submitButton.addEventListener('click', function () {

            Swal.fire({

                icon: 'question',

                title: 'Ajukan Permit?',

                html:
                    'Permit akan diajukan untuk diproses dan ' +
                    'tidak dapat diedit selama proses persetujuan.',

                showCancelButton: true,

                confirmButtonText: 'Ya, Ajukan',

                cancelButtonText: 'Batal',

                confirmButtonColor: '#2563eb',

                cancelButtonColor: '#6c757d',

                reverseButtons: true,

                allowOutsideClick: true,

                allowEscapeKey: true

            }).then(function (result) {

                if (!result.isConfirmed) {
                    return;
                }


                /*
                |----------------------------------------------------------
                | Aktifkan Loading Overlay
                |----------------------------------------------------------
                */

                submitLoading.classList.add('active');


                /*
                |----------------------------------------------------------
                | Disable Tombol
                |----------------------------------------------------------
                */

                submitButton.disabled = true;

                submitButton.classList.add(
                    'opacity-75',
                    'cursor-not-allowed'
                );


                /*
                |----------------------------------------------------------
                | Ubah Tampilan Tombol
                |----------------------------------------------------------
                */

                submitButton.innerHTML =
                    '<i class="fa-solid fa-spinner fa-spin"></i>' +
                    ' Mengajukan...';


                /*
                |----------------------------------------------------------
                | Submit Form
                |----------------------------------------------------------
                */

                submitForm.submit();

            });

        });

    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        @if(session('submit_permit_success'))

            Swal.fire({

                icon: 'success',

                title: 'Permit Berhasil Diajukan',

                text: @json(session('submit_permit_success')),

                confirmButtonText: 'OK',

                confirmButtonColor: '#22775E',

                timer: 3000,

                timerProgressBar: true,

                allowOutsideClick: false,

                allowEscapeKey: false

            });

        @endif


        @if(session('submit_permit_error'))

            Swal.fire({

                icon: 'error',

                title: 'Permit Gagal Diajukan',

                text: @json(session('submit_permit_error')),

                confirmButtonText: 'OK',

                confirmButtonColor: '#22775E',

                allowOutsideClick: true,

                allowEscapeKey: true

            });

        @endif

    });
</script>

@endpush


@section('content')

<div class="permit-show">
    {{-- =========================================================
         AJUKAN PERMIT LOADING OVERLAY
         ========================================================= --}}

    <div
        id="permitSubmitLoading"
        aria-hidden="true"
    >

        <div class="flex flex-col items-center gap-4">

            <div class="permit-submit-spinner"></div>

            <p class="text-sm font-semibold text-[#1D6751]">
                Mengajukan permit...
            </p>

        </div>

    </div>

    {{-- =========================================================
         BREADCRUMB
         ========================================================= --}}
    <div class="permit-breadcrumb">

        <a href="{{ route('permit.index') }}">
            Permit
        </a>

        <i class="fa-solid fa-chevron-right"></i>

        <span>
            Detail Permit
        </span>

    </div>


    {{-- =========================================================
         MAIN CARD
         ========================================================= --}}
    <div class="permit-detail-card">

        {{-- =====================================================
             HEADER
             ===================================================== --}}
        <div class="permit-detail-header">

            <div class="permit-detail-header-inner">

                <div class="permit-detail-title">

                    <div class="permit-detail-icon">
                        <i class="fa-solid fa-file-signature"></i>
                    </div>

                    <div>

                        <h3>
                            Detail Permit
                        </h3>

                        <p>
                            Informasi lengkap aktivitas luar pegawai.
                        </p>

                    </div>

                </div>


                {{-- STATUS --}}
                @switch($permit->status_permit)

                    @case('draft')

                        <span class="permit-status permit-status-draft">
                            <i class="fa-solid fa-file"></i>
                            Draft
                        </span>

                        @break

                    @case('diajukan')

                        <span class="permit-status permit-status-diajukan">
                            <i class="fa-solid fa-clock"></i>
                            Diajukan
                        </span>

                        @break

                    @case('disetujui')

                        <span class="permit-status permit-status-disetujui">
                            <i class="fa-solid fa-circle-check"></i>
                            Disetujui
                        </span>

                        @break

                    @case('ditolak')

                        <span class="permit-status permit-status-ditolak">
                            <i class="fa-solid fa-circle-xmark"></i>
                            Ditolak
                        </span>

                        @break

                    @default

                        <span class="permit-status permit-status-draft">
                            <i class="fa-solid fa-circle-question"></i>
                            -
                        </span>

                @endswitch

            </div>

        </div>


        {{-- =====================================================
             BODY
             ===================================================== --}}
        <div class="permit-detail-body">


            {{-- =================================================
                 NOMOR PERMIT
                 ================================================= --}}
            <div class="permit-number-box">

                <div>

                    <div class="permit-number-label">
                        Nomor Permit
                    </div>

                    <div class="permit-number-value">
                        {{ $permit->nomor_permit ?? '-' }}
                    </div>

                </div>

                <i class="fa-solid fa-hashtag text-[#9bbdb1]"></i>

            </div>


            {{-- =================================================
                 1. INFORMASI PEGAWAI
                 ================================================= --}}
            <div class="permit-section">

                <div class="permit-section-heading">

                    <div class="permit-section-number">
                        1
                    </div>

                    <div>
                        <h4>
                            Informasi Pegawai
                        </h4>

                        <p>
                            Informasi pegawai yang melakukan aktivitas luar.
                        </p>
                    </div>

                </div>


                <div class="permit-info-grid">

                    {{-- Nama --}}
                    <div class="permit-info-item">

                        <div class="permit-info-label">
                            <i class="fa-solid fa-user"></i>
                            Nama
                        </div>

                        <div class="permit-info-value">
                            {{ $permit->user->nama ?? '-' }}
                        </div>

                    </div>


                    {{-- NIP --}}
                    <div class="permit-info-item">

                        <div class="permit-info-label">
                            <i class="fa-solid fa-id-card"></i>
                            NIP
                        </div>

                        <div class="permit-info-value">
                            {{ $permit->user->nip ?? '-' }}
                        </div>

                    </div>


                    {{-- No WA --}}
                    <div class="permit-info-item">

                        <div class="permit-info-label">
                            <i class="fa-brands fa-whatsapp"></i>
                            No. WhatsApp
                        </div>

                        <div class="permit-info-value
                            {{ empty($permit->user->no_wa) ? 'muted' : '' }}">

                            {{ $permit->user->no_wa ?: 'Belum tersedia' }}

                        </div>

                    </div>


                    {{-- Jabatan --}}
                    <div class="permit-info-item">

                        <div class="permit-info-label">
                            <i class="fa-solid fa-briefcase"></i>
                            Jabatan
                        </div>

                        <div class="permit-info-value">

                            {{ $permit->user->penempatanDefinitif->jabatan->nama_jabatan ?? '-' }}

                        </div>

                    </div>


                    {{-- Unit Kerja --}}
                    <div class="permit-info-item">

                        <div class="permit-info-label">
                            <i class="fa-solid fa-building"></i>
                            Unit Kerja
                        </div>

                        <div class="permit-info-value">

                            {{ $permit->user->penempatanDefinitif->unitKerja->nama_unit_kerja ?? '-' }}

                        </div>

                    </div>

                </div>

            </div>


            <div class="permit-divider"></div>


            {{-- =================================================
                 2. DETAIL AKTIVITAS
                 ================================================= --}}
            <div class="permit-section">

                <div class="permit-section-heading">

                    <div class="permit-section-number">
                        2
                    </div>

                    <div>
                        <h4>
                            Detail Aktivitas
                        </h4>

                        <p>
                            Informasi mengenai aktivitas luar yang dilakukan.
                        </p>
                    </div>

                </div>


                <div class="permit-info-grid">

                    {{-- Jenis Aktivitas --}}
                    <div class="permit-info-item">

                        <div class="permit-info-label">
                            <i class="fa-solid fa-layer-group"></i>
                            Jenis Aktivitas Luar
                        </div>

                        <div class="permit-info-value">

                            {{ $permit->jenisAktivitasLuar->nama_jenis_aktivitas_luar ?? '-' }}

                        </div>

                    </div>


                    {{-- Keberadaan --}}
                    <div class="permit-info-item">

                        <div class="permit-info-label">
                            <i class="fa-solid fa-location-dot"></i>
                            Keberadaan
                        </div>

                        <div>

                            @if($permit->posisi_di_kantor)

                                <span class="permit-position in">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                    Di Kantor
                                </span>

                            @else

                                <span class="permit-position out">
                                    <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span>
                                    Di Luar
                                </span>

                            @endif

                        </div>

                    </div>

                </div>


                {{-- Deskripsi --}}
                <div class="mt-4">

                    <div class="permit-info-label mb-2">
                        <i class="fa-solid fa-align-left"></i>
                        Deskripsi Aktivitas Luar
                    </div>

                    <div class="permit-description">
                        {{ $permit->deskripsi_aktivitas_luar ?: '-' }}
                    </div>

                </div>

            </div>


            <div class="permit-divider"></div>


            {{-- =================================================
                 3. WAKTU AKTIVITAS
                 ================================================= --}}
            <div class="permit-section">

                <div class="permit-section-heading">

                    <div class="permit-section-number">
                        3
                    </div>

                    <div>
                        <h4>
                            Waktu Aktivitas
                        </h4>

                        <p>
                            Waktu keberangkatan dan pengembalian pegawai.
                        </p>
                    </div>

                </div>


                <div class="permit-info-grid">

                    {{-- Tanggal Keluar --}}
                    <div class="permit-info-item">

                        <div class="permit-info-label">
                            <i class="fa-regular fa-calendar"></i>
                            Tanggal Keluar
                        </div>

                        <div class="permit-info-value">

                            {{ $permit->tanggal_keluar?->translatedFormat('d F Y') ?? '-' }}

                        </div>

                    </div>


                    {{-- Waktu Keluar --}}
                    <div class="permit-info-item">

                        <div class="permit-info-label">
                            <i class="fa-regular fa-clock"></i>
                            Waktu Keluar
                        </div>

                        <div class="permit-info-value">

                            {{ $permit->waktu_keluar
                                ? \Carbon\Carbon::parse($permit->waktu_keluar)->format('H:i')
                                : '-' }}
                            WIB

                        </div>

                    </div>


                    {{-- Estimasi Kembali --}}
                    <div class="permit-info-item">

                        <div class="permit-info-label">
                            <i class="fa-regular fa-calendar-check"></i>
                            Tanggal Estimasi Kembali
                        </div>

                        <div class="permit-info-value">

                            {{ $permit->tanggal_estimasi_kembali?->translatedFormat('d F Y') ?? '-' }}

                        </div>

                    </div>


                    {{-- Waktu Estimasi --}}
                    <div class="permit-info-item">

                        <div class="permit-info-label">
                            <i class="fa-regular fa-clock"></i>
                            Waktu Estimasi Kembali
                        </div>

                        <div class="permit-info-value">

                            {{ $permit->waktu_estimasi_kembali
                                ? \Carbon\Carbon::parse($permit->waktu_estimasi_kembali)->format('H:i')
                                : '-' }}
                            WIB

                        </div>

                    </div>


                    {{-- Tanggal Kembali --}}
                    <div class="permit-info-item">

                        <div class="permit-info-label">
                            <i class="fa-solid fa-calendar-day"></i>
                            Tanggal Kembali
                        </div>

                        <div class="permit-info-value
                            {{ !$permit->tanggal_kembali ? 'muted' : '' }}">

                            {{ $permit->tanggal_kembali?->translatedFormat('d F Y') ?? 'Belum kembali' }}

                        </div>

                    </div>


                    {{-- Waktu Kembali --}}
                    <div class="permit-info-item">

                        <div class="permit-info-label">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                            Waktu Kembali
                        </div>

                        <div class="permit-info-value
                            {{ !$permit->waktu_kembali ? 'muted' : '' }}">

                            @if($permit->waktu_kembali)

                                {{ \Carbon\Carbon::parse($permit->waktu_kembali)->format('H:i') }}
                                WIB

                            @else

                                Belum kembali

                            @endif

                        </div>

                    </div>

                </div>

            </div>


            <div class="permit-divider"></div>


            {{-- =================================================
                 4. DOKUMEN PENDUKUNG
                 ================================================= --}}
            <div class="permit-section">

                <div class="permit-section-heading">

                    <div class="permit-section-number">
                        4
                    </div>

                    <div>
                        <h4>
                            Dokumen Pendukung
                        </h4>

                        <p>
                            Dokumen yang dilampirkan pada permit.
                        </p>
                    </div>

                </div>


                @if($permit->dokumen_pendukung)

                    <div class="permit-document">

                        <div class="permit-document-info">

                            <div class="permit-document-icon">
                                <i class="fa-solid fa-file"></i>
                            </div>

                            <div>

                                <div class="permit-document-name">
                                    {{ basename($permit->dokumen_pendukung) }}
                                </div>

                                <div class="permit-document-description">
                                    Dokumen pendukung permit
                                </div>

                            </div>

                        </div>


                        <a
                            href="{{ asset($permit->dokumen_pendukung) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="permit-document-button"
                        >

                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                            Lihat Dokumen

                        </a>

                    </div>

                @else

                    <div class="permit-info-value muted">
                        <i class="fa-regular fa-file mr-1"></i>
                        Tidak ada dokumen pendukung.
                    </div>

                @endif

            </div>


            <div class="permit-divider"></div>


            {{-- =================================================
                 5. INFORMASI PROSES
                 ================================================= --}}
            <div class="permit-section">

                <div class="permit-section-heading">

                    <div class="permit-section-number">
                        5
                    </div>

                    <div>
                        <h4>
                            Informasi Proses
                        </h4>

                        <p>
                            Informasi pembuatan dan pemrosesan permit.
                        </p>
                    </div>

                </div>


                <div class="permit-info-grid">

                    {{-- Dibuat Oleh --}}
                    <div class="permit-info-item">

                        <div class="permit-info-label">
                            <i class="fa-solid fa-user-plus"></i>
                            Dibuat Oleh
                        </div>

                        <div class="permit-info-value">

                            {{ $permit->creator->nama ?? '-' }}

                        </div>

                    </div>


                    {{-- Dibuat Pada --}}
                    <div class="permit-info-item">

                        <div class="permit-info-label">
                            <i class="fa-regular fa-calendar-plus"></i>
                            Dibuat Pada
                        </div>

                        <div class="permit-info-value">

                            {{ $permit->created_at?->translatedFormat('d F Y') ?? '-' }}

                            @if($permit->created_at)

                                <span class="text-xs text-gray-400 font-normal">
                                    {{ $permit->created_at->format('H:i') }} WIB
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- Diproses Oleh --}}
                    <div class="permit-info-item">

                        <div class="permit-info-label">

                            <i class="fa-solid fa-user-check"></i>

                            @if($permit->status_permit === 'ditolak')

                                Ditolak Oleh

                            @elseif($permit->status_permit === 'disetujui')

                                Disetujui Oleh

                            @else

                                Diproses Oleh

                            @endif

                        </div>

                        <div class="permit-info-value
                            {{ !$permit->processor ? 'muted' : '' }}">

                            {{ $permit->processor->nama ?? 'Belum diproses' }}

                        </div>

                    </div>


                    {{-- Diproses Pada --}}
                    <div class="permit-info-item">

                        <div class="permit-info-label">

                            <i class="fa-regular fa-calendar-check"></i>

                            @if($permit->status_permit === 'ditolak')

                                Ditolak Pada

                            @elseif($permit->status_permit === 'disetujui')

                                Disetujui Pada

                            @else

                                Diproses Pada

                            @endif

                        </div>

                        <div class="permit-info-value
                            {{ !$permit->processed_at ? 'muted' : '' }}">

                            @if($permit->processed_at)

                                {{ $permit->processed_at->translatedFormat('d F Y') }}

                                <span class="text-xs text-gray-400 font-normal">
                                    {{ $permit->processed_at->format('H:i') }} WIB
                                </span>

                            @else

                                Belum diproses

                            @endif

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 6. ALASAN PENOLAKAN
                 HANYA STATUS DITOLAK
                 ================================================= --}}
            @if($permit->status_permit === 'ditolak')

                <div class="permit-divider"></div>

                <div class="permit-section">

                    <div class="permit-section-heading">

                        <div class="permit-section-number">
                            <i class="fa-solid fa-xmark"></i>
                        </div>

                        <div>
                            <h4>
                                Alasan Penolakan
                            </h4>

                            <p>
                                Alasan permit tidak disetujui.
                            </p>
                        </div>

                    </div>


                    <div class="permit-rejection">

                        <div class="permit-rejection-heading">

                            <i class="fa-solid fa-circle-exclamation"></i>

                            Permit Ditolak

                        </div>

                        <div class="permit-rejection-text">

                            {{ $permit->alasan_penolakan ?: 'Alasan penolakan belum dicatat.' }}

                        </div>

                    </div>

                </div>

            @endif

        </div>


        {{-- =====================================================
             FOOTER
             ===================================================== --}}
        <div class="permit-detail-footer">

            <div class="permit-footer-info">

                Terakhir diperbarui:

                {{ $permit->updated_at?->translatedFormat('d F Y H:i') ?? '-' }}
                WIB

            </div>


            <div class="permit-footer-actions">

                <a
                    href="{{ route('permit.index') }}"
                    class="permit-btn permit-btn-back"
                >

                    <i class="fa-solid fa-arrow-left"></i>

                    Kembali

                </a>


                {{-- EDIT SEMENTARA HANYA UNTUK DRAFT --}}

                @if($permit->status_permit === 'draft')

                    <a
                        href="{{ route('permit.edit', $permit->id) }}"
                        class="permit-btn permit-btn-edit"
                    >

                        <i class="fa-solid fa-pen"></i>

                        Edit Permit

                    </a>

                    <form 
                        action="{{ route('permit.submit', $permit->id) }}"
                        method="POST"
                        class="inline"
                        id="submitPermitForm"
                    >
                        @csrf

                        <button
                            type="button"
                            id="submitPermitButton"
                            class="permit-btn permit-btn-submit"
                        >
                            <i class="fa-solid fa-paper-plane"></i>

                            Ajukan Permit

                        </button>
                    </form>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection