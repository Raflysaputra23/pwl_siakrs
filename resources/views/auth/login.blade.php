@extends('layouts.app')

@section('content')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .login-page {
            width: 100%;
            min-height: 100vh;
            height: auto;
            padding: 28px 20px;
            background: #f8fafc;
            font-family: 'Poppins', sans-serif;
            color: #111827;
            overflow: visible;
        }

        .login-page .login-container {
            width: 100%;
            max-width: 672px;
            min-height: 0;
            height: auto;
            margin: 0 auto;
            padding: 44px 42px 32px;
            background: #ffffff;
            border: 1px solid #e0e5eb;
            border-radius: 36px;
            box-shadow: 0 15px 35px rgba(15, 23, 42, 0.04);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-bottom: 49px;
        }

        .brand-icon {
            width: 60px;
            height: 60px;
            min-width: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #2864e8;
            color: #ffffff;
            border-radius: 23px;
            box-shadow: 0 4px 8px rgba(37, 99, 235, 0.18);
        }

        .brand-icon svg {
            width: 30px;
            height: 30px;
        }

        .brand-name {
            font-size: 27px;
            font-weight: 800;
            line-height: 1.4;
            letter-spacing: -0.8px;
        }

        .brand-name span {
            color: #2864e8;
        }

        .brand-description {
            font-size: 18px;
            color: #718096;
            margin-top: 1px;
        }

        .sso-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 7px 17px;
            background: #eff6ff;
            border: 1px solid #d4e5ff;
            border-radius: 30px;
            color: #2864d9;
            font-size: 17px;
            font-weight: 500;
            margin-bottom: 17px;
        }

        .sso-badge svg {
            width: 21px;
            height: 21px;
        }

        .welcome-title {
            font-size: 34px;
            font-weight: 800;
            line-height: 1.35;
            letter-spacing: -1.1px;
            margin-bottom: 10px;
        }

        .welcome-description {
            font-size: 20px;
            line-height: 1.55;
            color: #718096;
            margin-bottom: 47px;
        }

        .demo-box {
            padding: 17px 18px 18px;
            background: #f3f6f9;
            border: 1px solid #e0e6ed;
            border-radius: 24px;
            margin-bottom: 35px;
        }

        .demo-title {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #64748b;
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 13px;
        }

        .demo-title svg {
            width: 21px;
            height: 21px;
            color: #2864e8;
        }

        .demo-buttons {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .demo-button {
            height: 45px;
            padding: 0 8px;
            border: 1px solid #e0e6ed;
            border-radius: 19px;
            background: #ffffff;
            color: #111827;
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            box-shadow: 0 2px 3px rgba(15, 23, 42, 0.04);
            transition: 0.2s;
        }

        .demo-button:hover {
            border-color: #2864e8;
            background: #eff6ff;
            color: #2864e8;
        }

        .form-group {
            margin-bottom: 27px;
        }

        .label-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 11px;
        }

        .form-label {
            display: block;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: #111827;
        }

        .forgot-password {
            color: #2864d9;
            font-size: 16px;
            font-weight: 500;
            text-decoration: none;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .input-wrapper {
            height: 76px;
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 0 24px;
            border: 2px solid #e0e6ed;
            border-radius: 24px;
            background: #ffffff;
            transition: border-color 0.2s;
        }

        .input-wrapper:focus-within {
            border-color: #2864e8;
        }

        .input-icon {
            width: 25px;
            height: 25px;
            min-width: 25px;
            color: #718096;
        }

        .input-wrapper input {
            width: 100%;
            min-width: 0;
            height: 100%;
            border: none;
            outline: none;
            background: transparent;
            font-family: 'Poppins', sans-serif;
            font-size: 20px;
            font-weight: 400;
            color: #1f2937;
        }

        .password-toggle {
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            background: transparent;
            color: #718096;
            cursor: pointer;
        }

        .password-toggle svg {
            width: 27px;
            height: 27px;
        }

        .remember-row {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-top: 32px;
            color: #718096;
            font-size: 17px;
        }

        .remember-row input {
            appearance: none;
            width: 24px;
            height: 24px;
            border: 2px solid #cbd5e1;
            border-radius: 3px;
            cursor: pointer;
            position: relative;
        }

        .remember-row input:checked {
            background: #2864e8;
            border-color: #2864e8;
        }

        .remember-row input:checked::after {
            content: '';
            position: absolute;
            left: 6px;
            top: 1px;
            width: 7px;
            height: 13px;
            border: solid white;
            border-width: 0 3px 3px 0;
            transform: rotate(45deg);
        }

        .login-button {
            width: 100%;
            height: 58px;
            margin-top: 28px;
            border: none;
            border-radius: 16px;
            background: #2864e8;
            color: #ffffff;
            font-family: 'Poppins', sans-serif;
            font-size: 17px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .login-button:hover {
            background: #1d4ed8;
        }

        .footer-text {
            margin-top: 24px;
            text-align: center;
            color: #94a3b8;
            font-size: 13px;
        }

        @media (max-width: 600px) {
            .login-page {
                padding: 12px;
                min-height: 100vh;
            }

            .login-page .login-container {
                min-height: 0;
                height: auto;
                padding: 28px 22px;
                border-radius: 25px;
            }

            .brand {
                gap: 13px;
                margin-bottom: 38px;
            }

            .brand-icon {
                width: 52px;
                height: 52px;
                min-width: 52px;
                border-radius: 18px;
            }

            .brand-name {
                font-size: 23px;
            }

            .brand-description {
                font-size: 14px;
            }

            .welcome-title {
                font-size: 27px;
            }

            .welcome-description {
                font-size: 16px;
                margin-bottom: 30px;
            }

            .sso-badge {
                font-size: 14px;
            }

            .demo-box {
                padding: 14px 12px;
            }

            .demo-buttons {
                gap: 7px;
            }

            .demo-button {
                font-size: 11px;
                padding: 0 4px;
            }

            .input-wrapper {
                height: 64px;
                gap: 13px;
                padding: 0 17px;
                border-radius: 19px;
            }

            .input-wrapper input {
                font-size: 17px;
            }

            .form-label,
            .forgot-password {
                font-size: 13px;
            }

            .remember-row {
                font-size: 14px;
            }
        }

        /* Tata letak ringkas agar login muat dalam satu layar laptop */
        @media (min-width: 601px) and (min-height: 650px) {
            .login-page {
                min-height: 100vh;
                height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 12px 20px;
                overflow: hidden;
            }

            .login-page .login-container {
                max-width: 630px;
                padding: 24px 36px 18px;
            }

            .brand { margin-bottom: 22px; gap: 14px; }
            .brand-icon { width: 48px; height: 48px; min-width: 48px; border-radius: 16px; }
            .brand-icon svg { width: 25px; height: 25px; }
            .brand-name { font-size: 23px; }
            .brand-description { font-size: 14px; }
            .sso-badge { font-size: 13px; padding: 5px 12px; margin-bottom: 10px; gap: 7px; }
            .sso-badge svg { width: 17px; height: 17px; }
            .welcome-title { font-size: 27px; margin-bottom: 5px; }
            .welcome-description { font-size: 15px; line-height: 1.45; margin-bottom: 18px; }
            .demo-box { padding: 11px 14px 12px; border-radius: 18px; margin-bottom: 18px; }
            .demo-title { font-size: 12px; margin-bottom: 8px; gap: 7px; }
            .demo-title svg { width: 17px; height: 17px; }
            .demo-buttons { gap: 9px; }
            .demo-button { height: 36px; border-radius: 13px; font-size: 12px; }
            .form-group { margin-bottom: 15px; }
            .label-row { margin-bottom: 6px; }
            .form-label, .forgot-password { font-size: 12px; }
            .input-wrapper { height: 52px; gap: 13px; padding: 0 16px; border-radius: 16px; }
            .input-icon { width: 21px; height: 21px; min-width: 21px; }
            .input-wrapper input { font-size: 15px; }
            .password-toggle svg { width: 22px; height: 22px; }
            .remember-row { margin-top: 12px; gap: 10px; font-size: 13px; }
            .remember-row input { width: 19px; height: 19px; }
            .login-button { height: 46px; margin-top: 15px; font-size: 14px; border-radius: 13px; }
            .footer-text { margin-top: 12px; font-size: 11px; }
        }

        @media (min-width: 601px) and (max-height: 720px) {
            .login-page { padding-top: 6px; padding-bottom: 6px; }
            .login-page .login-container { padding-top: 16px; padding-bottom: 12px; }
            .brand { margin-bottom: 14px; }
            .welcome-description { margin-bottom: 12px; }
            .demo-box { margin-bottom: 12px; }
            .form-group { margin-bottom: 10px; }
            .remember-row { margin-top: 8px; }
            .login-button { margin-top: 10px; }
            .footer-text { margin-top: 8px; }
        }
    </style>


    <div class="login-page">
    <main class="login-container">

        <header class="brand">
            <div class="brand-icon">
                <svg viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 9l10-5 10 5-10 5L2 9z"></path>
                    <path d="M6 11v5c3.5 3 8.5 3 12 0v-5"></path>
                    <path d="M22 9v6"></path>
                </svg>
            </div>

            <div>
                <div class="brand-name">SIAKAD<span>KRS</span></div>
                <div class="brand-description">Portal Akademik Terpadu</div>
            </div>
        </header>

        <section class="welcome-section">

            <div class="sso-badge">
                <svg viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11z"></path>
                    <path d="m9 12 2 2 4-4"></path>
                </svg>
                <span>Single Sign-On Akademik</span>
            </div>

            <h1 class="welcome-title">Selamat Datang Kembali!</h1>

            <p class="welcome-description">
                Silakan masuk menggunakan akun <strong>NIM / NIP / Username</strong>
                Anda untuk mengakses layanan KRS.
            </p>

        </section>

        <section class="demo-box">

            <div class="demo-title">
                <svg viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.8"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path d="m12 3 1.9 5.8L20 11l-6.1 2.2L12 19l-1.9-5.8L4 11l6.1-2.2L12 3z"></path>
                    <path d="m19 14 1.2 2.8L23 18l-2.8 1.2L19 22l-1.2-2.8L15 18l2.8-1.2L19 14z"></path>
                </svg>
                <span>Isi Cepat Akun Demo:</span>
            </div>

            <div class="demo-buttons">
                <button type="button" class="demo-button"
                        onclick="isiAkun('admin')">
                    Admin SIAKAD
                </button>

                <button type="button" class="demo-button"
                        onclick="isiAkun('mahasiswa')">
                    Mahasiswa
                </button>

                <button type="button" class="demo-button"
                        onclick="isiAkun('dosen')">
                    Dosen PA
                </button>
            </div>

        </section>

        <form onsubmit="return false;">

            <div class="form-group">
                <div class="label-row">
                    <label for="username" class="form-label">
                        USERNAME / NIM / NIP
                    </label>
                </div>

                <div class="input-wrapper">
                    <svg class="input-icon" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>

                    <input type="text" id="username"
                           placeholder="Masukkan NIM / NIP / Username">
                </div>
            </div>

            <div class="form-group">
                <div class="label-row">
                    <label for="password" class="form-label">
                        KATA SANDI
                    </label>

                    <a href="#" class="forgot-password"
                       onclick="alert('Fitur lupa kata sandi belum tersedia.'); return false;">
                        Lupa Kata Sandi?
                    </a>
                </div>

                <div class="input-wrapper">
                    <svg class="input-icon" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>

                    <input type="password" id="password"
                           placeholder="Masukkan kata sandi">

                    <button type="button" class="password-toggle"
                            onclick="togglePassword()" aria-label="Tampilkan kata sandi">
                        <svg id="eyeIcon" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </button>
                </div>
            </div>

            <label class="remember-row">
                <input type="checkbox" checked>
                <span>Ingat sesi perangkat ini</span>
            </label>

            <button type="button" class="login-button"
                    onclick="alert('Backend login belum dihubungkan.')">
                Masuk ke Sistem
            </button>

            <p class="footer-text">
                SIAKADKRS &copy; 2026 — Portal Akademik Terpadu
            </p>

        </form>

    </main>
    </div>

<script>
    function isiAkun(role) {
        const akun = {
            admin: { username: 'admin', password: 'admin123' },
            mahasiswa: { username: '2417051045', password: 'mahasiswa123' },
            dosen: { username: 'dosen', password: 'dosen123' }
        };
        document.getElementById('username').value = akun[role].username;
        document.getElementById('password').value = akun[role].password;
    }

    function togglePassword() {
        const input = document.getElementById('password');
        input.type = input.type === 'password' ? 'text' : 'password';
    }
</script>

@endsection