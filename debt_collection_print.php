<?php
include("db_config.php");
include("msg_show.php");
session_start();
if (!isset($_SESSION['loged_user'])) {
    //echo "Access Denied";
    header('location: login.php');
}else {
$con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD);
  if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
  }
mysqli_select_db($con,DB_NAME);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Poli App - DEBT COLLECTION
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">

  <?php

    $id = $_GET['id']; // get id through query string

    $qry = mysqli_query($con,"SELECT * FROM loan,loan_installement WHERE loan.loan_no = loan_installement.loan_no AND id=$id "); // select query

    $data = mysqli_fetch_array($qry); // fetch data
                 
?>
       <div class="print_form" style="padding: 70px 0; display: flex; justify-content: center;">
        <form style="width: 30%; padding: 30px; border: 1px solid;">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-6 pr-3">
                <div class="form-group">
                  <label><b>Customer</b></label> : <?php echo $data['cust_id'] ?>
                </div>
              </div>              
              <div class="col-md-6 pr-3">
                <div class="form-group">
                  <label><b>Date</b></label> : <?php echo $data['li_date'] ?>
                </div>
              </div>
            </div>

            <div class="col-md-12 pr-1">
            <div class="row"> 
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label><b>Loan Amount</b></label> : 
                </div>
              </div>
              <div class="col-md-6 pr-1">
                <div class="form-group">
                   <?php echo $data['amount'] ?>
                </div>
              </div>
            </div> 

            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label><b>Installment amt</b></label> : 
                </div>
              </div>
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <?php echo $data['installement_amt'] ?>
                </div>
              </div>
            </div>
            
            <div class="row">                  
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label><b>Interest amount</b></label> : 
                </div>
              </div>
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <?php echo $data['interest_amt'] ?>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label><b>Remain Interest</b></label> : 
                </div>
              </div>
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <?php echo $data['remaining_int_amt'] ?>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label><b>Remaining amt</b></label> : 
                </div>
              </div>
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <?php echo $data['remaining_amt'] ?>
                </div>
              </div>
            </div>

            </div>
          </div>
         </form> 
       </div>
  </div>

  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <!-- <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script> -->
  <!--  Google Maps Plugin    -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
  <!-- Chart JS -->
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>
  <!-- sweetalert message -->
  <script src="assets/js/sweetalert.min.js"></script>
  <script>

  /////////////////////////////////////// Table Search 
  $(document).ready(function(){
      setTimeout(function(){ window.print(); }, 2500);
  });
  ///////////////////////////////////////////


  </script>
</body>

</html>
<?php
}
?>