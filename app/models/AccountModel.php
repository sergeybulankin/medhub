<?php

namespace App\Model;

use App\Handler\Model;

class AccountModel extends Model {
  private $table = 'accounts';

  /*
  показываем аккаунты

  второй параметр при вызове all - связуемые параметры
  при составлении запроса
  ключ table - связываемая таблицы
  ключ foreign_key - связываемый ключ таблицы модели
  */
  static function index()
  {
    $account = new AccountModel();

    $pivot_table = [
      [
        'table' => 'users',
        'foreign_key' => 'user_id'
      ],
      [
        'table' => 'accesses',
        'foreign_key' => 'access_id'
      ],
    ];

    return $account->all($account->query(), $pivot_table, '', 'account_key');
  }

  /*
  поиск по id в модели
  */
  public function find($id)
  {
    return $this->findById($this->table, $id);
  }

  /*
  подготавливаем запрос
  */
  public function query()
  {
    return $this->table;
  }
}
