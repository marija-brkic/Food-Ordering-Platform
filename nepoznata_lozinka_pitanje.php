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
        <?php
            require 'dbConn.php';
            session_start();
            $kor_ime = $_SESSION['kor_ime'];
            $result = mysqli_query($conn, "select * from korisnici where kor_ime='$kor_ime'");
            $row = mysqli_fetch_assoc($result);
            echo $row['bezbedonosno_pitanje'];
        ?>
        <form method="post" action="">
            Odgovor:
            <input type="text" name="bezbedonosni_odgovor" required><br/>
            <input type="submit" name="odgovor" value="Odgovori">
        </form>
        <?php
        if(isset($_POST['odgovor'])){
            $kor_ime = $_SESSION['kor_ime'];
            $bezbedonosni_odgovor = $_POST['bezbedonosni_odgovor'];
            $result = mysqli_query($conn, "select * from korisnici where kor_ime='$kor_ime'");
            $row = mysqli_fetch_assoc($result);
            if($row['bezbedonosni_odgovor']==$bezbedonosni_odgovor){
                mysqli_close($conn);
                header('Location: nepoznata_lozinka_promena.php');
            }
            else{
                mysqli_close($conn);
                echo "Netačan odgovor";
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
