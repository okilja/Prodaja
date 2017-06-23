<?php

session_start();
//error_reporting(0);

require 'konekcija.php';
require 'funkcije.php';
require 'korisnici.php';

if(provera_logovanja() === true){
    $user_id = $_SESSION['id'];
    $user_data = podatci_korisnika($user_id, 'id', 'korisnicko_ime', 'ime', 'prezime', 'adresa', 'mesto', 'posta', 'email', 'lozinka', 'admin', 'obavestenja');
}

$errors = array();

?>