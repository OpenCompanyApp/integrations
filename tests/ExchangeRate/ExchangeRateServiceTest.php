<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\ExchangeRate;

use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\ExchangeRate\ExchangeRateService;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for exchange-api endpoint mappings and fallback behavior.
 */
final class ExchangeRateServiceTest extends TestCase
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

    public function test_pair_rate_uses_direct_pair_endpoint(): void
    {
        Http::fake([
            'https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@latest/v1/currencies/usd/eur.json' => Http::response([
                'date' => '2026-05-06',
                'eur' => 0.92,
            ], 200),
        ]);

        $service = new ExchangeRateService();
        $rate = $service->getPairRate('USD', 'EUR');

        self::assertSame([
            'from' => 'usd',
            'to' => 'eur',
            'rate' => 0.92,
            'date' => '2026-05-06',
        ], $rate);

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@latest/v1/currencies/usd/eur.json');
    }

    public function test_convert_uses_direct_pair_endpoint(): void
    {
        Http::fake([
            'https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@2026-05-01/v1/currencies/eur/jpy.json' => Http::response([
                'date' => '2026-05-01',
                'jpy' => 170.5,
            ], 200),
        ]);

        $service = new ExchangeRateService();
        $result = $service->convert('EUR', 'JPY', 2, '2026-05-01');

        self::assertSame(341.0, $result['result']);
        self::assertSame(170.5, $result['rate']);

        Http::assertSentCount(1);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@2026-05-01/v1/currencies/eur/jpy.json');
    }

    public function test_rates_still_use_base_currency_endpoint(): void
    {
        Http::fake([
            'https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@latest/v1/currencies/usd.json' => Http::response([
                'date' => '2026-05-06',
                'usd' => ['eur' => 0.92, 'jpy' => 155.0],
            ], 200),
        ]);

        $service = new ExchangeRateService();
        $result = $service->getRates('USD');

        self::assertEquals(['eur' => 0.92, 'jpy' => 155.0], $result['rates']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@latest/v1/currencies/usd.json');
    }

    public function test_cloudflare_fallback_is_used_when_primary_fails(): void
    {
        Http::fake([
            'https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@latest/v1/currencies/usd/eur.json' => Http::response([], 503),
            'https://latest.currency-api.pages.dev/v1/currencies/usd/eur.json' => Http::response([
                'date' => '2026-05-06',
                'eur' => 0.91,
            ], 200),
        ]);

        $service = new ExchangeRateService();
        $result = $service->getPairRate('usd', 'eur');

        self::assertSame(0.91, $result['rate']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://latest.currency-api.pages.dev/v1/currencies/usd/eur.json');
    }
}
