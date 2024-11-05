<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>eOffice | Biro Sumber Daya Manusia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="eOffice Biro SDM Kementerian Agama" name="description" />
    <meta content="Danunih" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url()?>assets/images/favicon.ico">

    <!-- Layout config Js -->
    <script src="<?= base_url()?>assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="<?= base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= base_url()?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= base_url()?>assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="<?= base_url()?>assets/css/custom.min.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <!-- auth-page wrapper -->
    <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-overlay"></div>
        <!-- auth-page content -->
        <div class="auth-page-content overflow-hidden pt-lg-5">
          <div class="container">

              <div class="row justify-content-center">
                  <div class="col-md-8 col-lg-6 col-xl-5">
                      <div class="card mt-4">

                          <div class="card-body p-4">
                              <div class="text-center mt-2">
                                  <h5 class="text-primary">Login to App</h5>
                                  <p class="text-muted">Login with SSO Kemenag!</p>
                                  <img src="https://themesbrand.com/velzon/html/default/assets/images/bg-d.png" alt="">
                              </div>
                              <div class="p-2 mt-4">
                                  <form>
                                      <div class="mb-2 mt-4">
                                        <a href="<?= site_url('auth')?>" class="btn btn-success w-100">Login</a>
                                      </div>
                                  </form><!-- end form -->

                              </div>
                          </div>
                          <!-- end card body -->
                      </div>

                  </div>
              </div>
              <!-- end row -->
          </div>
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0">&copy;
                                <script>document.write(new Date().getFullYear())</script> eOffice. Crafted with <i class="mdi mdi-heart text-danger"></i> by Biro Kepegawaian
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="<?= base_url()?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url()?>assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?= base_url()?>assets/libs/node-waves/waves.min.js"></script>
    <script src="<?= base_url()?>assets/libs/feather-icons/feather.min.js"></script>
    <script src="<?= base_url()?>assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="<?= base_url()?>assets/js/plugins.js"></script>

    <!-- password-addon init -->
    <script src="<?= base_url()?>assets/js/pages/password-addon.init.js"></script>

    <script type="text/javascript">
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
</body>

</html>
