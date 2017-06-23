<?php ob_start(); //ZBOG PREUSMERENJA STRANICE POMOCU HEADERA
include("radionica/sesije.php"); 
preusmerenje_ulogovanog_korisnika('index.php');
include("includes/heder.php"); 
include("includes/modal.php");



//Provera nepravilnosti
if(empty($_POST) === false){
    $obavezna_polja = array('korisnicko_ime', 'ime', 'prezime', 'email', 'lozinka', 'provera_lozinke');
    foreach ($_POST as $key=>$value){
        if(empty($value) && in_array($key, $obavezna_polja) === true){
            $errors[] = 'Morate popuniti sva obavezna polja';
            break 1;
        }
    }
    
    if(empty($errors) === true){
        if(provera_korisnickog_imena($_POST['korisnicko_ime']) === true){
            $errors[] = 'Korisničko ime '. $_POST['korisnicko_ime'] .' je zauzeto';
        }
        if(preg_match("/\\s/", $_POST['korisnicko_ime']) == true){
            $errors[] = 'Vaše korisničko ime ne sme imati razmak';
        }
        if(strlen($_POST['lozinka']) <= 5){
            $errors[] = 'Lozinka mora imati barem 5 karaktera';
        }
        if($_POST['lozinka'] !== $_POST['provera_lozinke']){
            $errors[] = 'Vaše lozinke se ne poklapaju';
        }
        if(provera_emaila($_POST['email']) === true){
            $errors[] = 'E-mail koji ste uneli je već u upotrebi';
        }
    }
}

?>

<?php include("includes/heder_includes/lonkovi_sa_strane.php") ?>
        
        
    <?php
    if(isset($_GET['uspesna_registracija']) && empty($_GET['uspesna_registracija'])){
        ?> <h2> <?php echo  "Registracija završena!" ; ?> </h2> <?php
    }else{
        if(empty($_POST) === false && empty($errors) === true){
            $register_data = array(
                'korisnicko_ime'    => $_POST['korisnicko_ime'],
                'ime'               => $_POST['ime'],
                'prezime'            => $_POST['prezime'],
                'adresa'            => $_POST['adresa'],
                'mesto'             => $_POST['mesto'],
                'posta'             => $_POST['posta'],
                'email'             => $_POST['email'],
                'lozinka'           => $_POST['lozinka']
            );

            registracija_korisnika($register_data);
            preusmeri_ka('registracija.php?uspesna_registracija');

        }else if(empty($errors) === false){
            echo prikaz_gresaka($errors);
        } 


        ?><br>
        <!-- Forma za registraciju -->
        <h2>Registracija</h2><br><br>
        <form class="form-horizontal" action="" method="post">
            <div class="form-group">
                <label class="control-label col-sm-3" for="korisnicko_ime">Korisničko ime<span class="crveno">*</span>:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="korisnicko_ime" id="korisnicko_ime" placeholder="Unesite korisničko ime">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="ime">Ime<span class="crveno">*</span>:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="ime" id="ime" placeholder="Unesite ime">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="prezime">Prezme<span class="crveno">*</span>:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="prezime" id="prezime" placeholder="Unesite prezime">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="adresa">Ulica i broj:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="adresa" id="adresa" placeholder="Unesite ulicu i broj">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="mesto">Mesto stanovanja:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="mesto" id="mesto" placeholder="Unesite mesto stanovanja">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="posta">Poštanski broj:</label>
                <div class="col-sm-9">
                    <input type="text" maxlength="5" class="form-control" name="posta" id="posta" placeholder="Unesite poštanski broj">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="email">Email<span class="crveno">*</span>:</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Unesite email">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="lozinka">Lozinka<span class="crveno">*</span>:</label>
                <div class="col-sm-9"> 
                    <input type="password" class="form-control" name="lozinka" id="lozinka" placeholder="Unesite lozinku">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="provera_lozinke">Provera lozinke<span class="crveno">*</span>:</label>
                <div class="col-sm-9"> 
                    <input type="password" class="form-control" name="provera_lozinke" id="provera_lozinke" placeholder="Opet unesite lozinku">
                </div>
            </div>
            <div class="form-group"> 
                <div class="col-sm-offset-3 col-sm-9">
                    <div class="checkbox">
                        <label><input type="checkbox">Zapamti me</label>
                    </div>
                </div>
            </div>
            <div class="form-group"> 
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-success">Registruj se</button>
                </div>
            </div>
        </form>
<?php
    }  //POSLE USPESNE REGISTRACIJE NE PRIKAZUJEM OPET FORMU
?> 

<?php include("includes/heder_includes/reklame_sa_strane.php") ?>
<?php include("includes/futer.php") ?>
<?php ob_end_flush(); ?>

