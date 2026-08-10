<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\ChartMogul;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\ChartMogul\ChartMogulService;
use OpenCompany\Integrations\ChartMogul\ChartMogulToolProvider;
use OpenCompany\Integrations\ChartMogul\Tools\ChartMogulGetCurrentUser;
use OpenCompany\Integrations\ChartMogul\Tools\ChartMogulGetCustomer;
use OpenCompany\Integrations\ChartMogul\Tools\ChartMogulGetMetrics;
use OpenCompany\Integrations\ChartMogul\Tools\ChartMogulListCustomers;
use OpenCompany\Integrations\ChartMogul\Tools\ChartMogulListInvoices;
use OpenCompany\Integrations\ChartMogul\Tools\ChartMogulListPlans;
use OpenCompany\Integrations\ChartMogul\Tools\ChartMogulListSubscriptions;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the ChartMogul integration.
 */
final class ChartMogulServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(ChartMogulService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(ChartMogulService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new ChartMogulToolProvider;

        self::assertSame('chartmogul', $provider->appName());
        self::assertSame('ChartMogul', $provider->integrationMeta()['name']);
        self::assertSame('analytics', $provider->integrationMeta()['category']);
        self::assertSame('https://dev.chartmogul.com/docs/', $provider->integrationMeta()['docs_url']);
        self::assertSame('basic_auth_api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertContains('api_key', $provider->integrationCapabilities()['auth']['token_keys']);
        self::assertSame('API Key', $provider->credentialFields()[0]['label']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertCount(7, $provider->tools());
    }

    public function test_routes_are_mapped_to_current_api_and_use_basic_auth(): void
    {
        $service = new ChartMogulService(apiKey: 'cm-key');

        Http::fake(['*' => Http::response(['entries' => [['uuid' => 'cus_123']], 'has_more' => false], 200)]);
        self::assertTrue((new ChartMogulListCustomers($service))->execute([
            'per_page' => 25,
            'cursor' => 'next-cursor',
            'status' => 'Active',
            'email' => 'person@example.test',
            'data_source_uuid' => 'ds_123',
            'external_id' => 'ext_123',
            'system' => 'Stripe',
        ])->succeeded());
        Http::assertSent(fn (Request $request): bool => $this->matchesRequest($request, 'https://api.chartmogul.com/v1/customers', [
            'per_page' => '25',
            'cursor' => 'next-cursor',
            'status' => 'Active',
            'email' => 'person@example.test',
            'data_source_uuid' => 'ds_123',
            'external_id' => 'ext_123',
            'system' => 'Stripe',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['uuid' => 'cus_123'], 200)]);
        self::assertTrue((new ChartMogulGetCustomer($service))->execute(['id' => 'cus_123'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.chartmogul.com/v1/customers/cus_123'
            && $request->hasHeader('Authorization', 'Basic ' . base64_encode('cm-key:')));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['entries' => [['uuid' => 'sub_123']]], 200)]);
        self::assertTrue((new ChartMogulListSubscriptions($service))->execute([
            'customer_uuid' => 'cus_123',
            'per_page' => 50,
            'cursor' => 'sub-cursor',
        ])->succeeded());
        Http::assertSent(fn (Request $request): bool => $this->matchesRequest($request, 'https://api.chartmogul.com/v1/customers/cus_123/subscriptions', [
            'per_page' => '50',
            'cursor' => 'sub-cursor',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['plans' => [['uuid' => 'pl_123']]], 200)]);
        self::assertTrue((new ChartMogulListPlans($service))->execute([
            'per_page' => 10,
            'cursor' => 'plan-cursor',
            'data_source_uuid' => 'ds_123',
        ])->succeeded());
        Http::assertSent(fn (Request $request): bool => $this->matchesRequest($request, 'https://api.chartmogul.com/v1/plans', [
            'per_page' => '10',
            'cursor' => 'plan-cursor',
            'data_source_uuid' => 'ds_123',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['invoices' => [['uuid' => 'inv_123']]], 200)]);
        self::assertTrue((new ChartMogulListInvoices($service))->execute([
            'per_page' => 10,
            'cursor' => 'invoice-cursor',
            'customer_uuid' => 'cus_123',
            'external_id' => 'inv_001',
        ])->succeeded());
        Http::assertSent(fn (Request $request): bool => $this->matchesRequest($request, 'https://api.chartmogul.com/v1/invoices', [
            'per_page' => '10',
            'cursor' => 'invoice-cursor',
            'customer_uuid' => 'cus_123',
            'external_id' => 'inv_001',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['entries' => [['mrr' => 12345]]], 200)]);
        self::assertTrue((new ChartMogulGetMetrics($service))->execute([
            'start_date' => '2026-01-01',
            'end_date' => '2026-03-31',
            'interval' => 'month',
            'geo' => 'US,GB',
            'plans' => 'Gold Monthly',
            'filters' => "currency~ANY~'USD'",
        ])->succeeded());
        Http::assertSent(fn (Request $request): bool => $this->matchesRequest($request, 'https://api.chartmogul.com/v1/metrics/all', [
            'start-date' => '2026-01-01',
            'end-date' => '2026-03-31',
            'interval' => 'month',
            'geo' => 'US,GB',
            'plans' => 'Gold Monthly',
            'filters' => "currency~ANY~'USD'",
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => 'pong!'], 200)]);
        self::assertTrue((new ChartMogulGetCurrentUser($service))->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.chartmogul.com/v1/ping');
    }

    public function test_validation_api_errors_test_connection_and_multi_account(): void
    {
        $service = new ChartMogulService(apiKey: 'cm-key');

        $missingCustomer = (new ChartMogulGetCustomer($service))->execute([]);
        self::assertFalse($missingCustomer->succeeded());
        self::assertStringContainsString('Customer UUID is required', (string) $missingCustomer->error);

        $missingSubscriptionsCustomer = (new ChartMogulListSubscriptions($service))->execute([]);
        self::assertFalse($missingSubscriptionsCustomer->succeeded());
        self::assertStringContainsString('customer_uuid is required', (string) $missingSubscriptionsCustomer->error);

        $missingMetricsDates = (new ChartMogulGetMetrics($service))->execute([]);
        self::assertFalse($missingMetricsDates->succeeded());
        self::assertStringContainsString('start_date and end_date are required', (string) $missingMetricsDates->error);

        $unconfigured = (new ChartMogulListCustomers(new ChartMogulService))->execute([]);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);

        Http::fake(['*' => Http::response(['error' => 'Unauthorized'], 401)]);
        $apiError = (new ChartMogulListCustomers($service))->execute([]);
        self::assertFalse($apiError->succeeded());
        self::assertStringContainsString('Unauthorized', (string) $apiError->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => 'pong!'], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to ChartMogul API.'], (new ChartMogulToolProvider)->testConnection([
            'api_key' => 'cm-key',
        ]));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.chartmogul.com/v1/ping'
            && $request->hasHeader('Authorization', 'Basic ' . base64_encode('cm-key:')));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['error' => 'Invalid API key'], 401)]);
        self::assertSame(['success' => false, 'error' => 'ChartMogul API error: Invalid API key'], (new ChartMogulToolProvider)->testConnection([
            'api_key' => 'bad-key',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => 'pong!'], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['chartmogul', 'api_key', 'analytics'] => 'account-key',
                    ['chartmogul', 'url', 'analytics'] => 'https://chartmogul.example.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'chartmogul' && $account === 'analytics';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'chartmogul' ? ['analytics'] : [];
            }
        });

        $tool = (new ChartMogulToolProvider)->createTool(ChartMogulGetCurrentUser::class, ['account' => 'analytics']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://chartmogul.example.test/v1/ping'
            && $request->hasHeader('Authorization', 'Basic ' . base64_encode('account-key:')));
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
        if (!$request->hasHeader('Authorization', 'Basic ' . base64_encode('cm-key:'))) {
            return false;
        }

        $parts = parse_url($request->url());
        $actualBase = ($parts['scheme'] ?? '') . '://' . ($parts['host'] ?? '') . ($parts['path'] ?? '');
        parse_str($parts['query'] ?? '', $actualQuery);

        return $actualBase === $baseUrl && $actualQuery === $query;
    }
}
