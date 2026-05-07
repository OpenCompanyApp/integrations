<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Baserow;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Baserow\BaserowService;
use OpenCompany\Integrations\Baserow\BaserowToolProvider;
use OpenCompany\Integrations\Baserow\Tools\BaserowApiGet;
use OpenCompany\Integrations\Baserow\Tools\BaserowCreateField;
use OpenCompany\Integrations\Baserow\Tools\BaserowMoveRow;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Baserow REST API integration.
 */
final class BaserowServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(BaserowService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(BaserowService::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_category_docs_and_auth_scheme(): void
    {
        $provider = new BaserowToolProvider;

        self::assertSame('baserow', $provider->appName());
        self::assertSame('Baserow', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertCount(24, $provider->tools());
        self::assertArrayHasKey('baserow_list_database_tables', $provider->tools());
        self::assertArrayHasKey('baserow_create_field', $provider->tools());
        self::assertArrayHasKey('baserow_batch_update', $provider->tools());
        self::assertArrayHasKey('baserow_move_row', $provider->tools());
        self::assertArrayHasKey('baserow_api_delete', $provider->tools());
        self::assertContains('auth_scheme', array_column($provider->credentialFields(), 'key'));
    }

    public function test_service_maps_table_field_row_batch_and_raw_paths(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new BaserowService('token-test', 'https://example.test', 'Token');
        $service->listDatabases(2, 50);
        $service->listAllTables(['include' => ['id', 'name']]);
        $service->listDatabaseTables(123);
        $service->getTable(456);
        $service->listFields(456);
        $service->createField(456, ['name' => 'Status', 'type' => 'text']);
        $service->updateField(789, ['name' => 'Lifecycle']);
        $service->deleteField(789);
        $service->listRows(456, ['search' => 'Acme', 'include' => ['one', 'two']]);
        $service->getRow(456, 1, ['user_field_names' => true]);
        $service->createRow(456, ['Name' => 'Acme'], ['user_field_names' => true]);
        $service->updateRow(456, 1, ['Name' => 'Globex']);
        $service->moveRow(456, 1, ['before_id' => 2]);
        $service->deleteRow(456, 1);
        $service->batchCreate(456, [['Name' => 'Acme']]);
        $service->batchUpdate(456, [['id' => 1, 'Name' => 'Globex']]);
        $service->batchDelete(456, [1, 2]);
        $service->apiGet('/api/database/fields/table/456/', ['include' => ['id', 'name']]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/api/applications/?page=2&size=50'
            && $request->hasHeader('Authorization', 'Token token-test'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/api/database/tables/all-tables/?include=id&include=name');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/api/database/tables/database/123/');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/api/database/fields/table/456/'
            && $request['name'] === 'Status');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/api/database/rows/table/456/?search=Acme&include=one&include=two');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/api/database/rows/table/456/?user_field_names=true'
            && $request['Name'] === 'Acme');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH'
            && $request->url() === 'https://example.test/api/database/rows/table/456/1/move/?before_id=2');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://example.test/api/database/rows/table/456/batch/'
            && $request['items'] === [1, 2]);

        $this->expectException(\RuntimeException::class);
        $service->apiGet('https://evil.example.test/api/user/');
    }

    public function test_tools_validate_arguments_and_unconfigured_service(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new BaserowService('token-test', 'https://example.test', 'Token');
        $field = (new BaserowCreateField($service))->execute([
            'table_id' => 456,
            'payload' => ['name' => 'Status', 'type' => 'text'],
        ]);
        $move = (new BaserowMoveRow($service))->execute([
            'table_id' => 456,
            'row_id' => 1,
            'before_id' => 2,
        ]);
        $raw = (new BaserowApiGet($service))->execute([
            'path' => '/api/database/fields/table/456/',
        ]);

        self::assertTrue($field->succeeded());
        self::assertTrue($move->succeeded());
        self::assertTrue($raw->succeeded());

        $missing = (new BaserowCreateField($service))->execute(['payload' => []]);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('table_id is required', (string) $missing->error);

        $unconfigured = (new BaserowApiGet(new BaserowService('', 'https://example.test')))->execute([
            'path' => '/api/user/',
        ]);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_uses_configured_auth_scheme_and_database_endpoint(): void
    {
        Http::fake(['*' => Http::response(['results' => []], 200)]);

        $result = (new BaserowToolProvider)->testConnection([
            'access_token' => 'token-test',
            'auth_scheme' => 'JWT',
            'url' => 'https://example.test',
        ]);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/api/database/tables/all-tables/'
            && $request->hasHeader('Authorization', 'JWT token-test'));
    }
}
