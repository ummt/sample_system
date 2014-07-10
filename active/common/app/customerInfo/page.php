<?php
require_once dirname(__FILE__).'/../../../init.php';
require_once $pathPlaneSingle.'/planeSingle.php';

class Page extends PlaneSingle
{
  public function __construct()
  {
    parent::__construct();
    global $urlActiveCommonCss;
    $this->addLinkCss($urlActiveCommonCss.'/detail.css');
    $this->addLinkCss('style.css');
  }

  protected function getPageName()
  {
    return '顧客情報';
  }

  protected function getHtmlContents()
  {
?>
<header id="pageHeader">
  <div id="appTitle"><span>顧客情報</span></div>
</header><!--pageHeader-->
<section id="mainSection">
  <form id="main" method="post" action="detail.php" class="form01">
    <table class="detail01">
      <tr>
        <th>ID</th><td style="text-align: left;">AD001</td>
        <th>氏名</th><td style="text-align: left;">ﾀﾅｶﾀﾛｳ<br>田中太郎</td>
        <th>性別</th><td style="text-align: center;">男性</td>
        <th>年齢</th><td style="text-align: center;">32歳</td>
        <th>生年月日</th><td style="text-align: center;">1982/05/03</td>
      </tr>
      <tr>
        <th>住所</th><td colspan="9">&#12306;850-0035&nbsp;長崎県長崎市元船町２−１</td>
      </tr>
      <tr>
        <th>電話番号</th><td colspan="2">0120-071-199</td>
        <th>メール<br>アドレス</th><td colspan="3">info@nibc.ac.jp</td>
        <th>ステータス</th><td colspan="2">有効</td>
      </tr>
    </table>
    <div id="controlList"><a href="#" id="close" class="linkButton01">閉じる</a></div>
  </form><!--main-->
</section><!--mainSection-->
<?php
  }

  protected function getJs()
  {
?>
<script>
$(document).ready(function(){
  $("a#close").click(function() {
    window.close();
    return false;
  });
});
</script>
<?php
  }
}