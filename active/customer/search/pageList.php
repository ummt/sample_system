<?php
require_once dirname(__FILE__).'/init.php';
require_once $pathSearchInclude.'/pageSearchCommon.php';
require_once dirname(__FILE__).'/database.php';

class Page extends PageSearchCommon
{
  private $db;
  private $listCount; // 全件数
  private $pageMax; // 最大ページ数

  public function __construct($menuMain, $subMenu)
  {
    parent::__construct($menuMain, $subMenu);
    global $urlActiveCommonCss, $urlActive, $urlCustomer, $urlCustomerSearch;

    $this->addLinkCss($urlActiveCommonCss.'/list.css');

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
    $where = array();
    foreach ($_POST as $key => $value) {
      if(trim($value) === '') continue; // 未入力ならば次へ
      switch ($key) {
      case 'searchCustomerId':  // 顧客ID
        $where['customer_id'] = $value;
        $criteria['ID'] = $value;
        break;
      case 'searchCustomerName':  // 顧客名
        $where['customer_name'] = '%'.$value.'%';
        $criteria['氏名'] = $value;
        break;
      }
    }

    // 表示検索条件
    $criteriaList = '';
    foreach ($criteria as $key => $value) {
      if($criteriaList !== '') $criteriaList .= '、';
      $criteriaList .= $key.'：'.$value;
    }
    if($criteriaList === '') $criteriaList = '(全件抽出)';

    // 表示件数
    $dispRows = 20;

    // 検索結果取得
    $this->db->getSearchList($where, $rows);

    // 検索結果件数
    $this->listCount = count($rows);

    // 最大ページ数
    $this->pageMax = ceil($this->listCount / $dispRows);

    // 表示件数リスト
    $dispRowsParams = array(10, 20, 40, 80);
    $dispRowsList = '<select id="dispRows">';
    foreach ($dispRowsParams as $dispRowsParam) {
      $dispRowsList .= '<option value="'.$dispRowsParam.'" ';
      if ($dispRowsParam === 20) $dispRowsList .= ' selected ';
      $dispRowsList .= '>'.$dispRowsParam.'件</option>';
    }
    $dispRowsList .= '</select>';

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
    $rowCount = 0;
    foreach ($rows as $row) {
      global $urlCustomerInfo;
      $dataHref = 'data-href="'.$urlCustomerInfo.'/index.php?id='.$row['customer_id'].'"';
      $list .= '<tr '.$dataHref.' class="body">';
      $list .= '<td style="text-align: right;">'.(++$rowCount).'</td>';
      $list .= '<td style="text-align: left;">'.$row['customer_id'].'</td>';
      $list .= '<td style="text-align: left;">'.$row['customer_name'].'</td>';
      $list .= '<td style="text-align: left;">'.$row['prefecture_name'].$row['address1'].$row['address2'].'</td>';
      $list .= '<td style="text-align: left;">'.$row['tel'].'</td>';
      $list .= '</tr>';
    }
    $list .= '</table>';
?>
<input type="hidden" name="saveDispRows" id="saveDispRows" value="<?php echo $dispRows; ?>">
<div class="appControl01"><a href="index.php">条件入力へ戻る</a></div>
<div class="listInfo01">
  該当件数：&nbsp;<input type="text" name="listCount" id="listCount" value="<?php echo $this->listCount; ?>" readonly style="border-style:none;width: 25px; text-align: right;">件&nbsp;
  全<input type="text" name="pageMax" id="pageMax" value="<?php echo $this->pageMax; ?>" style="border-style:none;width: 25px; text-align: right;" readonly>ページ&nbsp;
  表示件数
  <?php echo $dispRowsList; ?>
</div>
<div id="pager_top"></div>
<table class="criteria01">
  <tr>
    <td class="title">条件</td>
    <td class="criteriaList"><?php echo $criteriaList; ?></td>
  </tr>
</table>
<?php echo $list; ?>
<div id="pager_bottom"></div>
<?php
  }

  protected function getJs()
  {
?>
<script>
var pageMax = <?php echo $this->pageMax; ?>;
var pageFirstRecordNo = 2; // ページ先頭番号
var listCount = <?php echo $this->listCount; ?>;
function setPager(){
  var pager = '';
  pager  = '';
  pager += '<table class="pageNavi01">';
  pager += '<tr>';
  pager += '<td class="prev"><a href="javascript:switchPage(\'-1\')">&lt;&nbsp;前へ</a></td>';
  for(i = 1; i <= pageMax; i++){
    pager += '<td class="';
    if(i === 1){
      pager += 'direct selected';
    }else{
      pager += 'direct';
    }
    pager += ' direct' + i + '"';
    pager += '><a href="javascript:directPage(' + i + ')">' + i + '</a></td>';
  }
  pager += '<td class="next"><a href="javascript:switchPage(\'+1\')">次へ&nbsp;&gt;</a></td>';
  pager += '</tr>';
  pager += '</table>';
  $("#pager_top").html(pager);
  $("#pager_bottom").html(pager);
}
setPager();
// ページング
function switchPage(arg){
  // 表示行数
  var dispRows = parseInt($("#dispRows").val());  // 最大行数
  var saveDispRows = parseInt($("#saveDispRows").val());  // 最大行数変更前の値
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
  var currentPage = Math.ceil(pageFirstRecordNo / saveDispRows);
  // 遷移先ページを求める
  var newPage = Math.ceil(newPageFirstRecordNo / dispRows);
  // 選択不可ページ
  if(newPage < 1 || pageMax < newPage) return;
  // 今のページの非表示
  var first = pageFirstRecordNo;
  var last = first + saveDispRows - 1;
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
function onChangeDispRows(){
  directPage(1);
  // すべての処理の最後
  $("#saveDispRows").val($("#dispRows").val());
  newPageMax = Math.ceil(listCount / $("#dispRows").val());
  pageMax = newPageMax;
  $("#pageMax").val(newPageMax);  //ceil($this->listCount / $dispRows);
  setPager();
}
$(document).ready(function(){
  $("table.table01 td").click(function(e){
    if(!$(e.target).is('a')){
      window.open($(e.target).closest('tr').data('href'));
    }
  });
  $("#dispRows").change( function(){
    onChangeDispRows();
  });
  /*$("table.pageNavi01 td.prev a").on('click',function(event){
    alert();
    switchPage('-1');
    return false;
  });
  $("table.pageNavi01 td.next a").on('click',function(event){
    switchPage('+1');
    return false;
  });*/
  // 最大ページ数を表示
  //printPageMax();
});
</script>
<?php
  }
}