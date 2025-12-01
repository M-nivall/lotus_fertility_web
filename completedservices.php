<?php
session_start();
//error_reporting(E_ERROR);
include('include/connections.php');

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
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/lotus_logo.png" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php include 'partials/navbar.php' ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
     
      <!-- partial:../../partials/_sidebar.html -->
      <?php include 'partials/sidebar.php' ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Completed Schedule </h4>
                 
                  <div class="">
                    <table id="zero_config" class="table  table-bordered">
                     <thead>
        <tr>

            
            <th>#</th>
            <th>Intende Parent</th>
            <th> Surrogate</th>
            <th> Fee</th>
            <th> Payment Code</th>
            <th> Attorney</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $select="SELECT s.schedule_id,s.schedule_date,s.total_fee,s.payment_code,c.full_name AS parent, su.full_name AS surrogate,e.f_name
        FROM schedule s 
        INNER JOIN clients c ON s.parent_id = c.client_id
        INNER JOIN attorney_assignments a ON s.schedule_id = a.schedule_id
        INNER JOIN employees e ON a.emp_id = e.emp_id
        INNER JOIN clients su ON s.surrogate_id = su.client_id
        WHERE  s.schedule_status='9'";
        $query=mysqli_query($con,$select);
        while($row=mysqli_fetch_array($query)){
            ?>
            <tr class="odd gradeX">

                <td><?php echo $row['schedule_id']?> </td>
                <td><?php echo $row['parent']?> </td>
                <td><?php echo $row['surrogate']?> </td>
                <td><?php echo $row['total_fee']?> </td>
                <td><?php echo $row['payment_code']?> </td>
                <td><?php echo $row['f_name']?> </td>
                <td><?php echo $row['schedule_date']?> </td>
                <td>Completed</td>
            </tr>
            <?php

        }
        ?>

        </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <?php include 'partials/footer.php' ?>
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
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
   <!-- this page js -->
    <script src="assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
    <script src="assets/extra-libs/multicheck/jquery.multicheck.js"></script>
    <script src="assets/extra-libs/DataTables/datatables.min.js"></script>
    <script>
        /****************************************
         *       Basic Table                   *
         ****************************************/
        $('#zero_config').DataTable();
    </script>
  <!-- End custom js for this page-->
</body>

</html>
