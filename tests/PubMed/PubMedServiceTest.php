<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\PubMed;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\PubMed\PubMedService;
use OpenCompany\Integrations\PubMed\PubMedToolProvider;
use OpenCompany\Integrations\PubMed\Tools\PubMedCitationMatch;
use OpenCompany\Integrations\PubMed\Tools\PubMedFetch;
use OpenCompany\Integrations\PubMed\Tools\PubMedInfo;
use OpenCompany\Integrations\PubMed\Tools\PubMedLink;
use OpenCompany\Integrations\PubMed\Tools\PubMedPost;
use OpenCompany\Integrations\PubMed\Tools\PubMedSearch;
use OpenCompany\Integrations\PubMed\Tools\PubMedSummary;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the public PubMed and NCBI E-utilities integration.
 */
final class PubMedServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(PubMedService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(PubMedService::class);
        parent::tearDown();
    }

    public function test_provider_exposes_public_eutilities_tools_and_docs(): void
    {
        $provider = new PubMedToolProvider;

        self::assertSame('pubmed', $provider->appName());
        self::assertSame('PubMed', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('none', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertSame([], $provider->credentialFields());
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertSame([
            'pubmed_search',
            'pubmed_summary',
            'pubmed_fetch',
            'pubmed_link',
            'pubmed_info',
            'pubmed_post',
            'pubmed_spell',
            'pubmed_global_query',
            'pubmed_citation_match',
        ], array_keys($provider->tools()));
    }

    public function test_search_maps_esearch_parameters_and_parses_json(): void
    {
        Http::fake(['*' => Http::response([
            'header' => ['type' => 'esearch'],
            'esearchresult' => [
                'count' => '2',
                'retmax' => '2',
                'retstart' => '0',
                'idlist' => ['40654110', '40654099'],
                'querykey' => '1',
                'webenv' => 'NCID_1',
            ],
        ], 200, ['Content-Type' => 'application/json'])]);

        $service = new PubMedService('https://example.test/eutils');
        $result = $service->search([
            'db' => 'pubmed',
            'term' => 'large language model',
            'retmax' => 2,
            'usehistory' => true,
            'api_key' => 'key-test',
            'email' => 'dev@example.test',
            'ignored_null' => null,
        ]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://example.test/eutils/esearch.fcgi?')
            && str_contains($request->url(), 'db=pubmed')
            && str_contains($request->url(), 'term=large%20language%20model')
            && str_contains($request->url(), 'retmax=2')
            && str_contains($request->url(), 'usehistory=y')
            && str_contains($request->url(), 'api_key=key-test')
            && str_contains($request->url(), 'email=dev%40example.test')
            && !str_contains($request->url(), 'ignored_null='));

        self::assertSame(['40654110', '40654099'], $result['esearchresult']['idlist']);
        self::assertSame('NCID_1', $result['esearchresult']['webenv']);
    }

    public function test_fetch_parses_xml_and_summary_requires_ids_or_history(): void
    {
        Http::fake(['*' => Http::response($this->pubmedXml(), 200, ['Content-Type' => 'application/xml'])]);

        $service = new PubMedService('https://example.test/eutils');
        $result = (new PubMedFetch($service))->execute([
            'id' => ['40654110', '40654099'],
            'rettype' => 'abstract',
            'retmode' => 'xml',
        ]);

        self::assertTrue($result->succeeded());
        self::assertSame('40654110', $result->data['xml']['PubmedArticle']['MedlineCitation']['PMID']);
        self::assertSame('Example Article', $result->data['xml']['PubmedArticle']['MedlineCitation']['Article']['ArticleTitle']);
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.test/eutils/efetch.fcgi?')
            && str_contains($request->url(), 'id=40654110%2C40654099')
            && str_contains($request->url(), 'rettype=abstract')
            && str_contains($request->url(), 'retmode=xml'));

        $missing = (new PubMedSummary($service))->execute(['retmax' => 10]);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('Provide id or both query_key and WebEnv', (string) $missing->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['result' => ['uids' => ['40654110']]], 200)]);
        $history = (new PubMedSummary($service))->execute([
            'query_key' => '1',
            'WebEnv' => 'NCID_1',
            'retmax' => 1,
        ]);
        self::assertTrue($history->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'esummary.fcgi?')
            && str_contains($request->url(), 'query_key=1')
            && str_contains($request->url(), 'WebEnv=NCID_1')
            && str_contains($request->url(), 'retmax=1'));
    }

    public function test_post_and_citation_match_send_form_bodies_to_official_endpoints(): void
    {
        Http::fake([
            'https://example.test/eutils/epost.fcgi*' => Http::response(['epostresult' => ['querykey' => '1', 'webenv' => 'NCID_1']], 200),
            'https://example.test/eutils/ecitmatch.cgi*' => Http::response("proc natl acad sci u s a|1991|88|3248|mann bj|example-1|2014248\n", 200, ['Content-Type' => 'text/plain']),
        ]);

        $service = new PubMedService('https://example.test/eutils');
        $posted = (new PubMedPost($service))->execute([
            'id' => ['40654110', '40654099'],
            'api_key' => 'key-test',
        ]);

        self::assertTrue($posted->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && str_starts_with($request->url(), 'https://example.test/eutils/epost.fcgi?')
            && str_contains($request->url(), 'db=pubmed')
            && str_contains($request->url(), 'retmode=json')
            && str_contains($request->url(), 'api_key=key-test')
            && $request->data()['id'] === '40654110,40654099');

        $matched = (new PubMedCitationMatch($service))->execute([
            'citations' => [
                'proc natl acad sci u s a|1991|88|3248|mann bj|example-1|',
            ],
        ]);

        self::assertTrue($matched->succeeded());
        self::assertStringContainsString('2014248', $matched->data['body']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && str_starts_with($request->url(), 'https://example.test/eutils/ecitmatch.cgi?')
            && str_contains($request->url(), 'db=pubmed')
            && $request->data()['bdata'] === 'proc natl acad sci u s a|1991|88|3248|mann bj|example-1|');
    }

    public function test_info_can_list_databases_and_link_accepts_history_server_keys(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new PubMedService('https://example.test/eutils');
        $info = (new PubMedInfo($service))->execute([]);

        self::assertTrue($info->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.test/eutils/einfo.fcgi?')
            && str_contains($request->url(), 'retmode=json')
            && !str_contains($request->url(), 'db='));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['linksets' => []], 200)]);
        $link = (new PubMedLink($service))->execute([
            'query_key' => '1',
            'WebEnv' => 'NCID_1',
            'db' => 'pmc',
            'cmd' => 'neighbor_history',
        ]);

        self::assertTrue($link->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'elink.fcgi?')
            && str_contains($request->url(), 'query_key=1')
            && str_contains($request->url(), 'WebEnv=NCID_1')
            && str_contains($request->url(), 'dbfrom=pubmed')
            && str_contains($request->url(), 'db=pmc')
            && str_contains($request->url(), 'cmd=neighbor_history'));
    }

    public function test_tools_merge_extra_top_level_overrides_and_convert_api_errors(): void
    {
        Http::fake(['*' => Http::response([
            'esearchresult' => ['count' => '1', 'idlist' => ['40654110']],
        ], 200)]);

        $service = new PubMedService('https://example.test/eutils');
        $result = (new PubMedSearch($service))->execute([
            'term' => 'asthma',
            'retmax' => 1,
            'extra' => ['retmax' => 99, 'field' => 'Title'],
        ]);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'retmax=1')
            && str_contains($request->url(), 'field=Title'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['error' => 'API rate limit exceeded'], 200)]);
        $bad = (new PubMedSearch($service))->execute(['term' => 'asthma']);

        self::assertFalse($bad->succeeded());
        self::assertStringContainsString('API rate limit exceeded', (string) $bad->error);
    }

    public function test_provider_create_tool_uses_bound_public_service(): void
    {
        Http::fake(['*' => Http::response(['esearchresult' => ['count' => '1', 'idlist' => ['40654110']]], 200)]);

        $service = new PubMedService('https://example.test/eutils');
        app()->instance(PubMedService::class, $service);
        $tool = (new PubMedToolProvider)->createTool(PubMedSearch::class);
        $result = $tool->execute(['term' => 'asthma']);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.test/eutils/esearch.fcgi?'));
    }

    private function pubmedXml(): string
    {
        return <<<'XML'
<?xml version="1.0" encoding="UTF-8"?>
<PubmedArticleSet>
  <PubmedArticle>
    <MedlineCitation>
      <PMID>40654110</PMID>
      <Article>
        <ArticleTitle>Example Article</ArticleTitle>
        <Abstract>
          <AbstractText Label="BACKGROUND">Example abstract.</AbstractText>
        </Abstract>
      </Article>
    </MedlineCitation>
  </PubmedArticle>
</PubmedArticleSet>
XML;
    }
}
