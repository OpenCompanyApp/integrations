<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\ArgoCd;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\ArgoCd\ArgoCdOperations;
use OpenCompany\Integrations\ArgoCd\ArgoCdService;
use OpenCompany\Integrations\ArgoCd\ArgoCdToolProvider;
use OpenCompany\Integrations\ArgoCd\Tools\ArgoCdCreateApplication;
use OpenCompany\Integrations\ArgoCd\Tools\ArgoCdGetApplication;
use OpenCompany\Integrations\ArgoCd\Tools\ArgoCdGetCurrentUser;
use OpenCompany\Integrations\ArgoCd\Tools\ArgoCdListApplications;
use OpenCompany\Integrations\ArgoCd\Tools\ArgoCdVersionVersion;
use PHPUnit\Framework\TestCase;

final class ArgoCdServiceTest extends TestCase
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

    public function test_provider_exposes_generated_metadata_and_preserved_tools(): void
    {
        $provider = new ArgoCdToolProvider;

        self::assertSame('argocd', $provider->appName());
        self::assertSame('Argo CD', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://argo-cd.readthedocs.io/en/stable/developer-guide/api-docs/', $provider->integrationMeta()['docs_url']);
        self::assertSame('https://raw.githubusercontent.com/argoproj/argo-cd/master/assets/swagger.json', $provider->integrationMeta()['source_url']);
        self::assertCount(106, ArgoCdOperations::all());
        self::assertCount(106, $provider->tools());
        self::assertArrayHasKey('argocd_list_applications', $provider->tools());
        self::assertArrayHasKey('argocd_get_application', $provider->tools());
        self::assertArrayHasKey('argocd_create_application', $provider->tools());
        self::assertArrayHasKey('argocd_list_projects', $provider->tools());
        self::assertArrayHasKey('argocd_get_project', $provider->tools());
        self::assertArrayHasKey('argocd_list_repositories', $provider->tools());
        self::assertArrayHasKey('argocd_get_current_user', $provider->tools());
        self::assertArrayHasKey('argocd_cluster_list', $provider->tools());
        self::assertArrayHasKey('argocd_application_set_list', $provider->tools());
    }

    public function test_service_maps_common_argocd_endpoints_and_bearer_auth(): void
    {
        Http::fake([
            'https://argocd.example.test/api/v1/applications/guestbook*' => Http::response(['metadata' => ['name' => 'guestbook']], 200),
            'https://argocd.example.test/api/v1/applications*' => Http::response(['items' => [['metadata' => ['name' => 'guestbook']]]], 200),
            'https://argocd.example.test/api/v1/projects' => Http::response(['items' => [['metadata' => ['name' => 'default']]]], 200),
            'https://argocd.example.test/api/v1/repositories*' => Http::response(['items' => [['repo' => 'https://example.test/repo.git']]], 200),
            'https://argocd.example.test/api/v1/session/userinfo' => Http::response(['username' => 'admin'], 200),
        ]);

        $service = new ArgoCdService(token: 'argocd-token', baseUrl: 'https://argocd.example.test');

        self::assertSame(['items' => [['metadata' => ['name' => 'guestbook']]]], $service->listApplications(['project' => 'default']));
        self::assertSame(['metadata' => ['name' => 'guestbook']], $service->getApplication('guestbook'));
        self::assertSame(['items' => [['metadata' => ['name' => 'guestbook']]]], $service->createApplication(['metadata' => ['name' => 'guestbook']]));
        self::assertSame(['items' => [['metadata' => ['name' => 'default']]]], $service->listProjects());
        self::assertSame(['items' => [['repo' => 'https://example.test/repo.git']]], $service->listRepositories());
        self::assertSame(['username' => 'admin'], $service->getCurrentUser());

        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://argocd.example.test/api/v1/applications?')
                && ($query['project'] ?? null) === 'default'
                && $request->hasHeader('Authorization', 'Bearer argocd-token');
        });
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://argocd.example.test/api/v1/applications'
            && $request['metadata']['name'] === 'guestbook');
    }

    public function test_generated_tools_map_path_query_and_loose_body_arguments(): void
    {
        Http::fake([
            'https://argocd.example.test/api/v1/applications/guestbook*' => Http::response(['metadata' => ['name' => 'guestbook']], 200),
            'https://argocd.example.test/api/v1/applications*' => Http::response(['items' => [['metadata' => ['name' => 'guestbook']]]], 200),
        ]);

        $service = new ArgoCdService(token: 'argocd-token', baseUrl: 'https://argocd.example.test');
        $get = new ArgoCdGetApplication($service);

        $success = $get->execute(['name' => 'guestbook', 'project' => 'default']);
        self::assertTrue($success->succeeded());
        self::assertSame('guestbook', $success->data['metadata']['name']);

        $missing = $get->execute(['project' => 'default']);
        self::assertFalse($missing->succeeded());
        self::assertSame('The name parameter is required.', $missing->error);

        $list = new ArgoCdListApplications($service);
        $listed = $list->execute(['project' => 'default']);
        self::assertTrue($listed->succeeded());
        self::assertSame('guestbook', $listed->data['items'][0]['metadata']['name']);

        $create = new ArgoCdCreateApplication($service);
        $created = $create->execute([
            'metadata' => ['name' => 'loose-body'],
            'spec' => ['project' => 'default'],
        ]);
        self::assertTrue($created->succeeded());

        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://argocd.example.test/api/v1/applications/guestbook?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://argocd.example.test/api/v1/applications'
            && $request['metadata']['name'] === 'loose-body'
            && $request['spec']['project'] === 'default');
    }

    public function test_legacy_api_v1_base_url_is_not_duplicated_and_version_is_public(): void
    {
        Http::fake([
            'https://argocd.example.test/api/version' => Http::response(['Version' => 'v2.14.0'], 200),
            'https://argocd.example.test/api/v1/applications*' => Http::response(['items' => []], 200),
        ]);

        $service = new ArgoCdService(token: 'argocd-token', baseUrl: 'https://argocd.example.test/api/v1');
        $service->listApplications();

        $version = new ArgoCdVersionVersion(new ArgoCdService(baseUrl: 'https://argocd.example.test/api/v1'));
        $result = $version->execute([]);

        self::assertTrue($result->succeeded());
        self::assertSame('v2.14.0', $result->data['Version']);

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://argocd.example.test/api/v1/applications');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://argocd.example.test/api/version'
            && !$request->hasHeader('Authorization'));
    }

    public function test_provider_resolves_named_account_credentials(): void
    {
        Http::fake([
            'https://tenant-argocd.example.test/api/v1/session/userinfo' => Http::response(['username' => 'tenant'], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration !== 'argocd' || $account !== 'work') {
                    return $default;
                }

                return match ($key) {
                    'api_key' => 'tenant-argocd-token',
                    'base_url' => 'https://tenant-argocd.example.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'argocd' && $account === 'work';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'argocd' ? ['work'] : [];
            }
        });

        $tool = (new ArgoCdToolProvider)->createTool(ArgoCdGetCurrentUser::class, ['account' => 'work']);
        $result = $tool->execute([]);

        self::assertTrue($result->succeeded());
        self::assertSame('tenant', $result->data['username']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://tenant-argocd.example.test/api/v1/session/userinfo'
            && $request->hasHeader('Authorization', 'Bearer tenant-argocd-token'));
    }
}
