<?php
/**
 * Created by PhpStorm.
 * User: cheremhovo1990
 * Date: 26.06.19
 * Time: 6:37
 */
declare(strict_types=1);


namespace Tests\Unit\Entity;


use App\Entity\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use phpDocumentor\Reflection\Types\Self_;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use DatabaseTransactions;

    public function testNew(): void
    {
        $user = User::new(
            $name = 'name',
            $email = 'email'
        );

        self::assertNotEmpty($user);

        self::assertEquals($name, $user->name);
        self::assertEquals($email, $user->email);
        self::assertNotEmpty($user->password);

        self::assertTrue($user->isActive());
        self::assertFalse($user->isAdmin());
    }
}