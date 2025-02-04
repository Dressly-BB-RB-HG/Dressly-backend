<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_szinu_ruha(): void
    {
        $response = $this->get('/api/szinu-ruha/fekete/kabát');
        $response->assertStatus(200);
    }

    public function test_meret_ruhak(): void
    {
        $response = $this->get('/api/meret-ruhak/M');
        $response->assertStatus(200);
    }

    public function test_szinu_minden(): void
    {
        $response = $this->get('/api/szinu-minden/Fehér');
        $response->assertStatus(200);
    }

    public function test_marka_ruhak(): void
    {
        $response = $this->get('/api/marka-ruhak/Nike');
        $response->assertStatus(200);
    }

    public function test_marka_kategoria(): void
    {
        $response = $this->get('/api/marka-kategoria/Nike/Pulóver');
        $response->assertStatus(200);
    }

    public function test_nemu_kategoria(): void
    {
        $response = $this->get('/api/nemu-kategoria/U/zokni');
        $response->assertStatus(200);
    }

    public function test_modellek_kategoriaval(): void
    {
        $response = $this->get('/api/modellek-kategoriaval');
        $response->assertStatus(200);
    }

    public function test_kategoria_ruhak(): void
    {
        $response = $this->get('/api/kategoria-ruhak/Kabát');
        $response->assertStatus(200);
    }

    public function test_meret_marka_tipus(): void
    {
        $response = $this->get('/api/meret-marka-tipus/M/Nike/F');
        $response->assertStatus(200);
    }

    public function test_meret_marka_tipus_kategoria(): void
    {
        $response = $this->get('/api/meret-marka-tipus-kategoria/S/Nike/U/Pulóver');
        $response->assertStatus(200);
    }

    public function test_modell_post(): void
    {
        $response = $this->withoutMiddleware()->post('/api/admin/modell', ['kategoria' => '1', 'tipus' => 'F', 'gyarto' => 'Nike', 'kep' => 'asd']);
        $response->assertStatus(201);
    }
}
