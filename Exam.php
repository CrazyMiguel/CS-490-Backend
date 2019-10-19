<?php

$host = 'sql.njit.edu';
$user = 'mm947';
$password = 'Vt312oiK';
$db = 'mm947';

$cnx = new mysqli($host, $user, $password, $db);
if ($cnx->connect_error)
	die('Connection failed: ' . $cnx->connect_error);

function InsertExamtype()
{
	$query5 = "INSERT INTO Exams (Testname) VALUES ('python')";
	$result5 = mysqli_query($cnx, $query5) or die("BAD QUERY\n");
}

function InsertQforExam($QID,$EID,$P)
{
	$query6 = "INSERT INTO Creates_with (QuestionID, ExamID, Points) VALUES ('$QID', '$EID', '$P')";
	$result6 = mysqli_query($cnx, $query6) or die("BAD QUERY\n");
}

//Exam Creation
	//Decoding the JSON file sent via POST
	$Exam_PHP= json_decode(file_get_contents('php://input'), true)
	$numquestions=$Exam_PHP["questions"]
	InsertExamtype();
	$query7= "SELECT ExamID FROM Exams ORDER BY ExamID DESC LIMIT 1"
	$ExamID = mysqli_query($cnx, $query7) or die("BAD Query\n");

	for($i=0;$i<=count($numquestions);$i++)
	{
		$QuestionID=["questionid"];
		$Points=["points"];
		InsertQforExam($QuestionID,$ExamID,$Points);
	}
}
mysqli_close($cnx);
?>
