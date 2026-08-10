<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Datadog;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Datadog\DatadogService;
use OpenCompany\Integrations\Datadog\DatadogToolProvider;
use OpenCompany\Integrations\Datadog\Tools\DatadogCreateMonitor;
use OpenCompany\Integrations\Datadog\Tools\DatadogListMonitors;
use OpenCompany\Integrations\Datadog\Tools\DatadogQueryMetrics;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Datadog v1 API mapping.
 */
final class DatadogServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(DatadogService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(DatadogService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_and_connection_contract(): void
    {
        $provider = new DatadogToolProvider;

        self::assertSame('datadog', $provider->appName());
        self::assertSame('Datadog', $provider->integrationMeta()['name']);
        self::assertSame('analytics', $provider->integrationMeta()['category']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertCount(10, $provider->tools());
        self::assertArrayHasKey('datadog_create_monitor', $provider->tools());
        self::assertArrayHasKey('datadog_query_metrics', $provider->tools());
        self::assertFileExists((string) $provider->scriptDocsPath());

        Http::fake(['https://api.datadoghq.eu/api/v1/validate' => Http::response(['valid' => true], 200)]);
        $result = $provider->testConnection(['api_key' => 'dd-api', 'app_key' => 'dd-app', 'site' => 'eu']);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.datadoghq.eu/api/v1/validate'
            && $request->hasHeader('DD-API-KEY', 'dd-api')
            && $request->hasHeader('DD-APPLICATION-KEY', 'dd-app'));
    }

    public function test_service_maps_monitor_metrics_dashboard_event_and_user_endpoints(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new DatadogService('dd-api', 'dd-app', 'us');

        $service->listMonitors(['name' => 'cpu', 'tags' => 'env:prod', 'page' => 2, 'page_size' => 10]);
        $service->getMonitor(123);
        $service->createMonitor(['type' => 'metric alert', 'query' => 'avg:system.cpu.user{*} > 90']);
        $service->updateMonitor(123, ['name' => 'CPU high']);
        $service->deleteMonitor(123);
        $service->queryMetrics(1700000000, 1700000600, 'avg:system.cpu.user{*}');
        $service->listDashboards();
        $service->getDashboard('dash-123');
        $service->postEvent(['title' => 'Deploy', 'text' => 'Deploy completed']);
        $service->getCurrentUser();

        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://api.datadoghq.com/api/v1/monitor?')
                && ($query['name'] ?? null) === 'cpu'
                && ($query['tags'] ?? null) === 'env:prod'
                && ($query['page'] ?? null) === '2'
                && ($query['page_size'] ?? null) === '10'
                && $request->hasHeader('DD-API-KEY', 'dd-api')
                && $request->hasHeader('DD-APPLICATION-KEY', 'dd-app');
        });
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.datadoghq.com/api/v1/monitor/123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.datadoghq.com/api/v1/monitor' && $request['type'] === 'metric alert');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://api.datadoghq.com/api/v1/monitor/123' && $request['name'] === 'CPU high');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.datadoghq.com/api/v1/monitor/123');
        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://api.datadoghq.com/api/v1/query?')
                && ($query['from'] ?? null) === '1700000000'
                && ($query['to'] ?? null) === '1700000600'
                && ($query['query'] ?? null) === 'avg:system.cpu.user{*}';
        });
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.datadoghq.com/api/v1/dashboard');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.datadoghq.com/api/v1/dashboard/dash-123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.datadoghq.com/api/v1/events' && $request['title'] === 'Deploy');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.datadoghq.com/api/v1/user');
    }

    public function test_tools_shape_payloads_and_validate_metric_time_range(): void
    {
        Http::fake(['*' => Http::response(['id' => 123, 'series' => []], 200)]);

        $service = new DatadogService('dd-api', 'dd-app', 'eu');

        $listed = (new DatadogListMonitors($service))->execute([
            'name' => 'cpu',
            'tags' => 'env:prod',
            'page' => 1,
            'page_size' => 25,
        ]);
        self::assertTrue($listed->succeeded());

        $created = (new DatadogCreateMonitor($service))->execute([
            'type' => 'metric alert',
            'query' => 'avg:system.cpu.user{*} > 90',
            'name' => 'CPU high',
            'options' => '{"thresholds":{"critical":90}}',
            'tags' => ['env:prod'],
        ]);
        self::assertTrue($created->succeeded());

        $invalidRange = (new DatadogQueryMetrics($service))->execute([
            'from' => 1700000600,
            'to' => 1700000000,
            'query' => 'avg:system.cpu.user{*}',
        ]);
        self::assertFalse($invalidRange->succeeded());
        self::assertSame('The "from" timestamp must be less than the "to" timestamp.', $invalidRange->error);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.datadoghq.eu/api/v1/monitor'
            && $request['options'] === ['thresholds' => ['critical' => 90]]
            && $request['tags'] === ['env:prod']);
    }

    public function test_multi_account_resolution_uses_account_keys_and_site(): void
    {
        Http::fake(['*' => Http::response(['monitors' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['datadog', 'api_key', 'workspace'] => 'account-api',
                    ['datadog', 'app_key', 'workspace'] => 'account-app',
                    ['datadog', 'site', 'workspace'] => 'eu',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'datadog' && $account === 'workspace';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'datadog' ? ['workspace'] : [];
            }
        });

        $tool = (new DatadogToolProvider)->createTool(DatadogListMonitors::class, ['account' => 'workspace']);
        self::assertTrue($tool->execute([])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.datadoghq.eu/api/v1/monitor'
            && $request->hasHeader('DD-API-KEY', 'account-api')
            && $request->hasHeader('DD-APPLICATION-KEY', 'account-app'));
    }
}
