<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Insightly;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Insightly\InsightlyService;
use OpenCompany\Integrations\Insightly\InsightlyToolProvider;
use OpenCompany\Integrations\Insightly\Tools\InsightlyCreateEvent;
use OpenCompany\Integrations\Insightly\Tools\InsightlySearchContacts;
use OpenCompany\Integrations\Insightly\Tools\InsightlyUpdateContact;
use OpenCompany\Integrations\Insightly\Tools\InsightlyUpdateTask;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Insightly authentication, endpoint mapping, and metadata.
 */
final class InsightlyServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(InsightlyService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(InsightlyService::class);
        parent::tearDown();
    }

    public function test_service_maps_insightly_rest_endpoints_and_basic_auth(): void
    {
        Http::fake([
            'https://api.example.test/v3.1/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new InsightlyService('api_key_test', 'https://api.example.test');

        $service->listContacts(top: 25, skip: 50, brief: true, countTotal: true);
        $service->getCurrentUser();
        $service->apiPut('/v3.1/Contacts', ['CONTACT_ID' => 123, 'FIRST_NAME' => 'Ada']);
        $service->apiGet('/v3.1/Contacts/Search', ['field_name' => 'EMAIL_ADDRESS', 'field_value' => 'ada@example.test']);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Basic ' . base64_encode('api_key_test')));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/v3.1/Contacts?top=25&skip=50&brief=1&count_total=1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/v3.1/Users/Me');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://api.example.test/v3.1/Contacts'
            && $request['CONTACT_ID'] === 123);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/v3.1/Contacts/Search?field_name=EMAIL_ADDRESS&field_value=ada%40example.test');
    }

    public function test_tools_delegate_to_expanded_endpoint_surface(): void
    {
        Http::fake([
            'https://api.example.test/v3.1/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new InsightlyService('api_key_test', 'https://api.example.test');

        self::assertNull((new InsightlyUpdateContact($service))->execute([
            'id' => 123,
            'FIRST_NAME' => 'Ada',
        ])->error);
        self::assertNull((new InsightlyUpdateTask($service))->execute([
            'id' => 456,
            'TITLE' => 'Follow up',
        ])->error);
        self::assertNull((new InsightlySearchContacts($service))->execute([
            'field_name' => 'EMAIL_ADDRESS',
            'field_value' => 'ada@example.test',
        ])->error);
        self::assertNull((new InsightlyCreateEvent($service))->execute([
            'TITLE' => 'Implementation call',
            'START_DATE_UTC' => '2026-05-21T15:00:00Z',
            'END_DATE_UTC' => '2026-05-21T15:30:00Z',
        ])->error);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://api.example.test/v3.1/Contacts'
            && $request['CONTACT_ID'] === 123);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://api.example.test/v3.1/Tasks'
            && $request['TASK_ID'] === 456);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/v3.1/Contacts/Search?field_name=EMAIL_ADDRESS&field_value=ada%40example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/v3.1/Events'
            && $request['TITLE'] === 'Implementation call');
    }

    public function test_provider_exposes_expanded_catalog_metadata(): void
    {
        Http::fake([
            'https://api.example.test/v3.1/Users/Me' => Http::response([
                'FIRST_NAME' => 'Ada',
                'LAST_NAME' => 'Example',
            ], 200),
        ]);

        $provider = new InsightlyToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://api.na1.insightly.com/v3.1/Help', $provider->integrationMeta()['docs_url']);
        self::assertSame(89, count($tools));
        self::assertArrayHasKey('insightly_search_contacts', $tools);
        self::assertArrayHasKey('insightly_create_event', $tools);
        self::assertArrayHasKey('insightly_update_task', $tools);
        self::assertArrayHasKey('insightly_list_pipeline_stages', $tools);
        self::assertArrayHasKey('insightly_list_custom_fields', $tools);
        self::assertArrayHasKey('insightly_list_team_members', $tools);

        self::assertTrue($provider->testConnection([
            'api_key' => 'api_key_test',
            'base_url' => 'https://api.example.test',
        ])['success']);
    }
}
