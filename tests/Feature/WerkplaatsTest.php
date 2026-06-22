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
        $this->get('/nl/werkplaats')->assertStatus(200);
    }

    public function test_werkplaats_page_contains_nl_heading(): void
    {
        $this->get('/nl/werkplaats')->assertSee('Waar vakmanschap vorm krijgt');
    }

    public function test_werkplaats_page_contains_nl_eyebrow(): void
    {
        $this->get('/nl/werkplaats')->assertSee('Eigen werkplaats');
    }

    public function test_werkplaats_page_contains_back_link(): void
    {
        $this->get('/nl/werkplaats')->assertSee('href="/nl"', false);
    }

    public function test_fr_werkplaats_page_loads(): void
    {
        $this->get('/fr/werkplaats')->assertStatus(200);
    }

    public function test_en_werkplaats_page_loads(): void
    {
        $this->get('/en/werkplaats')->assertStatus(200);
    }

    public function test_legacy_werkplaats_redirects_to_nl(): void
    {
        $this->get('/werkplaats')->assertRedirect('/nl/werkplaats');
    }

    public function test_legacy_houtsoorten_redirects_to_nl_werkplaats(): void
    {
        $this->get('/houtsoorten')->assertRedirect('/nl/werkplaats');
    }

    public function test_legacy_werkhuis_redirects_to_nl_werkplaats(): void
    {
        $this->get('/werkhuis')->assertRedirect('/nl/werkplaats');
    }
}
