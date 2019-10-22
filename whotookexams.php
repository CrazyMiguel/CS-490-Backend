<?php

$host = 'sql.njit.edu';
$user = 'mm947';
$password = 'Vt312oiK';
$db = 'mm947';

$cnx = new mysqli($host, $user, $password, $db);
if ($cnx->connect_error)
	die('Connection failed: ' . $cnx->connect_error);

    $query2 = "Select UCID,EXAMID from Review";
    $result2 = mysqli_query($cnx, $query2) or die("BAD QUERY\n");

    while($row = mysqli_fetch_assoc($result2)) 
    {
       $taken_exams[] = $row;
    }
    echo json_encode($taken_exams);

mysqli_close($cnx);
?>
