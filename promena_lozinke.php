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
            <input type="submit" name="poznata_lozinka" value="Znam staru lozinku">
        </form>
        <form method="post" action="">
            <input type="submit" name="nepoznata_lozinka" value="Ne znam staru lozinku">
        </form>
        <?php
        // put your code here
        if(isset($_POST['poznata_lozinka'])){
            header("Location: poznata_lozinka.php");
        }
        if(isset($_POST['nepoznata_lozinka'])){
            header("Location: nepoznata_lozinka.php");
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
