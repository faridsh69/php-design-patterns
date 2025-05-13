<?php

namespace App\Laravel\Db\Concretes;

use App\Laravel\Db\Contracts\DbContract;
use PDO;

// use App\Laravel\Config;

final class Db implements DbContract
{
  public $dbInstance;
  // private Config $config;

  public function __construct()
  {
    // $this->config = $config;
    $this->connect();
  }

  public function connect()
  {
    // $config = $this->config->getAll();
    // $dbInstance = new mysqli($config['host'], $config['user'], $config['password'], $config['dbname']);
    $pdo = new PDO("sqlite:my_database.db");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY,
        name TEXT,
        email TEXT
    )";
    // $pdo->exec("INSERT INTO users (name, email) VALUES ('Alice', 'alice@example.com')");

    $pdo->exec($sql);

    $this->dbInstance = $pdo;
  }
}
