<?php

$host = 'sql.njit.edu';
$user = 'mm947';
$password = 'Vt312oiK';
$db = 'mm947';

$cnx = new mysqli($host, $user, $password, $db);
if ($cnx->connect_error)
	die('Connection failed: ' . $cnx->connect_error);

//QuestionBank
if(isset($_POST['Question']))
{
	//Display the Question_Bank
	$query2 = "Select Question from Question_Bank";
	$result2 = mysqli_query($cnx, $query2) or die("BAD QUERY\n");
	while($row = mysqli_fetch_array($result2)) 
	{
		$Question_inputted=['Question' => $row['Question']];
		echo json_encode($Question_inputted); //must change to json format
	}
	//Decoding the JSON file sent via POS
	$Question_JSON=$_POST['Question'];
	$Question_PHP=json_decode($Question_JSON, TRUE);
	$Question=$Question_PHP["question"];
	$Topic= $Question_PHP["topic"];
	$Difficulty=$Question_PHP['difficulty'];
	$case1in=$Question_PHP['testcases'][0]['in']
	$case1out=$Question_PHP['testcases'][0]['out']
	$case2in=$Question_PHP['testcases'][1]['in'];
	$case2out=$Question_PHP['testcases'][1]['out'];

	//Inserting Question into Question Bank
	$query3 = "INSERT INTO Question_Bank (Question, Topic, Difficulty) VALUES ('$Question', '$Topic', '$Difficulty')";
	$result3 = mysqli_query($cnx, $query3) or die("BAD QUERY\n");
	$query4 = "INSERT INTO test_cases (in1, out1, in2, out2) VALUES ('$Question', '$case1in', '$case1out', '$case2in', '$case2out')";
	$result4 = mysqli_query($cnx, $query4) or die("BAD QUERYs\n");	
}

//Exam
	//Display Question Bank
	//$query6 = "Select Question from Question_Bank";
	//$result6 = mysqli_query($cnx, $query6) or die("BAD QUERY\n");
	//while($row = mysqli_fetch_array($result6)) 
	//{
	//	$Question_inputted=['Question' => $row['Question']];
	//	echo json_encode($Question_inputted); //must change to json format
	//}	
mysqli_close($cnx);
?>
