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
        <?php
        require 'dbConn.php';
        $result = mysqli_query($conn, "select * from registracije where status_registracije='neobradjena'");
        
        ?>
        <table>
            <tr>
                <th>Korisnicko ime:</th>
                <th>Prihvati:</th>
                <th>Odbij:</th>
                
            </tr>
                
                <?php
                   
                    if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_assoc($result)){
                            ?>
            <tr>
                <td><?php echo $row['kor_ime']?></td>
            <form method="post" action="">
                <td>
                    <input type="hidden" name="id_registracije" value="<?php echo $row['id_registracije']?>">
                    <input type="submit" name="prihvati" value="Prihvati">
                </td>
            </form>
            <form method="post" action="">
                <td>
                    <input type="hidden" name="id_registracije" value="<?php echo $row['id_registracije']?>">
                    <input type="submit" name="odbij" value="Odbij">
                </td>
            </form>
            </tr>
                        <?php
                        
                        }
                    }
            ?>
        </table>
        <?php
        if(isset($_POST['prihvati'])){
            $id_registracije = $_POST['id_registracije'];
            $result4 = mysqli_query($conn, "select * from registracije where id_registracije='$id_registracije'");
            $row4 = mysqli_fetch_assoc($result4);
            
            $kor_ime = $row4['kor_ime'];
            $lozinka = $row4['lozinka'];
            $bezbedonosno_pitanje = $row4['bezbedonosno_pitanje'];
            $bezbedonosni_odgovor = $row4['bezbedonosni_odgovor'];
            $ime = $row4['ime'];
            $prezime = $row4['prezime'];
            $pol = $row4['pol'];
            $adresa = $row4['adresa'];
            $kontakt_telefon = $row4['kontakt_telefon'];
            $email = $row4['email'];
            $profilna_slika = $row4['profilna_slika'];
            $broj_kreditne_kartice = $row4['broj_kreditne_kartice'];
            $result1 = mysqli_query($conn, "update registracije set status_registracije='prihvacena' where id_registracije='$id_registracije'");
            $result2 = mysqli_query($conn, "insert into korisnici (kor_ime, lozinka, bezbedonosno_pitanje, bezbedonosni_odgovor, ime, prezime, pol, adresa, kontakt_telefon, email, profilna_slika, tip) values ('$kor_ime', '$lozinka', '$bezbedonosno_pitanje', '$bezbedonosni_odgovor', '$ime', '$prezime', '$pol', '$adresa', '$kontakt_telefon', '$email', '$profilna_slika', 'gost')");
            $result3 = mysqli_query($conn, "insert into gosti (kor_ime, broj_kreditne_kartice, aktivnost, broj_kasnjenja) values ('$kor_ime', '$broj_kreditne_kartice', 'aktivan', '0')");
            if($result1 && $result2 && $result3){
                mysqli_close($conn);
                header('Location: obrada_registracija.php');
            }
        }
        if(isset($_POST['odbij'])){
            $id_registracije = $_POST['id_registracije'];
            $result1 = mysqli_query($conn, "update registracije set status_registracije='odbijena' where id_registracije='$id_registracije'");
            if($result1){
                mysqli_close($conn);
                header('Location: obrada_registracija.php');
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
