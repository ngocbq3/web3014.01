<?php

namespace App\Controllers;

class Controller
{
    public function view($path, $data = [])
    {
        extract($data);
        $path = str_replace('.', '/', $path);
        include_once __DIR__ . "/../views/" . $path . ".php";
    }
}
