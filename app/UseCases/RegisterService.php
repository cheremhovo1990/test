<?php
/**
 * Created by PhpStorm.
 * User: cheremhovo1990
 * Date: 27.06.19
 * Time: 6:50
 */
declare(strict_types=1);


namespace App\UseCases;


use App\Entity\User;
use App\Http\Requests\Auth\RegisterRequest;
use App\Mail\Auth\VerifyMail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;

/**
 * Class RegisterService
 * @package App\UseCases
 */
class RegisterService
{
    /**
     * @param RegisterRequest $request
     */
    public function register(RegisterRequest $request)
    {
        $user = User::register(
            $request['name'],
            $request['email'],
            $request['password']
        );
        Mail::to($user->email)->send(new VerifyMail($user));
        event(new Registered($user));
    }

    /**
     * @param $id
     */
    public function verify($id)
    {
        $user = User::findOrEmail($id);
        $user->verify();
    }
}