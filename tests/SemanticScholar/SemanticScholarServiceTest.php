<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\SemanticScholar;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\SemanticScholar\SemanticScholarService;
use OpenCompany\Integrations\SemanticScholar\SemanticScholarToolProvider;
use OpenCompany\Integrations\SemanticScholar\Tools\SemanticScholarBatchGetPapers;
use OpenCompany\Integrations\SemanticScholar\Tools\SemanticScholarGetAuthor;
use OpenCompany\Integrations\SemanticScholar\Tools\SemanticScholarGetDataset;
use OpenCompany\Integrations\SemanticScholar\Tools\SemanticScholarGetDatasetDiffs;
use OpenCompany\Integrations\SemanticScholar\Tools\SemanticScholarRecommendPapers;
use OpenCompany\Integrations\SemanticScholar\Tools\SemanticScholarSearchPapers;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Semantic Scholar API integration.
 */
final class SemanticScholarServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(SemanticScholarService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(SemanticScholarService::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new SemanticScholarToolProvider;

        self::assertSame('semantic-scholar', $provider->appName());
        self::assertSame('Semantic Scholar', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());

        $tools = array_keys($provider->tools());
        self::assertCount(20, $tools);
        self::assertContains('semantic_scholar_search_papers', $tools);
        self::assertContains('semantic_scholar_bulk_search_papers', $tools);
        self::assertContains('semantic_scholar_title_search_papers', $tools);
        self::assertContains('semantic_scholar_autocomplete_papers', $tools);
        self::assertContains('semantic_scholar_get_paper', $tools);
        self::assertContains('semantic_scholar_batch_get_papers', $tools);
        self::assertContains('semantic_scholar_get_paper_authors', $tools);
        self::assertContains('semantic_scholar_get_paper_citations', $tools);
        self::assertContains('semantic_scholar_get_paper_references', $tools);
        self::assertContains('semantic_scholar_search_authors', $tools);
        self::assertContains('semantic_scholar_get_author', $tools);
        self::assertContains('semantic_scholar_batch_get_authors', $tools);
        self::assertContains('semantic_scholar_get_author_papers', $tools);
        self::assertContains('semantic_scholar_search_snippets', $tools);
        self::assertContains('semantic_scholar_recommend_papers', $tools);
        self::assertContains('semantic_scholar_recommend_for_paper', $tools);
        self::assertContains('semantic_scholar_list_dataset_releases', $tools);
        self::assertContains('semantic_scholar_get_dataset_release', $tools);
        self::assertContains('semantic_scholar_get_dataset', $tools);
        self::assertContains('semantic_scholar_get_dataset_diffs', $tools);
    }

    public function test_service_maps_graph_recommendations_and_datasets_hosts(): void
    {
        Http::fake(['*' => Http::response(['data' => [['paperId' => 'paper-1']]], 200)]);

        $service = new SemanticScholarService(
            apiKey: 'key-test',
            graphUrl: 'https://graph.example.test',
            recommendationsUrl: 'https://recommend.example.test',
            datasetsUrl: 'https://datasets.example.test',
        );

        $service->graphGet('paper/search', ['query' => 'agent systems', 'fields' => ['title', 'year'], 'openAccessPdf' => true, 'limit' => 3]);
        $service->graphPost('paper/batch', ['fields' => ['title', 'authors']], ['ids' => ['CorpusId:1']]);
        $service->graphGet('paper/CorpusId%3A1/citations', ['limit' => 2]);
        $service->graphGet('author/search', ['query' => 'Ada Lovelace', 'limit' => 1]);
        $service->graphPost('author/batch', ['fields' => 'name,paperCount'], ['ids' => ['123']]);
        $service->graphGet('snippet/search', ['query' => 'attention', 'paperIds' => ['paper-1', 'paper-2']]);
        $service->recommendationsPost('papers/', ['limit' => 5], ['positivePaperIds' => ['paper-1']]);
        $service->recommendationsGet('papers/forpaper/paper-1', ['from' => 'all-cs', 'limit' => 5]);
        $service->datasetsGet('release/');
        $service->datasetsGet('release/2026-01-01');
        $service->datasetsGet('release/2026-01-01/dataset/papers');
        $service->datasetsGet('diffs/2026-01-01/to/2026-02-01/papers');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://graph.example.test/paper/search?')
            && str_contains($request->url(), 'query=agent%20systems')
            && str_contains($request->url(), 'fields=title%2Cyear')
            && str_contains($request->url(), 'openAccessPdf=true')
            && $request->hasHeader('x-api-key', 'key-test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && str_starts_with($request->url(), 'https://graph.example.test/paper/batch?')
            && str_contains($request->url(), 'fields=title%2Cauthors')
            && $request['ids'] === ['CorpusId:1']);
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://graph.example.test/paper/CorpusId%3A1/citations?'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://graph.example.test/author/search?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && str_starts_with($request->url(), 'https://graph.example.test/author/batch?'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://graph.example.test/snippet/search?')
            && str_contains($request->url(), 'paperIds=paper-1%2Cpaper-2'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && str_starts_with($request->url(), 'https://recommend.example.test/papers/?'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://recommend.example.test/papers/forpaper/paper-1?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://datasets.example.test/release/');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://datasets.example.test/release/2026-01-01');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://datasets.example.test/release/2026-01-01/dataset/papers');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://datasets.example.test/diffs/2026-01-01/to/2026-02-01/papers');
    }

    public function test_tools_validate_arguments_merge_extra_query_and_convert_errors(): void
    {
        Http::fake(['*' => Http::response(['data' => [['paperId' => 'paper-1']]], 200)]);
        $service = new SemanticScholarService('key-test', 'https://graph.example.test', 'https://recommend.example.test', 'https://datasets.example.test');

        $search = (new SemanticScholarSearchPapers($service))->execute([
            'query' => 'test query',
            'extra' => ['limit' => 5, 'fields' => 'title'],
            'limit' => 2,
        ]);
        self::assertTrue($search->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'query=test%20query')
            && str_contains($request->url(), 'limit=2')
            && str_contains($request->url(), 'fields=title'));

        $missingQuery = (new SemanticScholarSearchPapers($service))->execute([]);
        self::assertFalse($missingQuery->succeeded());
        self::assertStringContainsString('query is required', (string) $missingQuery->error);

        $missingId = (new SemanticScholarGetAuthor($service))->execute([]);
        self::assertFalse($missingId->succeeded());
        self::assertStringContainsString('author_id is required', (string) $missingId->error);

        $missingBody = (new SemanticScholarBatchGetPapers($service))->execute([]);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('payload must be', (string) $missingBody->error);

        $recommend = (new SemanticScholarRecommendPapers($service))->execute(['payload' => ['positivePaperIds' => ['paper-1']], 'limit' => 1]);
        self::assertTrue($recommend->succeeded());

        $dataset = (new SemanticScholarGetDataset($service))->execute(['release_id' => '2026-01-01', 'dataset_name' => 'papers']);
        self::assertTrue($dataset->succeeded());

        $missingDiff = (new SemanticScholarGetDatasetDiffs($service))->execute(['start_release_id' => '2026-01-01', 'dataset_name' => 'papers']);
        self::assertFalse($missingDiff->succeeded());
        self::assertStringContainsString('end_release_id is required', (string) $missingDiff->error);

        $unconfigured = (new SemanticScholarSearchPapers(new SemanticScholarService()))->execute(['query' => 'test']);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('API key is not configured', (string) $unconfigured->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['message' => 'Invalid API key'], 401)]);
        $bad = (new SemanticScholarSearchPapers($service))->execute(['query' => 'test']);
        self::assertFalse($bad->succeeded());
        self::assertStringContainsString('Invalid API key', (string) $bad->error);
    }

    public function test_connection_and_multi_account_credentials(): void
    {
        Http::fake(['*' => Http::response(['data' => [['paperId' => 'paper-1']]], 200)]);

        $provider = new SemanticScholarToolProvider;
        $ok = $provider->testConnection(['api_key' => 'key-test']);

        self::assertTrue($ok['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://api.semanticscholar.org/graph/v1/paper/search?')
            && str_contains($request->url(), 'query=science')
            && $request->hasHeader('x-api-key', 'key-test'));

        $missingKey = $provider->testConnection([]);
        self::assertFalse($missingKey['success']);
        self::assertStringContainsString('No API key', (string) $missingKey['error']);

        $resolver = new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return [$integration, $key, $account] === ['semantic-scholar', 'api_key', 'acct_1'] ? 'key-account' : $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'semantic-scholar' && $account === 'acct_1';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'semantic-scholar' ? ['acct_1'] : [];
            }
        };

        Container::getInstance()->instance(CredentialResolver::class, $resolver);
        $tool = $provider->createTool(SemanticScholarSearchPapers::class, ['account' => 'acct_1']);
        $result = $tool->execute(['query' => 'agent', 'limit' => 1]);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.semanticscholar.org/graph/v1/paper/search?')
            && $request->hasHeader('x-api-key', 'key-account'));
    }
}
