<?php
    include_once 'conn.php';
    header("Refresh:30");
    
    $currentdatetime = date('Y-m-d H:i:s');
    
    $selectquery = "Select id, ip, hostname, sn 
                    From totem";    //row['']
    $result = $conn -> query($selectquery);

    if ($result -> num_rows > 0)
    {
        while ($row = $result -> fetch_assoc())
        {
            $pingret = exec("ping -n 1 $row[ip]", $output);            

            if (strpos($pingret, 'perda')) {
                $status = 0;
                
                $checkstatus = "Select status 
                                From ping 
                                Where idtotem = " . $row['id'];
                $checkstatusresult = $conn -> query($checkstatus);  //row2['']
                
                while ($row2 = $checkstatusresult -> fetch_assoc())
                {
                    if ($row2['status'] != $status)
                    {
                        $updatequery = "Update `ping` 
                                        Set `status` = $status, `time` = '$currentdatetime' 
                                        Where idtotem = " . $row['id'];
                        $updatepingresult = $conn -> query($updatequery);
                        if($updatepingresult)
                        {
                            $checkstatuscontent = "<span style = 'color: yellow;'> changed</span>";
                        }
                        else
                        {
                            echo 'error updating status entry' . $conn -> error;
                        }
                    }
                    else
                    {
                        $checkstatuscontent = "<span style = 'color: rgb(48, 200, 100);'> same </span>";
                        //do nothing
                    }
                }

                //ob_start();
                //include 'checkstatus.php';
                //$checkstatuscontent = ob_get_clean();
            
                echo "<p style = 'color: red;'>ID: " . $row["id"] . "  --  IP: " . $row["ip"] . " -- Hostname: " . $row["hostname"] . " -- Serial Number: " . $row["sn"] . " - STATUS: DOWN (" . $checkstatuscontent . ")</p>";
            }
            else
            {
                $status = 1;
                
                $checkstatus = "Select status 
                                From ping 
                                Where idtotem = " . $row['id'];
                $checkstatusresult = $conn -> query($checkstatus);

                while ($row2 = $checkstatusresult -> fetch_assoc())
                {
                    //echo "<br> status: " . $row2['status'] . "<br>";
                    if ($row2['status'] != $status)
                    {
                        $updatequery = "Update `ping` 
                                        Set `status` = $status, `time` = '$currentdatetime' 
                                        Where idtotem = " . $row['id'];
                        $updatepingresult = $conn -> query($updatequery);
                        if($updatepingresult)
                        {
                            $checkstatuscontent = "<span style = 'color: yellow;'> changed</span>";
                        }
                        else
                        {
                            echo 'error updating status entry' . $conn -> error;
                        }
                    }
                    else
                    {
                        $checkstatuscontent = "<span style = 'color: rgb(48, 200, 100);'> same </span>";
                        //do nothing
                    }
                }

                //ob_start();
                //include 'checkstatus.php';
                //$checkstatuscontent = ob_get_clean();
            
                echo "<p> ID: " . $row["id"] . "  --  IP: " . $row["ip"] . " -- Hostname: " . $row["hostname"] . " -- Serial Number: " . $row["sn"] . " - STATUS: UP (" . $checkstatuscontent . ")</p>";
            }

        }
    }
    else
    {
        //nada
        //echo "0 results";
    }









    //{
    //    //echo 'FUCKING HELL';
    //    if ($row2['status'] != $status)
    //    {
    //        if ($row2['status'] == 0)
    //        {
    //            echo 'changed to 1';
    //            $updatequery1 = "Update `ping` Set `status` = 1, `time` = '$currentdatetime' Where idtotem = " . $row['id'];
    //            $result3 = $conn -> query($updatequery1);
    //        }
    //        elseif ($row2['status'] == 1)
    //        {
    //            echo 'changed to 0';
    //            $updatequery0 = "Update `ping` Set `status` = 0, `time` = '$currentdatetime' Where idtotem = " . $row['id'];
    //            $result3 = $conn -> query($updatequery0);
    //        }
    //        else
    //        {
    //            echo 'new entry';
    //            //$insertquery = "Insert Into `ping`(`id`, `idtotem`, `status`, `time`) Values ('', " . $row['id'] . ", $status, '" . $currentdatetime . "')";
    //            $result3 = $conn -> query($insertquery);
    //        }
    //    }
    //    
    //}



?>