<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\UsCensus;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\UsCensus\Tools\UsCensusDataQuery;
use OpenCompany\Integrations\UsCensus\Tools\UsCensusDataQueryUrl;
use OpenCompany\Integrations\UsCensus\Tools\UsCensusDatasetMetadata;
use OpenCompany\Integrations\UsCensus\Tools\UsCensusGeographies;
use OpenCompany\Integrations\UsCensus\Tools\UsCensusListDatasets;
use OpenCompany\Integrations\UsCensus\Tools\UsCensusVariables;
use OpenCompany\Integrations\UsCensus\UsCensusService;
use OpenCompany\Integrations\UsCensus\UsCensusToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the US Census integration.
 */
final class UsCensusServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(UsCensusService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(UsCensusService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new UsCensusToolProvider;

        self::assertSame('us-census', $provider->appName());
        self::assertSame('US Census', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFalse($provider->credentialFields()[0]['required']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertCount(8, $provider->tools());
        self::assertContains('us_census_data_query', array_keys($provider->tools()));
    }

    public function test_dataset_discovery_metadata_variables_and_geographies_are_mapped(): void
    {
        $service = new UsCensusService(apiKey: 'test-key', baseUrl: 'https://census.example.test');

        Http::fake(['*' => Http::response(['dataset' => [
            ['c_vintage' => 2023, 'title' => 'ACS 5-Year', 'c_dataset' => ['acs', 'acs5']],
            ['c_vintage' => 2020, 'title' => 'Decennial PL', 'c_dataset' => ['dec', 'pl']],
        ]], 200)]);
        $result = (new UsCensusListDatasets($service))->execute(['q' => 'acs', 'vintage' => '2023']);
        self::assertTrue($result->succeeded());
        self::assertSame(1, $result->data['count']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://census.example.test/data.json?key=test-key');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['title' => 'ACS'], 200)]);
        self::assertTrue((new UsCensusDatasetMetadata($service))->execute(['dataset' => '2023/acs/acs5'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://census.example.test/data/2023/acs/acs5.json?key=test-key');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['variables' => [
            'NAME' => ['label' => 'Geographic Area Name'],
            'B19013_001E' => ['label' => 'Median household income', 'predicateOnly' => false],
            'for' => ['label' => 'Census API Geography Specification', 'predicateOnly' => true],
        ]], 200)]);
        $variables = (new UsCensusVariables($service))->execute(['dataset' => '2023/acs/acs5', 'q' => 'income']);
        self::assertTrue($variables->succeeded());
        self::assertArrayHasKey('B19013_001E', $variables->data['variables']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://census.example.test/data/2023/acs/acs5/variables.json?key=test-key');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['fips' => [['name' => 'state'], ['name' => 'county']]], 200)]);
        $geos = (new UsCensusGeographies($service))->execute(['dataset' => '2023/acs/acs5', 'q' => 'county']);
        self::assertTrue($geos->succeeded());
        self::assertSame(1, $geos->data['count']);
    }

    public function test_data_query_normalizes_rows_and_url_builder_uses_predicates(): void
    {
        $service = new UsCensusService(apiKey: 'test-key', baseUrl: 'https://census.example.test');

        Http::fake(['*' => Http::response([
            ['NAME', 'B19013_001E', 'state'],
            ['California', '95521', '06'],
            ['New York', '82421', '36'],
        ], 200)]);
        $result = (new UsCensusDataQuery($service))->execute([
            'dataset' => '2023/acs/acs5',
            'get' => 'NAME,B19013_001E',
            'for' => 'state:*',
            'predicates' => ['time' => '2023'],
        ]);

        self::assertTrue($result->succeeded());
        self::assertSame(2, $result->data['row_count']);
        self::assertSame('California', $result->data['records'][0]['NAME']);
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://census.example.test/data/2023/acs/acs5?')
            && str_contains($request->url(), 'get=NAME%2CB19013_001E')
            && str_contains($request->url(), 'for=state%3A%2A')
            && str_contains($request->url(), 'time=2023')
            && str_contains($request->url(), 'key=test-key'));

        $url = (new UsCensusDataQueryUrl($service))->execute([
            'dataset' => '2023/acs/acs5',
            'get' => 'NAME,B01001_001E',
            'for' => 'county:*',
            'in' => 'state:06',
            'include_key' => true,
        ]);
        self::assertTrue($url->succeeded());
        self::assertStringContainsString('get=NAME%2CB01001_001E', $url->data['url']);
        self::assertStringContainsString('in=state%3A06', $url->data['url']);
        self::assertStringContainsString('key=test-key', $url->data['url']);
    }

    public function test_validation_api_errors_test_connection_and_multi_account(): void
    {
        $service = new UsCensusService(baseUrl: 'https://census.example.test');

        $badDataset = (new UsCensusDatasetMetadata($service))->execute(['dataset' => '../secret']);
        self::assertFalse($badDataset->succeeded());
        self::assertStringContainsString('dataset must be a Census API path', (string) $badDataset->error);

        $missingGeo = (new UsCensusDataQuery($service))->execute(['dataset' => '2023/acs/acs5', 'get' => 'NAME']);
        self::assertFalse($missingGeo->succeeded());
        self::assertStringContainsString('for or ucgid is required', (string) $missingGeo->error);

        Http::fake(['*' => Http::response('Invalid Key', 400)]);
        $apiError = (new UsCensusListDatasets($service))->execute([]);
        self::assertFalse($apiError->succeeded());
        self::assertStringContainsString('Invalid Key', (string) $apiError->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['dataset' => []], 200)]);
        self::assertSame(['success' => true, 'message' => 'US Census API reachable.'], (new UsCensusToolProvider)->testConnection([]));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['dataset' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return $integration === 'us-census' && $key === 'api_key' && $account === 'research' ? 'account-key' : $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'us-census' && $account === 'research';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'us-census' ? ['research'] : [];
            }
        });

        $tool = (new UsCensusToolProvider)->createTool(UsCensusListDatasets::class, ['account' => 'research']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'key=account-key'));
    }
}
