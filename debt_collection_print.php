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
       <div class="print_form">
        <form >
          <div>
             <span style="padding-left: 35px; font-size: 22px; color: black;"><b>C.S MOTORS</b></span><br>
             <span style="padding-left: 25px; font-size: revert; color: black;">Pitigala Road , Pelawatta</span><br>
             <span style="padding-left: 30px; font-size: small; color: black;"><b>Hotline : 071 - 337 38 51</b></span>
          </div>
          <span style="color: black;">--------------------------------------------------</span>
            <div class="row"> 
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label style="color: black; margin-bottom: 0;"><b>Customer</b></label><span style="color: black;"> :  
                  <?php
                     $name_id = $data['cust_id'];
                     $custom = "SELECT * FROM customer WHERE cust_id = '$name_id' ";
                     $result1 = mysqli_query($con,$custom);
                     $dataName = mysqli_fetch_array($result1);
                     echo $dataName['name'];
                  
                     ?>
                    </span><br>
                    <span style="padding-left: 83px; font-size: small;"><b><?php echo "( ".$data['cust_id']." )" ?></b></span>
                </div>
              </div> 
            </div> 
            <div class="row"> 
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label style="color: black;"><b>Date</b></label><span style="color: black;"> :  <?php echo $data['li_date'] ?></span>
                </div>
              </div> 
            </div> 

            <div class="row"> 
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label  style="color: black;"><b>Loan Amount</b></label><span style="color: black;"> : Rs <?php echo $data['amount'] ?>
                </div>
              </div> 
            </div> 
            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group" style="margin-bottom: 0px;">
                  <label  style="color: black;"><b>Total paid amt</b></label><span style="color: black;"> : Rs <?php echo $data['paid'] ?>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label  style="color: black;"><b>Installment amt</b></label><span style="color: black;"> : Rs <?php echo $data['installement_amt'] ?>
                </div>
              </div>
            </div>
            <div class="row">                  
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label  style="color: black;"><b>Interest amount</b></label><span style="color: black;"> : Rs <?php echo $data['interest_amt'] ?>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group" style="margin-bottom: 0px;">
                  <label  style="color: black;"><b>Remaining amt</b></label><span style="color: black;"> : Rs <?php echo $data['remaining_amt'] ?>
                </div>
              </div>
            </div>
            
            <span style="color: black;">--------------------------------------------------</span>
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

  ///////////////////////////////////////  Print  
  $(document).ready(function(){
      setTimeout(function(){ window.print(); }, 2000);
     // setTimeout(window.close, 3000);
  });
  ///////////////////////////////////////////


  </script>
</body>

</html>
<?php
}
?>