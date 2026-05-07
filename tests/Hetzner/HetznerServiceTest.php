<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Hetzner;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Hetzner\HetznerOperations;
use OpenCompany\Integrations\Hetzner\HetznerService;
use OpenCompany\Integrations\Hetzner\HetznerToolProvider;
use OpenCompany\Integrations\Hetzner\Tools\HetznerCreateServer;
use OpenCompany\Integrations\Hetzner\Tools\HetznerGetServer;
use OpenCompany\Integrations\Hetzner\Tools\HetznerListServers;
use PHPUnit\Framework\TestCase;

final class HetznerServiceTest extends TestCase
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

    public function test_provider_exposes_generated_metadata_and_tools(): void
    {
        $provider = new HetznerToolProvider;

        self::assertSame('hetzner', $provider->appName());
        self::assertSame('Hetzner Cloud', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://docs.hetzner.cloud/reference/cloud', $provider->integrationMeta()['docs_url']);
        self::assertSame('https://docs.hetzner.cloud/cloud.spec.json', $provider->integrationMeta()['source_url']);
        self::assertCount(189, HetznerOperations::all());
        self::assertCount(189, $provider->tools());
        self::assertArrayHasKey('hetzner_list_servers', $provider->tools());
        self::assertArrayHasKey('hetzner_get_server', $provider->tools());
        self::assertArrayHasKey('hetzner_create_server', $provider->tools());
        self::assertArrayHasKey('hetzner_list_volumes', $provider->tools());
        self::assertArrayHasKey('hetzner_list_networks', $provider->tools());
        self::assertArrayHasKey('hetzner_create_firewall', $provider->tools());
        self::assertArrayNotHasKey('hetzner_get_current_user', $provider->tools());
    }

    public function test_service_maps_common_hetzner_endpoints_and_bearer_auth(): void
    {
        Http::fake([
            'https://hcloud.example.test/v1/servers/123' => Http::response(['server' => ['id' => 123]], 200),
            'https://hcloud.example.test/v1/servers*' => Http::response(['servers' => [['id' => 123]]], 200),
            'https://hcloud.example.test/v1/volumes*' => Http::response(['volumes' => []], 200),
            'https://hcloud.example.test/v1/networks*' => Http::response(['networks' => []], 200),
            'https://hcloud.example.test/v1/ssh_keys*' => Http::response(['ssh_keys' => []], 200),
        ]);

        $service = new HetznerService(accessToken: 'hcloud-token', baseUrl: 'https://hcloud.example.test/v1');

        self::assertSame(['servers' => [['id' => 123]]], $service->listServers(10, 2));
        self::assertSame(['server' => ['id' => 123]], $service->getServer('123'));
        self::assertSame(['servers' => [['id' => 123]]], $service->createServer('agent-demo', 'cx22', 'ubuntu-24.04', 'fsn1', ['ssh_keys' => ['agent-key']]));
        self::assertSame(['volumes' => []], $service->listVolumes());
        self::assertSame(['networks' => []], $service->listNetworks());
        self::assertSame(['ssh_keys' => []], $service->listSshKeys());

        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://hcloud.example.test/v1/servers?')
                && ($query['per_page'] ?? null) === '10'
                && ($query['page'] ?? null) === '2'
                && $request->hasHeader('Authorization', 'Bearer hcloud-token');
        });
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://hcloud.example.test/v1/servers'
            && $request['name'] === 'agent-demo'
            && $request['server_type'] === 'cx22'
            && $request['image'] === 'ubuntu-24.04'
            && $request['location'] === 'fsn1'
            && $request['ssh_keys'][0] === 'agent-key');
    }

    public function test_generated_tools_map_path_query_and_body_arguments(): void
    {
        Http::fake([
            'https://hcloud.example.test/v1/servers/123' => Http::response(['server' => ['id' => 123]], 200),
            'https://hcloud.example.test/v1/servers*' => Http::response(['servers' => [['id' => 123]]], 200),
        ]);

        $service = new HetznerService(accessToken: 'hcloud-token', baseUrl: 'https://hcloud.example.test/v1');
        $get = new HetznerGetServer($service);

        $success = $get->execute(['id' => 123]);
        self::assertTrue($success->succeeded());
        self::assertSame(123, $success->data['server']['id']);

        $missing = $get->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertSame('The id parameter is required.', $missing->error);

        $list = new HetznerListServers($service);
        $listed = $list->execute(['per_page' => 5, 'page' => 3]);
        self::assertTrue($listed->succeeded());
        self::assertSame(123, $listed->data['servers'][0]['id']);

        $create = new HetznerCreateServer($service);
        $created = $create->execute([
            'name' => 'loose-body',
            'server_type' => 'cx22',
            'image' => 'ubuntu-24.04',
        ]);
        self::assertTrue($created->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://hcloud.example.test/v1/servers/123');
        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return str_starts_with($request->url(), 'https://hcloud.example.test/v1/servers?')
                && ($query['per_page'] ?? null) === '5'
                && ($query['page'] ?? null) === '3';
        });
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://hcloud.example.test/v1/servers'
            && $request['name'] === 'loose-body'
            && $request['server_type'] === 'cx22'
            && $request['image'] === 'ubuntu-24.04');
    }

    public function test_provider_resolves_named_account_credentials(): void
    {
        Http::fake([
            'https://tenant-hcloud.example.test/v1/servers*' => Http::response(['servers' => [['id' => 456]]], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration !== 'hetzner' || $account !== 'work') {
                    return $default;
                }

                return match ($key) {
                    'access_token' => 'tenant-hcloud-token',
                    'url' => 'https://tenant-hcloud.example.test/v1',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'hetzner' && $account === 'work';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'hetzner' ? ['work'] : [];
            }
        });

        $tool = (new HetznerToolProvider)->createTool(HetznerListServers::class, ['account' => 'work']);
        $result = $tool->execute(['per_page' => 5]);

        self::assertTrue($result->succeeded());
        self::assertSame(456, $result->data['servers'][0]['id']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://tenant-hcloud.example.test/v1/servers?per_page=5'
            && $request->hasHeader('Authorization', 'Bearer tenant-hcloud-token'));
    }
}
