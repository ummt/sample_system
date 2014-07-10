<?php
require_once dirname(__FILE__).'/../../init.php';
require_once dirname(__FILE__).'/auth.php';

abstract class PageCommon
{
  private $tool;

  /* リンク配列 */
  private $aryLinkCss = array();  // CSS
  private $aryLinkJs = array(); // js

  protected $auth;  //認証管理オブジェクト

  public function __construct()
  {
    global $urlCommonCss, $urlCommonJs;

    /*認証管理オブジェクト生成*/
    $this->auth = new Auth();

    // CSSを追加
    $this->addLinkCss($urlCommonCss.'/normalize.css');
    $this->addLinkCss($urlCommonCss.'/reset.css');
    $this->addLinkCss($urlCommonCss.'/common.css');

    // jsを追加
    $this->addLinkJs($urlCommonJs.'/jquery-1.11.1.min.js');
  }

  /* ページの全HTMLを取得 */
  public function getPage()
  {
    global $urlCommonImg;

    /* favicon */
    $linkFavicon = "<link rel=\"icon\" type=\"image/vnd.microsoft.icon\" href=\"$urlCommonImg/favicon.ico\">";
?>
<!doctype html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<!--[if lt IE 9]>
<script type="text/javascript">
document.createElement("nav");
document.createElement("header");
document.createElement("footer");
document.createElement("section");
document.createElement("aside");
document.createElement("article");
</script>
<![endif]-->
<title><?php echo $this->getTitle(); ?></title>
<?php echo $linkFavicon; ?>
<?php echo $this->getHtmlLinkCss(); ?>
</head>
<body>
<?php echo $this->getHtmlBody(); ?>
<?php echo $this->getHtmlLinkJs(); ?>
<?php echo $this->getJs(); ?>
</body>
</html>
<?php
  }

  /* タイトルタグの要素を取得 */
  protected function getTitle()
  {
    $ret = '';
    if($this->getPageName() !== '')
    {
      $ret .= $this->getPageName();
      $ret .= '｜';
    }
    $ret .= SITE_NAME;
    return $ret;
  }

  /* ページ名を取得 */
  protected function getPageName()
  {
    return '';
  }

  /* CSSへのリンクリストに追加 */
  protected function addLinkCss($path)
  {
    $this->aryLinkCss[] = $path;
  }

  /* CSSへのリンクタグを取得 */
  protected function getHtmlLinkCss()
  {
    $html = '';
    foreach($this->aryLinkCss as $path)
    {
      $html .= "<link rel=\"stylesheet\" href=\"$path\" type=\"text/css\">";
    }
    return $html;
  }

  /* jsへのリンクリストに追加 */
  protected function addLinkJs($path)
  {
    $this->aryLinkJs[] = $path;
  }

  /* jsへのリンクタグを取得 */
  protected function getHtmlLinkJs()
  {
    $html = '';
    foreach($this->aryLinkJs as $path)
    {
      $html .= "<script src=\"$path\"></script>";
    }
    return $html;
  }

  /*埋め込みjs*/
  protected function getJs()
  {
    return '';
  }

  /* Body要素を取得 */
  abstract protected function getHtmlBody();
}