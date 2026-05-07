<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\WorldBank;

use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\WorldBank\Tools\WorldBankMultiIndicatorData;
use OpenCompany\Integrations\WorldBank\Tools\WorldBankSourceIndicators;
use OpenCompany\Integrations\WorldBank\WorldBankService;
use OpenCompany\Integrations\WorldBank\WorldBankToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for World Bank Indicators API endpoint mappings.
 */
final class WorldBankServiceTest extends TestCase
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

    public function test_resource_endpoints_map_to_world_bank_v2_paths(): void
    {
        Http::fake([
            'https://api.worldbank.test/v2/country*' => Http::response([['page' => 1, 'total' => 1], [['id' => 'BRA', 'name' => 'Brazil']]], 200),
            'https://api.worldbank.test/v2/indicator/NY.GDP.MKTP.CD*' => Http::response([['page' => 1, 'total' => 1], [['id' => 'NY.GDP.MKTP.CD', 'name' => 'GDP']]], 200),
            'https://api.worldbank.test/v2/source?*' => Http::response([['page' => 1, 'total' => 1], [['id' => '2', 'name' => 'World Development Indicators']]], 200),
            'https://api.worldbank.test/v2/sources/2/series*' => Http::response([
                'page' => 1,
                'total' => 1,
                'source' => [[
                    'concept' => [[
                        'variable' => [['id' => 'SP.POP.TOTL', 'value' => 'Population']],
                    ]],
                ]],
            ], 200),
            'https://api.worldbank.test/v2/region*' => Http::response([['page' => 1, 'total' => 1], [['code' => 'LCN', 'name' => 'Latin America']]], 200),
            'https://api.worldbank.test/v2/incomelevel*' => Http::response([['page' => 1, 'total' => 1], [['id' => 'HIC', 'value' => 'High income']]], 200),
            'https://api.worldbank.test/v2/lendingtype*' => Http::response([['page' => 1, 'total' => 1], [['id' => 'IBD', 'value' => 'IBRD']]], 200),
            'https://api.worldbank.test/v2/languages*' => Http::response([['page' => 1, 'total' => 1], [['code' => 'en', 'name' => 'English']]], 200),
        ]);

        $service = new WorldBankService('https://api.worldbank.test/v2');
        $service->getCountries(['region' => 'LCN']);
        $service->getIndicator('NY.GDP.MKTP.CD');
        $sourceIndicators = $service->getSourceIndicators('2');
        $service->getSources();
        $service->getRegions();
        $service->getIncomeLevels();
        $service->getLendingTypes();
        $service->getLanguages();

        self::assertSame('SP.POP.TOTL', $sourceIndicators['data'][0]['id']);

        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.worldbank.test/v2/country?') && str_contains($request->url(), 'format=json') && str_contains($request->url(), 'region=LCN'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.worldbank.test/v2/indicator/NY.GDP.MKTP.CD?'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.worldbank.test/v2/sources/2/series?'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.worldbank.test/v2/source?'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.worldbank.test/v2/region?'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.worldbank.test/v2/incomelevel?'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.worldbank.test/v2/lendingtype?'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.worldbank.test/v2/languages?'));
    }

    public function test_multi_indicator_queries_require_source_and_preserve_semicolon_codes(): void
    {
        Http::fake([
            'https://api.worldbank.test/v2/country/chn;ago/indicator/SI.POV.DDAY;SP.POP.TOTL*' => Http::response([
                ['page' => 1, 'total' => 1],
                [[
                    'indicator' => ['id' => 'SP.POP.TOTL', 'value' => 'Population, total'],
                    'country' => ['id' => 'AO', 'value' => 'Angola'],
                    'countryiso3code' => 'AGO',
                    'date' => '2024',
                    'value' => 100,
                ]],
            ], 200),
        ]);

        $service = new WorldBankService('https://api.worldbank.test/v2');
        $service->getData('chn;ago', 'SI.POV.DDAY;SP.POP.TOTL', ['source' => 2, 'date' => '2000:2010']);

        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.worldbank.test/v2/country/chn;ago/indicator/SI.POV.DDAY;SP.POP.TOTL?') && str_contains($request->url(), 'source=2') && str_contains($request->url(), 'date=2000%3A2010'));

        $tool = new WorldBankMultiIndicatorData($service);
        $tooMany = implode(';', array_map(static fn (int $i): string => 'IND' . $i, range(1, 61)));
        $result = $tool->execute(['indicators' => $tooMany]);
        self::assertNotNull($result->error);
    }

    public function test_tools_and_provider_expose_expanded_public_surface(): void
    {
        Http::fake([
            'https://api.worldbank.test/v2/sources/2/series*' => Http::response([
                'page' => 1,
                'total' => 1,
                'source' => [[
                    'concept' => [[
                        'variable' => [['id' => 'SP.POP.TOTL', 'value' => 'Population']],
                    ]],
                ]],
            ], 200),
        ]);

        $service = new WorldBankService('https://api.worldbank.test/v2');
        $sourceIndicators = (new WorldBankSourceIndicators($service))->execute(['source_id' => '2']);
        self::assertNull($sourceIndicators->error);

        $provider = new WorldBankToolProvider();
        $tools = $provider->tools();
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertArrayHasKey('worldbank_sources', $tools);
        self::assertArrayHasKey('worldbank_multi_indicator_data', $tools);
        self::assertArrayHasKey('worldbank_languages', $tools);
        self::assertSame(14, count($tools));
    }
}
