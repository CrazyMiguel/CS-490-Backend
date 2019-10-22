<?php

$host = 'sql.njit.edu';
$user = 'mm947';
$password = 'Vt312oiK';
$db = 'mm947';

$cnx = new mysqli($host, $user, $password, $db);
if ($cnx->connect_error)
	die('Connection failed: ' . $cnx->connect_error);
	
$query1 = "Select ExamID from Exams where Released='1'";
$result = mysqli_query($cnx, $query1) or die("BAD QUERY\n");
	
$released_arr=array(); //storing all the exam ids that are released
while($row = mysqli_fetch_array($result)) 
{
	$ExamID=$row['ExamID'];
	array_push($released_arr,$ExamID);
}

$exams_arr=array();
for($i=0;$i<count($released_arr);$i++)
{
	$EID=$released_arr[$i];
	$query2 = "Select QuestionID, Points from Creates_with where ExamID='$EID'"; //getting points
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
			$newquestion = array("questionid" => $QID,"question" => $question,"Points" => $Points); //getting the question,id,points, for that speciific exam 
			array_push($exam_arr, $newquestion);
	    	}
	}
		$eachexam = array("ExamID" => $EID, "questions" => $exam_arr);	//putting the results of all the released exams into another array in order to encode altogether
		array_push($exams_arr,$eachexam);
}
$exams= ["ExamsReleased" => $exams_arr];
echo json_encode($exams);
	
?>
