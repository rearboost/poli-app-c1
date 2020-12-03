<?php

   include("db_config.php");
   $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }

    $id = $_POST['id']; // get id through query string

    $qry = mysqli_query($con,"SELECT * FROM loan WHERE loan_no =  $id  "); // select query

    $data = mysqli_fetch_array($qry); // fetch data

    if(isset($_POST['update'])) // when click on Update button
    {
        $no       = $_POST['no'];
        $l_date   = $_POST['l_date'];
        $l_amt    = $_POST['l_amt'];
        $interest = $_POST['interest'];
        $l_method = $_POST['l_method'];
        $p_amt    = $_POST['p_amt'];
        $i_amt    = $_POST['i_amt'];
        $ino_inst = $_POST['ino_inst'];
        $int_amt  = $_POST['daily_int'];

        $edit = mysqli_query($con,"UPDATE loan 
                                  SET l_date             ='$l_date', 
                                      amount             ='$l_amt', 
                                      interest           ='$interest', 
                                      l_method           ='$l_method', 
                                      total_amt          ='$p_amt', 
                                      installment_value  ='$i_amt', 
                                      no_of_installments ='$ino_inst',
                                      value_of_interest  ='$int_amt'
                                  WHERE loan_no=$no");
      
        if($edit)
        {
            mysqli_close($con); // Close connection
            header("location:customer_loan.php"); // redirects to all records page
            exit;
        }
        else
        {
            echo mysqli_error();
        }     
    }              
?>


<div class="card-body">
  <div class="modal fade" id="Form2" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">UPDATE CUSTOMER LOANS</h5>
        </div> 
        <form id="loanEdit">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-5 pr-3">
                <div class="form-group">
                  <input type="text" name="no" class="form-control" value="<?php echo $data['loan_no']?>" hidden>           
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-5 pr-3">
                <div class="form-group">
                  <label>Customer</label>
                  <input type="text" name="cust_id" class="form-control" disabled="" value="<?php echo $data['cust_id']?>">           
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-7 pr-3">
                <div class="form-group">
                  <label>Date of obtaining loan</label>
                  <input type="date" name="l_date" class="form-control" value="<?php echo $data['l_date']?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-7 pr-3">
                <div class="form-group">
                  <label>Loan Amount</label>
                  <input type="text" class="form-control customerAmt1" placeholder="LKR" id="amount1" name = "l_amt" value="<?php echo $data['amount']?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-7 pr-3">
                <div class="form-group">
                  <label>Interest (%)</label>
                  <input type="text" class="form-control customerAmt1" placeholder="Interest" id="int1" name = "interest" value="<?php echo $data['interest']?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-7 pr-3">
              <div class="form-group">
                  <label>No. of Installments</label>
                  <input type="text" class="form-control customerAmt1" id="no1" name = "ino_inst" value="<?php echo $data['no_of_installments']?>">
                </div>
              </div>
            </div>

           <!--  <div class="row">
              <div class="col-md-10 pr-3">
              <div class="form-group" id="rates1">
                <label><input type="radio" id="r4" name="l_method" value="daily" <?php // if($data['l_method']=="daily"){ echo "checked";}?>> Daily</label><br>
                  <label><input type="radio" id="r5" name="l_method" value="monthly" <?php // if($data['l_method']=="monthly"){ echo "checked";}?>> Monthly</label><br>
                  <label><input type="radio" id="r6" name="l_method" value="speed draft" <?php // if($data['l_method']=="speed draft"){ echo "checked";}?>> Speed Draft</label>
                </div>
              </div>
            </div> -->
            
            <div class="row">
              <div class="col-md-7 pr-3">
                <div class="form-group">
                  <label>Paid amount with interest</label>
                  <input type="text" class="form-control" placeholder="LKR" id="paid_amt1" name = "p_amt" value="<?php echo $data['total_amt']?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-7 pr-3">
                <div class="form-group">
                  <label>Value of installement</label>
                  <input type="text" class="form-control" placeholder="LKR" id="inst_val1" name = "i_amt" value="<?php echo $data['installment_value']?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-7 pr-3">
                <div class="form-group"><!-- 
                  <label>Value of interest</label> -->
                  <!-- <input type="text" class="form-control" placeholder="LKR" id="int_val1" name = "int_amt" required> -->
                  <input type="hidden" class="form-control" id="daily_int1" name = "daily_int" value="<?php echo $data['value_of_interest']?>" required>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="update ml-auto mr-auto">
                <input type="hidden" name ="update" value="update"/>
                <button type="submit" class="btn btn-primary btn-round">Update</button>
                <button type="reset" name="close" class="btn btn-danger btn-round" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </form>
      </div><!-- modal content end-->
    </div>
  </div>
</div>


<script>

    //////  radio button onchange catch  ########## Update 
    // $('#rates1').change(function(){

    //   if (document.getElementById('r4').checked) {
    //     rate_value = document.getElementById('r4').value;
    //   }
    //   else if(document.getElementById('r5').checked) {
    //     rate_value = document.getElementById('r5').value;
    //   }
    //   else if(document.getElementById('r6').checked) {
    //     rate_value = document.getElementById('r6').value;
    //   }

    //   var amount = $('#amount1').val();
    //   var int  = $('#int1').val();
    //   var no  = $('#no1').val();
    //   var paid_amt;
    //   var installement_amt;      
    //   var interest_amt;
    //   var daily_interest;


    //   if(rate_value =='daily')
    //   { 
        
    //     paid_amt = Number(amount) + (Number(amount)*(Number(int)/100))*Number(no);
    //     installement_amt = Number(amount)/(Number(no)*30);
    //     interest_amt = (Number(amount)*(Number(int)/100))*Number(no)/(Number(no)*30);

    //   }else if(rate_value =="monthly")
    //   {
    //     paid_amt = Number(amount) + (Number(amount)*(Number(int)/100))*Number(no);
    //     installement_amt = Number(amount)/Number(no);
    //     interest_amt = ((Number(amount)*(Number(int)/100))*Number(no))/Number(no);
    //   }
    //   else
    //   {       
    //     paid_amt = Number(amount) + (Number(amount)*(Number(int)/100))*Number(no);
    //     installement_amt = Number(amount)/(Number(no)*30);
    //     interest_amt = (Number(amount)*(Number(int)/100))*Number(no)/(Number(no)*30);
    //   }
    //     daily_interest = (Number(amount)*(Number(int)/100))*Number(no)/(Number(no)*30);
      
    //   $('#paid_amt1').val(paid_amt.toFixed(2));
    //   $('#inst_val1').val(installement_amt.toFixed(2));      
    //   $('#int_val1').val(interest_amt.toFixed(2));
    //   $('#daily_int1').val(daily_interest.toFixed(2));
    
    // }); 
    // ////////////////////

    // $('.customerAmt1').on('keyup',function(){
    //     customerAmt1()
    // }); 

    // function customerAmt1(){

    //   if (document.getElementById('r4').checked) {
    //     rate_value = document.getElementById('r4').value;
    //   }
    //   else if(document.getElementById('r5').checked) {
    //     rate_value = document.getElementById('r5').value;
    //   }
    //   else if(document.getElementById('r6').checked) {
    //     rate_value = document.getElementById('r6').value;
    //   }

    //   var amount = $('#amount1').val();
    //   var int  = $('#int1').val();
    //   var no  = $('#no1').val();
    //   var paid_amt;
    //   var installement_amt;
    //   var interest_amt;
    //   var daily_interest;

    //   if(rate_value =='daily')
    //   { 
        
    //     paid_amt = Number(amount) + (Number(amount)*(Number(int)/100))*Number(no);
    //     installement_amt = Number(amount)/(Number(no)*30);
    //     interest_amt = (Number(amount)*(Number(int)/100))*Number(no)/(Number(no)*30);

    //   }else if(rate_value =="monthly")
    //   {
        
    //     paid_amt = Number(amount) + (Number(amount)*(Number(int)/100))*Number(no);
    //     installement_amt = Number(amount)/Number(no);
    //     interest_amt = ((Number(amount)*(Number(int)/100))*Number(no))/Number(no);
    //   }
    //   else
    //   {       
    //     paid_amt = Number(amount) + (Number(amount)*(Number(int)/100))*Number(no);
    //     installement_amt = Number(amount)/(Number(no)*30);
    //     interest_amt = (Number(amount)*(Number(int)/100))*Number(no)/(Number(no)*30);
    //   }
    //     daily_interest = (Number(amount)*(Number(int)/100))*Number(no)/(Number(no)*30);
      
    //   $('#paid_amt1').val(paid_amt.toFixed(2));
    //   $('#inst_val1').val(installement_amt.toFixed(2));      
    //   $('#int_val1').val(interest_amt.toFixed(2));
    //   $('#daily_int1').val(daily_interest.toFixed(2));

    // } 
    $('.customerAmt1').on('keyup',function(){
        customerAmt1()
    });

    function customerAmt1(){

      var amount = $('#amount1').val();
      var int  = $('#int1').val();
      var no  = $('#no1').val();
      var paid_amt;
      var installement_amt;
      var interest_amt;
      var daily_interest;
      
        paid_amt = Number(amount) + (Number(amount)*(Number(int)/100))*Number(no);
        installement_amt = Number(amount)/(Number(no));
        interest_amt = ((Number(amount)*(Number(int)/100))*Number(no))/Number(no);

        daily_interest = (Number(amount)*(Number(int)/100))*Number(no)/(Number(no)*30);
      
      $('#paid_amt1').val(paid_amt.toFixed(2));
      $('#inst_val1').val(installement_amt.toFixed(2));
      $('#int_val1').val(interest_amt.toFixed(2));
      $('#daily_int1').val(daily_interest.toFixed(2));
    
    } 

    
    ///////////////////////////////////////////////////

    $(function () {

        $('#loanEdit').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'edit_loan.php',
            data: $('#loanEdit').serialize(),
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
    

</script>