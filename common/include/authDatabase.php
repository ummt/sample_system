<?php
require_once 'databaseCommon.php';

class AuthDatabase extends DatabaseCommon {
  function __construct() {
    parent::__construct();
  }

  // ユーザの存在確認
  public function countUser($loginId, $loginPassword, &$count) {
    $count = 0;
    $loginPassword = md5($loginPassword);

    $sql  = ' SELECT COUNT(*) AS cnt FROM user ';
    $sql .= ' WHERE is_deleted = :is_deleted ';
    $sql .= ' AND login_id = :login_id ';
    $sql .= ' AND login_password = :login_password ';
    $sql .= ' ORDER BY id ';

    $stmt = $this->prepare($sql);

    $stmt->bindValue(':login_id', $loginId);
    $stmt->bindValue(':login_password', $loginPassword);
    $stmt->bindValue(':is_deleted', '0');

    try {
      $stmt->execute();
      $rows = $stmt->fetchAll();
      if(count($rows) === 1){
        $count = (int)$rows[0]['cnt'];
      }
    } catch (PDOException $e) {
      $this->error('selectUser failed: '.$e->getMessage());
      return false;
    }
    return true;
  }
}