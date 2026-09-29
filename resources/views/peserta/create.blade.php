```blade
<!DOCTYPE html>
<html lang="id">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <title>Form Pendaftaran Peserta</title>

     <style>
          * {
               margin: 0;
               padding: 0;
               box-sizing: border-box;
          }

          body {
               font-family: Arial, Helvetica, sans-serif;
               background: #f4f6f9;
               color: #333;
          }

          .container {
               width: 100%;
               min-height: 100vh;
               padding: 40px 20px;
          }

          .form-wrapper {
               max-width: 800px;
               margin: 0 auto;
          }

          .card {
               background: white;
               border-radius: 15px;
               overflow: hidden;
               box-shadow: 0 5px 20px rgba(0, 0, 0, 0.10);
          }

          .card-header {
               background: linear-gradient(135deg, #212529, #343a40);
               color: white;
               padding: 22px 25px;
          }

          .card-header h2 {
               font-size: 22px;
               margin: 0;
          }

          .card-body {
               padding: 30px;
          }

          .form-group {
               margin-bottom: 22px;
          }

          .form-label {
               display: block;
               margin-bottom: 8px;
               font-weight: bold;
               color: #333;
          }

          .form-control,
          .form-select {
               width: 100%;
               padding: 12px 14px;
               border: 1px solid #ced4da;
               border-radius: 8px;
               font-size: 15px;
               outline: none;
               background: white;
               transition: 0.2s;
          }

          .form-control:focus,
          .form-select:focus {
               border-color: #343a40;
               box-shadow: 0 0 0 3px rgba(52, 58, 64, 0.12);
          }

          textarea.form-control {
               resize: vertical;
               min-height: 100px;
          }

          .is-invalid {
               border-color: #dc3545;
          }

          .invalid-feedback {
               display: block;
               margin-top: 6px;
               color: #dc3545;
               font-size: 13px;
          }

          .button-container {
               display: flex;
               justify-content: space-between;
               align-items: center;
               margin-top: 30px;
               gap: 15px;
          }

          .btn {
               display: inline-block;
               padding: 11px 20px;
               border-radius: 8px;
               text-decoration: none;
               border: none;
               cursor: pointer;
               font-size: 14px;
               font-weight: bold;
               transition: 0.2s;
          }

          .btn-secondary {
               background: #6c757d;
               color: white;
          }

          .btn-secondary:hover {
               background: #5a6268;
          }

          .btn-dark {
               background: #212529;
               color: white;
          }

          .btn-dark:hover {
               background: #000;
          }

          @media (max-width: 600px) {
               .container {
                    padding: 20px 15px;
               }

               .card-body {
                    padding: 20px;
               }

               .button-container {
                    flex-direction: column-reverse;
                    align-items: stretch;
               }

               .btn {
                    text-align: center;
                    width: 100%;
               }
          }
     </style>
</head>

<body>

     <div class="container">

          <div class="form-wrapper">

               <div class="card">

                    <div class="card-header">
                         <h2>Form Pendaftaran Peserta</h2>
                    </div>

                    <div class="card-body">

                         <form action="{{ route('peserta.store') }}" method="POST">

                              @csrf

                              <div class="form-group">

                                   <label class="form-label">
                                        Skema Sertifikasi
                                   </label>

                                   <select
                                        name="skema_id"
                                        class="form-select @error('skema_id') is-invalid @enderror"
                                        required>

                                        <option value="">
                                             -- Pilih Skema Sertifikasi --
                                        </option>

                                        @foreach($skemas as $skema)

                                        <option
                                             value="{{ $skema->id }}"
                                             {{ old('skema_id') == $skema->id ? 'selected' : '' }}>
                                             {{ $skema->kode_skema }} - {{ $skema->nama_skema }}
                                        </option>

                                        @endforeach

                                   </select>

                                   @error('skema_id')
                                   <div class="invalid-feedback">
                                        {{ $message }}
                                   </div>
                                   @enderror

                              </div>


                              <div class="form-group">

                                   <label class="form-label">
                                        Nama Lengkap
                                   </label>

                                   <input
                                        type="text"
                                        name="nama_peserta"
                                        class="form-control @error('nama_peserta') is-invalid @enderror"
                                        value="{{ old('nama_peserta') }}"
                                        required>

                                   @error('nama_peserta')
                                   <div class="invalid-feedback">
                                        {{ $message }}
                                   </div>
                                   @enderror

                              </div>


                              <div class="form-group">

                                   <label class="form-label">
                                        Alamat
                                   </label>

                                   <textarea
                                        name="alamat"
                                        class="form-control @error('alamat') is-invalid @enderror"
                                        rows="3"
                                        required>{{ old('alamat') }}</textarea>

                                   @error('alamat')
                                   <div class="invalid-feedback">
                                        {{ $message }}
                                   </div>
                                   @enderror

                              </div>


                              <div class="form-group">

                                   <label class="form-label">
                                        No. Handphone
                                   </label>

                                   <input
                                        type="text"
                                        name="no_hp"
                                        class="form-control @error('no_hp') is-invalid @enderror"
                                        value="{{ old('no_hp') }}"
                                        required>

                                   @error('no_hp')
                                   <div class="invalid-feedback">
                                        {{ $message }}
                                   </div>
                                   @enderror

                              </div>


                              <div class="form-group">

                                   <label class="form-label">
                                        Email
                                   </label>

                                   <input
                                        type="email"
                                        name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}"
                                        required>

                                   @error('email')
                                   <div class="invalid-feedback">
                                        {{ $message }}
                                   </div>
                                   @enderror

                              </div>


                              <div class="button-container">

                                   <a
                                        href="{{ route('peserta.index') }}"
                                        class="btn btn-secondary">
                                        Kembali
                                   </a>

                                   <button
                                        type="submit"
                                        class="btn btn-dark">
                                        Daftarkan Peserta
                                   </button>

                              </div>

                         </form>

                    </div>

               </div>

          </div>

     </div>

</body>

</html>
```