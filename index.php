<!DOCTYPE html>
<html>
    
    <head>
        <title>YEAH!</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    
        <style>
            table
            {
                border-collapse: collapse;
                width: 100%;
            }
            th, td
            {
                text-align: center;
                border: 1px solid gray;
                padding: 8px;
            }
        </style>    
    </head>
 
    <body>                                                                                          <center> <?php echo date('Y-m-d H:i:s'); header("Refresh:10");?> </center>
        <form action="insert.php" method="post">
            <p>
                <label for="ip">IP:</label>
                <input type="text" name="ip" id="ip">
            </p>
            <p>
                <label for="hostname">Hostname:</label>
                <input type="text" name="hostname" id="hostname">
            </p>
            <p>
                <label for="sn">Serial Number:</label>
                <input type="text" name="sn" id="sn">
            </p>
            <p>
                <label for="location">Location:</label>
                <input type="text" name="location" id="location">
            </p>

            <input type="submit" value="Submit">
        </form>

        <p>.............................................................................................................................................................................................................................................................................................................................................................................................................................................................................................</p>

<?php
            include_once 'conn.php';           

            $exhibitquery = "SELECT t.ip, t.hostname, t.sn, t.location, p.status, p.time
                                 FROM totem t
                                 JOIN ping p ON t.id = p.idtotem 
                                 Order by 4";
            
            $exhibitresult = $conn -> query($exhibitquery);

            if($exhibitresult)
            {
                ?>

                <table>
                    <thead>
                        <tr>
                            <!--<th>Totem ID</th>-->
                            <th>Location</th>
                            <th>Hostname</th>
                            <th>IP</th>
                            <th>Serial Number</th>
                            <th>Status</th>
                            <th>Last Update</th>
                        </tr>
                    </thead>
                    <tbody>

                <?php
                while ($exhibitrows = $exhibitresult -> fetch_assoc())
                {
                    //echo $exhibitrows["id"] . "  --  " . $exhibitrows["ip"] . "  --  " . $exhibitrows["hostname"] . "  --  " . $exhibitrows["sn"] . "  --  " . $exhibitrows["status"] . "  --  " . $exhibitrows["time"] . "<br>";
                    if($exhibitrows['status'] == 0)
                                {
                                    $statuscolor = "<span style = 'color: red;'> DOWN</span>";
                                }
                                else
                                {
                                    $statuscolor = "<span style = 'color: rgb(48, 200, 100);'> UP</span>";
                                }
                    
                    echo "  <tr>
                                <td>" . $exhibitrows['location'] . "</td>
                                <td>" . $exhibitrows['hostname'] . "</td>
                                <td>" . $exhibitrows['ip'] . "</td>
                                <td>" . $exhibitrows['sn'] . "</td>
                                <td>" . $statuscolor . "</td>
                                <td>" . $exhibitrows['time'] . "</td>                                
                            </tr>";


                }
            }
            else
            {
                    echo 'err: ' . $conn -> error;
                }
                
                

                //while ($row = $result -> fetch_assoc())
                //    {
                //        echo "  <tr>
                //                    <td>'q'</td>
                //                    <td>'w'</td>
                //                    <td>'e'</td>
                //                </tr>";
                //    }
?>
            </tbody>
        </table>


    </body>
</html>