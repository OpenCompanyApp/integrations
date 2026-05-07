<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Close;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Close\CloseService;
use OpenCompany\Integrations\Close\CloseToolProvider;
use OpenCompany\Integrations\Close\Tools\CloseCreateContact;
use OpenCompany\Integrations\Close\Tools\CloseCreateNote;
use OpenCompany\Integrations\Close\Tools\CloseCreateOpportunity;
use OpenCompany\Integrations\Close\Tools\CloseListTasks;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Close CRM endpoint mapping and catalog metadata.
 */
final class CloseServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(CloseService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(CloseService::class);
        parent::tearDown();
    }

    public function test_service_maps_close_rest_endpoints(): void
    {
        Http::fake([
            'https://api.close.test/api/v1/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new CloseService('api_key_test', 'https://api.close.test/api/v1');

        $service->listLeads('status:Potential', 25, 50);
        $service->getCurrentUser();
        $service->createTask('Follow up', 'lead_123', 'user_123', '2026-05-15');
        $service->apiPost('/opportunity/', ['lead_id' => 'lead_123', 'status_id' => 'stat_123']);
        $service->apiDelete('/contact/cont_123/');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Basic ' . base64_encode('api_key_test:')));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.close.test/api/v1/lead/?_limit=25&query=status%3APotential&_skip=50');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.close.test/api/v1/me/');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.close.test/api/v1/task/'
            && $request['assigned_to'] === 'user_123'
            && $request['date'] === '2026-05-15');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.close.test/api/v1/opportunity/'
            && $request['lead_id'] === 'lead_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://api.close.test/api/v1/contact/cont_123/');
    }

    public function test_tools_delegate_to_expanded_endpoint_surface(): void
    {
        Http::fake([
            'https://api.close.test/api/v1/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new CloseService('api_key_test', 'https://api.close.test/api/v1');

        self::assertNull((new CloseCreateContact($service))->execute([
            'lead_id' => 'lead_123',
            'name' => 'Ada Example',
            'emails' => [['email' => 'ada@example.test', 'type' => 'office']],
        ])->error);

        self::assertNull((new CloseCreateOpportunity($service))->execute([
            'lead_id' => 'lead_123',
            'status_id' => 'stat_123',
            'value' => 100000,
            'value_period' => 'one_time',
        ])->error);

        self::assertNull((new CloseListTasks($service))->execute([
            'lead_id' => 'lead_123',
            '_type' => 'all',
            '_limit' => 10,
        ])->error);

        self::assertNull((new CloseCreateNote($service))->execute([
            'lead_id' => 'lead_123',
            'note' => 'Implementation timeline requested.',
        ])->error);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.close.test/api/v1/contact/'
            && $request['lead_id'] === 'lead_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.close.test/api/v1/opportunity/'
            && $request['status_id'] === 'stat_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.close.test/api/v1/task/?lead_id=lead_123&_type=all&_limit=10');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.close.test/api/v1/activity/note/'
            && $request['note'] === 'Implementation timeline requested.');
    }

    public function test_provider_exposes_expanded_catalog_metadata(): void
    {
        Http::fake([
            'https://api.close.com/api/v1/me/' => Http::response([
                'first_name' => 'Ada',
                'last_name' => 'Example',
                'email' => 'ada@example.test',
            ], 200),
        ]);

        $provider = new CloseToolProvider();
        $tools = $provider->tools();

        self::assertSame('Close CRM', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://developer.close.com/api/overview', $provider->integrationMeta()['docs_url']);
        self::assertSame(42, count($tools));
        self::assertArrayHasKey('close_create_contact', $tools);
        self::assertArrayHasKey('close_list_opportunities', $tools);
        self::assertArrayHasKey('close_list_tasks', $tools);
        self::assertArrayHasKey('close_create_note', $tools);
        self::assertArrayHasKey('close_list_users', $tools);
        self::assertArrayHasKey('close_list_lead_statuses', $tools);
        self::assertArrayHasKey('close_list_pipelines', $tools);

        self::assertTrue($provider->testConnection([
            'api_key' => 'api_key_test',
        ])['success']);
    }
}
