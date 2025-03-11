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
        <form method="post" action="" enctype="multipart/form-data">
            Korisničko ime:
            <input type="text" name="kor_ime" required><br/>
            Lozinka:
            <input type="password" name="lozinka" required><br/>
            Bezbedonosno pitanje:
            <select name="bezbedonosno_pitanje" required>
            <option value="Kako se zove Vaša sestra">Kako se zove Vaša sestra?</option>
            <option value="Kako Vam se zvala učiteljica/učitelj">Kako Vam se zvala učiteljica/učitelj</option>
            <option value="Koja Vam je omiljena boja">Koja Vam je omiljena boja?</option>
            </select><br/>
            Odgovor na pitanje: <input type="text" name="odgovor_na_pitanje" required><br/>
            Ime: <input type="text" name="ime" required><br/>
            Prezime: <input type="text" name="prezime" required><br/>
            Pol: <select name="pol" required>
                <option value="M">Muški</option>
                <option value="Ž">Ženski</option>
            </select><br/>
            Adresa: <input type="text" name="adresa" required><br/>
            Kontakt telefon: <input type="text" name="kontakt_telefon" required><br/>
            E-mail: <input type="text" name="email" required><br/>
            Profilna slika: <input type="file" name="profilna_slika"><br/>
            Broj kreditne kartice: <input type="text" name="broj_kreditne_kartice" required><br/>
            <input type="submit" name="registruj" value="Registruj se">
        </form>
        <?php
            if(isset($_POST['registruj'])){
                require 'nova_registracija.php';
                
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
