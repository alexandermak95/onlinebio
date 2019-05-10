<?php
// inkluderar databas anslutningen
require 'conn.php';

// Hämtar alla kunder
function getKunder($conn){
  $query = 'SELECT * FROM kund';
  $result = mysqli_query($conn, $query);
  return $result;
}

// Hämtar alla filmer
function getMovies($conn){
  $query = 'SELECT * FROM filmer';
  $result = mysqli_query($conn, $query);
  return $result;
}

 ?>
