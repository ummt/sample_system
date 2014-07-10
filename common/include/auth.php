<?php
require_once 'authDatabase.php';

class Auth
{
  const ADMIN = 'A'; // システム管理者
  const MANAGER = 'B';  // 組織長
  const USER = 'C';  // 一般ユーザ

  public function __construct()
  {
    session_start();
  }

  /*ログイン処理*/
  public function login($loginId, $loginPassword, &$message = '')
  {
    $db = new AuthDatabase();
    $db->countUser($loginId, $loginPassword, $count);
    if ($count === 1){
      $_SESSION['loginId'] = $loginId;
      $_SESSION['loginPassword'] = $loginPassword;
      $_SESSION['loginAuth'] = $this->ADMIN;
      $message = 'ログイン成功';
      return true;
    }
    else {
      $message = 'ユーザもしくはパスワードが異なります';
    }
    return false;
  }

  /*ログインしているか確認*/
  public function check(&$message = '')
  {
    if (!isset($_SESSION['loginId']))
    {
      $message = 'ログインされていません';
      return false;
    }
    return true;
  }

  /*rログアウト処理*/
  public function logout()
  {
    session_destroy();
  }
}
