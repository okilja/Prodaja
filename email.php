<?php 
ob_start();
include("radionica/sesije.php");
preusmerenje_neulogovanog_korisnika('index.php');
dozvola_za_admina();
include("includes/modal.php");
include("includes/heder.php"); 
include("includes/heder_includes/lonkovi_sa_strane.php") ?>

<?php
if(isset($_GET['poslato']) === true && empty($_GET['poslato']) === true){
?>
    <p>Email je poslat!</p>
<?php
}else{
    if(empty($_POST) === false){
        if(empty($_POST['naslov']) === true){
            $errors[] = 'Morste staviti naslov.';
        }
        if(empty($_POST['poruka']) === true){
            $errors[] = 'Poruka ne sme biti prazna.';
        }
        if(empty($errors) === false){
            echo prikaz_gresaka($errors);
        }else{
            // OVDE IDE KOD ZA SLANJE MEJLA
            // OVDE IDE KOD ZA SLANJE MEJLA
            // OVDE IDE KOD ZA SLANJE MEJLA
            // OVDE IDE KOD ZA SLANJE MEJLA
            // OVDE IDE KOD ZA SLANJE MEJLA
            // OVDE IDE KOD ZA SLANJE MEJLA
            // OVDE IDE KOD ZA SLANJE MEJLA

            preusmeri_ka('email.php?poslato');
        }
    }

    ?>

    <h1>Slanje emaila korisnicima</h1><br><br>

    <form class="form-horizontal" action="" method="post">
        <div class="form-group">
            <label class="control-label" for="naslov">Naslov<span class="crveno">*</span>:</label>
            <div>
                <input type="text" class="form-control" name="naslov" id="naslov">
            </div>
        </div>
        <div class="form-group">
            <label for="poruka">Poruka<span class="crveno">*</span>:</label>
            <textarea class="form-control" rows="5" name="poruka" id="poruka"></textarea>
        </div>
        <br><br>

        <div class="form-group"> 
            <div>
                <button type="submit" class="btn btn-success">Pošalji</button>
            </div>
        </div>
    </form>
<?php
}
?>
    
<?php 
include("includes/heder_includes/reklame_sa_strane.php");
include("includes/futer.php");
ob_end_flush(); ?>