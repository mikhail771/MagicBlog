<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthControllerTest extends TestCase
{
    use WithFaker;

    public function testRegister()
    {
       $name = 'Werb';
       $this->post('/register', [
            'name' => $name,
           'email' => $this->faker()->email,
           'password' => '12345678'
       ]);

       $this->assertDatabaseHas('users', [
           'name' => $name,
       ]);
    }
}
