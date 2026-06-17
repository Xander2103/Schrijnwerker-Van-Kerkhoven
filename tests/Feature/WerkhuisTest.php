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

    public function test_werkhuis_page_loads_successfully(): void
    {
        $this->get('/werkhuis')->assertStatus(200);
    }

    public function test_werkhuis_page_contains_heading(): void
    {
        $this->get('/werkhuis')->assertSee('Vakmanschap begint in ons eigen atelier');
    }

    public function test_werkhuis_page_contains_eyebrow(): void
    {
        $this->get('/werkhuis')->assertSee('Eigen werkhuis');
    }

    public function test_werkhuis_page_contains_cta(): void
    {
        $this->get('/werkhuis')->assertSee('href="/contact"', false);
    }

    public function test_werkhuis_page_contains_back_link(): void
    {
        $this->get('/werkhuis')->assertSee('href="/"', false);
    }
}
