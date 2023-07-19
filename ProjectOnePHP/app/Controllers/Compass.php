<?php

namespace App\Controllers;

class Compass extends BaseController
{
    public function menu1()
  {
    $breadcrumbs['nav'] =  array(
      array('name' => 'Home', 'url' => '/')
    );
    return view('includes/header-compass', $breadcrumbs)
    . view('test/compass/index')
    . view('includes/footer');
  }

  public function menu2()
  {
    $breadcrumbs['nav'] =  array(
      array('name' => 'Home', 'url' => '/')
    );
    return view('includes/header-compass', $breadcrumbs)
    . view('test/compass/index2')
    . view('includes/footer');
  }
}