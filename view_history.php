<?php
  error_reporting(0);
  include("db_config.php");
  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }
?>
  <table class="table" id="get_data2">
    <thead class="text-primary">
      <th>                    DATE             </th>
      <th class="text-right"> INSTALLEMENT AMT </th>
      <th class="text-right"> INTEREST AMT     </th>
      <th class="text-right"> REMAINING AMT    </th>
    </thead>
    <tbody>

  <?php

    $loan_no = $_POST['id'];

    $query = mysqli_query($con,"SELECT  I.li_date as li_date, I.installement_amt as installement, I.interest_amt as interest, I.remaining_amt as remaining
      FROM loan L
      INNER JOIN loan_installement I
         ON L.loan_no = I.loan_no
      WHERE L.loan_no = '$loan_no' ");
        
    $numRows = mysqli_num_rows($query);

      if($numRows > 0) {
        while($row1 = mysqli_fetch_assoc($query)) {
?>
      <tr>
        <td>                    <?php echo $row1['li_date'] ?>       </td>
        <td class="text-right"> <?php echo $row1['installement'] ?>  </td>
        <td class="text-right"> <?php echo $row1['interest'] ?>      </td>
        <td class="text-right"> <?php echo $row1['remaining'] ?>     </td>
      </tr>
    </tbody>
<?php
        }
      }
?> 
  
  </table> 
    <h6><a href="#" onclick="Back()" name="back">Back</a></h6>
<?php
mysqli_close($con);


 ?>
<script>
    // BACK TO REPORT
    function Back(){

      $.ajax({
              url:"report",
              method:"POST",
              data:{"id":id},
              success:function(data){
                $('#show_report').html(data);
              }
        });
    }

    // $(function Back() {        
    //       setTimeout(function(){ location.reload(); }, 2500);

    //   });
    ////////////////////  
</script>