<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Crossref;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Crossref\CrossrefService;
use OpenCompany\Integrations\Crossref\CrossrefToolProvider;
use OpenCompany\Integrations\Crossref\Tools\CrossrefGetMember;
use OpenCompany\Integrations\Crossref\Tools\CrossrefGetWork;
use OpenCompany\Integrations\Crossref\Tools\CrossrefListFunderWorks;
use OpenCompany\Integrations\Crossref\Tools\CrossrefListWorks;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the public Crossref REST API integration.
 */
final class CrossrefServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(CrossrefService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(CrossrefService::class);
        parent::tearDown();
    }

    public function test_provider_exposes_public_endpoint_surface_and_docs(): void
    {
        $provider = new CrossrefToolProvider;

        self::assertSame('crossref', $provider->appName());
        self::assertSame('Crossref', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('none', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertSame([], $provider->credentialFields());
        self::assertFileExists((string) $provider->luaDocsPath());

        self::assertSame([
            'crossref_list_works',
            'crossref_get_work',
            'crossref_get_work_agency',
            'crossref_list_journals',
            'crossref_get_journal',
            'crossref_list_journal_works',
            'crossref_list_members',
            'crossref_get_member',
            'crossref_list_member_works',
            'crossref_get_prefix',
            'crossref_list_prefix_works',
            'crossref_list_funders',
            'crossref_get_funder',
            'crossref_list_funder_works',
            'crossref_list_types',
            'crossref_get_type',
            'crossref_list_type_works',
            'crossref_list_licenses',
        ], array_keys($provider->tools()));
    }

    public function test_service_maps_all_documented_endpoint_families_and_normalizes_filters(): void
    {
        Http::fake(['*' => Http::response(['status' => 'ok', 'message' => ['items' => []]], 200)]);

        $service = new CrossrefService('https://example.test');
        $service->get('works', ['query' => 'agent systems', 'filter' => ['type' => 'journal-article', 'from-pub-date' => '2024-01-01'], 'select' => ['DOI', 'title'], 'mailto' => 'agent@example.test']);
        $service->get('works/'.rawurlencode('10.1128/mbio.01735-25'));
        $service->get('works/'.rawurlencode('10.1128/mbio.01735-25').'/agency');
        $service->get('journals');
        $service->get('journals/03064530');
        $service->get('journals/03064530/works', ['rows' => 1]);
        $service->get('members');
        $service->get('members/98');
        $service->get('members/98/works', ['rows' => 1]);
        $service->get('prefixes/10.5555');
        $service->get('prefixes/10.5555/works', ['rows' => 1]);
        $service->get('funders', ['query' => 'National Science Foundation']);
        $service->get('funders/10.13039/100000001');
        $service->get('funders/10.13039/100000001/works', ['rows' => 1]);
        $service->get('types');
        $service->get('types/journal-article');
        $service->get('types/journal-article/works', ['rows' => 1]);
        $service->get('licenses');

        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.test/works?')
            && str_contains($request->url(), 'query=agent%20systems')
            && str_contains($request->url(), 'filter=type%3Ajournal-article%2Cfrom-pub-date%3A2024-01-01')
            && str_contains($request->url(), 'select=DOI%2Ctitle')
            && str_contains($request->url(), 'mailto=agent%40example.test'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/works/10.1128%2Fmbio.01735-25');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/works/10.1128%2Fmbio.01735-25/agency');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/journals');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/journals/03064530');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.test/journals/03064530/works?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/members');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/members/98');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.test/members/98/works?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/prefixes/10.5555');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.test/prefixes/10.5555/works?'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.test/funders?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/funders/10.13039/100000001');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.test/funders/10.13039/100000001/works?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/types');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/types/journal-article');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.test/types/journal-article/works?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/licenses');
    }

    public function test_tools_validate_arguments_merge_extra_and_convert_errors(): void
    {
        Http::fake(['*' => Http::response(['status' => 'ok', 'message' => ['items' => []]], 200)]);
        $service = new CrossrefService('https://example.test');

        $list = (new CrossrefListWorks($service))->execute([
            'query' => 'agent',
            'extra' => ['rows' => 5, 'sort' => 'score'],
            'rows' => 2,
        ]);
        self::assertTrue($list->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'query=agent')
            && str_contains($request->url(), 'rows=2')
            && str_contains($request->url(), 'sort=score'));

        $work = (new CrossrefGetWork($service))->execute(['doi' => '10.1128/mbio.01735-25']);
        self::assertTrue($work->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/works/10.1128%2Fmbio.01735-25');

        $missing = (new CrossrefGetMember($service))->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('id is required', (string) $missing->error);

        $scoped = (new CrossrefListFunderWorks($service))->execute(['id' => '10.13039/100000001', 'filter' => ['type' => 'grant']]);
        self::assertTrue($scoped->succeeded());

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['status' => 'failed', 'message' => 'DOI not found'], 404)]);
        $bad = (new CrossrefGetWork($service))->execute(['doi' => '10.0000/missing']);
        self::assertFalse($bad->succeeded());
        self::assertStringContainsString('DOI not found', (string) $bad->error);
    }

    public function test_provider_create_tool_uses_bound_public_service(): void
    {
        Http::fake(['*' => Http::response(['status' => 'ok', 'message' => ['items' => []]], 200)]);

        $service = new CrossrefService('https://example.test');
        app()->instance(CrossrefService::class, $service);

        $tool = (new CrossrefToolProvider)->createTool(CrossrefListWorks::class);
        $result = $tool->execute(['rows' => 1]);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.test/works?'));
    }
}
