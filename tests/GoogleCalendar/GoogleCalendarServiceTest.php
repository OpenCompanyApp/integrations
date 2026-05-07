<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\GoogleCalendar;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\GoogleCalendar\GoogleCalendarService;
use OpenCompany\Integrations\GoogleCalendar\GoogleCalendarToolProvider;
use OpenCompany\Integrations\GoogleCalendar\Tools\GoogleCalendarEventsInsert;
use OpenCompany\Integrations\GoogleCalendar\Tools\GoogleCalendarEventsList;
use OpenCompany\Integrations\GoogleCalendar\Tools\GoogleCalendarCalendarsGet;
use PHPUnit\Framework\TestCase;

final class GoogleCalendarServiceTest extends TestCase
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

    public function test_provider_matches_discovery_manifest_and_docs(): void
    {
        $provider = new GoogleCalendarToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__ . '/../../packages/google-calendar/google-calendar-discovery-manifest.json'), true);

        self::assertSame(37, $manifest['method_count']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Google Calendar', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertContains('google_calendar_events_list', array_keys($provider->tools()));
        self::assertContains('google_calendar_freebusy_query', array_keys($provider->tools()));
        self::assertContains('google_calendar_acl_watch', array_keys($provider->tools()));
    }

    public function test_service_maps_auth_paths_query_repeated_values_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new GoogleCalendarService('token-test', 'https://example.test/calendar/v3');
        $service->request('GET', '/calendars/{calendarId}/events', ['calendarId' => 'primary'], [], ['eventTypes' => ['default', 'focusTime'], 'singleEvents' => true]);
        $service->request('POST', '/calendars/{calendarId}/events', ['calendarId' => 'primary'], [], ['sendUpdates' => 'all'], ['summary' => 'Planning']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/calendar/v3/calendars/primary/events?eventTypes=default&eventTypes=focusTime&singleEvents=1'
            && $request->hasHeader('Authorization', 'Bearer token-test'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/calendar/v3/calendars/primary/events?sendUpdates=all'
            && $request['summary'] === 'Planning');
    }

    public function test_tools_filter_query_require_path_params_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);
        $service = new GoogleCalendarService('token-test');

        $list = new GoogleCalendarEventsList($service);
        $result = $list->execute(['calendarId' => 'primary', 'maxResults' => 10, 'unknown' => 'ignored']);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://www.googleapis.com/calendar/v3/calendars/primary/events?maxResults=10');

        $missingPath = (new GoogleCalendarCalendarsGet($service))->execute([]);
        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('calendarId must be', (string) $missingPath->error);

        $missingBody = (new GoogleCalendarEventsInsert($service))->execute(['calendarId' => 'primary']);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be', (string) $missingBody->error);
    }
}
