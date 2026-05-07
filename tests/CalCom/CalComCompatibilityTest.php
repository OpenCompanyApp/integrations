<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\CalCom;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\CalCom\CalComService;
use OpenCompany\Integrations\CalCom\CalComToolProvider;
use OpenCompany\Integrations\CalCom\Tools\CalComCreateBooking;
use OpenCompany\Integrations\CalCom\Tools\CalComGetBooking;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for the legacy cal-com package alias.
 */
final class CalComCompatibilityTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_legacy_service_delegates_to_canonical_v2_paths(): void
    {
        Http::fake([
            'https://api.cal.test/v2/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new CalComService('cal_test', 'https://api.cal.test/v2');

        $service->getCurrentUser();
        $service->getBooking('booking_uid');
        $service->listTeams(10, 1);
        $service->createBooking(123, '2026-05-07T10:00:00Z', '2026-05-07T10:30:00Z', [
            'name' => 'Jane Example',
            'email' => 'jane@example.test',
        ]);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer cal_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.cal.test/v2/me');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.cal.test/v2/bookings/booking_uid');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.cal.test/v2/teams?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.cal.test/v2/bookings' && $request['eventTypeId'] === 123);
    }

    public function test_legacy_tools_keep_old_slugs_but_accept_updated_parameters(): void
    {
        Http::fake([
            'https://api.cal.test/v2/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new CalComService('cal_test', 'https://api.cal.test/v2');

        self::assertTrue((new CalComCreateBooking($service))->execute([
            'event_type_id' => 123,
            'start' => '2026-05-07T10:00:00Z',
            'end' => '2026-05-07T10:30:00Z',
            'responses' => [
                'name' => 'Jane Example',
                'email' => 'jane@example.test',
            ],
        ])->succeeded());
        self::assertTrue((new CalComGetBooking($service))->execute([
            'id' => 'booking_uid',
        ])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.cal.test/v2/bookings');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.cal.test/v2/bookings/booking_uid');
    }

    public function test_provider_is_hidden_legacy_alias_with_current_connection_probe(): void
    {
        Http::fake([
            'https://api.cal.com/v2/me' => Http::response(['user' => ['name' => 'Jane Example']], 200),
        ]);

        $provider = new CalComToolProvider();

        self::assertSame('hidden', $provider->integrationMeta()['catalog_visibility']);
        self::assertSame('https://cal.com/docs/api-reference/v2/introduction', $provider->integrationMeta()['docs_url']);
        self::assertTrue($provider->testConnection(['access_token' => 'cal_test'])['success']);
    }
}
