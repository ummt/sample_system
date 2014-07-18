<?php
require_once dirname(__FILE__).'/../../../init.php';
require_once $pathPlaneSingle.'/planeSingle.php';
require_once dirname(__FILE__).'/database.php';
require_once $pathCommonInclude.'/system.php';

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
    $customerId = $_GET['id'];
    $db = new Database();
    $db->getCustomer($customerId, $customers);
    $customer = $customers[0];
?>
<header id="pageHeader">
  <div id="appTitle"><span>顧客情報</span></div>
</header><!--pageHeader-->
<section id="mainSection">
  <form id="main" method="post" action="detail.php" class="form01">
    <table class="detail01">
      <tr>
        <th>ID</th><td style="text-align: left;"><?php echo $customer['customer_id']; ?></td>
        <th>氏名</th><td style="text-align: left;"><?php echo $customer['name_kana']; ?><br><?php echo $customer['customer_name']; ?></td>
        <th>性別</th><td style="text-align: center;"><?php echo System::getGender($customer['gender']); ?></td>
        <th>年齢</th><td style="text-align: center;"><?php echo System::getAge($customer['birth_date']); ?>歳</td>
        <th>生年月日</th><td style="text-align: center;"><?php echo date('Y/m/d', strtotime($customer['birth_date'])); ?></td>
      </tr>
      <tr>
        <th>住所</th>
        <td colspan="9">
          &#12306;<?php echo System::formatZipcode($customer['zip_code']); ?>&nbsp;
          <?php echo $customer['prefecture_name']; ?>
          <?php echo $customer['address1']; ?>
          <?php echo $customer['address2']; ?>
        </td>
      </tr>
      <tr>
        <th>電話番号</th><td colspan="2"><?php echo $customer['tel']; ?></td>
        <th>メール<br>アドレス</th><td colspan="3"><?php echo $customer['mail']; ?></td>
        <th>ステータス</th><td colspan="2"><?php echo System::getCustomerStatus($customer['is_deleted']); ?></td>
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