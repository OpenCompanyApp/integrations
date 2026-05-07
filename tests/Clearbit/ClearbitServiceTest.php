<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Clearbit;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Clearbit\ClearbitService;
use OpenCompany\Integrations\Clearbit\ClearbitToolProvider;
use OpenCompany\Integrations\Clearbit\Tools\ClearbitApiGet;
use OpenCompany\Integrations\Clearbit\Tools\ClearbitEnrichCombined;
use OpenCompany\Integrations\Clearbit\Tools\ClearbitListAutocomplete;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Clearbit endpoint-family routing.
 */
final class ClearbitServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_routes_each_api_family_to_its_canonical_host(): void
    {
        Http::fake([
            'https://person.clearbit.test/v2/*' => Http::response(['ok' => true], 200),
            'https://company.clearbit.test/v2/*' => Http::response(['ok' => true], 200),
            'https://autocomplete.clearbit.test/v1/*' => Http::response([['domain' => 'example.test']], 200),
            'https://prospector.clearbit.test/v1/*' => Http::response(['results' => []], 200),
            'https://reveal.clearbit.test/v1/*' => Http::response(['company' => ['name' => 'Example']], 200),
            'https://discovery.clearbit.test/v1/*' => Http::response(['results' => []], 200),
            'https://risk.clearbit.test/v1/*' => Http::response(['risk' => ['score' => 0]], 200),
            'https://name.clearbit.test/v1/*' => Http::response(['domain' => 'example.test'], 200),
        ]);

        $service = new ClearbitService('clearbit_test', baseUrls: $this->baseUrls());

        $service->enrichPerson('person@example.test');
        $service->enrichCombined('person@example.test');
        $service->enrichCompany('example.test');
        $service->autocomplete('Example');
        $service->prospect(['domain' => 'example.test', 'roles' => 'sales,engineering']);
        $service->reveal('203.0.113.10');
        $service->searchDiscovery(['query' => 'name:example']);
        $service->calculateRisk(['email' => 'person@example.test', 'ip' => '203.0.113.10']);
        $service->nameToDomain('Example');
        $service->apiGet('company', '/companies/find', ['domain' => 'example.test']);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer clearbit_test'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://person.clearbit.test/v2/people/find?email=person%40example.test');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://person.clearbit.test/v2/combined/find?email=person%40example.test');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://company.clearbit.test/v2/companies/find?domain=example.test');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://autocomplete.clearbit.test/v1/companies/suggest?query=Example' && ! $request->hasHeader('Authorization'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://prospector.clearbit.test/v1/people/search?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://reveal.clearbit.test/v1/companies/find?ip=203.0.113.10');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://discovery.clearbit.test/v1/companies/search?query=name%3Aexample');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://risk.clearbit.test/v1/calculate?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://name.clearbit.test/v1/domains/find?name=Example' && $request->hasHeader('Authorization', 'Basic '.base64_encode('clearbit_test:')));
    }

    public function test_new_tools_delegate_to_service(): void
    {
        Http::fake([
            'https://person.clearbit.test/v2/*' => Http::response(['ok' => true], 200),
            'https://autocomplete.clearbit.test/v1/*' => Http::response([['domain' => 'example.test']], 200),
            'https://company.clearbit.test/v2/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new ClearbitService('clearbit_test', baseUrls: $this->baseUrls());

        self::assertTrue((new ClearbitEnrichCombined($service))->execute([
            'email' => 'person@example.test',
        ])->succeeded());
        self::assertTrue((new ClearbitListAutocomplete(new ClearbitService(baseUrls: $this->baseUrls())))->execute([
            'name' => 'Example',
        ])->succeeded());
        self::assertTrue((new ClearbitApiGet($service))->execute([
            'api' => 'company',
            'path' => '/companies/find',
            'params' => ['domain' => 'example.test'],
        ])->succeeded());
    }

    public function test_provider_exposes_corrected_catalog_and_connection_behavior(): void
    {
        Http::fake([
            'https://person.clearbit.com/v2/people/find*' => Http::response(['error' => 'not found'], 404),
        ]);

        $provider = new ClearbitToolProvider();
        $tools = $provider->tools();

        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertArrayHasKey('clearbit_enrich_combined', $tools);
        self::assertArrayHasKey('clearbit_name_to_domain', $tools);
        self::assertArrayHasKey('clearbit_discovery_search', $tools);
        self::assertArrayHasKey('clearbit_calculate_risk', $tools);
        self::assertArrayHasKey('clearbit_api_get', $tools);
        self::assertArrayNotHasKey('clearbit_get'.'_current_user', $tools);
        self::assertSame(10, count($tools));
        self::assertTrue($provider->testConnection(['api_key' => 'clearbit_test'])['success']);
    }

    /**
     * @return array<string, string>
     */
    private function baseUrls(): array
    {
        return [
            'person' => 'https://person.clearbit.test/v2',
            'company' => 'https://company.clearbit.test/v2',
            'autocomplete' => 'https://autocomplete.clearbit.test/v1',
            'prospector' => 'https://prospector.clearbit.test/v1',
            'reveal' => 'https://reveal.clearbit.test/v1',
            'discovery' => 'https://discovery.clearbit.test/v1',
            'risk' => 'https://risk.clearbit.test/v1',
            'name_to_domain' => 'https://name.clearbit.test/v1',
        ];
    }
}
