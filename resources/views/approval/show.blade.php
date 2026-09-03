@extends('layouts.admin')

@section('title', 'Detail Approval Permit')

@section('subtitle', 'Detail dan proses persetujuan permit aktivitas luar pegawai dan pejabat.')

@push('styles')

<style>
    /* =========================================================
       APPROVAL SHOW
       ========================================================= */

    .approval-show {
        max-width: 1100px;
        margin: 0 auto;
        padding-bottom: 32px;
    }

    /* =========================================================
       BREADCRUMB
       ========================================================= */

    .approval-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 18px;
        font-size: 13px;
        color: #6b7280;
    }

    .approval-breadcrumb a {
        color: #329E80;
        text-decoration: none;
        font-weight: 600;
    }

    .approval-breadcrumb a:hover {
        color: #22775E;
    }

    .approval-breadcrumb i {
        font-size: 10px;
        color: #9ca3af;
    }

    /* =========================================================
       DETAIL CARD
       ========================================================= */

    .approval-detail-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04);
    }

    /* =========================================================
       HEADER
       ========================================================= */

    .approval-detail-header {
        padding: 24px 28px;
        border-bottom: 1px solid #eef0f2;
        background: #ffffff;
    }

    .approval-detail-header-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .approval-detail-title-wrapper {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .approval-detail-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: #E4F2EE;
        color: #22775E;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .approval-detail-title {
        margin: 0;
        font-size: 20px;
        line-height: 1.3;
        font-weight: 700;
        color: #1f2937;
    }

    .approval-detail-subtitle {
        margin-top: 4px;
        font-size: 13px;
        color: #6b7280;
    }

    /* =========================================================
       STATUS
       ========================================================= */

    .approval-status {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 8px 13px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .approval-status i {
        font-size: 10px;
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
       BODY
       ========================================================= */

    .approval-detail-body {
        padding: 28px;
    }

    .approval-section {
        margin-bottom: 30px;
    }

    .approval-section:last-child {
        margin-bottom: 0;
    }

    .approval-section-heading {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 18px;
    }

    .approval-section-number {
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
    }

    .approval-section-heading h3 {
        margin: 0;
        font-size: 15px;
        font-weight: 700;
        color: #1f2937;
    }

    /* =========================================================
       INFO GRID
       ========================================================= */

    .approval-info-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px 24px;
    }

    .approval-info-item {
        min-width: 0;
    }

    .approval-info-label {
        margin-bottom: 5px;
        font-size: 12px;
        font-weight: 600;
        color: #6b7280;
    }

    .approval-info-value {
        font-size: 14px;
        line-height: 1.5;
        color: #1f2937;
        font-weight: 500;
        word-break: break-word;
    }

    .approval-info-value.muted {
        color: #9ca3af;
        font-weight: 400;
    }

    /* =========================================================
       PERMIT NUMBER
       ========================================================= */

    .approval-number-box {
        padding: 18px 20px;
        background: #f8faf9;
        border: 1px solid #dcebe6;
        border-radius: 14px;
    }

    .approval-number-label {
        margin-bottom: 6px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .05em;
        color: #6b7280;
    }

    .approval-number-value {
        font-size: 18px;
        font-weight: 800;
        color: #22775E;
        letter-spacing: .02em;
        word-break: break-word;
    }

    /* =========================================================
       DESCRIPTION
       ========================================================= */

    .approval-description {
        padding: 16px 18px;
        background: #f9fafb;
        border: 1px solid #eef0f2;
        border-radius: 14px;
        font-size: 14px;
        line-height: 1.7;
        color: #374151;
        white-space: pre-line;
    }

    /* =========================================================
       POSITION
       ========================================================= */

    .approval-position {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
    }

    .approval-position.out {
        background: #fff7ed;
        color: #c2410c;
    }

    .approval-position.in {
        background: #ecfdf5;
        color: #047857;
    }

    /* =========================================================
       DOCUMENT
       ========================================================= */

    .approval-document {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 15px 16px;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
    }

    .approval-document-info {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    .approval-document-icon {
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

    .approval-document-name {
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        word-break: break-word;
    }

    .approval-document-type {
        margin-top: 2px;
        font-size: 11px;
        color: #9ca3af;
    }

    .approval-document-button {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 8px 12px;
        border-radius: 9px;
        background: #E4F2EE;
        color: #22775E;
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
        transition: .2s ease;
    }

    .approval-document-button:hover {
        background: #d4ebe4;
        color: #1A634E;
    }

    /* =========================================================
       REJECTION
       ========================================================= */

    .approval-rejection {
        padding: 16px 18px;
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-radius: 14px;
    }

    .approval-rejection-title {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 8px;
        font-size: 13px;
        font-weight: 700;
        color: #b91c1c;
    }

    .approval-rejection-text {
        font-size: 13px;
        line-height: 1.6;
        color: #7f1d1d;
        white-space: pre-line;
    }

    /* =========================================================
       PROCESS INFO
       ========================================================= */

    .approval-process-box {
        padding: 16px 18px;
        background: #f9fafb;
        border: 1px solid #eef0f2;
        border-radius: 14px;
    }

    /* =========================================================
       DIVIDER
       ========================================================= */

    .approval-divider {
        height: 1px;
        background: #eef0f2;
        margin: 30px 0;
    }

    /* =========================================================
       RETURN STATUS
       ========================================================= */

    .approval-complete-box {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 15px 17px;
        border-radius: 14px;
        background: #ecfdf5;
        border: 1px solid #bbf7d0;
    }

    .approval-complete-icon {
        width: 40px;
        height: 40px;
        border-radius: 11px;
        background: #d1fae5;
        color: #047857;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .approval-complete-title {
        font-size: 13px;
        font-weight: 700;
        color: #047857;
    }

    .approval-complete-description {
        margin-top: 2px;
        font-size: 12px;
        color: #065f46;
    }

    /* =========================================================
       FOOTER
       ========================================================= */

    .approval-detail-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 20px 28px;
        border-top: 1px solid #eef0f2;
        background: #fafafa;
    }

    .approval-footer-info {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        color: #6b7280;
    }

    .approval-footer-info i {
        color: #9ca3af;
    }

    .approval-footer-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
    }

    .approval-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 40px;
        padding: 9px 15px;
        border-radius: 10px;
        border: 1px solid transparent;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none;
        transition: all .2s ease;
    }

    .approval-btn:disabled {
        cursor: not-allowed;
    }

    .approval-btn-back {
        background: #ffffff;
        color: #4b5563;
        border-color: #d1d5db;
    }

    .approval-btn-back:hover {
        background: #f9fafb;
        color: #1f2937;
    }

    .approval-btn-approve {
        background: #329E80;
        color: #ffffff;
    }

    .approval-btn-approve:hover {
        background: #22775E;
        color: #ffffff;
    }

    .approval-btn-reject {
        background: #ffffff;
        color: #dc2626;
        border-color: #fecaca;
    }

    .approval-btn-reject:hover {
        background: #fef2f2;
        color: #b91c1c;
    }

    .approval-btn-return {
        background: #329E80;
        color: #ffffff;
    }

    .approval-btn-return:hover {
        background: #22775E;
        color: #ffffff;
    }

    /* =========================================================
       LOADING OVERLAY
       ========================================================= */

    #approvalSubmitLoading {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(15, 23, 42, .42);
        backdrop-filter: blur(5px);
        opacity: 0;
        visibility: hidden;
        transition: all .2s ease;
    }

    #approvalSubmitLoading.active {
        opacity: 1;
        visibility: visible;
    }

    .approval-loading-card {
        min-width: 250px;
        padding: 24px;
        text-align: center;
        background: #ffffff;
        border-radius: 18px;
        box-shadow: 0 20px 50px rgba(15, 23, 42, .18);
    }

    .approval-loading-spinner {
        margin-bottom: 12px;
        font-size: 28px;
        color: #329E80;
    }

    .approval-loading-title {
        font-size: 14px;
        font-weight: 700;
        color: #1f2937;
    }

    .approval-loading-description {
        margin-top: 4px;
        font-size: 12px;
        color: #6b7280;
    }

    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (max-width: 768px) {

        .approval-show {
            padding: 0 12px 24px;
        }

        .approval-detail-header {
            padding: 20px;
        }

        .approval-detail-header-inner {
            align-items: flex-start;
            flex-direction: column;
        }

        .approval-detail-body {
            padding: 20px;
        }

        .approval-info-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .approval-document {
            align-items: flex-start;
            flex-direction: column;
        }

        .approval-detail-footer {
            align-items: stretch;
            flex-direction: column;
            padding: 18px 20px;
        }

        .approval-footer-actions {
            width: 100%;
            flex-wrap: wrap;
        }

        .approval-footer-actions .approval-btn {
            flex: 1;
        }
    }

    @media (max-width: 480px) {

        .approval-detail-title {
            font-size: 18px;
        }

        .approval-footer-actions {
            flex-direction: column;
        }

        .approval-footer-actions .approval-btn {
            width: 100%;
        }
    }
