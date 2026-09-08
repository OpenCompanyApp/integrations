<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Shippo;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Shippo\ShippoService;
use OpenCompany\Integrations\Shippo\ShippoToolProvider;
use OpenCompany\Integrations\Shippo\Tools\ShippoCreateAddress;
use OpenCompany\Integrations\Shippo\Tools\ShippoGetAddress;
use OpenCompany\Integrations\Shippo\Tools\ShippoListOrders;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the generated Shippo OpenAPI integration.
 */
final class ShippoServiceTest extends TestCase
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
        $provider = new ShippoToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/shippo/shippo-openapi-manifest.json'), true);

        self::assertSame(70, $manifest['method_count']);
        self::assertSame('3.1.0', $manifest['openapi']);
        self::assertSame('2018-02-08', $manifest['api_version']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Shippo', $provider->integrationMeta()['name']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertContains('shippo_create_address', array_keys($provider->tools()));
        self::assertContains('shippo_create_transaction', array_keys($provider->tools()));
        self::assertContains('shippo_create_webhook', array_keys($provider->tools()));
    }

    public function test_service_maps_auth_headers_path_query_arrays_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new ShippoService('shippo_test_token', 'https://shippo.example.test', '2018-02-08');
        $service->request('GET', '/addresses/{AddressId}', ['AddressId' => 'adr 123'], [], ['SHIPPO-API-VERSION' => '2024-01-01']);
        $service->request('GET', '/orders', [], ['order_status[]' => ['PAID', 'SHIPPED'], 'results' => 10]);
        $service->request('POST', '/addresses', [], [], [], ['name' => 'Test Sender']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://shippo.example.test/addresses/adr%20123'
            && $request->hasHeader('Authorization', 'ShippoToken shippo_test_token')
            && $request->hasHeader('SHIPPO-API-VERSION', '2024-01-01'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://shippo.example.test/orders?order_status%5B%5D=PAID&order_status%5B%5D=SHIPPED&results=10');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://shippo.example.test/addresses'
            && $request->data()['name'] === 'Test Sender');
    }

    public function test_tools_validate_and_map_parameters(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new ShippoService('shippo_test_token', 'https://shippo.example.test');

        self::assertTrue((new ShippoGetAddress($service))->execute(['address_id' => 'adr_123'])->succeeded());
        self::assertTrue((new ShippoListOrders($service))->execute(['order_status' => ['PAID', 'SHIPPED'], 'results' => 2])->succeeded());
        self::assertTrue((new ShippoCreateAddress($service))->execute(['body' => ['name' => 'Test Sender']])->succeeded());

        $missingPath = (new ShippoGetAddress($service))->execute([]);
        $badBody = (new ShippoCreateAddress($service))->execute(['body' => 'not-object']);
        $missingBody = (new ShippoCreateAddress($service))->execute([]);
        $unconfigured = (new ShippoGetAddress(new ShippoService('', 'https://shippo.example.test')))->execute(['address_id' => 'adr_123']);

        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('address_id must be a non-empty parameter', (string) $missingPath->error);
        self::assertFalse($badBody->succeeded());
        self::assertStringContainsString('body must be an object', (string) $badBody->error);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be a non-empty object', (string) $missingBody->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('API token is required', (string) $unconfigured->error);
    }

    public function test_connection_uses_lightweight_addresses_request(): void
    {
        Http::fake(['shippo.example.test/addresses?results=1' => Http::response(['results' => []], 200)]);

        $result = (new ShippoToolProvider)->testConnection([
            'api_token' => 'shippo_test_token',
            'api_version' => '2018-02-08',
            'url' => 'https://shippo.example.test',
        ]);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://shippo.example.test/addresses?results=1'
            && $request->hasHeader('Authorization', 'ShippoToken shippo_test_token')
            && $request->hasHeader('SHIPPO-API-VERSION', '2018-02-08'));
    }

    public function test_create_tool_resolves_account_specific_credentials(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                $values = [
                    'api_token' => $account === 'work' ? 'shippo_work_token' : 'shippo_default_token',
                    'url' => 'https://shippo.example.test',
                    'api_version' => '2018-02-08',
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

        $tool = (new ShippoToolProvider)->createTool(ShippoGetAddress::class, ['account' => 'work']);
        self::assertTrue($tool->execute(['address_id' => 'adr_123'])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'ShippoToken shippo_work_token'));
    }
}
