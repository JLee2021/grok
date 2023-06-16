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
    return view('dashboard-trip');
  }

  public function new_trip()
  {
    return view('new-trip');
  }

  public function new_haul()
  {
    return view('new-haul');
  }

    public function new_catch()
  {
    return view('new-catch');
  }

  public function log_catch()
  {
    return view('log-catch');
  }

  public function end_haul()
  {
    return view('end-haul');
  }
}
