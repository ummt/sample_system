<?php
require_once dirname(__FILE__).'/init.php';
require_once $pathCommonInclude.'/databaseCommon.php';

class Database extends DatabaseCommon
{
  function __construct() {
    parent::__construct();
  }

  public function getInfo(&$infos) {
    $infos = array();

    $sql  = ' SELECT id, subject, post_date, contents, update_date FROM info ';
    $sql .= ' ORDER BY post_date DESC, id DESC ';

    $stmt = $this->prepare($sql);

    try {
      $stmt->execute();
      $rows = $stmt->fetchAll();
      $infos = $rows;
    } catch (PDOException $e) {
      $this->error('getInfo failed: '.$e->getMessage());
      return false;
    }
    return true;
  }
}