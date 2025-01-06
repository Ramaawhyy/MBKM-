<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
      body {
        font-family: 'Roboto', sans-serif;
        background-color: #f5f5f5;
      }

      .content {
        display: flex;
        min-height: 100vh;
      }

      .left-section {
        background-size: cover;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        flex: 1;
        flex-direction: column;
        text-align: center;
      }

      .left-section img {
        border-radius: 50%;
        margin: 20px 0;
        width: 130px;
        height: 150px;
        object-fit: cover;
      }

      .right-section {
        flex: 1;
        background: rgb(255, 255, 255);
        padding: 40px;
      }

      .header {
        text-align: center;
        margin-bottom: 20px;
      }

      .header img {
        width: 140px;
        margin-right: 10px;
      }

      .nav-tabs {
        justify-content: center;
        margin-bottom: 30px;
        border-bottom: none;
      }

      .nav-tabs .nav-item {
        margin: 0 13px;
      }

      .nav-tabs .nav-link {
  color: #ffffff;
  font-weight: bold;
  border: none;
  background-color: #CD4A4A;
  border-radius: 10px;
  display: inline-block;
  text-align: center;
  min-width: 150px; /* Tentukan lebar minimum yang sama untuk semua tab */
  padding: 10px; /* Berikan ruang di sekitar teks dan ikon */
}


.nav-tabs .nav-link {
  color: #ffffff;
  font-weight: bold;
  border: none;
  background-color: #CD4A4A;
  border-radius: 10px;
  display: inline-block;
  text-align: center;
  min-width: 150px; /* Tentukan lebar minimum yang sama untuk semua tab */
  padding: 10px; /* Ruang di sekitar teks dan ikon */
  transition: background-color 0.3s ease, color 0.3s ease; /* Efek transisi */
}

.nav-tabs .nav-link.active {
  background-color: #B11116;
  color: white !important;
  border-radius: 10px;
  min-width: 150px; /* Pastikan ukuran active sama */
  padding: 10px; /* Konsistensi ruang */
}

      .card {
        background-color: #CD4A4A;
        max-width: 500px; /* Atur lebar maksimum */
        margin: 0 auto;
      }
      .card-body {
        margin: 20px; /* Tambahkan margin untuk card body */
      }



      .form-control {
        border-radius: 5px;
      }

      .btn-primary {
        background-color: #ffffff;
        border: none;
        color: #FF2020;
      }

      .btn-primary:hover {
        background-color: #B11116;
      }

      .form-control {
    max-width: 500px; /* Atur lebar maksimum */
    height: 45px; /* Atur tinggi elemen input */
    margin: 0 auto; /* Pusatkan elemen input */
    padding: 10px; /* Tambahkan padding untuk kenyamanan pengguna */
    font-size: 14px; /* Sesuaikan ukuran font */
    border-radius: 5px; /* Tambahkan sudut melengkung jika diperlukan */
    backdrop-filter: blur(10px);
    opacity: 70%; /* Tambahkan efek radial glass */
    }

      .remember-me {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
      }

      .fade-in {
        animation: fadeIn 0.5s;
      }

      .fade-out {
        animation: fadeOut 0.5s;
      }

      @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
      }

      @keyframes fadeOut {
        from { opacity: 1; }
        to { opacity: 0; }
      }


    </style>

    <title>Login Sistem Informasi MBKM</title>
  </head>
  <body>
    <div class="content" style="background-image: url('{{ asset('img/background.png') }}'); background-size: 50%;">

      <div class="left-section">
        <h1 style="font-weight: bold; margin-bottom: 100px;">Selamat Datang di<br>Sistem Informasi MBKM Tel-U</h1>
       
      </div>

      <div class="right-section">
        <div class="header">
          <img src="{{ asset('img/image 1.png') }}" alt="Telkom University" style=" margin-left: 30px;">
          <img src="{{ asset('img/image 4.png') }}" alt="Fakultas Rekayasa Industri" style="width: 300px; margin-left: 50px;">
          <h2 style="font-weight: 600; color: #D94444;">Login Sistem Informasi MBKM</h2>
        </div>
                <div class="card">
          <div class="card-body">
            <form action="{{ route('register') }}" method="POST">
              @csrf
              <div class="form-group">
    <label for="name" style="color: white;">Name</label>
    <input type="text" class="form-control" value="{{ old('name') }}" name="name" required>
</div>
              <div class="form-group">
                <label for="email" style="color: white;">Email</label>
                <input type="email" class="form-control" value="{{ old('email') }}" name="email">
              </div>
              <div class="form-group">
                <label for="password" style="color: white;">Password</label>
                <input type="password" class="form-control" id="password" name="password">
              </div>
              <div class="form-group">
                <label for="nim" style="color: white;">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim">
              </div>
              <button type="submit" class="btn btn-primary btn-block">Register</button>
            </form>
          </div>
        </div>
      </div>
    </div>

      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      $(document).ready(function() {
        $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
          const target = $($(e.target).attr('href'));
          target.removeClass('fade-out').addClass('fade-in');
        });

        $('a[data-toggle="tab"]').on('hide.bs.tab', function(e) {
          const target = $($(e.target).attr('href'));
          target.removeClass('fade-in').addClass('fade-out');
        });
      });
    </script>
  </body>
</html>
