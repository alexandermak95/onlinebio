<?php include 'header.php'; ?>

<!-- skapar användare -->
<?php $name = 'alex'; $pass = '1234';?>

<!-- hämtar info från formuläret -->
<?php
if(isset($_POST['set']) && $_POST['set'] == 1) {
  $user = $_POST['userName'];
  $password = $_POST['pwd'];
  $set = 1;
} else {
  $user = "";
  $password = "";
  $set = 0;
} ?>

<?php if($set == 1) {
  if ($user == $name && $password == $pass) {
    $_SESSION['status'] = 'ok';
    header('Location: index.php');
  } else {
    echo "<h2 class='wrong'>Fel användernamn eller lösenord! Försök igen!</h2>"; ?>
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

    <?php
  }
} else {
  header('location: index.php');
} ?>

<?php include 'footer.php'; ?>
