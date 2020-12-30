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
          <li class="">
            <a href="customer_loan">
              <i class="nc-icon nc-badge"></i>
              <p>CUSTOMER LOANS</p>
            </a>
          </li>
          <li class="active">
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
                <h4 class="card-title"> DEBT COLLECTION WITH INTEREST</h4>     
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
                    <h5 class="modal-title" id="staticBackdropLabel">Debt Collection</h5>
                  </div>
                <form id="collectionDebt">
                  <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6 pr-3">
                      <div class="form-group">
                        <label>Customer</label>
                          <select class="form-control form-selectBox" id="custom_id" name = "id" required>
                            <option value="default">--Select Customer--</option>
                            <?php

                              $custom = "SELECT C.cust_id AS cust_id  , C.name AS name
                                          FROM customer C 
                                          INNER JOIN  loan L
                                          ON C.cust_id = L.cust_id
                                          WHERE L.l_status = 1;";

                                $result1 = mysqli_query($con,$custom);
                                $numRows1 = mysqli_num_rows($result1); 
                 
                                  if($numRows1 > 0) {
                                    while($row1 = mysqli_fetch_assoc($result1)) {
                                      echo "<option value = ".$row1['cust_id'].">" . $row1['cust_id'] . " | " . $row1['name'] . "</option>";
                                      
                                    }
                                  }
                            ?>
                          </select>
                      </div>
                    </div>
                    <div class="col-md-6 pr-3">
                      <div class="form-group">
                        <?php

                          $print = mysqli_query($con,"SELECT * FROM loan_installement ORDER BY id DESC LIMIT 1");
                          $row_print = mysqli_fetch_assoc($print);

                        ?>
                        <input type="hidden" id="nextId" name="nextId" value ='<?php echo $row_print['id']+1; ?>'>
                        <label>Loan Amount</label>
                        <input type="text" class="form-control" id="loan_amt" name = "l_amt" disabled = "" id = "loan_amount" readonly required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-3">
                      <div class="form-group">
                        <label>Date</label>
                        <input type="date" class="form-control available" id="li_date" name = "li_date" required disabled="">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <input type="hidden" class="form-control" id="days" name = "day" required disabled>
                        <input type="text" class="form-control" id="daily_int" name = "daily_int" required disabled>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-3">
                      <div class="form-group">
                        <label>Amount</label>
                        <input type="text" class="form-control checkAmt" placeholder="LKR" id="amt" name = "amt" required disabled>
                        <input type="text" class="form-control" placeholder="LKR" id="new_amt" name = "new_amt" required disabled>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 pr-3">
                      <div class="form-group">
                        <label>Installment amount</label>
                        <input type="text" class="form-control" placeholder="LKR" id="inst_amt" name = "i_amt" required readonly>
                      </div>
                    </div>               
                    <div class="col-md-6 pr-3">
                      <div class="form-group">
                        <label>Interest amount</label>
                        <input type="text" class="form-control" placeholder="LKR" id="int_amount" name = "int_amt" required readonly>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-6 pr-3">
                      <div class="form-group">
                        <label>Remaining Interest Amount</label>
                        <input type="text" class="form-control" id="r_int" name = "r_int" readonly required>
                      </div>
                    </div>
                    <div class="col-md-6 pr-3">
                      <div class="form-group">
                        <label>Remaining amount</label>
                        <input type="text" class="form-control" id="remain_amt" name = "remain_amt" value="" readonly required>
                      </div>
                    </div>
                  </div>                  
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <input type="hidden" name ="submit" value="submit"/>
                      <button type="submit" class="btn btn-primary btn-round" >Submit</button>
                      <Input type="button" onclick="form_reset()" class="btn btn-danger btn-round" data-dismiss="modal" value="Close">

                      <?php
                          if(isset($_POST['submit'])){

                            $custom_id      = $_POST['id'];
                            $li_id          = $_POST['nextId'];
                            $li_date        = $_POST['li_date'];
                            $daily_int      = $_POST['daily_int'];
                            $amt            = $_POST['amt'];
                            $new_amt        = $_POST['new_amt'];
                            $i_amt          = $_POST['i_amt'];
                            $int_amt        = $_POST['int_amt'];
                            $remain_int_amt = $_POST['r_int'];
                            $remain_amt     = $_POST['remain_amt'];

                            $year =  date("Y");
                            $month = date("m");
                            $createDate = date("Y-m-d");
                  
                            $querySummary = "SELECT id ,debtAMT FROM summary WHERE year='$year' AND month='$month' ";
                            $resultSummary = mysqli_query($con ,$querySummary);

                            $countSummary =mysqli_num_rows($resultSummary);

                            if($countSummary>0){

                                while($rowSummary = mysqli_fetch_array($resultSummary)){

                                    $oldDebtAMT = $rowSummary['debtAMT'];
                                    $id = $rowSummary['id'];
                                }

                                $newDebtAMT = ($oldDebtAMT +$i_amt);

                                $queryRow ="UPDATE summary SET debtAMT='$newDebtAMT' WHERE id='$id' ";
                                $rowRow =mysqli_query($con,$queryRow);

                            }else{

                                $query ="INSERT INTO  summary (year,month,debtAMT,createDate)  VALUES (?,?,?,?)";

                                $stmt =mysqli_stmt_init($con);
                                if(!mysqli_stmt_prepare($stmt,$query))
                                {
                                    echo "SQL Error";
                                }
                                else
                                {
                                    mysqli_stmt_bind_param($stmt,"ssss",$year,$month,$i_amt,$createDate);
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

                          $data = mysqli_query($con,"SELECT l.loan_no, l.amount FROM customer c , loan l WHERE c.cust_id = l.cust_id AND l.cust_id = '$custom_id' AND l.l_status = 1");
                          		$row_l = mysqli_fetch_assoc($data);
                          		$loan_no = $row_l['loan_no'];
                          		$loan_amount = $row_l['amount'];

                          $insert = "INSERT INTO loan_installement (id,li_date,paid,installement_amt,interest_amt,remaining_int_amt,remaining_amt,loan_no) VALUES ($li_id,'$li_date',$amt,$i_amt,$int_amt,$remain_int_amt,$remain_amt,$loan_no)";
                          mysqli_query($con,$insert);

                          $update_new = mysqli_query($con,"UPDATE loan SET amount=$new_amt,
                           value_of_interest = $daily_int WHERE loan_no=$loan_no");

                          if($remain_amt <= 0){
                            $update_status = mysqli_query($con,"UPDATE loan SET l_status =0 WHERE loan_no=$loan_no");
                          }

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
                  	  <th>                    ID 				        </th>
                      <th>                    Installement Date </th>
                      <th class="text-right"> Paid amt 	      </th>
                      <th class="text-right"> Installement amt  </th>
                      <th class="text-right"> Interest amt 		  </th>
                      <th class="text-right"> Remaining interest</th>
                      <th class="text-right"> Remaining amt     </th>
                      <th class="text-right"> Loan no 			    </th>
                      <th class="text-center">Delete 			      </th>
                      <th class="text-center">Print 			      </th>
                    </thead>
                    <tbody>
                      <?php
                      $sql="SELECT * FROM loan_installement";
                      
                      $result = mysqli_query($con,$sql);
                      $numRows = mysqli_num_rows($result); 
                 
                      if($numRows > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                        	?>
                            
                            <tr>
                            <td>                      <?php echo $row['id']  ?>              </td>
                            <td>                      <?php echo $row['li_date']  ?>         </td>
                            <td class="text-right">   <?php echo $row['paid']?>             </td>
                            <td class="text-right">   <?php echo $row['installement_amt']?>  </td>
                            <td class="text-right">   <?php echo $row['interest_amt'] ?>     </td>
                            <td class="text-right">   <?php echo $row['remaining_int_amt']?> </td>
                            <td class="text-right">   <?php echo $row['remaining_amt'] ?>    </td>
                            <td class="text-right">   <?php echo $row['loan_no']  ?>         </td>
                           
                          	<td class="text-center">  
                            	<a href="#" onclick="confirmation('event','<?php echo $row['id']; ?>')" name="delete">
                            	<i class="fa fa-trash-o" aria-hidden="true"></i></a>
                          	</td>
                            <td class="text-center">  
                            	<a href="#" onclick="printView(<?php echo $row['id']; ?>)" name="print">
                              <i class="fa fa-print" aria-hidden="true"></i></a>
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
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
  ///////////////////////////////////////////

  // fetch remain amount and loan amount from remain_amt.php
  $('#custom_id').on('change', function() {

      $.ajax({
        url: 'remain_amt.php',
        method:"POST",
        data:{id:this.value},
        success: function (response) {

          var obj = JSON.parse(response);
          $('#remain_amt').val(obj.remain_amt);
          $('#loan_amt').val(obj.loan_amt);
          var pre_date  =  obj.pre_date
          var now_date  =  $('#li_date').val();

          const oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
          const firstDate = new Date(pre_date);
          const secondDate = new Date(now_date);

          const diffDays = Math.round(Math.abs((firstDate - secondDate) / oneDay));

          $('#days').val(diffDays);

          $('#li_date').prop('disabled', false);
        }
      });
  }); 

  ///////////////////////////////////////////

  // fetch no.of days when select the date
  $('#li_date').on('change', function() {

      var customer_id = $('#custom_id').val();

      $.ajax({
        url: 'remain_amt.php',
        method:"POST",
        data:{id:customer_id},
        success: function (response) {
          var obj = JSON.parse(response);
          var pre_date  =  obj.pre_date
          var now_date  =  $('#li_date').val();

          const oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
          const firstDate = new Date(pre_date);
          const secondDate = new Date(now_date);

          const diffDays = Math.round(Math.abs((firstDate - secondDate) / oneDay));

          $('#days').val(diffDays);
          $('#amt').prop('disabled', false);
        }
      });
}); 

///////// Form values reset /////////
function form_reset(){
  document.getElementById("collectionDebt").reset();
}

//////////////////// 


$('.checkAmt').on('keyup',function(){

  checkAmt()

})

function checkAmt(){

  var amount = $('#amt').val();
  var days   = $('#days').val();
  var new_daily_int;
  var new_loan_amt;
  var installement_amt;
  var interest_amt;
  var remain_int;
  var remain_amt;
  var id =  $('#custom_id').val();

  $.ajax({
    url: 'remain_amt.php',
    method:"POST",
    data:{id:id},
    success: function (response) {

      var obj = JSON.parse(response);
     // $('#remain_amt').val(obj.remain_amt);
      var remain_amt      =  obj.remain_amt
      var remain_int      =  obj.remain_int
      var loan            =  obj.loan_amt
      var daily_interest  =  obj.interest

      // this value doesn't come from remain.amount.php 
      var per_int         =  obj.int_perc
      
      interest_amt = (Number(daily_interest) * Number(days));
      
      if(amount>=interest_amt){
        installement_amt = Number(amount) - Number(interest_amt);
        remain_int       = Number(0.00);
        new_loan_amt     = Number(loan);
        new_daily_int    = (Number(new_loan_amt)*(Number(per_int)/100))/30;
        remain_amt = Number(remain_amt) - Number(installement_amt);  
      }else{
        installement_amt = Number(0.00);
        remain_int       = Number(interest_amt) - Number(amount);
        new_loan_amt     = Number(loan)+Number(remain_int);
        new_daily_int    = (Number(new_loan_amt)*(Number(per_int)/100))/30;
        remain_amt       = Number(remain_amt) + Number(remain_int);  
      }
        
  
       $('#int_amount').val(interest_amt.toFixed(2));
       $('#inst_amt').val(installement_amt.toFixed(2));
       $('#r_int').val(remain_int.toFixed(2));
       $('#remain_amt').val(remain_amt.toFixed(2));
       $('#new_amt').val(new_loan_amt.toFixed(2));
       $('#daily_int').val(new_daily_int.toFixed(2));
    }
  });
}

/////////////// Bill//////////////////// 
function printView(id){
  window.open('debt_collection_print?id='+id, '_blank');
}
/////////////////////

// Form edit 
function editView(id){

  $.ajax({
          url:"edit_debt.php",
          method:"POST",
          data:{"id":id},
          success:function(data){
            $('#show_view').html(data);
            $('#Form2').modal('show');
          }
    });
}
//////////////////// 
 $(function () {

      $('#collectionDebt').on('submit', function (e) {

        e.preventDefault();

        var nextId = $('#nextId').val();
        
        $.ajax({
          type: 'post',
          url: 'debt_collection.php',
          data: $('#collectionDebt').serialize(),
          success: function () {
            swal({
              title: "Good job !",
              text: "Successfully Submited",
              icon: "success",
              button: "Ok !",
              });
              setTimeout(function(){window.open('debt_collection_print?id='+nextId, '_blank'); }, 2500);
              setTimeout(function(){ location.reload(); }, 2500);
          }
        });

      });
  });

////////////////////  

// Form delete 
function delete_debt(id){

  $.ajax({
          url:"delete_debt",
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
           delete_debt(id)
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