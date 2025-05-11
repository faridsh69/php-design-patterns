<?php

namespace App\Laravel;

class Config
{
  private $config;

  public function __construct()
  {
    $this->config = require_once __DIR__ . '/../Configs/database.php';
  }

  public function get($key)
  {
    return $this->config[$key];
  }

  public function getAll()
  {
    return $this->config;
  }
}
