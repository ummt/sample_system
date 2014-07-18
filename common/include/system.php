<?php
class System
{
  // 性別
  public static function getGender($gender_id){
    switch((string)$gender_id){
    case '1': return '男';
    case '0': return '女';
    }
    return false;
  }

  // 現在年齢を計算
  public static function getAge($birthdate){
    $now = date('Ymd');
    $birthdate = strtotime($birthdate);
    $birthdate = date('Ymd', $birthdate);
    return floor(($now-$birthdate)/10000);
  }

  // 郵便番号
  public static function formatZipcode($zipcode){
    return preg_replace("/^(\d{3})(\d{4})$/", "$1-$2", $zipcode);
  }

  // 顧客ステータス
  public static function getCustomerStatus($value){
    switch((string)$value){
    case '0': return '有効';
    case '1': return '削除';
    case '2': return '無効';
    }
    return false;
  }
}