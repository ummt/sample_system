<?php
require_once dirname(__FILE__).'/../../../../init.php';
require_once $pathPattern.'/pattern.php';

abstract class PatternFrame extends Pattern
{
  private $appTitle;
  private $mainMenu;
  private $breadcrumbList = array();

  public function __construct($mainMenu)
  {
    global $urlFrameCss;
    parent::__construct();
    $this->mainMenu = $mainMenu;
    $this->addLinkCss($urlFrameCss.'/patternFrame.css');
  }

  protected function getHtmlBody()
  {
    /*ログアウト*/
    if (isset($_POST['logout']))
    {
      $this->auth->logout();
      global $urlRoot;
      header("Location: {$urlRoot}/active/index.php");
    }

    /*ヘッダーロゴ*/
    global $urlActiveCommonImg;
    $imgLogoHtml = "<img src=\"$urlActiveCommonImg/logo.png\" alt=\"SampleCompany\">";
?>
<header id="pageHeader">
  <div id="headerLogo"><a href="index.php"><?php echo $imgLogoHtml; ?></a></div>
  <div id="headerMain">
    <div id="headerStatus" class="text02">
      <div id="systemName"><?php echo SITE_NAME; ?></div>
      <div id="loginInfo" class="text01">ユーザID&nbsp;：&nbsp;XXXX
      <form method="POST" action="">
      <input type="submit" name="logout" value="ログアウト" style="color: #333333;">
      </form>
      </div>
    </div>
    <nav id="globalNavi">
      <ul class="text02">
<?php
    $menus = $this->mainMenu->getMenu();

    foreach($menus as $menu)
    {
      echo "<li><a href=\"{$menu['url']}\" class=\"default\">{$menu['name']}</a></li>";
    }

    for($i = 0; $i < 11 - count($menus); $i++){
      echo "<li>&nbsp;</li>";
    }
?>
      </ul>
    </nav><!--globalNavi-->
  </div><!--headerMain-->
<?php echo $this->getHtmlBreadcrumbList(); ?>
  <div id="appTitle"><span><?php echo $this->getAppTitle(); ?></span></div>
</header><!--pageHeader-->
<?php echo $this->getHtmlMainSection(); ?>
<footer id="pageFooter">
  <div id="copyright" class="text01">copyright &copy; 20XX SampleCompany All Rights Reserved.</div>
</footer><!--pageFooter-->
<?php
  }

  /*パンくずリストHTMLを取得*/
  protected function getHtmlBreadcrumbList()
  {
    /* 最後のキーを取得 */
    end($this->breadcrumbList);
    $wrk = each($this->breadcrumbList);
    $keyEnd = $wrk['key'];

    $html  = "<nav id=\"breadcrumbList\">";
    $html .= "<ul class=\"text01\">";
    foreach($this->breadcrumbList as $key => $bcl)
    {
      if ($key === $keyEnd)
      {
        $html .= "<li class=\"selected\">{$bcl['name']}</li>";
      }
      else {
        $html .= "<li><a href=\"{$bcl['url']}\">{$bcl['name']}</a></li>";
      }
    }
    $html .= "</ul>";
    $html .= "</nav>";
    return $html;
  }

  /*パンくずリストに追加*/
  protected function addBreadcrumbList($id, $name, $url)
  {
    $this->breadcrumbList[$id] = array('name' => $name, 'url' => $url);
  }

  /*アプリケーション名を設定*/
  protected function setAppTitle($appTitle)
  {
    $this->appTitle = $appTitle;
  }

  /*アプリケーション名を取得*/
  private function getAppTitle()
  {
    return $this->appTitle;
  }

  /*メインセクションHTMLを取得*/
  abstract protected function getHtmlMainSection();
}