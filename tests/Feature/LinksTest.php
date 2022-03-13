<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LinksTest extends TestCase
{


    public function test_home(): void
    {

        $response = $this->get('/');
        $response->assertStatus(200);

    }

    public function test_create(): void
    {
        $testData = [
            'url' => "https://example.com/abc123"
        ];
        $response = $this->post(route('links.create'), $testData);
        $response->assertStatus(302);
    }

    public function test_delete(): void
    {
        $testData = ['id' => 1];
        $response = $this->get(route('links.delete', $testData));
        $response->assertStatus(302);
    }

    public function test_redirect(): void
    {
        $testData = ['shortLink' => 'https://example.com/l-abc123'];
        $response = $this->get(route('hash', $testData));
        $response->assertStatus(404);
    }



}
