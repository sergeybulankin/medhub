<?php

namespace App\Controller;

use App\Model\AccountModel;
use Core\View;

class AccountController {
  /*
  вывод аккаунтов
  */
  public function show()
  {
    $accounts = AccountModel::index();

    foreach ($accounts as $key => $value) {
      echo 'Email: ' . $value->email . '<br>' .
      'Имя/Фамилия: ' . $value->name . ' ' . $value->surname . '<br>' .
      'Уровень доступа: ' . $value->name_access . ' с уровнем ' . $value->level_access . '<br>' .
      'Пользовательский ID:
          <a href=account?id=' . $value->account_key .'>' . $value->account_key . '</a><br><br><hr/><br>';
    }
  }

  /*
  Выводим один результат аккаунта
  */
  public function showAccount()
  {
    $id = $_GET['id'];
    $account = new AccountModel();
    $result = $account->find($id);

    View::render('show_account.php', ['account' => $result]);
  }
}
