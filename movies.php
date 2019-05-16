<?php
session_start();
require './functions/conn.php';
require './functions/getList.php';
$conn = dbConnect();
// Hämtar array med önskad tabell från db
$result= getList($conn, 'film');

while ($movies = mysqli_fetch_array($result)) : ?>
 <div class="col-md-3">
   <div class="card">
     <img src="./assets/images/<?php echo $movies['filmCover'];?>" alt="">
     <div class="text">
       <div class="right">
         <h4>+ <?php echo $movies['filmAge']; ?></h4>
       </div>
       <div class="left">
         <h4><?php echo $movies['filmTitel'];?></h4>
       </div>
     </div>
   </div>
 </div>

<?php  endwhile; dbClose($conn);?>
