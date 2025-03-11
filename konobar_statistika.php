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
        <h2>Statistika</h2>
        <hr/>
        <h4>Broj gostiju po danima:</h4>
        <form method='post' action='dijagram11.php'>
            <input type='submit' name='prikazi' value='Prikazi dijagram'>
        </form>
        <hr/>
        <h4>Raspodela gostiju medju konobarima:</h4>
        <form method='post' action='dijagram22.php'>
            <input type='submit' name='prikazi' value='Prikazi dijagram'>
        </form>
        <hr/>
        <h4>Prosecan broj rezervacija po danima:</h4>
        <form method='post' action='dijagram33.php'>
            <input type='submit' name='prikazi' value='Prikazi dijagram'>
        </form>
        </div>
        </div>
        <div class="row">
            <div class="col-sm-12 footer">Copyright 2024</div>
        </div>
        </div>
    </body>
</html>
