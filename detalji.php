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
        <form method="post" action="index.php" >
            <input type="submit" name="logout" value="Izloguj se">
        </form>
            <form method="post" action="gost.php" >
            <input type="submit" name="logout" value="Vrati se na profil">
        </form>
        <form method="post" action="gost_restorani.php" >
            <input type="submit" name="logout" value="Vrati se na sve restorane">
        </form>
        <?php 
        date_default_timezone_set('Europe/Belgrade');
        $id_restorana = $_GET['id'];
        session_start();
        $_SESSION['id_restorana'] = $id_restorana;
        require 'dbConn.php';
        $result = mysqli_query($conn, "select * from restorani where id='$id_restorana'");
        $result1 = mysqli_query($conn, "select * from komentari where id_restorana='$id_restorana'");
        $row = mysqli_fetch_assoc($result);
        ?>
            <h2>Restoran: <?php echo $row['naziv']?></h2>
        <?php     
        echo 'Adresa: '.$row['adresa'].'<br>';
        echo 'Tip restorana: '.$row['tip'].'<br>';
        echo 'Telefon: '.$row['telefon'].'<br>';
        echo 'Komentari:<br>';
        if(mysqli_num_rows($result1)>0){
            while($row1 = mysqli_fetch_assoc($result1)){
                echo $row1['komentar'].'<br>';
            }
        }
        mysqli_free_result($result);
        mysqli_close($conn);
        ?>
            <hr/>
            <h3>Rezervacija:</h3>
            <form method="post" axtion="">
                Datum i vreme:
                <input type="datetime-local" name="vreme" required>
                <br/>
                Broj osoba:
                <input type="number" name="br_osoba" required>
                <br/>
                Dodatni zahtevi:
                <textarea name="dodatni_zahtevi"></textarea>
                <br/>
                <input type="submit" name="rezervisi" value="Rezervisi">
            </form>
        <?php
        require 'dbConn.php';
        if(isset($_POST['rezervisi'])){
            $vreme = $_POST['vreme'];
            $br_osoba = $_POST['br_osoba'];
            $dodatni_zahtevi = $_POST['dodatni_zahtevi'];
            if($br_osoba < 1){
                echo "Uneli ste neispravan broj gostiju.";
            }
            else{
                $result = mysqli_query($conn, "select * from restorani where id='$id_restorana'");
                $row = mysqli_fetch_assoc($result);
                $pocetno_vreme = $row['pocetak_radnog_vremena'];
                $krajnje_vreme = $row['kraj_radnog_vremena'];
                $vreme_rezervacije = date('H:i:s', strtotime($vreme));
                $dan_rezervacije = date('Y-m-d', strtotime($vreme));
                $kraj_minus_3h = date('H:i:s', strtotime($krajnje_vreme) - 3 * 3600);
                if($vreme_rezervacije>=$pocetno_vreme && $vreme_rezervacije<=$kraj_minus_3h){
                    $result1 = mysqli_query($conn, "select * from stolovi where id_restorana='$id_restorana' and max_ljudi>='$br_osoba'");
                    if(mysqli_num_rows($result1)==0){
                        echo "Nemamo dostupne stolove za taj broj ljudi";
                    }
                    else{
                        $flag = 0;
                        while($row1 = mysqli_fetch_assoc($result1)){
                            $id_stola = $row1['id'];
                            $result2 = mysqli_query($conn, "select * from rezervacije where id_stola='$id_stola' and date(datum_i_vreme)='$dan_rezervacije' and time(datum_i_vreme) between time(date_sub('$vreme', interval 3 hour)) and time(date_add('$vreme', interval 3 hour)) and (status!='nije dosao' and status!='otkazana')");
                            if(mysqli_num_rows($result2)==0){
                                $kor_ime = $_SESSION['ulogovan'];
                                $result3 = mysqli_query($conn, "insert into rezervacije (id_restorana, datum_i_vreme, broj_osoba, specijalni_zahtevi, kor_ime, id_stola) values ('$id_restorana', '$vreme', '$br_osoba', '$dodatni_zahtevi', '$kor_ime', '$id_stola')");
                                if($result3){
                                    echo "Vasa rezervacija je zabelezena";
                                    $flag = 1;
                                    break;
                                }
                            }
                        }
                        if($flag == 0){
                            echo "Nemamo dostupne stolove za taj broj ljudi u to vreme";
                        }
                    }
                }
                else{
                    echo "Restoran ne radi u izabrano vreme.";
                }
            }
        }
        ?>
        <hr/>
        <h3>Jelovnik:</h3>
        <table>
            <tr>
                <th>Naziv</th>
                <th>Sastojci</th>
                <th>Cena</th>
                <th>Slika</th>
                <th>Kolicina</th>
                <th>Dodaj u korpu</th>
            </tr>
        <?php
        $res = mysqli_query($conn, "select * from jelovnik where id_restorana='$id_restorana'");
        if(mysqli_num_rows($res)>0){
            while($row2 = mysqli_fetch_assoc($res)){
                ?>
            <form method="post" action="dodaj_u_korpu.php">
            <tr>
                <td><?php echo $row2['naziv'];?></td>
                <td><?php echo $row2['sastojci'];?></td>
                <td><?php echo $row2['cena'];?></td>
                
                <td><img src=<?php echo $row2['slika']?> alt="Slika" width="50" height="50"></td>
                <td><input type="number" name="kolicina" min="1" required></td>
                
                <input type='hidden' name='id_jela' value='<?php echo $row2['id'];?>'>
                <td><input type="submit" name="dodaj_u_korpu" value="Dodaj u korpu"></td>
                </tr>
            </form>  
                <?php
            }
        }
        mysqli_close($conn);
        ?>
        </table>
        <form method="post" action="pregled_korpe.php" >
            <input type="submit" name="pregled_korpe" value="Pregled korpe">
        </form>
        </div>
        </div>
        <div class="row">
            <div class="col-sm-12 footer">Copyright 2024</div>
        </div>
        </div>
    </body>
</html>
