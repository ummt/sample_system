<?php
require_once dirname(__FILE__).'/init.php';
require_once $pathFrameSingle.'/frameSingle.php';

class Page extends FrameSingle
{
  private $subMenu;

  public function __construct($menuMain, $subMenu)
  {
    parent::__construct($menuMain);
    global $urlFrameSingleCss, $urlActive, $urlCustomer;

    $this->subMenu = $subMenu;

    $this->addLinkCss($urlFrameSingleCss.'/appList.css');

    $this->addBreadcrumbList('active', 'トップ', $urlActive.'/index.php');
    $this->addBreadcrumbList('customer' ,'顧客管理', $urlCustomer.'/index.php');

    $this->setAppTitle('顧客管理');
  }

  protected function getPageName()
  {
    return '顧客管理';
  }

  protected function getHtmlContents()
  {
    echo "<ul class=\"appList01\">";
    $menus = $this->subMenu->getMenu();
    foreach($menus as $menu)
    {
      echo "<li><a href=\"{$menu['url']}\">{$menu['name']}</a></li>";
    }
    echo "</ul>";
  }
}