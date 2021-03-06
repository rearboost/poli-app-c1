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
    Poli App - CUSTOMER LOANS
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
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="#" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="assets/img/logo-small.png">
          </div>
        </a>
        <a href="#" class="simple-text logo-normal">
          POLY APP
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li>
            <a href="index">
              <i class="nc-icon nc-bank"></i>
              <p>DASHBOARD</p>
            </a>
          </li>
          <li>
            <a href="customer">
              <i class="nc-icon nc-single-02"></i>
              <p>CUSTOMERS</p>
            </a>
          </li>
          <li class="active">
            <a href="customer_loan">
              <i class="nc-icon nc-badge"></i>
              <p>CUSTOMER LOANS</p>
            </a>
          </li>
          <li>
            <a href="debt_collection">
              <i class="nc-icon nc-book-bookmark"></i>
              <p>DEBT COLLECTION</p>
            </a>
          </li>
          <li>
            <a href="cheque_transfer">
              <i class="nc-icon nc-tap-01"></i>
              <p>CHEQUE TRANSFER</p>
            </a>
          </li>
          <li>
            <a href="report">
              <i class="nc-icon nc-single-copy-04"></i>
              <p>CUSTOMER HISTORY</p>
            </a>
          </li>
          <li>
            <a href="user">
              <i class="nc-icon nc-single-02"></i>
              <p>USER PROFILE</p>
            </a>
          </li>         
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <?php include('include/nav.php');  ?>
      <!-- End Navbar -->
      <div class="content">
      <div class="row">
          <div class="col-md-12">         
            <div class="card">
              <div class="row">
              <div class="col-md-9">
              <div class="card-header">
                <h4 class="card-title"> CUSTOMER LOANS</h4>    
                <input class="form-control myInput" id="myInput" type="text" placeholder="Search..">                                
              </div>
              </div>
              <div class="col-md-3">
                 <div class="card-header">
                    <button type="button" class="btn btn-primary add-btn" data-toggle="modal" data-target="#Form1">+ Fill Form in here..
                    </button>
                 </div>
              </div>
              </div>
              <div class="card-body">
                <div class="modal fade" id="Form1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">  Customer Loan</h5>
                  </div> 
                <form id="loanAdd">
                  <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-7 pr-3">
                      <div class="form-group">
                        <label>Customer</label>
                          <select class="form-control form-selectBox" id="customer_loan" name = "cust_id" required>
                            <option value="default">--Select Customer--</option>
                            <?php
                          
                            //// need to fetch customer who not a debtor [only drop customers who have l_status - 1]
                                $custom = "SELECT C.cust_id AS cust_id, C.name AS name
                                          FROM customer C 
                                          ";

                                $result1 = mysqli_query($con,$custom);
                                $numRows1 = mysqli_num_rows($result1); 
                 
                                  if($numRows1 > 0) {
                                    while($row1 = mysqli_fetch_assoc($result1)) {
                                      echo "<option value = ".$row1['cust_id'].">" . $row1['cust_id'] . " | " . $row1['name'] . "</option>";
                                      
                                    }
                                  }
                            ?>
                            
                          </select>
                          <div id="show" class="loan-validtion">
                            
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-7 pr-3">
                      <div class="form-group" >
                        <label>Date of obtaining loan</label>
                        <input type="date" name="l_date" class="form-control" required>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-7 pr-3">
                      <div class="form-group">
                        <label>Loan Amount</label>
                        <input type="text" class="form-control customerAmt" placeholder="LKR" id="amount" name="l_amt" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-7 pr-3">
                      <div class="form-group">
                        <label>Interest (%)</label>
                        <input type="text" class="form-control customerAmt" placeholder="Interest" id="int" name="interest" required>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-7 pr-3">
                      <div class="form-group">
                        <label>Daily Interest</label>
                        <input type="text" class="form-control" id="daily_int" name = "daily_int" required readonly>
                      </div>
                    </div>
                  </div>
                  
            
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <input type="hidden" name ="submit" value="submit"/>
                      <button type="submit" class="btn btn-primary btn-round">Submit</button>
                      <Input type="button" onclick="form_reset()" class="btn btn-danger btn-round" data-dismiss="modal" value="Close">

                      <?php
                          if(isset($_POST['submit'])){
                            $cust_id  = $_POST['cust_id'];
                            $l_date   = $_POST['l_date'];
                            $l_amt    = $_POST['l_amt'];
                            $interest = $_POST['interest'];
                            $int_amt  = $_POST['daily_int'];

                            $year =  date("Y");
                            $month = date("m");
                            $createDate = date("Y-m-d");
                  
                            $querySummary = "SELECT id ,loanAMT FROM summary WHERE year='$year' AND month='$month' ";
                            $resultSummary = mysqli_query($con ,$querySummary);

                            $countSummary =mysqli_num_rows($resultSummary);

                            if($countSummary>0){

                                while($rowSummary = mysqli_fetch_array($resultSummary)){

                                    $oldLoanAMT = $rowSummary['loanAMT'];
                                    $id = $rowSummary['id'];
                                }

                                $newLoanAMT = ($oldLoanAMT +$l_amt);

                                $queryRow ="UPDATE summary SET loanAMT='$newLoanAMT' WHERE id='$id' ";
                                $rowRow =mysqli_query($con,$queryRow);

                            }else{

                                $query ="INSERT INTO  summary (year,month,loanAMT,createDate)  VALUES (?,?,?,?)";

                                $stmt =mysqli_stmt_init($con);
                                if(!mysqli_stmt_prepare($stmt,$query))
                                {
                                    echo "SQL Error";
                                }
                                else
                                {
                                    mysqli_stmt_bind_param($stmt,"ssss",$year,$month,$l_amt,$createDate);
                                    $result =  mysqli_stmt_execute($stmt);
                                }

                                for ($x = 1; $x < 13; $x++) {
                              
                                    if($month !=str_pad($x, 2, "0", STR_PAD_LEFT)){

                                      $queryDefult ="INSERT INTO  summary (year,month,createDate)  VALUES (?,?,?)";

                                      $stmt =mysqli_stmt_init($con);
                                      if(!mysqli_stmt_prepare($stmt,$queryDefult))
                                      {
                                          echo "SQL Error";
                                      }
                                      else
                                      {
                                          mysqli_stmt_bind_param($stmt,"sss",$year,str_pad($x, 2, "0", STR_PAD_LEFT),$createDate);
                                          $result =  mysqli_stmt_execute($stmt);
                                      }

                                    }
                                }
                            }

                            $insert2 = "INSERT INTO loan (l_date,amount,interest,value_of_interest,cust_id,l_status) 
                              VALUES ('$l_date',$l_amt,$interest,$int_amt,'$cust_id',1)";                         
                            mysqli_query($con,$insert2);

                          }
                      ?>
                    </div>
                  </div>
                  </div>
                </form>
              </div>
              </div>
              </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="myTable">
                    <thead class="text-primary">
                      <th>                      Loan</th>
                      <th>                      Date</th>
                      <th class="text-right">   Loan Amt</th>
                      <th class="text-right">   Days</th>
                      <th class="text-right">   Remaining Amt</th>
                      <th class="text-right">   Interest(%)</th>                   
                      <th class="text-right">   Daily Interest</th>
                      <th class="text-center">  Status</th>
                      <th>                      cust.ID</th>
                      <th class="text-center">  Edit 				</th>
                      <th class="text-center">  Delete 			</th>
                    </thead>
                    <tbody>
                      <?php
                      $sql=mysqli_query($con,"SELECT * FROM loan");
                      
                      $numRows = mysqli_num_rows($sql); 
                 
                      if($numRows > 0) {
                        while($row = mysqli_fetch_assoc($sql)) {
                          $loan_no  = $row['loan_no'];
                          $l_date   = strtotime($row['l_date']);
                          $loan_amt = $row['amount'];
                          $interest = $row['value_of_interest'];



                        $check = mysqli_query($con,"SELECT * FROM (SELECT * FROM loan_installement WHERE loan_installement.loan_no = '$loan_no') V ORDER BY V.id DESC LIMIT 1;");

                        $data1 = mysqli_fetch_array($check); 

                        $li_date         = strtotime($data1['li_date']);
                        $remaining_amt   = $data1['remaining_amt'];
                        $now_date        = time();

                        if(empty($remaining_amt))
                        {
                           $pre_date   = $l_date;  
                           $remain_amt = $loan_amt;
                           $Days = round(($now_date-$pre_date) / (60 * 60 * 24));
                           $remain_amount = ($remain_amt + ($interest*$Days));
                        }
                        else if($remaining_amt==0){
                           $Days = 0;
                           $remain_amount = 0.00;
                        }
                        else
                        {
                           $pre_date   = $li_date;
                           $remain_amt = $remaining_amt;
                           $Days = round(($now_date-$pre_date) / (60 * 60 * 24));
                           $remain_amount = ($remain_amt + ($interest*$Days));
                        }
                          ?>
                    <tr>
                      <td>                   <?php echo $row['loan_no']?>  </td>
                      <td>                   <?php echo $row['l_date']?>   </td>
                      <td class="text-right"><?php echo number_format($row['amount'],2)?>  </td>
                      <td class="text-right"><?php echo $Days; ?>   </td>
                      <td class="text-right"><?php echo number_format($remain_amount,2);?></td>
                      <td class="text-right"><?php echo $row['interest']?> </td>
                      <td class="text-right"><?php echo number_format($row['value_of_interest'],2)?> </td>
                      <td class="text-center"><?php echo $row['l_status'] ?> </td>
                      <td>                    <?php echo $row['cust_id'] ?>  </td>

                      <td class="text-center">  
                        <a href="#" onclick="editView(<?php echo $row['loan_no']; ?>)" name="edit">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                      </td>

                      <td class="text-center">  
                        <a href="#" onclick="confirmation('event','<?php echo $row['loan_no']; ?>')"  name="delete">
                        <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                      </td>
                    </tr>
                    </tbody>
                           <?php
                        }
                      }
                    ?>                      
                    </table>
                  <?php
                  mysqli_close($con);
                  ?>
                </div>
              </div>
              </div>
            </div>
          </div>
          </div>
        </div>

        </div>
      </div>
      <!-- FOOTER -->
       <?php include('include/footer.php');  ?>
      <!-- FOOTER -->
    </div>
  </div>


  <div id="show_view">

  </div>

  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
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
    /////////////////CHECK IF THE CUSTOMER LOAN EXIST//////////////////////////

    $('#customer_loan').on('change', function() {

      $.ajax({
        url: 'cust_loan_verify.php',
        method:"POST",
        data:{cust_id:this.value},
        success: function (response) {//response is value returned from php 
          //alert(data)
          //$('#show').html(response);
          $("#show").removeAttr('class');
          if(response==1){
             $('#show').html("");
             $("#show").css({"color": "green"});
          }else{
             $('#show').html("Already You have a loan");
             $("#show").css({"color": "red"});
             setTimeout(function(){ $("#customer_loan").val("");  $('#show').html("") }, 1500);
          }
          $("#show").css({"padding": "5px" , "font-size":"small"});
        }
      });
    });  

  /////////////////////////////////////// Table Search ///////////////////////////
    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });


    ///////// Form values reset /////////
    function form_reset(){
      document.getElementById("loanAdd").reset();
    }

    //////////////////// 

    // Form edit 
    function editView(id){

      $.ajax({
              url:"edit_loan.php",
              method:"POST",
              data:{"id":id},
              success:function(data){
                $('#show_view').html(data);
                $('#Form2').modal('show');
              }
        });
    }
    //////////////////// 

    $('.customerAmt').on('keyup',function(){
        customerAmt()
    });

    function customerAmt(){

      var amount = $('#amount').val();
      var int  = $('#int').val();
      
      var daily_interest;

      daily_interest = (Number(amount)*(Number(int)/100))/30;
      
      $('#daily_int').val(daily_interest.toFixed(2));
    
    } 

    ///////////////////////////////////////////////////

    $(function () {

        $('#loanAdd').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'customer_loan.php',
            data: $('#loanAdd').serialize(),
            success: function () {
              swal({
                title: "Good job !",
                text: "Successfully Submited",
                icon: "success",
                button: "Ok !",
                });
                setTimeout(function(){ location.reload(); }, 2500);
               }
          });

        });

      });

    ////////////////////  

    // Form delete 
    function delete_loan(id){

      $.ajax({
              url:"delete_loan",
              method:"POST",
              data:{"id":id},
              success:function(data){
                  swal({
                  title: "Good job !",
                  text: data,
                  icon: "success",
                  button: "Ok !",
                  });
                  setTimeout(function(){ location.reload(); }, 2500);
      
              }
        });
    }

    // delete confirmation javascript
    function confirmation(e,id) {
        swal({
        title: "Are you sure?",
        text: "Want to Delete this recode !",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
               delete_loan(id)
            } 
        });
    }
    ////////////////////  
   
  </script>

</body>

</html>
<?php
}
?>