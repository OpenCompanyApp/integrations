<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\OpenAlex;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\OpenAlex\OpenAlexService;
use OpenCompany\Integrations\OpenAlex\OpenAlexToolProvider;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexAutocomplete;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexGetAuthor;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexGetChangefile;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexGetWork;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexListChangefiles;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexListTopics;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexListWorks;
use OpenCompany\Integrations\OpenAlex\Tools\OpenAlexRateLimit;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the OpenAlex scholarly graph integration.
 */
final class OpenAlexServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(OpenAlexService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(OpenAlexService::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new OpenAlexToolProvider;

        self::assertSame('openalex', $provider->appName());
        self::assertSame('OpenAlex', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());

        $tools = array_keys($provider->tools());
        self::assertCount(44, $tools);
        self::assertContains('openalex_list_works', $tools);
        self::assertContains('openalex_get_work', $tools);
        self::assertContains('openalex_list_authors', $tools);
        self::assertContains('openalex_get_author', $tools);
        self::assertContains('openalex_list_institutions', $tools);
        self::assertContains('openalex_list_topics', $tools);
        self::assertContains('openalex_list_keywords', $tools);
        self::assertContains('openalex_list_awards', $tools);
        self::assertContains('openalex_list_work_types', $tools);
        self::assertContains('openalex_get_license', $tools);
        self::assertContains('openalex_autocomplete', $tools);
        self::assertContains('openalex_rate_limit', $tools);
        self::assertContains('openalex_list_changefiles', $tools);
        self::assertContains('openalex_get_changefile', $tools);
    }

    public function test_service_maps_entity_list_get_autocomplete_rate_limit_and_changefiles(): void
    {
        Http::fake(['*' => Http::response(['meta' => ['count' => 1], 'results' => [['id' => 'https://openalex.org/W1']]], 200)]);

        $service = new OpenAlexService('key-test', 'https://example.test');
        $service->list('works', [
            'search' => 'machine learning',
            'filter' => ['publication_year' => 2024, 'is_oa' => true],
            'select' => ['id', 'display_name'],
            'per_page' => 10,
        ]);
        $service->get('works', 'doi:10.1234/example', ['select' => ['id', 'doi']]);
        $service->autocomplete('authors', ['q' => 'Ada', 'filter' => 'works_count:>10']);
        $service->rateLimit();
        $service->listChangefiles();
        $service->getChangefile('2026-01-01');

        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.test/works?')
            && str_contains($request->url(), 'api_key=key-test')
            && str_contains($request->url(), 'search=machine%20learning')
            && str_contains($request->url(), 'filter=publication_year%3A2024%2Cis_oa%3Atrue')
            && str_contains($request->url(), 'select=id%2Cdisplay_name'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.test/works/doi:10.1234/example?')
            && str_contains($request->url(), 'select=id%2Cdoi'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.test/autocomplete/authors?')
            && str_contains($request->url(), 'q=Ada'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.test/rate-limit?'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.test/changefiles?'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.test/changefiles/2026-01-01?'));
    }

    public function test_tools_validate_arguments_merge_query_and_convert_errors(): void
    {
        Http::fake(['*' => Http::response(['meta' => ['count' => 1], 'results' => [['id' => 'https://openalex.org/W1']]], 200)]);
        $service = new OpenAlexService('key-test', 'https://example.test');

        $list = (new OpenAlexListWorks($service))->execute([
            'query' => ['per_page' => 5, 'sort' => 'works_count:desc'],
            'search' => 'open science',
            'per_page' => 2,
        ]);
        self::assertTrue($list->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'per_page=2') && str_contains($request->url(), 'sort=works_count%3Adesc'));

        $get = (new OpenAlexGetWork($service))->execute(['id' => 'W2741809807']);
        self::assertTrue($get->succeeded());

        $missingId = (new OpenAlexGetAuthor($service))->execute([]);
        self::assertFalse($missingId->succeeded());
        self::assertStringContainsString('id is required', (string) $missingId->error);

        $badAutocomplete = (new OpenAlexAutocomplete($service))->execute(['entity' => 'concepts', 'q' => 'deprecated']);
        self::assertFalse($badAutocomplete->succeeded());
        self::assertStringContainsString('Unsupported OpenAlex autocomplete entity', (string) $badAutocomplete->error);

        $unconfigured = (new OpenAlexListTopics(new OpenAlexService('', 'https://example.test')))->execute(['per_page' => 1]);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('API key is not configured', (string) $unconfigured->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['message' => 'Invalid API key'], 401)]);
        $bad = (new OpenAlexRateLimit($service))->execute([]);
        self::assertFalse($bad->succeeded());
        self::assertStringContainsString('Invalid API key', (string) $bad->error);
    }

    public function test_connection_utility_tools_and_multi_account_credentials(): void
    {
        Http::fake(['*' => Http::response(['meta' => ['count' => 1], 'results' => [['id' => 'https://openalex.org/W1']]], 200)]);

        $provider = new OpenAlexToolProvider;
        $ok = $provider->testConnection(['api_key' => 'key-test', 'url' => 'https://example.test']);

        self::assertTrue($ok['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://example.test/works?')
            && str_contains($request->url(), 'api_key=key-test')
            && str_contains($request->url(), 'per_page=1'));

        $missingKey = $provider->testConnection([]);
        self::assertFalse($missingKey['success']);
        self::assertStringContainsString('No API key', (string) $missingKey['error']);

        $service = new OpenAlexService('key-test', 'https://example.test');
        self::assertTrue((new OpenAlexListChangefiles($service))->execute([])->succeeded());
        self::assertTrue((new OpenAlexGetChangefile($service))->execute(['date' => '2026-01-01'])->succeeded());

        $resolver = new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['openalex', 'api_key', 'acct_1'] => 'key-account',
                    ['openalex', 'url', 'acct_1'] => 'https://account.example.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'openalex' && $account === 'acct_1';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'openalex' ? ['acct_1'] : [];
            }
        };

        Container::getInstance()->instance(CredentialResolver::class, $resolver);
        $tool = $provider->createTool(OpenAlexListWorks::class, ['account' => 'acct_1']);
        $result = $tool->execute(['per_page' => 1]);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://account.example.test/works?')
            && str_contains($request->url(), 'api_key=key-account'));
    }
}
