<?php
/**
 * Created by PhpStorm.
 * User: cheremhovo1990
 * Date: 16.06.19
 * Time: 19:49
 */
declare(strict_types=1);


namespace App\Mail\Auth;


use App\Entity\User;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyMail extends Mailable
{
    use SerializesModels;

    /**
     * @var User
     */
    public $user;

    public function __construct(User $user)
    {

        $this->user = $user;
    }

    public function build()
    {
        return $this
            ->subject('Signup Confirmation')
            ->markdown('emails.auth.register.verify');
    }
}