<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\DeepL;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\DeepL\DeepLOperations;
use OpenCompany\Integrations\DeepL\DeepLService;
use OpenCompany\Integrations\DeepL\DeepLToolProvider;
use OpenCompany\Integrations\DeepL\Tools\DeepLGetUsage;
use OpenCompany\Integrations\DeepL\Tools\DeepLListLanguages;
use OpenCompany\Integrations\DeepL\Tools\DeepLTranslateText;
use PHPUnit\Framework\TestCase;

final class DeepLServiceTest extends TestCase
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

    public function test_provider_exposes_generated_metadata_and_preserved_tools(): void
    {
        $provider = new DeepLToolProvider;

        self::assertSame('deepl', $provider->appName());
        self::assertSame('DeepL', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://developers.deepl.com/docs', $provider->integrationMeta()['docs_url']);
        self::assertSame('https://raw.githubusercontent.com/DeepLcom/openapi/main/openapi.yaml', $provider->integrationMeta()['source_url']);
        self::assertCount(40, DeepLOperations::all());
        self::assertCount(40, $provider->tools());
        self::assertArrayHasKey('deepl_translate_text', $provider->tools());
        self::assertArrayHasKey('deepl_list_languages', $provider->tools());
        self::assertArrayHasKey('deepl_get_usage', $provider->tools());
        self::assertArrayHasKey('deepl_list_glossaries', $provider->tools());
        self::assertArrayHasKey('deepl_get_glossary', $provider->tools());
        self::assertArrayHasKey('deepl_create_glossary', $provider->tools());
        self::assertArrayHasKey('deepl_translate_document', $provider->tools());
        self::assertArrayHasKey('deepl_rephrase_text', $provider->tools());
        self::assertArrayNotHasKey('deepl_get_current_user', $provider->tools());
    }

    public function test_service_maps_common_deepl_endpoints_and_auth_header(): void
    {
        Http::fake([
            'https://api-free.example.test/v2/translate' => Http::response(['translations' => [['text' => 'Hallo']]], 200),
            'https://api-free.example.test/v2/languages*' => Http::response([['language' => 'DE']], 200),
            'https://api-free.example.test/v2/usage' => Http::response(['character_count' => 10, 'character_limit' => 1000], 200),
            'https://api-free.example.test/v2/glossaries' => Http::response(['glossaries' => []], 200),
            'https://api-free.example.test/v2/glossaries/example-glossary' => Http::response(['glossary_id' => 'example-glossary'], 200),
        ]);

        $service = new DeepLService(apiKey: 'deepl-key', baseUrl: 'https://api-free.example.test');

        self::assertSame(['translations' => [['text' => 'Hallo']]], $service->translateText('Hello', 'DE'));
        self::assertSame([['language' => 'DE']], $service->listLanguages('target'));
        self::assertSame(['character_count' => 10, 'character_limit' => 1000], $service->getUsage());
        self::assertSame(['glossaries' => []], $service->listGlossaries());
        self::assertSame(['glossary_id' => 'example-glossary'], $service->getGlossary('example-glossary'));
        self::assertSame(['glossaries' => []], $service->createGlossary('Example', 'EN', 'DE', "Hello\tHallo"));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api-free.example.test/v2/translate'
            && $request['text'] === ['Hello']
            && $request['target_lang'] === 'DE'
            && $request->hasHeader('Authorization', 'DeepL-Auth-Key deepl-key'));
        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return str_starts_with($request->url(), 'https://api-free.example.test/v2/languages?')
                && ($query['type'] ?? null) === 'target';
        });
    }

    public function test_generated_tools_map_query_body_and_content_type_arguments(): void
    {
        Http::fake([
            'https://api-free.example.test/v2/translate' => Http::response(['translations' => [['text' => 'Hallo']]], 200),
            'https://api-free.example.test/v2/languages*' => Http::response([['language' => 'DE']], 200),
        ]);

        $service = new DeepLService(apiKey: 'deepl-key', baseUrl: 'https://api-free.example.test');

        $translate = new DeepLTranslateText($service);
        $translated = $translate->execute([
            'text' => ['Hello'],
            'target_lang' => 'DE',
            'content_type' => 'application/x-www-form-urlencoded',
        ]);
        self::assertTrue($translated->succeeded());
        self::assertSame('Hallo', $translated->data['translations'][0]['text']);

        $languages = new DeepLListLanguages($service);
        $listed = $languages->execute(['type' => 'target']);
        self::assertTrue($listed->succeeded());
        self::assertSame('DE', $listed->data[0]['language']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api-free.example.test/v2/translate'
            && $request['text'] === ['Hello']
            && $request['target_lang'] === 'DE');
    }

    public function test_provider_resolves_named_account_credentials(): void
    {
        Http::fake([
            'https://tenant-deepl.example.test/v2/usage' => Http::response(['character_count' => 5, 'character_limit' => 100], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration !== 'deepl' || $account !== 'work') {
                    return $default;
                }

                return match ($key) {
                    'api_key' => 'tenant-deepl-key',
                    'base_url' => 'https://tenant-deepl.example.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'deepl' && $account === 'work';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'deepl' ? ['work'] : [];
            }
        });

        $tool = (new DeepLToolProvider)->createTool(DeepLGetUsage::class, ['account' => 'work']);
        $result = $tool->execute([]);

        self::assertTrue($result->succeeded());
        self::assertSame(5, $result->data['character_count']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://tenant-deepl.example.test/v2/usage'
            && $request->hasHeader('Authorization', 'DeepL-Auth-Key tenant-deepl-key'));
    }
}
