<?php
require_once dirname(__FILE__).'/../../../../init.php';
require_once $pathPattern.'/pattern.php';

abstract class PatternPlane extends Pattern
{
  public function __construct()
  {
    global $urlPlaneCss;
    parent::__construct();

    $this->addLinkCss($urlPlaneCss.'/patternPlane.css');
  }

  protected function getHtmlBody()
  {
    return $this->getHtmlMainSection();
  }

  /*メインセクションHTMLを取得*/
  abstract protected function getHtmlMainSection();
}