</style>

@endpush

@section('content')

<div class="approval-show">

    {{-- Breadcrumb --}}
    <div class="approval-breadcrumb">
        <a href="{{ route('approval.index') }}">
            Approval Permit
        </a>

        <i class="fa-solid fa-chevron-right"></i>

        <span>Detail Permit</span>
    </div>


    {{-- Main Card --}}
    <div class="approval-detail-card">

        {{-- Header --}}
        <div class="approval-detail-header">

            <div class="approval-detail-header-inner">

                <div class="approval-detail-title-wrapper">

                    <div class="approval-detail-icon">
                        <i class="fa-solid fa-file-signature"></i>
                    </div>

                    <div>
                        <h1 class="approval-detail-title">
                            Detail Permit
                        </h1>

                        <div class="approval-detail-subtitle">
                            Informasi lengkap permit aktivitas luar pegawai.
                        </div>
                    </div>

                </div>


                {{-- Status --}}
                @if($approval->status_permit === 'diajukan')

                    <span class="approval-status approval-status-diajukan">
                        <i class="fa-solid fa-clock"></i>
                        Diajukan
                    </span>

                @elseif($approval->status_permit === 'disetujui')

                    <span class="approval-status approval-status-disetujui">
                        <i class="fa-solid fa-circle-check"></i>
                        Disetujui
                    </span>

                @elseif($approval->status_permit === 'ditolak')

                    <span class="approval-status approval-status-ditolak">
                        <i class="fa-solid fa-circle-xmark"></i>
                        Ditolak
                    </span>

                @endif

            </div>

        </div>


        {{-- Body --}}
        <div class="approval-detail-body">

            {{-- =====================================================
                 1. NOMOR PERMIT
                 ===================================================== --}}

            <div class="approval-section">

                <div class="approval-section-heading">
                    <div class="approval-section-number">1</div>

                    <h3>Nomor Permit</h3>
                </div>

                <div class="approval-number-box">

                    <div class="approval-number-label">
                        Nomor Permit
                    </div>

                    <div class="approval-number-value">
                        {{ $approval->nomor_permit }}
                    </div>

                </div>

            </div>


            <div class="approval-divider"></div>


            {{-- =====================================================
                 2. INFORMASI PEGAWAI
                 ===================================================== --}}

            <div class="approval-section">

                <div class="approval-section-heading">
                    <div class="approval-section-number">2</div>

                    <h3>Informasi Pegawai</h3>
                </div>

                <div class="approval-info-grid">

                    <div class="approval-info-item">

                        <div class="approval-info-label">
                            Nama
                        </div>

                        <div class="approval-info-value">
                            {{ $approval->user->nama ?? '-' }}
                        </div>

                    </div>


                    <div class="approval-info-item">

                        <div class="approval-info-label">
                            NIP
                        </div>

                        <div class="approval-info-value">
                            {{ $approval->user->nip ?? '-' }}
                        </div>

                    </div>


                    <div class="approval-info-item">

                        <div class="approval-info-label">
                            No. WhatsApp
                        </div>

                        <div class="approval-info-value">
                            {{ $approval->user->no_wa ?? '-' }}
                        </div>

                    </div>


                    <div class="approval-info-item">

                        <div class="approval-info-label">
                            Jabatan
                        </div>

                        <div class="approval-info-value">
                            {{ $approval->user->penempatanDefinitif->jabatan->nama_jabatan ?? '-' }}
                        </div>

                    </div>


                    <div class="approval-info-item">

                        <div class="approval-info-label">
                            Unit Kerja
                        </div>

                        <div class="approval-info-value">
                            {{ $approval->user->penempatanDefinitif->unitKerja->nama_unit_kerja ?? '-' }}
                        </div>

                    </div>

                </div>

            </div>


            <div class="approval-divider"></div>


            {{-- =====================================================
                 3. DETAIL AKTIVITAS
                 ===================================================== --}}

            <div class="approval-section">

                <div class="approval-section-heading">
                    <div class="approval-section-number">3</div>

                    <h3>Detail Aktivitas</h3>
                </div>

                <div class="approval-info-grid">

                    <div class="approval-info-item">

                        <div class="approval-info-label">
                            Jenis Aktivitas Luar
                        </div>

                        <div class="approval-info-value">
                            {{ $approval->jenisAktivitasLuar->nama_jenis_aktivitas_luar ?? '-' }}
                        </div>

                    </div>


                    <div class="approval-info-item">

                        <div class="approval-info-label">
                            Keberadaan
                        </div>

                        <div class="approval-info-value">

                            @if($approval->posisi_di_kantor)

                                <span class="approval-position in">
                                    <i class="fa-solid fa-building"></i>
                                    Sudah Kembali ke Kantor
                                </span>

                            @else

                                <span class="approval-position out">
                                    <i class="fa-solid fa-person-walking"></i>
                                    Sedang di Luar Kantor
                                </span>

                            @endif

                        </div>

                    </div>

                </div>


                <div style="margin-top: 18px;">

                    <div class="approval-info-label">
                        Deskripsi Aktivitas
                    </div>

                    <div class="approval-description">
                        {{ $approval->deskripsi_aktivitas_luar }}
                    </div>

                </div>

            </div>


            <div class="approval-divider"></div>


            {{-- =====================================================
                 4. WAKTU AKTIVITAS
                 ===================================================== --}}

            <div class="approval-section">

                <div class="approval-section-heading">
                    <div class="approval-section-number">4</div>

                    <h3>Waktu Aktivitas</h3>
                </div>

                <div class="approval-info-grid">

                    <div class="approval-info-item">

                        <div class="approval-info-label">
                            Tanggal Keluar
                        </div>

                        <div class="approval-info-value">
                            {{ \Carbon\Carbon::parse($approval->tanggal_keluar)->translatedFormat('d F Y') }}
                        </div>

                    </div>


                    <div class="approval-info-item">

                        <div class="approval-info-label">
                            Waktu Keluar
                        </div>

                        <div class="approval-info-value">
                            {{ \Carbon\Carbon::parse($approval->waktu_keluar)->format('H:i') }} WIB
                        </div>

                    </div>


                    <div class="approval-info-item">

                        <div class="approval-info-label">
                            Tanggal Estimasi Kembali
                        </div>

                        <div class="approval-info-value">
                            {{ \Carbon\Carbon::parse($approval->tanggal_estimasi_kembali)->translatedFormat('d F Y') }}
                        </div>

                    </div>


                    <div class="approval-info-item">

                        <div class="approval-info-label">
                            Waktu Estimasi Kembali
                        </div>

                        <div class="approval-info-value">
                            {{ \Carbon\Carbon::parse($approval->waktu_estimasi_kembali)->format('H:i') }} WIB
                        </div>

                    </div>


                    <div class="approval-info-item">

                        <div class="approval-info-label">
                            Tanggal Kembali
                        </div>

                        <div class="approval-info-value {{ !$approval->tanggal_kembali ? 'muted' : '' }}">
                            @if($approval->tanggal_kembali)
                                {{ \Carbon\Carbon::parse($approval->tanggal_kembali)->translatedFormat('d F Y') }}
                            @else
                                Belum kembali
                            @endif
                        </div>

                    </div>


                    <div class="approval-info-item">

                        <div class="approval-info-label">
                            Waktu Kembali
                        </div>

                        <div class="approval-info-value {{ !$approval->waktu_kembali ? 'muted' : '' }}">
                            @if($approval->waktu_kembali)
                                {{ \Carbon\Carbon::parse($approval->waktu_kembali)->format('H:i') }} WIB
                            @else
                                Belum kembali
                            @endif
                        </div>

                    </div>

                </div>

            </div>


            <div class="approval-divider"></div>


            {{-- =====================================================
                 5. DOKUMEN PENDUKUNG
                 ===================================================== --}}

            <div class="approval-section">

                <div class="approval-section-heading">
                    <div class="approval-section-number">5</div>

                    <h3>Dokumen Pendukung</h3>
                </div>

                @if($approval->dokumen_pendukung)

                    <div class="approval-document">

                        <div class="approval-document-info">

                            <div class="approval-document-icon">
                                <i class="fa-solid fa-file-pdf"></i>
                            </div>

                            <div>

                                <div class="approval-document-name">
                                    {{ basename($approval->dokumen_pendukung) }}
                                </div>

                                <div class="approval-document-type">
                                    Dokumen pendukung permit
                                </div>

                            </div>

                        </div>

                        <a
                            href="{{ asset($approval->dokumen_pendukung) }}"
                            target="_blank"
                            class="approval-document-button"
                        >
                            <i class="fa-solid fa-eye"></i>
                            Lihat Dokumen
                        </a>

                    </div>

                @else

                    <div class="approval-info-value muted">
                        Tidak ada dokumen pendukung.
                    </div>

                @endif

            </div>


            <div class="approval-divider"></div>


            {{-- =====================================================
                 6. INFORMASI PROSES
                 ===================================================== --}}

            <div class="approval-section">

                <div class="approval-section-heading">
                    <div class="approval-section-number">6</div>

                    <h3>Informasi Proses</h3>
                </div>

                <div class="approval-process-box">

                    <div class="approval-info-grid">

                        <div class="approval-info-item">

                            <div class="approval-info-label">
                                Dibuat Oleh
                            </div>

                            <div class="approval-info-value">
                                {{ $approval->creator->nama ?? '-' }}
                            </div>

                        </div>


                        <div class="approval-info-item">

                            <div class="approval-info-label">
                                Dibuat Pada
                            </div>

                            <div class="approval-info-value">
                                {{ $approval->created_at
                                    ? $approval->created_at->translatedFormat('d F Y, H:i') . ' WIB'
                                    : '-' }}
                            </div>

                        </div>


                        <div class="approval-info-item">

                            <div class="approval-info-label">
                                Diproses Oleh
                            </div>

                            <div class="approval-info-value">
                                {{ $approval->processor->nama ?? 'Belum diproses' }}
                            </div>

                        </div>


                        <div class="approval-info-item">

                            <div class="approval-info-label">
                                Diproses Pada
                            </div>

                            <div class="approval-info-value {{ !$approval->processed_at ? 'muted' : '' }}">

                                @if($approval->processed_at)

                                    {{ $approval->processed_at->translatedFormat('d F Y, H:i') }}
                                    WIB

                                @else

                                    Belum diproses

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 7. ALASAN PENOLAKAN
                 ===================================================== --}}

            @if($approval->status_permit === 'ditolak')

                <div class="approval-divider"></div>

                <div class="approval-section">

                    <div class="approval-section-heading">
                        <div class="approval-section-number">7</div>

                        <h3>Alasan Penolakan</h3>
                    </div>

                    <div class="approval-rejection">

                        <div class="approval-rejection-title">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            Permit Ditolak
                        </div>

                        <div class="approval-rejection-text">
                            {{ $approval->alasan_penolakan ?: 'Tidak ada alasan penolakan.' }}
                        </div>

                    </div>

                </div>

            @endif


            {{-- =====================================================
                 SELESAI
                 ===================================================== --}}

            @if(
                $approval->status_permit === 'disetujui' &&
                $approval->posisi_di_kantor
            )

                <div class="approval-divider"></div>

                <div class="approval-complete-box">

                    <div class="approval-complete-icon">
                        <i class="fa-solid fa-check"></i>
                    </div>

                    <div>

                        <div class="approval-complete-title">
                            Aktivitas Selesai
                        </div>

                        <div class="approval-complete-description">
                            Pegawai telah dikonfirmasi kembali ke kantor pada
                            {{ \Carbon\Carbon::parse($approval->tanggal_kembali)->translatedFormat('d F Y') }}
                            pukul
                            {{ \Carbon\Carbon::parse($approval->waktu_kembali)->format('H:i') }}
                            WIB.
                        </div>

                    </div>

                </div>

            @endif

        </div>


        {{-- =========================================================
             FOOTER
             ========================================================= --}}

        <div class="approval-detail-footer">

            <div class="approval-footer-info">

                <i class="fa-regular fa-clock"></i>

                <span>
                    Diperbarui
                    {{ $approval->updated_at->diffForHumans() }}
                </span>

            </div>


            <div class="approval-footer-actions">

                {{-- Kembali --}}
                <a
                    href="{{ route('approval.index') }}"
                    class="approval-btn approval-btn-back"
                >
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali
                </a>


                {{-- =================================================
                     STATUS DIAJUKAN
                     ================================================= --}}

                @if($approval->status_permit === 'diajukan')

                    {{-- Tolak --}}
                    <button
                        type="button"
                        id="rejectButton"
                        class="approval-btn approval-btn-reject"
                    >
                        <i class="fa-solid fa-xmark"></i>
                        Tolak
                    </button>


                    {{-- Approve --}}
                    <button
                        type="button"
                        id="approveButton"
                        class="approval-btn approval-btn-approve"
                    >
                        <i class="fa-solid fa-check"></i>
                        Approve
                    </button>

                @endif


                {{-- =================================================
                     STATUS DISETUJUI + BELUM KEMBALI
                     ================================================= --}}

                @if(
                    $approval->status_permit === 'disetujui' &&
                    !$approval->posisi_di_kantor
                )

                    <button
                        type="button"
                        id="confirmReturnButton"
                        class="approval-btn approval-btn-return"
                    >
                        <i class="fa-solid fa-building-circle-check"></i>
                        Konfirmasi Kembali ke Kantor
                    </button>

                @endif


                {{-- =================================================
                     STATUS DISETUJUI + SUDAH KEMBALI
                     ================================================= --}}

                @if(
                    $approval->status_permit === 'disetujui' &&
                    $approval->posisi_di_kantor
                )

                    <span
                        class="approval-status approval-status-disetujui"
                        style="min-height: 40px;"
                    >
                        <i class="fa-solid fa-circle-check"></i>
                        Aktivitas Selesai
                    </span>

                @endif

            </div>

        </div>

    </div>

