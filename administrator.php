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
        <hr/>
        <h2>Gosti:</h2>
        <table>
            <tr>
                <th>Korisnicko ime:</th>
                <th>Blokiraj:</th>
                <th>Odblokiraj:</th>
                <th>Azuriraj podatke:</th>
                <?php
                date_default_timezone_set('Europe/Belgrade');
                    require 'dbConn.php';
                    $result = mysqli_query($conn, "select * from gosti");
                    if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_assoc($result)){
                            ?>
            <tr>
                <td><?php echo $row['kor_ime']?></td>
            <form method="post" action="blokiraj_gosta.php">
                <td>
                    <?php
                    if($row['aktivnost']=='aktivan'){
                        ?>
                    <input type="hidden" name="kor_ime" value="<?php echo $row['kor_ime']?>">
                    <input type="submit" name="blokiraj" value="Blokiraj">
                    <?php
                    }
                    ?>
                </td>
            </form>
            <form method="post" action="odblokiraj_gosta.php">
                <td>
                    <?php
                    if($row['aktivnost']=='blokiran'){
                        ?>
                    <input type="hidden" name="kor_ime" value="<?php echo $row['kor_ime']?>">
                    <input type="submit" name="odblokiraj" value="Odblokiraj">
                    <?php
                    }
                    ?>
                </td>
            </form>
            <form method="post" action="azuriraj_gosta.php">
                <td>
                    <input type="hidden" name="kor_ime" value="<?php echo $row['kor_ime']?>">
                    <input type="submit" name="azuriraj" value="Azuriraj podatke">
                </td>
            </form>
            </tr>
            
                <?php
                        }
                    }
                ?>
            </tr>
        </table>
        <hr/>
        <h2>Konobari:</h2>
        <table>
            <tr>
                <th>Korisnicko ime:</th>
                <th>Blokiraj:</th>
                <th>Odblokiraj:</th>
                <th>Azuriraj podatke:</th>
                <?php
                    require 'dbConn.php';
                    $result = mysqli_query($conn, "select * from konobari");
                    if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_assoc($result)){
                            ?>
            <tr>
                <td><?php echo $row['kor_ime']?></td>
            <form method="post" action="blokiraj_konobara.php">
                <td>
                    <?php
                    if($row['aktivnost']=='aktivan'){
                        ?>
                    <input type="hidden" name="kor_ime" value="<?php echo $row['kor_ime']?>">
                    <input type="submit" name="blokiraj" value="Blokiraj">
                    <?php
                    }
                    ?>
                </td>
            </form>
            <form method="post" action="odblokiraj_konobara.php">
                <td>
                    <?php
                    if($row['aktivnost']=='blokiran'){
                        ?>
                    <input type="hidden" name="kor_ime" value="<?php echo $row['kor_ime']?>">
                    <input type="submit" name="odblokiraj" value="Odblokiraj">
                    <?php
                    }
                    ?>
                </td>
            </form>
            <form method="post" action="azuriraj_konobara.php">
                <td>
                    <input type="hidden" name="kor_ime" value="<?php echo $row['kor_ime']?>">
                    <input type="submit" name="azuriraj" value="Azuriraj podatke">
                </td>
            </form>
            </tr>
            
                <?php
                        }
                    }
                ?>
            </tr>
        </table>
        
        <form method="post" action="dodaj_novog_konobara.php">
            <input type="submit" name="dodaj_novog_konobara" value="Dodaj novog konobara">
        </form>
        <hr/>
        <h2>Restorani:</h2>
        <table>
            <tr>
                <th>Ime restorana:</th>
                <?php
                    require 'dbConn.php';
                    $result = mysqli_query($conn, "select * from restorani");
                    if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_assoc($result)){
                            ?>
            <tr>
                <td><?php echo $row['naziv']?></td>
            </tr>
            <?php
                        }
                    }
                    mysqli_close($conn);
                    ?>
        </table>
        <form method="post" action="dodaj_novi_restoran.php">
            <input type="submit" name="dodaj_novi_restoran" value="Dodaj novi restoran">
        </form>
        <hr/>
        <h2>Registracije:</h2>
        <form method="post" action="obrada_registracija.php">
            <input type="submit" name="obradi_registracije" value="Obradi registracije">
        </form>
        </div>
        </div>
        <div class="row">
            <div class="col-sm-12 footer">Copyright 2024</div>
        </div>
        </div>
    </body>
</html>
