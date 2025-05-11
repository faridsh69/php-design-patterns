<?php

namespace App\Laravel\Db\Concretes;

use App\Laravel\Db\Contracts\DbContract;
use mysqli;
use App\Laravel\Config;

final class Db implements DbContract
{
  public $dbInstance;
  private Config $config;

  public function __construct(Config $config)
  {
    $this->config = $config;
    $this->connect();
  }

  public function connect()
  {
    $config = $this->config->getAll();
    $dbInstance = new mysqli($config['host'], $config['user'], $config['password'], $config['dbname']);

    if ($dbInstance->connect_error) {
      die("Connection failed: " . $dbInstance->connect_error);
    }

    $this->dbInstance = $dbInstance;
  }
}
