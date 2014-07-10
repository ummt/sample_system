<?php
require_once dirname(__FILE__).'/init.php';
require_once $pathFrameSingle.'/frameSingle.php';

class Page extends FrameSingle
{
  public function __construct($mainMenu)
  {
    parent::__construct($mainMenu);
    global $urlActive;
    $this->addLinkCss('style.css');
    $this->addBreadcrumbList('active', 'トップ', $urlActive.'/index.php');
    $this->setAppTitle('トップ');
  }

  protected function getPageName()
  {
    return 'トップ';
  }

  protected function getHtmlContents()
  {
?>
<div id="systemInfo" class="clearfix">
  <div id="infoList">
    <ul>
      <li><span>20XX.04.01&nbsp;定期メンテナンスのお知らせ</span></li>
      <li><a href="#">20XX.04.01&nbsp;定期メンテナンスのお知らせ</a></li>
      <li><a href="#">20XX.04.01&nbsp;定期メンテナンスのお知らせ</a></li>
      <li><a href="#">20XX.04.01&nbsp;定期メンテナンスのお知らせ</a></li>
      <li><a href="#">20XX.04.01&nbsp;定期メンテナンスのお知らせ</a></li>
      <li><a href="#">20XX.04.01&nbsp;定期メンテナンスのお知らせ</a></li>
      <li><a href="#">20XX.04.01&nbsp;定期メンテナンスのお知らせ</a></li>
      <li><a href="#">20XX.04.01&nbsp;定期メンテナンスのお知らせ</a></li>
      <li><a href="#">20XX.04.01&nbsp;定期メンテナンスのお知らせ</a></li>
      <li><a href="#">20XX.04.01&nbsp;定期メンテナンスのお知らせ</a></li>
      <li><a href="#">20XX.04.01&nbsp;定期メンテナンスのお知らせ</a></li>
    </ul>
  </div><!--infoList-->
  <div id="infoContents">
    <article>
      <h2>管理サーバーにおける早朝のネットワーク強化メンテナンスのお知らせ</h2>
      <p>次のとおり、システムメンテナンスを実施します</p>
      <table>
        <tr><td style="width: 50px">日時</td><td>20XX年04月02日&nbsp;AM3:00～AM5:00</td></tr>
        <tr><td>内容</td><td>フロア間ルータの入替作業</td></tr>
      </table>
      <p>作業中もシステムを利用可能となっておりますが、通信速度が落ちることが予想されます。</p>
      <p>以上</p>
    </article>
  </div>
</div>
<?php
  }
}