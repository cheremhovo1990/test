<?php
/**
 * Created by PhpStorm.
 * User: cheremhovo1990
 * Date: 21.07.19
 * Time: 10:26
 */
declare(strict_types=1);


namespace Tests\Feature\Auth;


use App\Entity\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function testForm(): void
    {
        $response = $this->get('/login');

        $response
            ->assertStatus(200)
            ->assertSee('Login');
    }

    public function testErrors(): void
    {
        $response = $this->post('/login', [
            'email' => '',
            'password' => '',
        ]);

        $response->assertStatus(302)
            ->assertSessionHasErrors(['email', 'password']);
    }

    public function testWait(): void
    {
        $user = factory(User::class)->create(['status' => User::STATUS_WAIT]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response
            ->assertStatus(302)
            ->assertRedirect('/')
            ->assertSessionHas('error', 'You need to confirm your account.Please check your email.');
    }

    public function testActive()
    {
        $user = factory(User::class)->create(['status' => User::STATUS_ACTIVE]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response
            ->assertStatus(302)
            ->assertRedirect('/cabinet');

        $this->assertAuthenticated();
    }
}