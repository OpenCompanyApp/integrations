<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Droplr;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Droplr\DroplrService;
use OpenCompany\Integrations\Droplr\DroplrToolProvider;
use OpenCompany\Integrations\Droplr\Tools\DroplrApiGet;
use OpenCompany\Integrations\Droplr\Tools\DroplrCreateNote;
use OpenCompany\Integrations\Droplr\Tools\DroplrUpdateDrop;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for expanded Droplr API coverage.
 */
final class DroplrServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_drop_account_board_and_generic_helpers(): void
    {
        Http::fake([
            'https://api.droplr.com/*' => Http::response(['ok' => true, 'email' => 'user@example.test'], 200),
        ]);

        $service = new DroplrService('drop_test');

        $service->listDrops(['type' => 'LINK', 'sortBy' => 'CREATION', 'order' => 'DESC', 'limit' => 25]);
        $service->getDrop('abc123');
        $service->createLinkDrop('https://example.test/docs', 'Documentation', null, ['privacy' => 'OBSCURE']);
        $service->createNoteDrop('Release note text', 'Release note', 'plain');
        $service->createDrop(['type' => 'LINK', 'link' => 'https://example.test']);
        $service->updateDrop('abc123', ['title' => 'Updated']);
        $service->deleteDrop('abc123');
        $service->listBoards(['page' => 1, 'limit' => 10]);
        $service->getCurrentUser();
        $service->updateCurrentUser(['theme' => 'dark']);
        $service->apiGet('/v2/drops', ['limit' => 10]);
        $service->apiPost('/v2/drops', ['link' => 'https://example.test']);
        $service->apiPut('/v2/user', ['theme' => 'dark']);
        $service->apiDelete('/v2/drops/abc123');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer drop_test'));
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'https://api.droplr.com/v2/drops?type=LINK'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.droplr.com/v2/drops');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://api.droplr.com/v2/drops/abc123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.droplr.com/v2/drops/abc123');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.droplr.com/v2/user');
    }

    public function test_new_tools_delegate_and_validate_required_arguments(): void
    {
        Http::fake([
            'https://api.droplr.com/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new DroplrService('drop_test');

        self::assertTrue((new DroplrCreateNote($service))->execute([
            'content' => 'Release note text',
            'title' => 'Release note',
        ])->succeeded());
        self::assertTrue((new DroplrUpdateDrop($service))->execute([
            'id' => 'abc123',
            'body' => ['title' => 'Updated'],
        ])->succeeded());
        self::assertTrue((new DroplrApiGet($service))->execute([
            'path' => '/v2/drops',
            'params' => ['limit' => 10],
        ])->succeeded());
        self::assertFalse((new DroplrCreateNote($service))->execute([
            'content' => '',
        ])->succeeded());
    }

    public function test_provider_exposes_expanded_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://api.droplr.com/v2/user' => Http::response(['email' => 'user@example.test'], 200),
        ]);

        $provider = new DroplrToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertArrayHasKey('droplr_create_note', $tools);
        self::assertArrayHasKey('droplr_create_drop_raw', $tools);
        self::assertArrayHasKey('droplr_update_drop', $tools);
        self::assertArrayHasKey('droplr_update_current_user', $tools);
        self::assertArrayHasKey('droplr_api_delete', $tools);
        self::assertSame(14, count($tools));
        self::assertTrue($provider->testConnection([
            'access_token' => 'drop_test',
        ])['success']);
    }
}
