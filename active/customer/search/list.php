<?php
/* 顧客検索 一覧 */
require_once dirname(__FILE__).'/pageList.php';
$page = new Page($mainMenu, $subMenu);
$page->getPage();