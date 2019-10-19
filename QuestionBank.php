<?php

$host = 'sql.njit.edu';
$user = 'mm947';
$password = 'Vt312oiK';
$db = 'mm947';

$cnx = new mysqli($host, $user, $password, $db);
if ($cnx->connect_error)
	die('Connection failed: ' . $cnx->connect_error);

function InsertStuff($Q,$T,$D,$F)
{
	global $cnx;
	$query3 = "INSERT INTO Question_Bank (question, topic, difficulty, functionname) VALUES ('$Q', '$T', '$D', '$F')";
	$result3 = mysqli_query($cnx, $query3) or die("BAD QUERYf\n");
}

function InsertTests($QID,$in,$out)
{
	global $cnx;
	$query4 = "INSERT INTO test_cases (QuestionID, in1, out1) VALUES ('$QID', '$in', '$out')";
	$result4 = mysqli_query($cnx, $query4) or die("BAD QUERYs\n");
}	

//QuestionBank
	//Decoding the JSON file sent via POST
	$Question_JSON= json_decode(file_get_contents('php://input'), true);
	$question=$Question_JSON["question"];
	$topic= $Question_JSON["topic"];
	$difficulty=$Question_JSON['difficulty'];
	$functionname=$Question_JSON['functionname'];
	$testcases=$Question_JSON['testcases'];
	echo $testcases;
	//Inserting Question into Question Bank
	InsertStuff($question,$topic,$difficulty,$functionname);
	echo $question;
	$query7= "SELECT QuestionID FROM Question_Bank Where question='$question'";
	$QID = mysqli_query($cnx, $query7) or die("BAD Querym\n");
	echo $QID;
	echo $question;
	for($i=0;$i<count($testcases);$i++)
	{
		$casein=$Question_PHP['testcases'][$i]['in'];
		$caseout=$Question_PHP['testcases'][$i]['out'];
		InsertTests($QID,$casein,$caseout);
	}
 	
mysqli_close($cnx);
?>
