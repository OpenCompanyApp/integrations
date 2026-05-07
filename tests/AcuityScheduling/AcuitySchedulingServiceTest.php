<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\AcuityScheduling;

use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\AcuityScheduling\AcuitySchedulingService;
use OpenCompany\Integrations\AcuityScheduling\AcuitySchedulingToolProvider;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityApiGet;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityCreateAppointment;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityCreateWebhook;
use OpenCompany\Integrations\AcuityScheduling\Tools\AcuityRescheduleAppointment;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Acuity Scheduling API authentication and endpoint coverage.
 */
final class AcuitySchedulingServiceTest extends TestCase
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

    public function test_service_maps_core_v1_endpoints_with_basic_auth(): void
    {
        Http::fake([
            'https://acuity.test/api/v1/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new AcuitySchedulingService('', 'https://acuity.test/api/v1', 'user_test', 'key_test');

        $service->listAppointments(['max' => 10, 'calendarID' => 1]);
        $service->getAppointment(123);
        $service->createAppointment(['datetime' => '2026-05-07T10:00:00-0400', 'appointmentTypeID' => 456]);
        $service->updateAppointment(123, ['notes' => 'Updated']);
        $service->rescheduleAppointment(123, ['datetime' => '2026-05-08T10:00:00-0400', 'admin' => true]);
        $service->listAppointmentPayments(123);
        $service->listClients(['email' => 'jane@example.test']);
        $service->createClient(['email' => 'jane@example.test']);
        $service->updateClient(['email' => 'jane@example.test'], ['firstName' => 'Jane']);
        $service->listCalendars();
        $service->listAppointmentTypes();
        $service->getAvailability(['appointmentTypeID' => 456, 'date' => '2026-05-07']);
        $service->getAvailabilityDates(['appointmentTypeID' => 456, 'month' => '2026-05']);
        $service->getAvailabilityClasses(['month' => '2026-05']);
        $service->listForms();
        $service->listProducts();
        $service->listOrders(['max' => 10]);
        $service->getOrder(987);
        $service->createCertificate(['productID' => 55, 'email' => 'jane@example.test']);
        $service->listBlocks(['calendarID' => 1]);
        $service->createBlock(['calendarID' => 1, 'start' => '2026-05-07T13:00:00-0400']);
        $service->deleteBlock(654);
        $service->listWebhooks();
        $service->createWebhook(['event' => 'appointment.scheduled', 'target' => 'https://example.test/acuity']);
        $service->deleteWebhook(321);
        $service->getCurrentUser();
        $service->apiGet('/forms');
        $service->apiPost('/webhooks', ['event' => 'appointment.changed']);
        $service->apiPut('/appointments/123', ['notes' => 'Updated again']);
        $service->apiDelete('/webhooks/321');

        $basic = 'Basic '.base64_encode('user_test:key_test');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', $basic));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://acuity.test/api/v1/appointments?') && str_contains($request->url(), 'calendarID=1'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://acuity.test/api/v1/appointments' && $request['appointmentTypeID'] === 456);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://acuity.test/api/v1/appointments/123' && $request['notes'] === 'Updated');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://acuity.test/api/v1/appointments/123/reschedule' && $request['admin'] === true);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://acuity.test/api/v1/appointments/123/payments');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://acuity.test/api/v1/clients' && $request['email'] === 'jane@example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://acuity.test/api/v1/availability/dates?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://acuity.test/api/v1/availability/classes?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://acuity.test/api/v1/forms');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://acuity.test/api/v1/products');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://acuity.test/api/v1/orders/987');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://acuity.test/api/v1/certificates' && $request['productID'] === 55);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://acuity.test/api/v1/blocks' && $request['calendarID'] === 1);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://acuity.test/api/v1/blocks/654');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://acuity.test/api/v1/webhooks' && ($request->data()['target'] ?? null) === 'https://example.test/acuity');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://acuity.test/api/v1/webhooks/321');
    }

    public function test_service_supports_oauth_bearer_token(): void
    {
        Http::fake([
            'https://acuity.test/api/v1/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new AcuitySchedulingService('token_test', 'https://acuity.test/api/v1');
        $service->getCurrentUser();

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer token_test'));
    }

    public function test_tools_delegate_to_service(): void
    {
        Http::fake([
            'https://acuity.test/api/v1/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new AcuitySchedulingService('', 'https://acuity.test/api/v1', 'user_test', 'key_test');

        self::assertTrue((new AcuityCreateAppointment($service))->execute([
            'body' => ['datetime' => '2026-05-07T10:00:00-0400', 'appointmentTypeID' => 456],
        ])->succeeded());
        self::assertTrue((new AcuityRescheduleAppointment($service))->execute([
            'id' => 123,
            'body' => ['datetime' => '2026-05-08T10:00:00-0400'],
        ])->succeeded());
        self::assertTrue((new AcuityCreateWebhook($service))->execute([
            'body' => ['event' => 'appointment.changed', 'target' => 'https://example.test/acuity'],
        ])->succeeded());
        self::assertTrue((new AcuityApiGet($service))->execute([
            'path' => '/forms',
        ])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://acuity.test/api/v1/appointments');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://acuity.test/api/v1/appointments/123/reschedule');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://acuity.test/api/v1/webhooks');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://acuity.test/api/v1/forms');
    }

    public function test_provider_exposes_expanded_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://acuityscheduling.com/api/v1/me' => Http::response(['name' => 'Jane Example'], 200),
        ]);

        $provider = new AcuitySchedulingToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://developers.acuityscheduling.com/reference', $provider->integrationMeta()['docs_url']);
        self::assertArrayHasKey('acuity_create_appointment', $tools);
        self::assertArrayHasKey('acuity_reschedule_appointment', $tools);
        self::assertArrayHasKey('acuity_get_availability_dates', $tools);
        self::assertArrayHasKey('acuity_list_forms', $tools);
        self::assertArrayHasKey('acuity_create_webhook', $tools);
        self::assertArrayHasKey('acuity_api_get', $tools);
        self::assertSame(31, count($tools));
        self::assertTrue($provider->testConnection([
            'user_id' => 'user_test',
            'api_key' => 'key_test',
        ])['success']);
    }
}
