<?php
class Menu
{
  private $menus;

  public function setMenu($name, $auth, $url)
  {
    $this->menus[] = array('name' => $name, 'auth' => $auth, 'url' => $url);
  }

  public function getMenu()
  {
    return $this->menus;
  }
}