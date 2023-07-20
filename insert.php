<html>
<body>
<center>


<?php
    include_once 'conn.php';
    $currentdatetime = date('Y-m-d H:i:s');

    $hostname = $_REQUEST['hostname'];
    $ip =  $_REQUEST['ip'];
    $sn =  $_REQUEST['sn'];
    $location =  $_REQUEST['location'];


    $newtotemquery =    "Insert Into totem 
                         Values ('','$ip','$hostname','$sn', '$location')";

    $selectnewtotemquery =    "Select id
                               From totem 
                               Where sn = " . $sn;
    
    $newtotem = $conn->query($newtotemquery);
    
    if ($newtotem)
    {
        $selectnewtotem = $conn->query($selectnewtotemquery);
        
        if ($selectnewtotem)
        {
            while ($row = $selectnewtotem->fetch_assoc())
            {
                $newpingquery =    "Insert Into `ping`(`id`, `idtotem`, `status`, `time`) 
                                    Values ('', " . $row['id'] . ", " . 0 . ", '" . $currentdatetime . "')";

                $insertping = $conn->query($newpingquery);

                if ($insertping)
                {
                    echo "Totem added successfully!";
                }
                else
                {
                    echo "Error inserting ping data: " . $conn->error;
                }
            }
        }
        else
        {
            echo "Error selecting totem data: " . $conn->error;
        }
    }
    else
    {
        echo "Error inserting totem data: " . $conn->error;
    }

    





//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //if ($result)
    //{
    //    while ($row = $result -> fetch_assoc())
    //    {
    //        echo "<br><br>ID: " . $row["id"] . "  --  IP: " . $row["ip"] . " -- Hostname: " . $row["hostname"] . " -- Serial Number: " . $row["sn"] . "<br>";
    //    }
    //}
    //else 
    //{
    //    echo 'nada';//nada
    //}
           
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    //$statusentry =      "Insert Into ping   Values ('', " . $id . ", 0, '" . $currentdatetime . "')";

    //if(mysqli_query($conn, $newtotemquery))
    //{
    //    echo "👍🏻";
    //    header("Refresh:2; url=index.php");
    //    echo nl2br("\n$first_name\n $last_name\n " . "$gender\n $address\n $email");
    //}
    //else
    //{
    //    echo "👎🏻 $newtotemquery. " . mysqli_error($conn);
    //}

    header("Refresh:2; url=index.php");
?>


<p> Redirecting to main page... </p>


</center>
</body>
</html>