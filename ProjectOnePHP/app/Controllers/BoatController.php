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
      array('name' => 'Boats', 'url' => null)
    );

    return view('includes/header', $breadcrumbs)
      . view('boats/index', $data)
      . view('includes/footer');
  }

  public function create()
  {
    $breadcrumbs['nav'] =  array(
      array('name' => 'Home', 'url' => '/'),
      array('name' => 'All Boats', 'url' => 'BoatController/index'),
      array('name' => 'New Boat', 'url' => null)
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

    // return $this->index();
    
    return redirect()->back();
  }

  public function edit($id)
  {
    // TODO: Return view to update
  }

  public function update($id)
  {
    // TODO: save update to JSON 
  }

  public function delete($id)
  {
    // TODO: hard delete from JSON
  }
}
