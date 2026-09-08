<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\FlyIo;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\FlyIo\FlyIoService;
use OpenCompany\Integrations\FlyIo\FlyIoToolProvider;
use OpenCompany\Integrations\FlyIo\Tools\FlyIoCreateApp;
use OpenCompany\Integrations\FlyIo\Tools\FlyIoGetApp;
use OpenCompany\Integrations\FlyIo\Tools\FlyIoGetMachine;
use OpenCompany\Integrations\FlyIo\Tools\FlyIoListApps;
use OpenCompany\Integrations\FlyIo\Tools\FlyIoListMachines;
use OpenCompany\Integrations\FlyIo\Tools\FlyIoListVolumes;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Fly.io Machines API endpoint mapping.
 */
final class FlyIoServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        Container::getInstance()->forgetInstance(FlyIoService::class);
        Container::getInstance()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        Container::getInstance()->forgetInstance(FlyIoService::class);
        Container::getInstance()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_and_connection_contract(): void
    {
        $provider = new FlyIoToolProvider;

        self::assertSame('fly-io', $provider->appName());
        self::assertSame('Fly.io', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('https://fly.io/docs/machines/api/', $provider->integrationMeta()['docs_url']);
        self::assertSame('https://fly.io/docs/machines/api/', $provider->integrationMeta()['source_url']);
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertCount(6, $provider->tools());
        self::assertArrayHasKey('fly_io_list_apps', $provider->tools());
        self::assertArrayHasKey('fly_io_create_app', $provider->tools());
        self::assertArrayNotHasKey('fly_io_get_current_user', $provider->tools());
        self::assertFileExists((string) $provider->scriptDocsPath());

        Http::fake([
            'https://api.fly.test/v1/apps' => Http::response([['name' => 'agent-app']], 200),
        ]);

        $result = $provider->testConnection([
            'access_token' => 'fly-token',
            'url' => 'https://api.fly.test/v1',
        ]);

        self::assertTrue($result['success']);
        self::assertSame('Connected to Fly.io Machines API.', $result['message']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.fly.test/v1/apps'
            && $request->hasHeader('Authorization', 'Bearer fly-token'));
    }

    public function test_service_maps_app_machine_and_volume_endpoints(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new FlyIoService('fly-token', 'https://api.fly.test/v1');

        self::assertTrue($service->isConfigured());
        $service->listApps();
        $service->getApp('agent-app');
        $service->createApp(['app_name' => 'agent-app', 'org_slug' => 'personal']);
        $service->listMachines('agent-app');
        $service->getMachine('agent-app', 'machine-123');
        $service->listVolumes('agent-app');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.fly.test/v1/apps'
            && $request->hasHeader('Authorization', 'Bearer fly-token')
            && $request->hasHeader('Content-Type', 'application/json'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.fly.test/v1/apps/agent-app');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.fly.test/v1/apps'
            && $request['app_name'] === 'agent-app'
            && $request['org_slug'] === 'personal');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.fly.test/v1/apps/agent-app/machines');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.fly.test/v1/apps/agent-app/machines/machine-123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.fly.test/v1/apps/agent-app/volumes');
    }

    public function test_tools_shape_arguments_and_report_unconfigured_state(): void
    {
        Http::fake([
            'https://api.fly.test/v1/apps/agent-app/machines/machine-123' => Http::response(['id' => 'machine-123'], 200),
            'https://api.fly.test/v1/apps/agent-app/machines' => Http::response([['id' => 'machine-123']], 200),
            'https://api.fly.test/v1/apps/agent-app/volumes' => Http::response([['id' => 'vol-123']], 200),
            'https://api.fly.test/v1/apps/agent-app' => Http::response(['name' => 'agent-app'], 200),
            'https://api.fly.test/v1/apps' => Http::response([['name' => 'agent-app']], 200),
        ]);

        $service = new FlyIoService('fly-token', 'https://api.fly.test/v1');

        $created = (new FlyIoCreateApp($service))->execute(['app_name' => 'agent-app', 'org_slug' => 'personal']);
        self::assertTrue($created->succeeded());

        $apps = (new FlyIoListApps($service))->execute([]);
        self::assertTrue($apps->succeeded());
        self::assertSame('agent-app', $apps->data[0]['name']);

        $app = (new FlyIoGetApp($service))->execute(['app_name' => 'agent-app']);
        self::assertTrue($app->succeeded());
        self::assertSame('agent-app', $app->data['name']);

        $machines = (new FlyIoListMachines($service))->execute(['app_name' => 'agent-app']);
        self::assertTrue($machines->succeeded());
        self::assertSame('machine-123', $machines->data[0]['id']);

        $machine = (new FlyIoGetMachine($service))->execute(['app_name' => 'agent-app', 'machine_id' => 'machine-123']);
        self::assertTrue($machine->succeeded());
        self::assertSame('machine-123', $machine->data['id']);

        $volumes = (new FlyIoListVolumes($service))->execute(['app_name' => 'agent-app']);
        self::assertTrue($volumes->succeeded());
        self::assertSame('vol-123', $volumes->data[0]['id']);

        $missing = (new FlyIoGetMachine($service))->execute(['app_name' => 'agent-app']);
        self::assertFalse($missing->succeeded());
        self::assertSame('The machine_id parameter is required.', $missing->error);

        $unconfigured = (new FlyIoListApps(new FlyIoService))->execute([]);
        self::assertFalse($unconfigured->succeeded());
        self::assertSame('Fly.io integration is not configured.', $unconfigured->error);
    }

    public function test_provider_resolves_named_account_credentials(): void
    {
        Http::fake([
            'https://tenant-fly.example.test/v1/apps' => Http::response([['name' => 'tenant-app']], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['fly-io', 'access_token', 'workspace'] => 'tenant-fly-token',
                    ['fly-io', 'url', 'workspace'] => 'https://tenant-fly.example.test/v1',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'fly-io' && $account === 'workspace';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'fly-io' ? ['workspace'] : [];
            }
        });

        $tool = (new FlyIoToolProvider)->createTool(FlyIoListApps::class, ['account' => 'workspace']);
        $result = $tool->execute([]);

        self::assertTrue($result->succeeded());
        self::assertSame('tenant-app', $result->data[0]['name']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://tenant-fly.example.test/v1/apps'
            && $request->hasHeader('Authorization', 'Bearer tenant-fly-token'));
    }
}
