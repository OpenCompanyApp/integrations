<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\MicrosoftBookings;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\MicrosoftBookings\MicrosoftBookingsService;
use OpenCompany\Integrations\MicrosoftBookings\MicrosoftBookingsToolProvider;
use OpenCompany\Integrations\MicrosoftBookings\Tools\MicrosoftBookingsBookingBusinessesBookingBusinessPublish;
use OpenCompany\Integrations\MicrosoftBookings\Tools\MicrosoftBookingsBookingBusinessesCreateAppointments;
use OpenCompany\Integrations\MicrosoftBookings\Tools\MicrosoftBookingsBookingBusinessesListAppointments;
use OpenCompany\Integrations\MicrosoftBookings\Tools\MicrosoftBookingsGetBookingBusinesses;
use OpenCompany\Integrations\MicrosoftBookings\Tools\MicrosoftBookingsListBookingBusinesses;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the generated Microsoft Bookings integration.
 */
final class MicrosoftBookingsServiceTest extends TestCase
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

    public function test_provider_matches_openapi_manifest_and_docs(): void
    {
        $provider = new MicrosoftBookingsToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/microsoft-bookings/microsoft-bookings-openapi-manifest.json'), true);

        self::assertSame(53, $manifest['method_count']);
        self::assertSame('v1.0', $manifest['version']);
        self::assertSame(['/solutions/bookingBusinesses', '/solutions/bookingCurrencies'], $manifest['path_prefixes']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Microsoft Bookings', $provider->integrationMeta()['name']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertContains('microsoft_bookings_list_booking_businesses', array_keys($provider->tools()));
        self::assertContains('microsoft_bookings_booking_businesses_list_appointments', array_keys($provider->tools()));
        self::assertContains('microsoft_bookings_booking_businesses_booking_business_publish', array_keys($provider->tools()));
        self::assertContains('microsoft_bookings_list_booking_currencies', array_keys($provider->tools()));
    }

    public function test_service_maps_bearer_path_odata_query_headers_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new MicrosoftBookingsService('graph-token', 'https://graph.example.test/v1.0');
        $service->request('GET', '/solutions/bookingBusinesses/{bookingBusiness-id}/appointments', ['bookingBusiness-id' => 'business 1'], ['$top' => 5, '$select' => 'id,serviceName']);
        $service->request('POST', '/solutions/bookingBusinesses/{bookingBusiness-id}/appointments', ['bookingBusiness-id' => 'business 1'], [], ['Prefer' => 'return=representation'], ['customerName' => 'Ada']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/solutions/bookingBusinesses/business%201/appointments?%24top=5&%24select=id%2CserviceName'
            && $request->hasHeader('Authorization', 'Bearer graph-token'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://graph.example.test/v1.0/solutions/bookingBusinesses/business%201/appointments'
            && $request->hasHeader('Prefer', 'return=representation')
            && $request->data()['customerName'] === 'Ada');
    }

    public function test_tools_validate_and_map_parameters(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new MicrosoftBookingsService('graph-token', 'https://graph.example.test/v1.0');

        self::assertTrue((new MicrosoftBookingsListBookingBusinesses($service))->execute(['top' => 5])->succeeded());
        self::assertTrue((new MicrosoftBookingsGetBookingBusinesses($service))->execute(['booking_business_id' => 'business-123'])->succeeded());
        self::assertTrue((new MicrosoftBookingsBookingBusinessesListAppointments($service))->execute(['booking_business_id' => 'business-123'])->succeeded());
        self::assertTrue((new MicrosoftBookingsBookingBusinessesCreateAppointments($service))->execute(['booking_business_id' => 'business-123', 'body' => ['customerName' => 'Ada']])->succeeded());
        self::assertTrue((new MicrosoftBookingsBookingBusinessesBookingBusinessPublish($service))->execute(['booking_business_id' => 'business-123'])->succeeded());

        $missingPath = (new MicrosoftBookingsGetBookingBusinesses($service))->execute([]);
        $badBody = (new MicrosoftBookingsBookingBusinessesCreateAppointments($service))->execute(['booking_business_id' => 'business-123', 'body' => 'not-object']);
        $missingBody = (new MicrosoftBookingsBookingBusinessesCreateAppointments($service))->execute(['booking_business_id' => 'business-123']);
        $unconfigured = (new MicrosoftBookingsGetBookingBusinesses(new MicrosoftBookingsService('', 'https://graph.example.test/v1.0')))->execute(['booking_business_id' => 'business-123']);

        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('booking_business_id must be a non-empty parameter', (string) $missingPath->error);
        self::assertFalse($badBody->succeeded());
        self::assertStringContainsString('body must be an object', (string) $badBody->error);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be a non-empty object', (string) $missingBody->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('access token is required', (string) $unconfigured->error);
    }

    public function test_connection_uses_booking_businesses_probe(): void
    {
        Http::fake(['graph.example.test/v1.0/solutions/bookingBusinesses*' => Http::response(['value' => []], 200)]);

        $result = (new MicrosoftBookingsToolProvider)->testConnection([
            'access_token' => 'graph-token',
            'base_url' => 'https://graph.example.test/v1.0',
        ]);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/solutions/bookingBusinesses?%24top=1'
            && $request->hasHeader('Authorization', 'Bearer graph-token'));
    }

    public function test_create_tool_resolves_account_specific_credentials(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                $values = [
                    'access_token' => $account === 'work' ? 'work-token' : 'default-token',
                    'base_url' => 'https://graph.example.test/v1.0',
                ];

                return $values[$key] ?? $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return true;
            }

            public function getAccounts(string $integration): array
            {
                return ['work'];
            }
        });

        $tool = (new MicrosoftBookingsToolProvider)->createTool(MicrosoftBookingsGetBookingBusinesses::class, ['account' => 'work']);
        self::assertTrue($tool->execute(['booking_business_id' => 'business-123'])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer work-token'));
    }
}
