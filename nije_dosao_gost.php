<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
$id_rezervacije = $_POST['id_rezervacije'];
require 'dbConn.php';
$result = mysqli_query($conn, "update rezervacije set status='nije dosao' where id='$id_rezervacije'");
$result1 = mysqli_query($conn, "select * from rezervacije where id='$id_rezervacije'");
$row1=mysqli_fetch_assoc($result1);
$kor_ime = $row1['kor_ime'];
$result2 = mysqli_query($conn, "select * from gosti where kor_ime='$kor_ime'");
$row2=mysqli_fetch_assoc($result2);
$br_kasnjenja = $row2['broj_kasnjenja'] + 1;
if($br_kasnjenja == 3){
    $result3 = mysqli_query($conn, "update gosti set broj_kasnjenja='$br_kasnjenja', aktivnost='blokiran' where kor_ime='$kor_ime'");
    if($result && $result3){
        mysqli_close($conn);
        header('Location: konobar_rezervacije.php');
    }
}
else{
    $result3 = mysqli_query($conn, "update gosti set broj_kasnjenja='$br_kasnjenja' where kor_ime='$kor_ime'");
    if($result && $result3){
        mysqli_close($conn);
        header('Location: konobar_rezervacije.php');
    }
}

?>