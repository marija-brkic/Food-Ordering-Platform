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
        <h2>Rezervacije</h2>
        <h4>Neobradjene</h4>
        <?php
        date_default_timezone_set('Europe/Belgrade');
        require 'dbConn.php';
        session_start();
        $kor_ime = $_SESSION['ulogovan'];
        $result1 = mysqli_query($conn, "select * from konobari where kor_ime='$kor_ime'");
        $row1 = mysqli_fetch_assoc($result1);
        $id_restorana = $row1['id_restorana'];
        $id_konobara = $row1['id'];
        $result = mysqli_query($conn, "select * from rezervacije where status='neobradjena' and id_restorana='$id_restorana' order by datum_i_vreme asc");
        
        
        ?>
        <table>
            <tr>
                <th>Datum i vreme rezervacije:</th>
                <th>Potvrdi:</th>
                <th>Odbij:</th>
            </tr>
            <?php
            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                    $id_rezervacije = $row['id'];
                    ?>
            <form method='get' action=''>
                <tr>
                    <td><?php echo $row['datum_i_vreme']?></td>
                    <td><input type='hidden' name='id_rezervacije' value='<?php echo $id_rezervacije?>'>
                        <input type='submit' name='prihvati' value='Prihvati'></td>
                    <td><input type='hidden' name='id_rezervacije' value='<?php echo $id_rezervacije?>'>
                        <input type='submit' name='odbij' value='Odbij'></td>
                </tr>
            </form>
            <?php
                }
            }
            ?>
        </table>
        <?php 
        if(isset($_GET['prihvati'])){
            $id_rezervacije = $_GET['id_rezervacije'];
            $result2 = mysqli_query($conn, "update rezervacije set status='prihvacena', id_konobara='$id_konobara' where id='$id_rezervacije'");
            if($result2){
                mysqli_close($conn);
                echo "<script>window.location.href='konobar_rezervacije.php';</script>";
                exit();
            }
        }
        if(isset($_GET['odbij'])){
          
            $id_rezervacije = $_GET['id_rezervacije'];            
                ?>
        <form method="post" action="">
            <textarea name='komentar' required></textarea>
            <input type="submit" name="potvrdi" value="Potvrdi">
        </form>
        <?php
            
        }
        if(isset($_POST['potvrdi'])){
            $komentar = $_POST['komentar'];
            $result2 = mysqli_query($conn, "update rezervacije set status='odbijena', id_konobara='$id_konobara', komentar_konobara='$komentar' where id='$id_rezervacije'");
            if($result2){
                mysqli_close($conn);
                echo "<script>window.location.href='konobar_rezervacije.php';</script>";
                exit();
            }
        }
        ?>
        <hr/>
        <h4>Vasa zaduzenja</h4>
        <?php
        $result3 = mysqli_query($conn, "select * from rezervacije where id_konobara='$id_konobara' and status='prihvacena' and datum_i_vreme<=date_sub(now(), interval 30 minute) order by datum_i_vreme asc");
        
        ?>
        <table>
            <tr>
                <th>Datum i vreme rezervacije:</th>
                <th>Gost je dosao:</th>
                <th>Gost nije dosao:</th>
            </tr>
            <?php
            if(mysqli_num_rows($result3)>0){
                while($row3 = mysqli_fetch_assoc($result3)){
                    ?>
            <tr>
                <td><?php echo $row3['datum_i_vreme']?></td>
                <td>
                    <form method='post' action="dosao_gost.php">
                        <input type='hidden' name='id_rezervacije' value='<?php echo $row3['id']?>'>
                        <input type='submit' name='dosao' value='Dosao'>
                    </form>
                </td>
                <td><form method='post' action="nije_dosao_gost.php">
                        <input type='hidden' name='id_rezervacije' value='<?php echo $row3['id']?>'>
                        <input type='submit' name='nije_dosao' value='Nije dosao'>
                    </form>
                </td>
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
</html>
