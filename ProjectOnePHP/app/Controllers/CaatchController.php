<?php

namespace App\Controllers;

class CatchController extends BaseController
{
    public function index()
    {
        return view('test/indexed-db/catch/index');
    }

    public function create()
    {
        return view('test/indexed-db/catch/create');
    }

    public function edit()
    {
        return view('test/indexed-db/catch/edit');
    }

    public function delete()
    {
        return view('test/indexed-db/catch/delete');
    }
}
