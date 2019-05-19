<?php
session_start();
require './functions/conn.php';
require './functions/getList.php';
$conn = dbConnect();
// Hämtar array med önskad tabell från db
$result= getList($conn, 'film');

while ($movies = mysqli_fetch_array($result)) : ?>
<?php if ($movies['platser'] > 0): ?>
 <div class="col-md-3">
   <div class="card">
     <img src="./assets/images/<?php echo $movies['filmCover'];?>" alt="">
     <div class="text">
       <div class="row">
         <div class="col-8 left">
          <h4><?php echo $movies['filmTitel'];?></h4>
         </div>
         <div class="col-4 right">
          <h4>+ <?php echo $movies['filmAge']; ?></h4>
         </div>
       </div>
       <div class="row">
         <div class="col-md-12">
           <div class="row">
             <div class="col-12 middle">
               <span class="plus">+</span>
               <span class="minus">-</span>
               <div class="more">
                 <div class="row">
                   <div class="info">
                    <p>Datum: <?php echo $movies['filmDate']; ?></p>
                   </div>
                   <div class="info">
                    <p>Lediga platser: <?php echo $movies['platser']; ?></p>
                   </div>
                   <div class="info">
                    <p>Pris: <?php echo $movies['filmPris']; ?> kr</p>
                   </div>
                 </div>
                 <div class="row">
                   <div class="col-md-10">
                     <div class="boka">
                       <?php if(isset($_SESSION['status'])) : ?>
                       <a class="btn-book" href="bokning.php">Biljetter</a>
                     <?php else : ?>
                       <a class="btn-book" href="login.php">Biljetter</a><br>
                     <?php endif; ?>
                     </div>
                   </div>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </div>
<?php endif; ?>
<?php  endwhile; dbClose($conn);?>
