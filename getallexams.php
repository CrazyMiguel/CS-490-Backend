<?php
    $host = 'sql.njit.edu';
    $user = 'mm947';
    $password = 'Vt312oiK';
    $db = 'mm947';

    $cnx = new mysqli($host, $user, $password, $db);
    if ($cnx->connect_error)
        die('Connection failed: ' . $cnx->connect_error);

    $query1 = "Select * from Exams";
    $result1 = mysqli_query($cnx, $query1) or die("BAD QUERY\n");

    while($row = mysqli_fetch_assoc($result1)) 
    {
       $Question_inputted[] = $row;
    }
    echo json_encode($Question_inputted);

    mysqli_close($cnx);

?>
