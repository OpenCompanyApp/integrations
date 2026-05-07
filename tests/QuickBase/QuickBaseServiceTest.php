<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\QuickBase;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\QuickBase\QuickBaseService;
use OpenCompany\Integrations\QuickBase\QuickBaseToolProvider;
use OpenCompany\Integrations\QuickBase\Tools\QuickBaseApiGet;
use OpenCompany\Integrations\QuickBase\Tools\QuickBaseCreateField;
use OpenCompany\Integrations\QuickBase\Tools\QuickBaseUpsertRecords;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for expanded Quickbase REST API coverage.
 */
final class QuickBaseServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_apps_tables_fields_records_reports_relationships_and_generic_helpers(): void
    {
        Http::fake([
            'https://api.quickbase.com/v1/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new QuickBaseService('qb_test', 'example.quickbase.com');

        $service->listApps(['name' => 'Ops']);
        $service->getApp('app1');
        $service->createApp(['name' => 'Ops']);
        $service->copyApp('app1', ['name' => 'Ops Copy']);
        $service->deleteApp('app1', 'Ops');
        $service->listTables('app1');
        $service->createTable('app1', ['name' => 'Tickets']);
        $service->updateTable('tbl1', ['name' => 'Cases']);
        $service->deleteTable('tbl1');
        $service->listFields('tbl1', ['includeFieldPerms' => true]);
        $service->getField('tbl1', 6);
        $service->createField('tbl1', ['label' => 'Status', 'fieldType' => 'text']);
        $service->updateField('tbl1', 6, ['label' => 'State']);
        $service->deleteField('tbl1', 6);
        $service->upsertRecords('tbl1', [[6 => ['value' => 'Open']]], 3, [3, 6]);
        $service->deleteRecords('tbl1', "{6.EX.'Closed'}");
        $service->listReports('tbl1');
        $service->getReport('tbl1', '7');
        $service->runReport('tbl1', '7', ['skip' => 0]);
        $service->listRelationships('tbl1');
        $service->createRelationship('tbl1', ['childTableId' => 'tbl2']);
        $service->deleteRelationship('tbl1', 10);
        $service->apiGet('/apps');
        $service->apiPost('/records', ['to' => 'tbl1'], ['appId' => 'app1']);
        $service->apiDelete('/records', ['from' => 'tbl1', 'where' => "{3.EX.'1'}"]);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer qb_test'));
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('QB-Realm-Hostname', 'example.quickbase.com'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.quickbase.com/v1/apps?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.quickbase.com/v1/apps/app1/copy');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.quickbase.com/v1/tables?appId=app1'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && str_starts_with($request->url(), 'https://api.quickbase.com/v1/tables?appId=app1'));
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), '/fields?tableId=tbl1'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.quickbase.com/v1/fields/6?tableId=tbl1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.quickbase.com/v1/records');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.quickbase.com/v1/records');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.quickbase.com/v1/reports?tableId=tbl1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.quickbase.com/v1/reports/7/run?tableId=tbl1');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.quickbase.com/v1/tables/tbl1/relationships');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.quickbase.com/v1/tables/tbl1/relationships/10');
    }

    public function test_new_tools_delegate_and_validate_required_arguments(): void
    {
        Http::fake([
            'https://api.quickbase.com/v1/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new QuickBaseService('qb_test', 'example.quickbase.com');

        self::assertTrue((new QuickBaseCreateField($service))->execute([
            'tableId' => 'tbl1',
            'body' => ['label' => 'Status', 'fieldType' => 'text'],
        ])->succeeded());
        self::assertTrue((new QuickBaseUpsertRecords($service))->execute([
            'tableId' => 'tbl1',
            'data' => [[6 => ['value' => 'Open']]],
        ])->succeeded());
        self::assertTrue((new QuickBaseApiGet($service))->execute([
            'path' => '/apps',
        ])->succeeded());
        self::assertFalse((new QuickBaseCreateField($service))->execute([
            'tableId' => 'tbl1',
            'body' => [],
        ])->succeeded());
    }

    public function test_provider_exposes_expanded_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://api.quickbase.com/v1/user' => Http::response(['firstName' => 'Example', 'lastName' => 'User'], 200),
        ]);

        $provider = new QuickBaseToolProvider();
        $tools = $provider->tools();

        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertArrayHasKey('quickbase_list_apps', $tools);
        self::assertArrayHasKey('quickbase_list_fields', $tools);
        self::assertArrayHasKey('quickbase_upsert_records', $tools);
        self::assertArrayHasKey('quickbase_run_report', $tools);
        self::assertArrayHasKey('quickbase_list_relationships', $tools);
        self::assertArrayHasKey('quickbase_api_delete', $tools);
        self::assertSame(30, count($tools));
        self::assertTrue($provider->testConnection([
            'access_token' => 'qb_test',
            'realm_hostname' => 'example.quickbase.com',
        ])['success']);
    }
}
