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
	$query4 = "INSERT INTO test_cases (in1, out1, in2, out2) VALUES ('$Q', '$Cin', '$Cout', '$Cin2', '$Cout2')";
	$result4 = mysqli_query($cnx, $query4) or die("BAD QUERYs\n");	
}

//QuestionBank
if(isset($_POST['Question']))
{
	//Decoding the JSON file sent via POST
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
	InsertStuff($Question,$Topic,$Difficulty,$case1in,$case1out,$case2in,$case2out)
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
?>
