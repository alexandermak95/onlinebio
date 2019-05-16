<?php require './classes/user.php'; ?>
<?php require './classes/admin.php'; ?>
<?php require './functions/conn.php'; ?>
<?php include "header.php"; ?>
<?php $conn = dbConnect(); ?>
<!-- Kollar Om man är inloggad  -->
<?php if(!isset($_SESSION['status'])) {
  header('Location:index.php');
  exit;
} ?>
<div class="container">
  <div class="row">
    <div class="col-md-10">
      <h2>Mina uppgifter:</h2>
      <?php $users = new User($_SESSION['kundId']);
            $row = mysqli_fetch_array($users->userInfo($conn));
            if($row) {
              echo 'Mitt användarnamn:' . $row['kundNamn'] .'<br>';
              echo 'Min epostadress: ' . $row['email'] .'<br>';
            }
      ?>
    </div>
  </div>
</div>

<!-- IF ADMIN  -->
<?php if(isset($_SESSION['admin'])) : ?>
  <?php $admin = new Admin($_SESSION['kundId'],true); ?>
  <!-- Lägger till nya filmer -->
<?php
if (isset($_POST['filmset']) && $_POST['filmset'] == 1) :
  $target_dir = "assets/images/";
  $file = $_FILES['cover']['name'];
  $path = pathinfo($file);
  $filename = $path['filename'];
  $ext = $path['extension'];
  $temp_name = $_FILES['cover']['tmp_name'];
  $path_filename_ext = $target_dir.$filename.".".$ext;
  if (file_exists($path_filename_ext)) {
   echo "<p class='warning'> Bilden finns redan!</p>";
  }else{
   move_uploaded_file($temp_name,$path_filename_ext);
  }
  $title = mysqli_real_escape_string($conn,$_POST['titel']);
  $age = mysqli_real_escape_string($conn,$_POST['age']);
  $date = mysqli_real_escape_string($conn,$_POST['date']);
  $price = mysqli_real_escape_string($conn,$_POST['price']);
  $seats = mysqli_real_escape_string($conn,$_POST['seats']);
  $cover = mysqli_real_escape_string($conn,$_FILES['cover']['name']);
  $query = "INSERT INTO film (filmTitel, filmAge, filmPris, filmDate, platser, filmCover)
            VALUES('$title', '$age', '$price', '$date', '$seats', '$cover')";
  $result = mysqli_query($conn, $query);
  endif;
 ?>

<div class="container">
  <div class="row">
    <div class="col-md-10">
      <button id="showbox" class="btn-book" type="button" name="button">Lägg till filmer</button>
      <button id="showbox-2" class="btn-book" type="button" name="button">Alla filmer</button>
      <div class="card login">
        <form class="film" action="account.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="filmset" value="1">
            <div class="form-group">
              <input type="text" name="titel" placeholder="Title" class="form-control">
            </div>
            <div class="form-group">
              <input type="number" name="age" min="7" placeholder="Åldersgräns" class="form-control">
            </div>
            <div class="form-group">
              <input type="date" name="date" placeholder="Datum" class="form-control">
            </div>
            <div class="form-group">
              <input type="number" name="seats" placeholder="Platser" class="form-control">
            </div>
            <div class="form-group">
              <input type="number" name="price" placeholder="Pris" class="form-control">
            </div>
            <div class="input-group mb-3">
              <div class="custom-file">
                <input type="file" name="cover" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                <label class="custom-file-label" for="inputGroupFile01">Välj bild</label>
              </div>
            </div><br>
            <button class="btn-book" type="submit" name="button">Lägg till</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
<?php dbClose($conn); ?>
