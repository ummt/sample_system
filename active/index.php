<?php
/*トップ*/
require_once dirname(__FILE__).'/page.php';
$page = new Page($mainMenu);
$page->getPage();