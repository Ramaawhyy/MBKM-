<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Web Pemilihan</title>
  <!-- base:css -->
  <link rel="stylesheet" href="../template/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../template/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../template/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../template/images/favicon.png" />
  <style>
    /* Tambahkan ini di file CSS Anda atau di dalam tag <style> di bagian <head> */
.hidden {
    display: none !important;
    /* Tambahan opsional untuk transisi halus */
    transition: opacity 0.3s ease;
    opacity: 0;
}

  </style>
</head>
<body>
  <div class="container-scroller d-flex">
    <div class="row p-0 m-0 proBanner" id="proBanner">
      <div class="col-md-12 p-0 m-0">
      </div>
    </div>
    <!-- partial:./partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
        <li class="nav-item sidebar-category">
          <!-- Gambar yang akan disembunyikan -->
          <img id="sidebarImage" src="../template/images/download-removebg-preview.png" alt="Image" class="img-fluid right-align">
          <span></span>
        </li>
        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'superadm'|| Auth::user()->role == 'dosen'|| Auth::user()->role == 'user')
  
        <li class="nav-item" {{ request()->routeIs('superadm') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('superadm') }}">
            <i class="mdi mdi-view-quilt menu-icon"></i>
            <span class="menu-title">Dashboard</span>
        </a>
    </li>
    <li class="nav-item {{ request()->routeIs('kaprodi.approve') ? 'active' : '' }}" style="background-color: white;">
        <a class="nav-link1" href="{{ route('kaprodi.approve') }}">
            <i class="mdi mdi-view-quilt menu-icon" style="color: black;"></i>
            <span class="menu-title" style="color: black;">Approval Pengajuan <br>MBKM</span>
        </a>
    </li>
      <li class="nav-item {{ request()->routeIs('historykaprodi') ? 'active' : '' }}" style="background-color: white;">
        <a class="nav-link1" href="{{ route('historykaprodi') }}">
            <i class="mdi mdi-view-quilt menu-icon" style="color: black;"></i>
            <span class="menu-title" style="color: black;">History 
        </a>
    </li>
      
@endif

        
        
      </ul>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:./partials/_navbar.html -->
      <nav class="navbar col-lg-12 col-12 px-0 py-0 py-lg-4 d-flex flex-row">
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu" style="margin-right: 22px;"></span>
          </button>
          <div class="navbar-brand-wrapper">
           
          </div>
          @if(Auth::user()->role == 'user')
          <h4 class="font-weight-bold mb-0 d-none d-md-block mt-1" > Welcome back, Unit Perusahaan</h4>
                @endif
                @if(Auth::user()->role == 'admin')
          <h4 class="font-weight-bold mb-0 d-none d-md-block mt-1" > Welcome back, Management Representative</h4>
                @endif
                @if(Auth::user()->role == 'superadm')
          <h4 class="font-weight-bold mb-0 d-none d-md-block mt-1" > Welcome back, Kaprodi</h4>
                @endif
                @if(Auth::user()->role == 'dosen')
          <h4 class="font-weight-bold mb-0 d-none d-md-block mt-1" > Welcome back, Dosen</h4>
                @endif
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item">
             
            </li>
            <li class="nav-item dropdown me-1">
              <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-bs-toggle="dropdown">
               
                
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                      <img src="images/faces/face4.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content flex-grow">
                    <h6 class="preview-subject ellipsis font-weight-normal">David Grey
                    </h6>
                    <p class="font-weight-light small-text text-muted mb-0">
                      The meeting is cancelled
                    </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                      <img src="images/faces/face2.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content flex-grow">
                    <h6 class="preview-subject ellipsis font-weight-normal">Tim Cook
                    </h6>
                    <p class="font-weight-light small-text text-muted mb-0">
                      New product launch
                    </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                      <img src="images/faces/face3.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content flex-grow">
                    <h6 class="preview-subject ellipsis font-weight-normal"> Johnson
                    </h6>
                    <p class="font-weight-light small-text text-muted mb-0">
                      Upcoming board meeting
                    </p>
                  </div>
                </a>
              </div>
            </li>
            <li class="nav-item dropdown me-2">
              <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
           
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-success">
                      <i class="mdi mdi-information mx-0"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal">Application Error</h6>
                    <p class="font-weight-light small-text mb-0 text-muted">
                      Just now
                    </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-warning">
                      <i class="mdi mdi-settings mx-0"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal">Settings</h6>
                    <p class="font-weight-light small-text mb-0 text-muted">
                      Private message
                    </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-info">
                      <i class="mdi mdi-account-box mx-0"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal">New user registration</h6>
                    <p class="font-weight-light small-text mb-0 text-muted">
                      2 days ago
                    </p>
                  </div>
                </a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                @if(Auth::user()->role == 'user')
                <span class="nav-profile-name">Unit Perusahaan</span>
                @endif
                @if(Auth::user()->role == 'admin')
                <span class="nav-profile-name">Management Representative</span>
                @endif
                @if(Auth::user()->role == 'superadm')
                <span class="nav-profile-name">Kaprodi</span>
                @endif
                @if(Auth::user()->role == 'dosen')
                <span class="nav-profile-name">Dosen</span>
                @endif
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item"  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="mdi mdi-logout text-primary"></i>
                  Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                  @csrf
                </form>
              </div>
        </div>
       
      </nav>
      
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-4 grid-margin">
              <div class="card text-white bg-success" style="background-image: url('{{ asset('img/hijau.png') }}'); border-radius: 20px; height: 80px; background-size: cover; background-position: center;">
                  <div class="card-body" style="display: flex; justify-content: space-between; align-items: center;">
                      <h5 class="card-title" style="margin: 0;">Approval Administrasi</h5>
                      <span class="badge badge-pill bg-dark" style="padding: 10px 15px; font-size: 16px;">{{ $waitingCount }}</span>
                  </div>
              </div>
          </div>
          
        </div>
          <div class="row">
                  <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                      @yield('content')
                      @if(Auth::user()->role == 'superadm')
                      <div class="table-responsive pt-3">
                      
                       
                        
                      </div>
                      
                      
                  <!-- index.blade.php -->
                
        <!-- content-wrapper ends -->
        <!-- partial:./partials/_footer.html -->
       
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  @yield('scripts')
  <!-- container-scroller -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      // Tombol menu
      const menuButton = document.getElementById("menuButton");
      // Gambar yang akan di-hide
      const sidebarImage = document.getElementById("sidebarImage");

      menuButton.addEventListener("click", function () {
        // Tambahkan atau hapus kelas 'hidden'
        sidebarImage.classList.toggle("hidden");
      });
    });
  </script>
  
  <!-- base:js -->
  <script src="../template/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="../template/vendors/chart.js/Chart.min.js"></script>
  <script src="../template/js/jquery.cookie.js" type="text/javascript"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="../template/js/off-canvas.js"></script>
  <script src="../template/js/hoverable-collapse.js"></script>
  <script src="../template/js/template.js"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
    <script src="../template/js/jquery.cookie.js" type="text/javascript"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="../template/js/dashboard.js"></script>
  <!-- End custom js for this page-->
  <!-- Delete icon trigger -->

@else
  <p>No data available</p>
  @endif
</body>

</html>