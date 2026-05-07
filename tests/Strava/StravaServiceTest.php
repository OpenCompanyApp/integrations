<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Strava;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Strava\StravaService;
use OpenCompany\Integrations\Strava\StravaToolProvider;
use OpenCompany\Integrations\Strava\Tools\StravaApiGet;
use OpenCompany\Integrations\Strava\Tools\StravaGetActivityStreams;
use OpenCompany\Integrations\Strava\Tools\StravaUpdateActivity;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for expanded Strava API coverage.
 */
final class StravaServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_activities_athletes_clubs_routes_segments_uploads_and_generic_endpoints(): void
    {
        Http::fake([
            'https://www.strava.com/api/v3/routes/route_1/export_gpx' => Http::response('<gpx />', 200, ['Content-Type' => 'application/gpx+xml']),
            'https://www.strava.com/api/v3/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new StravaService('strava_test');

        $service->getAthlete();
        $service->getAthleteStats(123);
        $service->getAthleteZones();
        $service->listActivities(2, 20, 200, 100);
        $service->getActivity(111);
        $service->createActivity('Morning Run', 'Run', '2026-05-08T10:00:00', 1800, ['distance' => 5000]);
        $service->updateActivity(111, ['name' => 'Updated']);
        $service->getActivityStreams(111, ['time', 'distance', 'latlng'], 'medium', 'time');
        $service->listActivityLaps(111);
        $service->getActivityZones(111);
        $service->getUpload(222);
        $service->listClubs(1, 10);
        $service->getClub(333);
        $service->listClubActivities(333, 1, 10);
        $service->listClubMembers(333, 1, 10);
        $service->listRoutes(123, 1, 10);
        $service->getRoute(444);
        $service->exportRoute(444, 'gpx');
        $service->getRouteStreams(444);
        $service->listStarredSegments(1, 10);
        $service->getSegment(555);
        $service->starSegment(555, true);
        $service->exploreSegments([37.7, -122.5, 37.8, -122.4], 'ride');
        $service->listSegmentEfforts(555, ['page' => 1]);
        $service->getSegmentEffort(666);
        $service->getSegmentStreams(555, ['distance', 'altitude']);
        $service->apiGet('/athlete');
        $service->apiPost('/activities', ['name' => 'Manual']);
        $service->apiPut('/activities/111', ['name' => 'Updated']);
        $service->apiDelete('/custom/111');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer strava_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://www.strava.com/api/v3/athlete');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://www.strava.com/api/v3/athletes/123/stats');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://www.strava.com/api/v3/athlete/zones');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://www.strava.com/api/v3/athlete/activities?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://www.strava.com/api/v3/activities/111');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://www.strava.com/api/v3/activities');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://www.strava.com/api/v3/activities/111');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://www.strava.com/api/v3/activities/111/streams?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://www.strava.com/api/v3/activities/111/laps');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://www.strava.com/api/v3/activities/111/zones');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://www.strava.com/api/v3/uploads/222');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://www.strava.com/api/v3/athlete/clubs?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://www.strava.com/api/v3/clubs/333');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://www.strava.com/api/v3/clubs/333/activities?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://www.strava.com/api/v3/clubs/333/members?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://www.strava.com/api/v3/athletes/123/routes?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://www.strava.com/api/v3/routes/444');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://www.strava.com/api/v3/routes/444/export_gpx');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://www.strava.com/api/v3/routes/444/streams');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://www.strava.com/api/v3/segments/starred?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://www.strava.com/api/v3/segments/555');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://www.strava.com/api/v3/segments/555/starred');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://www.strava.com/api/v3/segments/explore?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://www.strava.com/api/v3/segment_efforts?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://www.strava.com/api/v3/segment_efforts/666');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://www.strava.com/api/v3/segments/555/streams?'));
    }

    public function test_new_tools_delegate_and_validate_required_arguments(): void
    {
        Http::fake([
            'https://www.strava.com/api/v3/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new StravaService('strava_test');

        self::assertTrue((new StravaUpdateActivity($service))->execute([
            'activity_id' => 111,
            'payload' => ['name' => 'Updated'],
        ])->succeeded());
        self::assertTrue((new StravaGetActivityStreams($service))->execute([
            'activity_id' => 111,
            'keys' => ['time', 'distance'],
        ])->succeeded());
        self::assertTrue((new StravaApiGet($service))->execute([
            'path' => '/athlete',
        ])->succeeded());
        self::assertFalse((new StravaUpdateActivity($service))->execute([
            'activity_id' => 111,
        ])->succeeded());
        self::assertFalse((new StravaGetActivityStreams($service))->execute([
            'activity_id' => 111,
        ])->succeeded());
        self::assertFalse((new StravaApiGet($service))->execute([
            'path' => 'https://example.test/athlete',
        ])->succeeded());
    }

    public function test_provider_exposes_expanded_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://www.strava.com/api/v3/athlete' => Http::response(['firstname' => 'Ada', 'lastname' => 'Runner'], 200),
        ]);

        $provider = new StravaToolProvider();
        $tools = $provider->tools();

        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertArrayHasKey('strava_update_activity', $tools);
        self::assertArrayHasKey('strava_get_activity_streams', $tools);
        self::assertArrayHasKey('strava_upload_activity', $tools);
        self::assertArrayHasKey('strava_list_club_members', $tools);
        self::assertArrayHasKey('strava_get_route_streams', $tools);
        self::assertArrayHasKey('strava_explore_segments', $tools);
        self::assertArrayHasKey('strava_api_delete', $tools);
        self::assertSame(32, count($tools));
        self::assertTrue($provider->testConnection([
            'access_token' => 'strava_test',
        ])['success']);
    }
}
