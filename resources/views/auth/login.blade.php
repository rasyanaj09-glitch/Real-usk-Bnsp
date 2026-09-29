<!doctype html>
<html lang="id">

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Login - Portal Sertifikasi Siswa</title>

     <style>
          :root {
               --primary-color: #212529;
               --primary-hover: #343a40;
               --danger-color: #dc3545;
               --bg-gradient: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
               --card-bg: rgba(255, 255, 255, 0.95);
               --text-main: #1e293b;
               --text-muted: #64748b;
               --border-color: #e2e8f0;
               --focus-ring: rgba(33, 37, 41, 0.15);
          }

          * {
               box-sizing: border-box;
               margin: 0;
               padding: 0;
               font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, sans-serif;
          }

          body {
               background: var(--bg-gradient);
               min-height: 100vh;
               display: flex;
               align-items: center;
               justify-content: center;
               padding: 20px;
               overflow-x: hidden;
          }

          .login-container {
               background: var(--card-bg);
               width: 100%;
               max-width: 440px;
               padding: 40px;
               border-radius: 20px;
               box-shadow:
                    0 20px 40px rgba(0, 0, 0, 0.3),
                    0 0 0 1px rgba(255, 255, 255, 0.1);
               backdrop-filter: blur(10px);
               animation: fadeInCard 0.6s cubic-bezier(0.16, 1, 0.3, 1);
          }

          @keyframes fadeInCard {
               from {
                    opacity: 0;
                    transform: translateY(20px);
               }

               to {
                    opacity: 1;
                    transform: translateY(0);
               }
          }

          .brand-wrapper {
               display: flex;
               align-items: center;
               gap: 8px;
               margin-bottom: 24px;
               color: var(--primary-color);
               font-weight: 700;
               font-size: 18px;
               letter-spacing: -0.5px;
          }

          .brand-logo {
               background: var(--primary-color);
               color: #ffffff;
               width: 28px;
               height: 28px;
               border-radius: 6px;
               display: flex;
               align-items: center;
               justify-content: center;
               font-size: 14px;
          }

          .login-header h1 {
               color: var(--text-main);
               font-size: 28px;
               font-weight: 700;
               letter-spacing: -0.5px;
               margin-bottom: 8px;
          }

          .login-header p {
               color: var(--text-muted);
               font-size: 14px;
               line-height: 1.5;
               margin-bottom: 32px;
          }

          .form-group {
               margin-bottom: 20px;
               position: relative;
          }

          .form-label {
               display: block;
               color: var(--text-main);
               font-size: 13px;
               font-weight: 600;
               margin-bottom: 8px;
               text-transform: uppercase;
               letter-spacing: 0.5px;
          }

          .input-wrapper {
               position: relative;
               display: flex;
               align-items: center;
          }

          .form-input {
               width: 100%;
               padding: 14px 48px 14px 16px;
               font-size: 15px;
               color: var(--text-main);
               background: #ffffff;
               border: 1.5px solid var(--border-color);
               border-radius: 10px;
               outline: none;
               transition: all 0.25s ease;
          }

          .form-input::placeholder {
               color: #cbd5e1;
          }

          .form-input:focus {
               border-color: var(--primary-color);
               box-shadow: 0 0 0 4px var(--focus-ring);
          }

          .password-toggle {
               position: absolute;
               right: 10px;
               top: 50%;
               transform: translateY(-50%);
               background: none;
               border: none;
               color: var(--text-muted);
               cursor: pointer;
               display: flex;
               align-items: center;
               justify-content: center;
               padding: 6px;
               border-radius: 6px;
               transition: color 0.2s, background 0.2s;
          }

          .password-toggle:hover {
               color: var(--primary-color);
               background: #f1f5f9;
          }

          .password-toggle:focus {
               outline: 2px solid var(--primary-color);
               outline-offset: 2px;
          }

          .alert-container {
               background-color: rgba(220, 53, 69, 0.08);
               border-left: 4px solid var(--danger-color);
               padding: 14px 16px;
               border-radius: 8px;
               margin-bottom: 24px;
               animation: shakeAlert 0.4s ease-in-out;
          }

          @keyframes shakeAlert {

               0%,
               100% {
                    transform: translateX(0);
               }

               25% {
                    transform: translateX(-4px);
               }

               75% {
                    transform: translateX(4px);
               }
          }

          .alert-item {
               color: var(--danger-color);
               font-size: 13.5px;
               font-weight: 500;
               display: flex;
               align-items: center;
               gap: 8px;
          }

          .alert-item+.alert-item {
               margin-top: 8px;
          }

          .form-input.is-invalid {
               border-color: var(--danger-color);
          }

          .form-input.is-invalid:focus {
               box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.15);
          }

          .btn-submit {
               width: 100%;
               padding: 14px;
               background: var(--primary-color);
               color: #ffffff;
               border: none;
               border-radius: 10px;
               font-size: 15px;
               font-weight: 600;
               cursor: pointer;
               transition: all 0.2s ease;
               margin-top: 12px;
               box-shadow: 0 4px 12px rgba(33, 37, 41, 0.15);
          }

          .btn-submit:hover {
               background: var(--primary-hover);
               transform: translateY(-1px);
               box-shadow: 0 6px 16px rgba(33, 37, 41, 0.25);
          }

          .btn-submit:active {
               transform: translateY(0);
          }

          .login-footer {
               text-align: center;
               margin-top: 28px;
               font-size: 14px;
               color: var(--text-muted);
          }

          .login-link {
               color: var(--primary-color);
               text-decoration: none;
               font-weight: 600;
               transition: color 0.2s;
          }

          .login-link:hover {
               color: var(--primary-hover);
               text-decoration: underline;
          }

          @media (max-width: 480px) {
               body {
                    padding: 15px;
               }

               .login-container {
                    padding: 28px 22px;
                    border-radius: 16px;
               }

               .login-header h1 {
                    font-size: 24px;
               }

               .password-toggle {
                    position: absolute;
                    right: 10px;
                    background: none;
                    border: none;
                    cursor: pointer;
                    font-size: 18px;
               }

          }
     </style>
