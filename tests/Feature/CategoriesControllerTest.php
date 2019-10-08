<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoriesControllerTest extends TestCase
{
    public function testLogin()
    {
        Auth::attempt([
            'email' => 'mmihajlov771@gmail.com',
            'password' => 'papa0811'
            ]);
    }

    /**
     * @depends testLogin
     */
    public function testIndex()
    {
        $response = $this->get('/admin/categories');

        $response->assertStatus(200);
    }


}
