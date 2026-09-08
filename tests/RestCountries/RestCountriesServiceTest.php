<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\RestCountries;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\RestCountries\RestCountriesService;
use OpenCompany\Integrations\RestCountries\RestCountriesToolProvider;
use OpenCompany\Integrations\RestCountries\Tools\RestCountriesAll;
use OpenCompany\Integrations\RestCountries\Tools\RestCountriesAlpha;
use OpenCompany\Integrations\RestCountries\Tools\RestCountriesAlphaCodes;
use OpenCompany\Integrations\RestCountries\Tools\RestCountriesCapital;
use OpenCompany\Integrations\RestCountries\Tools\RestCountriesCurrency;
use OpenCompany\Integrations\RestCountries\Tools\RestCountriesDemonym;
use OpenCompany\Integrations\RestCountries\Tools\RestCountriesIndependent;
use OpenCompany\Integrations\RestCountries\Tools\RestCountriesLanguage;
use OpenCompany\Integrations\RestCountries\Tools\RestCountriesName;
use OpenCompany\Integrations\RestCountries\Tools\RestCountriesRegion;
use OpenCompany\Integrations\RestCountries\Tools\RestCountriesSubregion;
use OpenCompany\Integrations\RestCountries\Tools\RestCountriesTranslation;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the REST Countries integration.
 */
final class RestCountriesServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(RestCountriesService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(RestCountriesService::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new RestCountriesToolProvider;

        self::assertSame('rest-countries', $provider->appName());
        self::assertSame('REST Countries', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('none', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertSame([], $provider->credentialFields());
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertSame([
            'rest_countries_all',
            'rest_countries_name',
            'rest_countries_alpha',
            'rest_countries_alpha_codes',
            'rest_countries_currency',
            'rest_countries_language',
            'rest_countries_capital',
            'rest_countries_region',
            'rest_countries_subregion',
            'rest_countries_demonym',
            'rest_countries_translation',
            'rest_countries_independent',
        ], array_keys($provider->tools()));
    }

    public function test_all_name_alpha_and_alpha_codes_paths_are_mapped(): void
    {
        $service = new RestCountriesService(baseUrl: 'https://countries.example.test/v3.1');

        Http::fake(['*' => Http::response([['name' => ['common' => 'Peru']]], 200)]);
        self::assertTrue((new RestCountriesAll($service))->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://countries.example.test/v3.1/all?')
            && str_contains($request->url(), 'fields=name%2Ccca2%2Ccca3%2Ccapital%2Cregion%2Csubregion%2Cpopulation%2Cflags'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response([['name' => ['common' => 'Aruba']]], 200)]);
        self::assertTrue((new RestCountriesName($service))->execute(['name' => 'aruba', 'full_text' => true, 'fields' => 'name,capital'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://countries.example.test/v3.1/name/aruba?fields=name%2Ccapital&fullText=true');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response([['cca3' => 'DEU']], 200)]);
        self::assertTrue((new RestCountriesAlpha($service))->execute(['code' => 'DEU', 'fields' => 'name,cca3'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://countries.example.test/v3.1/alpha/DEU?fields=name%2Ccca3');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response([['cca3' => 'PER'], ['cca3' => 'EST']], 200)]);
        self::assertTrue((new RestCountriesAlphaCodes($service))->execute(['codes' => '170,no,est,pe', 'fields' => 'name,cca3'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://countries.example.test/v3.1/alpha?codes=170%2Cno%2Cest%2Cpe&fields=name%2Ccca3');
    }

    public function test_lookup_endpoint_paths_are_mapped(): void
    {
        $service = new RestCountriesService(baseUrl: 'https://countries.example.test/v3.1');

        $cases = [
            [RestCountriesCurrency::class, ['currency' => 'eur'], 'https://countries.example.test/v3.1/currency/eur?fields=name'],
            [RestCountriesLanguage::class, ['language' => 'spanish'], 'https://countries.example.test/v3.1/lang/spanish?fields=name'],
            [RestCountriesCapital::class, ['capital' => 'Tallinn'], 'https://countries.example.test/v3.1/capital/Tallinn?fields=name'],
            [RestCountriesRegion::class, ['region' => 'europe'], 'https://countries.example.test/v3.1/region/europe?fields=name'],
            [RestCountriesSubregion::class, ['subregion' => 'Northern Europe'], 'https://countries.example.test/v3.1/subregion/Northern%20Europe?fields=name'],
            [RestCountriesDemonym::class, ['demonym' => 'peruvian'], 'https://countries.example.test/v3.1/demonym/peruvian?fields=name'],
            [RestCountriesTranslation::class, ['translation' => 'alemania'], 'https://countries.example.test/v3.1/translation/alemania?fields=name'],
        ];

        foreach ($cases as [$class, $args, $url]) {
            Http::swap(new HttpFactory);
            Http::fake(['*' => Http::response([['name' => ['common' => 'Example']]], 200)]);

            self::assertTrue((new $class($service))->execute($args + ['fields' => 'name'])->succeeded());
            Http::assertSent(static fn (Request $request): bool => $request->url() === $url);
        }
    }

    public function test_independent_validation_errors_and_provider_creation(): void
    {
        $service = new RestCountriesService(baseUrl: 'https://countries.example.test/v3.1');

        Http::fake(['*' => Http::response([['independent' => true]], 200)]);
        self::assertTrue((new RestCountriesIndependent($service))->execute(['status' => true, 'fields' => 'name,independent'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://countries.example.test/v3.1/independent?status=true&fields=name%2Cindependent');

        $tooManyFields = (new RestCountriesAll($service))->execute(['fields' => 'a,b,c,d,e,f,g,h,i,j,k']);
        self::assertFalse($tooManyFields->succeeded());
        self::assertStringContainsString('at most 10', (string) $tooManyFields->error);

        $missing = (new RestCountriesName($service))->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('name is required', (string) $missing->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['message' => 'Not Found'], 404)]);
        $notFound = (new RestCountriesAlpha($service))->execute(['code' => 'ZZZ']);
        self::assertFalse($notFound->succeeded());
        self::assertStringContainsString('Not Found', (string) $notFound->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response([['name' => ['common' => 'Germany']]], 200)]);
        app()->instance(RestCountriesService::class, new RestCountriesService(baseUrl: 'https://countries.example.test/v3.1'));
        $tool = (new RestCountriesToolProvider)->createTool(RestCountriesAlpha::class);
        self::assertTrue($tool->execute(['code' => 'DE'])->succeeded());
    }
}
