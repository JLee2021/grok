<?php

namespace App\Controllers;

class TripController extends BaseController
{
    public function index()
    {
        return view('test/indexed-db/trip/index');
    }

    public function create()
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
        return view('test/indexed-db/trip/create', $data);
    }

    public function edit()
    {
        return view('test/indexed-db/trip/edit');
    }

    public function delete()
    {
        return view('test/indexed-db/trip/delete');
    }

    public function get()
    {
        return view('test/indexed-db/trip/get');
    }
}

