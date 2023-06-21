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
      $breadcrumbs['nav'] =  array(
        array('name' => 'Home', 'url' => '/'),
        array('name' => 'Login', 'url' => null)
      );
      return view('includes/header', $breadcrumbs)
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
      $breadcrumbs['nav'] =  array(
        array('name' => 'Home', 'url' => '/'),
        array('name' => 'Trips', 'url' => null)
      );
      return view('includes/header', $breadcrumbs)
              . view('dashboard-user')
              . $this->get_token_script()
              . view('includes/footer');
    }


  public function dashboard_trip($trip_id=null)
  {
    $data = array('trip_id' => $trip_id);
    $breadcrumbs['nav'] =  array(
      array('name' => 'Home', 'url' => '/'),
      array('name' => 'Trips', 'url' => '/home/dashboard'),
      array('name' => $trip_id, 'url' => null)
    );
    return view('includes/header', $breadcrumbs)
            . view('dashboard-trip', $data)
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
    $breadcrumbs['nav'] =  array(
      array('name' => 'Home', 'url' => '/'),
      array('name' => 'Trips', 'url' => '/home/dashboard'),
      array('name' => 'New trip', 'url' => null)
    );
    return view('includes/header', $breadcrumbs)
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
