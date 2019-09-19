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
        $password = $_POST['password'];
	$enteredpass_hashed = hash('sha256', $password);
}
//else
//{
//	echo "FALSE";
//}

$query1 = "Select password from School where ucid='$ucid'";
$result = mysqli_query($cnx, $query1) or die("BAD QUERY\n");
while($row = mysqli_fetch_array($result)) 
{
    $actual_pass=$row['password'];
}

if($enteredpass_hashed==$actual_pass)
{
	echo "TRUE";
}
else
{
	echo "FALSE";
}

//The middle end now needs to checks the front ends entry of username against my database if the name does exist
//must dehash my hashed password and then compare my password against the front ends entered password.
?>
