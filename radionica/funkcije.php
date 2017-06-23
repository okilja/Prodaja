<?php
require 'konekcija.php';

function broj_korisnika_u_bazi(){
    global $con;
    $query = "SELECT COUNT(id) FROM korisnici";
    $query_run = mysqli_query($con, $query);
    $dobijena_vrednost = mysqli_fetch_assoc($query_run);
    return $dobijena_vrednost['COUNT(id)'];
}


function preusmerenje_ulogovanog_korisnika($lokacija){
    if(provera_logovanja() === true){
        preusmeri_ka($lokacija);
    }
}


function preusmerenje_neulogovanog_korisnika($lokacija){
    if(provera_logovanja() === false){
        preusmeri_ka($lokacija);
    }
}


function dozvola_za_admina(){
    if(provera_admina($_SESSION['id']) === false){
        preusmeri_ka('index.php');
    }
}


//Provlacenje korisnickog imena kroz enkripciju radi prevencije SQL inekcija 
function zastita_podataka($data){
    global $con;
    return htmlentities(strip_tags(mysqli_real_escape_string($con, $data)));
}


//Isto kao i gornja funkcija ali za niz. Znak & znaci da funkcija vraca vrednost $data. Koristim funkciju u korisnici.php pri registraciji i promeni podataka
function zastita_podataka_u_nizu(&$data){
    global $con;
    $data = htmlentities(strip_tags(mysqli_real_escape_string($con, $data)));
}


function preusmeri_ka($lokacija) {
    header ("Location: " . $lokacija);
    exit();
}

        
function prikaz_gresaka($errors){
    return '<ul><li>' . implode('</li><li>', $errors) . '</li></ul>';
}

?>