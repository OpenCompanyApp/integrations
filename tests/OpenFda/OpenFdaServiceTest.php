<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\OpenFda;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\OpenFda\OpenFdaService;
use OpenCompany\Integrations\OpenFda\OpenFdaToolProvider;
use OpenCompany\Integrations\OpenFda\Tools\OpenFdaDeviceUdi;
use OpenCompany\Integrations\OpenFda\Tools\OpenFdaDrugEvent;
use OpenCompany\Integrations\OpenFda\Tools\OpenFdaFoodEnforcement;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the public openFDA dataset integration.
 */
final class OpenFdaServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(OpenFdaService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(OpenFdaService::class);
        parent::tearDown();
    }

    public function test_provider_exposes_public_dataset_tools_and_docs(): void
    {
        $provider = new OpenFdaToolProvider;

        self::assertSame('openfda', $provider->appName());
        self::assertSame('openFDA', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('none', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertSame([], $provider->credentialFields());
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertCount(24, $provider->tools());
        self::assertArrayHasKey('openfda_drug_event', $provider->tools());
        self::assertArrayHasKey('openfda_device_udi', $provider->tools());
        self::assertArrayHasKey('openfda_other_historicaldocument', $provider->tools());
    }

    public function test_dataset_tools_map_shared_query_contract(): void
    {
        Http::fake(['*' => Http::response([
            'meta' => ['results' => ['total' => 1, 'limit' => 1, 'skip' => 0]],
            'results' => [['safetyreportid' => '10000001']],
        ], 200)]);

        $service = new OpenFdaService('https://example.test');
        $result = (new OpenFdaDrugEvent($service))->execute([
            'search' => 'patient.drug.openfda.generic_name:"metformin"',
            'count' => 'patient.reaction.reactionmeddrapt.exact',
            'sort' => 'receivedate:desc',
            'limit' => 5,
            'skip' => 10,
            'api_key' => 'key-test',
            'extra' => ['limit' => 99],
        ]);

        self::assertTrue($result->succeeded());
        self::assertSame('10000001', $result->data['results'][0]['safetyreportid']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://example.test/drug/event.json?')
            && str_contains($request->url(), 'search=patient.drug.openfda.generic_name%3A%22metformin%22')
            && str_contains($request->url(), 'count=patient.reaction.reactionmeddrapt.exact')
            && str_contains($request->url(), 'sort=receivedate%3Adesc')
            && str_contains($request->url(), 'limit=5')
            && str_contains($request->url(), 'skip=10')
            && str_contains($request->url(), 'api_key=key-test'));
    }

    public function test_other_dataset_classes_use_their_official_paths(): void
    {
        Http::fake(['*' => Http::response(['results' => [['id' => 'demo']]], 200)]);

        $service = new OpenFdaService('https://example.test');

        self::assertTrue((new OpenFdaFoodEnforcement($service))->execute(['limit' => 1])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.test/food/enforcement.json?'));

        self::assertTrue((new OpenFdaDeviceUdi($service))->execute(['search' => 'brand_name:test'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.test/device/udi.json?')
            && str_contains($request->url(), 'search=brand_name%3Atest'));
    }

    public function test_api_errors_are_reported(): void
    {
        Http::fake(['*' => Http::response([
            'error' => ['code' => 'NOT_FOUND', 'message' => 'No matches found.'],
        ], 404)]);

        $service = new OpenFdaService('https://example.test');
        $bad = (new OpenFdaDrugEvent($service))->execute(['search' => 'missing']);

        self::assertFalse($bad->succeeded());
        self::assertStringContainsString('No matches found', (string) $bad->error);
    }

    public function test_provider_create_tool_uses_bound_public_service(): void
    {
        Http::fake(['*' => Http::response(['results' => []], 200)]);

        $service = new OpenFdaService('https://example.test');
        app()->instance(OpenFdaService::class, $service);
        $tool = (new OpenFdaToolProvider)->createTool(OpenFdaDrugEvent::class);
        $result = $tool->execute(['limit' => 1]);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.test/drug/event.json?'));
    }
}
