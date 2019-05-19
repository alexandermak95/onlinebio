
    <?php include "header.php"; ?>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="headline">Aktuella filmer</h2>
          <div class="row">
            <?php include "movies.php"; ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-10">
          <div class="boka">
            <?php if(isset($_SESSION['status'])) : ?>
            <a class="btn-book" href="bokning.php">Beställ biljett nu</a>
          <?php else : ?>
            <a class="btn-book" href="login.php">Beställ biljett nu</a><br>
          <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    <?php include "footer.php"; ?>
