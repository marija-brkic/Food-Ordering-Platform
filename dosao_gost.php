<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
date_default_timezone_set('Europe/Belgrade');
$id_rezervacije = $_POST['id_rezervacije'];
require 'dbConn.php';
$result = mysqli_query($conn, "update rezervacije set status='dosao' where id='$id_rezervacije'");
if($result){
    mysqli_close($conn);
    header('Location: konobar_rezervacije.php');
}

?>