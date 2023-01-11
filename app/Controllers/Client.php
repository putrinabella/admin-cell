<?php

namespace App\Controllers;


class Client extends BaseController
{
    public $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('client/Navigasi/template');
    }
}
