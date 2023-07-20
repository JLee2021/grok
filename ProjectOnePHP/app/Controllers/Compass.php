<?php

namespace App\Controllers;

class Compass extends BaseController
{
    public function index()
    {
        return view('includes/header2')
        . view('includes/navigation')
        . "\n".'<div class="usa-overlay"></div>'."\n"
        . view('includes/side-nav')
        . view('fake-page')
        . view('includes/footer2');
    }
    public function test()
    {
        $breadcrumbs['nav'] =  array(
          array('name' => 'Home', 'url' => '/')
        );
        return view('includes/header', $breadcrumbs)
        . view('test/compass/index')
        . view('includes/footer');
    }
}
