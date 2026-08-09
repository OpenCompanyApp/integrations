<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\DigitalOcean;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\DigitalOcean\DigitalOceanService;
use OpenCompany\Integrations\DigitalOcean\DigitalOceanToolProvider;
use OpenCompany\Integrations\DigitalOcean\Tools\DigitalOceanCreateDroplet;
use OpenCompany\Integrations\DigitalOcean\Tools\DigitalOceanGetDroplet;
use OpenCompany\Integrations\DigitalOcean\Tools\DigitalOceanListDroplets;
use OpenCompany\Integrations\DigitalOcean\Tools\DigitalOceanListKubernetes;
use OpenCompany\Integrations\DigitalOcean\Tools\DigitalOceanListSpaces;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for DigitalOcean API v2 endpoint mapping.
 */
final class DigitalOceanServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        Container::getInstance()->forgetInstance(DigitalOceanService::class);
        Container::getInstance()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        Container::getInstance()->forgetInstance(DigitalOceanService::class);
        Container::getInstance()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_and_connection_contract(): void
    {
        $provider = new DigitalOceanToolProvider;

        self::assertSame('digitalocean', $provider->appName());
        self::assertSame('DigitalOcean', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('https://docs.digitalocean.com/reference/api/reference/', $provider->integrationMeta()['docs_url']);
        self::assertSame('https://github.com/digitalocean/openapi', $provider->integrationMeta()['source_url']);
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertCount(10, $provider->tools());
        self::assertArrayHasKey('digitalocean_list_droplets', $provider->tools());
        self::assertArrayHasKey('digitalocean_list_spaces', $provider->tools());
        self::assertFileExists((string) $provider->scriptDocsPath());

        Http::fake([
            'https://api.digitalocean.test/v2/account' => Http::response([
                'account' => ['email' => 'agent@example.test'],
            ], 200),
        ]);

        $result = $provider->testConnection([
            'access_token' => 'do-token',
            'url' => 'https://api.digitalocean.test/v2',
        ]);

        self::assertTrue($result['success']);
        self::assertSame('Connected to DigitalOcean as agent@example.test.', $result['message']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.digitalocean.test/v2/account'
            && $request->hasHeader('Authorization', 'Bearer do-token'));
    }

    public function test_service_maps_core_cloud_endpoints_and_bearer_auth(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new DigitalOceanService('do-token', 'https://api.digitalocean.test/v2');

        self::assertTrue($service->isConfigured());
        $service->getCurrentUser();
        $service->listDroplets(2, 50);
        $service->getDroplet(123);
        $service->createDroplet([
            'name' => 'agent-demo',
            'region' => 'ams3',
            'size' => 's-1vcpu-1gb',
            'image' => 'ubuntu-24-04-x64',
        ]);
        $service->rebootDroplet(123);
        $service->deleteDroplet(123);
        $service->listDomains(3, 25);
        $service->getDomain('example.test');
        $service->listKubernetesClusters(4, 10);
        $service->listSpaces([
            'page' => 5,
            'per_page' => 15,
            'bucket' => 'assets',
            'permission' => 'read',
        ]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.digitalocean.test/v2/account'
            && $request->hasHeader('Authorization', 'Bearer do-token')
            && $request->hasHeader('Content-Type', 'application/json'));
        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://api.digitalocean.test/v2/droplets?')
                && ($query['page'] ?? null) === '2'
                && ($query['per_page'] ?? null) === '50';
        });
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.digitalocean.test/v2/droplets/123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.digitalocean.test/v2/droplets'
            && $request['name'] === 'agent-demo'
            && $request['region'] === 'ams3'
            && $request['size'] === 's-1vcpu-1gb'
            && $request['image'] === 'ubuntu-24-04-x64');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.digitalocean.test/v2/droplets/123/actions'
            && $request['type'] === 'reboot');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://api.digitalocean.test/v2/droplets/123');
        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://api.digitalocean.test/v2/domains?')
                && ($query['page'] ?? null) === '3'
                && ($query['per_page'] ?? null) === '25';
        });
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.digitalocean.test/v2/domains/example.test');
        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://api.digitalocean.test/v2/kubernetes/clusters?')
                && ($query['page'] ?? null) === '4'
                && ($query['per_page'] ?? null) === '10';
        });
        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://api.digitalocean.test/v2/spaces/keys?')
                && ($query['page'] ?? null) === '5'
                && ($query['per_page'] ?? null) === '15'
                && ($query['bucket'] ?? null) === 'assets'
                && ($query['permission'] ?? null) === 'read';
        });
    }

    public function test_tools_shape_payloads_and_report_unconfigured_state(): void
    {
        Http::fake([
            'https://api.digitalocean.test/v2/droplets/123' => Http::response(['droplet' => ['id' => 123]], 200),
            'https://api.digitalocean.test/v2/droplets*' => Http::response(['droplets' => [['id' => 123]]], 200),
            'https://api.digitalocean.test/v2/kubernetes/clusters*' => Http::response(['kubernetes_clusters' => []], 200),
            'https://api.digitalocean.test/v2/spaces/keys*' => Http::response(['spaces_keys' => [['name' => 'assets-read']]], 200),
        ]);

        $service = new DigitalOceanService('do-token', 'https://api.digitalocean.test/v2');

        $listed = (new DigitalOceanListDroplets($service))->execute(['page' => 1, 'per_page' => 5]);
        self::assertTrue($listed->succeeded());
        self::assertSame(123, $listed->data['droplets'][0]['id']);

        $got = (new DigitalOceanGetDroplet($service))->execute(['id' => 123]);
        self::assertTrue($got->succeeded());
        self::assertSame(123, $got->data['droplet']['id']);

        $created = (new DigitalOceanCreateDroplet($service))->execute([
            'name' => 'agent-demo',
            'region' => 'ams3',
            'size' => 's-1vcpu-1gb',
            'image' => 'ubuntu-24-04-x64',
            'ssh_keys' => ['fake-fingerprint'],
            'tags' => ['agent'],
        ]);
        self::assertTrue($created->succeeded());

        $clusters = (new DigitalOceanListKubernetes($service))->execute(['page' => 2, 'per_page' => 10]);
        self::assertTrue($clusters->succeeded());

        $keys = (new DigitalOceanListSpaces($service))->execute(['bucket' => 'assets', 'permission' => 'read']);
        self::assertTrue($keys->succeeded());
        self::assertSame('assets-read', $keys->data['spaces_keys'][0]['name']);

        $unconfigured = (new DigitalOceanListDroplets(new DigitalOceanService))->execute([]);
        self::assertFalse($unconfigured->succeeded());
        self::assertSame('DigitalOcean integration is not configured.', $unconfigured->error);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.digitalocean.test/v2/droplets'
            && $request['ssh_keys'] === ['fake-fingerprint']
            && $request['tags'] === ['agent']);
    }

    public function test_provider_resolves_named_account_credentials(): void
    {
        Http::fake([
            'https://tenant-do.example.test/v2/droplets*' => Http::response(['droplets' => [['id' => 456]]], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['digitalocean', 'access_token', 'workspace'] => 'tenant-do-token',
                    ['digitalocean', 'url', 'workspace'] => 'https://tenant-do.example.test/v2',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'digitalocean' && $account === 'workspace';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'digitalocean' ? ['workspace'] : [];
            }
        });

        $tool = (new DigitalOceanToolProvider)->createTool(DigitalOceanListDroplets::class, ['account' => 'workspace']);
        $result = $tool->execute(['per_page' => 5]);

        self::assertTrue($result->succeeded());
        self::assertSame(456, $result->data['droplets'][0]['id']);

        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://tenant-do.example.test/v2/droplets?')
                && ($query['per_page'] ?? null) === '5'
                && $request->hasHeader('Authorization', 'Bearer tenant-do-token');
        });
    }
}
