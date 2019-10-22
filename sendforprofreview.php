<?php

$host = 'sql.njit.edu';
$user = 'mm947';
$password = 'Vt312oiK';
$db = 'mm947';

$cnx = new mysqli($host, $user, $password, $db);
if ($cnx->connect_error)
	die('Connection failed: ' . $cnx->connect_error);

if(isset($_POST['ucid'], $_POST['examid']))
{
	$ucid = $_POST['ucid'];
        $examid = $_POST['examid'];
	$query1 = "Select SUM(Results) from Stored_Exams where UCID='$ucid' and ExamID= '$examid'";
	$result1 = mysqli_query($cnx, $query1) or die("BAD QUERY\n");

    $query2 = "Select * from Stored_Exams where UCID='$ucid' and ExamID= '$examid'";
    $result2 = mysqli_query($cnx, $query2) or die("BAD QUERY\n");

    while($row = mysqli_fetch_array($result1)) 
    {
       $total[] = $row;
    }
	$Total=$total[0][0];

    while($row = mysqli_fetch_assoc($result2)) 
    {
       $Stored_Exams[] = $row;
    }
	$response = ["info" => $Stored_Exams, "overall_grade" => $Total];
	echo json_encode($response);
}
mysqli_close($cnx);
?>
