<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\ZendeskSell;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellCreateDeal;
use OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellCreateTask;
use OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellUpdateContact;
use OpenCompany\Integrations\ZendeskSell\ZendeskSellService;
use OpenCompany\Integrations\ZendeskSell\ZendeskSellToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Zendesk Sell endpoint mapping and catalog metadata.
 */
final class ZendeskSellServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(ZendeskSellService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(ZendeskSellService::class);
        parent::tearDown();
    }

    public function test_service_maps_core_endpoints_and_data_envelope(): void
    {
        Http::fake([
            'https://api.example.test/v2/*' => Http::response(['data' => ['ok' => true]], 200),
        ]);

        $service = new ZendeskSellService('token_test', 'https://api.example.test');

        $service->listContacts(2, 50, 'updated_at:desc');
        $service->createContact(['first_name' => 'Ada', 'last_name' => 'Example']);
        $service->apiPut('/v2/deals/123', ['data' => ['stage_id' => 2]]);
        $service->apiDelete('/v2/tasks/456');
        $service->getCurrentUser();

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer token_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/v2/contacts?page=2&per_page=50&sort_by=updated_at%3Adesc');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/v2/contacts'
            && $request['data']['first_name'] === 'Ada');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://api.example.test/v2/deals/123'
            && $request['data']['stage_id'] === 2);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://api.example.test/v2/tasks/456');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/v2/users/me');
    }

    public function test_tools_delegate_to_expanded_endpoint_surface(): void
    {
        Http::fake([
            'https://api.example.test/v2/*' => Http::response(['data' => ['ok' => true]], 200),
        ]);

        $service = new ZendeskSellService('token_test', 'https://api.example.test');

        self::assertNull((new ZendeskSellUpdateContact($service))->execute([
            'id' => 123,
            'email' => 'ada@example.test',
        ])->error);
        self::assertNull((new ZendeskSellCreateDeal($service))->execute([
            'name' => 'Website Redesign',
            'value' => 25000,
            'contact_id' => 123,
        ])->error);
        self::assertNull((new ZendeskSellCreateTask($service))->execute([
            'content' => 'Follow up',
            'resource_type' => 'deal',
            'resource_id' => 456,
        ])->error);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://api.example.test/v2/contacts/123'
            && $request['data']['email'] === 'ada@example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/v2/deals'
            && $request['data']['name'] === 'Website Redesign');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/v2/tasks'
            && $request['data']['resource_type'] === 'deal');
    }

    public function test_provider_exposes_expanded_catalog_metadata(): void
    {
        Http::fake([
            'https://api.example.test/v2/users/me' => Http::response([
                'data' => ['first_name' => 'Ada', 'last_name' => 'Example'],
            ], 200),
        ]);

        $provider = new ZendeskSellToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://developer.zendesk.com/api-reference/sales-crm/resources/introduction/', $provider->integrationMeta()['docs_url']);
        self::assertSame(55, count($tools));
        self::assertArrayHasKey('zendesk_sell_upsert_contact', $tools);
        self::assertArrayHasKey('zendesk_sell_create_task', $tools);
        self::assertArrayHasKey('zendesk_sell_list_pipelines', $tools);
        self::assertArrayHasKey('zendesk_sell_list_deal_sources', $tools);
        self::assertArrayHasKey('zendesk_sell_list_products', $tools);

        self::assertTrue($provider->testConnection([
            'access_token' => 'token_test',
            'url' => 'https://api.example.test',
        ])['success']);
    }
}
