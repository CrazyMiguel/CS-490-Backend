<?php

$host = 'sql.njit.edu';
$user = 'mm947';
$password = 'Vt312oiK';
$db = 'mm947';

$cnx = new mysqli($host, $user, $password, $db);
if ($cnx->connect_error)
	die('Connection failed: ' . $cnx->connect_error);

	$query1 = "Select Count(ucid) as total from School where role='student'";
	$result1 = mysqli_query($cnx, $query1) or die("BAD Queryt\n");
	$students = mysqli_fetch_assoc($result1);
	$num_students = $students['total'];

	$Total=$total[0][0];
	$query2 = "Select Distinct ExamID from Review";
	$result2 = mysqli_query($cnx, $query2) or die("BAD Queryf\n");
	while($row = mysqli_fetch_array($result2)) 
	{
    		$ExamID_arr[] = $row;
	}
	for($j=0;$j<count($ExamID_arr);$j++)
	{
		$ExamID=$ExamID_arr[$j][0];

		$query6 = "Select SUM(Points) as possible from Creates_with where ExamID= '$ExamID'"; //getting total possible points on question
		$possible_outcome = mysqli_query($cnx, $query6) or die("BAD QUERY\n");
		$Possible_Points= mysqli_fetch_assoc($possible_outcome);
		$Pointsfor= $Possible_Points['possible'];

		$query2 = "Select Count(ucid) as taken from Review where ExamID='$ExamID'"; //getting number of students that took exam
		$result2 = mysqli_query($cnx, $query2) or die("BAD Querys\n");
		$TakenExams = mysqli_fetch_assoc($result2);
		$Students_took = $TakenExams['taken'];

		if($num_students==$Students_took) //checks if the exams submitted is equal to the total number of students in the class 
		{
			$query3 = "Select UCID,Reviewed from Review where ExamID='$ExamID'";
			$result3 = mysqli_query($cnx, $query3) or die("BAD Querys\n");
			while($row = mysqli_fetch_array($result3)) 
			{
    				$UCID= $row['UCID'];
				$Reviewed= $row['Reviewed'];
				if($Reviewed==1)//if the professor reviewed that exam
				{
					$query7 = "Select QuestionID,Results,Comments,Submission from Stored_Exam where ExamID='$ExamID' and UCID='$UCID'";
					$result7 = mysqli_query($cnx, $query7) or die("BAD Querym\n");
					$review_arr=array();
					echo $review_arr[0][0]; 
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
							$newreview = array("Results" => $Results,"Comments" => $Comm,"question" => $question,"Submission" => $Sub); //getting info for student 
							array_push($review_arr, $newreview);
	    					}
					}
				}
			}
		}
	}

mysqli_close($cnx);
?>
