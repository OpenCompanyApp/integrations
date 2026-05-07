<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Granola;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Granola\GranolaService;
use OpenCompany\Integrations\Granola\GranolaToolProvider;
use OpenCompany\Integrations\Granola\Tools\GranolaGetNote;
use OpenCompany\Integrations\Granola\Tools\GranolaListFolders;
use OpenCompany\Integrations\Granola\Tools\GranolaListNotes;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Granola Enterprise API endpoint mappings.
 */
final class GranolaServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_to_official_notes_and_folders_endpoints(): void
    {
        Http::fake([
            'https://public-api.granola.ai/v1/notes*' => Http::response(['notes' => [], 'hasMore' => false, 'cursor' => null], 200),
            'https://public-api.granola.ai/v1/notes/not_123' => Http::response(['id' => 'not_123', 'title' => 'Weekly review'], 200),
            'https://public-api.granola.ai/v1/folders*' => Http::response(['folders' => [], 'hasMore' => false, 'cursor' => null], 200),
        ]);

        $service = new GranolaService('granola_test');

        $service->listNotes([
            'created_after' => '2026-01-01',
            'updated_after' => '2026-01-02',
            'page_size' => 10,
            'unsupported' => 'ignored',
        ]);
        $service->getNote('not_123');
        $service->listFolders(['page_size' => 30, 'cursor' => 'next_cursor']);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer granola_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://public-api.granola.ai/v1/notes?') && str_contains($request->url(), 'page_size=10') && !str_contains($request->url(), 'unsupported=ignored'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://public-api.granola.ai/v1/notes/not_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://public-api.granola.ai/v1/folders?') && str_contains($request->url(), 'cursor=next_cursor'));
    }

    public function test_tools_map_agent_arguments_to_official_read_only_api(): void
    {
        Http::fake([
            'https://public-api.granola.ai/v1/notes*' => Http::response(['notes' => []], 200),
            'https://public-api.granola.ai/v1/folders*' => Http::response(['folders' => []], 200),
        ]);

        $service = new GranolaService('granola_test');

        self::assertNull((new GranolaListNotes($service))->execute([
            'page_size' => 5,
            'created_before' => '2026-01-27',
        ])->error);
        self::assertNull((new GranolaGetNote($service))->execute([
            'note_id' => 'not_123',
        ])->error);
        self::assertNull((new GranolaListFolders($service))->execute([
            'page_size' => 20,
        ])->error);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://public-api.granola.ai/v1/notes?') && str_contains($request->url(), 'page_size=5'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://public-api.granola.ai/v1/notes/not_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://public-api.granola.ai/v1/folders?') && str_contains($request->url(), 'page_size=20'));
    }

    public function test_provider_exposes_current_read_only_catalog(): void
    {
        Http::fake([
            'https://public-api.granola.ai/v1/notes*' => Http::response(['notes' => []], 200),
        ]);

        $provider = new GranolaToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://docs.granola.ai/api-reference/list-notes', $provider->integrationMeta()['docs_url']);
        self::assertArrayHasKey('granola_list_notes', $tools);
        self::assertArrayHasKey('granola_get_note', $tools);
        self::assertArrayHasKey('granola_list_folders', $tools);
        self::assertArrayNotHasKey('granola_create_note', $tools);
        self::assertSame(3, count($tools));

        self::assertTrue($provider->testConnection([
            'api_key' => 'granola_test',
        ])['success']);
    }
}
