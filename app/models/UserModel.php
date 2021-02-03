<?php

namespace App\Model;

use App\Handler\Model;

class UserModel extends Model {
  private $table = "users"; // таблица с которой будем работать

  /*
    статический метод для возврата якобы
    авторизованного пользователя
  */
  static function showAuth()
  {
    $user = new UserModel();
    $query = $user->authQuery();

    $result = $user->first($query);

    return $result;
  }

  /*
    sql запрос для выборки авторизованного пользователя
  */
  public function authQuery()
  {
    $sql = "SELECT * FROM " . $this->table;

    return $sql;
  }
}
