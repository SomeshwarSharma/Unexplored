<?php
include "includes/dbhandler.php";




                $sql9 = "SELECT P_id FROM `post` where P_head = 'badaam' ";
                $result9 = $conn->query($sql9);
                
                $data9 = $result9->fetch_assoc();
                echo $data9['P_id'];
                ?>
