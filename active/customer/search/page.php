<?php
require_once dirname(__FILE__).'/init.php';
require_once $pathSearchInclude.'/pageSearchCommon.php';

class Page extends PageSearchCommon
{
  public function __construct($menuMain, $subMenu)
  {
    parent::__construct($menuMain, $subMenu);
    global $urlCommonCss, $urlActive, $urlCustomer, $urlCustomerSearch;

    $this->addLinkCss($urlCommonCss.'/form.css');
    $this->addLinkCss('style.css');

    $this->addBreadcrumbList('active', 'トップ', $urlActive.'/index.php');
    $this->addBreadcrumbList('customer' ,'顧客管理', $urlCustomer.'/index.php');
    $this->addBreadcrumbList('customerSearch' ,'顧客検索', $urlCustomerSearch.'/index.php');

    $this->setAppTitle('顧客検索：条件入力');
  }

  protected function getPageName()
  {
    return '顧客検索：条件入力';
  }

  protected function getHtmlContents()
  {
?>
<form id="main" method="post" action="list.php" class="form01">
  <fieldset>
    <legend>検索条件</legend>
    <ul>
    <li><label for="searchCustomerId"><span class="title">ID</span></label><input type="text" id="searchCustomerId" name="searchCustomerId"></li>
    <li><label for="searchCustomerName"><span class="title">氏名</span></label><input type="text" id="searchCustomerName" name="searchCustomerName"></li>
    <li><label for="searchCustomerNameKana"><span class="title">氏名カナ</span></label><input type="text" id="searchCustomerNameKana" name="searchCustomerNameKana"></li>
    <li>
      <span class="title">性別</span>
      <input type="radio" id="searchCustomerGender0" name="searchCustomerGender" value="0" checked><label for="searchCustomerGender0"><span>未指定</span></label>
      <input type="radio" id="searchCustomerGender1" name="searchCustomerGender" value="1"><label for="searchCustomerGender1"><span>男性</span></label>
      <input type="radio" id="searchCustomerGender2" name="searchCustomerGender" value="2"><label for="searchCustomerGender2"><span>女性</span></label>
    </li>
    <li><label for="searchCustomerBirthdate"><span class="title">生年月日</span></label><input type="text" id="searchCustomerBirthdate" name="searchCustomerBirthdate"></li>
    <li>
      <span class="title">年齢</span>
      <input type="text" id="searchCustomerAgeBegin" name="searchCustomerAgeBegin">～
      <input type="text" id="searchCustomerAgeEnd" name="searchCustomerAgeEnd">
    </li>
    <li>
      <div id="searchCustomerAddressTitle"><span class="title">住所</span></div>
      <div id="searchCustomerAddressInput">
        <ul>
        <li>
          <label for="searchCustomerAddressZipcode"><span class="title">郵便番号</span></label>
          <input type="text" id="searchCustomerAddressZipcode" name="searchCustomerAddressZipcode">
          &nbsp;<input type="button" value="住所検索" class="button01">
        </li>
        <li>
          <label for="searchCustomerAddressPrefectures"><span class="title">都道府県</span></label>
          <select id="searchCustomerAddressPrefectures" name="searchCustomerAddressPrefectures">
            <option value="">選択してください</option>
          </select>
        </li>
        <li><label for="searchCustomerAddress01"><span class="title">市区町村</span></label><input type="text" id="searchCustomerAddress01" name="searchCustomerAddress01"></li>
        <li><label for="searchCustomerAddress02"><span class="title">番地・建物名</span></label><input type="text" id="searchCustomerAddress02" name="searchCustomerAddress02"></li>
        </ul>
      </div>
      <div style="clear: both;"></div>
    </li>
    <li><label for="searchCustomerTel"><span class="title">電話番号</span></label><input type="text" id="searchCustomerTel" name="searchCustomerTel"></li>
    <li><label for="searchCustomerMailAddress"><span class="title">メールアドレス</span></label><input type="text" id="searchCustomerMailAddress" name="searchCustomerMailAddress"></li>
    <li>
      <span class="title">ステータス</span>
      <input type="checkbox" id="searchCustomerStatus1" name="searchCustomerStatus1" value="1"><label for="searchCustomerStatus1"><span>有効</span></label>
      <input type="checkbox" id="searchCustomerStatus0" name="searchCustomerStatus0" value="0"><label for="searchCustomerStatus0"><span>無効</span></label>
      <input type="checkbox" id="searchCustomerStatus2" name="searchCustomerStatus2" value="2"><label for="searchCustomerStatus2"><span>削除</span></label>
    </li>
    <li><label for="keyword"><span class="title">キーワード</span></label><input type="text" id="keyword" name="keyword"></li>
    <li class="buttonList01"><input type="reset" value="リセット"><input type="submit" value="検索"></li>
    </ul>
  </fieldset>
</form>
<?php
  }
}