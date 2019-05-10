<?php include 'header.php'; ?>
<div class="container">
  <div class="row">
    <div class="col-md-9 card login">
      <form class="login-form" action="checklogin.php" method="post">
        <input type="hidden" name="set" value="1">
        <div class="form-group">
            <input name="userName" type="text" class="form-control"  placeholder="Användernamn" required>
          </div>
          <div class="form-group">
            <input name="pwd" type="password" class="form-control"  placeholder="Lösenord" required>
          </div>
          <button type="submit" class="btn-book">Logga in</button>
      </form>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
