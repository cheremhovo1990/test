<?php
/**
 * Created by PhpStorm.
 * User: cheremhovo1990
 * Date: 24.07.19
 * Time: 6:42
 */
declare(strict_types=1);


namespace Tests\Unit\Entity\User;


use App\Entity\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PhoneTest extends TestCase
{
    use DatabaseTransactions;

    public function testDefault(): void
    {
        $user = factory(User::class)->create([
            'phone' => null,
            'phone_verified' => false,
            'phone_verify_token' => null,
        ]);

        self::assertFalse($user->isPHoneVerified());
    }

    public function testRequestEmptyPhone(): void
    {
        $user = factory(User::class)->create([
            'phone' => null,
            'phone_verified' => false,
            'phone_verify_token' => null,
        ]);

        $this->expectExceptionMEssage('Phone number is empty.');
        $user->requestPhoneVerification(Carbon::now());
    }

    public function testRequest(): void
    {
        $user = factory(User::class)->create([
            'phone' => '79000000000',
            'phone_verified' => false,
            'phone_verify_token' => null,
        ]);

        $token = $user->requestPhoneVerification(Carbon::now());

        self::assertFalse($user->isPhoneVerified());
        self::assertNotEmpty($token);
    }

    public function testRequestWithOldPhone()
    {
        $user = factory(User::class)->create([
            'phone' => '79000000000',
            'phone_verified' => true,
            'phone_verify_token' => null,
        ]);

        self::assertTrue($user->isPhoneVerified());

        $user->requestPhoneVerification(Carbon::now());

        self::assertFalse($user->isPhoneVerified());
        self::assertNotEmpty($user->phone_verify_token);
    }

    public function testRequestAlreadySentTimeout(): void
    {
        $user = factory(User::class)->create([
            'phone' => '79000000000',
            'phone_verified' => true,
            'phone_verify_token' => null,
        ]);

        $user->requestPhoneVerification($now = Carbon::now());
        $user->requestPhoneVerification($now->copy()->addSeconds(300));

        self::assertFalse($user->isPhoneVerified());
    }

    public function testRequestAlreadySent()
    {
        $user = factory(User::class)->create([
            'phone' => '79000000000',
            'phone_verified' => true,
            'phone_verify_token' => null,
        ]);

        $user->requestPhoneVerification($now = Carbon::now());

        $this->expectExceptionMessage('Token is already requested.');
        $user->requestPhoneVerification($now->copy()->addSeconds(15));
    }

    public function testVerify()
    {
        $user = factory(User::class)->create([
            'phone' => '79000000000',
            'phone_verified' => false,
            'phone_verify_token' => $token = 'token',
            'phone_verify_token_expire' => $now = Carbon::now(),
        ]);

        self::assertFalse($user->isPhoneVerified());
        $user->verifyPhone($token, $now->copy()->subSeconds(15));

        self::assertTrue($user->isPhoneVerified());
    }

    public function testVerifyIncorrectToken()
    {
        $user = factory(User::class)->create([
            'phone' => '79000000000',
            'phone_verified' => false,
            'phone_verify_token' => $token = 'token',
            'phone_verify_token_expire' => $now = Carbon::now(),
        ]);

        $this->expectExceptionMessage('Incorrect verify token.');
        $user->verifyPhone('other_token', $now->copy()->subSeconds(15));
    }

    public function testVerifyExpiredToken(): void
    {
        $user = factory(User::class)->create([
            'phone' => '79000000000',
            'phone_verified' => false,
            'phone_verify_token' => $token = 'token',
            'phone_verify_token_expire' => $now = Carbon::now(),
        ]);

        $this->expectExceptionMessage('Token is expired.');
        $user->verifyPhone($token, $now->copy()->addSeconds(500));
    }
}