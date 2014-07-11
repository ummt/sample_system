<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/rootSampleSystem.php';

/*サイトルートディレクトリ*/
$pathRoot = $_SERVER['DOCUMENT_ROOT'].SITE_PATH_DIR;

/*サイトルートURL*/
//$urlRoot = HYPER_TEXT_TRANSFER_PROTOCOL.'://'.$_SERVER['SERVER_NAME'].SITE_PATH_DIR;
$urlRoot = HYPER_TEXT_TRANSFER_PROTOCOL.'://'.$_SERVER["HTTP_HOST"].SITE_PATH_DIR;

/*共通ディレクトリへのパス*/
$pathCommon = $pathRoot.'/common';
$pathCommonInclude = $pathCommon.'/include';

/*共通ディレクトリへのURL*/
$urlCommon = $urlRoot.'/common';
$urlCommonJs = $urlCommon.'/js';
$urlCommonCss = $urlCommon.'/css';
$urlCommonImg = $urlCommon.'/images';