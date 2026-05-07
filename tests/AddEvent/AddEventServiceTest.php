<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\AddEvent;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\AddEvent\AddEventService;
use OpenCompany\Integrations\AddEvent\AddEventToolProvider;
use OpenCompany\Integrations\AddEvent\Tools\AddEventCreateEvent;
use OpenCompany\Integrations\AddEvent\Tools\AddEventListCalendars;
use OpenCompany\Integrations\AddEvent\Tools\AddEventUpdateEvent;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for AddEvent Calendar and Events API v2 mapping.
 */
final class AddEventServiceTest extends TestCase
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

    public function test_provider_metadata_matches_v2_api(): void
    {
        $provider = new AddEventToolProvider;

        self::assertSame('AddEvent', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertSame(['access_token'], $provider->integrationCapabilities()['auth']['token_keys']);
        self::assertCount(9, $provider->tools());
        self::assertSame(['access_token', 'url'], array_column($provider->credentialFields(), 'key'));
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertArrayHasKey('addevent_update_event', $provider->tools());
        self::assertArrayHasKey('addevent_create_calendar', $provider->tools());
    }

    public function test_service_uses_calendar_event_v2_endpoints_and_json_payloads(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new AddEventService('api_key', 'https://api.example.test');
        $service->listEvents(2, 50, 'cal_123', 'created', 'desc');
        $service->getEvent('evt 1');
        $service->createEvent(['title' => 'Demo', 'datetime_start' => '2026-04-10 09:00:00', 'calendar_id' => 'cal_123']);
        $service->updateEvent('evt_1', ['title' => 'Updated']);
        $service->deleteEvent('evt_1');
        $service->listCalendars(1, 10, ['cal_123'], 'title', 'asc');
        $service->getCalendar('cal_123');
        $service->createCalendar(['title' => 'Webinars', 'timezone' => 'America/New_York']);
        $service->listTimezones();

        Http::assertSent(fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/calevent/v2/events?page=2&page_size=20&sort_by=created&sort_order=desc&calendar_id=cal_123'
            && $request->hasHeader('Authorization', 'Bearer api_key'));

        Http::assertSent(fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/calevent/v2/events/evt%201');

        Http::assertSent(function (Request $request): bool {
            $body = $request->data();

            return $request->method() === 'POST'
                && $request->url() === 'https://api.example.test/calevent/v2/events'
                && ($body['title'] ?? '') === 'Demo'
                && ($body['datetime_start'] ?? '') === '2026-04-10 09:00:00'
                && ($body['calendar_id'] ?? '') === 'cal_123';
        });

        Http::assertSent(fn (Request $request): bool => $request->method() === 'PATCH'
            && $request->url() === 'https://api.example.test/calevent/v2/events/evt_1'
            && ($request->data()['title'] ?? '') === 'Updated');

        Http::assertSent(fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://api.example.test/calevent/v2/events/evt_1');

        Http::assertSent(fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/calevent/v2/calendars?page=1&page_size=10&sort_by=title&sort_order=asc&calendar_ids=cal_123');

        Http::assertSent(fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/calevent/v2/calendars/cal_123');

        Http::assertSent(fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/calevent/v2/calendars'
            && ($request->data()['title'] ?? '') === 'Webinars');

        Http::assertSent(fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/calevent/v2/timezones');
    }

    public function test_tools_validate_required_payloads(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new AddEventService('api_key', 'https://api.example.test/calevent/v2');

        self::assertTrue((new AddEventCreateEvent($service))->execute([
            'title' => 'Demo',
            'datetime_start' => '2026-04-10 09:00:00',
        ])->succeeded());

        self::assertTrue((new AddEventListCalendars($service))->execute([
            'calendar_ids' => ['cal_123'],
            'page_size' => 10,
        ])->succeeded());

        self::assertTrue((new AddEventUpdateEvent($service))->execute([
            'id' => 'evt_123',
            'attributes' => ['title' => 'Updated'],
        ])->succeeded());

        $missingStart = (new AddEventCreateEvent($service))->execute(['title' => 'Demo']);
        $badUpdate = (new AddEventUpdateEvent($service))->execute(['id' => 'evt_123', 'attributes' => []]);

        self::assertFalse($missingStart->succeeded());
        self::assertStringContainsString('datetime_start is required', (string) $missingStart->error);
        self::assertFalse($badUpdate->succeeded());
        self::assertStringContainsString('non-empty object', (string) $badUpdate->error);
    }

    public function test_connection_uses_search_events_endpoint(): void
    {
        Http::fake(['api.example.test/calevent/v2/events*' => Http::response(['events' => []], 200)]);

        $result = (new AddEventToolProvider)->testConnection([
            'access_token' => 'api_key',
            'url' => 'https://api.example.test/calevent/v2',
        ]);

        self::assertTrue($result['success']);
        Http::assertSent(fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/calevent/v2/events?page_size=1'
            && $request->hasHeader('Authorization', 'Bearer api_key'));
    }
}
