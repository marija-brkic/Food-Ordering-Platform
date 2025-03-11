<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
$id_rezervacije = $_POST['id_rezervacije'];
require 'dbConn.php';
$result = mysqli_query($conn, "update rezervacije set status='otkazana' where id='$id_rezervacije'");
if($result){
    mysqli_close($conn);
    header('Location:gost_rezervacije.php');
}

?>