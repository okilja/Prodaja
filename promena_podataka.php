<?php ob_start();
include("radionica/sesije.php");
preusmerenje_neulogovanog_korisnika('index.php');
include("includes/modal.php");
include("includes/heder.php");
include("includes/heder_includes/lonkovi_sa_strane.php") ?>

<?php
//Provera nepravilnosti

if(empty($_POST) === false){
    $obavezna_polja = array('korisnicko_ime', 'ime', 'prezime', 'adresa', 'mesto', 'email');
    foreach ($_POST as $key=>$value){
        if(empty($value) && in_array($key, $obavezna_polja) === true){
            $errors[] = 'Morate popuniti sva obavezna polja';
            break 1;
        }
    }
    
    if(provera_emaila($_POST['email']) === true && $user_data['email'] !== $_POST['email']){
        $errors[] = 'E-mail koji ste uneli je već u upotrebi';
    }
}
?>

<h2>Promena podataka</h2><br><br>

<?php
if(isset($_GET['uspesna_promena']) === true && empty($_GET['uspesna_promena']) === true){
    echo  "Uspešno ste promenili podatke!";
}else{
    if(empty($_POST) === false && empty($errors) === true){
        $update_data = array(
            'korisnicko_ime'     => $_POST['korisnicko_ime'],
            'ime'                => $_POST['ime'],
            'prezime'            => $_POST['prezime'],
            'adresa'             => $_POST['adresa'],
            'mesto'              => $_POST['mesto'],
            'email'              => $_POST['email'],
            'obavestenja'        => ($_POST['obavestenja'] == 'on') ? 1 : 0
        );

        promena_podatka($update_data);

        preusmeri_ka('promena_podataka.php?uspesna_promena');

    }else if(empty($errors) === false){
        echo prikaz_gresaka($errors). '<br><br>' ;
    }
    ?>

    <form class="form-horizontal" action="" method="post">
        <div class="form-group">
            <label class="control-label col-sm-3" for="korisnicko_ime">Korisničko ime<span class="crveno">*</span>:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="korisnicko_ime" id="korisnicko_ime" value="<?php echo $user_data['korisnicko_ime']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="ime">Ime<span class="crveno">*</span>:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="ime" id="ime" value="<?php echo $user_data['ime']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="prezime">Prezme<span class="crveno">*</span>:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="prezime" id="prezime" value="<?php echo $user_data['prezime']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="adresa">Ulica i broj<span class="crveno">*</span>:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="adresa" id="adresa" value="<?php echo $user_data['adresa']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="mesto">Mesto stanovanja<span class="crveno">*</span>:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="mesto" id="mesto" value="<?php echo $user_data['mesto']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="email">Email<span class="crveno">*</span>:</label>
            <div class="col-sm-9">
                <input type="email" class="form-control" name="email" id="email" value="<?php echo $user_data['email']; ?>">
            </div>
        </div>
        <div class="checkbox col-sm-push-3">
            <label><input type="checkbox" name="obavestenja" <?php if($user_data['obavestenja'] == 1){ echo "checked='checked'"; } ?> >Prijava na newsletter. </label>  
        </div><br><br>

        <div class="form-group"> 
            <div class="col-sm-offset-3 col-sm-9">
                <button type="submit" class="btn btn-success">Promeni</button>
            </div>
        </div>
    </form>
<?php
    }
?> 

<?php 
include("includes/heder_includes/reklame_sa_strane.php");
include("includes/futer.php");
ob_end_flush();
?>