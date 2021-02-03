<?php

namespace App\Handler;

use DB\Database;

class Model {
  protected $db;

  /*
  конструктор инициализации базы
  */
  public function __construct()
  {
    $this->db =  new Database();
  }

  /*
  вывод только первого элемента
  */
  protected function first($query)
  {
    $sql = $query . " LIMIT 1";

    $result = $this->db->query($sql);

    return array_shift($result);
  }

  /*
  защищенный метод для получения sql-кода
  и отправки его (и исполения) к БД
  работаем без связуемых таблиц
  */
  protected function get($table)
  {
    $sql = "SELECT * FROM " . $table;

    $result = $this->db->query($sql);

    return $result;
  }

  /*
  показать все данные из таблицы
  */
  protected function all($table, $params, $group_key, $table_key)
  {
    $sql = $this->sctuctureQuery($table, $params, $group_key, $table_key);

    $result = $this->db->query($sql);

    return $result;
  }

  /*
  составляем sql-запрос из предложенных параметров
  разбираем массив $params на следующие пункты:
  - table => название связываемой таблицы
  - foreign_key => требуемая связываемое поле с таблицей модели
  Сравнивая с количеством таблиц выясняем последняя ли группировка
  Если последняя, то не добавляем AND в запрос
  $group_length - вычисляем ключ для группировки. Если пользователь ничего не ввел,
  то группируем по id таблицы модели
  */
  public function sctuctureQuery($table, $params, $group_key, $table_key)
  {
    $where = '';
    $selected_tables = $table;
    $count = count($params);
    $group_length = strlen(str_replace(' ', '', $group_key));
    if ($group_length == 0) {
      $group_key = 'id';
    }

    if ($count > 0) {
      $where = ' WHERE ';
      foreach ($params as $key => $value) {
        $selected_tables = $selected_tables . ', ' . $value['table'];
        if ($key == $count-1) {
          $where .=  $table . '.' . $value['foreign_key'] . '=' . $value['table']. '.id ';
        }else {
          $where .=  $table . '.' . $value['foreign_key'] . '=' . $value['table']. '.id AND ';
        }
      }
      $where .= ' GROUP BY ' . $table. '.' . $group_key;
    }
    $sql = "SELECT *, " . $table . ".id AS " . $table_key . " FROM " . $selected_tables . $where;

    return $sql;
  }

  /*
  поиск только одной запаси по параметрам
  */
  public function findById($table, $id)
  {
    $params = ['id' => $id];
    $sql = "SELECT * FROM " . $table . ' WHERE id = :id';

    $result = $this->db->execute($sql, $params);

    return $result;
  }
}
