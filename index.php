<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Lotus Fertility</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <link rel="stylesheet" href="dist/output.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/lotus_logo.png" />
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="images/lotus_logo.png" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
       
        <ul class="navbar-nav navbar-nav-right">
          
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="images/faces/face28.jpg" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="index.php?logout='1'">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
          
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      
      <!-- partial:partials/_sidebar.html -->
      
      <?php include 'partials/sidebar.php' ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Welcome Admin</h3>
                </div>
                <div class="col-12 col-xl-4">
                 <div class="justify-content-end d-flex">
                  <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                  </div>
                 </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Grid layout for content -->
          <div class="row">
           <!-- New Surrogates Card -->
            <div class="col-md-4 mb-4 stretch-card transparent">
              <div class="card card-tale">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-4">New Surrogates</p>
                    <?php
                    include 'include/connections.php'; 
                    $sql = "SELECT COUNT(*) AS total_surrogates FROM clients WHERE user='Surrogate Mother' AND status='Pending approval'";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $total_surrogates = $row['total_surrogates'];
                    ?>
                    <span class="badge badge-pill badge-warning fs-14 text-center">
                      <?php echo $total_surrogates; ?>
                    </span>
                  </div>
                  <a href="newsurrogates.php"><p class="fs-30 mb-2">View</p></a>
                </div>
              </div>
            </div>

            <!-- Intended Parents Card -->
            <div class="col-md-4 mb-4 stretch-card transparent">
              <div class="card card-dark-blue">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-4">New Intended Parent's</p>
                    <?php
                    include 'include/connections.php'; 
                    $sql = "SELECT COUNT(*) AS intended_parents FROM clients WHERE user='Intended Parents' AND status = 'Pending approval'";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $total_surrogates = $row['intended_parents'];
                    ?>
                    <span class="badge badge-pill badge-warning fs-14 text-center">
                      <?php echo $total_surrogates; ?>
                    </span>
                  </div>
                  <a href="newparents.php"><p class="fs-30 mb-2">View</p></a>
                </div>
              </div>
            </div>


            <!-- Intended Parents Card -->
            <div class="col-md-4 mb-4 stretch-card transparent">
              <div class="card card-tale">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-4">All Employees</p>
                    <?php
                    include 'include/connections.php'; 
                    $sql = "SELECT COUNT(*) AS staff FROM employees";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $total_surrogates = $row['staff'];
                    ?>
                    <span class="badge badge-pill badge-warning fs-14 text-center">
                      <?php echo $total_surrogates; ?>
                    </span>
                  </div>
                  <a href="allstaff.php"><p class="fs-30 mb-2">View</p></a>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 mb-4 stretch-card transparent">
              <div class="card card-light-blue">
                <div class="card-body">
                  <p class="mb-4">Schedules</p>
                  <a href="completedservices.php"><p class="fs-30 mb-2">View</p></a>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-4 stretch-card transparent">
              <div class="card card-light-danger">
                <div class="card-body">
                  <p class="mb-4">Payment Records</p>
                  <a href="approvedpayments.php"><p class="fs-30 mb-2">View</p></a>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-4 stretch-card transparent">
              <div class="card card-light-blue">
                <div class="card-body">
                  <p class="mb-4">All Suppliers</p>
                  <a href="suppliers.php"><p class="fs-30 mb-2">View</p></a>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- content-wrapper ends -->
        
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright ©2024 Lotusfertility. All rights reserved</span>
          </div>
        </footer> 
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="js/dataTables.select.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <script src="js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->
</body>

</html>
