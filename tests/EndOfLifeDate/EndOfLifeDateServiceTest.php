<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\EndOfLifeDate;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\EndOfLifeDate\EndOfLifeDateService;
use OpenCompany\Integrations\EndOfLifeDate\EndOfLifeDateToolProvider;
use OpenCompany\Integrations\EndOfLifeDate\Tools\EndOfLifeDateCategories;
use OpenCompany\Integrations\EndOfLifeDate\Tools\EndOfLifeDateCategoryProducts;
use OpenCompany\Integrations\EndOfLifeDate\Tools\EndOfLifeDateIdentifierTypes;
use OpenCompany\Integrations\EndOfLifeDate\Tools\EndOfLifeDateIdentifiers;
use OpenCompany\Integrations\EndOfLifeDate\Tools\EndOfLifeDateIndex;
use OpenCompany\Integrations\EndOfLifeDate\Tools\EndOfLifeDateLatestRelease;
use OpenCompany\Integrations\EndOfLifeDate\Tools\EndOfLifeDateProduct;
use OpenCompany\Integrations\EndOfLifeDate\Tools\EndOfLifeDateProductRelease;
use OpenCompany\Integrations\EndOfLifeDate\Tools\EndOfLifeDateProducts;
use OpenCompany\Integrations\EndOfLifeDate\Tools\EndOfLifeDateProductsFull;
use OpenCompany\Integrations\EndOfLifeDate\Tools\EndOfLifeDateTagProducts;
use OpenCompany\Integrations\EndOfLifeDate\Tools\EndOfLifeDateTags;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the endoflife.date integration.
 */
final class EndOfLifeDateServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(EndOfLifeDateService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(EndOfLifeDateService::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new EndOfLifeDateToolProvider;

        self::assertSame('endoflife-date', $provider->appName());
        self::assertSame('endoflife.date', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('none', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertSame([], $provider->credentialFields());
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertSame([
            'endoflife_date_index',
            'endoflife_date_products',
            'endoflife_date_products_full',
            'endoflife_date_product',
            'endoflife_date_product_release',
            'endoflife_date_latest_release',
            'endoflife_date_categories',
            'endoflife_date_category_products',
            'endoflife_date_tags',
            'endoflife_date_tag_products',
            'endoflife_date_identifier_types',
            'endoflife_date_identifiers',
        ], array_keys($provider->tools()));
    }

    public function test_index_and_product_endpoint_paths_are_mapped(): void
    {
        $service = new EndOfLifeDateService(baseUrl: 'https://eol.example.test/api/v1');

        Http::fake(['*' => Http::response(['schema_version' => '1.2.1', 'result' => [['name' => 'products']]], 200)]);
        self::assertTrue((new EndOfLifeDateIndex($service))->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://eol.example.test/api/v1/');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['result' => [['name' => 'ubuntu', 'label' => 'Ubuntu']]], 200)]);
        self::assertTrue((new EndOfLifeDateProducts($service))->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://eol.example.test/api/v1/products');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['result' => [['name' => 'ubuntu', 'releases' => []]]], 200)]);
        self::assertTrue((new EndOfLifeDateProductsFull($service))->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://eol.example.test/api/v1/products/full');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['result' => ['name' => 'ubuntu', 'releases' => []]], 200)]);
        self::assertTrue((new EndOfLifeDateProduct($service))->execute(['product' => 'ubuntu linux'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://eol.example.test/api/v1/products/ubuntu%20linux');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['result' => ['name' => '24.04', 'isEol' => false]], 200)]);
        self::assertTrue((new EndOfLifeDateProductRelease($service))->execute(['product' => 'ubuntu', 'release' => '24.04'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://eol.example.test/api/v1/products/ubuntu/releases/24.04');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['result' => ['name' => '26.04', 'isEol' => false]], 200)]);
        self::assertTrue((new EndOfLifeDateLatestRelease($service))->execute(['product' => 'ubuntu'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://eol.example.test/api/v1/products/ubuntu/releases/latest');
    }

    public function test_category_tag_and_identifier_paths_are_mapped(): void
    {
        $service = new EndOfLifeDateService(baseUrl: 'https://eol.example.test/api/v1');

        Http::fake(['*' => Http::response(['result' => [['name' => 'os']]], 200)]);
        self::assertTrue((new EndOfLifeDateCategories($service))->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://eol.example.test/api/v1/categories');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['result' => [['name' => 'ubuntu']]], 200)]);
        self::assertTrue((new EndOfLifeDateCategoryProducts($service))->execute(['category' => 'server app'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://eol.example.test/api/v1/categories/server%20app');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['result' => [['name' => 'linux-distribution']]], 200)]);
        self::assertTrue((new EndOfLifeDateTags($service))->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://eol.example.test/api/v1/tags');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['result' => [['name' => 'ubuntu']]], 200)]);
        self::assertTrue((new EndOfLifeDateTagProducts($service))->execute(['tag' => 'java runtime'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://eol.example.test/api/v1/tags/java%20runtime');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['result' => [['name' => 'purl']]], 200)]);
        self::assertTrue((new EndOfLifeDateIdentifierTypes($service))->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://eol.example.test/api/v1/identifiers');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['result' => [['identifier' => 'pkg:deb/ubuntu/ubuntu', 'product' => ['name' => 'ubuntu']]]], 200)]);
        self::assertTrue((new EndOfLifeDateIdentifiers($service))->execute(['identifier_type' => 'purl'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://eol.example.test/api/v1/identifiers/purl');
    }

    public function test_validation_html_errors_and_redirect_options_are_handled(): void
    {
        $service = new EndOfLifeDateService(baseUrl: 'https://eol.example.test/api/v1');

        $missing = (new EndOfLifeDateProduct($service))->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('product is required', (string) $missing->error);

        Http::fake(['*' => Http::response('<html><body>Not Found</body></html>', 404)]);
        $apiError = (new EndOfLifeDateProductRelease($service))->execute(['product' => 'missing', 'release' => '1.0']);
        self::assertFalse($apiError->succeeded());
        self::assertStringContainsString('Not Found', (string) $apiError->error);

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://eol.example.test/api/v1/products/missing/releases/1.0');
    }

    public function test_provider_creates_tools_with_default_service(): void
    {
        Http::fake(['*' => Http::response(['result' => ['name' => 'ubuntu']], 200)]);

        app()->instance(EndOfLifeDateService::class, new EndOfLifeDateService(baseUrl: 'https://eol.example.test/api/v1'));
        $tool = (new EndOfLifeDateToolProvider)->createTool(EndOfLifeDateProduct::class);
        $result = $tool->execute(['product' => 'ubuntu']);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://eol.example.test/api/v1/products/ubuntu');
    }
}
