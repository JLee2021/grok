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
    return view('login');
  }

  public function dashboard()
  {
    return view('dashboard-user');
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
