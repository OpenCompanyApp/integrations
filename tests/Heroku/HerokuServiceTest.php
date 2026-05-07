<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Heroku;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Heroku\HerokuService;
use OpenCompany\Integrations\Heroku\HerokuToolProvider;
use OpenCompany\Integrations\Heroku\Tools\HerokuGetApp;
use OpenCompany\Integrations\Heroku\Tools\HerokuListAddons;
use OpenCompany\Integrations\Heroku\Tools\HerokuListApps;
use OpenCompany\Integrations\Heroku\Tools\HerokuListCollaborators;
use OpenCompany\Integrations\Heroku\Tools\HerokuListDomains;
use OpenCompany\Integrations\Heroku\Tools\HerokuListDynos;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Heroku Platform API endpoint mapping.
 */
final class HerokuServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        Container::getInstance()->forgetInstance(HerokuService::class);
        Container::getInstance()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        Container::getInstance()->forgetInstance(HerokuService::class);
        Container::getInstance()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_and_connection_contract(): void
    {
        $provider = new HerokuToolProvider;

        self::assertSame('heroku', $provider->appName());
        self::assertSame('Heroku', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('https://devcenter.heroku.com/articles/platform-api-reference', $provider->integrationMeta()['docs_url']);
        self::assertSame('https://devcenter.heroku.com/articles/platform-api-reference', $provider->integrationMeta()['source_url']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertCount(7, $provider->tools());
        self::assertArrayHasKey('heroku_list_apps', $provider->tools());
        self::assertArrayHasKey('heroku_get_current_user', $provider->tools());
        self::assertFileExists((string) $provider->luaDocsPath());

        Http::fake([
            'https://api.heroku.test/account' => Http::response(['email' => 'agent@example.test'], 200),
        ]);

        $result = $provider->testConnection([
            'api_key' => 'heroku-token',
            'url' => 'https://api.heroku.test',
        ]);

        self::assertTrue($result['success']);
        self::assertSame('Connected to Heroku as agent@example.test.', $result['message']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.heroku.test/account'
            && $request->hasHeader('Authorization', 'Bearer heroku-token')
            && $request->hasHeader('Accept', 'application/vnd.heroku+json; version=3'));
    }

    public function test_service_maps_core_platform_endpoints_and_headers(): void
    {
        Http::fake(['*' => Http::response([['id' => 'item']], 200)]);

        $service = new HerokuService('heroku-token', 'https://api.heroku.test');

        self::assertTrue($service->isConfigured());
        $service->getCurrentUser();
        $service->listApps();
        $service->getApp('agent-app');
        $service->listDynos('agent-app');
        $service->listAddons('agent-app');
        $service->listDomains('agent-app');
        $service->listCollaborators('agent-app');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.heroku.test/account'
            && $request->hasHeader('Authorization', 'Bearer heroku-token')
            && $request->hasHeader('Accept', 'application/vnd.heroku+json; version=3')
            && $request->hasHeader('Content-Type', 'application/json'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.heroku.test/apps');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.heroku.test/apps/agent-app');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.heroku.test/apps/agent-app/dynos');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.heroku.test/apps/agent-app/addons');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.heroku.test/apps/agent-app/domains');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.heroku.test/apps/agent-app/collaborators');
    }

    public function test_tools_shape_app_arguments_and_report_unconfigured_state(): void
    {
        Http::fake([
            'https://api.heroku.test/apps/agent-app' => Http::response(['name' => 'agent-app'], 200),
            'https://api.heroku.test/apps/agent-app/dynos' => Http::response([['name' => 'web.1']], 200),
            'https://api.heroku.test/apps/agent-app/addons' => Http::response([['name' => 'heroku-postgresql']], 200),
            'https://api.heroku.test/apps/agent-app/domains' => Http::response([['hostname' => 'example.test']], 200),
            'https://api.heroku.test/apps/agent-app/collaborators' => Http::response([['email' => 'dev@example.test']], 200),
            'https://api.heroku.test/apps' => Http::response([['name' => 'agent-app']], 200),
        ]);

        $service = new HerokuService('heroku-token', 'https://api.heroku.test');

        $apps = (new HerokuListApps($service))->execute([]);
        self::assertTrue($apps->succeeded());
        self::assertSame('agent-app', $apps->data[0]['name']);

        $app = (new HerokuGetApp($service))->execute(['app_id' => 'agent-app']);
        self::assertTrue($app->succeeded());
        self::assertSame('agent-app', $app->data['name']);

        $dynos = (new HerokuListDynos($service))->execute(['app_id' => 'agent-app']);
        self::assertTrue($dynos->succeeded());
        self::assertSame('web.1', $dynos->data[0]['name']);

        $addons = (new HerokuListAddons($service))->execute(['app_id' => 'agent-app']);
        self::assertTrue($addons->succeeded());
        self::assertSame('heroku-postgresql', $addons->data[0]['name']);

        $domains = (new HerokuListDomains($service))->execute(['app_id' => 'agent-app']);
        self::assertTrue($domains->succeeded());
        self::assertSame('example.test', $domains->data[0]['hostname']);

        $collaborators = (new HerokuListCollaborators($service))->execute(['app_id' => 'agent-app']);
        self::assertTrue($collaborators->succeeded());
        self::assertSame('dev@example.test', $collaborators->data[0]['email']);

        $unconfigured = (new HerokuListApps(new HerokuService))->execute([]);
        self::assertFalse($unconfigured->succeeded());
        self::assertSame('Heroku integration is not configured.', $unconfigured->error);
    }

    public function test_provider_resolves_named_account_credentials(): void
    {
        Http::fake([
            'https://tenant-heroku.example.test/apps' => Http::response([['name' => 'tenant-app']], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['heroku', 'api_key', 'workspace'] => 'tenant-heroku-token',
                    ['heroku', 'url', 'workspace'] => 'https://tenant-heroku.example.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'heroku' && $account === 'workspace';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'heroku' ? ['workspace'] : [];
            }
        });

        $tool = (new HerokuToolProvider)->createTool(HerokuListApps::class, ['account' => 'workspace']);
        $result = $tool->execute([]);

        self::assertTrue($result->succeeded());
        self::assertSame('tenant-app', $result->data[0]['name']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://tenant-heroku.example.test/apps'
            && $request->hasHeader('Authorization', 'Bearer tenant-heroku-token'));
    }
}
