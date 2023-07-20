<body style="color:rgb(48, 200, 100); background-color:rgb(21, 30, 35)">
<?php  

    global $mysqli;

    $host = "localhost";
    $db = "eee";
    $user = "root";
    $pass = "";
        
    $conn = new mysqli($host, $user, $pass, $db) or die ("not ok... :(");
    if ($conn -> connect_errno)
    {
        echo "not ok :: " . $conn -> connect_errno . " - " . $conn -> connect_error;
    }

    else
    {
        //nada
    }
?>