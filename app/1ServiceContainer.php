<?php

interface SampleContract {}

class SampleConcrete implements SampleContract
{
  public $db;
  public function __construct(DbContract $db)
  {
    $this->db = $db;
  }

  public function init()
  {
    echo 123;
  }
}
