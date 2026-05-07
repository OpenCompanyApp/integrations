<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Cloudinary;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Cloudinary\CloudinaryService;
use OpenCompany\Integrations\Cloudinary\CloudinaryToolProvider;
use OpenCompany\Integrations\Cloudinary\Tools\CloudinaryApiGet;
use OpenCompany\Integrations\Cloudinary\Tools\CloudinaryListTags;
use OpenCompany\Integrations\Cloudinary\Tools\CloudinarySearchResources;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Cloudinary Upload and Admin API routing.
 */
final class CloudinaryServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_upload_admin_resources_folders_and_metadata_endpoints(): void
    {
        Http::fake([
            'https://api.cloudinary.test/v1_1/demo/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new CloudinaryService(
            cloudName: 'demo',
            baseUrl: 'https://api.cloudinary.test/v1_1',
            apiKey: 'key_123',
            apiSecret: 'secret_123',
        );

        $service->upload('https://example.test/image.jpg', 'folder/hero', 'folder', 'image', ['tags' => 'hero']);
        $service->listResources('image', 10, null, 'folder/', 'upload');
        $service->getResource('image', 'folder/hero');
        $service->deleteResource('image', 'folder/hero', 'upload', ['invalidate' => true]);
        $service->searchResources(['expression' => 'folder=folder']);
        $service->listResourcesByTag('hero', 'image');
        $service->listTags('image', ['prefix' => 'he']);
        $service->listFolders();
        $service->listSubfolders('folder');
        $service->searchFolders(['expression' => 'name:folder']);
        $service->createFolder('folder/new');
        $service->deleteFolder('folder/new');
        $service->listTransformations();
        $service->listUploadPresets();
        $service->getUsage();
        $service->ping();
        $service->apiGet('/resources/search', ['expression' => 'resource_type:image']);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Basic '.base64_encode('key_123:secret_123')));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.cloudinary.test/v1_1/demo/image/upload' && isset($request['signature']));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.cloudinary.test/v1_1/demo/resources/image/upload?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.cloudinary.test/v1_1/demo/resources/image/upload/folder/hero');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://api.cloudinary.test/v1_1/demo/resources/image/upload'
            && $request['invalidate'] === true
            && $request['public_ids'] === ['folder/hero']);
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.cloudinary.test/v1_1/demo/resources/search?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.cloudinary.test/v1_1/demo/resources/image/tags/hero');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.cloudinary.test/v1_1/demo/tags/image?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.cloudinary.test/v1_1/demo/folders');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.cloudinary.test/v1_1/demo/folders/folder');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.cloudinary.test/v1_1/demo/folders/search?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.cloudinary.test/v1_1/demo/folders/folder/new');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.cloudinary.test/v1_1/demo/folders/folder/new');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.cloudinary.test/v1_1/demo/transformations');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.cloudinary.test/v1_1/demo/upload_presets');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.cloudinary.test/v1_1/demo/usage');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.cloudinary.test/v1_1/demo/ping');
    }

    public function test_new_tools_delegate_to_service(): void
    {
        Http::fake([
            'https://api.cloudinary.test/v1_1/demo/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new CloudinaryService(
            cloudName: 'demo',
            baseUrl: 'https://api.cloudinary.test/v1_1',
            apiKey: 'key_123',
            apiSecret: 'secret_123',
        );

        self::assertTrue((new CloudinarySearchResources($service))->execute([
            'params' => ['expression' => 'resource_type:image'],
        ])->succeeded());
        self::assertTrue((new CloudinaryListTags($service))->execute([
            'resource_type' => 'image',
        ])->succeeded());
        self::assertTrue((new CloudinaryApiGet($service))->execute([
            'path' => '/usage',
        ])->succeeded());
    }

    public function test_provider_exposes_expanded_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://api.cloudinary.com/v1_1/demo/ping' => Http::response(['status' => 'ok'], 200),
        ]);

        $provider = new CloudinaryToolProvider();
        $tools = $provider->tools();

        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertArrayHasKey('cloudinary_search_resources', $tools);
        self::assertArrayHasKey('cloudinary_list_resources_by_tag', $tools);
        self::assertArrayHasKey('cloudinary_list_tags', $tools);
        self::assertArrayHasKey('cloudinary_create_folder', $tools);
        self::assertArrayHasKey('cloudinary_list_transformations', $tools);
        self::assertArrayHasKey('cloudinary_list_upload_presets', $tools);
        self::assertArrayHasKey('cloudinary_api_get', $tools);
        self::assertArrayNotHasKey('cloudinary_get'.'_current_user', $tools);
        self::assertSame(17, count($tools));
        self::assertTrue($provider->testConnection([
            'cloud_name' => 'demo',
            'api_key' => 'key_123',
            'api_secret' => 'secret_123',
        ])['success']);
    }
}
