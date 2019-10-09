<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class   RegisterTest extends DuskTestCase
{
    public function testRegister()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('register')
                    ->value('#name', 'Joe')
                    ->value('#email', 'qwert@gmail.com')
                    ->value('#password', '12345')
                    ->click('button[type="submit"]')
                    ->assertPathIs('/');
        });
    }
}
