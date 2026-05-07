<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Copper;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Copper\CopperService;
use OpenCompany\Integrations\Copper\CopperToolProvider;
use OpenCompany\Integrations\Copper\Tools\CopperCreateActivity;
use OpenCompany\Integrations\Copper\Tools\CopperCreateTask;
use OpenCompany\Integrations\Copper\Tools\CopperGetContactByEmail;
use OpenCompany\Integrations\Copper\Tools\CopperListLeads;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Copper endpoint mapping and catalog metadata.
 */
final class CopperServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(CopperService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(CopperService::class);
        parent::tearDown();
    }

    public function test_service_maps_people_and_user_endpoints(): void
    {
        Http::fake([
            'https://api.copper.test/developer_api/v1/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new CopperService('token_test', 'ada@example.test', 'https://api.copper.test/developer_api/v1');

        $service->listContacts(['page_size' => 25]);
        $service->getContact(123);
        $service->createContact(['name' => 'Ada Example']);
        $service->updateContact(123, ['name' => 'Ada Lovelace']);
        $service->deleteContact(123);
        $service->getCurrentUser();

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('X-PW-AccessToken', 'token_test')
            && $request->hasHeader('X-PW-Application', 'developer_api')
            && $request->hasHeader('X-PW-UserEmail', 'ada@example.test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.copper.test/developer_api/v1/people/search'
            && $request['page_size'] === 25);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.copper.test/developer_api/v1/people/123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.copper.test/developer_api/v1/people'
            && $request['name'] === 'Ada Example');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://api.copper.test/developer_api/v1/people/123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://api.copper.test/developer_api/v1/people/123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.copper.test/developer_api/v1/users/me');
    }

    public function test_tools_delegate_to_expanded_endpoint_surface(): void
    {
        Http::fake([
            'https://api.copper.test/developer_api/v1/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new CopperService('token_test', 'ada@example.test', 'https://api.copper.test/developer_api/v1');

        self::assertNull((new CopperGetContactByEmail($service))->execute([
            'email' => 'ada@example.test',
        ])->error);
        self::assertNull((new CopperListLeads($service))->execute([
            'page_size' => 10,
            'email' => 'buyer@example.test',
        ])->error);
        self::assertNull((new CopperCreateTask($service))->execute([
            'name' => 'Follow up',
            'related_resource' => ['type' => 'person', 'id' => 123],
        ])->error);
        self::assertNull((new CopperCreateActivity($service))->execute([
            'parent' => ['type' => 'person', 'id' => 123],
            'type' => ['category' => 'user', 'id' => 1],
            'details' => 'Discussed renewal.',
        ])->error);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.copper.test/developer_api/v1/people/fetch_by_email');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.copper.test/developer_api/v1/leads/search'
            && $request['email'] === 'buyer@example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.copper.test/developer_api/v1/tasks'
            && $request['name'] === 'Follow up');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.copper.test/developer_api/v1/activities'
            && $request['details'] === 'Discussed renewal.');
    }

    public function test_provider_exposes_expanded_catalog_metadata(): void
    {
        Http::fake([
            'https://api.copper.com/developer_api/v1/users/me' => Http::response([
                'first_name' => 'Ada',
                'last_name' => 'Example',
            ], 200),
        ]);

        $provider = new CopperToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://developer.copper.com/introduction/requests.html', $provider->integrationMeta()['docs_url']);
        self::assertSame(55, count($tools));
        self::assertArrayHasKey('copper_get_contact_by_email', $tools);
        self::assertArrayHasKey('copper_list_leads', $tools);
        self::assertArrayHasKey('copper_list_projects', $tools);
        self::assertArrayHasKey('copper_list_tasks', $tools);
        self::assertArrayHasKey('copper_list_activities', $tools);
        self::assertArrayHasKey('copper_list_custom_field_definitions', $tools);
        self::assertArrayHasKey('copper_create_webhook', $tools);

        self::assertTrue($provider->testConnection([
            'api_key' => 'token_test',
            'email' => 'ada@example.test',
        ])['success']);
    }
}
