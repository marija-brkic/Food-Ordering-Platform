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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .stars-outer {
            display: inline-block;
            position: relative;
            font-family: FontAwesome;
            font-size: 24px;
            color: #ccc;
        }
        .stars-inner {
            position: absolute;
            top: 0;
            left: 0;
            white-space: nowrap;
            overflow: hidden;
            color: #f8ce0b;
        }
        .stars-inner::before, .stars-outer::before {
            content: "\f005 \f005 \f005 \f005 \f005";
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
            require 'gost_restorani_prikaz_restorana.php';
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
