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

