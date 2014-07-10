<?php
require_once dirname(__FILE__).'/../../../../../init.php';
require_once $pathFrame.'/patternFrame.php';
abstract class FrameLayout extends PatternFrame {
  public function __construct($mainMenu)
  {
    parent::__construct($mainMenu);
  }
}