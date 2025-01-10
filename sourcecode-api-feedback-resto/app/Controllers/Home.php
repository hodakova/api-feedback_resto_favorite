<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (session()->get('num_user') == '') {
            return redirect()->to('/login');
        }
        return view('head').view('menu').view('welcome_message').view('footer');
    }
}
