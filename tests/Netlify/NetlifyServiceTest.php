<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Netlify;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Netlify\NetlifyService;
use OpenCompany\Integrations\Netlify\NetlifyToolProvider;
use OpenCompany\Integrations\Netlify\Tools\NetlifyCreateDeploy;
use OpenCompany\Integrations\Netlify\Tools\NetlifyCreateSite;
use OpenCompany\Integrations\Netlify\Tools\NetlifyDeleteSite;
use OpenCompany\Integrations\Netlify\Tools\NetlifyGetDeploy;
use OpenCompany\Integrations\Netlify\Tools\NetlifyGetSite;
use OpenCompany\Integrations\Netlify\Tools\NetlifyListDeploys;
use OpenCompany\Integrations\Netlify\Tools\NetlifyListSites;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Netlify REST API endpoint mapping.
 */
final class NetlifyServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        Container::getInstance()->forgetInstance(NetlifyService::class);
        Container::getInstance()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        Container::getInstance()->forgetInstance(NetlifyService::class);
        Container::getInstance()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_and_connection_contract(): void
    {
        $provider = new NetlifyToolProvider;

        self::assertSame('netlify', $provider->appName());
        self::assertSame('Netlify', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('https://docs.netlify.com/api/get-started/', $provider->integrationMeta()['docs_url']);
        self::assertSame('https://github.com/netlify/open-api', $provider->integrationMeta()['source_url']);
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertCount(10, $provider->tools());
        self::assertArrayHasKey('netlify_create_site', $provider->tools());
        self::assertArrayHasKey('netlify_create_deploy', $provider->tools());
        self::assertArrayHasKey('netlify_delete_site', $provider->tools());
        self::assertFileExists((string) $provider->luaDocsPath());

        Http::fake([
            'https://api.netlify.test/api/v1/user' => Http::response([
                'id' => 'user-1',
                'email' => 'agent@example.test',
            ], 200),
        ]);

        $result = $provider->testConnection([
            'access_token' => 'netlify-token',
            'url' => 'https://api.netlify.test/api/v1',
        ]);

        self::assertTrue($result['success']);
        self::assertSame('Connected to Netlify API as agent@example.test.', $result['message']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.netlify.test/api/v1/user'
            && $request->hasHeader('Authorization', 'Bearer netlify-token'));
    }

    public function test_service_maps_sites_deploys_forms_dns_and_user_endpoints(): void
    {
        Http::fake(['*' => Http::response([['id' => 'item']], 200)]);

        $service = new NetlifyService('netlify-token', 'https://api.netlify.test/api/v1');

        self::assertTrue($service->isConfigured());
        $service->listSites(['name' => 'agent-site', 'page' => 2, 'per_page' => 25]);
        $service->createSite('agent-site', ['custom_domain' => 'example.test']);
        $service->getSite('site-123');
        $service->deleteSite('site-123');
        $service->listDeploys('site-123', ['page' => 3, 'per_page' => 10]);
        $service->createDeploy('site-123', ['async' => true], ['title' => 'Agent deploy']);
        $service->getDeploy('deploy-123');
        $service->listForms('site-123');
        $service->listDnsZones(['page' => 4, 'per_page' => 20]);
        $service->getCurrentUser();

        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://api.netlify.test/api/v1/sites?')
                && ($query['name'] ?? null) === 'agent-site'
                && ($query['page'] ?? null) === '2'
                && ($query['per_page'] ?? null) === '25'
                && $request->hasHeader('Authorization', 'Bearer netlify-token')
                && $request->hasHeader('Content-Type', 'application/json');
        });
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.netlify.test/api/v1/sites'
            && $request['name'] === 'agent-site'
            && $request['custom_domain'] === 'example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.netlify.test/api/v1/sites/site-123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://api.netlify.test/api/v1/sites/site-123');
        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://api.netlify.test/api/v1/sites/site-123/deploys?')
                && ($query['page'] ?? null) === '3'
                && ($query['per_page'] ?? null) === '10';
        });
        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'POST'
                && str_starts_with($request->url(), 'https://api.netlify.test/api/v1/sites/site-123/deploys?')
                && ($query['title'] ?? null) === 'Agent deploy'
                && $request['async'] === true;
        });
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.netlify.test/api/v1/deploys/deploy-123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.netlify.test/api/v1/sites/site-123/forms');
        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://api.netlify.test/api/v1/dns_zones?')
                && ($query['page'] ?? null) === '4'
                && ($query['per_page'] ?? null) === '20';
        });
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.netlify.test/api/v1/user');
    }

    public function test_tools_shape_read_write_payloads_and_unconfigured_state(): void
    {
        Http::fake([
            'https://api.netlify.test/api/v1/sites/site-123/deploys*' => Http::response([['id' => 'deploy-123', 'state' => 'ready']], 200),
            'https://api.netlify.test/api/v1/sites/site-123' => Http::response(['id' => 'site-123', 'name' => 'agent-site'], 200),
            'https://api.netlify.test/api/v1/sites*' => Http::response([['id' => 'site-123', 'name' => 'agent-site']], 200),
            'https://api.netlify.test/api/v1/deploys/deploy-123' => Http::response(['id' => 'deploy-123', 'state' => 'ready'], 200),
        ]);

        $service = new NetlifyService('netlify-token', 'https://api.netlify.test/api/v1');

        $createdSite = (new NetlifyCreateSite($service))->execute([
            'name' => 'agent-site',
            'custom_domain' => 'example.test',
        ]);
        self::assertTrue($createdSite->succeeded());

        $sites = (new NetlifyListSites($service))->execute(['name' => 'agent-site', 'page' => 1, 'per_page' => 5]);
        self::assertTrue($sites->succeeded());
        self::assertSame('site-123', $sites->data['sites'][0]['id']);

        $site = (new NetlifyGetSite($service))->execute(['site_id' => 'site-123']);
        self::assertTrue($site->succeeded());
        self::assertSame('site-123', $site->data['id']);

        $deploy = (new NetlifyCreateDeploy($service))->execute([
            'site_id' => 'site-123',
            'title' => 'Agent deploy',
            'body' => ['async' => true],
        ]);
        self::assertTrue($deploy->succeeded());

        $deploys = (new NetlifyListDeploys($service))->execute(['site_id' => 'site-123']);
        self::assertTrue($deploys->succeeded());
        self::assertSame('deploy-123', $deploys->data['deploys'][0]['id']);

        $gotDeploy = (new NetlifyGetDeploy($service))->execute(['deploy_id' => 'deploy-123']);
        self::assertTrue($gotDeploy->succeeded());
        self::assertSame('ready', $gotDeploy->data['state']);

        $deleted = (new NetlifyDeleteSite($service))->execute(['site_id' => 'site-123']);
        self::assertTrue($deleted->succeeded());

        $missing = (new NetlifyGetSite($service))->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertSame('site_id is required.', $missing->error);

        $unconfigured = (new NetlifyListSites(new NetlifyService))->execute([]);
        self::assertFalse($unconfigured->succeeded());
        self::assertSame('Netlify integration is not configured.', $unconfigured->error);
    }

    public function test_provider_resolves_named_account_credentials(): void
    {
        Http::fake([
            'https://tenant-netlify.example.test/api/v1/sites*' => Http::response([['id' => 'tenant-site']], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['netlify', 'access_token', 'workspace'] => 'tenant-netlify-token',
                    ['netlify', 'url', 'workspace'] => 'https://tenant-netlify.example.test/api/v1',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'netlify' && $account === 'workspace';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'netlify' ? ['workspace'] : [];
            }
        });

        $tool = (new NetlifyToolProvider)->createTool(NetlifyListSites::class, ['account' => 'workspace']);
        $result = $tool->execute(['per_page' => 5]);

        self::assertTrue($result->succeeded());
        self::assertSame('tenant-site', $result->data['sites'][0]['id']);

        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://tenant-netlify.example.test/api/v1/sites?')
                && ($query['per_page'] ?? null) === '5'
                && $request->hasHeader('Authorization', 'Bearer tenant-netlify-token');
        });
    }
}
