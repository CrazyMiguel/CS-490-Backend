<?php

$host = 'sql.njit.edu';
$user = 'mm947';
$password = 'Vt312oiK';
$db = 'mm947';

$cnx = new mysqli($host, $user, $password, $db);
if ($cnx->connect_error)
	die('Connection failed: ' . $cnx->connect_error);

if(isset($_POST['ucid'], $_POST['password']))
{
	$ucid = $_POST['ucid'];
        $password = $_POST['password'];		//setting the recieved ucid and password to variables
	$enteredpass_hashed = hash('sha256', $password); //hashing the input password to compare to hashed password in db
}

$query1 = "Select password, role from School where ucid='$ucid'";
$result = mysqli_query($cnx, $query1) or die("BAD QUERY\n");
while($row = mysqli_fetch_array($result)) 
{
    $actual_pass=$row['password'];
    $db_role=$row['role'];
}					//checking and saving (in a variable) the password for the ucid in the db

if($enteredpass_hashed==$actual_pass) //comparing entered password to the password in db
{
	if($db_role=="professor")
	{
		$response = ['response' => 'professor'];
		echo json_encode($response);	//delivering it in json format {"response":"professor"}
	}
	else
	{
		$response = ['response' => 'student'];
		echo json_encode($response);	//delivering it in json format {"response":"student"}
	}
}
else
{
	
	$response = ['response' => 'FALSE'];
	echo json_encode($response);
}

//QuestionBank
if(isset($_POST['Question'], $_POST['Topic'], $_POST['Difficulty'], $_POST['Case1in'], $_POST['Case2in'], $_POST['Case1out'], $_POST['Case2out']))
{
	$query2 = "Select Question from Question_Bank";
	$result2 = mysqli_query($cnx, $query2) or die("BAD QUERY\n");
	while($row = mysqli_fetch_array($result2)) 
	{
		$Question_inputted=$row['Question'];
		echo "$Question_inputted"; //must change to json format
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
