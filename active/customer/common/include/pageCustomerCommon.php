<?php
require_once dirname(__FILE__).'/../../init.php';
require_once $pathFrameSideNavi.'/frameSideNavi.php';

abstract class PageCustomerCommon extends FrameSideNavi
{
  private $subMenu;

  public function __construct($menuMain, $subMenu)
  {
    parent::__construct($menuMain);
    $this->subMenu = $subMenu;
  }

  protected function getHtmlSideNavi()
  {
    echo "<div class=\"title\">顧客管理</div>";
    echo "<nav>";
    echo "<ul>";
    $menus = $this->subMenu->getMenu();
    foreach($menus as $menu)
    {
      echo "<li><a href=\"{$menu['url']}\" class=\"selected\">{$menu['name']}</a></li>";
    }
    echo "</ul>";
    echo "</nav>";
  }
}