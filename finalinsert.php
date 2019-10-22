<?php

$host = 'sql.njit.edu';
$user = 'mm947';
$password = 'Vt312oiK';
$db = 'mm947';

$cnx = new mysqli($host, $user, $password, $db);
if ($cnx->connect_error)
	die('Connection failed: ' . $cnx->connect_error);

function UpdateScores($QID,$EID,$ucid,$Results,$comments,$score)
{
	global $cnx;
	$query4 = "UPDATE Review SET TotalGrade='$score', Reviewed='1' where ExamID='$EID' and UCID='$ucid'";
	$result4 = mysqli_query($cnx, $query4) or die("BAD QUERYs\n");
	$query5 = "UPDATE Stored_Exams SET Results='$Results', Comments='$comments' where ExamID='$EID' and UCID='$ucid' and QuestionID='$QID'";
	$result5 = mysqli_query($cnx, $query5) or die("BAD QUERYs\n");
}

	$Review_JSON= json_decode(file_get_contents('php://input'), true); //listening for a Json Post
	$info=$Review_JSON["info"];
	$score=$Review_JSON["overall_grade"];
	for($i=0;$i<count($info);$i++)
	{
		$EID=$info[$i]['ExamID'];
		$ucid=$info[$i]['UCID'];
		$Results=$info[$i]['Results'];
		$comments=$info[$i]['Comments'];
		$QID=$info[$i]['QuestionID'];
		UpdateScores($QID,$EID,$ucid,$Results,$comments,$score);
	}
mysqli_close($cnx);
?>
