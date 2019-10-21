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

	while($row = mysqli_fetch_array($result)) 
	{
	    $ExamID=$row['ExamID'];
	}
	$query2 = "Select QuestionID, Points from Creates_with where ExamID='$ExamID'"; //getting points
	$result2 = mysqli_query($cnx, $query2) or die("BAD QUERY\n");
	
	$exam_arr=array();
	while($row = mysqli_fetch_array($result2)) 
	{
	    $QID=$row['QuestionID'];
	    $Points=$row['Points'];
	    $query3 = "Select question from Question_Bank where QuestionID='$QID'";
	    $result3 = mysqli_query($cnx, $query3) or die("BAD QUERY\n");
	    while($row = mysqli_fetch_array($result3))
	    {
		$question=$row['question'];
		$newquestion = array("questionid" => $QID,"question" => $question,"Points" => $Points);
		array_push($exam_arr, $newquestion);
	    } 
	}
	$response = ["questions" => $exam_arr];
	echo json_encode($response);
	
}

/*
	{"questions":[{
		"questionid":"120"
		"question":"fjklsfjdlksjdflksjd"
		"points":"20"},
		{
		"questionid":"120"
		"question":"fjklsfjdlksjdflksjd"
		"points":"20"}]

}
*/
