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
        <h2>Arhiva rezervacija</h2>
        <?php
        date_default_timezone_set('Europe/Belgrade');
        require 'dbConn.php';
        session_start();
        $kor_ime = $_SESSION['ulogovan'];
        
        ?>
        <table>
            <tr>
                <th>Datum rezervacije:</th>
                <th>Naziv restorana:</th>
                <th>Komentar:</th>
                <th>Ocena:</th>
                <th>Dodaj komentar i ocenu:</th>
            </tr>
            
            
                <?php
                $result = mysqli_query($conn, "select * from rezervacije where kor_ime='$kor_ime' and (datum_i_vreme<=date_sub(now(), interval 30 minute) or status='otkazana') order by datum_i_vreme desc");
                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){
                        $id_restorana = $row['id_restorana'];
                        $id_rezervacije = $row['id'];
                        $result1 = mysqli_query($conn, "select * from restorani where id='$id_restorana'");
                        $row1 = mysqli_fetch_assoc($result1);
                        $result2 = mysqli_query($conn, "select * from komentari where id_rezervacije='$id_rezervacije'");
                        $row2 = mysqli_fetch_assoc($result2);
                        ?>
                <tr>
                    <td><?php echo $row['datum_i_vreme'] ?></td>
                    <td><?php echo $row1['naziv'] ?></td>
                    <td><?php 
                        $result2 = mysqli_query($conn, "select * from komentari where id_rezervacije='$id_rezervacije'");
                        if(mysqli_num_rows($result2)>0){
                            $row2 = mysqli_fetch_assoc($result2);
                            echo $row2['komentar'];
                        } 
                        ?>
                    </td>
                    <td><?php 
                        $result2 = mysqli_query($conn, "select * from komentari where id_rezervacije='$id_rezervacije'");
                        if(mysqli_num_rows($result2)>0){
                            $row2 = mysqli_fetch_assoc($result2);
                            echo $row2['ocena'];           
                        }
                        ?>
                    </td>
                    <form method="get" action="dodavanje_komentara.php">
                    <td><?php 
                            $result2 = mysqli_query($conn, "select * from komentari where id_rezervacije='$id_rezervacije'");
                            if($row['status']=='dosao' && mysqli_num_rows($result2)==0){
                                $_SESSION['id_restorana'] = $id_restorana;
                           
                                ?>
                        <input type="hidden" name="id_rezervacije" value='<?php echo $id_rezervacije ?>'>
                        <input type="submit" name="komentarisi" value="Dodaj komentar i ocenu">
                        <?php
                            }
                        ?>
                    </td>
                    </form>
                </tr>
                <?php
                
                    }
                }
                ?>
            
            
        </table>
        <hr/>
        <h2>Aktuelne rezervacije</h2>
        <table>
            <tr>
                <th>Datum rezervacije:</th>
                <th>Naziv restorana:</th>
                <th>Adresa restorana:</th>
                <th>Otkazi:</th>
            </tr>
            <?php
            $result3 = mysqli_query($conn, "select * from rezervacije where kor_ime='$kor_ime' and (datum_i_vreme>=date_sub(now(), interval 30 minute) and status!='otkazana') order by datum_i_vreme asc");
            if(mysqli_num_rows($result3)>0){
                while($row3 = mysqli_fetch_assoc($result3)){
                    ?>
            <tr>
                <td><?php echo $row3['datum_i_vreme']?></td>
                <td><?php 
                $id_restorana = $row3['id_restorana'];
                $result4 = mysqli_query($conn, "select * from restorani where id='$id_restorana'");
                $row4 = mysqli_fetch_assoc($result4);
                echo $row4['naziv']
                        ?></td>
                <td><?php 
                $id_restorana = $row3['id_restorana'];
                $result4 = mysqli_query($conn, "select * from restorani where id='$id_restorana'");
                $row4 = mysqli_fetch_assoc($result4);
                echo $row4['adresa']
                        ?></td>
                <?php
                $datum_i_vreme = new DateTime($row3['datum_i_vreme']);
                $trenutno_vreme = new DateTime();
                $trenutno_vreme->modify('+45 minutes');
                if($datum_i_vreme>=$trenutno_vreme){
                    $id_rezervacije = $row3['id']; 
                    ?>
                <form method="post" action="otkazivanje_rezervacije.php">
                    <td>
                        <input type="hidden" name="id_rezervacije" value="<?php echo $id_rezervacije ?>">
                        <input type='submit' name='otkazi' value='Otkazi'>
                    </td>
                </form>
                <?php
                }
                ?>
            
            </tr>
            <?php
                }
            }
            mysqli_close($conn);
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
