<?php

namespace App\Controllers;

class BoatController extends BaseController
{
  public function index()
  { 
    $boat = new \App\Models\BoatModel();
    $file = "https://nefsctest.nmfs.local/grok/html/ProjectOnePHP/public/boat/boats.csv";
    $readfile = $boat->read_file($file); 
    $data = array(
      'boats' => $readfile
    );

    $breadcrumbs['nav'] =  array(
      array('name' => 'Home', 'url' => '/'),
      array('name' => 'All Vessels', 'url' => null)
    );

    return view('includes/header', $breadcrumbs)
      . view('boats/index', $data)
      . view('includes/footer');
  }

  public function create()
  {
    $breadcrumbs['nav'] =  array(
      array('name' => 'Home', 'url' => '/'),
      array('name' => 'All Vessels', 'url' => 'BoatController/index'),
      array('name' => 'New Vessel', 'url' => null)
    );
    return view('includes/header', $breadcrumbs)
      . view('boats/create')
      . view('includes/footer');
  }

  public function store()
  {
    $boat_name = $this->request->getPost(['boat-name']);
    $implode = implode($boat_name);
    $name = ',' . $implode;
    $file = "/var/www/html/grok/html/ProjectOnePHP/public/boat/boats.csv";
    file_put_contents($file, $name, FILE_APPEND);

    return redirect()->to(site_url('BoatController/index'));
  }

  public function edit()
  {
    $boat = new \App\Models\BoatModel();
    $file = "https://nefsctest.nmfs.local/grok/html/ProjectOnePHP/public/boat/boats.csv";
    $readfile = $boat->read_file($file); 
    $data = array(
      'boats' => $readfile
    );

    $breadcrumbs['nav'] =  array(
      array('name' => 'Home', 'url' => '/'),
      array('name' => 'All Vessels', 'url' => 'BoatController/index'),
      array('name' => 'Edit Vessels', 'url' => null)
    );

    return view('includes/header', $breadcrumbs)
      . view('boats/edit', $data)
      . view('includes/footer');
  }

  public function update()
  {
    $original = $this->request->getPost(['original-name']);
    $boat_name = $this->request->getPost(['boat-name']);
    $old_name = implode($original);
    $new_name = implode($boat_name);
    
    $locate = "/var/www/html/grok/html/ProjectOnePHP/public/boat/boats.csv";
    $file = file_get_contents($locate);

    $replace = str_replace($old_name, $new_name, $file);
    
    file_put_contents($locate, $replace);

    return redirect()->to(site_url('BoatController/edit'));
  
  }

  public function delete()
  {
    $boat = new \App\Models\BoatModel();
    $file = "https://nefsctest.nmfs.local/grok/html/ProjectOnePHP/public/boat/boats.csv";
    $readfile = $boat->read_file($file); 
    $data = array(
      'boats' => $readfile
    );

    $breadcrumbs['nav'] =  array(
      array('name' => 'Home', 'url' => '/'),
      array('name' => 'All Vessels', 'url' => 'BoatController/index'),
      array('name' => 'Delete Vessels', 'url' => null)
    );

    return view('includes/header', $breadcrumbs)
      . view('boats/delete', $data)
      . view('includes/footer');
  }

  public function remove(){
    $boat_name = $this->request->getPost(['boat-name']);
    $implode = implode($boat_name);

    $needle1 = "," . $implode;
    $needle2 = $implode;

    $locate = "/var/www/html/grok/html/ProjectOnePHP/public/boat/boats.csv";
    $file = file_get_contents($locate);

    if(strpos($file, $needle2) == 0){
      $needle2 = $implode . ",";
      $replace = str_replace($needle2, "", $file);
    }
    else{
      $replace = str_replace($needle1, "", $file);
    }

    file_put_contents($locate, $replace);

    return redirect()->to(site_url('BoatController/delete'));
  }
}
