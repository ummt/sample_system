<?php
require_once dirname(__FILE__).'/../../../../../../init.php';
require_once $pathFrameLayout.'/frameLayout.php';

abstract class FrameSingle extends FrameLayout {
  public function __construct($mainMenu)
  {
    global $urlFrameSingleCss;
    parent::__construct($mainMenu);

    $this->addLinkCss($urlFrameSingleCss.'/frameSingle.css');
  }

  protected function getHtmlMainSection()
  {
?>
<section id="mainSection" class="clearfix">
<?php echo $this->getHtmlContents(); ?>
</section><!--mainSection-->
<?php
  }

  /* コンテンツを取得 */
  abstract protected function getHtmlContents();
}