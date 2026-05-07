<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\GoogleDriveActivity;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\GoogleDriveActivity\GoogleDriveActivityService;
use OpenCompany\Integrations\GoogleDriveActivity\GoogleDriveActivityToolProvider;
use OpenCompany\Integrations\GoogleDriveActivity\Tools\GoogleDriveActivityActivityQuery;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for the generated Google Drive Activity package.
 */
final class GoogleDriveActivityServiceTest extends TestCase
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

    public function test_service_maps_activity_query_to_official_endpoint(): void
    {
        Http::fake([
            'https://driveactivity.googleapis.com/v2/activity:query' => Http::response([
                'activities' => [],
            ], 200),
        ]);

        $service = new GoogleDriveActivityService('google_token');
        $result = $service->queryActivity([
            'itemName' => 'items/file_123',
            'pageSize' => 10,
        ]);

        self::assertSame(['activities' => []], $result);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer google_token'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://driveactivity.googleapis.com/v2/activity:query' && $request['itemName'] === 'items/file_123' && $request['pageSize'] === 10);
    }

    public function test_tool_accepts_structured_arguments_and_delegates_to_service(): void
    {
        Http::fake([
            'https://driveactivity.googleapis.com/v2/activity:query' => Http::response([
                'activities' => [],
            ], 200),
        ]);

        $tool = new GoogleDriveActivityActivityQuery(new GoogleDriveActivityService('google_token'));

        self::assertNotNull($tool->execute([])->error);
        self::assertNull($tool->execute([
            'ancestor_name' => 'items/folder_123',
            'page_size' => 5,
            'filter' => 'detail.action_detail_case:(CREATE EDIT)',
            'consolidation_strategy' => ['legacy' => new \stdClass()],
        ])->error);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://driveactivity.googleapis.com/v2/activity:query'
            && $request['ancestorName'] === 'items/folder_123'
            && $request['pageSize'] === 5
            && $request['filter'] === 'detail.action_detail_case:(CREATE EDIT)'
            && array_key_exists('legacy', $request['consolidationStrategy']));
    }

    public function test_tool_merges_raw_body_with_first_class_overrides(): void
    {
        Http::fake([
            'https://driveactivity.googleapis.com/v2/activity:query' => Http::response([
                'activities' => [],
            ], 200),
        ]);

        $tool = new GoogleDriveActivityActivityQuery(new GoogleDriveActivityService('google_token'));

        self::assertNull($tool->execute([
            'body' => [
                'itemName' => 'items/original',
                'pageSize' => 20,
            ],
            'item_name' => 'items/override',
            'page_token' => 'next-page',
        ])->error);

        Http::assertSent(static fn (Request $request): bool => $request['itemName'] === 'items/override'
            && $request['pageSize'] === 20
            && $request['pageToken'] === 'next-page');
    }

    public function test_provider_catalog_reflects_single_method_discovery_surface(): void
    {
        $provider = new GoogleDriveActivityToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://developers.google.com/workspace/drive/activity/v2/reference/rest', $provider->integrationMeta()['docs_url']);
        self::assertArrayHasKey('google_drive_activity_activity_query', $tools);
        self::assertSame(1, count($tools));
    }
}
