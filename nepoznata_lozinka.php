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
        <form method="post" action="logout.php">
            <input type="submit" name="logout" value="Izloguj se">
        </form>
        <form method="post" action="">
            Korisničko ime:
            <input type="text" name="kor_ime" required><br/>
            <input type="submit" name="postavi_pitanje" value="Postavi mi pitanje">
        </form>
        <?php
        if(isset($_POST['postavi_pitanje'])){
            require 'dbConn.php';
            $kor_ime = $_POST['kor_ime'];
            $result = mysqli_query($conn, "select * from korisnici where kor_ime='$kor_ime'");
            if(mysqli_num_rows($result)>0){
                session_start();
                $_SESSION['kor_ime'] = $kor_ime;
                mysqli_close($conn);
                header('Location: nepoznata_lozinka_pitanje.php');
            }
            else{
                mysqli_close($conn);
                echo "Niste registrovani u sistem ili ste uneli pogrešno korisničko ime";
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
