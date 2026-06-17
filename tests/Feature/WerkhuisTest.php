<?php

namespace Tests\Feature;

use Tests\TestCase;

class WerkhuisTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
    }

    public function test_werkhuis_redirects_to_werkplaats(): void
    {
        $this->get('/werkhuis')->assertRedirect('/werkplaats');
    }

    public function test_werkhuis_redirect_is_permanent(): void
    {
        $this->get('/werkhuis')->assertStatus(301);
    }
}
