<?php

declare(strict_types=1);

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CardsControllerTest extends TestCase
{
    public function test__success__invalid_sort_is_no_sort(): void
    {
        $response = $this->getJson('/api/cards?sort=bogus');

        $response->assertOk();
    }

    public function test__success__sort_desc(): void
    {
        $response = $this->getJson('/api/cards?sort=-1');

        $response->assertOk();
        $responseOriginalContent = $response->getOriginalContent();
        static::assertCount(6, $responseOriginalContent);
        static::assertGreaterThanOrEqual($responseOriginalContent[1]['realName'], $responseOriginalContent[0]['realName']);
        static::assertGreaterThanOrEqual($responseOriginalContent[2]['realName'], $responseOriginalContent[1]['realName']);
        static::assertGreaterThanOrEqual($responseOriginalContent[3]['realName'], $responseOriginalContent[2]['realName']);
        static::assertGreaterThanOrEqual($responseOriginalContent[4]['realName'], $responseOriginalContent[3]['realName']);
        static::assertGreaterThanOrEqual($responseOriginalContent[5]['realName'], $responseOriginalContent[4]['realName']);
    }

    public function test__success__sort_asc(): void
    {
        $response = $this->getJson('/api/cards?sort=1');

        $response->assertOk();
        $responseOriginalContent = $response->getOriginalContent();
        static::assertCount(6, $responseOriginalContent);
        static::assertLessThanOrEqual($responseOriginalContent[1]['realName'], $responseOriginalContent[0]['realName']);
        static::assertLessThanOrEqual($responseOriginalContent[2]['realName'], $responseOriginalContent[1]['realName']);
        static::assertLessThanOrEqual($responseOriginalContent[3]['realName'], $responseOriginalContent[2]['realName']);
        static::assertLessThanOrEqual($responseOriginalContent[4]['realName'], $responseOriginalContent[3]['realName']);
        static::assertLessThanOrEqual($responseOriginalContent[5]['realName'], $responseOriginalContent[4]['realName']);
    }
}
