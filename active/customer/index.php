<?php
/* 顧客管理 */
require_once dirname(__FILE__).'/page.php';
$page = new Page($mainMenu, $subMenu);
$page->getPage();