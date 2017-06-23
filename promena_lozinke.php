<?php ob_start();
include("radionica/sesije.php");
preusmerenje_neulogovanog_korisnika('index.php');
include("includes/modal.php");
include("includes/heder.php"); 

if(empty($_POST) === false){
    $obavezna_polja = array('stara_lozinka', 'nova_lozinka', 'ponovljena_lozinka');
    foreach ($_POST as $key=>$value){
        if(empty($value) && in_array($key, $obavezna_polja) === true){
            $errors[] = 'Morate popuniti sva obavezna polja!';
            break 1;
        }
    }
    
    if(md5($_POST['stara_lozinka']) === $user_data['lozinka']){
        if(trim($_POST['nova_lozinka']) !== trim($_POST['ponovljena_lozinka'])){
            $errors[] = 'Loznike se ne poklapaju';
        }else if (strlen($_POST['nova_lozinka']) <= 5) {
            $errors[] = 'Lozinka mora imati barem 5 karaktera';
        }
    }else{
        $errors[] = 'Stara lozinka ne odgovara';
    }
}

include("includes/heder_includes/lonkovi_sa_strane.php") ?>


<?php
if(isset($_GET['uspesna_promena']) && empty($_GET['uspesna_promena'])){
    ?> <h2> <?php echo  "Loznika promenjena" ; ?> </h2> <?php
}else{
    if(empty($_POST) === false && empty($errors) === true){
        promena_lozinke($user_id, $_POST['nova_lozinka']);
        preusmeri_ka('promena_lozinke.php?uspesna_promena');
    }else if(empty($errors) === false){
        echo prikaz_gresaka($errors);
    }
    ?>


    <h2>Promena lozinke</h2><br><br>
    <form class="form-horizontal" action="" method="post">
        <div class="form-group">
            <label class="control-label col-sm-3" for="stara_lozinka">Stara lozinka<span class="crveno">*</span>:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="stara_lozinka" id="stara_lozinka" placeholder="Unesite staru lozinku">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="nova_lozinka">Nova lozinka<span class="crveno">*</span>:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="nova_lozinka" id="nova_lozinka" placeholder="Unesite novu lozinku">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="ponovljena_lozinka">Ponovite lozinku<span class="crveno">*</span>:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="ponovljena_lozinka" id="ponovljena_lozinka" placeholder="Ponovite lozinku">
            </div>
        </div>

        <div class="form-group"> 
            <div class="col-sm-offset-3 col-sm-9">
                <button type="submit" class="btn btn-success">Promeni</button>
            </div>
        </div>
    </form>
<?php 
    } 
?>

<?php include("includes/heder_includes/reklame_sa_strane.php") ?>
<?php include("includes/futer.php") ?>
<?php ob_end_flush(); ?>