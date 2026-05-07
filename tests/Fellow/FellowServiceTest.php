<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Fellow;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Fellow\FellowService;
use OpenCompany\Integrations\Fellow\FellowToolProvider;
use OpenCompany\Integrations\Fellow\Tools\FellowApiGet;
use OpenCompany\Integrations\Fellow\Tools\FellowCreateWebhook;
use OpenCompany\Integrations\Fellow\Tools\FellowMarkActionItemComplete;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Fellow Developer API endpoint and auth mapping.
 */
final class FellowServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_official_v1_endpoints_and_x_api_key_auth(): void
    {
        Http::fake([
            'https://example.fellow.app/api/v1/*' => Http::response(['ok' => true, 'data' => []], 200),
        ]);

        $service = new FellowService(apiKey: 'fel_test', subdomain: 'example');

        $service->getCurrentUser();
        $service->listNotes(['pagination' => ['page_size' => 10]]);
        $service->getNote('note_1');
        $service->deleteNote('note_1');
        $service->listActionItems(['filters' => ['scope' => 'assigned_to_me']]);
        $service->getActionItem('action_1');
        $service->markActionItemComplete('action_1', true);
        $service->archiveActionItem('action_1');
        $service->listRecordings(['media_url' => ['expires_in' => 3600]]);
        $service->getRecording('rec_1');
        $service->deleteRecording('rec_1');
        $service->listWebhooks(['page_size' => 20]);
        $service->createWebhook(['url' => 'https://example.test/fellow', 'enabled_events' => ['action_item.assigned']]);
        $service->getWebhook('hook_1');
        $service->updateWebhook('hook_1', ['status' => 'inactive']);
        $service->deleteWebhook('hook_1');
        $service->apiGet('/me');
        $service->apiPost('/notes', ['filters' => []]);
        $service->apiPatch('/webhook/hook_1', ['status' => 'active']);
        $service->apiDelete('/webhook/hook_1');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('X-API-KEY', 'fel_test'));
        Http::assertSent(static fn (Request $request): bool => ! $request->hasHeader('Authorization'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://example.fellow.app/api/v1/me');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://example.fellow.app/api/v1/notes');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://example.fellow.app/api/v1/note/note_1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://example.fellow.app/api/v1/action_items');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://example.fellow.app/api/v1/action_item/action_1/complete');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://example.fellow.app/api/v1/recordings');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://example.fellow.app/api/v1/webhooks?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://example.fellow.app/api/v1/webhook/hook_1');
    }

    public function test_tools_delegate_and_validate_required_arguments(): void
    {
        Http::fake([
            'https://example.fellow.app/api/v1/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new FellowService(apiKey: 'fel_test', subdomain: 'example');

        self::assertTrue((new FellowMarkActionItemComplete($service))->execute([
            'action_item_id' => 'action_1',
            'completed' => true,
        ])->succeeded());
        self::assertTrue((new FellowCreateWebhook($service))->execute([
            'url' => 'https://example.test/fellow',
            'enabled_events' => ['action_item.assigned'],
        ])->succeeded());
        self::assertTrue((new FellowApiGet($service))->execute([
            'path' => '/me',
        ])->succeeded());
        self::assertFalse((new FellowMarkActionItemComplete($service))->execute([
            'completed' => true,
        ])->succeeded());
        self::assertFalse((new FellowApiGet($service))->execute([
            'path' => 'https://example.test/me',
        ])->succeeded());
    }

    public function test_provider_exposes_expanded_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://example.fellow.app/api/v1/me' => Http::response(['id' => 'user_1'], 200),
        ]);

        $provider = new FellowToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertArrayHasKey('fellow_list_notes', $tools);
        self::assertArrayHasKey('fellow_get_action_item', $tools);
        self::assertArrayHasKey('fellow_list_recordings', $tools);
        self::assertArrayHasKey('fellow_create_webhook', $tools);
        self::assertArrayHasKey('fellow_api_patch', $tools);
        self::assertSame(20, count($tools));
        self::assertTrue($provider->testConnection([
            'api_key' => 'fel_test',
            'subdomain' => 'example',
        ])['success']);
    }
}
