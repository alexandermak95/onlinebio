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

<!-- Kunder bara, ej admin! -->
<?php if(!isset($_SESSION['admin'])) : ?>
<div class="container">
  <div class="row">
    <div class="col-md-10">
      <div class="userInfo">
        <h2>Mina uppgifter</h2>
        <?php $users = new User($_SESSION['kundId']);
              $row = mysqli_fetch_array($users->userInfo($conn));
              if($row) {
                echo '<strong>Användarnamn: </strong>' . $row['kundNamn'] .'<br>';
                echo '<strong>Epostadress: </strong>' . $row['email'] .'<br>';
              }
        ?>
      </div>
      <div class="orders">
        <h2>Köpta biljetter</h2>
        <?php $orders = $users->getSpec($conn, $_SESSION['kundId']); ?>
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Titel</th>
              <th scope="col">Datum</th>
              <th scope="col">Antal biljetter</th>
            </tr>
          </thead>
          <tbody>
        <?php
        while($order = mysqli_fetch_array($orders)) {?>
                  <tr>
                    <th scope="row"><?php echo $order['filmTitel']; ?></th>
                    <td><?php echo $order['filmDate']; ?></td>
                    <td><?php echo $order['antalTickets']; ?></td>
                  </tr>
          <?php } ?>
         </tbody>
       </table>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

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

  $title = mysqli_real_escape_string($conn,$_POST['titel']);
  $age = mysqli_real_escape_string($conn,$_POST['age']);
  $date = mysqli_real_escape_string($conn,$_POST['date']);
  $price = mysqli_real_escape_string($conn,$_POST['price']);
  $seats = mysqli_real_escape_string($conn,$_POST['seats']);
  $cover = mysqli_real_escape_string($conn,$_FILES['cover']['name']);
  $query = "INSERT INTO film (filmTitel, filmAge, filmPris, filmDate, platser, filmCover)
            VALUES('$title', '$age', '$price', '$date', '$seats', '$cover')";
  $result = mysqli_query($conn, $query);
  }
  endif;
 ?>


 <!-- Radera film -->
 <?php if(isset($_POST['delete']) && $_POST['delete'] > 0) {
   $admin->deleteFilm($conn, $_POST['delete']);
 } ?>

 <!-- Redigera film  -->
 <?php if (isset($_POST['edit']) && $_POST['edit'] > 0) {
   $admin->updateFilm($conn, $_POST['edit']);
 } ?>

<div class="container">
  <div class="row">
    <div class="col-md-10">
      <div class="row">
        <div class="col-md-10 buttons">
          <button id="showbox" class="btn-book" type="button" name="button">Lägg till filmer</button>
          <button id="showbox-2" class="btn-book" type="button" name="button">Alla filmer</button>
        </div>
      </div>
      <div class="row all-movies">
        <div class="col-md-12">
          <div class="movies">
            <?php $filmer = $admin->getList($conn, 'film'); ?>
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Title</th>
                  <th scope="col">Datum</th>
                  <th scope="col">Platser</th>
                  <th scope="col">Pris</th>
                  <th scope="col">Redigera</th>
                  <th scope="col">Radera</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 0; ?>
              <?php while($film = mysqli_fetch_array($filmer)) : $i++; ?>
                    <tr>
                      <th scope="row"><?php echo $i; ?></th>
                      <td><?php echo $film['filmTitel'];?></td>
                      <td><?php echo $film['filmDate'];?></td>
                      <td><?php echo $film['platser'];?></td>
                      <td><?php echo $film['filmPris'];?></td>
                      <td class="edit">
                        <span>&#9998;</span>
                        <form class="editform" action="account.php" method="post">
                          <input type="hidden" name="edit" value="<?php echo $film['filmId'];?>">
                          <input type="text" name="titel" value="<?php echo $film['filmTitel'];?>">
                          <input type="text" name="date" value="<?php echo $film['filmDate'];?>">
                          <input type="text" name="seats" value="<?php echo $film['platser'];?>">
                          <input type="text" name="price" value="<?php echo $film['filmPris'];?>">
                          <button type="submit" name="button">Uppdatera</button>
                        </form>
                      </td>
                      <td>
                        <form action="account.php" method="post">
                        <input type="hidden" name="delete" value="<?php echo $film['filmId']; ?>">
                        <button class="remove" type="submit" value="radera"><span>&#9747;</span></button>
                      </form>
                    </td>
                    </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
          </div>
        </div>
      </div>
      <div class="row add-movies">
        <div class="col-md-10">
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
                <button  class="btn-book" type="submit" name="button">Lägg till</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
<?php dbClose($conn); ?>
<?php include 'footer.php'; ?>
