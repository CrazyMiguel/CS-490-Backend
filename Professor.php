<?php

$host = 'sql.njit.edu';
$user = 'mm947';
$password = 'Vt312oiK';
$db = 'mm947';

$cnx = new mysqli($host, $user, $password, $db);
if ($cnx->connect_error)
	die('Connection failed: ' . $cnx->connect_error);

//QuestionBank
if(isset($_POST['Question'], $_POST['Topic'], $_POST['Difficulty'], $_POST['Case1in'], $_POST['Case2in'], $_POST['Case1out'], $_POST['Case2out']))
{
	$query2 = "Select Question from Question_Bank";
	$result2 = mysqli_query($cnx, $query2) or die("BAD QUERY\n");
	while($row = mysqli_fetch_array($result2)) 
	{
		$Question_inputted=$row['Question'];
		echo json_encode($Question_inputted); //must change to json format
	}
	$Question=$_POST['Question'];
	$Topic=$_POST['Topic'];
	$Difficulty=$_POST['Difficulty'];
	$case1in=$_POST['Case1in'];
	$case2in=$_POST['Case2in'];
	$case1out=$_POST['Case1out'];
	$case2out=$_POST['Case2out'];
	$query3 = "INSERT INTO Question_Bank (Question, Topic, Difficulty) VALUES ('$Question', '$Topic', '$Difficulty')";
	$result3 = mysqli_query($cnx, $query3) or die("BAD QUERY\n");
	$query4 = "INSERT INTO test_cases (Question, testNo, input, output) VALUES ('$Question', '1', '$case1in', '$case1out')";
	$result4 = mysqli_query($cnx, $query4) or die("BAD QUERYs\n");	
	$query5 = "INSERT INTO test_cases (Question, testNo, input, output) VALUES ('$Question', '2', '$case2in', '$case2out')";
	$result5 = mysqli_query($cnx, $query5) or die("BAD QUERYm\n");	
}		
mysqli_close($cnx);
?>
