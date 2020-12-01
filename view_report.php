<?php
  error_reporting(0);
  include("db_config.php");
  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }
?>
  <table class="table" id="get_data1">
    <thead class="text-primary">
      <th>                    LOAN NO         </th>
      <th class="text-right"> BORROWED DATE   </th>
      <th class="text-right"> LOAN AMOUNT     </th>
      <th class="text-right"> PAID AMOUNT     </th>
    </thead>
    <tbody>

  <?php

  if(isset($_POST['cust_id'])){

    $customer = $_POST['cust_id'];

    $query = mysqli_query($con,"SELECT  L.loan_no AS loan_no, L.l_date as l_date, L.amount as amount, L.total_amt as total
      FROM customer C
      INNER JOIN loan L
        ON C.cust_id = L.cust_id
      WHERE L.cust_id = '$customer' ");

        
    $numRows = mysqli_num_rows($query);

      if($numRows > 0) {
        while($row = mysqli_fetch_assoc($query)) {
?>
     
      <tr>
        <td>                    <?php echo $row['loan_no'] ?>   </td>
        <td class="text-right"> <?php echo $row['l_date'] ?>    </td>
        <td class="text-right"> <?php echo $row['amount'] ?>    </td>
        <td class="text-right"> <?php echo $row['total'] ?>     </td>
        <td class="text-right">    
         <a href="#" onclick="View('<?php echo $row['loan_no']; ?>')" name="view">History </a>
        </td>
      </tr>
      <div id = "show_view">
        
      </div>

    </tbody>

<?php
        }
      }
?> 
  
  </table>
  <?php
  mysqli_close($con);

  }

 ?>
<script>
    // VIEW HISTORY
    function View(id){

      $.ajax({
              url:"view_history.php",
              method:"POST",
              data:{"id":id},
              success:function(data){
                $('#show_view').html(data);
                // alert(data)
                $('#get_data1').hide();
              }
        });
    }
    ////////////////////  
</script>