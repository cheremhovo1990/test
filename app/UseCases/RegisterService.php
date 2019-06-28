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
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Facades\Mail;

/**
 * Class RegisterService
 * @package App\UseCases
 */
class RegisterService
{
    /**
     * @var Mailer
     */
    private $mailer;
    /**
     * @var Dispatcher
     */
    private $dispatcher;

    /**
     * RegisterService constructor.
     * @param Mailer $mailer
     * @param Dispatcher $dispatcher
     */
    public function __construct(
        Mailer $mailer,
        Dispatcher $dispatcher
    )
    {
        $this->mailer = $mailer;
        $this->dispatcher = $dispatcher;
    }

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
        $this->mailer->to($user->email)->send(new VerifyMail($user));
        $this->dispatcher->dispatch(new Registered($user));
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