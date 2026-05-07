<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Affinity;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Affinity\AffinityService;
use OpenCompany\Integrations\Affinity\AffinityToolProvider;
use OpenCompany\Integrations\Affinity\Tools\AffinityApiGet;
use OpenCompany\Integrations\Affinity\Tools\AffinityListContacts;
use OpenCompany\Integrations\Affinity\Tools\AffinityListListEntries;
use OpenCompany\Integrations\Affinity\Tools\AffinitySemanticSearch;
use OpenCompany\Integrations\Affinity\Tools\AffinityUpdateListEntryField;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Affinity API v2 endpoint coverage.
 */
final class AffinityServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_uses_bearer_auth_and_v2_paths(): void
    {
        Http::fake([
            'https://api.affinity.co/v2/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new AffinityService('aff_test');

        self::assertSame(['ok' => true], $service->getCurrentUser());
        self::assertSame(['ok' => true], $service->listContacts(['limit' => 25]));
        self::assertSame(['ok' => true], $service->getContact('person_test'));
        self::assertSame(['ok' => true], $service->listOrganizations(['limit' => 10]));
        self::assertSame(['ok' => true], $service->apiPost('/semantic-search', ['query' => 'founders']));

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer aff_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.affinity.co/v2/auth/user');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.affinity.co/v2/persons?limit=25');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.affinity.co/v2/persons/person_test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.affinity.co/v2/semantic-search' && $request['query'] === 'founders');
    }

    public function test_tools_delegate_and_validate_safe_raw_paths(): void
    {
        Http::fake([
            'https://api.affinity.co/v2/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new AffinityService('aff_test');

        self::assertTrue((new AffinityListContacts($service))->execute(['limit' => 10])->succeeded());
        self::assertTrue((new AffinityListListEntries($service))->execute([
            'list_id' => 'list_test',
            'limit' => 10,
        ])->succeeded());
        self::assertTrue((new AffinityUpdateListEntryField($service))->execute([
            'list_id' => 'list_test',
            'list_entry_id' => 'entry_test',
            'field_id' => 'field_test',
            'value' => 'Qualified',
        ])->succeeded());
        self::assertTrue((new AffinitySemanticSearch($service))->execute([
            'payload' => [
                'entity-type' => 'person',
                'query' => 'founders in fintech',
            ],
        ])->succeeded());
        self::assertTrue((new AffinityApiGet($service))->execute([
            'path' => '/persons',
            'params' => ['limit' => 1],
        ])->succeeded());
        self::assertFalse((new AffinityApiGet($service))->execute([
            'path' => 'https://example.test/persons',
        ])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.affinity.co/v2/persons?limit=10');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.affinity.co/v2/lists/list_test/list-entries?limit=10');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.affinity.co/v2/lists/list_test/list-entries/entry_test/fields/field_test' && $request['value'] === 'Qualified');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.affinity.co/v2/semantic-search' && $request['query'] === 'founders in fintech');
    }

    public function test_provider_exposes_current_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://api.affinity.co/v2/auth/user' => Http::response([
                'firstName' => 'Ada',
                'lastName' => 'Reader',
            ], 200),
        ]);

        $provider = new AffinityToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://developer.affinity.co/docs/v2/', $provider->integrationMeta()['docs_url']);
        self::assertArrayHasKey('affinity_list_contacts', $tools);
        self::assertArrayHasKey('affinity_list_organization_field_values', $tools);
        self::assertArrayHasKey('affinity_list_opportunities', $tools);
        self::assertArrayHasKey('affinity_list_list_entries', $tools);
        self::assertArrayHasKey('affinity_update_list_entry_field', $tools);
        self::assertArrayHasKey('affinity_list_saved_view_entries', $tools);
        self::assertArrayHasKey('affinity_list_transcript_fragments', $tools);
        self::assertArrayHasKey('affinity_semantic_search', $tools);
        self::assertArrayHasKey('affinity_api_delete', $tools);
        self::assertSame(52, count($tools));

        self::assertTrue($provider->testConnection(['api_key' => 'aff_test'])['success']);
    }
}
