<?php
require_once dirname(__FILE__).'/init.php';
require_once $pathSearchInclude.'/pageSearchCommon.php';
require_once dirname(__FILE__).'/database.php';

class Page extends PageSearchCommon
{
  private $db;

  public function __construct($menuMain, $subMenu)
  {
    parent::__construct($menuMain, $subMenu);
    global $urlCommonCss, $urlActive, $urlCustomer, $urlCustomerSearch;

    $this->addLinkCss($urlCommonCss.'/list.css');

    $this->addBreadcrumbList('active', 'トップ', $urlActive.'/index.php');
    $this->addBreadcrumbList('customer' ,'顧客管理', $urlCustomer.'/index.php');
    $this->addBreadcrumbList('customerSearch' ,'顧客検索', $urlCustomerSearch.'/index.php');

    $this->setAppTitle('顧客検索：一覧');

    $this->db = new Database();
  }

  protected function getPageName()
  {
    return '顧客検索：一覧';
  }

  protected function getHtmlContents()
  {
    // 検索条件
    $criteria = array();
    foreach ($_POST as $key => $value) {
      if(trim($value) === '') continue; // 未入力ならば次へ
      switch ($key) {
      case 'searchCustomerId':  // 顧客ID
        $criteria['customer_id'] = $value;
        break;
      case 'searchCustomerName':  // 顧客名
        $criteria['customer_name'] = '%'.$value.'%';
        break;
      }
    }
    // 検索結果取得
    $this->db->getSearchList($criteria, $rows);
    $list = '';
    $list .= '<table class="table01">';
    $list .= '<tr>';
    $list .= '<th style="width: 05%;">NO.</th>';
    $list .= '<th style="width: 10%;">ID</th>';
    $list .= '<th style="width: 12%;">氏名</th>';
    $list .= '<th style="width: 58%;">住所</th>';
    $list .= '<th style="width: 15%;">電話番号</th>';
    $list .= '</tr>';
    foreach ($rows as $row) {
      global $urlCustomerInfo;
      $dataHref = 'data-href="'.$urlCustomerInfo.'/index.php?id='.$row['customer_id'].'"';
      $list .= '<tr '.$dataHref.'>';
      $list .= '<td style="text-align: right;">'.'番号'.'</td>';
      $list .= '<td style="text-align: left;">'.$row['customer_id'].'</td>';
      $list .= '<td style="text-align: left;">'.$row['customer_name'].'</td>';
      $list .= '<td style="text-align: left;">'.$row['prefecture_name'].$row['address1'].$row['address2'].'</td>';
      $list .= '<td style="text-align: left;">'.$row['tel'].'</td>';
      $list .= '</tr>';
    }
    $list .= '</table>';
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
<?php echo $list; ?>
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