<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RouteTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $user = factory(App\Model\User::class)->create();

        $this->visit('/')
            ->click('Posts')
            ->seePageIs('/')
            ->assertResponseOk()
            ->visit('/')
            ->click('Sign up')
            ->seePageIs('register')
            ->assertResponseOk()
            ->visit('/')
            ->click('login')
            ->seePageIs('login')
            ->assertResponseOk();

        $this->actingAs($user)
            ->visit('/')
            ->click('profile')
            ->seePageIs('profile')
            ->click('Add Post')
            ->seePageIs('posts/create')
            ->assertResponseOk()
            ->visit('/')
            ->click('Users')
            ->seePageIs('users')
            ->assertResponseOk();
    }


}
