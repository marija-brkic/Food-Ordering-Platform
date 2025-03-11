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
        <style>
        .rating {
            direction: rtl;
            unicode-bidi: bidi-override;
        }
        .rating > label {
            color: #ddd;
            font-size: 30px;
            padding: 0;
            cursor: pointer;
            display: inline-block;
            position: relative;
        }
        .rating > input {
            display: none;
        }
        .rating > label:hover,
        .rating > label:hover ~ label,
        .rating > input:checked ~ label {
            color: #f0a500;
        }
    </style>
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
        <form method="post" action="gost_rezervacije.php" >
            <input type="submit" name="logout" value="Vrati se na rezervacije">
        </form>
        <hr/>
        <form method="post" action="">
            <textarea name="komentar" required></textarea>
             <div class="rating">
                <input type="radio" name="ocena" id="star5" value="5"><label for="star5" title="5 zvezdica">★</label>
                <input type="radio" name="ocena" id="star4" value="4"><label for="star4" title="4 zvezdice">★</label>
                <input type="radio" name="ocena" id="star3" value="3"><label for="star3" title="3 zvezdice">★</label>
                <input type="radio" name="ocena" id="star2" value="2"><label for="star2" title="2 zvezdice">★</label>
                <input type="radio" name="ocena" id="star1" value="1"><label for="star1" title="1 zvezdica">★</label>
            </div>
            <input type="submit" name="potvrdi_komentar" value="Potvrdi komentar">
        </form>
        <?php
        date_default_timezone_set('Europe/Belgrade');
        require 'dbConn.php';
        session_start();
        $id_restorana = $_SESSION['id_restorana'];
        $kor_ime = $_SESSION['ulogovan'];
        $id_rezervacije = $_GET['id_rezervacije'];
        
        if(isset($_POST['potvrdi_komentar'])){
            $komentar = $_POST['komentar'];
            $ocena = $_POST['ocena'];
            $result = mysqli_query($conn, "insert into komentari (id_restorana, komentar, kor_ime, id_rezervacije, ocena) values ('$id_restorana', '$komentar', '$kor_ime', '$id_rezervacije', '$ocena')");
         
            if($result){
                $result1 = mysqli_query($conn, "select * from restorani where id='$id_restorana'");
                $row1 = mysqli_fetch_assoc($result1);
                $broj = $row1['broj_ocena'];
                $prosecna_ocena = $row1['prosecna_ocena'];
                $prosecna_ocena = ($prosecna_ocena*$broj + $ocena)/($broj+1);
                $broj = $broj+1;
                $result2 = mysqli_query($conn, "update restorani set prosecna_ocena='$prosecna_ocena', broj_ocena='$broj' where id='$id_restorana'");
                if($result2){
                    mysqli_close($conn);
                    header('Location:gost_rezervacije.php');
                }
                else{
                    echo 'Neuspesna promena ocene';
                }
            }
            else{
                echo "Neuspesan upis komentara";
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
    </body>
</html>
