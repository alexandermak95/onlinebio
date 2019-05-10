<?php session_start();?>

<?php
$film1->name = 'Matrix';
$film1->img = "Matrix.jpg";
$film1->age = 7;

$film2->name = 'No pain no gain';
$film2->img = "pain.jpg";
$film2->age = 11;

$film3->name = 'Die hard';
$film3->img = "die.jpg";
$film3->age = 15;

$film4->name = 'Tomb raider';
$film4->img = "Tomb.jpg";
$film4->age = 11;


$filmer = array($film1, $film2, $film3, $film4);
$_SESSION['movies'] = $filmer;

foreach ($filmer as $film) : ?>
 <div class="col-md-3">
   <div class="card">
     <img src="./assets/images/<?php echo $film->img ?>" alt="">
     <div class="text">
       <div class="right">
         <h4>+ <?php echo $film->age; ?></h4>
       </div>
       <div class="left">
         <h4><?php echo $film->name ?></h4>
       </div>
     </div>

   </div>
 </div>

<?php  endforeach; ?>
