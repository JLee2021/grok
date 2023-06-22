<?php

namespace App\Controllers;

class BoatController extends BaseController
{
  public function index()
  {
    $breadcrumbs['nav'] =  array(
      array('name' => 'Home', 'url' => '/'),
      array('name' => 'Boats', 'url' => null)
    );
    return view('includes/header', $breadcrumbs)
      . view('boats/index')
      . view('includes/footer');
  }

  public function create()
  {
    $breadcrumbs['nav'] =  array(
      array('name' => 'Home', 'url' => '/'),
      array('name' => 'New Boat', 'url' => null)
    );
    return view('includes/header', $breadcrumbs)
      . view('boats/create')
      . view('includes/footer');
  }

  public function store(){
    // TODO: Save to JSON via model
  }

  public function edit($id){
    // TODO: Return view to update
  }

  public function update($id){
    // TODO: save update to JSON 
  }

  public function delete($id){
    // TODO: hard delete from JSON
  }
}
