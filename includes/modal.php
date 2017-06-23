
<div class="modal fade" id="LoginProzor" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="padding:35px 50px;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4>Uloguj se:</h4>
      </div>
      <div class="modal-body" style="padding:40px 50px;">
        <form role="form" action="login.php" method="post">
          <div class="form-group">
            <label for="username">Korisni&#269;ko ime</label>
            <input type="text" name="korisnicko_ime" class="form-control" id="username" placeholder="Unesite korisni&#269;ko ime">
          </div>
          <div class="form-group">
            <label for="pass">Lozinka</label>
            <input type="text" name="lozinka" class="form-control" id="pass" placeholder="Unesite lozinku">
          </div>
          <div class="checkbox">
            <label><input type="checkbox" value="" checked>Zapamti</label>
          </div>
            <button type="submit" class="btn btn-success btn-block">Uloguj se</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal">Otka&#382;i</button>
        <p>Nemate nalog? <a href="registracija.php">Registrujte se</a></p>
        <p>Zaboravili <a href="promena_korisnickog_imena.php?mode=korisnicko_ime">korisničko ime</a> ili <a href="promena_korisnickog_imena.php?mode=lozinka">lozinku</a> ?</p>
      </div>
    </div>

  </div>
</div> 








