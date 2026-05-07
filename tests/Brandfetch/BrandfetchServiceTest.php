<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Brandfetch;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Brandfetch\BrandfetchService;
use OpenCompany\Integrations\Brandfetch\BrandfetchToolProvider;
use OpenCompany\Integrations\Brandfetch\Tools\BrandfetchApiGet;
use OpenCompany\Integrations\Brandfetch\Tools\BrandfetchEnrichTransaction;
use OpenCompany\Integrations\Brandfetch\Tools\BrandfetchGetBrandByDomain;
use OpenCompany\Integrations\Brandfetch\Tools\BrandfetchLogoUrl;
use OpenCompany\Integrations\Brandfetch\Tools\BrandfetchSearchBrands;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for current Brandfetch API endpoint coverage.
 */
final class BrandfetchServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_current_brandfetch_apis(): void
    {
        Http::fake([
            'https://api.brandfetch.io/v2/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new BrandfetchService('bf_token', clientId: 'bf_client');

        self::assertSame(['ok' => true], $service->getBrand('brandfetch.com'));
        self::assertSame(['ok' => true], $service->getBrandByType('domain', 'brandfetch.com'));
        self::assertSame(['ok' => true], $service->getBrandByType('ticker', 'NKE'));
        self::assertSame(['ok' => true], $service->searchBrands('Nike'));
        self::assertSame(['ok' => true], $service->enrichTransaction([
            'transactionLabel' => 'STARBUCKS 1523 OMAHA NE',
            'countryCode' => 'US',
        ]));

        $logo = $service->logoUrl('nike.com', ['width' => 400, 'height' => 400, 'theme' => 'dark']);
        self::assertSame('https://cdn.brandfetch.io/nike.com/w/400/h/400/theme/dark?c=bf_client', $logo['url']);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer bf_token'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.brandfetch.io/v2/brands/brandfetch.com');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.brandfetch.io/v2/brands/domain/brandfetch.com');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.brandfetch.io/v2/search/Nike?c=bf_client');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.brandfetch.io/v2/brands/transaction' && $request['countryCode'] === 'US');
    }

    public function test_tools_delegate_and_validate_raw_paths(): void
    {
        Http::fake([
            'https://api.brandfetch.io/v2/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new BrandfetchService('bf_token', clientId: 'bf_client');

        self::assertTrue((new BrandfetchGetBrandByDomain($service))->execute([
            'domain' => 'brandfetch.com',
        ])->succeeded());
        self::assertTrue((new BrandfetchSearchBrands($service))->execute([
            'query' => 'Nike',
        ])->succeeded());
        self::assertTrue((new BrandfetchEnrichTransaction($service))->execute([
            'transactionLabel' => 'STARBUCKS 1523 OMAHA NE',
            'countryCode' => 'US',
        ])->succeeded());
        self::assertTrue((new BrandfetchLogoUrl($service))->execute([
            'identifier' => 'nike.com',
            'options' => ['width' => 128],
        ])->succeeded());
        self::assertTrue((new BrandfetchApiGet($service))->execute([
            'path' => '/v2/brands/domain/brandfetch.com',
        ])->succeeded());
        self::assertFalse((new BrandfetchApiGet($service))->execute([
            'path' => 'https://example.test/v2/brands/brandfetch.com',
        ])->succeeded());
    }

    public function test_provider_exposes_current_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://api.brandfetch.io/v2/brands/brandfetch.com' => Http::response(['name' => 'Brandfetch'], 200),
        ]);

        $provider = new BrandfetchToolProvider();
        $tools = $provider->tools();

        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('https://docs.brandfetch.com/reference', $provider->integrationMeta()['docs_url']);
        self::assertArrayHasKey('brandfetch_get_brand_by_domain', $tools);
        self::assertArrayHasKey('brandfetch_get_brand_by_ticker', $tools);
        self::assertArrayHasKey('brandfetch_enrich_transaction', $tools);
        self::assertArrayHasKey('brandfetch_logo_url', $tools);
        self::assertArrayHasKey('brandfetch_api_post', $tools);
        self::assertSame(15, count($tools));

        self::assertTrue($provider->testConnection(['access_token' => 'bf_token'])['success']);
    }
}
