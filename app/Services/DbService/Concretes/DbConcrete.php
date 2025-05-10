<?php

namespace Test\Simple\Services\DbService\Concretes;

class DbConcrete implements DbContract
{
  public function connect()
  {
    echo 'connecting to db';
  }
}
