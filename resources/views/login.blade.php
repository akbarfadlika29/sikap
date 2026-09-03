<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIKPA Kemenag Tuban</title>
    
    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- FontAwesome Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Tailwind CSS (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        'kemenag-dark': '#1A634E',
                        'kemenag-mint': '#7DD3BA',
                        'kemenag-text': '#1D6751',
                    },
                    boxShadow: {
                        'figma-box': '0 20px 60px -15px rgba(26, 99, 78, 0.2)',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background-color: #F4F7F6;
        }

        /* =========================================================
        LOGIN LOADING OVERLAY
        ========================================================= */

        #loginLoading {
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

        #loginLoading.active {
            display: flex;
        }

        .login-spinner {
            width: 55px;
            height: 55px;
            border: 5px solid rgba(50, 158, 128, 0.25);
            border-top-color: #329E80;
            border-radius: 50%;
            animation: loginSpin 0.8s linear infinite;
        }

        @keyframes loginSpin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-800 min-h-screen flex flex-col relative overflow-x-hidden">

    <!-- =========================================================
         LOGIN LOADING OVERLAY
         ========================================================= -->

    <div id="loginLoading" aria-hidden="true">
        <div class="flex flex-col items-center gap-4">
            <div class="login-spinner"></div>

            <p class="text-sm font-semibold text-[#1D6751]">
                Memverifikasi akun...
            </p>
        </div>
    </div>

    <!-- Ornamen Background Belakang -->
    <div class="absolute top-0 left-0 w-full h-96 bg-gradient-to-b from-[#22755B] to-[#185945] z-0 rounded-b-[4rem] shadow-lg"></div>

    <!-- Tombol Kembali ke Beranda -->
    <div class="relative z-20 container mx-auto px-6 pt-8">
        <a href="/" class="inline-flex items-center gap-2 text-white/90 hover:text-white font-medium transition-colors">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda
        </a>
    </div>

    <!-- Container Form Login -->
    <div class="flex-1 flex items-center justify-center relative z-20 px-6 mt-10 mb-20">
        <div class="bg-white rounded-[2.5rem] shadow-figma-box p-10 md:p-14 w-full max-w-md border border-gray-100">
            
            <!-- Logo & Judul -->
            <div class="flex flex-col items-center text-center mb-10">
                <img src="{{ asset('images/logo-kemenag.png') }}" alt="Logo Kemenag" class="w-20 h-20 mb-4 object-contain">
                <h1 class="text-[1.8rem] font-black text-kemenag-dark leading-tight tracking-wide">SIKPA</h1>
                <p class="text-[10px] font-bold text-kemenag-dark mt-1 tracking-widest">KEMENTERIAN AGAMA KABUPATEN TUBAN</p>
                <div class="h-1 w-12 bg-[#329E80] rounded-full mt-5"></div>
                <h2 class="text-xl font-bold text-gray-700 mt-4">Login Sikpa</h2>
                <p class="text-sm text-gray-500 mt-1">Silakan masuk menggunakan NIP Anda.</p>
            </div>

            <!-- Error login ditampilkan menggunakan SweetAlert2 -->

            <!-- Form -->
            <form id="loginForm" action="{{ url('/login') }}" method="POST" class="space-y-6" novalidate>
                @csrf <!-- Token wajib keamanan Laravel -->
                
                <!-- Input NIP -->
                <div>
                    <label for="nip" class="block text-sm font-bold text-[#1D6751] mb-2">Nomor Induk Pegawai (NIP)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-id-card text-gray-400"></i>
                        </div>
                        <input type="text" id="nip" name="nip" required autocomplete="off"
                            value="{{ old('nip') }}"
                            class="w-full pl-11 pr-4 py-3.5 bg-[#F4F7F6] border border-gray-200 rounded-2xl text-gray-700 font-medium focus:outline-none focus:ring-2 focus:ring-[#329E80] focus:border-transparent transition-all placeholder-gray-400"
                            placeholder="Masukkan NIP">
                    </div>
                </div>

                <!-- Input Password -->
                <div>
                    <label for="password" class="block text-sm font-bold text-[#1D6751] mb-2">Kata Sandi</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" id="password" name="password" required
                            class="w-full pl-11 pr-4 py-3.5 bg-[#F4F7F6] border border-gray-200 rounded-2xl text-gray-700 font-medium focus:outline-none focus:ring-2 focus:ring-[#329E80] focus:border-transparent transition-all placeholder-gray-400"
                            placeholder="••••••••">
                    </div>
                </div>

                <!-- Lupa Password & Submit -->
                <div class="pt-2">
                    <button type="submit" 
                        class="w-full bg-gradient-to-r from-[#36A282] to-[#22775E] hover:from-[#2c876b] hover:to-[#1a5e4a] hover:scale-[1.02] transition-all duration-300 text-white py-4 rounded-2xl font-bold shadow-lg tracking-wide text-[15px]">
                        Masuk Sistem <i class="fa-solid fa-right-to-bracket ml-2"></i>
                    </button>
                </div>
            </form>

        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const loginForm = document.getElementById('loginForm');
        const loginLoading = document.getElementById('loginLoading');

        if (!loginForm) {
            return;
        }

        loginForm.addEventListener('submit', function (event) {

            const nip = document.getElementById('nip');
            const password = document.getElementById('password');

            // =====================================================
            // VALIDASI FIELD KOSONG
            // =====================================================

            if (!nip.value.trim()) {
                event.preventDefault();

                Swal.fire({
                    icon: 'warning',
                    title: 'NIP Belum Diisi',
                    text: 'Silakan masukkan NIP Anda terlebih dahulu.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#22775E',
                    timer: 4000,
                    timerProgressBar: true
                });

                nip.focus();

                return;
            }

            if (!password.value) {
                event.preventDefault();

                Swal.fire({
                    icon: 'warning',
                    title: 'Password Belum Diisi',
                    text: 'Silakan masukkan password Anda terlebih dahulu.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#22775E',
                    timer: 4000,
                    timerProgressBar: true
                });

                password.focus();

                return;
            }

            // =====================================================
            // TAMPILKAN LOADING
            // =====================================================

            loginLoading.classList.add('active');

            // Cegah user melakukan klik submit berulang kali
            const submitButton = loginForm.querySelector(
                'button[type="submit"]'
            );

            if (submitButton) {
                submitButton.disabled = true;
                submitButton.classList.add(
                    'opacity-75',
                    'cursor-not-allowed'
                );
            }
        });

    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        @if(session('login_error'))
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: @json(session('login_error')),
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

</body>
</html>