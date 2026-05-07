<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Arxiv;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Arxiv\ArxivService;
use OpenCompany\Integrations\Arxiv\ArxivToolProvider;
use OpenCompany\Integrations\Arxiv\Tools\ArxivGetPapers;
use OpenCompany\Integrations\Arxiv\Tools\ArxivOaiGetRecord;
use OpenCompany\Integrations\Arxiv\Tools\ArxivOaiListRecords;
use OpenCompany\Integrations\Arxiv\Tools\ArxivSearchByAuthor;
use OpenCompany\Integrations\Arxiv\Tools\ArxivSearchPapers;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the public arXiv Atom API integration.
 */
final class ArxivServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(ArxivService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(ArxivService::class);
        parent::tearDown();
    }

    public function test_provider_exposes_public_tools_and_docs(): void
    {
        $provider = new ArxivToolProvider;

        self::assertSame('arxiv', $provider->appName());
        self::assertSame('arXiv', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('none', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertSame([], $provider->credentialFields());
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertSame([
            'arxiv_search_papers',
            'arxiv_get_papers',
            'arxiv_search_by_author',
            'arxiv_search_by_title',
            'arxiv_search_by_category',
            'arxiv_search_recent',
            'arxiv_oai_identify',
            'arxiv_oai_list_metadata_formats',
            'arxiv_oai_list_sets',
            'arxiv_oai_list_identifiers',
            'arxiv_oai_list_records',
            'arxiv_oai_get_record',
        ], array_keys($provider->tools()));
    }

    public function test_service_maps_query_parameters_and_parses_atom_metadata(): void
    {
        Http::fake(['*' => Http::response($this->atomFeed(), 200, ['Content-Type' => 'application/atom+xml'])]);

        $service = new ArxivService('https://example.test/api/query');
        $result = $service->query([
            'search_query' => 'cat:cs.AI AND ti:"agent"',
            'id_list' => ['2103.15348', '1706.03762'],
            'start' => 10,
            'max_results' => 2,
            'sortBy' => 'submittedDate',
            'sortOrder' => 'descending',
            'ignored' => 'drop-me',
        ]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://example.test/api/query?')
            && str_contains($request->url(), 'search_query=cat%3Acs.AI%20AND%20ti%3A%22agent%22')
            && str_contains($request->url(), 'id_list=2103.15348%2C1706.03762')
            && str_contains($request->url(), 'start=10')
            && str_contains($request->url(), 'max_results=2')
            && str_contains($request->url(), 'sortBy=submittedDate')
            && str_contains($request->url(), 'sortOrder=descending')
            && !str_contains($request->url(), 'ignored='));

        self::assertSame(42, $result['total_results']);
        self::assertSame(10, $result['start_index']);
        self::assertSame(2, $result['items_per_page']);
        self::assertCount(1, $result['entries']);
        self::assertSame('2103.15348v1', $result['entries'][0]['arxiv_id']);
        self::assertSame('Example Agent Paper', $result['entries'][0]['title']);
        self::assertSame(['Ada Lovelace', 'Grace Hopper'], $result['entries'][0]['authors']);
        self::assertSame('cs.AI', $result['entries'][0]['primary_category']);
        self::assertSame(['cs.AI', 'cs.LG'], $result['entries'][0]['categories']);
        self::assertSame('10.1000/example', $result['entries'][0]['doi']);
        self::assertSame('https://arxiv.org/pdf/2103.15348v1', $result['entries'][0]['pdf_url']);
    }

    public function test_get_by_ids_and_tools_validate_arguments_and_convert_errors(): void
    {
        Http::fake(['*' => Http::response($this->atomFeed(), 200)]);

        $service = new ArxivService('https://example.test/api/query');
        $byId = $service->getByIds(['2103.15348v1']);

        self::assertSame('2103.15348v1', $byId['entries'][0]['arxiv_id']);
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'id_list=2103.15348v1')
            && str_contains($request->url(), 'max_results=1'));

        $search = (new ArxivSearchPapers($service))->execute(['search_query' => 'all:electron', 'max_results' => 1]);
        self::assertTrue($search->succeeded());

        $missingSearch = (new ArxivSearchPapers($service))->execute([]);
        self::assertFalse($missingSearch->succeeded());
        self::assertStringContainsString('Provide search_query or id_list', (string) $missingSearch->error);

        $missingIds = (new ArxivGetPapers($service))->execute(['id_list' => []]);
        self::assertFalse($missingIds->succeeded());
        self::assertStringContainsString('id_list must be', (string) $missingIds->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response('bad gateway', 502)]);
        $bad = (new ArxivGetPapers($service))->execute(['id_list' => ['2103.15348']]);
        self::assertFalse($bad->succeeded());
        self::assertStringContainsString('arXiv API error (502)', (string) $bad->error);
    }

    public function test_focused_search_tools_build_official_queries(): void
    {
        Http::fake(['*' => Http::response($this->atomFeed(), 200)]);

        $service = new ArxivService('https://example.test/api/query');
        $result = (new ArxivSearchByAuthor($service))->execute([
            'author' => 'Ada Lovelace',
            'max_results' => 3,
        ]);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'search_query=au%3A%22Ada%20Lovelace%22')
            && str_contains($request->url(), 'max_results=3'));
    }

    public function test_oai_methods_map_parameters_and_parse_metadata(): void
    {
        Http::fake(['*' => Http::response($this->oaiRecords(), 200, ['Content-Type' => 'application/xml'])]);

        $service = new ArxivService('https://example.test/api/query', 'https://example.test/oai');
        $result = $service->oaiListRecords([
            'metadataPrefix' => 'arXiv',
            'from' => '2024-01-01',
            'until' => '2024-01-31',
            'set' => 'cs',
            'ignored' => 'drop-me',
        ]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://example.test/oai?')
            && str_contains($request->url(), 'verb=ListRecords')
            && str_contains($request->url(), 'metadataPrefix=arXiv')
            && str_contains($request->url(), 'from=2024-01-01')
            && str_contains($request->url(), 'until=2024-01-31')
            && str_contains($request->url(), 'set=cs')
            && !str_contains($request->url(), 'ignored='));

        self::assertSame('2024-02-01T00:00:00Z', $result['response_date']);
        self::assertSame('ListRecords', $result['request']['attributes']['verb']);
        self::assertSame([], $result['errors']);
        self::assertSame('oai:arXiv.org:2103.15348', $result['data']['ListRecords']['children']['record']['children']['header']['children']['identifier']);
        self::assertSame('2103.15348', $result['data']['ListRecords']['children']['record']['children']['metadata']['children']['arXiv']['children']['id']);
        self::assertSame('abc', $result['data']['ListRecords']['children']['resumptionToken']['_attributes']['cursor']);
    }

    public function test_oai_tools_default_metadata_prefix_and_validate_identifier(): void
    {
        Http::fake(['*' => Http::response($this->oaiRecords(), 200)]);

        $service = new ArxivService('https://example.test/api/query', 'https://example.test/oai');
        $records = (new ArxivOaiListRecords($service))->execute(['from' => '2024-01-01']);

        self::assertTrue($records->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'verb=ListRecords')
            && str_contains($request->url(), 'metadataPrefix=arXiv'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response($this->oaiRecords(), 200)]);
        $tokenPage = (new ArxivOaiListRecords($service))->execute([
            'resumptionToken' => 'next-token',
            'metadataPrefix' => 'arXiv',
        ]);
        self::assertTrue($tokenPage->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'verb=ListRecords')
            && str_contains($request->url(), 'resumptionToken=next-token')
            && !str_contains($request->url(), 'metadataPrefix='));

        $missing = (new ArxivOaiGetRecord($service))->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('Missing required argument: identifier', (string) $missing->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response($this->oaiRecords(), 200)]);
        $record = (new ArxivOaiGetRecord($service))->execute(['identifier' => 'oai:arXiv.org:2103.15348']);
        self::assertTrue($record->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'verb=GetRecord')
            && str_contains($request->url(), 'identifier=oai%3AarXiv.org%3A2103.15348')
            && str_contains($request->url(), 'metadataPrefix=arXiv'));
    }

    public function test_provider_create_tool_uses_bound_public_service(): void
    {
        Http::fake(['*' => Http::response($this->atomFeed(), 200)]);

        $service = new ArxivService('https://example.test/api/query');
        app()->instance(ArxivService::class, $service);
        $tool = (new ArxivToolProvider)->createTool(ArxivSearchPapers::class);
        $result = $tool->execute(['search_query' => 'cat:cs.AI']);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.test/api/query?'));
    }

    private function atomFeed(): string
    {
        return <<<'XML'
<?xml version="1.0" encoding="UTF-8"?>
<feed xmlns="http://www.w3.org/2005/Atom"
      xmlns:opensearch="http://a9.com/-/spec/opensearch/1.1/"
      xmlns:arxiv="http://arxiv.org/schemas/atom">
  <title>ArXiv Query: search_query=cat:cs.AI</title>
  <id>https://arxiv.org/api/query</id>
  <updated>2024-01-02T00:00:00Z</updated>
  <opensearch:totalResults>42</opensearch:totalResults>
  <opensearch:startIndex>10</opensearch:startIndex>
  <opensearch:itemsPerPage>2</opensearch:itemsPerPage>
  <entry>
    <id>https://arxiv.org/abs/2103.15348v1</id>
    <updated>2024-01-02T00:00:00Z</updated>
    <published>2021-03-29T00:00:00Z</published>
    <title> Example
      Agent Paper </title>
    <summary> A compact abstract
      with whitespace. </summary>
    <author><name>Ada Lovelace</name></author>
    <author><name>Grace Hopper</name></author>
    <arxiv:primary_category term="cs.AI" scheme="http://arxiv.org/schemas/atom"/>
    <category term="cs.AI" scheme="http://arxiv.org/schemas/atom"/>
    <category term="cs.LG" scheme="http://arxiv.org/schemas/atom"/>
    <arxiv:doi>10.1000/example</arxiv:doi>
    <arxiv:journal_ref>Example Journal</arxiv:journal_ref>
    <arxiv:comment>12 pages</arxiv:comment>
    <link href="https://arxiv.org/abs/2103.15348v1" rel="alternate" type="text/html"/>
    <link title="pdf" href="https://arxiv.org/pdf/2103.15348v1" rel="related" type="application/pdf"/>
  </entry>
</feed>
XML;
    }

    private function oaiRecords(): string
    {
        return <<<'XML'
<?xml version="1.0" encoding="UTF-8"?>
<OAI-PMH xmlns="http://www.openarchives.org/OAI/2.0/">
  <responseDate>2024-02-01T00:00:00Z</responseDate>
  <request verb="ListRecords" metadataPrefix="arXiv" from="2024-01-01" until="2024-01-31" set="cs">https://oaipmh.arxiv.org/oai</request>
  <ListRecords>
    <record>
      <header>
        <identifier>oai:arXiv.org:2103.15348</identifier>
        <datestamp>2024-01-02</datestamp>
        <setSpec>cs</setSpec>
      </header>
      <metadata>
        <arXiv xmlns="http://arxiv.org/OAI/arXiv/">
          <id>2103.15348</id>
          <created>2021-03-29</created>
          <updated>2024-01-02</updated>
          <title>Example Agent Paper</title>
          <authors>
            <author>
              <keyname>Lovelace</keyname>
              <forenames>Ada</forenames>
            </author>
          </authors>
          <categories>cs.AI cs.LG</categories>
          <abstract>A compact abstract.</abstract>
        </arXiv>
      </metadata>
    </record>
    <resumptionToken cursor="abc" completeListSize="42">next-token</resumptionToken>
  </ListRecords>
</OAI-PMH>
XML;
    }
}
