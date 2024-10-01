<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-compact layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="<?= base_url()?>assets/" data-template="vertical-menu-template" data-style="light">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <title>HRMS - Kementerian Agama RI</title>


    <meta name="description" content="eOffice Biro Kepegawaian Kementerian Agama RI">
    <meta name="keywords" content="eoffice, aset, manajemen aset, Biro Kepegawaian, Kementerian Agama RI">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url()?>assets/img/favicon/favicon.ico">

    <!-- Icons -->
    <link rel="stylesheet" href="<?= base_url()?>assets/vendor/fonts/fontawesome.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/vendor/fonts/tabler-icons.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/vendor/fonts/flag-icons.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/vendor/libs/select2/select2.css">

    <link rel="stylesheet" href="<?= base_url()?>assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css">
    <!-- Core CSS -->

    <link rel="stylesheet" href="<?= base_url()?>assets/vendor/css/rtl/core.css" class="template-customizer-core-css">
    <link rel="stylesheet" href="<?= base_url()?>assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css">

    <link rel="stylesheet" href="<?= base_url()?>assets/css/demo.css">

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?= base_url()?>assets/vendor/libs/node-waves/node-waves.css">

    <link rel="stylesheet" href="<?= base_url()?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/vendor/libs/typeahead-js/typeahead.css">


    <!-- Page CSS -->


    <!-- Helpers -->
    <script src="<?= base_url()?>assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?= base_url()?>assets/js/config.js"></script>

    <?= $this->renderSection('style') ?>

  </head>

  <body>
<div class="layout-wrapper layout-content-navbar  ">
  <div class="layout-container">

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">


  <div class="app-brand demo ">
    <a href="index.html" class="app-brand-link">
      <span class="app-brand-logo demo">
        <img src="<?= base_url()?>assets/img/simpeg.png" alt="">
</span>
      <span class="app-brand-text demo menu-text fw-bold">HRMS</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
      <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>



  <ul class="menu-inner py-1">
    <!-- Dashboards -->
    <li class="menu-item active">
      <a href="<?= site_url('surat/dashboard')?>" class="menu-link">
        <i class="menu-icon tf-icons ti ti-smart-home"></i>
        <div data-i18n="Dashboard">Dashboard</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="<?= site_url('surat/surat_masuk')?>" class="menu-link">
        <i class="menu-icon tf-icons ti ti-smart-home"></i>
        <div data-i18n="Surat Masuk">Surat Masuk</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="<?= site_url('surat/agenda_keluar')?>" class="menu-link">
        <i class="menu-icon tf-icons ti ti-smart-home"></i>
        <div data-i18n="Agenda Keluar">Agenda Keluar</div>
      </a>
    </li>


    <!-- Components -->
    <li class="menu-header small">
      <span class="menu-header-text" data-i18n="Aset">Aset</span>
    </li>
    <!-- Cards -->
    <li class="menu-item">
      <a href="<?= site_url('dashboard')?>" class="menu-link">
        <i class="menu-icon tf-icons ti ti-lifebuoy"></i>
        <div data-i18n="Dashboard">Dashboard</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="<?= site_url('aset/kategori')?>" class="menu-link">
        <i class="menu-icon tf-icons ti ti-lifebuoy"></i>
        <div data-i18n="Kategori">Kategori</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="<?= site_url('aset/data')?>" class="menu-link">
        <i class="menu-icon tf-icons ti ti-lifebuoy"></i>
        <div data-i18n="Data Aset">Data Aset</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="<?= site_url('aset/distribusi')?>" class="menu-link">
        <i class="menu-icon tf-icons ti ti-lifebuoy"></i>
        <div data-i18n="Distribusi Aset">Distribusi Aset</div>
      </a>
    </li>

    <!-- Misc -->
    <li class="menu-header small">
      <span class="menu-header-text" data-i18n="Administrasi">Administrasi</span>
    </li>
    <li class="menu-item">
      <a href="<?= site_url('users')?>" class="menu-link">
        <i class="menu-icon tf-icons ti ti-file-description"></i>
        <div data-i18n="Pengguna">Pengguna</div>
      </a>
    </li>
  </ul>



</aside>
<!-- / Menu -->



    <!-- Layout container -->
    <div class="layout-page">

