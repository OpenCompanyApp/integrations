<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\MicrosoftSharePoint;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\MicrosoftSharePoint\MicrosoftSharePointService;
use OpenCompany\Integrations\MicrosoftSharePoint\MicrosoftSharePointToolProvider;
use OpenCompany\Integrations\MicrosoftSharePoint\Tools\MicrosoftSharePointSitesCreateLists;
use OpenCompany\Integrations\MicrosoftSharePoint\Tools\MicrosoftSharePointSitesListsListItems;
use OpenCompany\Integrations\MicrosoftSharePoint\Tools\MicrosoftSharePointSitesSiteGetSite;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the generated Microsoft SharePoint Graph integration.
 */
final class MicrosoftSharePointServiceTest extends TestCase
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
        parent::tearDown();
    }

    public function test_provider_matches_openapi_manifest_and_docs(): void
    {
        $provider = new MicrosoftSharePointToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/microsoft-sharepoint/microsoft-sharepoint-openapi-manifest.json'), true);

        self::assertSame(1193, $manifest['method_count']);
        self::assertSame('v1.0', $manifest['version']);
        self::assertSame(['/sites', '/drives', '/shares'], $manifest['path_prefixes']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Microsoft SharePoint', $provider->integrationMeta()['name']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertContains('microsoft_sharepoint_sites_site_list_site', array_keys($provider->tools()));
        self::assertContains('microsoft_sharepoint_sites_get_all_sites', array_keys($provider->tools()));
        self::assertContains('microsoft_sharepoint_sites_lists_list_items', array_keys($provider->tools()));
        self::assertContains('microsoft_sharepoint_drives_update_items_content', array_keys($provider->tools()));
    }

    public function test_service_maps_bearer_path_odata_query_headers_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new MicrosoftSharePointService('graph-token', 'https://graph.example.test/v1.0');
        $service->request('GET', '/sites/{site-id}/lists/{list-id}/items', ['site-id' => 'contoso site', 'list-id' => 'list 1'], ['$top' => 5, '$expand' => 'fields', '$count' => true], ['ConsistencyLevel' => 'eventual']);
        $service->request('POST', '/sites/{site-id}/lists', ['site-id' => 'contoso site'], [], [], ['displayName' => 'Launch']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/sites/contoso%20site/lists/list%201/items?%24top=5&%24expand=fields&%24count=true'
            && $request->hasHeader('Authorization', 'Bearer graph-token')
            && $request->hasHeader('ConsistencyLevel', 'eventual'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://graph.example.test/v1.0/sites/contoso%20site/lists'
            && $request->data()['displayName'] === 'Launch');
    }

    public function test_tools_validate_and_map_parameters(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new MicrosoftSharePointService('graph-token', 'https://graph.example.test/v1.0');

        self::assertTrue((new MicrosoftSharePointSitesSiteGetSite($service))->execute(['site_id' => 'site-123', 'select' => 'id,displayName'])->succeeded());
        self::assertTrue((new MicrosoftSharePointSitesListsListItems($service))->execute(['site_id' => 'site-123', 'list_id' => 'list-123', 'expand' => 'fields'])->succeeded());
        self::assertTrue((new MicrosoftSharePointSitesCreateLists($service))->execute(['site_id' => 'site-123', 'body' => ['displayName' => 'Launch']])->succeeded());

        $missingPath = (new MicrosoftSharePointSitesSiteGetSite($service))->execute([]);
        $badBody = (new MicrosoftSharePointSitesCreateLists($service))->execute(['site_id' => 'site-123', 'body' => 'not-object']);
        $missingBody = (new MicrosoftSharePointSitesCreateLists($service))->execute(['site_id' => 'site-123']);
        $unconfigured = (new MicrosoftSharePointSitesSiteGetSite(new MicrosoftSharePointService('', 'https://graph.example.test/v1.0')))->execute(['site_id' => 'site-123']);

        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('site_id must be a non-empty parameter', (string) $missingPath->error);
        self::assertFalse($badBody->succeeded());
        self::assertStringContainsString('body must be an object', (string) $badBody->error);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be a non-empty object', (string) $missingBody->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('access token is required', (string) $unconfigured->error);
    }

    public function test_connection_uses_root_site_probe(): void
    {
        Http::fake(['graph.example.test/v1.0/sites/root' => Http::response(['id' => 'root-site'], 200)]);

        $result = (new MicrosoftSharePointToolProvider)->testConnection([
            'access_token' => 'graph-token',
            'base_url' => 'https://graph.example.test/v1.0',
        ]);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/sites/root'
            && $request->hasHeader('Authorization', 'Bearer graph-token'));
    }

    public function test_create_tool_resolves_account_specific_credentials(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                $values = [
                    'access_token' => $account === 'work' ? 'work-token' : 'default-token',
                    'base_url' => 'https://graph.example.test/v1.0',
                ];

                return $values[$key] ?? $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return true;
            }

            public function getAccounts(string $integration): array
            {
                return ['work'];
            }
        });

        $tool = (new MicrosoftSharePointToolProvider)->createTool(MicrosoftSharePointSitesSiteGetSite::class, ['account' => 'work']);
        self::assertTrue($tool->execute(['site_id' => 'site-123'])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer work-token'));
    }
}
