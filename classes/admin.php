<?php
class Admin extends User {
  private $admin;

  public function __construct($userID, $admin) {
    $this->$admin = $admin;
    parent::__construct($userID);
  }


}
 ?>