</head>

<body>

     <div class="login-container">

          <!-- Brand -->
          <div class="brand-wrapper">
               <div class="brand-logo" aria-hidden="true">✓</div>
               <span>PORTAL SERTIFIKASI</span>
          </div>

          <!-- Header -->
          <div class="login-header">
               <h1>Selamat Datang.</h1>
               <p>
                    Silakan masuk menggunakan akun email dan password Anda
                    untuk mengakses sistem data siswa.
               </p>
          </div>

          <!-- Login Form -->
          <form action="{{ route('login') }}" method="POST" autocomplete="off">
               @csrf

               <!-- Error -->
               @if ($errors->any())
               <div class="alert-container" role="alert">
                    @foreach ($errors->all() as $error)
                    <div class="alert-item">
                         <svg
                              xmlns="http://www.w3.org/2000/svg"
                              width="16"
                              height="16"
                              fill="currentColor"
                              viewBox="0 0 16 16"
                              aria-hidden="true">
                              <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                         </svg>

                         <span>{{ $error }}</span>
                    </div>
                    @endforeach
               </div>
               @endif

               <!-- Email -->
               <div class="form-group">
                    <label class="form-label" for="email">
                         Alamat Email
                    </label>

                    <div class="input-wrapper">
                         <input
                              class="form-input @error('email') is-invalid @enderror"
                              id="email"
                              name="email"
                              type="email"
                              placeholder="nama@sekolah.sch.id"
                              value="{{ old('email') }}"
                              autocomplete="email"
                              required
                              autofocus>
                    </div>
               </div>

               <!-- Password -->
               <div class="form-group">
                    <label class="form-label" for="password">Kata Sandi</label>

                    <div class="input-wrapper">
                         <input
                              class="form-input"
                              id="password"
                              name="password"
                              type="password"
                              placeholder="Masukkan password"
                              required>

                         <button
                              type="button"
                              class="password-toggle"
                              id="passwordToggle">
                              👁️
                         </button>
                    </div>
               </div>


               <!-- Submit -->
               <button type="submit" class="btn-submit">
                    Masuk Ke Aplikasi
               </button>

          </form>

          <!-- Footer -->
          <div class="login-footer">
               Belum memiliki hak akses?
               <a href="#" class="login-link">
                    Hubungi Admin
               </a>
          </div>

     </div>
     <script>
          const password = document.getElementById("password");
          const tombol = document.getElementById("passwordToggle");

          tombol.addEventListener("click", function() {

               if (password.type === "password") {
                    password.type = "text";
               } else {
                    password.type = "password";
               }

          });
     </script>



</body>

</html>