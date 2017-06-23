<?php ob_start();
include("radionica/sesije.php");
preusmerenje_ulogovanog_korisnika('index.php');
include("includes/modal.php");
include("includes/heder.php"); 
include("includes/heder_includes/lonkovi_sa_strane.php") ?>


<h2>Promena korisničkog imena</h2><br><br>
<?php
if(isset($_GET['uspesno']) === true  && empty($_GET['uspesno']) === true){
?>
    <p>Poslat vam je email sa novim podatcima!</p>
<?php
}else{
    ?>
    <?php
    $dozvoljeno = array('korisnicko_ime', 'lozinka');
    if(isset($_GET['mode']) === true && in_array($_GET['mode'], $dozvoljeno) === true){
        if(isset($_POST['email']) === true && empty($_POST['email']) === false){
            if(provera_emaila($_POST['email']) === true){
                slanje_mejla_sa_korisnickim_imenom($_GET['mode'], $_POST['email']);
                preusmeri_ka('promena_korisnickog_imena.php?uspesno');
                echo '<br><br>';
            }else{
                echo '<p> Ne postoji takav email. </p><br><br>';
            }
        }
    ?>

    <form class="form-horizontal" action="" method="post">
        <div class="form-group">
            <label class="control-label col-sm-3" for="email">Unesite vaš email:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="email" id="email">
            </div>
        </div>

        <div class="form-group"> 
            <div class="col-sm-offset-3 col-sm-9">
                <button type="submit" class="btn btn-success">Potvrdi</button>
            </div>
        </div>
    </form>

    <?php
    }else{
        preusmeri_ka('index.php');
    }
}
?>


<?php include("includes/heder_includes/reklame_sa_strane.php") ?>
<?php include("includes/futer.php") ?>
<?php ob_end_flush(); ?>