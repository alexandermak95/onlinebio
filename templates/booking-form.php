<div class="container">
  <div class="row">
    <div class="col-md-9">
      <div class="booking-form">
        <form class="bokning" action="bokning.php" method="post">
          <input type="hidden" name="order" value="1">
          <div class="form-group">
            <label for="exampleFormControlInput1">Ålder</label>
            <input name="age" type="number" class="form-control" id="exampleFormControlInput1" min="7" placeholder="Ange din ålder" required>
          </div>
          <div class="form-group">
            <label for="exampleFormControlSelect1">Välj Film</label>
            <select name="val" class="form-control" id="exampleFormControlSelect1">
              <?php foreach ($filmer as $film) {
                echo "<option value='$film->age'>" .$film->name. ' <i> ( '.$film->age.'+)<i/>'. "</option>";
              } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="antal">Antal biljetter</label>
            <input class="form-control" type="number" min="1" name="antal" value="1">
          </div>
          <div class="form-group">
            <label for="exampleFormControlSelect2">Medföljande målsman?</label>
            <select name="co" class="form-control" id="exampleFormControlSelect2">
              <option value="nej">NEJ</option>
              <option value="ja">JA</option>
            </select>
          </div>
          <button class="btn-book confirm" type="submit" name="button">Beställ</button>
        </form>
      </div>
    </div>
  </div>
</div>
