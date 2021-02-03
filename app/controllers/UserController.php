<?php

namespace App\Controller;

use App\Model\UserModel;

class UserController {
  /*
  вывборка авторизованного пользователя
  */
  public function showAuth()
  {
    $user = UserModel::showAuth();

    echo "USER - " . $user->login . " с ID " . $user->id;
  }
}
