<?php
require_once dirname(__FILE__).'/../../init.php';
require_once $pathCustomerCommonInclude.'/pageCustomerCommon.php';

abstract class PageSearchCommon extends PageCustomerCommon
{
  public function __construct($menuMain, $subMenu)
  {
    parent::__construct($menuMain, $subMenu);
  }
}