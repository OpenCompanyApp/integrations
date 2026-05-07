<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\DailyCo;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\DailyCo\DailyCoService;
use OpenCompany\Integrations\DailyCo\DailyCoToolProvider;
use OpenCompany\Integrations\DailyCo\Tools\DailyCoGetMeetingParticipants;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Daily REST API coverage and request mapping.
 */
final class DailyCoServiceTest extends TestCase
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

    public function test_provider_exposes_official_daily_sdk_surface(): void
    {
        $provider = new DailyCoToolProvider;
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://docs.daily.co/reference/rest-api', $provider->integrationMeta()['docs_url']);
        self::assertCount(54, $tools);
        self::assertArrayHasKey('daily_co_list_rooms', $tools);
        self::assertArrayHasKey('daily_co_create_meeting_token', $tools);
        self::assertArrayHasKey('daily_co_get_meeting_participants', $tools);
        self::assertArrayHasKey('daily_co_room_recordings_start', $tools);
        self::assertArrayHasKey('daily_co_list_transcripts', $tools);
        self::assertArrayHasKey('daily_co_list_webhooks', $tools);

        foreach ($tools as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], '\\') + 1);
            self::assertFileExists(__DIR__.'/../../packages/daily-co/src/Tools/'.$shortName.'.php');
        }

        self::assertFileExists((string) $provider->luaDocsPath());
    }

    public function test_service_maps_path_query_json_and_bearer_requests(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new DailyCoService('daily-token', 'https://api.example.test/v1');
        $service->call('daily_co_list_rooms', ['limit' => 5]);
        $service->call('daily_co_room_recordings_start', [
            'room_name' => 'team sync',
            'payload' => ['type' => 'cloud'],
        ]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/v1/rooms?limit=5'
            && $request->hasHeader('Authorization', 'Bearer daily-token'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/v1/rooms/team%20sync/recordings/start'
            && $request->hasHeader('Authorization', 'Bearer daily-token')
            && $request['type'] === 'cloud');
    }

    public function test_tools_report_missing_required_path_arguments(): void
    {
        $tool = new DailyCoGetMeetingParticipants(new DailyCoService('daily-token'));
        $result = $tool->execute([]);

        self::assertFalse($result->succeeded());
        self::assertStringContainsString('meeting is required', (string) $result->error);
    }
}
