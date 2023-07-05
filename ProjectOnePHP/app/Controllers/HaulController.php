<?php

namespace App\Controllers;

class HaulController extends BaseController
{
    public function index()
    {
        return view('test/indexed-db/haul/index');
    }

    public function create()
    {
        return view('test/indexed-db/haul/create');
    }

    public function edit()
    {
        return view('test/indexed-db/haul/edit');
    }

    public function delete()
    {
        return view('test/indexed-db/haul/delete');
    }
}