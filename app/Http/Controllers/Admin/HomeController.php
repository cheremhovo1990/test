<?php
/**
 * Created by PhpStorm.
 * User: cheremhovo1990
 * Date: 23.06.19
 * Time: 7:45
 */
declare(strict_types=1);


namespace App\Http\Controllers\Admin;


class HomeController
{
    public function index()
    {
        return view('admin.home');
    }
}