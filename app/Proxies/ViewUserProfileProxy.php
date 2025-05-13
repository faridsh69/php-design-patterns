<?php

namespace App\Proxies;

class ViewUserProfile
{
  public function getProfile()
  {
    echo 'get profile';
  }
}

class ViewUserProfileProxy extends ViewUserProfile
{
  public function getProfile()
  {
    if (!isset($_SESSION['user'])) {
      echo "Access Denied: Only admins can view profile.\n";
      return;
    }

    return parent::getProfile();
  }
}
