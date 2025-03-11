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
        date_default_timezone_set('Europe/Belgrade');
        if(isset($_POST['kor_ime'])){
            $kor_ime = $_POST['kor_ime'];
            session_start();
            $_SESSION['kor_ime'] = $kor_ime;
        }
        else{
            session_start();
            $kor_ime = $_SESSION['kor_ime'];
        }
        
        require 'dbConn.php';
        $result = mysqli_query($conn, "select * from korisnici where kor_ime='$kor_ime'"); #reci cu da nema potrebe za proverom da li postoji jer smo ovde dosli nakon te provere
        $result1 = mysqli_query($conn, "select * from gosti where kor_ime='$kor_ime'");
        $row = mysqli_fetch_assoc($result);
        $row1 = mysqli_fetch_assoc($result1);
        ?>
        <form method="post" action="" enctype="multipart/form-data">
        <table>
            <tr>
                <th>Ime:</th>
                <td><?php echo $row['ime']?></td>
                <td><input type="text" name="ime"></td>
                <td><input type="submit" name="azuriraj_ime" value="Azuriraj"></td>
            </tr>
            <tr>
                <th>Prezime:</th>
                <td><?php echo $row['prezime']?></td>
                <td><input type="text" name="prezime"></td>
                <td><input type="submit" name="azuriraj_prezime" value="Azuriraj"></td>
            </tr>
            <tr>
                <th>Adresa:</th>
                <td><?php echo $row['adresa']?></td>
                <td><input type="text" name="adresa"></td>
                <td><input type="submit" name="azuriraj_adresu" value="Azuriraj"></td>
            </tr>
            <tr>
                <th>Email:</th>
                <td><?php echo $row['email']?></td>
                <td><input type="text" name="email"></td>
                <td><input type="submit" name="azuriraj_email" value="Azuriraj"></td>
            </tr>
            <tr>
                <th>Telefon:</th>
                <td><?php echo $row['kontakt_telefon']?></td>
                <td><input type="text" name="telefon"></td>
                <td><input type="submit" name="azuriraj_telefon" value="Azuriraj"></td>
            </tr>
            <tr>
                <th>Broj kreditne kartice:</th>
                <td><?php echo $row1['broj_kreditne_kartice']?></td>
                <td><input type="text" name="kartica"></td>
                <td><input type="submit" name="azuriraj_karticu" value="Azuriraj"></td>
            </tr>
            <tr>
                <th>Slika:</th>
                <td><img src=<?php echo $row['profilna_slika']?> alt="Profilna slika"></td>
                <td><input type="file" name="profilna_slika"></td>
                <td><input type="submit" name="azuriraj_sliku" value="Azuriraj"></td>
            </tr>
        </table>
        </form>
        <?php
        require 'dbConn.php';
        if(isset($_POST['azuriraj_ime'])){
            $ime = $_POST['ime'];
            $result = mysqli_query($conn, "update korisnici set ime='$ime' where kor_ime='$kor_ime'");
            if($result){
                mysqli_close($conn);
                header('Location: azuriraj_gosta.php');
            }
            else{
                echo "Greska pri azuriranju";
            }
        }
        if(isset($_POST['azuriraj_prezime'])){
            $prezime = $_POST['prezime'];
            $result = mysqli_query($conn, "update korisnici set prezime='$prezime' where kor_ime='$kor_ime'");
            if($result){
                mysqli_close($conn);
                header('Location: azuriraj_gosta.php');
            }
            else{
                echo "Greska pri azuriranju";
            }
        }
        if(isset($_POST['azuriraj_adresu'])){
            $adresa = $_POST['adresa'];
            $result = mysqli_query($conn, "update korisnici set adresa='$adresa' where kor_ime='$kor_ime'");
            if($result){
                mysqli_close($conn);
                header('Location: azuriraj_gosta.php');
            }
            else{
                echo "Greska pri azuriranju";
            }
        }
        if(isset($_POST['azuriraj_email'])){
            $email = $_POST['email'];
            $result1 = mysqli_query($conn, "select * from registracije where email='$email'");
            $result2 = mysqli_query($conn, "select * from korisnici where kor_ime!='$kor_ime' and email='$email'");
            if(mysqli_num_rows($result1)>0 || mysqli_num_rows($result2)>0){
                echo "Zauzet email!";
            }
            else{
                $result = mysqli_query($conn, "update korisnici set email='$email' where kor_ime='$kor_ime'");
                if($result){
                    mysqli_close($conn);
                    header('Location: azuriraj_gosta.php');
                }
                else{
                    echo "Greska pri azuriranju";
                }
            }
        }
        if(isset($_POST['azuriraj_telefon'])){
            $telefon = $_POST['telefon'];
            $result = mysqli_query($conn, "update korisnici set kontakt_telefon='$telefon' where kor_ime='$kor_ime'");
            if($result){
                mysqli_close($conn);
                header('Location: azuriraj_gosta.php');
            }
            else{
                echo "Greska pri azuriranju";
            }
        }
        if(isset($_POST['azuriraj_karticu'])){
            $kartica = $_POST['kartica'];
            if(!preg_match('/^\d{16}$/', $kartica)){
                echo "Loše unet broj kreditne kartice";
            }
            else{
                $result = mysqli_query($conn, "update gosti set broj_kreditne_kartice='$kartica' where kor_ime='$kor_ime'");
                if($result){
                    mysqli_close($conn);
                    header('Location: azuriraj_gosta.php');
                }
                else{
                    echo "Greska pri azuriranju";
                }   
            }
        }
        if(isset($_POST['azuriraj_sliku'])){
            $default_image = 'uploads/default_image.png';
            $profilna_slika = $default_image;
            if($_FILES['profilna_slika']["error"] == 0) {
                $allowed_types = ['image/jpeg', 'image/png'];
        
                $image_type = $_FILES['profilna_slika']['type'];
    
        
                if (!in_array($image_type, $allowed_types)) {
                    echo "Profilna slika mora biti u JPG ili PNG formatu." ;
                }
                else{
                    $image_info = getimagesize($_FILES['profilna_slika']["tmp_name"]);
                    $image_width = $image_info[0];
                    $image_height = $image_info[1];

                    if ($image_width < 100 || $image_height < 100 || $image_width > 300 || $image_height > 300) {
                        echo "Dimenzije profilne slike moraju biti između 100x100 i 300x300 piksela.";
                    }
                    else{
                        $profilna_slika = 'uploads/' . basename($_FILES["profilna_slika"]["name"]);
                
                        if (!move_uploaded_file($_FILES["profilna_slika"]["tmp_name"], $profilna_slika)) {
                            echo "Greška prilikom postavljanja profilne slike.";
                        }
                        else{
                            $result = mysqli_query($conn, "update korisnici set profilna_slika='$profilna_slika' where kor_ime='$kor_ime'");
                            if($result){
                                mysqli_close($conn);
                                header('Location: azuriraj_gosta.php');
                            }
                            else{
                                echo "Greska pri azuriranju";
                            }
                        }
                    }
                }   
            }
            else{
                $result = mysqli_query($conn, "update korisnici set profilna_slika='$profilna_slika' where kor_ime='$kor_ime'");
                if($result){
                    mysqli_close($conn);
                    header('Location: azuriraj_gosta.php');
                }
                else{
                    echo "Greska pri azuriranju";
                }   
            }
        }
        mysqli_close($conn);
        ?>
        </div>
        </div>
        <div class="row">
            <div class="col-sm-12 footer">Copyright 2024</div>
        </div>
        </div>
    </body>
</html>
