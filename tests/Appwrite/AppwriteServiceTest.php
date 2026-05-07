<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Appwrite;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Appwrite\AppwriteService;
use OpenCompany\Integrations\Appwrite\AppwriteToolProvider;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteCreateBucket;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteCreateDatabase;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteCreateExecution;
use OpenCompany\Integrations\Appwrite\Tools\AppwriteCreatePush;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Appwrite server REST endpoint mapping.
 */
final class AppwriteServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_core_server_rest_endpoints(): void
    {
        Http::fake([
            'https://example.test/v1/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new AppwriteService('key_test', 'project_test', 'https://example.test/v1');

        $service->listDatabases(['queries' => ['limit(10)'], 'search' => 'crm']);
        $service->getDatabase('crm');
        $service->createDocument('crm', 'contacts', ['documentId' => 'unique()', 'data' => ['name' => 'Ada']]);
        $service->apiPatch('/databases/crm/collections/contacts/documents/doc_1', ['data' => ['name' => 'Grace']]);
        $service->apiDelete('/storage/buckets/imports/files/file_1');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('X-Appwrite-Key', 'key_test') && $request->hasHeader('X-Appwrite-Project', 'project_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://example.test/v1/databases?') && str_contains($request->url(), 'queries%5B%5D=limit%2810%29') && str_contains($request->url(), 'search=crm'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://example.test/v1/databases/crm');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://example.test/v1/databases/crm/collections/contacts/documents' && $request['documentId'] === 'unique()');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://example.test/v1/databases/crm/collections/contacts/documents/doc_1' && $request['data']['name'] === 'Grace');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://example.test/v1/storage/buckets/imports/files/file_1');
    }

    public function test_endpoint_tools_map_snake_case_arguments_to_appwrite_payloads(): void
    {
        Http::fake([
            'https://example.test/v1/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new AppwriteService('key_test', 'project_test', 'https://example.test/v1');

        self::assertNull((new AppwriteCreateDatabase($service))->execute([
            'database_id' => 'crm',
            'name' => 'CRM',
        ])->error);

        self::assertNull((new AppwriteCreateBucket($service))->execute([
            'bucket_id' => 'imports',
            'name' => 'Imports',
            'file_security' => true,
            'maximum_file_size' => 1024,
            'allowed_file_extensions' => ['csv'],
        ])->error);

        self::assertNull((new AppwriteCreateExecution($service))->execute([
            'function_id' => 'sync',
            'body' => '{"dry_run":true}',
            'scheduled_at' => '2026-05-07T12:00:00Z',
        ])->error);

        self::assertNull((new AppwriteCreatePush($service))->execute([
            'message_id' => 'msg_1',
            'title' => 'Update',
            'body' => 'Ready',
            'scheduled_at' => '2026-05-07T12:00:00Z',
        ])->error);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://example.test/v1/databases' && $request['databaseId'] === 'crm');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://example.test/v1/storage/buckets' && $request['bucketId'] === 'imports' && $request['fileSecurity'] === true && $request['maximumFileSize'] === 1024 && $request['allowedFileExtensions'] === ['csv']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://example.test/v1/functions/sync/executions' && $request['scheduledAt'] === '2026-05-07T12:00:00Z');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://example.test/v1/messaging/messages/push' && $request['messageId'] === 'msg_1' && $request['scheduledAt'] === '2026-05-07T12:00:00Z');
    }

    public function test_provider_exposes_expanded_catalog_metadata(): void
    {
        Http::fake([
            'https://example.test/v1/databases' => Http::response(['databases' => []], 200),
        ]);

        $provider = new AppwriteToolProvider();
        $tools = $provider->tools();

        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('https://appwrite.io/docs/references/cloud/server-rest', $provider->integrationMeta()['docs_url']);
        self::assertSame(46, count($tools));
        self::assertArrayHasKey('appwrite_create_database', $tools);
        self::assertArrayHasKey('appwrite_update_document', $tools);
        self::assertArrayHasKey('appwrite_list_users', $tools);
        self::assertArrayHasKey('appwrite_list_buckets', $tools);
        self::assertArrayHasKey('appwrite_create_execution', $tools);
        self::assertArrayHasKey('appwrite_create_push', $tools);

        self::assertTrue($provider->testConnection([
            'api_key' => 'key_test',
            'project_id' => 'project_test',
            'url' => 'https://example.test/v1',
        ])['success']);
    }
}
