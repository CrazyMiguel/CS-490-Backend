<?php

$host = 'sql.njit.edu';
$user = 'mm947';
$password = 'Vt312oiK';
$db = 'mm947';

$cnx = new mysqli($host, $user, $password, $db);
if ($cnx->connect_error)
	die('Connection failed: ' . $cnx->connect_error);


function InsertExamtype($Ename)
{
	global $cnx;

	$query5 = "INSERT INTO Exams (Testname, Released) VALUES ('$Ename', '0')";
	$result5 = mysqli_query($cnx, $query5) or die("BAD QUERYs\n");
}

function InsertQforExam($QID,$EID,$P)
{
	global $cnx;
	$query6 = "INSERT INTO Creates_with (QuestionID, ExamID, Points) VALUES ('$QID', '$EID', '$P')";
	$result6 = mysqli_query($cnx, $query6) or die("BAD QUERYm\n");
}

//Exam Creation
	//Decoding the JSON file sent via POST
	$Exam_JSON= json_decode(file_get_contents('php://input'), true);
	$numquestions=$Exam_JSON["questions"];
	$Examname=$Exam_JSON["exam_name"];
	InsertExamtype($Examname);
	$ExamID= intval(mysqli_insert_id($cnx));
	
	for($i=0;$i<count($numquestions);$i++)
	{
		$QuestionID=$numquestions[$i]['questionid'];
		$Points=$numquestions[$i]['points'];
		InsertQforExam($QuestionID,$ExamID,$Points);
	}

mysqli_close($cnx);
?>
