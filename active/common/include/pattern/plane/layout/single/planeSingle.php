<?php
require_once dirname(__FILE__).'/../../../../../../init.php';
require_once $pathPlaneLayout.'/planeLayout.php';

abstract class PlaneSingle extends PlaneLayout {
  public function __construct()
  {
    global $urlPlaneSingleCss;
    parent::__construct();

    $this->addLinkCss($urlPlaneSingleCss.'/planeSingle.css');
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