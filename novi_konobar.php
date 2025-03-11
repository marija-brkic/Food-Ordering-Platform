<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

$kor_ime = $_POST['kor_ime'];
$lozinka = $_POST['lozinka'];
$bezbedonosno_pitanje = $_POST['bezbedonosno_pitanje'];
$bezbedonosni_odgovor = $_POST['odgovor_na_pitanje'];
$ime = $_POST['ime'];
$prezime = $_POST['prezime'];
$pol = $_POST['pol'];
$adresa = $_POST['adresa'];
$kontakt_telefon = $_POST['kontakt_telefon'];
$email = $_POST['email'];
$default_image = 'uploads/default_image.png';
$id_restorana = $_POST['id_restorana'];

if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z].*[a-z].*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z].{5,9}$/', $lozinka)) {
    echo "Loše uneta lozinka";
}
else{
    $profilna_slika = $default_image;
    if ($_FILES['profilna_slika']["error"] == 0) {
        $allowed_types = ['image/jpeg', 'image/png'];
        
        $image_type = $_FILES['profilna_slika']['type'];
    
        
        if (!in_array($image_type, $allowed_types)) {
            echo "Profilna slika mora biti u JPG ili PNG formatu." ;
        }
        else{
            $image_info = getimagesize($_FILES['profilna_slika']["tmp_name"]);
            $image_width = $image_info[0];
            $image_height = $image_info[1];

            if ($image_width < 100 || $image_height < 100 || $image_width > 300 || $image_height > 300) {
                echo "Dimenzije profilne slike moraju biti između 100x100 i 300x300 piksela.";
            }
            else{
                $profilna_slika = 'uploads/' . basename($_FILES["profilna_slika"]["name"]);
                
                if (!move_uploaded_file($_FILES["profilna_slika"]["tmp_name"], $profilna_slika)) {
                    echo "Greška prilikom postavljanja profilne slike.";
                }
                else{
                    
                    $lozinka = md5($lozinka);
                    require 'dbConn.php';
                    $result1 = mysqli_query($conn, "select * from registracije where kor_ime='$kor_ime' or email='$email'");
                    $result2 = mysqli_query($conn, "select * from korisnici where kor_ime='$kor_ime' or email='$email'");
                    if(mysqli_num_rows($result1)>0 || mysqli_num_rows($result2)>0){
                        echo "Korisničko ime ili email adresa su zauzeti";
                    }
                    else{
                        $result = mysqli_query($conn, "insert into korisnici (kor_ime, lozinka, bezbedonosno_pitanje, bezbedonosni_odgovor, ime, prezime, pol, adresa, kontakt_telefon, email, profilna_slika, tip) values ('$kor_ime', '$lozinka', '$bezbedonosno_pitanje', '$bezbedonosni_odgovor', '$ime', '$prezime', '$pol', '$adresa', '$kontakt_telefon', '$email', '$profilna_slika', 'konobar')");
                        $result1 = mysqli_query($conn, "insert into konobari (kor_ime, id_restorana, aktivnost, ime, prezime) values ('$kor_ime', '$id_restorana', 'aktivan', '$ime', '$prezime')");
                        if($result and $result1){
                            echo "Dodat novi konobar";
                        }
                    }
                        
                    mysqli_close($conn);
                    
                }
            }
        }
    }
    else{
        
        $lozinka = md5($lozinka);
        require 'dbConn.php';
        $result1 = mysqli_query($conn, "select * from registracije where kor_ime='$kor_ime' or email='$email'");
        $result2 = mysqli_query($conn, "select * from korisnici where kor_ime='$kor_ime'  or email='$email'");
        if(mysqli_num_rows($result1)>0 || mysqli_num_rows($result2)>0){
            echo "Korisničko ime ili email adresa su zauzeti";
        }
        else{
            $result = mysqli_query($conn, "insert into korisnici (kor_ime, lozinka, bezbedonosno_pitanje, bezbedonosni_odgovor, ime, prezime, pol, adresa, kontakt_telefon, email, profilna_slika, tip) values ('$kor_ime', '$lozinka', '$bezbedonosno_pitanje', '$bezbedonosni_odgovor', '$ime', '$prezime', '$pol', '$adresa', '$kontakt_telefon', '$email', '$profilna_slika', 'konobar')");
            $result1 = mysqli_query($conn, "insert into konobari (kor_ime, id_restorana, aktivnost, ime, prezime) values ('$kor_ime', '$id_restorana', 'aktivan', '$ime', '$prezime')");
                        
            if($result and $result1){
                echo "Dodat novi konobar";
            }
                     
            mysqli_close($conn);
        }
    }
}



?>