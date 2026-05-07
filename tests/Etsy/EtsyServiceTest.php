<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Etsy;

use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Etsy\EtsyService;
use OpenCompany\Integrations\Etsy\EtsyToolProvider;
use OpenCompany\Integrations\Etsy\Tools\EtsyApiGet;
use OpenCompany\Integrations\Etsy\Tools\EtsyUpdateListing;
use OpenCompany\Integrations\Etsy\Tools\EtsyUpdateListingInventory;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for expanded Etsy Open API coverage.
 */
final class EtsyServiceTest extends TestCase
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

    public function test_service_maps_shop_listing_inventory_receipt_and_generic_endpoints(): void
    {
        Http::fake([
            'https://openapi.etsy.com/v3/application/*' => Http::response(['ok' => true, 'user_id' => 123], 200),
        ]);

        $service = new EtsyService('etsy_oauth', 'shop-1', apiKey: 'etsy_app');

        $service->getShop();
        $service->listListings(['state' => 'active', 'limit' => 10]);
        $service->getListing(100);
        $service->createListing(['title' => 'Example Listing']);
        $service->updateListing(100, ['title' => 'Updated Listing']);
        $service->deleteListing(100);
        $service->listListingImages(100);
        $service->getListingInventory(100);
        $service->updateListingInventory(100, ['products' => []]);
        $service->listOrders(['was_paid' => true, 'was_shipped' => false]);
        $service->getReceipt(200);
        $service->listReceiptTransactions(200);
        $service->listShopSections();
        $service->listShippingProfiles();
        $service->listSellerTaxonomyNodes();
        $service->getCurrentUser();
        $service->apiGet('/seller-taxonomy/nodes', ['limit' => 5]);
        $service->apiPost('/shops/shop-1/listings', ['title' => 'Draft']);
        $service->apiPut('/listings/100/inventory', ['products' => []]);
        $service->apiDelete('/shops/shop-1/listings/100');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer etsy_oauth'));
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('x-api-key', 'etsy_app'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://openapi.etsy.com/v3/application/shops/shop-1');
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), '/shops/shop-1/listings?state=active'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://openapi.etsy.com/v3/application/shops/shop-1/listings');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://openapi.etsy.com/v3/application/shops/shop-1/listings/100');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://openapi.etsy.com/v3/application/shops/shop-1/listings/100');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://openapi.etsy.com/v3/application/shops/shop-1/listings/100/images');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://openapi.etsy.com/v3/application/listings/100/inventory');
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), '/shops/shop-1/receipts?was_paid=1'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://openapi.etsy.com/v3/application/shops/shop-1/receipts/200/transactions');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://openapi.etsy.com/v3/application/shops/shop-1/sections');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://openapi.etsy.com/v3/application/shops/shop-1/shipping-profiles');
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), '/seller-taxonomy/nodes?limit=5'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://openapi.etsy.com/v3/application/users/me');
    }

    public function test_upload_listing_image_uses_multipart_endpoint(): void
    {
        Http::fake([
            'https://openapi.etsy.com/v3/application/*' => Http::response(['listing_image_id' => 300], 200),
        ]);

        $imagePath = tempnam(sys_get_temp_dir(), 'etsy-image-');
        self::assertIsString($imagePath);
        file_put_contents($imagePath, 'fake-image-bytes');

        try {
            $service = new EtsyService('etsy_oauth', 'shop-1', apiKey: 'etsy_app');
            $result = $service->uploadListingImage(100, $imagePath, ['rank' => 1, 'alt_text' => 'Example image']);

            self::assertSame(300, $result['listing_image_id']);
        } finally {
            if (is_file($imagePath)) {
                unlink($imagePath);
            }
        }

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://openapi.etsy.com/v3/application/shops/shop-1/listings/100/images'
            && $request->hasHeader('x-api-key', 'etsy_app'));
    }

    public function test_new_tools_delegate_and_validate_required_arguments(): void
    {
        Http::fake([
            'https://openapi.etsy.com/v3/application/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new EtsyService('etsy_oauth', 'shop-1', apiKey: 'etsy_app');

        self::assertTrue((new EtsyUpdateListing($service))->execute([
            'listing_id' => 100,
            'data' => ['title' => 'Updated Listing'],
        ])->succeeded());
        self::assertTrue((new EtsyUpdateListingInventory($service))->execute([
            'listing_id' => 100,
            'data' => ['products' => []],
        ])->succeeded());
        self::assertTrue((new EtsyApiGet($service))->execute([
            'path' => '/seller-taxonomy/nodes',
            'params' => ['limit' => 5],
        ])->succeeded());
        self::assertFalse((new EtsyUpdateListing($service))->execute([
            'listing_id' => 0,
            'data' => ['title' => 'Updated Listing'],
        ])->succeeded());
        self::assertFalse((new EtsyApiGet($service))->execute([
            'path' => 'https://example.test/listings',
        ])->succeeded());
    }

    public function test_provider_exposes_expanded_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://openapi.etsy.com/v3/application/users/me' => Http::response(['user_id' => 123], 200),
        ]);

        $provider = new EtsyToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertArrayHasKey('etsy_get_shop', $tools);
        self::assertArrayHasKey('etsy_update_listing', $tools);
        self::assertArrayHasKey('etsy_upload_listing_image', $tools);
        self::assertArrayHasKey('etsy_update_listing_inventory', $tools);
        self::assertArrayHasKey('etsy_get_receipt', $tools);
        self::assertArrayHasKey('etsy_list_seller_taxonomy_nodes', $tools);
        self::assertArrayHasKey('etsy_api_delete', $tools);
        self::assertSame(21, count($tools));
        self::assertTrue($provider->testConnection([
            'access_token' => 'etsy_oauth',
            'api_key' => 'etsy_app',
            'shop_id' => 'shop-1',
        ])['success']);
    }
}
