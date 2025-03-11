<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
$conn = mysqli_connect('localhost', 'root', '', 'kutak_dobre_hrane');
if(mysqli_connect_error()){
    echo "Bad data";
    exit();
}
?>