<?php

include 'includes/dbhandler.php';

$m_id = $_GET['id'];

$sql = " DELETE FROM menu WHERE m_id = $m_id ";

mysqli_query($conn, $sql);


mysqli_close($conn);

header('location:addmenu.php');
?>