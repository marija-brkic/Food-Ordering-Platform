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
        <form method="post" action="">
            Nova lozinka:
            <input type="password" name="nova_lozinka" required><br/>
            Ponovljena nova lozinka:
            <input type="password" name="nova_lozinka1" required><br/>
            <input type="submit" name="zameni" value="Zameni">
        </form>
        <?php
        if(isset($_POST['zameni'])){
            $nova_lozinka = $_POST['nova_lozinka'];
            $nova_lozinka1 = $_POST['nova_lozinka1'];
            if($nova_lozinka == $nova_lozinka1){
                if(!preg_match('/^(?=.*[A-Z])(?=.*[a-z].*[a-z].*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z].{5,9}$/', $nova_lozinka)){
                    echo "Loše uneta lozinka";
                }
                else{
                    require 'dbConn.php';
                    session_start();
                    $kor_ime = $_SESSION['kor_ime'];
                    $nova_lozinka = md5($nova_lozinka);
                    $result1 = mysqli_query($conn, "update korisnici set lozinka='$nova_lozinka' where kor_ime='$kor_ime'");
                    if($result1){
                        mysqli_close($conn);
                        header('Location:index.php');
                    }
                    mysqli_close($conn);
                }
            }
            else{
                echo "Nove lozinke se razlikuju";
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
