<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Raindrop;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Raindrop\RaindropService;
use OpenCompany\Integrations\Raindrop\RaindropToolProvider;
use OpenCompany\Integrations\Raindrop\Tools\RaindropRaindropsSingleUpdateRaindrop;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Raindrop.io API coverage and request mapping.
 */
final class RaindropServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        parent::tearDown();
    }

    public function test_provider_exposes_official_raindrop_surface(): void
    {
        $provider = new RaindropToolProvider;
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://developer.raindrop.io/', $provider->integrationMeta()['docs_url']);
        self::assertCount(50, $tools);
        self::assertArrayHasKey('raindrop_raindrops_multiple_get_raindrops', $tools);
        self::assertArrayHasKey('raindrop_collections_get_root_collections', $tools);
        self::assertArrayHasKey('raindrop_tags_get_tags', $tools);
        self::assertArrayHasKey('raindrop_backups_get_all', $tools);

        foreach ($tools as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], '\\') + 1);
            self::assertFileExists(__DIR__.'/../../packages/raindrop/src/Tools/'.$shortName.'.php');
        }

        self::assertFileExists((string) $provider->luaDocsPath());
    }

    public function test_service_maps_query_path_json_and_bearer_requests(): void
    {
        Http::fake(['*' => Http::response(['result' => true], 200)]);

        $service = new RaindropService('rain-token', 'https://api.example.test/rest/v1');
        $service->call('raindrop_raindrops_multiple_get_raindrops', [
            'collection_id' => 0,
            'query' => ['perpage' => 10],
        ]);
        $service->call('raindrop_raindrops_single_update_raindrop', [
            'id' => 123,
            'payload' => ['title' => 'Updated'],
        ]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/rest/v1/raindrops/0?perpage=10'
            && $request->hasHeader('Authorization', 'Bearer rain-token'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://api.example.test/rest/v1/raindrop/123'
            && $request->hasHeader('Authorization', 'Bearer rain-token')
            && $request['title'] === 'Updated');
    }

    public function test_optional_collection_path_parameter_can_be_omitted_for_tags(): void
    {
        Http::fake(['*' => Http::response(['items' => []], 200)]);

        $service = new RaindropService('rain-token', 'https://api.example.test/rest/v1');
        $service->call('raindrop_tags_get_tags');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/rest/v1/tags');
    }

    public function test_tools_report_missing_required_path_arguments(): void
    {
        $tool = new RaindropRaindropsSingleUpdateRaindrop(new RaindropService('rain-token'));
        $result = $tool->execute(['payload' => ['title' => 'Updated']]);

        self::assertFalse($result->succeeded());
        self::assertStringContainsString('id is required', (string) $result->error);
    }
}
