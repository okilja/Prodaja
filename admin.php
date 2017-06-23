<?php //ob_start();
include("radionica/sesije.php");
preusmerenje_neulogovanog_korisnika('index.php');
dozvola_za_admina();
include("includes/modal.php");
include("includes/heder.php"); 
include("includes/heder_includes/lonkovi_sa_strane.php") ?>

<h1>Administratorska strana</h1><br><br>
<p>Broj korisnika u bazi: <?php echo broj_korisnika_u_bazi(); ?></p>


<?php include("includes/heder_includes/reklame_sa_strane.php") ?>
<?php include("includes/futer.php");
 //ob_end_flush(); ?>