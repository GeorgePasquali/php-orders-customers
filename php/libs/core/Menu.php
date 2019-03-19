<?php
namespace Core;

$menu = array(
    'home'  => array('text'=>'Home',  'url'=>'/index'),
    'Orders'  => array('text'=>'Orders',  'url'=>'/preview'),
    'Insert'  => array('text'=>'Insert Order',  'url'=>'/insert')
);

class Menu {
  public static function GenerateMenu($items, $class) {
    $html = "<nav class='$class'>\n";
    foreach($items as $item) {
      $html .= "<a href='{$item['url']}'>{$item['text']}</a>\n";
    }
    $html .= "</nav>\n";
    return $html;
  }
};


echo Menu::GenerateMenu($menu, 'navbar');