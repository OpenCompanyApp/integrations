<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\EuropePmc;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\EuropePmc\EuropePmcService;
use OpenCompany\Integrations\EuropePmc\EuropePmcToolProvider;
use OpenCompany\Integrations\EuropePmc\Tools\EuropePmcAnnotationsByArticleIds;
use OpenCompany\Integrations\EuropePmc\Tools\EuropePmcAnnotationsBySectionOrType;
use OpenCompany\Integrations\EuropePmc\Tools\EuropePmcArticle;
use OpenCompany\Integrations\EuropePmc\Tools\EuropePmcFullTextXml;
use OpenCompany\Integrations\EuropePmc\Tools\EuropePmcGrantsSearch;
use OpenCompany\Integrations\EuropePmc\Tools\EuropePmcReferences;
use OpenCompany\Integrations\EuropePmc\Tools\EuropePmcSearch;
use OpenCompany\Integrations\EuropePmc\Tools\EuropePmcSearchPost;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the public Europe PMC integration.
 */
final class EuropePmcServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(EuropePmcService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(EuropePmcService::class);
        parent::tearDown();
    }

    public function test_provider_exposes_public_tools_and_docs(): void
    {
        $provider = new EuropePmcToolProvider;

        self::assertSame('europe-pmc', $provider->appName());
        self::assertSame('Europe PMC', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('none', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertSame([], $provider->credentialFields());
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertSame([
            'europe_pmc_search',
            'europe_pmc_search_post',
            'europe_pmc_article',
            'europe_pmc_references',
            'europe_pmc_citations',
            'europe_pmc_database_links',
            'europe_pmc_labs_links',
            'europe_pmc_data_links',
            'europe_pmc_evaluations',
            'europe_pmc_full_text_xml',
            'europe_pmc_book_xml',
            'europe_pmc_supplementary_files',
            'europe_pmc_fields',
            'europe_pmc_profile',
            'europe_pmc_metrics',
            'europe_pmc_status_update_search',
            'europe_pmc_annotations_by_article_ids',
            'europe_pmc_annotations_by_entity',
            'europe_pmc_annotations_by_provider',
            'europe_pmc_annotations_by_relationship',
            'europe_pmc_annotations_by_section_or_type',
            'europe_pmc_grants_search',
        ], array_keys($provider->tools()));
    }

    public function test_search_maps_query_parameters_and_parses_json(): void
    {
        Http::fake(['*' => Http::response([
            'hitCount' => 1,
            'nextCursorMark' => 'next',
            'resultList' => ['result' => [['id' => '28585529', 'source' => 'MED']]],
        ], 200, ['Content-Type' => 'application/json'])]);

        $service = new EuropePmcService('https://example.test/rest');
        $result = (new EuropePmcSearch($service))->execute([
            'query' => 'TITLE:"agent"',
            'resultType' => 'core',
            'pageSize' => 25,
            'cursorMark' => '*',
            'synonym' => true,
            'extra' => ['pageSize' => 99, 'sort' => 'CITED desc'],
        ]);

        self::assertTrue($result->succeeded());
        self::assertSame(1, $result->data['hitCount']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://example.test/rest/search?')
            && str_contains($request->url(), 'query=TITLE%3A%22agent%22')
            && str_contains($request->url(), 'resultType=core')
            && str_contains($request->url(), 'pageSize=25')
            && str_contains($request->url(), 'cursorMark=%2A')
            && str_contains($request->url(), 'synonym=true')
            && str_contains($request->url(), 'sort=CITED%20desc'));
    }

    public function test_post_search_and_article_path_parameters_are_mapped(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new EuropePmcService('https://example.test/rest');
        $post = (new EuropePmcSearchPost($service))->execute([
            'query' => 'malaria',
            'resultType' => 'lite',
        ]);

        self::assertTrue($post->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/rest/searchPOST'
            && $request->data()['query'] === 'malaria'
            && $request->data()['resultType'] === 'lite'
            && $request->data()['format'] === 'json');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => '28585529'], 200)]);
        $article = (new EuropePmcArticle($service))->execute([
            'source' => 'MED',
            'id' => '28585529',
        ]);

        self::assertTrue($article->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.test/rest/article/MED/28585529?')
            && str_contains($request->url(), 'resultType=core')
            && str_contains($request->url(), 'format=json'));
    }

    public function test_reference_style_endpoints_and_xml_full_text_are_parsed(): void
    {
        Http::fake(['*' => Http::response(['referenceList' => ['reference' => [['id' => '1']]]], 200)]);

        $service = new EuropePmcService('https://example.test/rest');
        $refs = (new EuropePmcReferences($service))->execute([
            'source' => 'MED',
            'id' => '28585529',
            'page' => 2,
        ]);

        self::assertTrue($refs->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.test/rest/MED/28585529/references?')
            && str_contains($request->url(), 'page=2'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response($this->fullTextXml(), 200, ['Content-Type' => 'application/xml'])]);
        $xml = (new EuropePmcFullTextXml($service))->execute(['id' => 'PMC1664601']);

        self::assertTrue($xml->succeeded());
        self::assertSame('Example full text', $xml->data['xml']['front']['article-meta']['title-group']['article-title']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/rest/PMC1664601/fullTextXML');
    }

    public function test_annotations_and_grants_use_their_dedicated_api_families(): void
    {
        Http::fake([
            'https://example.test/annotations/*' => Http::response([['annotations' => [['exact' => 'BRCA1']]]], 200),
            'https://example.test/grist/*' => Http::response(['hitCount' => 1, 'resultList' => []], 200),
        ]);

        $service = new EuropePmcService(
            'https://example.test/rest',
            'https://example.test/annotations',
            'https://example.test/grist',
        );

        $annotations = (new EuropePmcAnnotationsByArticleIds($service))->execute([
            'articleIds' => ['MED:28585529', 'PMC:PMC1664601'],
            'type' => 'Chemicals',
        ]);

        self::assertTrue($annotations->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.test/annotations/annotationsByArticleIds?')
            && str_contains($request->url(), 'articleIds=MED%3A28585529%2CPMC%3APMC1664601')
            && str_contains($request->url(), 'type=Chemicals')
            && str_contains($request->url(), 'format=JSON'));

        $grants = (new EuropePmcGrantsSearch($service))->execute([
            'query' => 'ga:"Wellcome Trust" pi:smith',
            'resultType' => 'core',
            'page' => 2,
        ]);

        self::assertTrue($grants->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.test/grist/get/query=ga%3A%22Wellcome%20Trust%22%20pi%3Asmith?')
            && str_contains($request->url(), 'resultType=core')
            && str_contains($request->url(), 'format=json')
            && str_contains($request->url(), 'page=2'));
    }

    public function test_validation_and_api_errors_are_reported(): void
    {
        $service = new EuropePmcService('https://example.test/rest');

        $missing = (new EuropePmcSearch($service))->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('query is required', (string) $missing->error);

        $missingSectionType = (new EuropePmcAnnotationsBySectionOrType($service))->execute([]);
        self::assertFalse($missingSectionType->succeeded());
        self::assertStringContainsString('section or type is required', (string) $missingSectionType->error);

        Http::fake(['*' => Http::response(['message' => 'bad query'], 400)]);
        $bad = (new EuropePmcSearch($service))->execute(['query' => 'bad']);
        self::assertFalse($bad->succeeded());
        self::assertStringContainsString('bad query', (string) $bad->error);
    }

    public function test_provider_create_tool_uses_bound_public_service(): void
    {
        Http::fake(['*' => Http::response(['hitCount' => 1], 200)]);

        $service = new EuropePmcService('https://example.test/rest');
        app()->instance(EuropePmcService::class, $service);
        $tool = (new EuropePmcToolProvider)->createTool(EuropePmcSearch::class);
        $result = $tool->execute(['query' => 'malaria']);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.test/rest/search?'));
    }

    private function fullTextXml(): string
    {
        return <<<'XML'
<?xml version="1.0" encoding="UTF-8"?>
<article>
  <front>
    <article-meta>
      <title-group>
        <article-title>Example full text</article-title>
      </title-group>
    </article-meta>
  </front>
</article>
XML;
    }
}
