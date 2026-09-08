<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\CompaniesHouse;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\CompaniesHouse\CompaniesHouseService;
use OpenCompany\Integrations\CompaniesHouse\CompaniesHouseToolProvider;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHouseAdvancedSearchCompanies;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHouseCompanyProfile;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHouseFilingHistory;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHouseOfficers;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHousePscCorporateEntityBeneficialOwner;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHousePscIndividual;
use OpenCompany\Integrations\CompaniesHouse\Tools\CompaniesHouseSearchCompanies;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Companies House Public Data API integration.
 */
final class CompaniesHouseServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(CompaniesHouseService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(CompaniesHouseService::class);
        Container::getInstance()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new CompaniesHouseToolProvider;

        self::assertSame('companies-house', $provider->appName());
        self::assertSame('Companies House', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertSame($provider->configSchema(), $provider->credentialFields());
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertCount(31, $provider->tools());
        self::assertArrayHasKey('companies_house_company_profile', $provider->tools());
        self::assertArrayHasKey('companies_house_psc_corporate_entity_beneficial_owner', $provider->tools());
        self::assertArrayHasKey('companies_house_disqualified_officer_natural', $provider->tools());
    }

    public function test_search_and_advanced_search_map_queries_and_basic_auth(): void
    {
        Http::fake(['*' => Http::response([
            'items' => [['company_number' => '00000006', 'title' => 'EXAMPLE LTD']],
            'total_results' => 1,
        ], 200)]);

        $service = new CompaniesHouseService(apiKey: 'key-test', baseUrl: 'https://api.example.test');

        $search = (new CompaniesHouseSearchCompanies($service))->execute([
            'q' => 'example',
            'items_per_page' => 5,
            'start_index' => 10,
        ]);
        self::assertTrue($search->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://api.example.test/search/companies?')
            && str_contains($request->url(), 'q=example')
            && str_contains($request->url(), 'items_per_page=5')
            && str_contains($request->url(), 'start_index=10')
            && $request->hasHeader('Authorization', 'Basic '.base64_encode('key-test:'))
            && $request->hasHeader('Accept', 'application/json'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['items' => []], 200)]);
        $advanced = (new CompaniesHouseAdvancedSearchCompanies($service))->execute([
            'company_name_includes' => 'example',
            'company_status' => 'active',
            'sic_codes' => ['62012', '62020'],
            'query' => ['items_per_page' => 99],
            'items_per_page' => 25,
        ]);
        self::assertTrue($advanced->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.example.test/advanced-search/companies?')
            && str_contains($request->url(), 'company_name_includes=example')
            && str_contains($request->url(), 'company_status=active')
            && str_contains($request->url(), 'sic_codes=62012%2C62020')
            && str_contains($request->url(), 'items_per_page=25'));
    }

    public function test_company_records_filings_officers_and_psc_paths_are_mapped(): void
    {
        $service = new CompaniesHouseService(apiKey: 'key-test', baseUrl: 'https://api.example.test');

        Http::fake(['*' => Http::response(['company_number' => '00000006'], 200)]);
        $profile = (new CompaniesHouseCompanyProfile($service))->execute(['company_number' => '00000006']);
        self::assertTrue($profile->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.example.test/company/00000006');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['items' => [['transaction_id' => 'MzAw']]], 200)]);
        $filings = (new CompaniesHouseFilingHistory($service))->execute([
            'company_number' => '00000006',
            'category' => ['accounts', 'confirmation-statement'],
            'items_per_page' => 10,
        ]);
        self::assertTrue($filings->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.example.test/company/00000006/filing-history?')
            && str_contains($request->url(), 'category=accounts%2Cconfirmation-statement')
            && str_contains($request->url(), 'items_per_page=10'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['items' => [['name' => 'JANE EXAMPLE']]], 200)]);
        $officers = (new CompaniesHouseOfficers($service))->execute([
            'company_number' => '00000006',
            'order_by' => 'appointed_on',
        ]);
        self::assertTrue($officers->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.example.test/company/00000006/officers?')
            && str_contains($request->url(), 'order_by=appointed_on'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['name' => 'JANE EXAMPLE'], 200)]);
        $psc = (new CompaniesHousePscIndividual($service))->execute([
            'company_number' => '00000006',
            'psc_id' => 'abc123',
        ]);
        self::assertTrue($psc->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.example.test/company/00000006/persons-with-significant-control/individual/abc123');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['name' => 'EXAMPLE OWNER LTD'], 200)]);
        $beneficialOwner = (new CompaniesHousePscCorporateEntityBeneficialOwner($service))->execute([
            'company_number' => '00000006',
            'psc_id' => 'bo123',
        ]);
        self::assertTrue($beneficialOwner->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.example.test/company/00000006/persons-with-significant-control/corporate-entity-beneficial-owner/bo123');
    }

    public function test_validation_and_api_errors_are_reported(): void
    {
        $service = new CompaniesHouseService(apiKey: 'key-test', baseUrl: 'https://api.example.test');

        $missing = (new CompaniesHouseCompanyProfile($service))->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('company_number is required', (string) $missing->error);

        $badPath = (new CompaniesHouseCompanyProfile($service))->execute(['company_number' => '../bad']);
        self::assertFalse($badPath->succeeded());
        self::assertStringContainsString('without slashes', (string) $badPath->error);

        $unconfigured = (new CompaniesHouseSearchCompanies(new CompaniesHouseService()))->execute(['q' => 'example']);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('API key is not configured', (string) $unconfigured->error);

        Http::fake(['*' => Http::response(['errors' => [['error' => 'company-profile-not-found']]], 404)]);
        $notFound = (new CompaniesHouseCompanyProfile($service))->execute(['company_number' => '00000000']);
        self::assertFalse($notFound->succeeded());
        self::assertStringContainsString('company-profile-not-found', (string) $notFound->error);
    }

    public function test_connection_and_multi_account_credentials(): void
    {
        Http::fake(['*' => Http::response(['items' => []], 200)]);

        $provider = new CompaniesHouseToolProvider;
        $ok = $provider->testConnection(['api_key' => 'key-test']);

        self::assertTrue($ok['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://api.company-information.service.gov.uk/search/companies?')
            && str_contains($request->url(), 'q=opencompany')
            && str_contains($request->url(), 'items_per_page=1')
            && $request->hasHeader('Authorization', 'Basic '.base64_encode('key-test:')));

        $missingKey = $provider->testConnection([]);
        self::assertFalse($missingKey['success']);
        self::assertStringContainsString('No API key', (string) $missingKey['error']);

        $resolver = new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return [$integration, $key, $account] === ['companies-house', 'api_key', 'acct_1'] ? 'key-account' : $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'companies-house' && $account === 'acct_1';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'companies-house' ? ['acct_1'] : [];
            }
        };

        Container::getInstance()->instance(CredentialResolver::class, $resolver);
        $tool = $provider->createTool(CompaniesHouseSearchCompanies::class, ['account' => 'acct_1']);
        $result = $tool->execute(['q' => 'example']);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.company-information.service.gov.uk/search/companies?')
            && $request->hasHeader('Authorization', 'Basic '.base64_encode('key-account:')));
    }
}
