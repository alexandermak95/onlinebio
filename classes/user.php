<?php
class User {
  private $userID;

  public function __construct($userID ) {
    $this->userID = $userID;
  }

  public function userInfo($conn) {
    //hämtar userInfo från DB
    $query = "SELECT * FROM kund WHERE kundId='$this->userID'";
    $result = mysqli_query($conn,$query);
    return $result;
  }
}


 ?>
