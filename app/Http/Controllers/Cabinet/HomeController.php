<?php
/**
 * Created by PhpStorm.
 * User: cheremhovo1990
 * Date: 09.06.19
 * Time: 18:20
 */
declare(strict_types=1);


namespace App\Http\Controllers\Cabinet;


use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('cabinet.home');
    }
}