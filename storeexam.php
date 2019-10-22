<?php

$host = 'sql.njit.edu';
$user = 'mm947';
$password = 'Vt312oiK';
$db = 'mm947';

$cnx = new mysqli($host, $user, $password, $db);
if ($cnx->connect_error)
	die('Connection failed: ' . $cnx->connect_error);

function InsertTakenExam($EID,$UCID,$QID,$R,$C,$Sub)
{
	global $cnx;
	$query3 = "INSERT INTO Stored_Exams (ExamID, UCID, QuestionID, Results, Comments, Submission) VALUES ('$EID', '$UCID', '$QID', '$R', '$C','$Sub'))";
	$result3 = mysqli_query($cnx, $query3) or die("BAD QUERYf\n");
}

//StoreTakenExam
	//Decoding the JSON file sent via POST
	$Question_JSON= json_decode(file_get_contents('php://input'), true); //listening for a Json Post
	$ucid=$Question_JSON["student"];
	$examID= $Question_JSON["examid"];
	$questions=$Question_JSON['questions'];
	for($i=0;$i<count($questions);$i++)
	{
		$qid=$questions[$i]['questionid'];
		$submission=$testcases[$i]['submission'];
		$commments=$questions[$i]['comments'];
		$grade=$testcases[$i]['grade'];
		InsertTakenExam($examID,$ucid,$qid,$grade,$comments,$submission);
	}
 	
mysqli_close($cnx);
?>
