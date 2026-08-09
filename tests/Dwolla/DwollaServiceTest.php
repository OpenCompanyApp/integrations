<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Dwolla;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;
use OpenCompany\Integrations\Dwolla\DwollaService;
use OpenCompany\Integrations\Dwolla\DwollaServiceProvider;
use OpenCompany\Integrations\Dwolla\DwollaToolProvider;
use OpenCompany\Integrations\Dwolla\Tools\DwollaCreateApplicationAccessToken;
use OpenCompany\Integrations\Dwolla\Tools\DwollaCreateCustomer;
use OpenCompany\Integrations\Dwolla\Tools\DwollaGetCustomer;
use OpenCompany\Integrations\Dwolla\Tools\DwollaGetRoot;
use OpenCompany\Integrations\Dwolla\Tools\DwollaListAndSearchCustomers;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the generated Dwolla OpenAPI integration.
 */
final class DwollaServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(DwollaService::class);
        app()->forgetInstance(CredentialResolver::class);
        app()->forgetInstance(ToolProviderRegistry::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(DwollaService::class);
        app()->forgetInstance(CredentialResolver::class);
        app()->forgetInstance(ToolProviderRegistry::class);
        parent::tearDown();
    }

    public function test_provider_matches_openapi_manifest_and_docs(): void
    {
        $provider = new DwollaToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/dwolla/dwolla-openapi-manifest.json'), true);

        self::assertSame(82, $manifest['method_count']);
        self::assertSame('2.0', $manifest['version']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Dwolla', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('oauth_client_credentials', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertContains('access_token', $provider->integrationCapabilities()['auth']['token_keys']);
        self::assertCount(3, $provider->credentialFields());
        self::assertCount(4, $provider->configSchema());
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertContains('dwolla_create_application_access_token', array_keys($provider->tools()));
        self::assertContains('dwolla_create_customer', array_keys($provider->tools()));
        self::assertContains('dwolla_list_and_search_customers', array_keys($provider->tools()));
    }

    public function test_service_maps_bearer_basic_path_query_hal_and_form_requests(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200, ['Location' => 'https://dwolla.example.test/customers/customer-1'])]);

        $service = new DwollaService('access', 'client', 'secret', 'https://dwolla.example.test');
        $service->request('GET', '/customers/{id}', ['id' => 'customer 1'], ['limit' => 2]);
        $service->request('POST', '/customers', [], [], [], ['firstName' => 'Example'], 'application/vnd.dwolla.v1.hal+json');
        $service->request('POST', '/token', [], [], [], ['grant_type' => 'client_credentials'], 'application/x-www-form-urlencoded', 'basic');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://dwolla.example.test/customers/customer%201?limit=2'
            && $request->hasHeader('Authorization', 'Bearer access'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://dwolla.example.test/customers'
            && $request->hasHeader('Content-Type', 'application/vnd.dwolla.v1.hal+json')
            && $request['firstName'] === 'Example');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://dwolla.example.test/token'
            && $request->hasHeader('Authorization', 'Basic '.base64_encode('client:secret'))
            && $request['grant_type'] === 'client_credentials');
    }

    public function test_tools_validate_and_map_parameters(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new DwollaService('access', 'client', 'secret', 'https://dwolla.example.test');

        self::assertTrue((new DwollaGetRoot($service))->execute([])->succeeded());
        self::assertTrue((new DwollaListAndSearchCustomers($service))->execute(['limit' => 5, 'search' => 'example'])->succeeded());
        self::assertTrue((new DwollaGetCustomer($service))->execute(['id' => 'customer-1'])->succeeded());
        self::assertTrue((new DwollaCreateCustomer($service))->execute(['body' => ['firstName' => 'Example']])->succeeded());
        self::assertTrue((new DwollaCreateApplicationAccessToken(new DwollaService('', 'client', 'secret', 'https://dwolla.example.test')))->execute(['body' => ['grant_type' => 'client_credentials']])->succeeded());

        $missingPath = (new DwollaGetCustomer($service))->execute([]);
        $badBody = (new DwollaCreateCustomer($service))->execute(['body' => 'not-object']);
        $unconfigured = (new DwollaGetRoot(new DwollaService('', '', '', 'https://dwolla.example.test')))->execute([]);

        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('id must be', (string) $missingPath->error);
        self::assertFalse($badBody->succeeded());
        self::assertStringContainsString('body must be a non-empty object', (string) $badBody->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_uses_root_endpoint(): void
    {
        Http::fake(['dwolla.example.test/' => Http::response(['_links' => []], 200)]);

        $result = (new DwollaToolProvider)->testConnection(['access_token' => 'access', 'url' => 'https://dwolla.example.test']);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://dwolla.example.test/'
            && $request->hasHeader('Authorization', 'Bearer access'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['ok' => true], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['dwolla', 'access_token', 'merchant'] => 'account-token',
                    ['dwolla', 'client_id', 'merchant'] => 'account-client',
                    ['dwolla', 'client_secret', 'merchant'] => 'account-secret',
                    ['dwolla', 'url', 'merchant'] => 'https://account-dwolla.example.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'dwolla' && $account === 'merchant';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'dwolla' ? ['merchant'] : [];
            }
        });

        $tool = (new DwollaToolProvider)->createTool(DwollaGetRoot::class, ['account' => 'merchant']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://account-dwolla.example.test/'
            && $request->hasHeader('Authorization', 'Bearer account-token'));

        $registry = new ToolProviderRegistry;
        app()->instance(ToolProviderRegistry::class, $registry);
        (new DwollaServiceProvider(app()))->boot();

        self::assertTrue($registry->has('dwolla'));
        self::assertInstanceOf(DwollaToolProvider::class, $registry->get('dwolla'));
    }
}
