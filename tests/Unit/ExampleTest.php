<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * @before
     */
    public function setupAuth()
    {
        $response = $this->post('/login', [
            'email' => 'mmihajlov771@gmail.com',
            'password' => 'papa0811'
        ]);

    }

    public function testGetMainPage()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testGoToAdminWithoutAuth()
    {
        $response = $this->get('/admin');
        $response->assertStatus(404);
    }

    public function testGoToRegister()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }
}
