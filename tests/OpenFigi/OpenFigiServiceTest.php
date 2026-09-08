<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\OpenFigi;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\OpenFigi\OpenFigiService;
use OpenCompany\Integrations\OpenFigi\OpenFigiToolProvider;
use OpenCompany\Integrations\OpenFigi\Tools\OpenFigiFilter;
use OpenCompany\Integrations\OpenFigi\Tools\OpenFigiMapping;
use OpenCompany\Integrations\OpenFigi\Tools\OpenFigiMappingValues;
use OpenCompany\Integrations\OpenFigi\Tools\OpenFigiSchema;
use OpenCompany\Integrations\OpenFigi\Tools\OpenFigiSearch;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the complete current OpenFIGI API surface.
 */
final class OpenFigiServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(OpenFigiService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(OpenFigiService::class);
        Container::getInstance()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new OpenFigiToolProvider;

        self::assertSame('openfigi', $provider->appName());
        self::assertSame('OpenFIGI', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFalse($provider->credentialFields()[0]['required']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertSame([
            'openfigi_mapping',
            'openfigi_mapping_values',
            'openfigi_search',
            'openfigi_filter',
            'openfigi_schema',
        ], array_keys($provider->tools()));
    }

    public function test_mapping_and_mapping_values_paths_are_mapped_with_optional_api_key(): void
    {
        Http::fake(['*' => Http::response([
            ['data' => [['figi' => 'BBG000BLNNH6', 'ticker' => 'IBM']]],
        ], 200)]);

        $service = new OpenFigiService(apiKey: 'key-test', baseUrl: 'https://api.example.test');
        $mapping = (new OpenFigiMapping($service))->execute([
            'jobs' => [
                ['idType' => 'TICKER', 'idValue' => 'IBM', 'exchCode' => 'US'],
            ],
        ]);

        self::assertTrue($mapping->succeeded());
        self::assertSame('IBM', $mapping->data[0]['data'][0]['ticker']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/v3/mapping'
            && $request->hasHeader('X-OPENFIGI-APIKEY', 'key-test')
            && $request->data() === [['idType' => 'TICKER', 'idValue' => 'IBM', 'exchCode' => 'US']]);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['values' => ['TICKER', 'ID_ISIN']], 200)]);
        $values = (new OpenFigiMappingValues($service))->execute(['key' => 'idType']);

        self::assertTrue($values->succeeded());
        self::assertSame(['TICKER', 'ID_ISIN'], $values->data['values']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/v3/mapping/values/idType'
            && $request->hasHeader('X-OPENFIGI-APIKEY', 'key-test'));
    }

    public function test_search_filter_and_schema_paths_are_mapped(): void
    {
        $service = new OpenFigiService(baseUrl: 'https://api.example.test');

        Http::fake(['*' => Http::response(['data' => [['figi' => 'BBG000BLNNH6']], 'next' => 'cursor'], 200)]);
        $search = (new OpenFigiSearch($service))->execute([
            'query' => 'IBM',
            'exchCode' => 'US',
            'payload' => ['currency' => 'USD'],
        ]);

        self::assertTrue($search->succeeded());
        self::assertSame('cursor', $search->data['next']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/v3/search'
            && !$request->hasHeader('X-OPENFIGI-APIKEY')
            && $request->data() === ['currency' => 'USD', 'query' => 'IBM', 'exchCode' => 'US']);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => [['ticker' => 'IBM']]], 200)]);
        $filter = (new OpenFigiFilter($service))->execute([
            'query' => 'IBM',
            'includeUnlistedEquities' => false,
            'payload' => ['marketSecDes' => 'Equity'],
        ]);
        self::assertTrue($filter->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/v3/filter'
            && $request->data() === ['marketSecDes' => 'Equity', 'query' => 'IBM', 'includeUnlistedEquities' => false]);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['openapi' => '3.0.3', 'paths' => ['/mapping' => []]], 200)]);
        $schema = (new OpenFigiSchema($service))->execute([]);
        self::assertTrue($schema->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/schema');
    }

    public function test_validation_and_api_errors_are_reported(): void
    {
        $service = new OpenFigiService(baseUrl: 'https://api.example.test');

        $missingJobs = (new OpenFigiMapping($service))->execute([]);
        self::assertFalse($missingJobs->succeeded());
        self::assertStringContainsString('jobs is required', (string) $missingJobs->error);

        $badJob = (new OpenFigiMapping($service))->execute(['jobs' => [['idType' => 'TICKER']]]);
        self::assertFalse($badJob->succeeded());
        self::assertStringContainsString('must include idType and idValue', (string) $badJob->error);

        $badKey = (new OpenFigiMappingValues($service))->execute(['key' => 'bad']);
        self::assertFalse($badKey->succeeded());
        self::assertStringContainsString('key must be one of', (string) $badKey->error);

        Http::fake(['*' => Http::response(['error' => 'Invalid request body.'], 400)]);
        $apiError = (new OpenFigiFilter($service))->execute(['query' => 'IBM']);
        self::assertFalse($apiError->succeeded());
        self::assertStringContainsString('Invalid request body', (string) $apiError->error);
    }

    public function test_connection_and_multi_account_credentials(): void
    {
        Http::fake(['*' => Http::response(['openapi' => '3.0.3'], 200)]);

        $provider = new OpenFigiToolProvider;
        $anonymous = $provider->testConnection([]);
        self::assertTrue($anonymous['success']);
        self::assertStringContainsString('without an API key', (string) $anonymous['message']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.openfigi.com/schema'
            && !$request->hasHeader('X-OPENFIGI-APIKEY'));

        $withKey = $provider->testConnection(['api_key' => 'key-test']);
        self::assertTrue($withKey['success']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.openfigi.com/schema'
            && $request->hasHeader('X-OPENFIGI-APIKEY', 'key-test'));

        $resolver = new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return [$integration, $key, $account] === ['openfigi', 'api_key', 'acct_1'] ? 'key-account' : $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'openfigi' && $account === 'acct_1';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'openfigi' ? ['acct_1'] : [];
            }
        };

        Container::getInstance()->instance(CredentialResolver::class, $resolver);
        $tool = $provider->createTool(OpenFigiMappingValues::class, ['account' => 'acct_1']);
        $result = $tool->execute(['key' => 'idType']);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.openfigi.com/v3/mapping/values/idType'
            && $request->hasHeader('X-OPENFIGI-APIKEY', 'key-account'));
    }
}
