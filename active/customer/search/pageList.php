<?php
require_once dirname(__FILE__).'/init.php';
require_once $pathSearchInclude.'/pageSearchCommon.php';
require_once dirname(__FILE__).'/database.php';

class Page extends PageSearchCommon
{
  private $db;
  private $pageMax;

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
    $where = array();
    foreach ($_POST as $key => $value) {
      if(trim($value) === '') continue; // 未入力ならば次へ
      switch ($key) {
      case 'searchCustomerId':  // 顧客ID
        $where['customer_id'] = $value;
        break;
      case 'searchCustomerName':  // 顧客名
        $where['customer_name'] = '%'.$value.'%';
        break;
      }
    }

    // 表示件数
    $dispRows = 20;

    // 検索結果取得
    $this->db->getSearchList($where, $rows);

    // 検索結果件数
    $listCount = count($rows);

    // 表示件数リスト
    $dispRowsParams = array(10, 20, 40, 80);
    $dispRowsList = '<select id="dispRows">';
    foreach ($dispRowsParams as $dispRowsParam) {
      $dispRowsList .= '<option value="'.$dispRowsParam.'" ';
      if ($dispRowsParam === 20) $dispRowsList .= ' selected ';
      $dispRowsList .= '>'.$dispRowsParam.'件</option>';
    }
    $dispRowsList .= '</select>';

    // 全ページ数
    $this->pageMax = ceil($listCount / $dispRows);

    // 一覧の初期表示CSS
    for($i = 2; $i <= $dispRows + 1; $i++){
      $showTrSelecters[] = 'table.table01 tr.body:nth-child('.$i.')';
    }
    $showTrSelecter = implode(',', $showTrSelecters);
    $listStyle = <<<_EOD
<style>
{$showTrSelecter} {
  display: table-row;
}
</style>
_EOD;

    // 一覧
    $list = '';
    $list .= $listStyle;
    $list .= '<table class="table01">';
    $list .= '<tr class="header">';
    $list .= '<th style="width: 05%;">NO.</th>';
    $list .= '<th style="width: 10%;">ID</th>';
    $list .= '<th style="width: 12%;">氏名</th>';
    $list .= '<th style="width: 58%;">住所</th>';
    $list .= '<th style="width: 15%;">電話番号</th>';
    $list .= '</tr>';
    foreach ($rows as $row) {
      global $urlCustomerInfo;
      $dataHref = 'data-href="'.$urlCustomerInfo.'/index.php?id='.$row['customer_id'].'"';
      $list .= '<tr '.$dataHref.' class="body">';
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
  該当件数：&nbsp;<?php echo $listCount; ?>件&nbsp;
  全<?php echo $this->pageMax; ?>ページ&nbsp;
  表示件数
  <?php echo $dispRowsList; ?>
</div>
<div id="pager_top"></div>
<table class="criteria01">
  <tr>
    <td class="title">条件</td>
    <td class="criteriaList">名前：田中、住所：長崎県</td>
  </tr>
</table>
<?php echo $list; ?>
<div id="pager_bottom"></div>
<?php
  }

  protected function getJs()
  {
    $directFunc = '';
    for($i = 1; $i <= $this->pageMax; $i++){
      $directFunc .= '$("table.pageNavi01 td.direct'.$i.' a").on("click", function(event){directPage('.$i.');return false;});';
    }
?>
<script>
var pageMax = <?php echo $this->pageMax; ?>;  // 最大ページ数
var pageFirstRecordNo = 2; // ページ先頭番号
// ページャを設置
function setPager(){
  var pager = '';
  pager  = '';
  pager += '<table class="pageNavi01">';
  pager += '<tr>';
  pager += '<td class="prev"><a href="#">&lt;&nbsp;前へ</a></td>';
  for(i = 1; i <= pageMax; i++){
    pager += '<td class="';
    if(i === 1){
      pager += 'direct selected';
    }else{
      pager += 'direct';
    }
    pager += ' direct' + i + '"';
    pager += '><a href="#">' + i + '</a></td>';
  }
  pager += '<td class="next"><a href="#">次へ&nbsp;&gt;</a></td>';
  pager += '</tr>';
  pager += '</table>';
  $("#pager_top").html(pager);
  $("#pager_bottom").html(pager);
}
setPager();
// ページング
function switchPage(arg){
  // 表示行数
  var dispRows = parseInt($("#dispRows").val());
  var newPageFirstRecordNo;
  switch(arg){
  case '+1': // 次へ
    newPageFirstRecordNo = pageFirstRecordNo + dispRows;
    break;
  case '-1': // 前へ
    newPageFirstRecordNo = pageFirstRecordNo - dispRows;
    break;
  default: // ページ直接指定
    newPageFirstRecordNo = (arg - 1) * dispRows + 2;
  }
  // 現在ページを求める
  var currentPage = Math.ceil(pageFirstRecordNo / dispRows);
  // 遷移先ページを求める
  var newPage = Math.ceil(newPageFirstRecordNo / dispRows);
  // 選択不可ページ
  if(newPage < 1 || pageMax < newPage) return;
  // 今のページの非表示
  var first = pageFirstRecordNo;
  var last = first + dispRows - 1;
  for (var i = first; i <= last; i++) {
    $("table.table01 tr.body:nth-child(" + i + ")").css("display", "none");
  }
  // 新しいページの表示
  first = newPageFirstRecordNo;
  last = first + dispRows - 1;
  //alert('表示する：' + first + '～' + last);
  for (var i = first; i <= last; i++) {
    $("table.table01 tr.body:nth-child(" + i + ")").css("display", "table-row");
  }
  // 選択ページCSS設定
  $(".direct" + currentPage).removeClass('selected');
  $(".direct" + newPage).addClass('selected');
  // ページ先頭番号の書き換え
  pageFirstRecordNo = newPageFirstRecordNo;
}
function directPage(page){
  switchPage(page);
}
$(document).ready(function(){
  $("table.table01 td").click(function(e){
    if(!$(e.target).is('a')){
      window.open($(e.target).closest('tr').data('href'));
    }
  });
  $("#dispRows").change( function(){
    alert('dispRows changed');
  });
  $("table.pageNavi01 td.prev a").on('click',function(event){
    switchPage('-1');
    return false;
  });
  $("table.pageNavi01 td.next a").on('click',function(event){
    switchPage('+1');
    return false;
  });
  <?php echo $directFunc; ?>
});
</script>
<?php
  }
}