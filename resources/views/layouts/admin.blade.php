<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin - SIKPA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Poppins', 'sans-serif'], },
                    colors: {
                        'kemenag-dark': '#1A634E',
                        'kemenag-mint': '#7DD3BA',
                        'kemenag-text': '#1D6751'
                    }
                }
            }
        }
    </script>

    @stack('styles')
    <style>
        /* =========================================================
        LOGOUT LOADING OVERLAY
        ========================================================= */

        #logoutLoading {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 99999;
            background: rgba(255, 255, 255, 0.55);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            align-items: center;
            justify-content: center;
        }

        #logoutLoading.active {
            display: flex;
        }

        .logout-spinner {
            width: 55px;
            height: 55px;
            border: 5px solid rgba(50, 158, 128, 0.25);
            border-top-color: #329E80;
            border-radius: 50%;
            animation: logoutSpin 0.8s linear infinite;
        }

        @keyframes logoutSpin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const logoutForm =
                document.getElementById('logoutForm');

            const logoutButton =
                document.getElementById('logoutButton');

            const logoutLoading =
                document.getElementById('logoutLoading');


            if (!logoutForm || !logoutButton || !logoutLoading) {
                return;
            }


            logoutForm.addEventListener('submit', function () {

                /*
                |----------------------------------------------------------
                | TAMPILKAN LOADING
                |----------------------------------------------------------
                */

                logoutLoading.classList.add('active');


                /*
                |----------------------------------------------------------
                | DISABLE BUTTON
                |----------------------------------------------------------
                */

                logoutButton.disabled = true;

                logoutButton.classList.add(
                    'opacity-75',
                    'cursor-not-allowed'
                );


                /*
                |----------------------------------------------------------
                | UBAH TEKS BUTTON
                |----------------------------------------------------------
                */

                logoutButton.innerHTML = `
                    <i class="fa-solid fa-spinner fa-spin"></i>
                    <span>Keluar...</span>
                `;

            });

        });
    </script>
</head>

<body class="bg-[#E4F2EE] font-sans antialiased flex h-screen overflow-hidden text-gray-800">

    <aside class="w-1/4 max-w-[300px] bg-gradient-to-b from-[#1C6851] to-[#124B3A] h-full flex flex-col justify-between shadow-2xl relative z-20 overflow-y-auto [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
        <div>
            <div class="px-8 py-10 flex items-center gap-4">
                <div class="bg-white p-2 rounded-2xl shadow-lg">
                    <img src="{{ asset('images/logo-kemenag.png') }}" alt="Logo Kemenag" class="w-12 h-12 object-contain">
                </div>
                <div>
                    <h1 class="text-2xl font-black text-white leading-none tracking-wide">SIKPA</h1>
                    <p class="text-[10px] font-bold text-white/80 mt-1 tracking-widest">KEMENTERIAN AGAMA KABUPATEN TUBAN</p>
                </div>
            </div>

            <nav class="mt-4 flex flex-col gap-2 px-6 pb-4">
                @php
                    $activeClass = 'bg-green-700 text-white font-semibold shadow';
                    $inactiveClass = 'text-green-100 hover:bg-green-700 hover:text-white';
                @endphp
                @if(in_array(auth()->user()->role, ['superadmin','admin','kepala_kantor','kepala_seksi','staff']))
                    <a href="{{ route('permit.index') }}"
                        :class="sidebarOpen ? 'justify-start' : 'justify-center'"
                        class="flex items-center gap-4 text-white/90 px-6 py-4 rounded-xl font-semibold transition-all
                        {{ request()->routeIs('permit.*') ? $activeClass : $inactiveClass }}">
                        
                        <i class="fa-solid fa-file-pen w-6 text-xl"></i> Permit
                    </a>
                @endif
                @if(in_array(auth()->user()->role, ['superadmin','admin']))
                    <a href="{{ route('approval.index') }}"
                        :class="sidebarOpen ? 'justify-start' : 'justify-center'"
                        class="flex items-center gap-4 text-white/90 px-6 py-4 rounded-xl font-semibold transition-all
                        {{ request()->routeIs('approval.*') ? $activeClass : $inactiveClass }}">

                        <i class="fa-solid fa-circle-check w-6 text-xl"></i> Approval
                    </a>
                @endif
            </nav>
        </div>

        <div class="px-6 pb-10">
            <div class="bg-[#155441] rounded-2xl p-4 flex items-center gap-4 mb-4 border border-[#1d6b53]">
                <div class="w-12 h-12 bg-gradient-to-br from-[#1C6851] to-[#0f3d2f] rounded-xl flex items-center justify-center text-white font-black text-lg shadow-inner">
                    {{ strtoupper(substr(auth()->user()->nama, 0, 2)) }}
                </div>
                <div>
                    <p class="text-white font-bold text-sm leading-tight">{{ auth()->user()->nama }}</p>
                    <p class="text-white/60 text-xs font-medium mt-0.5">NIP: {{ auth()->user()->nip }}</p>
                </div>
            </div>
            <form
                id="logoutForm"
                action="{{ url('/logout') }}"
                method="POST"
            >
                @csrf

                <button
                    type="submit"
                    id="logoutButton"
                    class="w-full bg-gradient-to-r from-[#36A282] to-[#22775E] hover:from-[#2c876b] hover:to-[#1a5e4a] transition-all text-white px-6 py-3.5 rounded-xl font-bold shadow-lg flex items-center justify-center gap-3"
                >
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 p-10 lg:p-14 overflow-y-auto relative z-10">
        
        <div class="mb-10">
            <h2 class="text-[2.5rem] font-black text-[#1A634E] leading-tight mb-1">
                @yield('title')
            </h2>
            @hasSection('subtitle')
                <p class="text-sm text-gray-500 mt-1">
                    @yield('subtitle')
                </p>
            @endif
            <p class="text-[#268A6B] text-lg font-bold tracking-[0.15em] uppercase">SELAMAT DATANG {{ auth()->user()->nama }}</p>
        </div>

        <div class="bg-white rounded-[2.5rem] p-10 border border-white shadow-[0_20px_50px_-15px_rgba(26,99,78,0.15)]">
            @yield('content')
        </div>
    </main>

    @if(session('success'))
    <script>
        Swal.fire({
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'Oke',
            confirmButtonColor: '#329E80',
            background: '#F4F7F6',
            customClass: { title: 'text-[#1A634E] font-bold font-sans', popup: 'rounded-3xl', confirmButton: 'rounded-xl px-8 font-bold' }
        });
    </script>
    @endif

    <div id="logoutLoading" aria-hidden="true">

        <div class="flex flex-col items-center gap-4">

            <div class="logout-spinner"></div>

            <p class="text-sm font-semibold text-[#1D6751]">
                Keluar dari sistem...
            </p>

        </div>

    </div>

    @stack('scripts')
    
    @if(session('logout_error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal Keluar',
            text: @json(session('logout_error')),
            confirmButtonText: 'Coba Lagi',
            confirmButtonColor: '#22775E',
            allowOutsideClick: true,
            allowEscapeKey: true
        });
    </script>
    @endif
</body>

</html>