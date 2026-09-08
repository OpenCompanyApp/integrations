<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\ChargeOver;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\ChargeOver\ChargeOverService;
use OpenCompany\Integrations\ChargeOver\ChargeOverToolProvider;
use OpenCompany\Integrations\ChargeOver\Tools\ChargeOverGetCurrentUser;
use OpenCompany\Integrations\ChargeOver\Tools\ChargeOverGetCustomer;
use OpenCompany\Integrations\ChargeOver\Tools\ChargeOverGetInvoice;
use OpenCompany\Integrations\ChargeOver\Tools\ChargeOverGetTransaction;
use OpenCompany\Integrations\ChargeOver\Tools\ChargeOverListCustomers;
use OpenCompany\Integrations\ChargeOver\Tools\ChargeOverListInvoices;
use OpenCompany\Integrations\ChargeOver\Tools\ChargeOverListSubscriptions;
use OpenCompany\Integrations\ChargeOver\Tools\ChargeOverListTransactions;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the ChargeOver REST API v3 integration.
 */
final class ChargeOverServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(ChargeOverService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(ChargeOverService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new ChargeOverToolProvider;

        self::assertSame('chargeover', $provider->appName());
        self::assertSame('ChargeOver', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('https://developer.chargeover.com/', $provider->integrationMeta()['docs_url']);
        self::assertSame('basic_auth', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertSame(['api_username', 'api_password'], $provider->integrationCapabilities()['auth']['token_keys']);
        self::assertSame('API Username', $provider->credentialFields()[0]['label']);
        self::assertSame('API Password', $provider->credentialFields()[1]['label']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertCount(8, $provider->tools());
        self::assertArrayHasKey('chargeover_list_subscriptions', $provider->tools());
        self::assertArrayHasKey('chargeover_get_transaction', $provider->tools());
    }

    public function test_customer_package_invoice_transaction_and_health_routes_are_mapped(): void
    {
        $service = new ChargeOverService(apiUsername: 'api-user', apiPassword: 'api-secret', baseUrl: 'https://billing.example.test/api/v3');

        Http::fake(['*' => Http::response(['response' => [['customer_id' => 123]]], 200)]);
        self::assertTrue((new ChargeOverListCustomers($service))->execute([
            'limit' => 25,
            'offset' => 10,
            'where' => 'company:CONTAINS:acme',
            'order' => 'customer_id:DESC',
        ])->succeeded());
        Http::assertSent(fn (Request $request): bool => $this->matchesRequest($request, 'https://billing.example.test/api/v3/customer', [
            'limit' => '25',
            'offset' => '10',
            'where' => 'company:CONTAINS:acme',
            'order' => 'customer_id:DESC',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['response' => ['customer_id' => 123]], 200)]);
        self::assertTrue((new ChargeOverGetCustomer($service))->execute(['id' => 123])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://billing.example.test/api/v3/customer/123');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['response' => [['package_id' => 456]]], 200)]);
        self::assertTrue((new ChargeOverListSubscriptions($service))->execute([
            'limit' => 5,
            'offset' => 15,
            'customer_id' => 123,
            'where' => 'package_status_state:EQUALS:a',
            'expand' => 'line_items',
        ])->succeeded());
        Http::assertSent(fn (Request $request): bool => $this->matchesRequest($request, 'https://billing.example.test/api/v3/package', [
            'limit' => '5',
            'offset' => '15',
            'where' => 'package_status_state:EQUALS:a,customer_id:EQUALS:123',
            'expand' => 'line_items',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['response' => [['invoice_id' => 789]]], 200)]);
        self::assertTrue((new ChargeOverListInvoices($service))->execute([
            'limit' => 10,
            'offset' => 20,
            'where' => 'date:GTE:2026-01-01',
            'order' => 'total:ASC',
        ])->succeeded());
        Http::assertSent(fn (Request $request): bool => $this->matchesRequest($request, 'https://billing.example.test/api/v3/invoice', [
            'limit' => '10',
            'offset' => '20',
            'where' => 'date:GTE:2026-01-01',
            'order' => 'total:ASC',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['response' => ['invoice_id' => 789]], 200)]);
        self::assertTrue((new ChargeOverGetInvoice($service))->execute(['id' => 789])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://billing.example.test/api/v3/invoice/789');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['response' => [['transaction_id' => 321]]], 200)]);
        self::assertTrue((new ChargeOverListTransactions($service))->execute([
            'limit' => 10,
            'offset' => 0,
            'where' => 'applied_to.invoice_id:EQUALS:789',
            'expand' => 'applied_to',
        ])->succeeded());
        Http::assertSent(fn (Request $request): bool => $this->matchesRequest($request, 'https://billing.example.test/api/v3/transaction', [
            'limit' => '10',
            'offset' => '0',
            'where' => 'applied_to.invoice_id:EQUALS:789',
            'expand' => 'applied_to',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['response' => ['transaction_id' => 321]], 200)]);
        self::assertTrue((new ChargeOverGetTransaction($service))->execute(['id' => 321])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://billing.example.test/api/v3/transaction/321');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['response' => []], 200)]);
        self::assertTrue((new ChargeOverGetCurrentUser($service))->execute([])->succeeded());
        Http::assertSent(fn (Request $request): bool => $this->matchesRequest($request, 'https://billing.example.test/api/v3/customer', [
            'limit' => '1',
            'offset' => '0',
        ]));
    }

    public function test_validation_api_errors_test_connection_and_multi_account(): void
    {
        $service = new ChargeOverService(apiUsername: 'api-user', apiPassword: 'api-secret', subdomain: 'billing');

        $missingCustomer = (new ChargeOverGetCustomer($service))->execute([]);
        self::assertFalse($missingCustomer->succeeded());
        self::assertStringContainsString('Customer ID is required', (string) $missingCustomer->error);

        $missingInvoice = (new ChargeOverGetInvoice($service))->execute([]);
        self::assertFalse($missingInvoice->succeeded());
        self::assertStringContainsString('Invoice ID is required', (string) $missingInvoice->error);

        $missingTransaction = (new ChargeOverGetTransaction($service))->execute([]);
        self::assertFalse($missingTransaction->succeeded());
        self::assertStringContainsString('Transaction ID is required', (string) $missingTransaction->error);

        $unconfigured = (new ChargeOverListCustomers(new ChargeOverService))->execute([]);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);

        Http::fake(['*' => Http::response(['message' => 'Authentication error'], 401)]);
        $apiError = (new ChargeOverListCustomers($service))->execute([]);
        self::assertFalse($apiError->succeeded());
        self::assertStringContainsString('Authentication error', (string) $apiError->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['response' => []], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to ChargeOver API at https://demo.chargeover.com.'], (new ChargeOverToolProvider)->testConnection([
            'api_username' => 'api-user',
            'api_password' => 'api-secret',
            'subdomain' => 'demo',
        ]));
        Http::assertSent(fn (Request $request): bool => $this->matchesRequest($request, 'https://demo.chargeover.com/api/v3/customer', [
            'limit' => '1',
            'offset' => '0',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['message' => 'Bad credentials'], 401)]);
        self::assertSame(['success' => false, 'error' => 'ChargeOver API returned HTTP 401: Bad credentials'], (new ChargeOverToolProvider)->testConnection([
            'api_username' => 'api-user',
            'api_password' => 'wrong',
            'subdomain' => 'demo',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['response' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['chargeover', 'api_username', 'billing'] => 'account-user',
                    ['chargeover', 'api_password', 'billing'] => 'account-secret',
                    ['chargeover', 'subdomain', 'billing'] => 'account-site',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'chargeover' && $account === 'billing';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'chargeover' ? ['billing'] : [];
            }
        });

        $tool = (new ChargeOverToolProvider)->createTool(ChargeOverGetCurrentUser::class, ['account' => 'billing']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://account-site.chargeover.com/api/v3/customer?')
            && $request->hasHeader('Authorization', 'Basic ' . base64_encode('account-user:account-secret')));
    }

    /**
     * Assert a request uses the expected endpoint, Basic Auth, and query parameters.
     *
     * @param  Request  $request  Captured Laravel HTTP request.
     * @param  string  $baseUrl   Expected URL without the query string.
     * @param  array<string, string>  $query  Expected query parameters.
     */
    private function matchesRequest(Request $request, string $baseUrl, array $query): bool
    {
        if (!$request->hasHeader('Authorization', 'Basic ' . base64_encode('api-user:api-secret'))) {
            return false;
        }

        $parts = parse_url($request->url());
        $actualBase = ($parts['scheme'] ?? '') . '://' . ($parts['host'] ?? '') . ($parts['path'] ?? '');
        parse_str($parts['query'] ?? '', $actualQuery);

        return $actualBase === $baseUrl && $actualQuery === $query;
    }
}
