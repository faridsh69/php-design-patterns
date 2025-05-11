<?php

namespace App\Models;

class User
{
  public $dbInstance;

  public function __construct($dbInstance)
  {
    $this->dbInstance = $dbInstance;
  }

  public function get()
  {
    $sql = "SELECT id, name, email FROM users WHERE id='1'";
    $result = $this->dbInstance->query($sql);
    // dd($result);

    return ['name' => 'John Doe'];
  }
}
