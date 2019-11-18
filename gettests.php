<?php

$host = 'sql.njit.edu';
$user = 'mm947';
$password = 'Vt312oiK';
$db = 'mm947';

$cnx = new mysqli($host, $user, $password, $db);
if ($cnx->connect_error)
	die('Connection failed: ' . $cnx->connect_error);

if(isset($_POST['questionid']))
{
	$QID=$_POST['questionid'];
	
	$query1 = "Select functionname,required from Question_Bank where QuestionID='$QID'";
	$Functionname = mysqli_query($cnx, $query1) or die("BAD QUERY\n");
	
	while($row = mysqli_fetch_array($Functionname)) 
	{
    		$function=$row['functionname'];
		$required=$row['required'];
	}	

	$query1 = "Select in1, out1 from test_cases where QuestionID='$QID'";
	$testcases = mysqli_query($cnx, $query1) or die("BAD QUERY\n");
	
	$test_arr=array();
	while($row = mysqli_fetch_array($testcases)) 
	{
    		$test_casein=$row['in1'];
    		$test_caseout=$row['out1'];
		$newdata = array("in" => $test_casein,"out" => $test_caseout);
		array_push($test_arr, $newdata);
	}
	
	$response = ["functionname" => $function, "required" => $required, "testcases" => $test_arr];
	echo json_encode($response);
	
}
?>
