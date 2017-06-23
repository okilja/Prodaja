<?php

function provera_admina($user_id){
    global $con;
    $user_id = (int)$user_id;
    $query = "SELECT COUNT(id) FROM korisnici WHERE id = $user_id AND admin = 1";
    $query_run = mysqli_query($con, $query);
    $dobijena_vrednost = mysqli_fetch_assoc($query_run);
    return ($dobijena_vrednost['COUNT(id)'] == 1) ? true : false;
}


function slanje_mejla_sa_korisnickim_imenom($mode, $email){
    $mode = zastita_podataka($mode);
    $email = zastita_podataka($email);
    
    $user_data = podatci_korisnika(id_vrednost_od_emaila($email), 'id', 'ime', 'korisnicko_ime');
    
    if($mode == 'korisnicko_ime'){
        //FUNKCIJA email() nije napravljena
        //email($email, 'Korsinicko ime', "Vase korsinicko ime je: " . $user_data['korisnicko_ime']);
    }else if($mode == 'lozinka'){
        $generisana_lozinka = substr(md5(rand(999, 999999)), 0, 8);
        promena_lozinke($user_data['id'], $generisana_lozinka);
        //email($email, 'Nova lozinka', "Vasa nova lozinka je ime je: " . $generisana_lozinka);
    }
}


function promena_podatka($update_data){
    global $con;
    $update = array();
    array_walk($update_data, 'zastita_podataka_u_nizu');   //FUNKCIJA SE POZIVA ZA SVAKI CLAN NIZA I VRACA PREPRAVLJENI NIZ
    
    foreach($update_data as $polje=>$vrednost){
        $update[] = $polje. ' = \'' . $vrednost . '\'';
    }
    
    $unos_u_query = implode(', ', $update);
 
    $query = "UPDATE korisnici SET " . $unos_u_query . " WHERE id = " . $_SESSION['id'];
    $query_run = mysqli_query($con, $query);
}


function promena_lozinke($user_id, $password){
    global $con;
    $user_id = (int)$user_id;
    $password = md5($password);
    
    $query = "UPDATE korisnici SET lozinka = '$password' WHERE id = $user_id";
    $query_run = mysqli_query($con, $query);
}


function registracija_korisnika($register_data){
    global $con;
    array_walk($register_data, 'zastita_podataka_u_nizu');   //FUNKCIJA SE POZIVA ZA SVAKI CLAN NIZA I VRACA PREPRAVLJENI NIZ
    $register_data['lozinka'] = md5($register_data['lozinka']);
    
    $polja = implode(', ', array_keys($register_data));
    $vrednosti = '\'' . implode('\', \'', $register_data) . '\'';
    
    $query = "INSERT INTO korisnici ($polja) VALUES ($vrednosti)";
    $query_run = mysqli_query($con, $query);
}


function podatci_korisnika($user_id){   //KORISTIM JE U sesije.php
    global $con;
    $data = array();
    $user_id = (int)$user_id;  //PREVENCIJA SQL INJEKCIJA
    
    $func_num_args = func_num_args();
    $func_get_args = func_get_args();  //NIZ OD ARGIMENATA FUNKCIJE
    
    if($func_num_args > 1){
        unset($func_get_args[0]);  //BRISEM PRVI ARGUMENT NIZA
        
        $polja = implode(', ', $func_get_args);
        $query = "SELECT $polja FROM korisnici WHERE id = $user_id";
        $query_run = mysqli_query($con, $query);
        $podatci_korisnika = mysqli_fetch_assoc($query_run);
        return $podatci_korisnika;
    }
}


function provera_logovanja(){
    return (isset($_SESSION['id'])) ? true : false ;
}


function provera_korisnickog_imena($korisnicko_ime){
    global $con;
    $korisnicko_ime = zastita_podataka($korisnicko_ime);
    $query = "SELECT COUNT(id) FROM korisnici WHERE korisnicko_ime = '$korisnicko_ime'";
    $query_run = mysqli_query($con, $query);
    $dobijena_vrednost = mysqli_fetch_assoc($query_run);
    return ($dobijena_vrednost['COUNT(id)'] == 1) ? true : false;
}


function provera_emaila($email){
    global $con;
    $email = zastita_podataka($email);
    $query = "SELECT COUNT(id) FROM korisnici WHERE email = '$email'";
    $query_run = mysqli_query($con, $query);
    $dobijena_vrednost = mysqli_fetch_assoc($query_run);
    return ($dobijena_vrednost['COUNT(id)'] == 1) ? true : false;
}


//TREBA JE PREPRAVITI DA NE VRACA BROJ REDOVA VEC IZNOS DOBIJENOG POLJA. A MOZDA NMI NECE TRABATI
//function provera_aktivnosti_korisnika($korisnicko_ime){
//    global $con;
//    $korisnicko_ime = zastita_podataka($korisnicko_ime);
//    $query = "SELECT COUNT(id) FROM korisnici WHERE korisnicko_ime = '$korisnicko_ime' AND aktivan = 1";
//    $query_run = mysqli_query($con, $query);
//    $query_num_rows = mysqli_num_rows($query_run);
//    return ($query_num_rows == 1) ? true : false;
//}


function id_vrednost_od_korisnika($korisnicko_ime){
    global $con;
    $korisnicko_ime = zastita_podataka($korisnicko_ime);
    $query = "SELECT id FROM korisnici WHERE korisnicko_ime = '$korisnicko_ime'";
    $query_run = mysqli_query($con, $query);
    $query_result = mysqli_fetch_assoc($query_run);
    return $query_result['id'];
}


function id_vrednost_od_emaila($email){
    global $con;
    $email = zastita_podataka($email);
    $query = "SELECT id FROM korisnici WHERE email = '$email'";
    $query_run = mysqli_query($con, $query);
    $query_result = mysqli_fetch_assoc($query_run);
    return $query_result['id'];
}


function login($korisnicko_ime, $lozinka){
    global $con;
    $id_korisnika = id_vrednost_od_korisnika($korisnicko_ime);
    
    $korisnicko_ime = zastita_podataka($korisnicko_ime); // radi se zastita i za prvi red funkcije u samoj funkciji
    $lozinka = md5($lozinka);
    
    $query = "SELECT COUNT(id) FROM korisnici WHERE korisnicko_ime = '$korisnicko_ime' AND lozinka = '$lozinka'";
    $query_run = mysqli_query($con, $query);
    $dobijena_vrednost = mysqli_fetch_assoc($query_run);
    return ($dobijena_vrednost['COUNT(id)'] == 1) ? $id_korisnika : false;
}

?>
