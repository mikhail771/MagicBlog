<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    public function testLoginPage()
    {
        $this->visit('/')
            ->click('login')
            ->seePageIs('/login');
    }
}
