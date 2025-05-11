<?php

namespace App\Laravel\Db\Concretes;

use App\Laravel\Db\Contracts\DbContract;
use mysqli;

final class Db implements DbContract
{
  public $dbInstance;

  public function __construct()
  {
    $this->connect();
  }

  public function connect()
  {
    $config = [
      'database' => [
        'host' => 'localhost',
        'user' => '1',
        'password' => '1',
        'dbname' => '1',
      ],
    ];
    $dbConfig = $config['database'];

    $dbInstance = new mysqli($dbConfig['host'], $dbConfig['user'], $dbConfig['password'], $dbConfig['dbname']);

    if ($dbInstance->connect_error) {
      die("Connection failed: " . $dbInstance->connect_error);
    }

    $this->dbInstance = $dbInstance;

    // $sql = "SELECT id, name, email FROM users WHERE id='1'";
    // $result = $conn->query($sql);

    // if ($result->num_rows > 0) {
    //   // output data of each row
    //   while ($row = $result->fetch_assoc()) {
    //     echo "id: " . $row["id"] . " - Name: " . $row["name"] . " " . $this->testSingleton . "<br>";
    //   }
    // } else {
    //   echo "0 results";
    // }
    // // $conn->close();
  }
}
