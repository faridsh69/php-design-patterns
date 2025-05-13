<?php

namespace App\Models;

use App\Laravel\Db\Concretes\Db;
use PDO;

/**
 * @property int $id
 */
class User
{
  public Db $db;

  public function __construct(Db $db)
  {
    $this->db = $db;
  }

  public function get()
  {
    $sql = "SELECT id, name, email FROM users WHERE id='1'";
    $result = $this->db->dbInstance->query($sql);


    return $result->fetch(PDO::FETCH_ASSOC);
  }
}
