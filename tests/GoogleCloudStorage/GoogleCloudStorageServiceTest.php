<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\GoogleCloudStorage;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\GoogleCloudStorage\GoogleCloudStorageService;
use OpenCompany\Integrations\GoogleCloudStorage\GoogleCloudStorageToolProvider;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageBucketsList;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageObjectsGet;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageObjectsInsert;
use PHPUnit\Framework\TestCase;

final class GoogleCloudStorageServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_provider_matches_discovery_manifest_and_docs(): void
    {
        $provider = new GoogleCloudStorageToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__ . '/../../packages/google-cloud-storage/google-cloud-storage-discovery-manifest.json'), true);

        self::assertSame(82, $manifest['method_count']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Google Cloud Storage', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());

        foreach ($provider->tools() as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], '\\') + 1);
            self::assertFileExists(__DIR__ . '/../../packages/google-cloud-storage/src/Tools/' . $shortName . '.php');
        }

        $manifestTools = array_column($manifest['methods'], 'tool');
        $providerTools = array_keys($provider->tools());
        sort($manifestTools);
        sort($providerTools);
        self::assertSame($manifestTools, $providerTools);
        self::assertContains('google_cloud_storage_buckets_list', $manifestTools);
        self::assertContains('google_cloud_storage_objects_insert', $manifestTools);
        self::assertContains('google_cloud_storage_projects_hmac_keys_create', $manifestTools);
    }

    public function test_service_maps_auth_path_query_body_and_media_upload(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new GoogleCloudStorageService('token-test', 'https://example.test/storage/v1');
        $service->request('GET', '/b', [], [], ['project' => 'project-1', 'maxResults' => 5]);
        $service->request('PATCH', '/b/{bucket}/o/{object}', ['bucket' => 'bucket-1', 'object' => 'path/to.txt'], [], ['generation' => '1'], ['metadata' => ['k' => 'v']]);
        $service->request('POST', '/b/{bucket}/o', ['bucket' => 'bucket-1'], [], ['name' => 'hello.txt'], ['content' => 'hello', 'content_type' => 'text/plain'], true, '/upload/storage/v1/b/{bucket}/o');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/storage/v1/b?project=project-1&maxResults=5'
            && $request->hasHeader('Authorization', 'Bearer token-test'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH'
            && $request->url() === 'https://example.test/storage/v1/b/bucket-1/o/path%2Fto.txt?generation=1'
            && $request['metadata']['k'] === 'v');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/upload/storage/v1/b/bucket-1/o?name=hello.txt&uploadType=media'
            && $request->body() === 'hello'
            && $request->hasHeader('Content-Type', 'text/plain'));
    }

    public function test_tools_filter_query_require_path_params_and_support_download_flag(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);
        $service = new GoogleCloudStorageService('token-test');

        $list = new GoogleCloudStorageBucketsList($service);
        $result = $list->execute(['project' => 'project-1', 'maxResults' => 10, 'unknown' => 'ignored']);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://storage.googleapis.com/storage/v1/b?')
            && str_contains($request->url(), 'project=project-1')
            && str_contains($request->url(), 'maxResults=10'));

        $missingPath = (new GoogleCloudStorageObjectsGet($service))->execute(['bucket' => 'bucket-1']);
        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('object must be', (string) $missingPath->error);

        $upload = (new GoogleCloudStorageObjectsInsert($service))->execute([
            'bucket' => 'bucket-1',
            'name' => 'hello.txt',
            'body' => ['content' => 'hello', 'content_type' => 'text/plain'],
        ]);
        self::assertTrue($upload->succeeded());
    }
}
