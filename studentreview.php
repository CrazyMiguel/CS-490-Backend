<?php

$host = 'sql.njit.edu';
$user = 'mm947';
$password = 'Vt312oiK';
$db = 'mm947';

$cnx = new mysqli($host, $user, $password, $db);
if ($cnx->connect_error)
	die('Connection failed: ' . $cnx->connect_error);

	$query3 = "Select * from Review";
	$result3 = mysqli_query($cnx, $query3) or die("BAD Querys\n");
	$valid_arr=array();
	while($row = mysqli_fetch_array($result3)) 
	{
    		$UCID= $row['UCID'];
		$ExamID= $row['ExamID'];
		$Reviewed= $row['Reviewed'];
		if($Reviewed==1)//if the professor reviewed that exam
		{
			$query7 = "Select QuestionID,Results,Comments,Submission from Stored_Exams where ExamID='$ExamID' and UCID='$UCID'";
			$result7 = mysqli_query($cnx, $query7) or die("BAD Querym\n");
			while($row = mysqli_fetch_array($result7))
			{
				$QID= $row['QuestionID'];
				$Results= $row['Results'];
				$Comm= $row['Comments'];
				$Sub= $row['Submission'];
				$query8 = "Select question from Question_Bank where QuestionID='$QID'";
				$result8 = mysqli_query($cnx, $query8) or die("BAD Queryp\n");
				while($row = mysqli_fetch_array($result8))
				{
					$question=$row['question'];
					$who= array("ExamID" => $ExamID,"UCID" => $UCID,"QuestionID" => $QID,"Question" => $question,"Results" => $Results,"Comments" => $Comm,"Submission" => $Sub); 
					array_push($valid_arr, $who);
				}
				
			}
			//$who= array("ExamID" => $ExamID,"UCID" => $UCID); 
			//array_push($valid_arr, $who);
		}
	}	
$exams= ["Student Review" => $valid_arr];
echo json_encode($exams);
mysqli_close($cnx);
?>
