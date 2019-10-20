<?php

$host = 'sql.njit.edu';
$user = 'mm947';
$password = 'Vt312oiK';
$db = 'mm947';

$cnx = new mysqli($host, $user, $password, $db);
if ($cnx->connect_error)
	die('Connection failed: ' . $cnx->connect_error);

if(isset($_POST['examid']))
{
	$examid = $_POST['examid'];
}

$query1 = "UPDATE Exams SET Released='1' WHERE ExamID=$examid";
$result = mysqli_query($cnx, $query1) or die("BAD QUERY\n");

mysqli_close($cnx);
?>
