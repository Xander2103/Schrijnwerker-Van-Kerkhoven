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

    public function test_houtsoorten_page_loads_successfully(): void
    {
        $this->get('/houtsoorten')->assertStatus(200);
    }

    public function test_houtsoorten_page_contains_page_title(): void
    {
        $this->get('/houtsoorten')->assertSee('Onze houtsoorten');
    }

    public function test_houtsoorten_page_contains_wood_types(): void
    {
        $this->get('/houtsoorten')
            ->assertSee('Massief hout')
            ->assertSee('Afzelia')
            ->assertSee('Franse eik')
            ->assertSee('Meranti');
    }

    public function test_houtsoorten_page_contains_cta_link(): void
    {
        $this->get('/houtsoorten')->assertSee('href="/contact"', false);
    }

    public function test_houtsoorten_page_contains_back_link(): void
    {
        $this->get('/houtsoorten')->assertSee('href="/"', false);
    }
}
