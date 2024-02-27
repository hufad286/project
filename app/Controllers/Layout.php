<?php

namespace App\Controllers;

class Layout extends BaseController
{
    public function index()
    {
        $data = [
            'akses' => session()->get('Level')
        ];
        return view('layout/home');
    }
}
