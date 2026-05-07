<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Airwallex;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Airwallex\AirwallexService;
use OpenCompany\Integrations\Airwallex\AirwallexToolProvider;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexAuthenticationObtainAccessToken;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexScaleRetrieveAccountDetails;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingCreateABillingCustomer;
use OpenCompany\Integrations\Airwallex\Tools\AirwallexBillingGetListOfBllingCustomers;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the generated Airwallex Postman collection integration.
 */
final class AirwallexServiceTest extends TestCase
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

    public function test_provider_matches_postman_manifest_and_docs(): void
    {
        $provider = new AirwallexToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/airwallex/airwallex-postman-manifest.json'), true);

        self::assertSame(201, $manifest['method_count']);
        self::assertSame('v2025-11-11', $manifest['version']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Airwallex', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('api_key_with_bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertContains('client_id', $provider->integrationCapabilities()['auth']['token_keys']);
        self::assertContains('api_key', $provider->integrationCapabilities()['auth']['token_keys']);
        self::assertCount(3, $provider->credentialFields());
        self::assertCount(8, $provider->configSchema());
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertContains('airwallex_authentication_obtain_access_token', array_keys($provider->tools()));
        self::assertContains('airwallex_scale_retrieve_account_details', array_keys($provider->tools()));
        self::assertContains('airwallex_billing_create_a_billing_customer', array_keys($provider->tools()));
    }

    public function test_service_maps_api_key_bearer_query_headers_and_file_host_requests(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200, ['Location' => 'https://api.example.test/resource'])]);

        $service = new AirwallexService('access', 'client', 'key', 'https://api.example.test', 'https://files.example.test', '2025-11-11', 'acct-login', 'acct-behalf');
        $service->request('POST', '/api/v1/authentication/login', [], [], [], [], 'application/json', 'api_key');
        $service->request('GET', '/api/v1/billing_customers/{id}', ['id' => 'customer 1'], ['page_num' => 1]);
        $service->request('POST', '/api/v1/files/upload', [], [], [], ['file' => 'contents'], 'multipart/form-data', 'bearer', 'file');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/api/v1/authentication/login'
            && $request->hasHeader('x-client-id', 'client')
            && $request->hasHeader('x-api-key', 'key')
            && !$request->hasHeader('Authorization'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/api/v1/billing_customers/customer%201?page_num=1'
            && $request->hasHeader('Authorization', 'Bearer access')
            && $request->hasHeader('x-api-version', '2025-11-11')
            && $request->hasHeader('x-login-as', 'acct-login')
            && $request->hasHeader('x-on-behalf-of', 'acct-behalf'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://files.example.test/api/v1/files/upload'
            && $request->hasHeader('Authorization', 'Bearer access'));
    }

    public function test_tools_validate_and_map_parameters(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new AirwallexService('access', 'client', 'key', 'https://api.example.test', 'https://files.example.test');

        self::assertTrue((new AirwallexAuthenticationObtainAccessToken($service))->execute([])->succeeded());
        self::assertTrue((new AirwallexScaleRetrieveAccountDetails($service))->execute([])->succeeded());
        self::assertTrue((new AirwallexBillingGetListOfBllingCustomers($service))->execute(['page_num' => 1, 'page_size' => 20])->succeeded());
        self::assertTrue((new AirwallexBillingCreateABillingCustomer($service))->execute(['body' => ['name' => 'Example Customer']])->succeeded());

        $badBody = (new AirwallexBillingCreateABillingCustomer($service))->execute(['body' => 'not-object']);
        $unconfigured = (new AirwallexScaleRetrieveAccountDetails(new AirwallexService('', '', '', 'https://api.example.test')))->execute([]);

        self::assertFalse($badBody->succeeded());
        self::assertStringContainsString('body must be a non-empty object', (string) $badBody->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_uses_login_when_client_credentials_are_available(): void
    {
        Http::fake(['api.example.test/api/v1/authentication/login' => Http::response(['token' => 'access'], 200)]);

        $result = (new AirwallexToolProvider)->testConnection(['client_id' => 'client', 'api_key' => 'key', 'url' => 'https://api.example.test']);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/api/v1/authentication/login'
            && $request->hasHeader('x-client-id', 'client')
            && $request->hasHeader('x-api-key', 'key'));
    }
}
