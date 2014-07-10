<?php
require_once dirname(__FILE__).'/../../../../../../init.php';
require_once $pathFrameLayout.'/frameLayout.php';

abstract class FrameSideNavi extends FrameLayout {
  public function __construct($mainMenu)
  {
    global $urlFrameSideNaviCss;
    parent::__construct($mainMenu);
    $this->addLinkCss($urlFrameSideNaviCss.'/frameSideNavi.css');
  }

  protected function getHtmlMainSection()
  {
?>
<section id="mainSection">
<?php echo $this->getHtmlContents(); ?>
</section><!--mainSection-->
<section id="sideNavi">
<?php echo $this->getHtmlSideNavi(); ?>
</section><!--sideNavi-->
<?php
  }

  /* コンテンツを取得 */
  abstract protected function getHtmlContents();
  abstract protected function getHtmlSideNavi();
}