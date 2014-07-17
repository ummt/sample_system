<?php
require_once dirname(__FILE__).'/init.php';
require_once $pathCommonInclude.'/databaseCommon.php';

class Database extends DatabaseCommon
{
  function __construct() {
    parent::__construct();
  }

  // 都道府県を取得
  public function getPrefectures(&$prefectures) {
    $prefectures = array();
    $sql  = ' SELECT id, name FROM prefecture ';
    $sql .= ' ORDER BY id ';
    $stmt = $this->prepare($sql);
    try {
      $stmt->execute();
      $rows = $stmt->fetchAll();
      $prefectures = $rows;
    } catch (PDOException $e) {
      $this->error('getPrefectures failed: '.$e->getMessage());
      return false;
    }
    return true;
  }

  // 検索結果一覧を取得
  public function getSearchList($criteria, &$rows) {
    $rows = array();

    // 条件
    $sqlCriteria = '';
    foreach ($criteria as $key => $value) {
      if ($sqlCriteria === ''){
        $sqlCriteria .= ' WHERE ';
      }else{
        $sqlCriteria .= ' AND ';
      }
      switch ($key) {
      case 'customer_id': // 顧客ID
        $sqlCriteria .= ' c.id = :customer_id ';
        break;
      case 'customer_name': // 顧客名
        $sqlCriteria .= ' c.name LIKE :customer_name ';
        break;
      }
    }

    $sql  = ' SELECT ';
    $sql .= ' c.id AS customer_id, ';
    $sql .= ' c.name AS customer_name, ';
    $sql .= ' p.name AS prefecture_name, ';
    $sql .= ' address1, ';
    $sql .= ' address2, ';
    $sql .= ' tel ';
    $sql .= ' FROM customer AS c ';
    $sql .= ' LEFT JOIN prefecture AS p ON c.prefecture_id = p.id ';
    $sql .= $sqlCriteria; //' WHERE
    $sql .= ' ORDER BY c.id ';

    $stmt = $this->prepare($sql);

    // バインド
    foreach ($criteria as $key => $value) {
      $stmt->bindValue(':'.$key, $value);
    }

    try {
      $stmt->execute();
      $rows = $stmt->fetchAll();
    } catch (PDOException $e) {
      $this->error('getSearchList failed: '.$e->getMessage());
      return false;
    }
    return true;
  }
}