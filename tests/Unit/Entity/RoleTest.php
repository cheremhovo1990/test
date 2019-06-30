<?php
/**
 * Created by PhpStorm.
 * User: cheremhovo1990
 * Date: 30.06.19
 * Time: 15:05
 */
declare(strict_types=1);


namespace Tests\Unit\Entity;


use App\Entity\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use DatabaseTransactions;

    public function testChange()
    {
        $user = factory(User::class)->create(['role' => User::ROLE_USER]);

        self::assertFalse($user->isAdmin());

        $user->changeRole(User::ROLE_ADMIN);

        self::assertTrue($user->isAdmin());
    }

    public function testAleady(): void
    {
        $user = factory(User::class)->create(['role' => User::ROLE_ADMIN]);

        $this->expectExceptionMessage('Role is already assigned.');

        $user->changeRole(User::ROLE_ADMIN);
    }
}