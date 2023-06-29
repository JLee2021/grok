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
        return view('test/indexed-db/trip/create');
    }

    public function edit()
    {
        return view('test/indexed-db/trip/edit');
    }

    public function delete()
    {
        return view('test/indexed-db/trip/delete');
    }
}