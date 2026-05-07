<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\TrustMrr;

use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\TrustMrr\Tools\TrustMrrGetStartup;
use OpenCompany\Integrations\TrustMrr\Tools\TrustMrrListStartups;
use OpenCompany\Integrations\TrustMrr\TrustMrrService;
use OpenCompany\Integrations\TrustMrr\TrustMrrToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for TrustMRR endpoint coverage and parameter mapping.
 */
final class TrustMrrServiceTest extends TestCase
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

    public function test_service_maps_to_documented_startup_endpoints(): void
    {
        Http::fake([
            'https://api.trustmrr.test/v1/startups*' => Http::response([
                'data' => [['slug' => 'example-startup', 'name' => 'Example Startup']],
                'meta' => ['total' => 1, 'page' => 1, 'limit' => 10, 'hasMore' => false],
            ], 200),
        ]);

        $service = new TrustMrrService('tmrr_test', 'https://api.trustmrr.test/v1');
        $service->listStartups(['sort' => 'revenue-desc', 'limit' => 10]);
        $service->getStartup('example/startup');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://api.trustmrr.test/v1/startups?')
            && str_contains($request->url(), 'sort=revenue-desc')
            && str_contains($request->url(), 'limit=10')
            && $request->hasHeader('Authorization', 'Bearer tmrr_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.trustmrr.test/v1/startups/example%2Fstartup');
    }

    public function test_list_tool_maps_agent_snake_case_to_api_camel_case(): void
    {
        Http::fake([
            'https://api.trustmrr.test/v1/startups*' => Http::response([
                'data' => [[
                    'slug' => 'example-startup',
                    'name' => 'Example Startup',
                    'revenue' => ['mrr' => 100000],
                ]],
                'meta' => ['total' => 1, 'page' => 2, 'limit' => 50, 'hasMore' => true],
            ], 200),
        ]);

        $tool = new TrustMrrListStartups(new TrustMrrService('tmrr_test', 'https://api.trustmrr.test/v1'));
        $result = $tool->execute([
            'on_sale' => true,
            'x_handle' => 'founder',
            'min_revenue' => 10000,
            'max_revenue' => 500000,
            'min_mrr' => 5000,
            'max_mrr' => 100000,
            'min_growth' => 0.1,
            'max_growth' => 0.5,
            'min_price' => 1000000,
            'max_price' => 10000000,
            'page' => 2,
            'limit' => 99,
        ]);

        self::assertNull($result->error);
        self::assertSame(1, $result->data['total']);
        self::assertSame(2, $result->data['page']);
        self::assertTrue($result->data['has_more']);

        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.trustmrr.test/v1/startups?')
            && str_contains($request->url(), 'onSale=true')
            && str_contains($request->url(), 'xHandle=founder')
            && str_contains($request->url(), 'minRevenue=10000')
            && str_contains($request->url(), 'maxRevenue=500000')
            && str_contains($request->url(), 'minMrr=5000')
            && str_contains($request->url(), 'maxMrr=100000')
            && str_contains($request->url(), 'minGrowth=0.1')
            && str_contains($request->url(), 'maxGrowth=0.5')
            && str_contains($request->url(), 'minPrice=1000000')
            && str_contains($request->url(), 'maxPrice=10000000')
            && str_contains($request->url(), 'page=2')
            && str_contains($request->url(), 'limit=50'));
    }

    public function test_get_tool_and_provider_cover_the_complete_documented_surface(): void
    {
        Http::fake([
            'https://api.trustmrr.test/v1/startups/example-startup' => Http::response([
                'data' => [
                    'slug' => 'example-startup',
                    'name' => 'Example Startup',
                    'revenue' => ['last30Days' => 200000, 'mrr' => 150000],
                    'techStack' => [['slug' => 'laravel']],
                ],
            ], 200),
        ]);

        $tool = new TrustMrrGetStartup(new TrustMrrService('tmrr_test', 'https://api.trustmrr.test/v1'));
        $result = $tool->execute(['slug' => 'example-startup']);

        self::assertNull($result->error);
        self::assertSame('Example Startup', $result->data['name']);
        self::assertSame('laravel', $result->data['techStack'][0]['slug']);

        $provider = new TrustMrrToolProvider();
        $tools = $provider->tools();

        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('https://trustmrr.com/docs/api', $provider->integrationMeta()['docs_url']);
        self::assertArrayHasKey('trustmrr_list_startups', $tools);
        self::assertArrayHasKey('trustmrr_get_startup', $tools);
        self::assertSame(2, count($tools));
    }

    public function test_tools_return_configuration_errors_without_api_key(): void
    {
        $service = new TrustMrrService('', 'https://api.trustmrr.test/v1');

        self::assertSame('TrustMRR integration is not configured.', (new TrustMrrListStartups($service))->execute([])->error);
        self::assertSame('TrustMRR integration is not configured.', (new TrustMrrGetStartup($service))->execute(['slug' => 'example-startup'])->error);
    }
}
