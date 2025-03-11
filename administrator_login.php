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
        <form action="" method="post">
            Ime:
            <input type="text", name="ime"><br/>
            Lozinka:
            <input type="password", name="lozinka"><br/>
            <input type="submit", name="login", value="Uloguj se">
        </form>
        <?php
        date_default_timezone_set('Europe/Belgrade');
            if(isset($_POST['login'])){
                if(empty($_POST['ime'])||empty($_POST['lozinka'])){
                    echo "<span style='color:red'>Niste uneli sve podatke</span>";
                }
                else{
                    require 'dbConn.php';
                    $ime = $_POST['ime'];
                    $lozinka = $_POST['lozinka'];
                    $kriptovana_lozinka = md5($lozinka);
                    global $conn;
                    $result = mysqli_query($conn, "select * from korisnici where kor_ime = '$ime' and lozinka = '$kriptovana_lozinka'");
                    if(mysqli_num_rows($result)>0){
                        $row = mysqli_fetch_assoc($result);
                        if($row['tip']=='administrator'){
                            session_start();
                            $_SESSION['ulogovan'] = $ime;
                            header('Location: administrator.php');
                        }
                        else{
                            echo "Nije moguć pristum ako niste administrator.";
                        }
                    }
                    else{
                        echo "<span style='color:red'>Losi podaci</span>";
                    }
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
