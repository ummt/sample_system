<?php
require_once dirname(__FILE__).'/../../init.php';
require_once $pathCommonInclude.'/pageCommon.php';

abstract class PageActive extends PageCommon
{
  public function __construct()
  {
    parent::__construct();

    /*ログインしているか確認*/
    if (!$this->auth->check())
    {
      global $urlRoot;
      header("Location: {$urlRoot}");
    }
  }
}