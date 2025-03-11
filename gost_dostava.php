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
        <form method="post" action="gost.php" >
            <input type="submit" name="logout" value="Vrati se na profil">
        </form>
        <hr/>
        <h2>Aktuelne dostave</h2>
        <table>
            <tr>
                <th>Naziv restorana:</th>
                <th>Status narudzbine:</th>
                <th>Procenjeno vreme dostave:</th>
            </tr>
        <?php
        date_default_timezone_set('Europe/Belgrade');
        require 'dbConn.php';
        session_start();
        $kor_ime = $_SESSION['ulogovan'];
        $result = mysqli_query($conn, "select * from dostave where kor_ime='$kor_ime' and (datum_i_vreme>=date_sub(now(), interval 90 minute) and status!='odbijena') order by datum_i_vreme asc");
        if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result)){
                ?>
            <tr>
                <td><?php
                $id_restorana = $row['id_restorana'];
                $result1 = mysqli_query($conn, "select * from restorani where id='$id_restorana'"); 
                $row1 = mysqli_fetch_assoc($result1);
                echo $row1['naziv'];
                ?></td>
                <td><?php
                echo $row['status'];
                ?></td>
                <td><?php
                echo $row['vreme_dostave'];
                ?></td>
            </tr>
            <?php
            }
        }
        ?>
        </table>
        <hr/>
        <h2>Arhiva dostava</h2>
        <table>
            <tr>
                <th>Naziv restorana:</th>
                <th>Iznos racuna:</th>
                <th>Datum dostave:</th>
            </tr>
        <?php
        $result = mysqli_query($conn, "select * from dostave where kor_ime='$kor_ime' and (datum_i_vreme<=date_sub(now(), interval 90 minute) or status='odbijena') order by datum_i_vreme desc");
        if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result)){
                ?>
            <tr>
                <td><?php
                $id_restorana = $row['id_restorana'];
                $result1 = mysqli_query($conn, "select * from restorani where id='$id_restorana'"); 
                $row1 = mysqli_fetch_assoc($result1);
                echo $row1['naziv'];
                ?></td>
                <td><?php
                echo $row['racun'];
                ?></td>
                <td><?php
                echo $row['datum_i_vreme'];
                ?></td>
            </tr>
            <?php
            }
        }
        ?>
        </table>
        </div>
        </div>
        <div class="row">
            <div class="col-sm-12 footer">Copyright 2024</div>
        </div>
        </div>
    </body>
    </body>
</html>
