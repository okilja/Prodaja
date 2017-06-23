<?php
if(provera_logovanja() === true){
    $vrednost_dugmeta = 'Izloguj se';
    $vrednost_linka = 'logout.php';
    $data_toggle = '';
    $gliphicon = 'glyphicon-off';
}else{
    $vrednost_dugmeta = 'Uloguj se';
    $vrednost_linka = '#LoginProzor';
    $data_toggle = 'modal';
    $gliphicon = 'glyphicon-share-alt';
}
?>

<!-- Meni -->
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
            </button>
            <a class="navbar-brand" href="#">Logo</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li id="home"><a href="index.php">Home</a></li>
                <li id="o_nama"><a href="#">O nama</a></li>
                <li id="artikli"><a href="artikli.php">Artikli</a></li>
                <li id="kontakt"><a href="#">Kontakt</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                if(provera_logovanja() === true){ ?>
                    <li class="dropdown">
                        <a class="btn dropdown-toggle" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Nalog <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="profil.php">Profil</a></li>
                            <li><a href="promena_podataka.php">Promena podataka</a></li>
                            <?php
                            if(provera_admina($_SESSION['id']) === true){ 
                            ?>
                                <li role="presentation" class="divider"></li>
                                <li><a href="admin.php">Admin strana</a></li>
                                <li><a href="email.php">Slanje poruka</a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </li>
                <?php }
                ?>

                <li><a href="<?php echo $vrednost_linka ?>" data-toggle="<?php echo $data_toggle ?>"><span class="glyphicon  <?php echo $gliphicon ?>"></span><?php echo ' '.$vrednost_dugmeta ?></a></li>

                <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Kolica</a></li>
            </ul>
        </div>
  </div>
</nav>