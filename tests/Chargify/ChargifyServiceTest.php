<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Chargify;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Chargify\ChargifyService;
use OpenCompany\Integrations\Chargify\ChargifyToolProvider;
use OpenCompany\Integrations\Chargify\Tools\ChargifyGetCurrentUser;
use OpenCompany\Integrations\Chargify\Tools\ChargifyGetCustomer;
use OpenCompany\Integrations\Chargify\Tools\ChargifyGetInvoice;
use OpenCompany\Integrations\Chargify\Tools\ChargifyGetSubscription;
use OpenCompany\Integrations\Chargify\Tools\ChargifyListCustomers;
use OpenCompany\Integrations\Chargify\Tools\ChargifyListInvoices;
use OpenCompany\Integrations\Chargify\Tools\ChargifyListProducts;
use OpenCompany\Integrations\Chargify\Tools\ChargifyListSubscriptions;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Chargify / Maxio Advanced Billing integration.
 */
final class ChargifyServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(ChargifyService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(ChargifyService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new ChargifyToolProvider;

        self::assertSame('chargify', $provider->appName());
        self::assertSame('Chargify', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('https://developers.maxio.com/', $provider->integrationMeta()['docs_url']);
        self::assertSame('basic_auth_api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertContains('api_key', $provider->integrationCapabilities()['auth']['token_keys']);
        self::assertSame('API Key', $provider->credentialFields()[0]['label']);
        self::assertSame('API Password', $provider->credentialFields()[1]['label']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertCount(8, $provider->tools());
        self::assertArrayHasKey('chargify_get_invoice', $provider->tools());
    }

    public function test_routes_are_mapped_and_use_basic_auth(): void
    {
        $service = new ChargifyService(apiKey: 'api-key', subdomain: 'demo');

        Http::fake(['*' => Http::response([['subscription' => ['id' => 123]]], 200)]);
        self::assertTrue((new ChargifyListSubscriptions($service))->execute(['page' => 2, 'per_page' => 50, 'state' => 'active'])->succeeded());
        Http::assertSent(fn (Request $request): bool => $this->matchesRequest($request, 'https://demo.chargify.com/subscriptions.json', [
            'page' => '2',
            'per_page' => '50',
            'state' => 'active',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['subscription' => ['id' => 123]], 200)]);
        self::assertTrue((new ChargifyGetSubscription($service))->execute(['subscription_id' => 123])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://demo.chargify.com/subscriptions/123.json'
            && $request->hasHeader('Authorization', 'Basic ' . base64_encode('api-key:x')));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response([['customer' => ['id' => 456]]], 200)]);
        self::assertTrue((new ChargifyListCustomers($service))->execute(['page' => 1, 'per_page' => 25])->succeeded());
        Http::assertSent(fn (Request $request): bool => $this->matchesRequest($request, 'https://demo.chargify.com/customers.json', [
            'page' => '1',
            'per_page' => '25',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['customer' => ['id' => 456]], 200)]);
        self::assertTrue((new ChargifyGetCustomer($service))->execute(['customer_id' => 456])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://demo.chargify.com/customers/456.json');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response([['product' => ['id' => 789]]], 200)]);
        self::assertTrue((new ChargifyListProducts($service))->execute(['page' => 1, 'per_page' => 10])->succeeded());
        Http::assertSent(fn (Request $request): bool => $this->matchesRequest($request, 'https://demo.chargify.com/products.json', [
            'page' => '1',
            'per_page' => '10',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response([['invoice' => ['uid' => 'inv_123']]], 200)]);
        self::assertTrue((new ChargifyListInvoices($service))->execute(['page' => 3, 'per_page' => 20, 'status' => 'open'])->succeeded());
        Http::assertSent(fn (Request $request): bool => $this->matchesRequest($request, 'https://demo.chargify.com/invoices.json', [
            'page' => '3',
            'per_page' => '20',
            'status' => 'open',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['invoice' => ['uid' => 'inv_123']], 200)]);
        self::assertTrue((new ChargifyGetInvoice($service))->execute(['invoice_id' => 'inv_123'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://demo.chargify.com/invoices/inv_123.json');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['site' => ['name' => 'Demo']], 200)]);
        self::assertTrue((new ChargifyGetCurrentUser($service))->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://demo.chargify.com/site.json');
    }

    public function test_validation_api_errors_test_connection_and_multi_account(): void
    {
        $service = new ChargifyService(apiKey: 'api-key', subdomain: 'demo');

        $missingSubscription = (new ChargifyGetSubscription($service))->execute([]);
        self::assertFalse($missingSubscription->succeeded());
        self::assertStringContainsString('subscription_id is required', (string) $missingSubscription->error);

        $missingCustomer = (new ChargifyGetCustomer($service))->execute([]);
        self::assertFalse($missingCustomer->succeeded());
        self::assertStringContainsString('customer_id is required', (string) $missingCustomer->error);

        $missingInvoice = (new ChargifyGetInvoice($service))->execute([]);
        self::assertFalse($missingInvoice->succeeded());
        self::assertStringContainsString('invoice_id is required', (string) $missingInvoice->error);

        $unconfigured = (new ChargifyListSubscriptions(new ChargifyService))->execute([]);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);

        Http::fake(['*' => Http::response(['errors' => ['Not authorized']], 401)]);
        $apiError = (new ChargifyListSubscriptions($service))->execute([]);
        self::assertFalse($apiError->succeeded());
        self::assertStringContainsString('Not authorized', (string) $apiError->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['site' => ['name' => 'Demo Site']], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Chargify site Demo Site.'], (new ChargifyToolProvider)->testConnection([
            'api_key' => 'api-key',
            'subdomain' => 'demo',
        ]));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://demo.chargify.com/site.json'
            && $request->hasHeader('Authorization', 'Basic ' . base64_encode('api-key:x')));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['errors' => ['Invalid API key']], 401)]);
        self::assertSame(['success' => false, 'error' => 'Invalid API key.'], (new ChargifyToolProvider)->testConnection([
            'api_key' => 'bad-key',
            'subdomain' => 'demo',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['site' => ['name' => 'Account Site']], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['chargify', 'api_key', 'billing'] => 'account-key',
                    ['chargify', 'api_password', 'billing'] => 'account-secret',
                    ['chargify', 'subdomain', 'billing'] => 'account-site',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'chargify' && $account === 'billing';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'chargify' ? ['billing'] : [];
            }
        });

        $tool = (new ChargifyToolProvider)->createTool(ChargifyGetCurrentUser::class, ['account' => 'billing']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://account-site.chargify.com/site.json'
            && $request->hasHeader('Authorization', 'Basic ' . base64_encode('account-key:account-secret')));
    }

    /**
     * Assert a request uses the expected URL, Basic Auth, and query parameters.
     *
     * @param  Request  $request  Captured Laravel HTTP request.
     * @param  string  $baseUrl   Expected URL without the query string.
     * @param  array<string, string>  $query  Expected query parameters.
     */
    private function matchesRequest(Request $request, string $baseUrl, array $query): bool
    {
        if (!$request->hasHeader('Authorization', 'Basic ' . base64_encode('api-key:x'))) {
            return false;
        }

        $parts = parse_url($request->url());
        $actualBase = ($parts['scheme'] ?? '') . '://' . ($parts['host'] ?? '') . ($parts['path'] ?? '');
        parse_str($parts['query'] ?? '', $actualQuery);

        return $actualBase === $baseUrl && $actualQuery === $query;
    }
}
