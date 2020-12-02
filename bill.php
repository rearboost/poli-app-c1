<?php
  error_reporting(0);
  include("db_config.php");
  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }
?>
<div class="card-body">
  <div class="modal fade" id="bill" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <center><h5 class="modal-title" id="staticBackdropLabel">CASH RECEIPT</h5></center>
        </div> 

      <?php
      if(isset($_POST['bill'])){

        $custom_id  = $_POST['id'];
        $li_date    = $_POST['li_date'];
        $i_amt      = $_POST['i_amt'];
        $int_amt    = $_POST['int_amt'];
        $remain_amt = $_POST['remain_amt'];
?>
      
      <h6>CUSTOMER #        : <?php echo $custom_id ?>  </h6>
      <h6>DATE              : <?php echo $li_date ?>    </h6>
      <h6>INSTALLEMENT AMT  : <?php echo $i_amt ?>      </h6>
      <h6>INTEREST AMT      : <?php echo $int_amt ?>    </h6>
      <h6>REMAINING AMT     : <?php echo $remain_amt ?> </h6>

        <form>
          <center>
          <button type="submit" name="print" class="btn btn-success btn-round">Print</button>
          </center>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
mysqli_close($con);
}
 ?>
