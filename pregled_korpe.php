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
        <form method="post" action="gost_restorani.php" >
            <input type="submit" name="logout" value="Izloguj se">
        </form>
            <form method="post" action="gost.php" >
            <input type="submit" name="logout" value="Vrati se na profil">
        </form>
        <form method="post" action="gost_restorani.php" >
            <input type="submit" name="logout" value="Vrati se na sve restorane">
        </form>
        <?php
        session_start();
        $id_restorana = $_SESSION['id_restorana'];
        ?>
        <form method="post" action="detalji?id=<?php echo $id_restorana?>" >
            <input type="submit" name="logout" value="Vrati se na restoran">
        </form>
        <h2>Pregled korpe:</h2>
        <?php
        if (!isset($_SESSION['korpa']) || empty($_SESSION['korpa'])) {
            echo "Korpa je prazna.";
        }
        else{
            require "dbConn.php";
            $ukupna_cena = 0;
            foreach($_SESSION['korpa'] as $id_jela => $kolicina){
                $result = mysqli_query($conn, "select * from jelovnik where id='$id_jela'");
                $row = mysqli_fetch_assoc($result);
                $cena = $row['cena']*$kolicina;
                $ukupna_cena+= $cena;
                echo 'Naziv:'.$row['naziv'].',  ';
                echo 'Kolicina:'.$kolicina.',  ';
                echo 'Cena:'.$cena.'RSD';
                ?>
        <form method="post" action="izmeni_korpu.php">
            <input type="number" name="nova_kolicina" min="0" required>
            <input type="hidden" name="id_jela" value='<?php echo $id_jela?>'>
            <input type="submit" name="izmeni" value="Izmeni">
        </form>
        <?php
            }
            mysqli_close($conn);
            echo "Ukupna cena: ".$ukupna_cena;
        $_SESSION['ukupna_cena'] = $ukupna_cena;
        
        ?>
        <form method="post" action="zavrsi_porudzbinu.php" >
            <input type="submit" name="zavrsi" value="Zavrsi">
        </form>
        <?php
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