<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
      <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0   d-xl-none ">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
          <i class="ti ti-menu-2 ti-md"></i>
        </a>
      </div>


      <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">


        <!-- Search -->
        <div class="navbar-nav align-items-center">
          xxx
        </div>
        <!-- /Search -->





        <ul class="navbar-nav flex-row align-items-center ms-auto">
          <li class="nav-item dropdown-style-switcher dropdown">
            <a class="nav-link btn btn-text-secondary btn-icon rounded-pill dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
              <i class='ti ti-md'></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
              <li>
                <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                  <span class="align-middle"><i class='ti ti-sun ti-md me-3'></i>Light</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                  <span class="align-middle"><i class="ti ti-moon-stars ti-md me-3"></i>Dark</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                  <span class="align-middle"><i class="ti ti-device-desktop-analytics ti-md me-3"></i>System</span>
                </a>
              </li>
            </ul>
          </li>
          <!-- / Style Switcher-->

          <!-- User -->
          <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
              <div class="avatar avatar-online">
                <img src="<?= base_url()?>assets/img/avatars/1.png" alt="" class="rounded-circle">
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item mt-0" href="pages-account-settings-account.html">
                  <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 me-2">
                      <div class="avatar avatar-online">
                        <img src="<?= base_url()?>assets/img/avatars/1.png" alt="" class="rounded-circle">
                      </div>
                    </div>
                    <div class="flex-grow-1">
                      <h6 class="mb-0">John Doe</h6>
                      <small class="text-muted">Admin</small>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <div class="dropdown-divider my-1 mx-n2"></div>
              </li>
              <li>
                <a class="dropdown-item" href="pages-profile-user.html">
                  <i class="ti ti-user me-3 ti-md"></i><span class="align-middle">My Profile</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="pages-account-settings-account.html">
                  <i class="ti ti-settings me-3 ti-md"></i><span class="align-middle">Settings</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="pages-account-settings-billing.html">
                  <span class="d-flex align-items-center align-middle">
                    <i class="flex-shrink-0 ti ti-file-dollar me-3 ti-md"></i><span class="flex-grow-1 align-middle">Billing</span>
                    <span class="flex-shrink-0 badge bg-danger d-flex align-items-center justify-content-center">4</span>
                  </span>
                </a>
              </li>
              <li>
                <div class="dropdown-divider my-1 mx-n2"></div>
              </li>
              <li>
                <a class="dropdown-item" href="pages-pricing.html">
                  <i class="ti ti-currency-dollar me-3 ti-md"></i><span class="align-middle">Pricing</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="pages-faq.html">
                  <i class="ti ti-question-mark me-3 ti-md"></i><span class="align-middle">FAQ</span>
                </a>
              </li>
              <li>
                <div class="d-grid px-2 pt-2 pb-1">
                  <a class="btn btn-sm btn-danger d-flex" href="auth-login-cover.html" target="_blank">
                    <small class="align-middle">Logout</small>
                    <i class="ti ti-logout ms-2 ti-14px"></i>
                  </a>
                </div>
              </li>
            </ul>
          </li>
          <!--/ User -->



        </ul>
      </div>


      <!-- Search Small Screens -->
      <div class="navbar-search-wrapper search-input-wrapper  d-none">
        <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..." aria-label="Search...">
        <i class="ti ti-x search-toggler cursor-pointer"></i>
      </div>



</nav>

<!-- / Navbar -->



      <!-- Content wrapper -->
      <div class="content-wrapper">

        <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <?= $this->renderSection('content') ?>
          </div>
          <!-- / Content -->




<!-- Footer -->
<footer class="content-footer footer bg-footer-theme">
  <div class="container-xxl">
    <div class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
      <div class="text-body">
        © <script>
        document.write(new Date().getFullYear())

        </script>, made with ❤️ by <a href="https://pixinvent.com" target="_blank" class="footer-link">Pixinvent</a>
      </div>
      <div class="d-none d-lg-inline-block">

        <a href="https://themeforest.net/licenses/standard" class="footer-link me-4" target="_blank">License</a>
        <a href="https://1.envato.market/pixinvent_portfolio" target="_blank" class="footer-link me-4">More Themes</a>

        <a href="https://demos.pixinvent.com/vuexy-html-admin-template/documentation/" target="_blank" class="footer-link me-4">Documentation</a>


        <a href="https://pixinvent.ticksy.com/" target="_blank" class="footer-link d-none d-sm-inline-block">Support</a>

      </div>
    </div>
  </div>
</footer>
<!-- / Footer -->


          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    <div class="layout-overlay layout-menu-toggle"></div>
    <div class="drag-target"></div>

  </div>

    <script src="<?= base_url()?>assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?= base_url()?>assets/vendor/libs/popper/popper.js"></script>
    <script src="<?= base_url()?>assets/vendor/js/bootstrap.js"></script>
    <script src="<?= base_url()?>assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="<?= base_url()?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?= base_url()?>assets/vendor/libs/hammer/hammer.js"></script>
    <script src="<?= base_url()?>assets/vendor/libs/i18n/i18n.js"></script>
    <script src="<?= base_url()?>assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="<?= base_url()?>assets/vendor/js/menu.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="<?= base_url()?>assets/vendor/libs/select2/select2.js"></script>
    <script src="<?= base_url()?>assets/vendor/libs/datatables/dataTables.js"></script>
    <script src="<?= base_url()?>assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>

    <script src="<?= base_url()?>assets/js/main.js"></script>

    <script type="text/javascript">
    $(document).ready(function() {
      $(".select2").select2()
    });

    $('.datatable').dataTable();

    function alert($text) {
        Toastify({
        text: $text,
        duration: 5000,
        newWindow: true,
        close: true,
        gravity: "top", // `top` or `bottom`
        position: "center", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
            background: "linear-gradient(to right, #00b09b, #96c93d)",
        },
        onClick: function(){} // Callback after click
        }).showToast();
    }

    <?php
    if(session()->getFlashdata('message')){
        ?>
        alert("<?= session()->getFlashdata('message')?>");
        <?php
    }
    ?>
    </script>

    <?= $this->renderSection('script') ?>

  </body>

</html>
