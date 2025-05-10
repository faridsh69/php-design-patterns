<?php

namespace App\Services\Db\Concretes;

use App\Services\Db\Contracts\DbContract;
use mysqli;

class DbConcrete implements DbContract
{
  public $testSingleton;

  public function __construct()
  {
    $this->testSingleton = rand(1, 100);
  }

  public function connect()
  {

    $servername = "localhost";
    $username = "1";
    $password = "1";
    $dbname = '1';

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT id, name, email FROM users WHERE id='1'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      while ($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"] . " - Name: " . $row["name"] . " " . $this->testSingleton . "<br>";
      }
    } else {
      echo "0 results";
    }
    // $conn->close();
  }
}
