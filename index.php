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
        <form action="" method="post">
            Ime:
            <input type="text", name="ime"><br/>
            Lozinka:
            <input type="password", name="lozinka"><br/>
            <input type="submit", name="login", value="Uloguj se">
        </form>
        <form method="post" action="registracija_gosta.php">
            <input type="submit", name="registracija", value="Registracija novog gosta">
        </form>
        <form method="post" action="promena_lozinke.php">
            <input type="submit", name="lozinka", value="Promena lozinke">
        </form>
            <?php
            if(isset($_POST['login'])){
                if(empty($_POST['ime'])||empty($_POST['lozinka'])){
                    echo "<span style='color:red'>Niste uneli sve podatke</span>";
                }
                else{
                    require 'login.php';
                }
            }
        ?>
        <hr/>
        <?php
            require 'dbConn.php';
            $result = mysqli_query($conn, 'select * from restorani');
            $br_restorana = mysqli_num_rows($result);
            echo 'Broj restorana u sistemu: '.$br_restorana.' ';
            $result = mysqli_query($conn, 'select * from gosti');
            $br_gostiju = mysqli_num_rows($result);
            echo 'Broj registrovanih gostiju u sistemu: '.$br_gostiju.' ';
            date_default_timezone_set('Europe/Belgrade');
            $trenutno_vreme = date('Y-m-d H:i:s');
            $result = mysqli_query($conn, "select * from rezervacije where datum_i_vreme >= date_sub('$trenutno_vreme', interval 1 day) and datum_i_vreme <= '$trenutno_vreme'");
            $br_dan = mysqli_num_rows($result);
            echo 'Broj registracija u poslednjih 24h: '.$br_dan.'<br>';
            $result = mysqli_query($conn, "select * from rezervacije where datum_i_vreme >= date_sub('$trenutno_vreme', interval 7 day) and datum_i_vreme <= '$trenutno_vreme'");
            $br_nedelja = mysqli_num_rows($result);
            echo 'Broj registracija u poslednjoj nedelji: '.$br_nedelja.' ';
            $result = mysqli_query($conn, "select * from rezervacije where datum_i_vreme >= date_sub('$trenutno_vreme', interval 30 day) and datum_i_vreme <= '$trenutno_vreme'");
            $br_mesec = mysqli_num_rows($result);
            echo 'Broj registracija u poslednjem mesecu: '.$br_mesec.'<br>';
            mysqli_free_result($result);
            mysqli_close($conn);
        ?>
        <hr/>
        <h3>Prikaz restorana:</h3>
        <form method="get" action="">
            <table>
                <tr>
                    <th>Sortiraj po nazivu:</th>
                    <th>Sortiraj po adresi:</th>
                    <th>Sortiraj po tipu:</th>
                    <th>Pretraga po imenu:</th>
                    <th>Pretraga po adresi:</th>
                    <th>Pretraga po tipu:</th>
                    <th>Pretraži:</th>
                </tr>
                <tr>
                    <td>
                        <select name="sort_naziv" required>
                        <option value="neopadajuce">neopadajuće</option>
                        <option value="nerastuce">nerastuće</option>
                        </select>
                    </td>
                    <td>
                        <select name="sort_adresa" required>
                        <option value="neopadajuce">neopadajuće</option>
                        <option value="nerastuce">nerastuće</option>
                        </select>
                    </td>
                    <td>
                        <select name="sort_tip" required>
                        <option value="neopadajuce">neopadajuće</option>
                        <option value="nerastuce">nerastuće</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="pretaga_naziv">
                    </td>
                    <td>
                        <input type="text" name="pretaga_adresa">
                    </td>
                    <td>
                        <input type="text" name="pretaga_tip">
                    </td>
                    <td>
                        <input type="submit" name="pretrazi" value="pretraži">
                    </td>
                </tr>
            </table>     
        </form>
        <?php
        if(isset($_GET['pretrazi'])){
            require 'neregistrovani_korisnik.php';
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
