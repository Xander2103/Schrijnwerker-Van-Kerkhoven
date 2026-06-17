<?php

namespace Tests\Feature;

use Tests\TestCase;

class WerkplaatsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
    }

    public function test_werkplaats_page_loads_successfully(): void
    {
        $this->get('/werkplaats')->assertStatus(200);
    }

    public function test_werkplaats_page_contains_heading(): void
    {
        $this->get('/werkplaats')->assertSee('Waar vakmanschap vorm krijgt');
    }

    public function test_werkplaats_page_contains_eyebrow(): void
    {
        $this->get('/werkplaats')->assertSee('Eigen werkplaats');
    }

    public function test_werkplaats_page_contains_cta(): void
    {
        $this->get('/werkplaats')->assertSee('href="/contact"', false);
    }

    public function test_werkplaats_page_contains_back_link(): void
    {
        $this->get('/werkplaats')->assertSee('href="/"', false);
    }
}
