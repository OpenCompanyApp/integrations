<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Ahrefs;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Ahrefs\AhrefsService;
use OpenCompany\Integrations\Ahrefs\AhrefsToolProvider;
use OpenCompany\Integrations\Ahrefs\Tools\AhrefsApiGet;
use OpenCompany\Integrations\Ahrefs\Tools\AhrefsGetMetrics;
use OpenCompany\Integrations\Ahrefs\Tools\AhrefsListBrokenBacklinks;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Ahrefs API v3 endpoint mapping and catalog coverage.
 */
final class AhrefsServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_current_api_v3_paths(): void
    {
        Http::fake([
            'https://api.ahrefs.test/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new AhrefsService('ahrefs_test', 'https://api.ahrefs.test');

        $service->listBacklinks('example.test', 10, 0, 'domain');
        $service->listReferringDomains('example.test', 10, 0, 'domain');
        $service->listOrganicKeywords('example.test', 10, 0, 'domain');
        $service->listPages('example.test', 10, 0, 'domain');
        $service->getMetrics(['target' => 'example.test', 'date' => '2026-05-06']);
        $service->getDomainRating(['target' => 'example.test', 'date' => '2026-05-06']);
        $service->getBacklinksStats(['target' => 'example.test', 'date' => '2026-05-06']);
        $service->listBrokenBacklinks(['target' => 'example.test', 'mode' => 'domain']);
        $service->listOrganicCompetitors(['target' => 'example.test', 'date' => '2026-05-06', 'country' => 'us']);
        $service->listPaidPages(['target' => 'example.test', 'date' => '2026-05-06']);
        $service->listAnchors('example.test', 10, 0);
        $service->listLinkedDomains(['target' => 'example.test', 'mode' => 'domain']);
        $service->getLimitsAndUsage();
        $service->apiGet('/v3/site-explorer/metrics-by-country', ['target' => 'example.test']);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer ahrefs_test') && $request->hasHeader('Accept', 'application/json'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.ahrefs.test/v3/site-explorer/all-backlinks?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.ahrefs.test/v3/site-explorer/refdomains?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.ahrefs.test/v3/site-explorer/top-pages?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.ahrefs.test/v3/site-explorer/metrics?') && str_contains($request->url(), 'date=2026-05-06'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.ahrefs.test/v3/site-explorer/domain-rating?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.ahrefs.test/v3/site-explorer/backlinks-stats?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.ahrefs.test/v3/site-explorer/broken-backlinks?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.ahrefs.test/v3/site-explorer/organic-competitors?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.ahrefs.test/v3/site-explorer/paid-pages?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.ahrefs.test/v3/site-explorer/linkeddomains?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.ahrefs.test/v3/subscription-info/limits-and-usage');
        Http::assertNotSent(static fn (Request $request): bool => str_contains($request->url(), '/v3/users/me'));
        Http::assertNotSent(static fn (Request $request): bool => str_contains($request->url(), '/v3/site-explorer/referring-domains'));
        Http::assertNotSent(static fn (Request $request): bool => str_contains($request->url(), '/v3/site-explorer/paid-keywords'));
    }

    public function test_tools_delegate_to_service(): void
    {
        Http::fake([
            'https://api.ahrefs.test/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new AhrefsService('ahrefs_test', 'https://api.ahrefs.test');

        self::assertTrue((new AhrefsGetMetrics($service))->execute([
            'params' => ['target' => 'example.test', 'date' => '2026-05-06'],
        ])->succeeded());
        self::assertTrue((new AhrefsListBrokenBacklinks($service))->execute([
            'params' => ['target' => 'example.test', 'mode' => 'domain'],
        ])->succeeded());
        self::assertTrue((new AhrefsApiGet($service))->execute([
            'path' => '/v3/site-explorer/metrics-by-country',
            'params' => ['target' => 'example.test'],
        ])->succeeded());

        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), '/v3/site-explorer/metrics?'));
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), '/v3/site-explorer/broken-backlinks?'));
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), '/v3/site-explorer/metrics-by-country?'));
    }

    public function test_provider_exposes_current_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://api.ahrefs.com/v3/subscription-info/limits-and-usage' => Http::response(['limits_and_usage' => ['subscription' => 'Enterprise']], 200),
        ]);

        $provider = new AhrefsToolProvider();
        $tools = $provider->tools();

        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('https://docs.ahrefs.com/docs/api/reference/introduction', $provider->integrationMeta()['docs_url']);
        self::assertArrayHasKey('ahrefs_get_metrics', $tools);
        self::assertArrayHasKey('ahrefs_get_domain_rating', $tools);
        self::assertArrayHasKey('ahrefs_list_broken_backlinks', $tools);
        self::assertArrayHasKey('ahrefs_list_paid_pages', $tools);
        self::assertArrayHasKey('ahrefs_get_limits_and_usage', $tools);
        self::assertArrayHasKey('ahrefs_api_get', $tools);
        self::assertArrayNotHasKey('ahrefs_get_current_user', $tools);
        self::assertArrayNotHasKey('ahrefs_list_paid_keywords', $tools);
        self::assertSame(14, count($tools));
        self::assertTrue($provider->testConnection(['api_key' => 'ahrefs_test'])['success']);
    }
}
