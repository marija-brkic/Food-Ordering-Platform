<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
require 'dbConn.php';
$kor_ime = $_POST['kor_ime'];
$result = mysqli_query($conn, "update gosti set aktivnost='aktivan' where kor_ime='$kor_ime'");
if($result){
    mysqli_close($conn);
    header('Location: administrator.php');
}

?>