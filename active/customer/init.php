<?php
require_once dirname(__FILE__).'/../init.php';

const DIR_NAME_CUSTOMER = 'customer';

$pathCustomer = $pathActive.'/'.DIR_NAME_CUSTOMER;
$pathCustomerCommon = $pathCustomer.'/common';
$pathCustomerCommonInclude = $pathCustomerCommon.'/include';

$urlCustomer = $urlActive.'/'.DIR_NAME_CUSTOMER;

/* subMenu start */
$subMenu = new Menu();
$subMenu->setMenu('顧客検索', Auth::USER, $urlCustomer.'/search/index.php');
/* subMenu end */