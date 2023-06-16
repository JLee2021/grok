<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function login()
    {
      $this->session = \Config\Services::session();
      $data = array('auth_msg' => $this->session->auth_msg);
      $this->session->destroy();

      return view('includes/header')
              . view('login', $data)
              //. view('js/login.js')
              . view('includes/footer');
    }
    private function get_token_script()
    {
        $this->session = \Config\Services::session();
        $token = $this->session->token;
        return '        const token="'.$token.'";'."\n";
    }

    public function dashboard()
    {
      //return view('dashboard-user');
      return view('includes/header')
              . view('dashboard-user')
              . $this->get_token_script()
              . view('includes/footer');
    }

  public function dashboard_trip()
  {
    return view('includes/header')
            . view('dashboard-trip')
            // . view('js/main.js')
            . view('includes/footer');
  }

  public function new_trip()
  {
    return view('includes/header')
            . view('new-trip')
            . view('includes/footer');
  }

  public function new_haul()
  {
    return view('includes/header')
            . view('new-haul')
            // . view('js/main.js')
            . view('includes/footer');
  }

    public function new_catch()
  {
    return view('includes/header')
            . view('new-catch')
            // . view('js/main.js')
            . view('includes/footer');
  }

  public function log_catch()
  {
    return view('includes/header')
            . view('log-catch')
            // . view('js/main.js')
            . view('includes/footer');
  }

  public function end_haul()
  {
    return view('includes/header')
            . view('end-haul')
            // . view('js/main.js')
            . view('includes/footer');
  }

  public function form_links()
  {
    return view('includes/header')
            . view('form-links')
            // . view('js/main.js')
            . view('includes/footer');
  }

  public function splash()
  {
    return view('includes/header')
            . view('splash')
            // . view('js/main.js')
            . view('includes/footer');
  }

  public function gps()
  {
    return view('includes/header')
            . view('gps')
            // . view('js/main.js')
            . view('includes/footer');
  }
}
