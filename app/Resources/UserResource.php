<?php

namespace App\Resources;

class UserResource
{
  public function toArray()
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'email' => $this->email,
    ];
  }
}
