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
            <h2>Upisi maksimalni broj gostiju za sve stolove</h2>
            <?php
            date_default_timezone_set('Europe/Belgrade');
            require 'dbConn.php';
            session_start();
            $id_restorana = $_SESSION['id_restorana'];
            $broj_stolova = $_SESSION['broj_stolova'];
            ?>
            <form method="post" action="">
            <?php
            for($i=0; $i<$broj_stolova; $i++){
                ?>
            Maksimalni broj gostiju: <input type="number" min="1" name="<?php echo $i ?>" required><br/>
            <?php
            }
            ?>
            
            <input type="submit" name="potvrdi" value="Potvrdi">
            </form>
            <?php
            if(isset($_POST['potvrdi'])){
            for($i=0; $i<$broj_stolova; $i++){
                $broj = $_POST[$i];
                $result2 = mysqli_query($conn, "insert into stolovi (id_restorana, max_ljudi) values ('$id_restorana', '$broj')");
            }
            mysqli_close($conn);
            header('Location: dodaj_novi_restoran.php');
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
