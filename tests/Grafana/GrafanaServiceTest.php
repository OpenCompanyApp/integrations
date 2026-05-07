<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Grafana;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Grafana\GrafanaOperations;
use OpenCompany\Integrations\Grafana\GrafanaService;
use OpenCompany\Integrations\Grafana\GrafanaToolProvider;
use OpenCompany\Integrations\Grafana\Tools\GrafanaCreateDashboard;
use OpenCompany\Integrations\Grafana\Tools\GrafanaGetDashboard;
use OpenCompany\Integrations\Grafana\Tools\GrafanaListDashboards;
use PHPUnit\Framework\TestCase;

final class GrafanaServiceTest extends TestCase
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
        $provider = new GrafanaToolProvider;

        self::assertSame('grafana', $provider->appName());
        self::assertSame('Grafana', $provider->integrationMeta()['name']);
        self::assertSame('analytics', $provider->integrationMeta()['category']);
        self::assertSame('https://grafana.com/docs/grafana/latest/developers/http_api/', $provider->integrationMeta()['docs_url']);
        self::assertSame('https://raw.githubusercontent.com/grafana/grafana/main/public/openapi3.json', $provider->integrationMeta()['source_url']);
        self::assertCount(321, GrafanaOperations::all());
        self::assertCount(321, $provider->tools());
        self::assertArrayHasKey('grafana_list_dashboards', $provider->tools());
        self::assertArrayHasKey('grafana_get_dashboard', $provider->tools());
        self::assertArrayHasKey('grafana_create_dashboard', $provider->tools());
        self::assertArrayHasKey('grafana_list_datasources', $provider->tools());
        self::assertArrayHasKey('grafana_list_alerts', $provider->tools());
        self::assertArrayHasKey('grafana_get_health', $provider->tools());
        self::assertArrayHasKey('grafana_create_role', $provider->tools());
    }

    public function test_service_maps_common_grafana_endpoints_and_bearer_auth(): void
    {
        Http::fake([
            'https://grafana.example.test/api/search*' => Http::response([['uid' => 'service-latency']], 200),
            'https://grafana.example.test/api/dashboards/uid/service-latency' => Http::response(['dashboard' => ['uid' => 'service-latency']], 200),
            'https://grafana.example.test/api/dashboards/db' => Http::response(['uid' => 'agent-demo'], 200),
            'https://grafana.example.test/api/datasources' => Http::response([['uid' => 'prometheus']], 200),
            'https://grafana.example.test/api/v1/provisioning/alert-rules' => Http::response([['uid' => 'rule-1']], 200),
            'https://grafana.example.test/api/teams/search*' => Http::response(['teams' => []], 200),
            'https://grafana.example.test/api/user' => Http::response(['login' => 'agent'], 200),
        ]);

        $service = new GrafanaService(apiToken: 'grafana-token', baseUrl: 'https://grafana.example.test/api');

        self::assertSame([['uid' => 'service-latency']], $service->listDashboards('latency', 'dash-db', 25));
        self::assertSame(['dashboard' => ['uid' => 'service-latency']], $service->getDashboard('service-latency'));
        self::assertSame(['uid' => 'agent-demo'], $service->createDashboard(['uid' => 'agent-demo'], 'ops', true));
        self::assertSame([['uid' => 'prometheus']], $service->listDatasources());
        self::assertSame([['uid' => 'rule-1']], $service->listAlerts(1, 2));
        self::assertSame(['teams' => []], $service->listTeams(2, 15));
        self::assertSame(['login' => 'agent'], $service->getCurrentUser());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://grafana.example.test/api/search?query=latency&type=dash-db&limit=25'
            && $request->hasHeader('Authorization', 'Bearer grafana-token'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://grafana.example.test/api/dashboards/uid/service-latency');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://grafana.example.test/api/dashboards/db'
            && $request['dashboard']['uid'] === 'agent-demo'
            && $request['folderUid'] === 'ops'
            && $request['overwrite'] === true);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://grafana.example.test/api/v1/provisioning/alert-rules');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://grafana.example.test/api/teams/search?page=2&perpage=15');
    }

    public function test_generated_tools_map_path_query_and_body_arguments(): void
    {
        Http::fake([
            'https://grafana.example.test/api/dashboards/uid/ops%2Flatency' => Http::response(['dashboard' => ['uid' => 'ops/latency']], 200),
            'https://grafana.example.test/api/search*' => Http::response([['uid' => 'agent-demo']], 200),
            'https://grafana.example.test/api/dashboards/db' => Http::response(['uid' => 'agent-demo'], 200),
        ]);

        $service = new GrafanaService(apiToken: 'grafana-token', baseUrl: 'https://grafana.example.test/api');
        $get = new GrafanaGetDashboard($service);

        $success = $get->execute(['uid' => 'ops/latency']);
        self::assertTrue($success->succeeded());
        self::assertSame('ops/latency', $success->data['dashboard']['uid']);

        $missing = $get->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertSame('The uid parameter is required.', $missing->error);

        $list = new GrafanaListDashboards($service);
        $listed = $list->execute(['query' => 'agent', 'dashboard_u_i_ds' => ['agent-demo']]);
        self::assertTrue($listed->succeeded());
        self::assertSame('agent-demo', $listed->data[0]['uid']);

        $create = new GrafanaCreateDashboard($service);
        $created = $create->execute([
            'dashboard' => ['uid' => 'agent-demo'],
            'overwrite' => true,
        ]);
        self::assertTrue($created->succeeded());
        self::assertSame('agent-demo', $created->data['uid']);

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://grafana.example.test/api/dashboards/uid/ops%2Flatency');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://grafana.example.test/api/search?query=agent&dashboardUIDs%5B0%5D=agent-demo');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://grafana.example.test/api/dashboards/db'
            && $request['dashboard']['uid'] === 'agent-demo'
            && $request['overwrite'] === true);
    }

    public function test_provider_resolves_named_account_credentials(): void
    {
        Http::fake([
            'https://tenant-grafana.example.test/api/search*' => Http::response([['uid' => 'tenant-dashboard']], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration !== 'grafana' || $account !== 'work') {
                    return $default;
                }

                return match ($key) {
                    'api_token' => 'tenant-grafana-token',
                    'url' => 'https://tenant-grafana.example.test/api',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'grafana' && $account === 'work';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'grafana' ? ['work'] : [];
            }
        });

        $tool = (new GrafanaToolProvider)->createTool(GrafanaListDashboards::class, ['account' => 'work']);
        $result = $tool->execute(['query' => 'tenant']);

        self::assertTrue($result->succeeded());
        self::assertSame('tenant-dashboard', $result->data[0]['uid']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://tenant-grafana.example.test/api/search?query=tenant'
            && $request->hasHeader('Authorization', 'Bearer tenant-grafana-token'));
    }
}
