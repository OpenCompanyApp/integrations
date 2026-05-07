<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Docker;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Docker\DockerOperations;
use OpenCompany\Integrations\Docker\DockerService;
use OpenCompany\Integrations\Docker\DockerToolProvider;
use OpenCompany\Integrations\Docker\Tools\DockerCreateRepository;
use OpenCompany\Integrations\Docker\Tools\DockerGetRepository;
use OpenCompany\Integrations\Docker\Tools\DockerListRepositories;
use PHPUnit\Framework\TestCase;

final class DockerServiceTest extends TestCase
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
        $provider = new DockerToolProvider;

        self::assertSame('docker', $provider->appName());
        self::assertSame('Docker Hub', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://docs.docker.com/reference/api/hub/latest/', $provider->integrationMeta()['docs_url']);
        self::assertSame('https://docs.docker.com/reference/api/hub/latest.yaml', $provider->integrationMeta()['source_url']);
        self::assertCount(51, DockerOperations::all());
        self::assertCount(51, $provider->tools());
        self::assertArrayHasKey('docker_list_repositories', $provider->tools());
        self::assertArrayHasKey('docker_get_repository', $provider->tools());
        self::assertArrayHasKey('docker_create_repository', $provider->tools());
        self::assertArrayHasKey('docker_list_tags', $provider->tools());
        self::assertArrayHasKey('docker_get_tag', $provider->tools());
        self::assertArrayHasKey('docker_get_v2_access_tokens', $provider->tools());
        self::assertArrayNotHasKey('docker_list_organizations', $provider->tools());
        self::assertArrayNotHasKey('docker_get_current_user', $provider->tools());
    }

    public function test_service_maps_common_docker_hub_endpoints_and_bearer_auth(): void
    {
        Http::fake([
            'https://hub.example.test/v2/namespaces/example/repositories/api' => Http::response(['name' => 'api'], 200),
            'https://hub.example.test/v2/namespaces/example/repositories/api/tags/latest' => Http::response(['name' => 'latest'], 200),
            'https://hub.example.test/v2/namespaces/example/repositories/api/tags*' => Http::response(['results' => [['name' => 'latest']]], 200),
            'https://hub.example.test/v2/namespaces/example/repositories*' => Http::response(['results' => [['name' => 'api']]], 200),
        ]);

        $service = new DockerService(accessToken: 'docker-token', baseUrl: 'https://hub.example.test');

        self::assertSame(['results' => [['name' => 'api']]], $service->listRepositories('example', 25, 2));
        self::assertSame(['name' => 'api'], $service->getRepository('example', 'api'));
        self::assertSame(['results' => [['name' => 'latest']]], $service->listTags('example', 'api', 10, 1));
        self::assertSame(['name' => 'latest'], $service->getTag('example', 'api', 'latest'));
        self::assertSame(['results' => [['name' => 'api']]], $service->createRepository('example', 'agent-demo', 'Demo', '', true));

        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://hub.example.test/v2/namespaces/example/repositories?')
                && ($query['page_size'] ?? null) === '25'
                && ($query['page'] ?? null) === '2'
                && $request->hasHeader('Authorization', 'Bearer docker-token');
        });
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://hub.example.test/v2/namespaces/example/repositories'
            && $request['name'] === 'agent-demo'
            && $request['description'] === 'Demo'
            && $request['is_private'] === true);
    }

    public function test_generated_tools_map_path_query_and_body_arguments(): void
    {
        Http::fake([
            'https://hub.example.test/v2/namespaces/example/repositories/api' => Http::response(['name' => 'api'], 200),
            'https://hub.example.test/v2/namespaces/example/repositories*' => Http::response(['results' => [['name' => 'api']]], 200),
        ]);

        $service = new DockerService(accessToken: 'docker-token', baseUrl: 'https://hub.example.test');
        $get = new DockerGetRepository($service);

        $success = $get->execute(['namespace' => 'example', 'repository' => 'api']);
        self::assertTrue($success->succeeded());
        self::assertSame('api', $success->data['name']);

        $missing = $get->execute(['namespace' => 'example']);
        self::assertFalse($missing->succeeded());
        self::assertSame('The repository parameter is required.', $missing->error);

        $list = new DockerListRepositories($service);
        $listed = $list->execute(['namespace' => 'example', 'page_size' => 5]);
        self::assertTrue($listed->succeeded());
        self::assertSame('api', $listed->data['results'][0]['name']);

        $create = new DockerCreateRepository($service);
        $created = $create->execute([
            'namespace' => 'example',
            'name' => 'loose-body',
            'is_private' => true,
        ]);
        self::assertTrue($created->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://hub.example.test/v2/namespaces/example/repositories/api');
        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return str_starts_with($request->url(), 'https://hub.example.test/v2/namespaces/example/repositories?')
                && ($query['page_size'] ?? null) === '5';
        });
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://hub.example.test/v2/namespaces/example/repositories'
            && $request['name'] === 'loose-body'
            && $request['is_private'] === true);
    }

    public function test_legacy_v2_base_url_is_not_duplicated(): void
    {
        Http::fake([
            'https://hub.example.test/v2/namespaces/example/repositories*' => Http::response(['results' => []], 200),
        ]);

        $service = new DockerService(accessToken: 'docker-token', baseUrl: 'https://hub.example.test/v2');
        $service->listRepositories('example');

        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return str_starts_with($request->url(), 'https://hub.example.test/v2/namespaces/example/repositories?')
                && ($query['page_size'] ?? null) === '25'
                && ($query['page'] ?? null) === '1';
        });
    }

    public function test_provider_resolves_named_account_credentials(): void
    {
        Http::fake([
            'https://tenant-hub.example.test/v2/namespaces/example/repositories*' => Http::response(['results' => [['name' => 'tenant']]], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration !== 'docker' || $account !== 'work') {
                    return $default;
                }

                return match ($key) {
                    'access_token' => 'tenant-docker-token',
                    'url' => 'https://tenant-hub.example.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'docker' && $account === 'work';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'docker' ? ['work'] : [];
            }
        });

        $tool = (new DockerToolProvider)->createTool(DockerListRepositories::class, ['account' => 'work']);
        $result = $tool->execute(['namespace' => 'example', 'page_size' => 5]);

        self::assertTrue($result->succeeded());
        self::assertSame('tenant', $result->data['results'][0]['name']);

        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://tenant-hub.example.test/v2/namespaces/example/repositories?')
                && ($query['page_size'] ?? null) === '5'
                && $request->hasHeader('Authorization', 'Bearer tenant-docker-token');
        });
    }
}
