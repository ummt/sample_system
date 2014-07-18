<?php
require_once dirname(__FILE__).'/../../../init.php';
require_once $pathCommonInclude.'/databaseCommon.php';

class Database extends DatabaseCommon
{
  function __construct() {
    parent::__construct();
  }

  public function getCustomer($customerId, &$customer) {
    $customer = array();

    $sql  = ' SELECT ';
    $sql .= ' c.id AS customer_id, ';
    $sql .= ' c.name AS customer_name, ';
    $sql .= ' name_kana, ';
    $sql .= ' gender, ';
    $sql .= ' birth_date, ';
    $sql .= ' zip_code, ';
    $sql .= ' address1, ';
    $sql .= ' address2, ';
    $sql .= ' tel, ';
    $sql .= ' mail, ';
    $sql .= ' is_deleted, ';
    $sql .= ' p.name AS prefecture_name ';
    $sql .= ' FROM customer AS c ';
    $sql .= ' LEFT JOIN prefecture AS p ON c.prefecture_id = p.id ';
    $sql .= ' WHERE c.id = :customer_id ';
    $sql .= ' ORDER BY c.id ';

    $stmt = $this->prepare($sql);

    $stmt->bindValue(':customer_id', $customerId);

    try {
      $stmt->execute();
      $rows = $stmt->fetchAll();
      $customer = $rows;
    } catch (PDOException $e) {
      $this->error('getCustomer failed: '.$e->getMessage());
      return false;
    }
    return true;
  }
}