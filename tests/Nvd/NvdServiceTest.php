<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Nvd;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Nvd\NvdService;
use OpenCompany\Integrations\Nvd\NvdToolProvider;
use OpenCompany\Integrations\Nvd\Tools\NvdCpeByNameId;
use OpenCompany\Integrations\Nvd\Tools\NvdCpeMatch;
use OpenCompany\Integrations\Nvd\Tools\NvdCpeMatchByCriteriaId;
use OpenCompany\Integrations\Nvd\Tools\NvdCpes;
use OpenCompany\Integrations\Nvd\Tools\NvdCveById;
use OpenCompany\Integrations\Nvd\Tools\NvdCveHistory;
use OpenCompany\Integrations\Nvd\Tools\NvdCves;
use OpenCompany\Integrations\Nvd\Tools\NvdSourceByIdentifier;
use OpenCompany\Integrations\Nvd\Tools\NvdSources;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the NVD 2.0 API integration.
 */
final class NvdServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(NvdService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(NvdService::class);
        Container::getInstance()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new NvdToolProvider;

        self::assertSame('nvd', $provider->appName());
        self::assertSame('NVD', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFalse($provider->credentialFields()[0]['required']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertSame([
            'nvd_cves',
            'nvd_cve_by_id',
            'nvd_cve_history',
            'nvd_cpes',
            'nvd_cpe_by_name_id',
            'nvd_cpe_match',
            'nvd_cpe_match_by_criteria_id',
            'nvd_sources',
            'nvd_source_by_identifier',
        ], array_keys($provider->tools()));
    }

    public function test_cve_search_and_lookup_map_query_parameters_flags_and_api_key(): void
    {
        $service = new NvdService(apiKey: 'key-test', baseUrl: 'https://nvd.example.test/rest/json');

        Http::fake(['*' => Http::response([
            'resultsPerPage' => 1,
            'startIndex' => 0,
            'totalResults' => 1,
            'vulnerabilities' => [['cve' => ['id' => 'CVE-2024-12345']]],
        ], 200)]);

        $result = (new NvdCves($service))->execute([
            'keyword_search' => 'openssl',
            'keyword_exact_match' => true,
            'has_kev' => true,
            'no_rejected' => false,
            'cvss_v3_severity' => 'HIGH',
            'results_per_page' => 1,
            'start_index' => 0,
        ]);

        self::assertTrue($result->succeeded());
        self::assertSame('CVE-2024-12345', $result->data['vulnerabilities'][0]['cve']['id']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://nvd.example.test/rest/json/cves/2.0?')
            && str_contains($request->url(), 'keywordSearch=openssl')
            && str_contains($request->url(), 'cvssV3Severity=HIGH')
            && str_contains($request->url(), 'resultsPerPage=1')
            && str_contains($request->url(), 'startIndex=0')
            && str_contains($request->url(), 'keywordExactMatch')
            && str_contains($request->url(), 'hasKev')
            && !str_contains($request->url(), 'noRejected')
            && $request->hasHeader('apiKey', 'key-test'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['vulnerabilities' => [['cve' => ['id' => 'CVE-2024-99999']]]], 200)]);
        $lookup = (new NvdCveById($service))->execute(['cve_id' => 'cve-2024-99999']);

        self::assertTrue($lookup->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'cveId=CVE-2024-99999'));
    }

    public function test_cve_history_cpe_cpe_match_and_sources_paths_are_mapped(): void
    {
        $service = new NvdService(baseUrl: 'https://nvd.example.test/rest/json');

        Http::fake(['*' => Http::response(['cveChanges' => [['change' => ['cveId' => 'CVE-2024-12345']]]], 200)]);
        self::assertTrue((new NvdCveHistory($service))->execute([
            'cve_id' => 'CVE-2024-12345',
            'change_start_date' => '2024-01-01T00:00:00.000',
            'change_end_date' => '2024-01-02T00:00:00.000',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://nvd.example.test/rest/json/cvehistory/2.0?')
            && str_contains($request->url(), 'cveId=CVE-2024-12345')
            && !$request->hasHeader('apiKey'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['products' => [['cpe' => ['cpeNameId' => 'cpe-uuid']]]], 200)]);
        self::assertTrue((new NvdCpes($service))->execute(['keyword_search' => 'nginx', 'keyword_exact_match' => true])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://nvd.example.test/rest/json/cpes/2.0?')
            && str_contains($request->url(), 'keywordSearch=nginx')
            && str_contains($request->url(), 'keywordExactMatch'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['products' => [['cpe' => ['cpeNameId' => 'cpe-uuid']]]], 200)]);
        self::assertTrue((new NvdCpeByNameId($service))->execute(['cpe_name_id' => 'cpe-uuid'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), '/cpes/2.0?cpeNameId=cpe-uuid'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['matchStrings' => [['matchString' => ['matchCriteriaId' => 'criteria-uuid']]]], 200)]);
        self::assertTrue((new NvdCpeMatch($service))->execute(['match_string_search' => 'cpe:2.3:a:vendor:product'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://nvd.example.test/rest/json/cpematch/2.0?')
            && str_contains($request->url(), 'matchStringSearch=cpe%3A2.3%3Aa%3Avendor%3Aproduct'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['matchStrings' => [['matchString' => ['matchCriteriaId' => 'criteria-uuid']]]], 200)]);
        self::assertTrue((new NvdCpeMatchByCriteriaId($service))->execute(['match_criteria_id' => 'criteria-uuid'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), '/cpematch/2.0?matchCriteriaId=criteria-uuid'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['sources' => [['source' => ['identifier' => 'security@example.test']]]], 200)]);
        self::assertTrue((new NvdSources($service))->execute(['source_identifier' => 'security@example.test'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), '/source/2.0?sourceIdentifier=security%40example.test'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['sources' => [['source' => ['identifier' => 'security@example.test']]]], 200)]);
        self::assertTrue((new NvdSourceByIdentifier($service))->execute(['source_identifier' => 'security@example.test'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), '/source/2.0?sourceIdentifier=security%40example.test'));
    }

    public function test_validation_and_api_errors_are_reported(): void
    {
        $service = new NvdService(baseUrl: 'https://nvd.example.test/rest/json');

        $missing = (new NvdCveById($service))->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('cve_id is required', (string) $missing->error);

        Http::fake(['*' => Http::response(['message' => 'Invalid parameter cveId.'], 400)]);
        $apiError = (new NvdCveById($service))->execute(['cve_id' => 'bad']);
        self::assertFalse($apiError->succeeded());
        self::assertStringContainsString('Invalid parameter', (string) $apiError->error);
    }

    public function test_connection_and_multi_account_credentials(): void
    {
        Http::fake(['*' => Http::response(['vulnerabilities' => []], 200)]);

        $provider = new NvdToolProvider;
        $anonymous = $provider->testConnection([]);
        self::assertTrue($anonymous['success']);
        self::assertStringContainsString('without an API key', (string) $anonymous['message']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://services.nvd.nist.gov/rest/json/cves/2.0?resultsPerPage=1&startIndex=0'
            && !$request->hasHeader('apiKey'));

        $withKey = $provider->testConnection(['api_key' => 'key-test']);
        self::assertTrue($withKey['success']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://services.nvd.nist.gov/rest/json/cves/2.0?resultsPerPage=1&startIndex=0'
            && $request->hasHeader('apiKey', 'key-test'));

        $resolver = new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return [$integration, $key, $account] === ['nvd', 'api_key', 'acct_1'] ? 'key-account' : $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'nvd' && $account === 'acct_1';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'nvd' ? ['acct_1'] : [];
            }
        };

        Container::getInstance()->instance(CredentialResolver::class, $resolver);
        $tool = $provider->createTool(NvdCveById::class, ['account' => 'acct_1']);
        $result = $tool->execute(['cve_id' => 'CVE-2024-12345']);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'cveId=CVE-2024-12345')
            && $request->hasHeader('apiKey', 'key-account'));
    }
}
