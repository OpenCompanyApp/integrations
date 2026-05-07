<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\FreshworksCrm;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\FreshworksCrm\FreshworksCrmService;
use OpenCompany\Integrations\FreshworksCrm\FreshworksCrmToolProvider;
use OpenCompany\Integrations\FreshworksCrm\Tools\FreshworksCrmCreateDeal;
use OpenCompany\Integrations\FreshworksCrm\Tools\FreshworksCrmCreateTask;
use OpenCompany\Integrations\FreshworksCrm\Tools\FreshworksCrmListContacts;
use OpenCompany\Integrations\FreshworksCrm\Tools\FreshworksCrmListContactFields;
use OpenCompany\Integrations\FreshworksCrm\Tools\FreshworksCrmSearch;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Freshworks CRM endpoint mapping and catalog metadata.
 */
final class FreshworksCrmServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(FreshworksCrmService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(FreshworksCrmService::class);
        Container::getInstance()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_service_maps_core_freshworks_endpoints(): void
    {
        Http::fake([
            'https://example.myfreshworks.test/crm/sales/api/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new FreshworksCrmService('token_test', 'https://example.myfreshworks.test/crm/sales');

        $service->listContacts(2, 50);
        $service->createContact(['first_name' => 'Ada', 'email' => 'ada@example.test']);
        $service->apiPut('/api/deals/123', ['deal' => ['name' => 'Renewal']]);
        $service->apiGet('/api/settings/contacts/fields');
        $service->getCurrentUser();

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Token token=token_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.myfreshworks.test/crm/sales/api/contacts?page=2&per_page=50');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.myfreshworks.test/crm/sales/api/contacts'
            && $request['contact']['email'] === 'ada@example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://example.myfreshworks.test/crm/sales/api/deals/123'
            && $request['deal']['name'] === 'Renewal');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.myfreshworks.test/crm/sales/api/settings/contacts/fields');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.myfreshworks.test/crm/sales/api/users/me');
    }

    public function test_tools_delegate_to_expanded_endpoint_surface(): void
    {
        Http::fake([
            'https://example.myfreshworks.test/crm/sales/api/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new FreshworksCrmService('token_test', 'https://example.myfreshworks.test/crm/sales');

        self::assertNull((new FreshworksCrmCreateDeal($service))->execute([
            'name' => 'Renewal',
            'amount' => 25000,
        ])->error);
        self::assertNull((new FreshworksCrmCreateTask($service))->execute([
            'title' => 'Follow up',
            'targetable_id' => 123,
            'targetable_type' => 'Contact',
        ])->error);
        self::assertNull((new FreshworksCrmSearch($service))->execute([
            'q' => 'Example',
        ])->error);
        self::assertNull((new FreshworksCrmListContactFields($service))->execute([])->error);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.myfreshworks.test/crm/sales/api/deals'
            && $request['deal']['name'] === 'Renewal');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.myfreshworks.test/crm/sales/api/tasks'
            && $request['task']['title'] === 'Follow up');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.myfreshworks.test/crm/sales/api/search?q=Example');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.myfreshworks.test/crm/sales/api/settings/contacts/fields');
    }

    public function test_provider_exposes_expanded_catalog_metadata(): void
    {
        Http::fake([
            'https://example.myfreshworks.test/crm/sales/api/users/me' => Http::response([
                'user' => ['first_name' => 'Ada'],
            ], 200),
        ]);

        $provider = new FreshworksCrmToolProvider();
        $tools = $provider->tools();

        self::assertSame('freshworks-crm', $provider->appName());
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://developers.freshworks.com/crm/api/', $provider->integrationMeta()['docs_url']);
        self::assertSame(51, count($tools));
        self::assertArrayHasKey('freshworks_crm_create_deal', $tools);
        self::assertArrayHasKey('freshworks_crm_list_tasks', $tools);
        self::assertArrayHasKey('freshworks_crm_create_note', $tools);
        self::assertArrayHasKey('freshworks_crm_list_sales_activities', $tools);
        self::assertArrayHasKey('freshworks_crm_list_contact_fields', $tools);

        self::assertTrue($provider->testConnection([
            'api_key' => 'token_test',
            'base_url' => 'https://example.myfreshworks.test/crm/sales',
        ])['success']);
    }

    public function test_named_account_falls_back_to_legacy_underscore_credentials(): void
    {
        Http::fake([
            'https://legacy.myfreshworks.test/crm/sales/api/contacts*' => Http::response([
                'contacts' => [],
            ], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration === 'freshworks-crm') {
                    return '';
                }

                if ($integration === 'freshworks_crm' && $account === 'sales') {
                    return match ($key) {
                        'api_key' => 'legacy-token',
                        'base_url' => 'https://legacy.myfreshworks.test/crm/sales',
                        default => $default,
                    };
                }

                return $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'freshworks_crm' && $account === 'sales';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'freshworks_crm' ? ['sales'] : [];
            }
        });

        $tool = (new FreshworksCrmToolProvider)->createTool(FreshworksCrmListContacts::class, ['account' => 'sales']);
        $result = $tool->execute(['page' => 1, 'per_page' => 25]);

        self::assertTrue($result->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://legacy.myfreshworks.test/crm/sales/api/contacts?page=1&per_page=25'
            && $request->hasHeader('Authorization', 'Token token=legacy-token'));
    }
}
