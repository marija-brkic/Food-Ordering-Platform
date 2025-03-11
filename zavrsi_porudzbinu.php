<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require 'dbConn.php';
session_start();
$id_restorana = $_SESSION['id_restorana'];
$cena = $_SESSION['ukupna_cena'];
$kor_ime=$_SESSION['ulogovan'];
$jela = '';

foreach ($_SESSION['korpa'] as $id_jela => $kolicina) {
    $result = mysqli_query($conn, "select * from jelovnik where id='$id_jela'");
    $row = mysqli_fetch_assoc($result);
    $naziv = $row['naziv'];
    $jela = $jela.'Naziv: '.$naziv.', Kolicina: '.$kolicina.'  ';
}
date_default_timezone_set('Europe/Belgrade');
$vreme = date('Y-m-d H:i:s', time());
$result = mysqli_query($conn, "insert into dostave (id_restorana, datum_i_vreme, racun, kor_ime, jela) values ('$id_restorana', '$vreme', '$cena', '$kor_ime', '$jela')");

if($result){
    mysqli_close($conn);
    unset($_SESSION['korpa']);
    header("Location:detalji?id=$id_restorana");
}
else{
    echo "Neuspesna porudzbina";
}

?>