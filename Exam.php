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

function InsertExamID($EID)
{
	$query5 = "INSERT INTO Exams (ExamID) VALUES ('$EID')";
	$result5 = mysqli_query($cnx, $query5) or die("BAD QUERY\n");
}

function InsertQforExam($QID,$EID,$P)
{
	$query6 = "INSERT INTO Creates_with (QuestionID, ExamID, Points) VALUES ('$QID', '$EID', '$P')";
	$result6 = mysqli_query($cnx, $query6) or die("BAD QUERY\n");
}

//Exam Creation
if(isset($_POST['Exam']))
{
	//Decoding the JSON file sent via POST
	$Exam_JSON=$_POST['Question'];
	$Exam_PHP=json_decode($Question_JSON, TRUE);
	//$ExamID I need an exam id
	//

mysqli_close($cnx);
?>