</div>


{{-- =============================================================
     LOADING OVERLAY
     ============================================================= --}}

<div id="approvalSubmitLoading">

    <div class="approval-loading-card">

        <div class="approval-loading-spinner">
            <i class="fa-solid fa-spinner fa-spin"></i>
        </div>

        <div
            class="approval-loading-title"
            id="approvalLoadingTitle"
        >
            Memproses...
        </div>

        <div class="approval-loading-description">
            Mohon tunggu, jangan tutup halaman.
        </div>

    </div>

</div>


{{-- =============================================================
     HIDDEN FORMS
     ============================================================= --}}

<form
    id="approveForm"
    action="{{ route('approval.approve', $approval->id) }}"
    method="POST"
    style="display: none;"
>
    @csrf
</form>


<form
    id="rejectForm"
    action="{{ route('approval.reject', $approval->id) }}"
    method="POST"
    style="display: none;"
>
    @csrf

    <input
        type="hidden"
        name="alasan_penolakan"
        id="rejectionReason"
    >
</form>


<form
    id="confirmReturnForm"
    action="{{ route('approval.confirm-return', $approval->id) }}"
    method="POST"
    style="display: none;"
>
    @csrf
</form>


@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    const loadingOverlay = document.getElementById('approvalSubmitLoading');
    const loadingTitle = document.getElementById('approvalLoadingTitle');


    function showLoading(message) {

        loadingTitle.textContent = message;

        loadingOverlay.classList.add('active');

    }


    function disableButton(button) {

        if (!button) {
            return;
        }

        button.disabled = true;

        button.classList.add(
            'opacity-75',
            'cursor-not-allowed'
        );

    }


    /* =========================================================
       APPROVE
       ========================================================= */

    const approveButton = document.getElementById('approveButton');
    const approveForm = document.getElementById('approveForm');

    if (approveButton) {

        approveButton.addEventListener('click', function () {

            Swal.fire({

                title: 'Approve Permit?',
                text: 'Permit akan disetujui dan dapat digunakan oleh pegawai.',
                icon: 'question',

                showCancelButton: true,

                confirmButtonText: 'Ya, Approve',
                cancelButtonText: 'Batal',

                confirmButtonColor: '#329E80',
                cancelButtonColor: '#6b7280',

                reverseButtons: true,

            }).then((result) => {

                if (result.isConfirmed) {

                    showLoading('Menyetujui permit...');

                    disableButton(approveButton);

                    approveForm.submit();

                }

            });

        });

    }


    /* =========================================================
       REJECT
       ========================================================= */

    const rejectButton = document.getElementById('rejectButton');
    const rejectForm = document.getElementById('rejectForm');
    const rejectionReason = document.getElementById('rejectionReason');

    if (rejectButton) {

        rejectButton.addEventListener('click', function () {

            Swal.fire({

                title: 'Tolak Permit?',

                text: 'Silakan masukkan alasan penolakan permit.',

                icon: 'warning',

                input: 'textarea',

                inputPlaceholder: 'Tuliskan alasan penolakan...',

                inputAttributes: {
                    'aria-label': 'Alasan penolakan'
                },

                inputValidator: (value) => {

                    if (!value || !value.trim()) {
                        return 'Alasan penolakan wajib diisi.';
                    }

                    if (value.trim().length > 1000) {
                        return 'Alasan penolakan maksimal 1000 karakter.';
                    }

                },

                showCancelButton: true,

                confirmButtonText: 'Ya, Tolak',
                cancelButtonText: 'Batal',

                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',

                reverseButtons: true,

            }).then((result) => {

                if (result.isConfirmed) {

                    rejectionReason.value = result.value.trim();

                    showLoading('Menolak permit...');

                    disableButton(rejectButton);

                    rejectForm.submit();

                }

            });

        });

    }


    /* =========================================================
       CONFIRM RETURN
       ========================================================= */

    const confirmReturnButton =
        document.getElementById('confirmReturnButton');

    const confirmReturnForm =
        document.getElementById('confirmReturnForm');

    if (confirmReturnButton) {

        confirmReturnButton.addEventListener('click', function () {

            Swal.fire({

                title: 'Konfirmasi Kembali ke Kantor?',

                text: 'Sistem akan mencatat waktu saat ini sebagai waktu kepulangan pegawai.',

                icon: 'question',

                showCancelButton: true,

                confirmButtonText: 'Ya, Sudah Kembali',
                cancelButtonText: 'Batal',

                confirmButtonColor: '#329E80',
                cancelButtonColor: '#6b7280',

                reverseButtons: true,

            }).then((result) => {

                if (result.isConfirmed) {

                    showLoading('Mencatat kepulangan...');

                    disableButton(confirmReturnButton);

                    confirmReturnForm.submit();

                }

            });

        });

    }

});
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('approve_success'))

            Swal.fire({
                icon: 'success',
                title: 'Permit Berhasil Disetujui',
                text: @json(session('approve_success')),
                confirmButtonText: 'OK',
                confirmButtonColor: '#22775E',
                timer: 3000,
                timerProgressBar: true,
                allowOutsideClick: false,
                allowEscapeKey: false
            });

        @endif

        @if(session('approve_error'))

            Swal.fire({
                icon: 'error',
                title: 'Permit Gagal Disetujui',
                text: @json(session('approve_error')),
                confirmButtonText: 'OK',
                confirmButtonColor: '#22775E',
                allowOutsideClick: true,
                allowEscapeKey: true
            });

        @endif
        @if(session('reject_success'))

            Swal.fire({
                icon: 'success',
                title: 'Permit Berhasil Ditolak',
                text: @json(session('reject_success')),
                confirmButtonText: 'OK',
                confirmButtonColor: '#22775E',
                timer: 3000,
                timerProgressBar: true,
                allowOutsideClick: false,
                allowEscapeKey: false
            });

        @endif

        @if(session('reject_error'))

            Swal.fire({
                icon: 'error',
                title: 'Permit Gagal Ditolak',
                text: @json(session('reject_error')),
                confirmButtonText: 'OK',
                confirmButtonColor: '#22775E',
                allowOutsideClick: true,
                allowEscapeKey: true
            });

        @endif
        @if(session('return_success'))

            Swal.fire({
                icon: 'success',
                title: 'Kepulangan Berhasil Dikonfirmasi',
                text: @json(session('return_success')),
                confirmButtonText: 'OK',
                confirmButtonColor: '#22775E',
                timer: 3000,
                timerProgressBar: true,
                allowOutsideClick: false,
                allowEscapeKey: false
            });

        @endif

        @if(session('return_error'))

            Swal.fire({
                icon: 'error',
                title: 'Konfirmasi Kepulangan Gagal',
                text: @json(session('return_error')),
                confirmButtonText: 'OK',
                confirmButtonColor: '#22775E',
                allowOutsideClick: true,
                allowEscapeKey: true
            });

        @endif
    });
</script>
@endpush

@endsection