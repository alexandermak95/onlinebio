<?php include 'header.php'; ?>
<?php require './functions/conn.php'; ?>
<?php $conn = dbConnect();?>

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
  // Kan slängas i en function
  $query = "SELECT * FROM kund WHERE kundNamn='$user'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  $name = $row['kundNamn'];
  $pass = $row['password'];

  $id = $row['kundId'];
  if ($row && $user == $name && password_verify($password, $pass)) {
    $_SESSION['status'] = 'ok';
    $_SESSION['kundId'] = $id;
    if($name == 'ADMIN') {
      $_SESSION['admin'] = 'ok';
    }
    header('Location: index.php');
  }
   else {
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
