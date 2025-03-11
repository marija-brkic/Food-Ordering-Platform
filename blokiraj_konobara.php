<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
date_default_timezone_set('Europe/Belgrade');
require 'dbConn.php';
$kor_ime = $_POST['kor_ime'];
$result = mysqli_query($conn, "update konobari set aktivnost='blokiran' where kor_ime='$kor_ime'");
if($result){
    mysqli_close($conn);
    header('Location: administrator.php');
}

?>