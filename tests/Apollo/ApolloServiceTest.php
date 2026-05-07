<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Apollo;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Apollo\ApolloService;
use OpenCompany\Integrations\Apollo\ApolloToolProvider;
use OpenCompany\Integrations\Apollo\Tools\ApolloBulkCreateContacts;
use OpenCompany\Integrations\Apollo\Tools\ApolloEnrich;
use OpenCompany\Integrations\Apollo\Tools\ApolloSearchContacts;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Apollo endpoint mappings and catalog metadata.
 */
final class ApolloServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_current_core_apollo_endpoints(): void
    {
        Http::fake([
            'https://api.apollo.test/*' => Http::response(['success' => true], 200),
        ]);

        $service = new ApolloService('apollo_test', 'https://api.apollo.test');

        $service->searchPeople(['q_keywords' => 'cto', 'page' => 1]);
        $service->enrichPerson(['email' => 'person@example.test']);
        $service->bulkEnrichPeople([['email' => 'one@example.test']], ['reveal_personal_emails' => false]);
        $service->searchOrganizations(['q_organization_name' => 'example']);
        $service->enrichOrganization('example.test');
        $service->bulkEnrichOrganizations(['example.test']);
        $service->listOrganizationJobPostings('org_123', ['per_page' => 10]);
        $service->searchContacts(['q_keywords' => 'jane']);
        $service->getContact('contact_123');
        $service->createContact(['email' => 'jane@example.test']);
        $service->updateContact('contact_123', ['title' => 'VP Sales']);
        $service->bulkCreateContacts([['email' => 'one@example.test']], ['run_dedupe' => true]);
        $service->listContactStages();
        $service->searchAccounts(['q_organization_name' => 'example']);
        $service->getAccount('account_123');
        $service->createAccount(['name' => 'Example Inc']);
        $service->updateAccount('account_123', ['domain' => 'example.test']);
        $service->bulkCreateAccounts([['domain' => 'example.test']]);
        $service->listAccountStages();
        $service->listUsers();
        $service->listEmailAccounts();
        $service->getApiUsageStats();

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('X-Api-Key', 'apollo_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && str_starts_with($request->url(), 'https://api.apollo.test/api/v1/mixed_people/api_search?') && str_contains($request->url(), 'q_keywords=cto'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && str_starts_with($request->url(), 'https://api.apollo.test/api/v1/people/match?') && str_contains($request->url(), 'email=person%40example.test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && str_starts_with($request->url(), 'https://api.apollo.test/api/v1/people/bulk_match?') && $request['details'][0]['email'] === 'one@example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && str_starts_with($request->url(), 'https://api.apollo.test/api/v1/mixed_companies/search?') && str_contains($request->url(), 'q_organization_name=example'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.apollo.test/api/v1/organizations/enrich?') && str_contains($request->url(), 'domain=example.test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && str_starts_with($request->url(), 'https://api.apollo.test/api/v1/organizations/bulk_enrich?') && str_contains($request->url(), 'domains%5B%5D=example.test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.apollo.test/api/v1/organizations/org_123/job_postings?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.apollo.test/api/v1/contacts/search' && $request['q_keywords'] === 'jane');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.apollo.test/api/v1/contacts/contact_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://api.apollo.test/api/v1/contacts/contact_123' && $request['title'] === 'VP Sales');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.apollo.test/api/v1/contacts/bulk_create' && $request['run_dedupe'] === true);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.apollo.test/api/v1/contact_stages');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.apollo.test/api/v1/accounts/search' && $request['q_organization_name'] === 'example');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.apollo.test/api/v1/accounts/account_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://api.apollo.test/api/v1/accounts/account_123' && $request['domain'] === 'example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.apollo.test/api/v1/accounts/bulk_create');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.apollo.test/api/v1/account_stages');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.apollo.test/api/v1/users');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.apollo.test/api/v1/email_accounts');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.apollo.test/api/v1/usage_stats/api_usage');
    }

    public function test_tools_delegate_to_current_service_methods(): void
    {
        Http::fake([
            'https://api.apollo.test/*' => Http::response(['success' => true], 200),
        ]);

        $service = new ApolloService('apollo_test', 'https://api.apollo.test');

        self::assertNull((new ApolloSearchContacts($service))->execute(['q' => 'legacy alias'])->error);
        self::assertNull((new ApolloEnrich($service))->execute(['email' => 'person@example.test'])->error);
        self::assertNull((new ApolloBulkCreateContacts($service))->execute(['contacts' => [['email' => 'one@example.test']]])->error);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.apollo.test/api/v1/contacts/search' && $request['q_keywords'] === 'legacy alias');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && str_starts_with($request->url(), 'https://api.apollo.test/api/v1/people/match?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.apollo.test/api/v1/contacts/bulk_create' && $request['contacts'][0]['email'] === 'one@example.test');
    }

    public function test_provider_exposes_expanded_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://api.apollo.io/v1/auth/health' => Http::response(['is_logged_in' => true, 'is_api_key_valid' => true], 200),
        ]);

        $provider = new ApolloToolProvider();
        $tools = $provider->tools();

        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('https://docs.apollo.io/', $provider->integrationMeta()['docs_url']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertSame(['api_key'], $provider->integrationCapabilities()['auth']['token_keys']);
        self::assertArrayHasKey('apollo_search_people', $tools);
        self::assertArrayHasKey('apollo_bulk_enrich_people', $tools);
        self::assertArrayHasKey('apollo_enrich_organization', $tools);
        self::assertArrayHasKey('apollo_bulk_create_contacts', $tools);
        self::assertArrayHasKey('apollo_search_accounts', $tools);
        self::assertArrayHasKey('apollo_get_api_usage_stats', $tools);
        self::assertSame(23, count($tools));

        self::assertTrue($provider->testConnection(['api_key' => 'apollo_test'])['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.apollo.io/v1/auth/health'
            && $request->hasHeader('X-Api-Key', 'apollo_test'));
    }
}
