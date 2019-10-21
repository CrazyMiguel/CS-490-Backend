<?php

$host = 'sql.njit.edu';
$user = 'mm947';
$password = 'Vt312oiK';
$db = 'mm947';

$cnx = new mysqli($host, $user, $password, $db);
if ($cnx->connect_error)
	die('Connection failed: ' . $cnx->connect_error);
	
if(isset($_POST['studentexam']))
{
	$query1 = "Select ExamID from Exams where Released='1'";
	$result = mysqli_query($cnx, $query1) or die("BAD QUERY\n");
	echo $result;
	$query2 = "Select QuestionID, Points from Creates_with where ExamID='$result'";
	$result2 = mysqli_query($cnx, $query2) or die("BAD QUERY\n");
	
}

?>
