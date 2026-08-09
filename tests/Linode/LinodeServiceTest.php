<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Linode;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Linode\LinodeService;
use OpenCompany\Integrations\Linode\LinodeToolProvider;
use OpenCompany\Integrations\Linode\Tools\LinodeGetInstance;
use OpenCompany\Integrations\Linode\Tools\LinodeListDomains;
use OpenCompany\Integrations\Linode\Tools\LinodeListInstances;
use OpenCompany\Integrations\Linode\Tools\LinodeListStackscripts;
use OpenCompany\Integrations\Linode\Tools\LinodeListVolumes;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Linode API v4 endpoint mapping.
 */
final class LinodeServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        Container::getInstance()->forgetInstance(LinodeService::class);
        Container::getInstance()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        Container::getInstance()->forgetInstance(LinodeService::class);
        Container::getInstance()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_and_connection_contract(): void
    {
        $provider = new LinodeToolProvider;

        self::assertSame('linode', $provider->appName());
        self::assertSame('Linode', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('https://techdocs.akamai.com/linode-api/reference/api', $provider->integrationMeta()['docs_url']);
        self::assertSame('https://github.com/linode/linode-api-docs', $provider->integrationMeta()['source_url']);
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertCount(7, $provider->tools());
        self::assertArrayHasKey('linode_list_instances', $provider->tools());
        self::assertArrayHasKey('linode_get_current_user', $provider->tools());
        self::assertFileExists((string) $provider->scriptDocsPath());

        Http::fake([
            'https://api.linode.test/v4/profile' => Http::response([
                'username' => 'agent',
            ], 200),
        ]);

        $result = $provider->testConnection([
            'access_token' => 'linode-token',
            'url' => 'https://api.linode.test/v4',
        ]);

        self::assertTrue($result['success']);
        self::assertSame('Connected to Linode as agent.', $result['message']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.linode.test/v4/profile'
            && $request->hasHeader('Authorization', 'Bearer linode-token'));
    }

    public function test_service_maps_core_linode_endpoints_and_bearer_auth(): void
    {
        Http::fake(['*' => Http::response(['data' => []], 200)]);

        $service = new LinodeService('linode-token', 'https://api.linode.test/v4');

        self::assertTrue($service->isConfigured());
        $service->getCurrentUser();
        $service->listInstances(2, 50);
        $service->getInstance(123);
        $service->listVolumes(3, 25);
        $service->listDomains(4, 10);
        $service->getDomain(456);
        $service->listStackScripts(5, 15);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.linode.test/v4/profile'
            && $request->hasHeader('Authorization', 'Bearer linode-token')
            && $request->hasHeader('Content-Type', 'application/json'));
        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://api.linode.test/v4/linode/instances?')
                && ($query['page'] ?? null) === '2'
                && ($query['per_page'] ?? null) === '50';
        });
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.linode.test/v4/linode/instances/123');
        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://api.linode.test/v4/volumes?')
                && ($query['page'] ?? null) === '3'
                && ($query['per_page'] ?? null) === '25';
        });
        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://api.linode.test/v4/domains?')
                && ($query['page'] ?? null) === '4'
                && ($query['per_page'] ?? null) === '10';
        });
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.linode.test/v4/domains/456');
        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://api.linode.test/v4/linode/stackscripts?')
                && ($query['page'] ?? null) === '5'
                && ($query['per_page'] ?? null) === '15';
        });
    }

    public function test_tools_shape_pagination_and_report_unconfigured_state(): void
    {
        Http::fake([
            'https://api.linode.test/v4/linode/instances/123' => Http::response(['id' => 123], 200),
            'https://api.linode.test/v4/linode/instances*' => Http::response(['data' => [['id' => 123]]], 200),
            'https://api.linode.test/v4/volumes*' => Http::response(['data' => [['id' => 234]]], 200),
            'https://api.linode.test/v4/domains*' => Http::response(['data' => [['id' => 345]]], 200),
            'https://api.linode.test/v4/linode/stackscripts*' => Http::response(['data' => [['id' => 456]]], 200),
        ]);

        $service = new LinodeService('linode-token', 'https://api.linode.test/v4');

        $instances = (new LinodeListInstances($service))->execute(['page' => 1, 'per_page' => 5]);
        self::assertTrue($instances->succeeded());
        self::assertSame(123, $instances->data['data'][0]['id']);

        $instance = (new LinodeGetInstance($service))->execute(['id' => 123]);
        self::assertTrue($instance->succeeded());
        self::assertSame(123, $instance->data['id']);

        $volumes = (new LinodeListVolumes($service))->execute(['page' => 2, 'per_page' => 10]);
        self::assertTrue($volumes->succeeded());
        self::assertSame(234, $volumes->data['data'][0]['id']);

        $domains = (new LinodeListDomains($service))->execute(['page' => 3, 'per_page' => 15]);
        self::assertTrue($domains->succeeded());
        self::assertSame(345, $domains->data['data'][0]['id']);

        $scripts = (new LinodeListStackscripts($service))->execute(['page' => 4, 'per_page' => 20]);
        self::assertTrue($scripts->succeeded());
        self::assertSame(456, $scripts->data['data'][0]['id']);

        $unconfigured = (new LinodeListInstances(new LinodeService))->execute([]);
        self::assertFalse($unconfigured->succeeded());
        self::assertSame('Linode integration is not configured.', $unconfigured->error);
    }

    public function test_provider_resolves_named_account_credentials(): void
    {
        Http::fake([
            'https://tenant-linode.example.test/v4/linode/instances*' => Http::response(['data' => [['id' => 789]]], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['linode', 'access_token', 'workspace'] => 'tenant-linode-token',
                    ['linode', 'url', 'workspace'] => 'https://tenant-linode.example.test/v4',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'linode' && $account === 'workspace';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'linode' ? ['workspace'] : [];
            }
        });

        $tool = (new LinodeToolProvider)->createTool(LinodeListInstances::class, ['account' => 'workspace']);
        $result = $tool->execute(['per_page' => 5]);

        self::assertTrue($result->succeeded());
        self::assertSame(789, $result->data['data'][0]['id']);

        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://tenant-linode.example.test/v4/linode/instances?')
                && ($query['per_page'] ?? null) === '5'
                && $request->hasHeader('Authorization', 'Bearer tenant-linode-token');
        });
    }
}
