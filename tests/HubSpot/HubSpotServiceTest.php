<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\HubSpot;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\HubSpot\HubSpotService;
use OpenCompany\Integrations\HubSpot\HubSpotToolProvider;
use OpenCompany\Integrations\HubSpot\Tools\HubSpotGetCurrentUser;
use OpenCompany\Integrations\HubSpot\Tools\HubSpotListContacts;
use OpenCompany\Integrations\Hubspot3\Hubspot3ToolProvider as LegacyHubspot3ToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the HubSpot CRM integration and legacy hubspot3 alias.
 */
final class HubSpotServiceTest extends TestCase
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

    public function test_provider_exposes_canonical_tools_metadata_and_docs(): void
    {
        $provider = new HubSpotToolProvider;
        $tools = $provider->tools();

        self::assertSame('hubspot', $provider->appName());
        self::assertSame('HubSpot', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://developers.hubspot.com/docs/api/overview', $provider->integrationMeta()['docs_url']);
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());

        self::assertArrayHasKey('hubspot_list_contacts', $tools);
        self::assertArrayHasKey('hubspot_list_companies', $tools);
        self::assertArrayHasKey('hubspot_get_current_user', $tools);
        self::assertArrayHasKey('hubspot_create_ticket', $tools);
        self::assertArrayHasKey('hubspot_list_forms', $tools);
        self::assertGreaterThanOrEqual(28, count($tools));

        foreach ($tools as $tool) {
            self::assertTrue(class_exists($tool['class']), $tool['class'] . ' should exist.');
        }
    }

    public function test_service_maps_core_v3_account_and_base_url_requests(): void
    {
        Http::fake([
            'https://hubspot.example.test/*' => Http::response([
                'results' => [
                    ['id' => '1', 'properties' => ['email' => 'agent@example.test']],
                ],
                'paging' => ['next' => ['after' => 'next-cursor']],
            ], 200),
        ]);

        $service = new HubSpotService('hs-test', 'https://hubspot.example.test/v1');

        $service->listContacts(['limit' => 2, 'properties' => 'email,firstname']);
        $service->listCompanies(['after' => 'next']);
        $service->getCurrentUser();
        $service->listOwners(['limit' => 1]);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer hs-test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://hubspot.example.test/crm/v3/objects/contacts?')
            && str_contains($request->url(), 'limit=2')
            && str_contains($request->url(), 'properties='));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://hubspot.example.test/crm/v3/objects/companies?')
            && str_contains($request->url(), 'after=next'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://hubspot.example.test/integrations/v1/me');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://hubspot.example.test/crm/v3/owners?'));
    }

    public function test_tools_shape_contact_list_and_current_user_results(): void
    {
        Http::fake([
            'https://api.hubapi.com/crm/v3/objects/contacts*' => Http::response([
                'results' => [
                    ['id' => '101', 'properties' => ['email' => 'jane@example.test']],
                ],
                'paging' => ['next' => ['after' => 'next-cursor']],
            ], 200),
            'https://api.hubapi.com/integrations/v1/me' => Http::response([
                'user_id' => 123,
                'user' => 'jane@example.test',
                'first_name' => 'Jane',
                'last_name' => 'Example',
                'portal_id' => 456,
            ], 200),
        ]);

        $service = new HubSpotService('hs-test');

        self::assertTrue((new HubSpotListContacts($service))->execute([
            'limit' => 1,
            'properties' => ['email'],
        ])->succeeded());
        self::assertTrue((new HubSpotGetCurrentUser($service))->execute([])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://api.hubapi.com/crm/v3/objects/contacts?')
            && $request->hasHeader('Authorization', 'Bearer hs-test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.hubapi.com/integrations/v1/me');
    }

    public function test_legacy_hubspot3_package_aliases_canonical_provider_and_credentials(): void
    {
        $canonicalComposer = json_decode((string) file_get_contents(__DIR__ . '/../../packages/hubspot/composer.json'), true);
        $legacyComposer = json_decode((string) file_get_contents(__DIR__ . '/../../packages/hubspot3/composer.json'), true);

        self::assertSame('self.version', $canonicalComposer['replace']['opencompanyapp/integration-hubspot3']);
        self::assertSame('self.version', $canonicalComposer['replace']['opencompanyapp/ai-tool-hubspot3']);
        self::assertSame('opencompanyapp/integration-hubspot', $legacyComposer['abandoned']);

        $legacyProvider = new LegacyHubspot3ToolProvider;

        self::assertSame('hubspot', $legacyProvider->appName());
        self::assertSame('HubSpot', $legacyProvider->integrationMeta()['name']);
        self::assertArrayHasKey('hubspot_list_contacts', $legacyProvider->tools());

        Http::fake([
            'https://legacy.hubspot.example.test/crm/v3/objects/contacts*' => Http::response(['results' => []], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration === 'hubspot') {
                    return '';
                }

                if ($integration === 'hubspot3' && $account === 'work') {
                    return match ($key) {
                        'access_token' => 'legacy-hubspot-token',
                        'base_url' => 'https://legacy.hubspot.example.test/v1',
                        default => $default,
                    };
                }

                return $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'hubspot3' && $account === 'work';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'hubspot3' ? ['work'] : [];
            }
        });

        $tool = (new HubSpotToolProvider)->createTool(HubSpotListContacts::class, ['account' => 'work']);

        self::assertTrue($tool->execute([])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://legacy.hubspot.example.test/crm/v3/objects/contacts'
            && $request->hasHeader('Authorization', 'Bearer legacy-hubspot-token'));
    }
}
