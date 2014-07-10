<?php
require_once dirname(__FILE__).'/init.php';
require_once $pathSearchInclude.'/pageSearchCommon.php';

class Page extends PageSearchCommon
{
  public function __construct($menuMain, $subMenu)
  {
    parent::__construct($menuMain, $subMenu);
    global $urlCommonCss, $urlActive, $urlCustomer, $urlCustomerSearch;

    $this->addLinkCss($urlCommonCss.'/list.css');

    $this->addBreadcrumbList('active', 'トップ', $urlActive.'/index.php');
    $this->addBreadcrumbList('customer' ,'顧客管理', $urlCustomer.'/index.php');
    $this->addBreadcrumbList('customerSearch' ,'顧客検索', $urlCustomerSearch.'/index.php');

    $this->setAppTitle('顧客検索：一覧');
  }

  protected function getPageName()
  {
    return '顧客検索：一覧';
  }

  protected function getHtmlContents()
  {
?>
<div class="appControl01"><a href="index.php">条件入力へ戻る</a></div>
<div class="listInfo01">
  該当件数：1,000件&nbsp;
  全50ページ&nbsp;
  表示件数
  <select name="dispRows">
    <option value="10">10件</option>
    <option value="20">20件</option>
    <option value="40">40件</option>
    <option value="80">80件</option>
  </select>
</div>
<table class="pageNavi01">
  <tr>
    <td class="prev"><a href="#">&lt;&nbsp;前へ</a></td>
    <td class="selected">1</td>
    <td><a href="#">2</a></td>
    <td><a href="#">3</a></td>
    <td><a href="#">4</a></td>
    <td><a href="#">5</a></td>
    <td><a href="#">6</a></td>
    <td><a href="#">7</a></td>
    <td><a href="#">8</a></td>
    <td><a href="#">9</a></td>
    <td><a href="#">10</a></td>
    <td class="prev"><a href="#">次へ&nbsp;&gt;</a></td>
  </tr>
</table>

<table class="criteria01">
  <tr>
    <td class="title">条件</td>
    <td class="criteriaList">名前：田中、住所：長崎県</td>
  </tr>
</table>

<table class="table01">
  <tr>
    <th style="width: 05%;">NO.</th>
    <th style="width: 10%;">ID</th>
    <th style="width: 12%;">氏名</th>
    <th style="width: 58%;">住所</th>
    <th style="width: 15%;">電話番号</th>
  </tr>
<?php
    for($i = 0; $i < 20; $i++)
    {
      global $urlCustomerInfo;
      $dataHref = "data-href=\"{$urlCustomerInfo}/index.php?id=AD001\"";
?>
  <tr <?php echo $dataHref; ?>>
    <td style="text-align: right;">1</td>
    <td style="text-align: left;">AD0001</td>
    <td style="text-align: left;">田中太郎</td>
    <td style="text-align: left;">長崎県長崎市元船町２－１</td>
    <td style="text-align: left;">095-823-1199</td>
  </tr>
<?php
    }
?>
</table>
<table class="pageNavi01">
  <tr>
    <td class="prev"><a href="#">&lt;&nbsp;前へ</a></td>
    <td class="selected">1</td>
    <td><a href="#">2</a></td>
    <td><a href="#">3</a></td>
    <td><a href="#">4</a></td>
    <td><a href="#">5</a></td>
    <td><a href="#">6</a></td>
    <td><a href="#">7</a></td>
    <td><a href="#">8</a></td>
    <td><a href="#">9</a></td>
    <td><a href="#">10</a></td>
    <td class="prev"><a href="#">次へ&nbsp;&gt;</a></td>
  </tr>
</table>
<?php
  }

  protected function getJs()
  {
?>
<script>
$(document).ready(function(){
  $("table.table01 td").click(function(e){
    if(!$(e.target).is('a')){
      window.open($(e.target).closest('tr').data('href'));
    }
  });
});
</script>
<?php
  }
}