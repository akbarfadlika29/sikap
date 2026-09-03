@extends('layouts.admin')

@section('title', 'Edit Permit')

@section('subtitle', 'Perbarui data draft permit atau izin aktivitas luar pegawai dan pejabat.')

@push('styles')

    <style>
        /* =========================================================
           CREATE PERMIT
           ========================================================= */

        .permit-create {
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

        .permit-form-card {
            background: #ffffff;
            border: 1px solid #eef0f2;
            border-radius: 24px;
            overflow: hidden;
        }

        /* =========================================================
           HEADER
           ========================================================= */

        .permit-form-header {
            padding: 26px 30px;
            background: linear-gradient(
                135deg,
                #f7fbf9 0%,
                #ffffff 100%
            );
            border-bottom: 1px solid #eef0f2;
        }

        .permit-form-header-inner {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .permit-form-icon {
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

        .permit-form-header h3 {
            margin: 0;
            font-size: 19px;
            font-weight: 700;
            color: #1f2937;
        }

        .permit-form-header p {
            margin: 4px 0 0;
            font-size: 13px;
            color: #6b7280;
        }

        /* =========================================================
           FORM BODY
           ========================================================= */

        .permit-form-body {
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
           FORM FIELD
           ========================================================= */

        .permit-field {
            margin-bottom: 20px;
        }

        /* =========================================================
        FORM ROW SPACING
        ========================================================= */

        .permit-form-row {
            --bs-gutter-x: 24px;
            --bs-gutter-y: 24px;
        }

        .permit-field:last-child {
            margin-bottom: 0;
        }

        .permit-label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
        }

        .required {
            color: #dc3545;
        }

        .permit-input,
        .permit-select {
            width: 100%;
            min-height: 46px;
            padding: 10px 13px;
            border: 1px solid #dfe4e8;
            border-radius: 11px;
            background: #ffffff;
            color: #374151;
            font-size: 13px;
            outline: none;
            transition: all .2s ease;
        }

        .permit-input::placeholder {
            color: #a7adb4;
        }

        .permit-input:focus,
        .permit-select:focus {
            border-color: #329E80;
            box-shadow: 0 0 0 3px rgba(50, 158, 128, .10);
        }

        .permit-input[readonly] {
            background: #f7f8f9;
            color: #6b7280;
            cursor: not-allowed;
        }

        textarea.permit-input {
            min-height: 120px;
            resize: vertical;
            line-height: 1.6;
        }

        .permit-help {
            margin-top: 6px;
            font-size: 11px;
            color: #9ca3af;
        }

        /* =========================================================
           INPUT WITH ICON
           ========================================================= */

        .permit-input-wrapper {
            position: relative;
        }

        .permit-input-wrapper .permit-input {
            padding-left: 40px;
        }

        .permit-input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 13px;
            pointer-events: none;
        }

        /* =========================================================
           READONLY WA
           ========================================================= */

        .permit-wa-wrapper {
            position: relative;
        }

        .permit-wa-wrapper .permit-input {
            padding-left: 40px;
            padding-right: 42px;
        }

        .permit-wa-lock {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #adb5bd;
            font-size: 12px;
        }

        /* =========================================================
           ERROR
           ========================================================= */

        .permit-input.is-invalid,
        .permit-select.is-invalid {
            border-color: #dc3545;
        }

        .permit-input.is-invalid:focus,
        .permit-select.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(220, 53, 69, .08);
        }

        .permit-error {
            margin-top: 6px;
            font-size: 11px;
            color: #dc3545;
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
           FILE UPLOAD
           ========================================================= */

        .permit-file-wrapper {
            position: relative;
        }

        .permit-file-input {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            z-index: 2;
        }

        .permit-file-box {
            min-height: 150px;
            border: 1.5px dashed #cfd7d3;
            border-radius: 14px;
            background: #fafcfb;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 25px;
            transition: all .2s ease;
        }

        .permit-file-wrapper:hover .permit-file-box {
            border-color: #329E80;
            background: #f7fbf9;
        }

        .permit-file-content {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .permit-file-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #E4F2EE;
            color: #22775E;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }

        .permit-file-title {
            font-size: 13px;
            font-weight: 700;
            color: #374151;
        }

        .permit-file-description {
            margin-top: 4px;
            font-size: 11px;
            color: #9ca3af;
        }

        .permit-file-name {
            margin-top: 8px;
            font-size: 12px;
            color: #22775E;
            font-weight: 600;
        }

        /* =========================================================
           FOOTER
           ========================================================= */

        .permit-form-footer {
            padding: 18px 30px;
            background: #fafbfb;
            border-top: 1px solid #eef0f2;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .permit-required-info {
            font-size: 11px;
            color: #9ca3af;
        }

        .permit-footer-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .permit-btn-cancel,
        .permit-btn-submit {
            min-height: 42px;
            padding: 9px 18px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all .2s ease;
            cursor: pointer;
        }

        .permit-btn-cancel {
            border: 1px solid #dfe4e8;
            background: #ffffff;
            color: #6b7280;
            text-decoration: none;
        }

        .permit-btn-cancel:hover {
            background: #f5f6f7;
            color: #374151;
        }

        .permit-btn-submit {
            border: 1px solid #22775E;
            background: linear-gradient(
                135deg,
                #36A282,
                #22775E
            );
            color: #ffffff;
            box-shadow: 0 4px 10px rgba(34, 119, 94, .15);
        }

        .permit-btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 14px rgba(34, 119, 94, .20);
        }

        /* =========================================================
           RESPONSIVE
           ========================================================= */

        @media (max-width: 767.98px) {

            .permit-form-header,
            .permit-form-body {
                padding: 20px;
            }

            .permit-form-footer {
                padding: 16px 20px;
                flex-direction: column;
                align-items: stretch;
            }

            .permit-required-info {
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
        PERMIT FORM LOADING OVERLAY
        ========================================================= */

        #permitLoading {
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

        #permitLoading.active {
            display: flex;
        }

        .permit-spinner {
            width: 55px;
            height: 55px;
            border: 5px solid rgba(50, 158, 128, 0.25);
            border-top-color: #329E80;
            border-radius: 50%;
            animation: permitSpin 0.8s linear infinite;
        }

        @keyframes permitSpin {
            to {
                transform: rotate(360deg);
            }
        }

        .permit-user-row {
            --bs-gutter-x: 24px;
        }
    </style>

@endpush


@section('content')

{{-- =========================================================
     PERMIT LOADING OVERLAY
     ========================================================= --}}

<div id="permitLoading" aria-hidden="true">

    <div class="flex flex-col items-center gap-4">

        <div class="permit-spinner"></div>

        <p class="text-sm font-semibold text-[#1D6751]">
            Menyimpan perubahan...
        </p>

    </div>

</div>


<div class="permit-create">

    {{-- =========================================================
         BREADCRUMB
         ========================================================= --}}
    <div class="permit-breadcrumb">

        <a href="{{ route('permit.index') }}">
            Permit
        </a>

        <i class="fa-solid fa-chevron-right"></i>

        <span>
            Edit Permit
        </span>

    </div>


    {{-- =========================================================
         MAIN FORM CARD
         ========================================================= --}}
    <div class="permit-form-card">

        {{-- =====================================================
             HEADER
             ===================================================== --}}
        <div class="permit-form-header">

            <div class="permit-form-header-inner">

                <div class="permit-form-icon">
                    <i class="fa-solid fa-file-pen"></i>
                </div>

                <div>

                    <h3>
                        Edit Permit
                    </h3>

                    <p>
                        Perbarui informasi aktivitas luar pegawai.
                    </p>

                </div>

            </div>

        </div>


        {{-- =====================================================
             FORM
             ===================================================== --}}
        <form
            id="permitForm"
            action="{{ route('permit.update', $permit->id) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')


            <div class="permit-form-body">

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
                                Pilih pegawai yang melakukan aktivitas luar.
                            </p>
                        </div>

                    </div>


                    <div class="row permit-form-row permit-user-row">

                        {{-- Nama & NIP --}}
                        <div class="col-md-6">

                            <div class="permit-field">

                                <label
                                    for="id_user"
                                    class="permit-label"
                                >
                                    Nama & NIP
                                    <span class="required">*</span>
                                </label>

                                <select
                                    name="id_user"
                                    id="id_user"
                                    class="permit-select @error('id_user') is-invalid @enderror"
                                    required
                                >

                                    <option value="">
                                        Pilih nama / NIP pegawai
                                    </option>

                                    @foreach($users as $user)

                                        <option
                                            value="{{ $user->id }}"
                                            {{ old('id_user', $permit->id_user) == $user->id ? 'selected' : '' }}
                                        >
                                            {{ $user->nama }} — {{ $user->nip }}
                                        </option>

                                    @endforeach

                                </select>

                                <div class="permit-help">
                                    Pilih berdasarkan nama atau NIP pegawai.
                                </div>

                                @error('id_user')
                                    <div class="permit-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>


                        {{-- No. WA --}}
                        <div class="col-md-6">

                            <div class="permit-field">

                                <label
                                    for="no_wa"
                                    class="permit-label"
                                >
                                    No. WhatsApp
                                </label>

                                <div class="permit-wa-wrapper">

                                    <i class="fa-brands fa-whatsapp permit-input-icon"></i>

                                    <input
                                        type="text"
                                        id="no_wa"
                                        class="permit-input"
                                        value=""
                                        placeholder="Otomatis mengikuti pegawai"
                                        readonly
                                    >

                                    <i class="fa-solid fa-lock permit-wa-lock"></i>

                                </div>

                                <div class="permit-help">
                                    Nomor WhatsApp diambil otomatis dari data pegawai.
                                </div>

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


                    {{-- Jenis Aktivitas --}}
                    <div class="permit-field">

                        <label
                            for="id_jenis_aktivitas_luar"
                            class="permit-label"
                        >
                            Jenis Aktivitas Luar
                            <span class="required">*</span>
                        </label>

                        <select
                            name="id_jenis_aktivitas_luar"
                            id="id_jenis_aktivitas_luar"
                            class="permit-select @error('id_jenis_aktivitas_luar') is-invalid @enderror"
                            required
                        >

                            <option value="">
                                Pilih jenis aktivitas luar
                            </option>

                            @foreach($jenisAktivitasLuar as $jenis)

                                <option
                                    value="{{ $jenis->id }}"
                                    {{ old('id_jenis_aktivitas_luar', $permit->id_jenis_aktivitas_luar) == $jenis->id ? 'selected' : '' }}
                                >
                                    {{ $jenis->nama_jenis_aktivitas_luar }}
                                </option>

                            @endforeach

                        </select>

                        @error('id_jenis_aktivitas_luar')
                            <div class="permit-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Deskripsi --}}
                    <div class="permit-field">

                        <label
                            for="deskripsi_aktivitas_luar"
                            class="permit-label"
                        >
                            Deskripsi Aktivitas Luar
                            <span class="required">*</span>
                        </label>

                        <textarea
                            name="deskripsi_aktivitas_luar"
                            id="deskripsi_aktivitas_luar"
                            class="permit-input @error('deskripsi_aktivitas_luar') is-invalid @enderror"
                            placeholder="Jelaskan aktivitas luar yang akan dilakukan..."
                            required
                        >{{ old('deskripsi_aktivitas_luar', $permit->deskripsi_aktivitas_luar) }}</textarea>

                        <div class="permit-help">
                            Jelaskan aktivitas secara singkat, jelas, dan informatif.
                        </div>

                        @error('deskripsi_aktivitas_luar')
                            <div class="permit-error">
                                {{ $message }}
                            </div>
                        @enderror

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
                                Tentukan waktu keberangkatan dan estimasi kembali.
                            </p>
                        </div>

                    </div>


                    <div class="row permit-form-row">

                        {{-- Tanggal Keluar --}}
                        <div class="col-md-6">

                            <div class="permit-field">

                                <label
                                    for="tanggal_keluar"
                                    class="permit-label"
                                >
                                    Tanggal Keluar
                                    <span class="required">*</span>
                                </label>

                                <div class="permit-input-wrapper">

                                    <i class="fa-regular fa-calendar permit-input-icon"></i>

                                    <input
                                        type="date"
                                        name="tanggal_keluar"
                                        id="tanggal_keluar"
                                        class="permit-input @error('tanggal_keluar') is-invalid @enderror"
                                        value="{{ old('tanggal_keluar', $permit->tanggal_keluar?->format('Y-m-d')) }}"
                                        required
                                    >

                                </div>

                                @error('tanggal_keluar')
                                    <div class="permit-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>


                        {{-- Waktu Keluar --}}
                        <div class="col-md-6">

                            <div class="permit-field">

                                <label
                                    for="waktu_keluar"
                                    class="permit-label"
                                >
                                    Waktu Keluar
                                    <span class="required">*</span>
                                </label>

                                <div class="permit-input-wrapper">

                                    <i class="fa-regular fa-clock permit-input-icon"></i>

                                    <input
                                        type="time"
                                        name="waktu_keluar"
                                        id="waktu_keluar"
                                        class="permit-input @error('waktu_keluar') is-invalid @enderror"
                                        value="{{ old('waktu_keluar', \Carbon\Carbon::parse($permit->waktu_keluar)->format('H:i')) }}"
                                        required
                                    >

                                </div>

                                @error('waktu_keluar')
                                    <div class="permit-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>


                        {{-- Tanggal Estimasi Kembali --}}
                        <div class="col-md-6">

                            <div class="permit-field">

                                <label
                                    for="tanggal_estimasi_kembali"
                                    class="permit-label"
                                >
                                    Tanggal Estimasi Kembali
                                    <span class="required">*</span>
                                </label>

                                <div class="permit-input-wrapper">

                                    <i class="fa-regular fa-calendar-check permit-input-icon"></i>

                                    <input
                                        type="date"
                                        name="tanggal_estimasi_kembali"
                                        id="tanggal_estimasi_kembali"
                                        class="permit-input @error('tanggal_estimasi_kembali') is-invalid @enderror"
                                        value="{{ old('tanggal_estimasi_kembali', $permit->tanggal_estimasi_kembali?->format('Y-m-d')) }}"
                                        required
                                    >

                                </div>

                                @error('tanggal_estimasi_kembali')
                                    <div class="permit-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>


                        {{-- Waktu Estimasi Kembali --}}
                        <div class="col-md-6">

                            <div class="permit-field">

                                <label
                                    for="waktu_estimasi_kembali"
                                    class="permit-label"
                                >
                                    Waktu Estimasi Kembali
                                    <span class="required">*</span>
                                </label>

                                <div class="permit-input-wrapper">

                                    <i class="fa-regular fa-clock permit-input-icon"></i>

                                    <input
                                        type="time"
                                        name="waktu_estimasi_kembali"
                                        id="waktu_estimasi_kembali"
                                        class="permit-input @error('waktu_estimasi_kembali') is-invalid @enderror"
                                        value="{{ old('waktu_estimasi_kembali', \Carbon\Carbon::parse($permit->waktu_estimasi_kembali)->format('H:i')) }}"
                                        required
                                    >

                                </div>

                                @error('waktu_estimasi_kembali')
                                    <div class="permit-error">
                                        {{ $message }}
                                    </div>
                                @enderror

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
                                Lampirkan dokumen yang berkaitan dengan aktivitas.
                            </p>
                        </div>

                    </div>


                    <div class="permit-field">

                        <label class="permit-label">
                            Dokumen Pendukung
                        </label>

                        <div class="permit-file-wrapper">

                            <input
                                type="file"
                                name="dokumen_pendukung"
                                id="dokumen_pendukung"
                                class="permit-file-input"
                                accept=".pdf,.jpg,.jpeg,.png"
                            >

                            <div class="permit-file-box">

                                <div class="permit-file-content">

                                    <div class="permit-file-icon">
                                        <i class="fa-solid fa-cloud-arrow-up"></i>
                                    </div>

                                    <div class="permit-file-title">
                                        Klik untuk memilih dokumen
                                    </div>

                                    <div class="permit-file-description">
                                        PDF, JPG, JPEG, atau PNG • Maksimal 2 MB
                                    </div>

                                    <div
                                        id="fileName"
                                        class="permit-file-name"
                                    ></div>

                                    @if($permit->dokumen_pendukung)

                                        <div class="mt-3 text-center">

                                            <p class="text-xs text-gray-500 mb-2">
                                                Dokumen saat ini:
                                            </p>

                                            <a
                                                href="{{ asset('storage/' . $permit->dokumen_pendukung) }}"
                                                target="_blank"
                                                class="inline-flex items-center gap-2
                                                    text-xs font-semibold
                                                    text-[#22775E]
                                                    hover:text-[#1A634E]"
                                            >

                                                <i class="fa-solid fa-file-lines"></i>

                                                Lihat dokumen saat ini

                                            </a>

                                            <p class="text-[11px] text-gray-400 mt-1">
                                                Upload file baru jika ingin mengganti dokumen.
                                            </p>

                                        </div>

                                    @endif

                                </div>

                            </div>

                        </div>

                        @error('dokumen_pendukung')
                            <div class="permit-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 FOOTER
                 ===================================================== --}}
            <div class="permit-form-footer">

                <div class="permit-required-info">
                    <span class="required">*</span>
                    Field wajib diisi
                </div>

                <div class="permit-footer-actions">

                    <a
                        href="{{ route('permit.index') }}"
                        class="permit-btn-cancel"
                    >
                        <i class="fa-solid fa-arrow-left"></i>
                        Batal
                    </a>

                    <button
                        type="submit"
                        id="permitSubmitButton"
                        class="permit-btn-submit"
                    >
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Simpan Perubahan</span>
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection


@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const permitUsers = @json($users->keyBy('id'));
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        /*
        |--------------------------------------------------------------------------
        | ELEMENT
        |--------------------------------------------------------------------------
        */

        const permitForm =
            document.getElementById('permitForm');

        const permitLoading =
            document.getElementById('permitLoading');

        const permitSubmitButton =
            document.getElementById('permitSubmitButton');


        /*
        |--------------------------------------------------------------------------
        | NAMA/NIP → NO. WHATSAPP
        |--------------------------------------------------------------------------
        */

        const userSelect =
            document.getElementById('id_user');

        const noWaInput =
            document.getElementById('no_wa');


        function updateNoWa() {

            const userId = userSelect.value;

            if (!userId) {

                noWaInput.value = '';

                return;
            }

            const user = permitUsers[userId];

            if (user && user.no_wa) {

                noWaInput.value = user.no_wa;

            } else {

                noWaInput.value = 'Belum tersedia';

            }

        }

        userSelect.addEventListener(
            'change',
            updateNoWa
        );

        // Jalankan saat halaman pertama kali dibuka.
        // Berguna ketika Laravel mengembalikan old('id_user').
        updateNoWa();


        /*
        |--------------------------------------------------------------------------
        | FILE UPLOAD PREVIEW
        |--------------------------------------------------------------------------
        */

        const fileInput =
            document.getElementById('dokumen_pendukung');

        const fileName =
            document.getElementById('fileName');


        fileInput.addEventListener('change', function () {

            if (this.files.length > 0) {

                fileName.textContent =
                    this.files[0].name;

            } else {

                fileName.textContent = '';

            }

        });


        /*
        |--------------------------------------------------------------------------
        | VALIDASI TANGGAL
        |--------------------------------------------------------------------------
        */

        const tanggalKeluar =
            document.getElementById('tanggal_keluar');

        const tanggalEstimasiKembali =
            document.getElementById(
                'tanggal_estimasi_kembali'
            );


        function updateMinimumReturnDate() {

            tanggalEstimasiKembali.min =
                tanggalKeluar.value;

        }


        tanggalKeluar.addEventListener(
            'change',
            updateMinimumReturnDate
        );

        // Jalankan juga ketika halaman pertama kali dibuka.
        updateMinimumReturnDate();


        /*
        |--------------------------------------------------------------------------
        | VALIDASI WAKTU
        |--------------------------------------------------------------------------
        */

        const waktuKeluar =
            document.getElementById('waktu_keluar');

        const waktuEstimasiKembali =
            document.getElementById(
                'waktu_estimasi_kembali'
            );


        function validateEstimatedReturn() {

            if (
                tanggalKeluar.value &&
                tanggalEstimasiKembali.value &&
                waktuKeluar.value &&
                waktuEstimasiKembali.value
            ) {

                const start = new Date(
                    tanggalKeluar.value +
                    'T' +
                    waktuKeluar.value
                );

                const end = new Date(
                    tanggalEstimasiKembali.value +
                    'T' +
                    waktuEstimasiKembali.value
                );


                if (end <= start) {

                    waktuEstimasiKembali.setCustomValidity(
                        'Estimasi kembali harus setelah waktu keluar.'
                    );

                } else {

                    waktuEstimasiKembali.setCustomValidity('');

                }

            } else {

                waktuEstimasiKembali.setCustomValidity('');

            }

        }


        tanggalKeluar.addEventListener(
            'change',
            validateEstimatedReturn
        );

        tanggalEstimasiKembali.addEventListener(
            'change',
            validateEstimatedReturn
        );

        waktuKeluar.addEventListener(
            'change',
            validateEstimatedReturn
        );

        waktuEstimasiKembali.addEventListener(
            'change',
            validateEstimatedReturn
        );


        /*
        |--------------------------------------------------------------------------
        | SUBMIT FORM
        |--------------------------------------------------------------------------
        */

        permitForm.addEventListener(
            'submit',
            function (event) {

                /*
                |--------------------------------------------------------------
                | HTML5 VALIDATION
                |--------------------------------------------------------------
                */

                if (!permitForm.checkValidity()) {

                    event.preventDefault();

                    permitForm.reportValidity();

                    return;

                }


                /*
                |--------------------------------------------------------------
                | TAMPILKAN LOADING
                |--------------------------------------------------------------
                */

                permitLoading.classList.add('active');


                /*
                |--------------------------------------------------------------
                | DISABLE SUBMIT BUTTON
                |--------------------------------------------------------------
                */

                permitSubmitButton.disabled = true;

                permitSubmitButton.classList.add(
                    'opacity-75',
                    'cursor-not-allowed'
                );


                /*
                |--------------------------------------------------------------
                | Ubah teks tombol
                |--------------------------------------------------------------
                */

                permitSubmitButton.innerHTML = `
                    <i class="fa-solid fa-spinner fa-spin"></i>
                    <span>Menyimpan perubahan...</span>
                `;

            }
        );

    });
</script>

@endpush
