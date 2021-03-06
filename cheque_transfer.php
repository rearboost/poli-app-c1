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
      Poli App - CHEQUE TRANSFER
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
          <li>
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
          <li  class="active">
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
                <h4 class="card-title"> Cheque Transfer</h4>     
                <input class="form-control myInput" id="myInput" type="text" placeholder="Search..">                              
              </div>
              </div>
              <div class="col-md-3">
                <div class="card-header">
                  <button type="button" class="btn btn-primary add-btn" data-toggle="modal" data-target="#Form1">+ FILL FORM IN HERE..
                  </button> 
                </div>
              </div>
              </div>
              <div class="card-body">
                <div class="modal fade" id="Form1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Cheque Transfer</h5>
                  </div> 
                <form id="transferCheque">
                  <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-7 pr-3">
                      <div class="form-group">
                        <label>Customer</label>
                          <select class="form-control form-selectBox" name = "id" required>
                            <option value="default">--Select Customer--</option>
                            <?php
                              $custom = "SELECT cust_id, name FROM customer";

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
                  </div>
                  <div class="row">
                    <div class="col-md-7 pr-3">
                      <div class="form-group">
                        <label>Bank</label>
                        <input type="text" placeholder="Bank name" name="bank" class="form-control" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-7 pr-3">
                      <div class="form-group">
                        <label>Cheque Number</label>
                        <input type="text" class="form-control" placeholder="cheque number" name="cheque_no" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-7 pr-3">
                      <div class="form-group">
                        <label>Valid Date</label>
                        <input type="date" class="form-control" name="v_date" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-7 pr-3">
                    <div class="form-group">
                        <label>Exchange Date</label>
                        <input type="date" class="form-control" name = "change_date" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-7 pr-3">
                      <div class="form-group">
                        <label>Value of the cheque</label>
                        <input type="text" class="form-control cal_exAmt" placeholder="LKR" id="cheque_val" name="cheque_value" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-7 pr-3">
                      <div class="form-group">
                        <label>Interest(%)</label>
                        <input type="text" class="form-control cal_exAmt" placeholder="0" id="int" name = "interest" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-7 pr-3">
                      <div class="form-group">
                        <label>Exchange Value</label>
                        <input type="text" class="form-control" placeholder="LKR" id="exchange_val" name="exchange_value" readonly required>
                      </div>
                    </div>
                  </div>
                  <div class="row">                    
                    <div class="col-md-7 pr-3">
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control form-selectBox" name = "status" required>
                            <option>--Select Status--</option>
                            <option>Completed</option>
                            <option>NYC</option>
                          </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <input type="hidden" name ="submit" value="submit"/>'
                      <button type="submit" name="submit" class="btn btn-primary btn-round">Submit</button>
                      <Input type="button" onclick="form_reset()" class="btn btn-danger btn-round" data-dismiss="modal" value="Close">

                      <?php
                          if(isset($_POST['submit'])){
                            $cust_id        = $_POST['id'];
                            $bank           = $_POST['bank'];
                            $cheque_no      = $_POST['cheque_no'];
                            $v_date         = $_POST['v_date'];
                            $change_date    = $_POST['change_date'];
                            $cheque_value   = $_POST['cheque_value'];
                            $interest       = $_POST['interest'];
                            $exchange_value = $_POST['exchange_value'];
                            $status         = $_POST['status'];

                          $insert2 = "INSERT INTO cheque (bank,cheque_no,valid_date,exchange_date,cheque_value,interest,exchange_amt,status,cust_id) 
                            VALUES ('$bank','$cheque_no','$v_date','$change_date',$cheque_value,$interest,$exchange_value,'$status','$cust_id')";  

                          mysqli_query($con,$insert2);
                          // header('location:'.$_SERVER['PHP_SELF']);
                           // $res = mysqli_query($con,$insert2);
                           // if($res){
                           //  unset($_POST);

                           // }
                          }   
                      ?>
                    </div>
                  </div>
                 </div>
                </form>
               </div>
              </div>
            </div>
          
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="myTable">
                    <thead class="text-primary">
                      <th>                    ID</th>
                      <th>                    Bank</th>
                      <th>                    Cheque No.</th>
                      <th>                    Valid Date</th>
                      <th>                    Exchange Date</th>
                      <th class="text-right"> Cheque Value</th>
                      <th class="text-right"> Interest</th>
                      <th class="text-right"> Exchange Amount</th>
                      <th>                    Status</th>
                      <th>                    cust.ID</th>
                      <th class="text-center">                    Edit 				</th>
                      <th class="text-center">                    Delete 			</th>
                    </thead>
                    <tbody>
                      <?php
                      $sql=mysqli_query($con,"SELECT * FROM cheque");
                      
                      $numRows = mysqli_num_rows($sql); 
                 
                      if($numRows > 0) {
                        while($row = mysqli_fetch_assoc($sql)) {
                          ?>
                          <tr>
                            <td>                    <?php echo $row['cheque_id'] ?>     </td>
                            <td>                    <?php echo $row['bank'] ?>          </td>
                            <td>                    <?php echo $row['cheque_no'] ?>     </td>
                            <td>                    <?php echo $row['valid_date'] ?>    </td>
                            <td>                    <?php echo $row['exchange_date'] ?> </td>
                            <td class="text-right"> <?php echo $row['cheque_value'] ?>  </td>
                            <td class="text-right"> <?php echo $row['interest'] ?>      </td>
                            <td class="text-right"> <?php echo $row['exchange_amt']?>   </td>
                            <td>                    <?php echo $row['status']?>         </td>
                            <td>                    <?php echo $row['cust_id'] ?>       </td>
                            <td class="text-center">  
                              <!-- <a href="edit_cheque.php?id=<?php //echo $row['cheque_id']; ?>" name="edit"> -->
                              <a href="#" onclick="editView(<?php echo $row['cheque_id']; ?>)" name="edit">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            </td>
                            <td class="text-center">  
                              <a href="#" onclick="confirmation('event','<?php echo $row['cheque_id']; ?>')"  name="delete">
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

    $('.cal_exAmt').on('keyup',function(){

        calAmt()
    })

    function calAmt(){

      var amount = $('#cheque_val').val();
      var int  = $('#int').val();
      var exchange_amt;

          exchange_amt = (Number(amount)-(Number(amount)*(Number(int)/100)));
          $('#exchange_val').val(exchange_amt.toFixed(2));
    }


    // $('#int').keyup(function(){
    //       var amount = $('#cheque_val').val();
    //       var int  = $('#int').val();
    //       var exchange_amt;

    //       exchange_amt = (Number(amount)-(Number(amount)*(Number(int)/100)));
    //       $('#exchange_val').val(exchange_amt.toFixed(2));
    // });  

    ////////////////////  

    // Form edit 
    function editView(id){

      $.ajax({
              url:"edit_cheque.php",
              method:"POST",
              data:{"id":id},
              success:function(data){
                $('#show_view').html(data);
                $('#Form2').modal('show');
              }
        });
    }
    ////////////////////  

    ///////// Form values reset /////////
    function form_reset(){
      document.getElementById("transferCheque").reset();
    }

    //////////////////// 


    ///////////////////////////////////////////////////

    $(function () {

        $('#transferCheque').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'cheque_transfer.php',
            data: $('#transferCheque').serialize(),
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
    function delete_cheque(id){

      $.ajax({
              url:"delete_cheque",
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
               delete_cheque(id)
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