<?php
	
	error_reporting(0);
	include("db_config.php");
    $con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
	mysqli_select_db($con, DB_NAME);

	$customer_id = $_POST['id'];

	$get_loan = mysqli_query($con,"SELECT loan_no, total_amt,value_of_interest, l_date FROM loan l WHERE cust_id = '$customer_id' AND l_status = 1");

	$data = mysqli_fetch_array($get_loan); 

	$loan_no 	= $data['loan_no'];
	$l_date 	= $data['l_date'];
	$loan_amt 	= $data['total_amt'];
	$interest 	= $data['value_of_interest'];

	$check_no = mysqli_query($con,"SELECT * FROM (SELECT * FROM loan_installement WHERE loan_installement.loan_no = '$loan_no') V ORDER BY V.id DESC LIMIT 1;");

    $data1 = mysqli_fetch_array($check_no); 

	$remaining_amt  = $data1['remaining_amt'];
	$li_date 		= $data1['li_date'];

	if(empty($remaining_amt))
	{
		$remain_amt = $loan_amt;	
		$pre_date 	= $l_date;	
	}
	else
	{
	   $remain_amt = $remaining_amt;
	   $pre_date   = $li_date;
	}

	$myObj->remain_amt = $remain_amt;
	$myObj->loan_amt = $loan_amt;
	$myObj->interest = $interest;
	$myObj->pre_date = $pre_date;

	$myJSON = json_encode($myObj);

	echo $myJSON;

?>