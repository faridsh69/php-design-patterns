<?php

namespace App\Laravel;

final class Cache
{
  public function remember($key, $time, $value)
  {
    echo 'cache ' . $key . ' for ' . $time . ' minutes <br>';
    var_dump($value);
  }
}
