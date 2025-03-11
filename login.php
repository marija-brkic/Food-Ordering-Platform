<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
date_default_timezone_set('Europe/Belgrade');
require 'dbConn.php';
$ime = $_POST['ime'];
$lozinka = $_POST['lozinka'];
$kriptovana_lozinka = md5($lozinka);
global $conn;
$result = mysqli_query($conn, "select * from korisnici where kor_ime = '$ime' and lozinka = '$kriptovana_lozinka'");
if(mysqli_num_rows($result)>0){
    $row = mysqli_fetch_assoc($result);
    if($row['tip']=='gost'){
        $result1 = mysqli_query($conn, "select * from gosti where kor_ime='$ime'");
        $row1 = mysqli_fetch_assoc($result1);
        if($row1['aktivnost']=='aktivan'){
            session_start();
            $_SESSION['ulogovan'] = $ime;
            header('Location: gost.php');
        }
        else{
            echo 'Blokirani ste!';
        }
    }
    else if($row['tip']=='konobar'){
        $result1 = mysqli_query($conn, "select * from konobari where kor_ime='$ime'");
        $row1 = mysqli_fetch_assoc($result1);
        if($row1['aktivnost']=='aktivan'){
            session_start();
            $_SESSION['ulogovan'] = $ime;
            header('Location: konobar.php');
        }
        else{
            echo 'Blokirani ste!';
        }
    }
    else{
        echo "Prijaviti se na posebnom linku za administratore.";
    }
}
else{
    echo "<span style='color:red'>Losi podaci</span>";
}
mysqli_free_result($result);
mysqli_close($conn);
?>

