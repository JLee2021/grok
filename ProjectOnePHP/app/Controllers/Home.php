<?php

namespace App\Controllers;

class Home extends BaseController
{
  public function index()
  {
    return view('welcome_message');
  }

  public function test($fieldname)
  {
    $dropdown = new \App\Models\DropdownModel();
    $this->session = \Config\Services::session();
    $token = $this->session->token;
    $result = $dropdown->get_values($fieldname, $token);
    $this->response->setHeader('Content-type', 'application/json');
    echo json_encode($result);
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
    return $token;
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
    $dropdown = new \App\Models\DropdownModel();
    $this->session = \Config\Services::session();
    $token = $this->session->token;
    $data = array(
      'username' => $this->session->username,
      'observer' => $dropdown->get_values('obsid', $token),
      'vessels' => $dropdown->get_values('vessel_permit_num', $token),
      'ports' => $dropdown->get_values('port', $token)
    );
    return view('includes/header')
      . view('new-trip', $data)
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
    $dropdown = new \App\Models\DropdownModel();
    $this->session = \Config\Services::session();
    $token = $this->session->token;
    $data = array(
      'disposition' => $dropdown->get_values('disposition_code', $token),
      'species' => $dropdown->get_values('species_itis', $token),
      'ports' => $dropdown->get_values('port', $token)
    );
    return view('includes/header')
      . view('new-catch', $data)
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
    $token = $this->get_token_script();
    if(strlen($token) < 1 || $token == null){
      return view('login');
    }
    return view('includes/header')
      . view('dashboard-user')
      . view('service-worker')
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

  public function service_worker(){

  }
}
