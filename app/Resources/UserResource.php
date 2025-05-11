<?php

namespace App\Resources;

class UserResource
{
  public function toArray($users)
  {
    return json_encode($users);
  }
}
