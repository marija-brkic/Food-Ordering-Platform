<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
date_default_timezone_set('Europe/Belgrade');
session_start();

$id_jela = $_POST['id_jela'];
$nova_kolicina = $_POST['nova_kolicina'];

if ($nova_kolicina > 0) {
    $_SESSION['korpa'][$id_jela] = $nova_kolicina;
} else {
    unset($_SESSION['korpa'][$id_jela]);
}

header("Location: pregled_korpe.php");
?>