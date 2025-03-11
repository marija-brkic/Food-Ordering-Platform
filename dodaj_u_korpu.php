<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
date_default_timezone_set('Europe/Belgrade');
session_start();

$id_jela = $_POST['id_jela'];
$kolicina = $_POST['kolicina'];

if (!isset($_SESSION['korpa'])) {
    $_SESSION['korpa'] = array();
}

if (isset($_SESSION['korpa'][$id_jela])) {
    $_SESSION['korpa'][$id_jela] += $kolicina;
} else {
    $_SESSION['korpa'][$id_jela] = $kolicina;
}

$id_restorana = $_SESSION['id_restorana'];
header("Location:detalji?id=$id_restorana");

?>