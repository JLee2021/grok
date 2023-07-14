<?php

namespace App\Controllers;

class Home2 extends BaseController
{

    public function index()
    {
        $breadcrumbs['nav'] =  array(
            array('name' => 'Home', 'url' => '/'),
            array('name' => 'Trips', 'url' => '/home2'),
            array('name' => 'placeholder', 'url' => null)
        );
        $dropdown = new \App\Models\DropdownModel();
        $this->session = \Config\Services::session();
        $token = $this->session->token;
        $data = array(
            'username' => $this->session->username,
            'observer' => $dropdown->get_values('obsid', $token),
            'vessels' => $dropdown->get_values('vessel_permit_num', $token),
            'ports' => $dropdown->get_values('port', $token),
            'gear' => $dropdown->get_values('accsp_gear_category', $token),
            'disposition' => $dropdown->get_values('disposition_code', $token),
            'species' => $dropdown->get_values('species_itis', $token),
            'weight_uom' => $dropdown->get_values('weight_uom', $token),
            'grade' => $dropdown->get_values('grade_code', $token)

        );
        return view('includes/header', $breadcrumbs)
              . view('one-page', $data)
              . $this->get_token_script()
              . view('service-worker')
              . view('includes/footer');
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
      return view('home2/includes/header', $breadcrumbs)
              . view('home2/login', $data)
              //. view('js/login.js')
              . view('home2/includes/footer');
    }
    private function get_token_script()
    {
        $this->session = \Config\Services::session();
        $token = $this->session->token;
        return "\n".'        const token="'.$token.'";'."\n";
    }


}
