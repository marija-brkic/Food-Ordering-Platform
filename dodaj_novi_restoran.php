<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="izgled_stranice.css">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 header"></div>
            </div>
            <div class="row">
                <div class="col-sm-12 message">
                    Kutak dobre hrane
                </div>
            </div>
        <div class="row center1">
        <div class="col-sm-10 menu">
        <form method="post" action="logout.php" >
            <input type="submit" name="logout" value="Izloguj se">
        </form>
            <form method="post" action="administrator.php" >
            <input type="submit" name="logout" value="Vrati se na pocetnu stranu">
        </form>
        <hr/>
        <h2>Dodavanje novog restorana:</h2>
        <form method="post" action="">
            Naziv: <input type='text' name='naziv' required><br/>
            Adresa: <input type='text' name='adresa' required><br/>
            Tip: <select name='tip' required>
                <option value='domaca kuhinja'>Domaca kuhinja</option>
                <option value='kineski'>Kineski</option>
                <option value='indijski'>Indijski</option>
                <option value='japanski'>Japanski</option>
            </select>
            <br/>
            Kontakt osoba: <input type='text' name='kontakt_osoba' required><br/>
            Telefon:<input type='text' name='telefon' required><br/>
            Pocetak radnog vremena:<input type='time' name='pocetak_radnog_vremena' required><br/>
            Kraj radnog vremena:<input type='time' name='kraj_radnog_vremena' required><br/>
            Opis:<textarea name='opis' required></textarea><br/>
            Broj stolova: <input type='number' name='broj_stolova' min="1" required><br/>
            <input type="submit" name="dodaj" value="Dodaj">
            
        </form>
        <?php 
        date_default_timezone_set('Europe/Belgrade');
        if(isset($_POST['dodaj'])){
        require 'dbConn.php';
        $naziv = $_POST['naziv'];
        $adresa = $_POST['adresa'];
        $tip = $_POST['tip'];
        $kontakt_osoba = $_POST['kontakt_osoba'];
        $telefon = $_POST['telefon'];
        $pocetak_radnog_vremena = $_POST['pocetak_radnog_vremena'];
        $kraj_radnog_vremena = $_POST['kraj_radnog_vremena'];
        $opis = $_POST['opis'];
        $broj_stolova = $_POST['broj_stolova'];
        $prosecna_ocena = 0;
        $broj_ocena = 0;
        
        $result = mysqli_query($conn, "insert into restorani (naziv, adresa, tip, kontakt_osoba, telefon, pocetak_radnog_vremena, kraj_radnog_vremena, opis, broj_stolova, prosecna_ocena, broj_ocena) values ('$naziv', '$adresa', '$tip', '$kontakt_osoba', '$telefon', '$pocetak_radnog_vremena', '$kraj_radnog_vremena', '$opis', '$broj_stolova', '$prosecna_ocena', '$broj_ocena')");
        if($result){
            $result1 = mysqli_query($conn, "select * from restorani order by id desc");
            $row1 = mysqli_fetch_assoc($result1);
            $id_restorana = $row1['id'];
            session_start();
            $_SESSION['id_restorana'] = $id_restorana;
            $_SESSION['broj_stolova'] = $broj_stolova;
            mysqli_close($conn);
            header('Location: dodaj_stolove.php');
            
        }
        }
        
        ?>
        
        </div>
        </div>
        <div class="row">
            <div class="col-sm-12 footer">Copyright 2024</div>
        </div>
        </div>
    </body>
</html>


<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

