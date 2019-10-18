<?php

$host = 'sql.njit.edu';
$user = 'mm947';
$password = 'Vt312oiK';
$db = 'mm947';

$cnx = new mysqli($host, $user, $password, $db);
if ($cnx->connect_error)
	die('Connection failed: ' . $cnx->connect_error);

//get the entire question bank 
function GetAllQuestions()
{
	$query1 = "Select * from Question_Bank";
	$result1 = mysqli_query($cnx, $query1) or die("BAD QUERY\n");
	while($row = mysqli_fetch_array($result1)) 
	{
		$Question_inputted=['Question' => $row['Question']];
		echo json_encode($Question_inputted); //must change to json format
	}
}

GetALLQuestions();

//Exam Creation
mysqli_close($cnx);
?>
