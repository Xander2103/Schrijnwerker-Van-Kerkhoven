<?php

namespace Tests\Feature;

use Tests\TestCase;

class HoutSoortenTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
    }

    public function test_houtsoorten_redirects_to_werkplaats(): void
    {
        $this->get('/houtsoorten')->assertRedirect('/werkplaats');
    }

    public function test_houtsoorten_redirect_is_permanent(): void
    {
        $this->get('/houtsoorten')->assertStatus(301);
    }
}
