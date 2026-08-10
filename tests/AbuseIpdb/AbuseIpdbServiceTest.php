<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\AbuseIpdb;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\AbuseIpdb\AbuseIpdbService;
use OpenCompany\Integrations\AbuseIpdb\AbuseIpdbToolProvider;
use OpenCompany\Integrations\AbuseIpdb\Tools\AbuseIpdbBlacklist;
use OpenCompany\Integrations\AbuseIpdb\Tools\AbuseIpdbBulkReport;
use OpenCompany\Integrations\AbuseIpdb\Tools\AbuseIpdbCheck;
use OpenCompany\Integrations\AbuseIpdb\Tools\AbuseIpdbCheckBlock;
use OpenCompany\Integrations\AbuseIpdb\Tools\AbuseIpdbClearAddress;
use OpenCompany\Integrations\AbuseIpdb\Tools\AbuseIpdbReport;
use OpenCompany\Integrations\AbuseIpdb\Tools\AbuseIpdbReports;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the AbuseIPDB integration.
 */
final class AbuseIpdbServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(AbuseIpdbService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(AbuseIpdbService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new AbuseIpdbToolProvider;

        self::assertSame('abuseipdb', $provider->appName());
        self::assertSame('AbuseIPDB', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertTrue($provider->credentialFields()[0]['required']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertSame([
            'abuseipdb_check',
            'abuseipdb_reports',
            'abuseipdb_blacklist',
            'abuseipdb_report',
            'abuseipdb_check_block',
            'abuseipdb_bulk_report',
            'abuseipdb_clear_address',
        ], array_keys($provider->tools()));
    }

    public function test_check_reports_blacklist_and_block_paths_are_mapped(): void
    {
        $service = new AbuseIpdbService(apiKey: 'test-key', baseUrl: 'https://abuse.example.test/api/v2');

        Http::fake(['*' => Http::response(['data' => ['ipAddress' => '198.51.100.10', 'abuseConfidenceScore' => 10]], 200)]);
        self::assertTrue((new AbuseIpdbCheck($service))->execute(['ip_address' => '198.51.100.10', 'max_age_in_days' => 30, 'verbose' => true])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://abuse.example.test/api/v2/check?ipAddress=198.51.100.10&maxAgeInDays=30&verbose=1'
            && $request->hasHeader('Key', 'test-key'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => ['results' => [['reportedAt' => '2026-01-01T00:00:00+00:00']]]], 200)]);
        self::assertTrue((new AbuseIpdbReports($service))->execute(['ip_address' => '198.51.100.10', 'page' => 2, 'per_page' => 50])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://abuse.example.test/api/v2/reports?ipAddress=198.51.100.10&page=2&perPage=50');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response("198.51.100.10\n203.0.113.20\n", 200)]);
        $plain = (new AbuseIpdbBlacklist($service))->execute(['plaintext' => true, 'confidence_minimum' => 90, 'ip_version' => 4]);
        self::assertTrue($plain->succeeded());
        self::assertSame(['198.51.100.10', '203.0.113.20'], $plain->data['data']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://abuse.example.test/api/v2/blacklist?confidenceMinimum=90&ipVersion=4&plaintext=1'
            && $request->hasHeader('Accept', 'text/plain'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => ['networkAddress' => '198.51.100.0', 'numPossibleHosts' => 256]], 200)]);
        self::assertTrue((new AbuseIpdbCheckBlock($service))->execute(['network' => '198.51.100.0/24', 'max_age_in_days' => 7])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://abuse.example.test/api/v2/check-block?network=198.51.100.0%2F24&maxAgeInDays=7');
    }

    public function test_report_bulk_report_and_clear_address_are_mapped(): void
    {
        $service = new AbuseIpdbService(apiKey: 'test-key', baseUrl: 'https://abuse.example.test/api/v2');

        Http::fake(['*' => Http::response(['data' => ['ipAddress' => '198.51.100.10']], 200)]);
        self::assertTrue((new AbuseIpdbReport($service))->execute(['ip_address' => '198.51.100.10', 'categories' => [18, 22], 'comment' => 'fake test traffic'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://abuse.example.test/api/v2/report'
            && $request->data()['ip'] === '198.51.100.10'
            && $request->data()['categories'] === '18,22'
            && $request->data()['comment'] === 'fake test traffic');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => ['savedReports' => 1]], 200)]);
        self::assertTrue((new AbuseIpdbBulkReport($service))->execute(['csv' => "IP,Categories,ReportDate,Comment\n198.51.100.10,18,2026-01-01T00:00:00+00:00,fake\n"])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://abuse.example.test/api/v2/bulk-report');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => ['numReportsDeleted' => 2]], 200)]);
        self::assertTrue((new AbuseIpdbClearAddress($service))->execute(['ip_address' => '198.51.100.10'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://abuse.example.test/api/v2/clear-address?ipAddress=198.51.100.10');
    }

    public function test_validation_api_errors_and_test_connection_are_reported(): void
    {
        $unconfigured = new AbuseIpdbService(apiKey: '', baseUrl: 'https://abuse.example.test/api/v2');
        $missingKey = (new AbuseIpdbCheck($unconfigured))->execute(['ip_address' => '198.51.100.10']);
        self::assertFalse($missingKey->succeeded());
        self::assertStringContainsString('API key is required', (string) $missingKey->error);

        $service = new AbuseIpdbService(apiKey: 'test-key', baseUrl: 'https://abuse.example.test/api/v2');
        $missingCategories = (new AbuseIpdbReport($service))->execute(['ip_address' => '198.51.100.10', 'categories' => []]);
        self::assertFalse($missingCategories->succeeded());
        self::assertStringContainsString('categories is required', (string) $missingCategories->error);

        Http::fake(['*' => Http::response(['errors' => [['detail' => 'The ip address is invalid.']]], 422)]);
        $apiError = (new AbuseIpdbCheck($service))->execute(['ip_address' => 'bad']);
        self::assertFalse($apiError->succeeded());
        self::assertStringContainsString('The ip address is invalid', (string) $apiError->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => ['ipAddress' => '127.0.0.2']], 200)]);
        self::assertSame(['success' => true, 'message' => 'AbuseIPDB API key accepted.'], (new AbuseIpdbToolProvider)->testConnection(['api_key' => 'test-key']));
    }

    public function test_provider_resolves_multi_account_credentials(): void
    {
        Http::fake(['*' => Http::response(['data' => ['ipAddress' => '198.51.100.10']], 200)]);

        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return $integration === 'abuseipdb' && $key === 'api_key' && $account === 'soc' ? 'account-key' : $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'abuseipdb' && $account === 'soc';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'abuseipdb' ? ['soc'] : [];
            }
        });

        $tool = (new AbuseIpdbToolProvider)->createTool(AbuseIpdbCheck::class, ['account' => 'soc']);
        self::assertTrue($tool->execute(['ip_address' => '198.51.100.10'])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Key', 'account-key'));
    }
}
