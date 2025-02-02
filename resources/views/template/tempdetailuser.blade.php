<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Web MBKM</title>
  <!-- base:css -->
  <link rel="stylesheet" href="{{ asset('template/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('template/vendors/css/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('template/css/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('template/images/favicon.png') }}" />
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
          <img id="sidebarImage" src="{{ asset('template/images/download-removebg-preview.png') }}" alt="Image" class="img-fluid right-align">
          <span></span>
        </li>
        <li class="nav-item">
            <a class="nav-link1 {{ request()->routeIs('user') ? 'active' : '' }}" href="{{ route('user') }}" style="color: black;">
                <i class="mdi mdi-view-quilt menu-icon" style="color: black;"></i>
                <span class="menu-title" style="color: black;">Dashboard</span>
            </a>
        </li>
         <li class="nav-item">
            <a class="nav-link">
                <i class="mdi mdi-view-quilt menu-icon" style="color: black" ></i>
                <span class="menu-title" >Pengajuan MBKM</span>
            </a>
            <ul>

    <a class="nav-link {{ request()->routeIs('user.tambahsop') ? 'active' : '' }}" href="{{ route('user.tambahsop') }}" style="background-color: white; text-decoration: none; color: black; border: none;">
        <i class="mdi mdi-view-quilt menu-icon" style="color: black;"></i>
        <span class="menu-title" style="color: black;">Administrasi</span>
    </a>
    <a class="nav-link {{ request()->routeIs('user.matakuliah') ? 'active' : '' }}" href="{{ route('user.matakuliah') }}" style="background-color: white; text-decoration: none; color: black; border: none;">
        <i class="mdi mdi-view-quilt menu-icon" style="color: black;"></i>
        <span class="menu-title" style="color: black;">Mata Kuliah Ekivalensi</span>
    </a>

            </ul>
              <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('user.status') ? 'active' : '' }}"  href="{{ route('user.status') }}" style="background-color: white;">
                <i class="mdi mdi-view-quilt menu-icon" style="color: black;"></i>
                <span class="menu-title" style="color: black;">Status</span>
            </a>
        </li>
      
        </li>
       
        
      
      
      


        
        
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
          <h4 class="font-weight-bold mb-0 d-none d-md-block mt-1" > Welcome back, Mahasiswa</h4>
                @endif
                @if(Auth::user()->role == 'admin')
          <h4 class="font-weight-bold mb-0 d-none d-md-block mt-1" > Welcome back, Management Representative</h4>
                @endif
                @if(Auth::user()->role == 'superadm')
          <h4 class="font-weight-bold mb-0 d-none d-md-block mt-1" > Welcome back, Direktur</h4>
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
            <button class="btn btn-light" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class="mdi mdi-logout text-dark"></i> Logout
</button>

<!-- Hidden Logout Form -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
     </nav>
      
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            @yield('cardatas')
        </div>
          <div class="row">
                  <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                      @yield('content')
                      @if(Auth::user()->role == 'user')
                      <div class="table-responsive pt-3">
                      
                       
                        
                      </div>
          <!-- row end -->
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:./partials/_footer.html -->
       
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
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
  <script src="{{ asset('template/vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="{{ asset('template/vendors/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('template/js/jquery.cookie.js') }}" type="text/javascript"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{ asset('template/js/off-canvas.js') }}"></script>
  <script src="{{ asset('template/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('template/js/template.js') }}"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
    <script src="{{ asset('template/js/jquery.cookie.js') }}" type="text/javascript"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="{{ asset('template/js/dashboard.js') }}"></script>
  <!-- End custom js for this page-->
  <!-- Delete icon trigger -->

@else
  <p>No data available</p>
  @endif
</body>

</html>