<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Cal;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Cal\CalService;
use OpenCompany\Integrations\Cal\CalToolProvider;
use OpenCompany\Integrations\Cal\Tools\CalApiGet;
use OpenCompany\Integrations\Cal\Tools\CalCancelBooking;
use OpenCompany\Integrations\Cal\Tools\CalCreateBooking;
use OpenCompany\Integrations\Cal\Tools\CalListEventTypes;
use OpenCompany\Integrations\Cal\Tools\CalRescheduleBooking;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Cal.com API v2 request mapping and tool catalog coverage.
 */
final class CalServiceTest extends TestCase
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
        Container::getInstance()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_service_maps_core_v2_endpoints_and_bearer_auth(): void
    {
        Http::fake([
            'https://api.cal.test/v2/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new CalService('cal_test', 'https://api.cal.test/v2');

        $service->listEventTypes(10, 1, 2);
        $service->getEventType(123);
        $service->listBookings(10, 1, 'upcoming', 123);
        $service->getBooking('booking_uid');
        $service->createBooking(123, '2026-05-07T10:00:00Z', '2026-05-07T10:30:00Z', [
            'name' => 'Jane Example',
            'email' => 'jane@example.test',
        ]);
        $service->cancelBooking('booking_uid', ['cancellationReason' => 'changed']);
        $service->rescheduleBooking('booking_uid', ['start' => '2026-05-08T10:00:00Z']);
        $service->getCurrentUser();
        $service->apiGet('/slots', ['eventTypeId' => 123]);
        $service->apiPatch('/event-types/123', ['title' => 'Consulting']);
        $service->apiDelete('/bookings/booking_uid');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer cal_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.cal.test/v2/event-types?') && str_contains($request->url(), 'limit=10') && str_contains($request->url(), 'page=1') && str_contains($request->url(), 'teamId=2'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.cal.test/v2/event-types/123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.cal.test/v2/bookings?') && str_contains($request->url(), 'status=upcoming') && str_contains($request->url(), 'eventTypeId=123'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.cal.test/v2/bookings/booking_uid');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.cal.test/v2/bookings' && $request['eventTypeId'] === 123 && $request['responses']['email'] === 'jane@example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.cal.test/v2/bookings/booking_uid/cancel' && $request['cancellationReason'] === 'changed');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.cal.test/v2/bookings/booking_uid/reschedule' && $request['start'] === '2026-05-08T10:00:00Z');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.cal.test/v2/me');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.cal.test/v2/slots?') && str_contains($request->url(), 'eventTypeId=123'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://api.cal.test/v2/event-types/123' && $request['title'] === 'Consulting');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.cal.test/v2/bookings/booking_uid');
    }

    public function test_tools_delegate_with_uid_and_snake_case_parameters(): void
    {
        Http::fake([
            'https://api.cal.test/v2/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new CalService('cal_test', 'https://api.cal.test/v2');

        self::assertTrue((new CalCreateBooking($service))->execute([
            'event_type_id' => 123,
            'start' => '2026-05-07T10:00:00Z',
            'end' => '2026-05-07T10:30:00Z',
            'responses' => [
                'name' => 'Jane Example',
                'email' => 'jane@example.test',
            ],
        ])->succeeded());
        self::assertTrue((new CalCancelBooking($service))->execute([
            'booking_uid' => 'booking_uid',
            'body' => ['cancellationReason' => 'changed'],
        ])->succeeded());
        self::assertTrue((new CalRescheduleBooking($service))->execute([
            'booking_uid' => 'booking_uid',
            'body' => ['start' => '2026-05-08T10:00:00Z'],
        ])->succeeded());
        self::assertTrue((new CalApiGet($service))->execute([
            'path' => '/slots',
            'params' => ['eventTypeId' => 123],
        ])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.cal.test/v2/bookings' && $request['eventTypeId'] === 123);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.cal.test/v2/bookings/booking_uid/cancel');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.cal.test/v2/bookings/booking_uid/reschedule');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.cal.test/v2/slots?'));
    }

    public function test_provider_exposes_v2_tools_and_allowed_category(): void
    {
        Http::fake([
            'https://api.cal.com/v2/me' => Http::response(['user' => ['name' => 'Jane Example']], 200),
        ]);

        $provider = new CalToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertArrayHasKey('cal_cancel_booking', $tools);
        self::assertArrayHasKey('cal_reschedule_booking', $tools);
        self::assertArrayHasKey('cal_api_get', $tools);
        self::assertArrayHasKey('cal_api_post', $tools);
        self::assertArrayHasKey('cal_api_patch', $tools);
        self::assertArrayHasKey('cal_api_delete', $tools);
        self::assertSame(12, count($tools));
        self::assertTrue($provider->testConnection(['access_token' => 'cal_test'])['success']);
    }

    public function test_canonical_package_replaces_legacy_cal_com_and_falls_back_to_legacy_credentials(): void
    {
        $canonicalComposer = json_decode((string) file_get_contents(__DIR__ . '/../../packages/cal/composer.json'), true);
        $legacyComposer = json_decode((string) file_get_contents(__DIR__ . '/../../packages/cal-com/composer.json'), true);

        self::assertSame('self.version', $canonicalComposer['replace']['opencompanyapp/integration-cal-com']);
        self::assertSame('self.version', $canonicalComposer['replace']['opencompanyapp/ai-tool-cal-com']);
        self::assertSame('opencompanyapp/integration-cal', $legacyComposer['abandoned']);

        Http::fake([
            'https://legacy.cal.example.test/v2/*' => Http::response(['data' => []], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration === 'cal') {
                    return '';
                }

                if ($integration === 'cal-com' && $account === 'work') {
                    return match ($key) {
                        'access_token' => 'legacy-cal-token',
                        'url' => 'https://legacy.cal.example.test/v2',
                        default => $default,
                    };
                }

                return $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'cal-com' && $account === 'work';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'cal-com' ? ['work'] : [];
            }
        });

        $tool = (new CalToolProvider)->createTool(CalListEventTypes::class, ['account' => 'work']);

        self::assertTrue($tool->execute([])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://legacy.cal.example.test/v2/event-types'
            && $request->hasHeader('Authorization', 'Bearer legacy-cal-token'));
    }
}
