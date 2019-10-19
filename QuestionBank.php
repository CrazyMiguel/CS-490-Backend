<?php

$host = 'sql.njit.edu';
$user = 'mm947';
$password = 'Vt312oiK';
$db = 'mm947';

$cnx = new mysqli($host, $user, $password, $db);
if ($cnx->connect_error)
	die('Connection failed: ' . $cnx->connect_error);

function InsertStuff($Q,$T,$D,$Cin,$Cout,$Cin2,$Cout2)
{
	$query3 = "INSERT INTO Question_Bank (Question, Topic, Difficulty) VALUES ('$Q', '$T', '$D')";
	$result3 = mysqli_query($cnx, $query3) or die("BAD QUERY\n");
}
function InsertTests($QID,$in,$out)
{
	$query4 = "INSERT INTO test_cases (QuestionID, in1, out1) VALUES ('$QID', '$in', '$out')";
	$result4 = mysqli_query($cnx, $query4) or die("BAD QUERYs\n");
}	

//QuestionBank
	//Decoding the JSON file sent via POST
	$Question_JSON= json_decode(file_get_contents('php://input'), true)
	$Question=$Question_PHP["question"];
	$Topic= $Question_PHP["topic"];
	$Difficulty=$Question_PHP['difficulty'];
	$functionname=$Question_PHP['functionname']
	$testcases=$Question_PHP['testcases']
	
	//Inserting Question into Question Bank
	InsertStuff($Question,$Topic,$Difficulty)


	for($i=0;$i<=count($testcases);$i++)
	{
		$casein=$Question_PHP['testcases'][$i]['in']
		$caseout=$Question_PHP['testcases'][$i]['out']
		InsertTests($QID,$casein,$caseout)
	}

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

//Exam Creation
 	
mysqli_close($cnx);
