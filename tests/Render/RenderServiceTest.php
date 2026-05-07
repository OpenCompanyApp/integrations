<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Render;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Render2\RenderOperations;
use OpenCompany\Integrations\Render2\RenderService;
use OpenCompany\Integrations\Render2\RenderToolProvider;
use OpenCompany\Integrations\Render2\Tools\RenderCreateDeploy;
use OpenCompany\Integrations\Render2\Tools\RenderGetDeploy;
use OpenCompany\Integrations\Render2\Tools\RenderListServices;
use PHPUnit\Framework\TestCase;

final class RenderServiceTest extends TestCase
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

    public function test_provider_uses_canonical_metadata_and_legacy_package_replacements(): void
    {
        $composer = json_decode((string) file_get_contents(__DIR__ . '/../../packages/render2/composer.json'), true);
        $provider = new RenderToolProvider;

        self::assertSame('self.version', $composer['replace']['opencompanyapp/integration-render']);
        self::assertSame('self.version', $composer['replace']['opencompanyapp/ai-tool-render']);
        self::assertSame('render', $provider->appName());
        self::assertSame('Render', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('https://api-docs.render.com/', $provider->integrationMeta()['docs_url']);
        self::assertSame('https://api-docs.render.com/openapi/render-public-api-1.json', $provider->integrationMeta()['source_url']);
        self::assertCount(196, RenderOperations::all());
        self::assertCount(196, $provider->tools());
        self::assertArrayHasKey('render_get_deploy', $provider->tools());
        self::assertArrayHasKey('render_create_deploy', $provider->tools());
        self::assertArrayHasKey('render_get_cpu', $provider->tools());
        self::assertArrayHasKey('render_create_postgres_export', $provider->tools());
        self::assertArrayHasKey('render_list_workflows', $provider->tools());
    }

    public function test_provider_connection_uses_render_users_endpoint(): void
    {
        Http::fake([
            'https://render.example.test/v1/users' => Http::response(['email' => 'agent@example.test'], 200),
        ]);

        $result = (new RenderToolProvider)->testConnection([
            'api_key' => 'render-token',
            'url' => 'https://render.example.test/v1',
        ]);

        self::assertTrue($result['success']);
        self::assertSame('Connected to Render as agent@example.test.', $result['message']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://render.example.test/v1/users'
            && $request->hasHeader('Authorization', 'Bearer render-token')
            && $request->hasHeader('Accept', 'application/json'));
    }

    public function test_service_maps_render_endpoints_and_bearer_auth(): void
    {
        Http::fake([
            'https://render.example.test/v1/services/srv%2F123/deploys/dep%2F456' => Http::response(['deploy' => ['id' => 'dep/456']], 200),
            'https://render.example.test/v1/services/srv%2F123/jobs*' => Http::response(['jobs' => []], 200),
            'https://render.example.test/v1/services/srv%2F123/deploys*' => Http::response(['deploys' => []], 200),
            'https://render.example.test/v1/services/srv%2F123*' => Http::response(['service' => ['id' => 'srv/123']], 200),
            'https://render.example.test/v1/services*' => Http::response(['services' => []], 200),
            'https://render.example.test/v1/users' => Http::response(['email' => 'agent@example.test'], 200),
        ]);

        $service = new RenderService(apiKey: 'render-token', baseUrl: 'https://render.example.test/v1');

        self::assertSame(['services' => []], $service->listServices(25, 'cursor'));
        self::assertSame(['service' => ['id' => 'srv/123']], $service->getService('srv/123'));
        self::assertSame(['deploys' => []], $service->listDeploys('srv/123', 10, 'next'));
        self::assertSame(['deploy' => ['id' => 'dep/456']], $service->getDeploy('srv/123', 'dep/456'));
        self::assertSame(['jobs' => []], $service->listJobs('srv/123'));
        self::assertSame(['email' => 'agent@example.test'], $service->getCurrentUser());

        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://render.example.test/v1/services?')
                && ($query['cursor'] ?? null) === 'cursor'
                && ($query['limit'] ?? null) === '25'
                && $request->hasHeader('Authorization', 'Bearer render-token');
        });
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://render.example.test/v1/services/srv%2F123');
        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return str_starts_with($request->url(), 'https://render.example.test/v1/services/srv%2F123/deploys?')
                && ($query['cursor'] ?? null) === 'next'
                && ($query['limit'] ?? null) === '10';
        });
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://render.example.test/v1/services/srv%2F123/deploys/dep%2F456');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://render.example.test/v1/services/srv%2F123/jobs');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://render.example.test/v1/users');
    }

    public function test_generated_tools_map_path_query_and_body_arguments(): void
    {
        Http::fake([
            'https://render.example.test/v1/services/srv-123/deploys/dep-456' => Http::response(['deploy' => ['id' => 'dep-456']], 200),
            'https://render.example.test/v1/services/srv-123/deploys' => Http::response(['deploy' => ['id' => 'dep-new']], 201),
        ]);

        $tool = new RenderGetDeploy(new RenderService(apiKey: 'render-token', baseUrl: 'https://render.example.test/v1'));

        $success = $tool->execute(['service_id' => 'srv-123', 'deploy_id' => 'dep-456']);
        self::assertTrue($success->succeeded());
        self::assertSame('dep-456', $success->data['deploy']['id']);

        $missingService = $tool->execute(['deploy_id' => 'dep-456']);
        self::assertFalse($missingService->succeeded());
        self::assertSame('The service_id parameter is required.', $missingService->error);

        $missingDeploy = $tool->execute(['service_id' => 'srv-123']);
        self::assertFalse($missingDeploy->succeeded());
        self::assertSame('The deploy_id parameter is required.', $missingDeploy->error);

        $create = new RenderCreateDeploy(new RenderService(apiKey: 'render-token', baseUrl: 'https://render.example.test/v1'));
        $created = $create->execute([
            'service_id' => 'srv-123',
            'clearCache' => 'do_not_clear',
        ]);
        self::assertTrue($created->succeeded());
        self::assertSame('dep-new', $created->data['deploy']['id']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://render.example.test/v1/services/srv-123/deploys'
            && $request['clearCache'] === 'do_not_clear');
    }

    public function test_provider_falls_back_to_legacy_render2_credentials_for_named_accounts(): void
    {
        Http::fake([
            'https://legacy-render.example.test/v1/services*' => Http::response(['services' => [['id' => 'srv-legacy']]], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration === 'render') {
                    return '';
                }

                if ($integration === 'render2' && $account === 'work') {
                    return match ($key) {
                        'api_key' => 'legacy-render-token',
                        'url' => 'https://legacy-render.example.test/v1',
                        default => $default,
                    };
                }

                return $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'render2' && $account === 'work';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'render2' ? ['work'] : [];
            }
        });

        $tool = (new RenderToolProvider)->createTool(RenderListServices::class, ['account' => 'work']);
        $result = $tool->execute(['limit' => 5]);

        self::assertTrue($result->succeeded());
        self::assertSame('srv-legacy', $result->data['services'][0]['id']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://legacy-render.example.test/v1/services?limit=5'
            && $request->hasHeader('Authorization', 'Bearer legacy-render-token'));
    }
}
