<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/api/barna-polok');
        $response->assertStatus(200);
    }

    public function testAPostResponse(): void
    {
        $response = $this->withoutMiddleware()->post('/api/admin/modell', ['kategoria' => '1', 'tipus' => 'F', 'gyarto' => 'Nike', 'kep' => 'asd']);
        $response->assertStatus(201);
    }

    
}
