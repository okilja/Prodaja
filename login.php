<?php
include("radionica/sesije.php");
preusmerenje_ulogovanog_korisnika('index.php');


if(empty($_POST) === false){
    $korisnicko_ime = $_POST['korisnicko_ime'];
    $lozinka = $_POST['lozinka'];
    
    if(empty($korisnicko_ime) || empty($lozinka)){
        $errors[] = 'Morate uneti korisničko ime i lozinku'; 
    } else if (provera_korisnickog_imena($korisnicko_ime) === false){
        $errors[] = 'Korisničko ime nije dobro. Možda se niste registrovali!'; 
    //} else if (provera_aktivnosti_korisnika($korisnicko_ime) === false){
    //    $errors[] = 'Niste aktivirali vas nalog!'; 
    } else{
        $login = login($korisnicko_ime, $lozinka); //funkcija login vraca id od korisnika
        if($login === false){
            $errors[] = 'Pogrešna lozinka za korisnika '. $korisnicko_ime;
        }else{
            //Postavljanje sesije korisnika
            $_SESSION['id'] = $login;
            preusmeri_ka('index.php');
        }
    }
}else{
    $errors[] = 'Popunite polja za logovanje!';
}


include("includes/heder.php");
include("includes/modal.php");
include("includes/heder_includes/lonkovi_sa_strane.php");

if(empty($errors) === false){
?>
    <h2>Neuspešno logovanje</h2><br><br>
<?php
    echo prikaz_gresaka($errors);
}

include("includes/heder_includes/reklame_sa_strane.php");
include("includes/futer.php");

?>









