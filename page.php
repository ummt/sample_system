<?php
require_once dirname(__FILE__).'/init.php';
require_once $pathCommonInclude.'/pageCommon.php';

class Page extends PageCommon
{
  public function __construct()
  {
    parent::__construct();
    $this->addLinkCss('style.css');
  }

  protected function getHtmlBody()
  {
    $loginMessage = ''; //ログインメッセージ

    if (isset($_POST['loginId']) && isset($_POST['loginPassword']))
    {
      /*認証*/
      if($this->auth->login($_POST['loginId'], $_POST['loginPassword'], $loginMessage))
      {
        global $urlRoot;
        header("Location: {$urlRoot}/active/index.php");
      }
    }
?>
<div id="layoutLogin">
  <h1>サンプルシステム</h1>
  <form id="loginForm" method="post" action="index.php">
  <fieldset>
    <legend>ログイン</legend>
    <ul>
    <li><label for="loginId"><span>ID</span></label><input type="text" id="loginId" name="loginId"></li>
    <li><label for="loginPassword"><span>パスワード</span></label><input type="password" id="loginPassword" name="loginPassword"></li>
    <li><input type="submit" value="ログイン"></li>
    </ul>
    <div><?php echo $loginMessage; ?></div>
  </fieldset>
  </form><!--loginForm-->
</div><!--layoutLogin-->
<?php
  }
}