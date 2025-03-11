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
        <form method="post" action="konobar.php" >
            <input type="submit" name="logout" value="Vrati se na profil">
        </form>
        <hr/>
        <h2>Dostave</h2>
        <?php
        date_default_timezone_set('Europe/Belgrade');
        require 'dbConn.php';
        session_start();
        $kor_ime = $_SESSION['ulogovan'];
        $result4 = mysqli_query($conn, "select * from konobari where kor_ime='$kor_ime'");
        $row4 = mysqli_fetch_assoc($result4);
        $id_restorana = $row4['id_restorana'];
        $result = mysqli_query($conn, "select * from dostave where status='neobradjena' and id_restorana='$id_restorana'");
        
        ?>
        <table>
            <tr>
                <th>Narudzbina:</th>
                <th>Potvrdi:</th>
                <th>Odbij:</th>
            </tr>
            <?php
            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                    $id_porudzbine = $row['id'];
                    ?>
            <form method='get' action=''>
                <tr>
                    <td><?php echo $row['jela']?></td>
                    <td><input type='hidden' name='id_porudzbine' value='<?php echo $id_porudzbine?>'>
                        <input type='submit' name='prihvati' value='Potvrdi'></td>
                    <td><input type='hidden' name='id_porudzbine' value='<?php echo $id_porudzbine?>'>
                        <input type='submit' name='odbij' value='Odbij'></td>
                </tr>
            </form>
            <?php
                }
            }
            ?>
        </table>
        <?php 
        if(isset($_GET['odbij'])){
            $id_dostave = $_GET['id_porudzbine'];
            $result1 = mysqli_query($conn, "update dostave set status='odbijena' where id='$id_dostave'");
            if($result1){
                mysqli_close($conn);
                echo "<script>window.location.href='konobar_dostave.php';</script>";
                exit();
            }
        }
        if(isset($_GET['prihvati'])){
            $id_dostave = $_GET['id_porudzbine'];
            $result1 = mysqli_query($conn, "update dostave set status='prihvacena' where id='$id_dostave'");
            if($result1){
                ?>
        <form method="post" action="">
            <select name="vreme" required>
                <option value="20-30 minuta">20-30 minuta</option>
                <option value="30-40 minuta">30-40 minuta</option>
                <option value="50-60 minuta">50-60 minuta</option>
            </select>
            <input type="submit" name="postavi" value="Postavi">
        </form>
        <?php
            }
        }
        if(isset($_POST['postavi'])){
            $id_dostave = $_GET['id_porudzbine'];
            $vreme = $_POST['vreme'];
            $result2 = mysqli_query($conn, "update dostave set vreme_dostave='$vreme' where id='$id_dostave'");
            if($result2){
                mysqli_close($conn);
                echo "<script>window.location.href='konobar_dostave.php';</script>";
                exit();
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
