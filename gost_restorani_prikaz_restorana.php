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
        <?php
        date_default_timezone_set('Europe/Belgrade');
        require 'dbConn.php';
        $sort_naziv = $_GET['sort_naziv'];
        $sort_adresa = $_GET['sort_adresa'];
        $sort_tip = $_GET['sort_tip'];
        $pretaga_naziv = $_GET['pretaga_naziv'];
        $pretaga_adresa = $_GET['pretaga_adresa'];
        $pretaga_tip = $_GET['pretaga_tip'];
        
        
        if($sort_naziv == 'neopadajuce'){
            $sort_naziv = 'asc';
        }
        else{
            $sort_naziv = 'desc';
        }
        
        if($sort_adresa == 'neopadajuce'){
            $sort_adresa = 'asc';
        }
        else{
            $sort_adresa = 'desc';
        }
        
        if($sort_tip == 'neopadajuce'){
            $sort_tip = 'asc';
        }
        else{
            $sort_tip = 'desc';
        }
        
        $result = mysqli_query($conn, "select * from restorani where naziv like '%$pretaga_naziv%' and adresa like '%$pretaga_adresa%' and tip like '%$pretaga_tip%' order by naziv ".$sort_naziv.", adresa ".$sort_adresa.", tip ".$sort_tip."");
        
        
        ?>
        <table>
            <tr colspan = "2">
                <th>Naziv restorana</th>
                <th>Konobari</th>
                <th>Adresa</th>
                <th>Tip restorana</th>
                <th>Ocena restorana</th>
                <th>Ocena</th>
            </tr>
            <?php
            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                  ?>
            <tr colspan = "2">
                
                <td><a href="detalji.php?id=<?php echo $row['id']; ?>"><?php echo $row['naziv']; ?></a></td>
                <td><?php 
                $id_restorana = $row['id'];
                $result1 = mysqli_query($conn, "select * from konobari where id_restorana='$id_restorana' and aktivnost='aktivan'");
                if(mysqli_num_rows($result1)>0){
                    while($row1 = mysqli_fetch_assoc($result1)){
                        echo $row1['ime'].' '.$row1['prezime'].'<br>';
                    }
                }
                mysqli_free_result($result1);
                ?></td>
                <td><?php echo $row['adresa'] ?></td>
                <td><?php echo $row['tip'] ?></td>
                <td><?php echo $row['prosecna_ocena'] ?></td>
                <td>
                    <div class="stars-outer">
                        <div class="stars-inner" style="width: <?php echo ($row['prosecna_ocena'] / 5) * 100; ?>%;"></div>
                    </div>
                </td>
            </tr>
            <?php
                }
            }
            mysqli_free_result($result);
            mysqli_close($conn);
            ?>
        </table>
    </body>
</html>
