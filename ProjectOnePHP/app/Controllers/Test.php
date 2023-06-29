<?php

namespace App\Controllers;

class Test extends BaseController
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
              . view('test/t-login', $data)
              //. view('js/login.js')
              . view('includes/footer');
    }
    private function get_token_script()
    {
        $this->session = \Config\Services::session();
        $token = $this->session->token;
        return "\n".'        const token="'.$token.'";'."\n";
    }

    public function dashboard()
    {
      $breadcrumbs['nav'] =  array(
        array('name' => 'Home', 'url' => '/'),
        array('name' => 'Trips', 'url' => null)
      );
      return view('includes/header', $breadcrumbs)
              . view('test/t-dashboard-user')
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
            . view('test/t-dashboard-trip', $data)
            // . view('js/main.js')
            . view('includes/footer');
  }

  public function dashboard_haul()
  {
    $breadcrumbs['nav'] =  array(
      array('name' => 'Home', 'url' => '/'),
      array('name' => 'Trips', 'url' => '/home/dashboard'),
      array('name' => 'Hauls', 'url' => null)
    );
    return view('includes/header', $breadcrumbs)
            . view('test/t-dashboard-haul')
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
            . view('test/t-new-trip', $data)
            //. view('js/indexdb.js')
            . view('includes/footer');
  }

  public function new_haul($trip_id=null)
  {
      $dropdown = new \App\Models\DropdownModel();
      $this->session = \Config\Services::session();
      $token = $this->session->token;
      $data = array(
        'username' => $this->session->username,
        'trip_id' => $trip_id,
        'gear' => $dropdown->get_values('accsp_gear_category', $token)
      );
    $breadcrumbs['nav'] =  array(
      array('name' => 'Home', 'url' => '/'),
      array('name' => 'Trips', 'url' => '/home/dashboard'),
      array('name' => $trip_id, 'url' => '/home/dashboard_trip/'.$trip_id),
      array('name' => 'New Haul', 'url' => null)
    );
    return view('includes/header', $breadcrumbs)
      . view('test/t-new-haul', $data)
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
    $breadcrumbs['nav'] =  array(
      array('name' => 'Home', 'url' => '/'),
      array('name' => 'Trips', 'url' => '/home/dashboard'),
      array('name' => 'Hauls', 'url' => '/home/dashboard_haul'),
      array('name' => 'New Catch', 'url' => null)
    );
    return view('includes/header', $breadcrumbs)
      . view('test/t-new-catch', $data)
      // . view('js/main.js')
      . view('includes/footer');
  }

  public function log_catch()
  {
    $breadcrumbs['nav'] =  array(
      array('name' => 'Home', 'url' => '/'),
      array('name' => 'Trips', 'url' => '/home/dashboard'),
      array('name' => 'Hauls', 'url' => '/home/dashboard_haul'),
      array('name' => 'New Catch', 'url' => null)
    );
    return view('includes/header', $breadcrumbs)
      . view('test/t-log-catch')
      // . view('js/main.js')
      . view('includes/footer');
  }

  public function end_haul()
  {
    $breadcrumbs['nav'] =  array(
      array('name' => 'Home', 'url' => '/'),
      array('name' => 'Trips', 'url' => '/home/dashboard'),
      array('name' => 'Hauls', 'url' => '/home/dashboard_haul'),
      array('name' => 'End Haul', 'url' => null)
    );
    return view('includes/header', $breadcrumbs)
      . view('test/t-end-haul')
      // . view('js/main.js')
      . view('includes/footer');
  }

  public function form_links()
  {
    $breadcrumbs['nav'] =  array(
      array('name' => 'Home', 'url' => '/'),
      array('name' => 'Form Links', 'url' => null)
    );
    return view('includes/header', $breadcrumbs)
      . view('test/form-links')
      // . view('js/main.js')
      . view('includes/footer');
  }

  public function splash()
  {
    $token = $this->get_token_script();
    if (strlen($token) < 1 || $token == null) {
      return $this->login();
    }
    return $this->dashboard();
  }

  public function gps()
  {
    $breadcrumbs['nav'] =  array(
      array('name' => 'Home', 'url' => '/'),
      array('name' => 'GPS', 'url' => null)
    );
    return view('includes/header', $breadcrumbs)
      . view('test/gps')
      // . view('js/main.js')
      . view('includes/footer');
  }

  public function online_offline()
  {
    $breadcrumbs['nav'] =  array(
      array('name' => 'Home', 'url' => '/'),
      array('name' => 'Connection Test', 'url' => null)
    );
    return view('includes/header', $breadcrumbs)
      . view('test/online-offline')
      // . view('js/main.js')
      . view('includes/footer');
  }

}
