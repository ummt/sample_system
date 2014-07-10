<?php
require_once dirname(__FILE__).'/../init.php';

const DIR_NAME_ACTIVE = 'active';

/*path*/
$pathActive = $pathRoot.'/'.DIR_NAME_ACTIVE;

$pathActiveCommon = $pathActive.'/common';
$pathActiveCommonInclude = $pathActiveCommon.'/include';
$pathPattern = $pathActiveCommonInclude.'/pattern';

$pathFrame = $pathPattern.'/frame';
$pathFrameLayout = $pathFrame.'/layout';
$pathFrameSingle = $pathFrameLayout.'/single';
$pathFrameSideNavi = $pathFrameLayout.'/sideNavi';

$pathPlane = $pathPattern.'/plane';
$pathPlaneLayout = $pathPlane.'/layout';
$pathPlaneSingle = $pathPlaneLayout.'/single';

/*url*/
/*css*/
$urlActive = $urlRoot.'/'.DIR_NAME_ACTIVE;

$urlActiveCommon = $urlActive.'/common';
$urlActiveCommonCss = $urlActiveCommon.'/css';
$urlActiveCommonInclude = $urlActiveCommon.'/include';
$urlActiveCommonApp = $urlActiveCommon.'/app';
$urlPattern = $urlActiveCommonInclude.'/pattern';

$urlFrame = $urlPattern.'/frame';
$urlFrameCss = $urlFrame.'/css';
$urlFrameLayout = $urlFrame.'/layout';
$urlFrameSingle = $urlFrameLayout.'/single';
$urlFrameSingleCss = $urlFrameSingle.'/css';
$urlFrameSideNavi = $urlFrameLayout.'/sideNavi';
$urlFrameSideNaviCss = $urlFrameSideNavi.'/css';

$urlPlane = $urlPattern.'/plane';
$urlPlaneCss = $urlPlane.'/css';
$urlPlaneLayout = $urlPlane.'/layout';
$urlPlaneSingle = $urlPlaneLayout.'/single';
$urlPlaneSingleCss = $urlPlaneSingle.'/css';

$urlCustomerInfo = $urlActiveCommonApp.'/customerInfo';

/*image*/
$urlActiveCommonImg = $urlActiveCommon.'/images';

/* mainMenu start */
require_once $pathCommonInclude.'/menu.php';
require_once $pathCommonInclude.'/auth.php';
$mainMenu = new Menu();
$mainMenu->setMenu('顧客管理', Auth::USER, $urlActive.'/customer/index.php');
/* mainMenu end */
