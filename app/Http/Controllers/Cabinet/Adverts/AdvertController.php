<?php

declare(strict_types=1);


namespace App\Http\Controllers\Cabinet\Adverts;


use App\Http\Controllers\Controller;

class AdvertController extends Controller
{
    public function index()
    {
        return view('cabinet.adverts.index');
    }
}
