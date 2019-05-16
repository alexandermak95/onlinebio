<?php include 'header.php';?>
<?php
require './functions/conn.php';
$conn = dbConnect();

if(isset($_POST['signed']) && $_POST['signed'] == 1) {
  $userName = mysqli_real_escape_string($conn, $_POST['newName']);
  $email = mysqli_real_escape_string($conn, $_POST['newEmail']);
  $pass = mysqli_real_escape_string($conn, $_POST['newPass']);
  $password = password_hash($pass, PASSWORD_DEFAULT);

  //Kollar om namnet är upptaget
  $check = "SELECT * FROM kund WHERE kundNamn='$userName'";
  $checkres= mysqli_query($conn, $check);
  if(mysqli_fetch_array($checkres)) {
    $warning = '<p class="warning">Användarnamnet är redan upptaget!</p>';
  } else {
    $query = "INSERT INTO kund (kundNamn, email, password) VALUES('$userName', '$email', '$password')";
    $result = mysqli_query($conn, $query) or die("Query failed: $query");
    $insId = mysqli_insert_id($connection);
    header("Location: login.php");
  }
}
 ?>

<div class="container">
  <div class="row">
    <div class="col-md-9 card login">
      <form class="signup-form" action="signup.php" method="post">
        <input type="hidden" name="signed" value="1">
        <div class="form-group">
          <input  class="form-control" type="text" name="newName" placeholder="Ange ett användernamn">
        </div>
        <?php echo $warning; ?>
        <div class="form-group">
          <input  class="form-control" type="password" name="newPass" placeholder="Ange ett lösenord">
        </div>
        <div class="form-group">
          <input  class="form-control" type="email" name="newEmail" placeholder="Ange din epostadress">
        </div>
        <button class="btn-book" type="submit" name="button">Skapa konto</button>
      </form>
    </div>
  </div>
</div>
<?php dbClose($conn);?>
