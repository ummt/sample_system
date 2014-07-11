<?php
require_once dirname(__FILE__).'/init.php';
require_once $pathFrameSingle.'/frameSingle.php';
require_once 'database.php';

class Page extends FrameSingle
{
  private $db;

  public function __construct($mainMenu)
  {
    parent::__construct($mainMenu);
    global $urlActive;
    $this->addLinkCss('style.css');
    $this->addBreadcrumbList('active', 'トップ', $urlActive.'/index.php');
    $this->setAppTitle('トップ');
    //DBクラスをオブジェクト化
    $this->db = new Database();
  }

  protected function getPageName()
  {
    return 'トップ';
  }

  protected function getHtmlContents()
  {
    global $urlActive;

    $infoSubject = '';  // タイトル
    $infoContents = '';  // 主文

    // infoのデータを取得
    $this->db->getInfo($infos);

    // 選択されているinfoのidを取得
    $infoId = 0;
    if(isset($_GET['infoid'])){
      $infoId = $_GET['infoid'];
    }

    // 一覧作成
    $infoList = '<ul>';
    foreach ($infos as $info){
      $post_date = date("Y.m.d", strtotime($info['post_date']));  //日付のフォーマット
      $infoList .= '<li>';
      if ((string)$infoId === (string)$info['id'] || $infoId === 0) {
        // 選択
        $infoSubject = $info['subject'];
        $infoContents = $info['contents'];
        $infoId = $info['id'];
        $infoList .= '<span>'.$post_date.'&nbsp;'.$info['subject'].'</span>';
      } else {
        $infoList .= '<a href="'.$urlActive.'/index.php?infoid='.$info['id'].'">'.$post_date.'&nbsp;'.$info['subject'].'</a>';
      }
      $infoList .= '</li>';
    }
    $infoList .= '</ul>';
?>
<div id="systemInfo" class="clearfix">
  <div id="infoList">
<?php echo $infoList; ?>
  </div><!--infoList-->
  <div id="infoContents">
    <article>
      <h2><?php echo $infoSubject; ?></h2>
      <?php echo $infoContents; ?>
    </article>
  </div>
</div>
<?php
  }
}