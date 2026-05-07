<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Binance;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Binance\BinanceService;
use OpenCompany\Integrations\Binance\BinanceToolProvider;
use OpenCompany\Integrations\Binance\Tools\BinanceGetApiV3Ping;
use OpenCompany\Integrations\Binance\Tools\BinanceGetApiV3TickerPrice;
use OpenCompany\Integrations\Binance\Tools\BinanceGetApiV3Account;
use OpenCompany\Integrations\Binance\Tools\BinancePostApiV3Order;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the generated Binance Spot OpenAPI integration.
 */
final class BinanceServiceTest extends TestCase
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
        $provider = new BinanceToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/binance/binance-openapi-manifest.json'), true);

        self::assertSame(340, $manifest['method_count']);
        self::assertSame('3.0.2', $manifest['openapi']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Binance', $provider->integrationMeta()['name']);
        self::assertSame('api_key_hmac', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertContains('binance_get_api_v3_ping', array_keys($provider->tools()));
        self::assertContains('binance_get_api_v3_ticker_price', array_keys($provider->tools()));
        self::assertContains('binance_get_api_v3_account', array_keys($provider->tools()));
    }

    public function test_service_maps_public_api_key_and_signed_requests(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new BinanceService('api-key', 'secret', 'https://binance.example.test');
        $service->request('GET', '/api/v3/ping', [], [], [], 'public');
        $service->request('GET', '/api/v3/ticker/price', [], ['symbol' => 'BNBUSDT'], [], 'public');
        $service->request('GET', '/api/v3/account', [], ['recvWindow' => 5000, 'timestamp' => 1700000000000], [], 'signed');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://binance.example.test/api/v3/ping'
            && !$request->hasHeader('X-MBX-APIKEY'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://binance.example.test/api/v3/ticker/price?symbol=BNBUSDT'
            && !$request->hasHeader('X-MBX-APIKEY'));

        $expectedSignature = hash_hmac('sha256', 'recvWindow=5000&timestamp=1700000000000', 'secret');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://binance.example.test/api/v3/account?recvWindow=5000&timestamp=1700000000000&signature=' . $expectedSignature
            && $request->hasHeader('X-MBX-APIKEY', 'api-key'));
    }

    public function test_tools_validate_and_map_parameters(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new BinanceService('api-key', 'secret', 'https://binance.example.test');

        self::assertTrue((new BinanceGetApiV3Ping(new BinanceService('', '', 'https://binance.example.test')))->execute([])->succeeded());
        self::assertTrue((new BinanceGetApiV3TickerPrice(new BinanceService('', '', 'https://binance.example.test')))->execute(['symbol' => 'BNBUSDT'])->succeeded());
        self::assertTrue((new BinanceGetApiV3Account($service))->execute(['recv_window' => 5000, 'timestamp' => 1700000000000])->succeeded());
        self::assertTrue((new BinancePostApiV3Order($service))->execute(['symbol' => 'BNBUSDT', 'side' => 'BUY', 'type' => 'MARKET', 'quantity' => 1, 'timestamp' => 1700000000000])->succeeded());

        $missingPathOrParam = (new BinancePostApiV3Order($service))->execute([]);
        $missingSecret = (new BinanceGetApiV3Account(new BinanceService('api-key', '', 'https://binance.example.test')))->execute([]);

        self::assertTrue($missingPathOrParam->succeeded(), 'Binance leaves required query validation to the API because conditional order parameters vary by order type.');
        self::assertFalse($missingSecret->succeeded());
        self::assertStringContainsString('API key and API secret', (string) $missingSecret->error);
    }

    public function test_connection_uses_ping_without_credentials(): void
    {
        Http::fake(['binance.example.test/api/v3/ping' => Http::response([], 200)]);

        $result = (new BinanceToolProvider)->testConnection(['url' => 'https://binance.example.test']);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://binance.example.test/api/v3/ping');
    }
}
