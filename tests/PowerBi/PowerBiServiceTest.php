<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\PowerBi;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\MicrosoftPowerBI\PowerBIToolProvider as LegacyPowerBiToolProvider;
use OpenCompany\Integrations\PowerBi\PowerBiService;
use OpenCompany\Integrations\PowerBi\PowerBiToolProvider;
use OpenCompany\Integrations\PowerBi\Tools\PowerBiGetDataset;
use OpenCompany\Integrations\PowerBi\Tools\PowerBiListReports;
use OpenCompany\Integrations\PowerBi\Tools\PowerBiListWorkspaces;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Microsoft Power BI REST API integration.
 */
final class PowerBiServiceTest extends TestCase
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

    public function test_provider_metadata_credentials_tools_and_docs(): void
    {
        $provider = new PowerBiToolProvider;
        $tools = $provider->tools();

        self::assertSame('powerbi', $provider->appName());
        self::assertSame('Microsoft Power BI', $provider->integrationMeta()['name']);
        self::assertSame('analytics', $provider->integrationMeta()['category']);
        self::assertSame('https://learn.microsoft.com/en-us/rest/api/power-bi/', $provider->integrationMeta()['docs_url']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());

        self::assertCount(6, $tools);
        self::assertArrayHasKey('powerbi_list_workspaces', $tools);
        self::assertArrayHasKey('powerbi_list_datasets', $tools);
        self::assertArrayHasKey('powerbi_get_report', $tools);
        self::assertArrayNotHasKey('powerbi_get_current_user', $tools);

        foreach ($tools as $tool) {
            self::assertTrue(class_exists($tool['class']), $tool['class'].' should exist.');
        }
    }

    public function test_legacy_provider_defers_to_canonical_power_bi_namespace(): void
    {
        $provider = new LegacyPowerBiToolProvider;

        self::assertSame('powerbi', $provider->appName());
        self::assertSame('Microsoft Power BI', $provider->integrationMeta()['name']);
        self::assertCount(6, $provider->tools());
        self::assertArrayNotHasKey('powerbi_get_current_user', $provider->tools());
    }

    public function test_service_maps_power_bi_workspace_dataset_and_report_requests(): void
    {
        Http::fake(['*' => Http::response(['value' => [], 'id' => 'item_123'], 200)]);

        $service = new PowerBiService('powerbi-test-token', 'https://powerbi.example.test/v1.0/myorg');

        $service->listWorkspaces(7);
        $service->getWorkspace('workspace 123');
        $service->listDatasets('workspace 123');
        $service->getDataset('workspace 123', 'dataset/123');
        $service->listReports('workspace 123');
        $service->getReport('workspace 123', 'report/123');

        Http::assertSentCount(6);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://powerbi.example.test/v1.0/myorg/groups?%24top=7'
            && $request->hasHeader('Authorization', 'Bearer powerbi-test-token')
            && $request->hasHeader('Content-Type', 'application/json'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://powerbi.example.test/v1.0/myorg/groups/workspace%20123');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://powerbi.example.test/v1.0/myorg/groups/workspace%20123/datasets');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://powerbi.example.test/v1.0/myorg/groups/workspace%20123/datasets/dataset%2F123');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://powerbi.example.test/v1.0/myorg/groups/workspace%20123/reports');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://powerbi.example.test/v1.0/myorg/groups/workspace%20123/reports/report%2F123');
    }

    public function test_service_normalizes_errors(): void
    {
        Http::fake([
            'https://powerbi.example.test/v1.0/myorg/groups/workspace_123' => Http::response([
                'error' => ['message' => 'Workspace not found'],
            ], 404),
        ]);

        $service = new PowerBiService('powerbi-test-token', 'https://powerbi.example.test');

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Power BI API error (404): Workspace not found');

        $service->getWorkspace('workspace_123');
    }

    public function test_tools_validate_configuration_and_map_agent_parameters(): void
    {
        Http::fake([
            'https://powerbi.example.test/v1.0/myorg/groups?%24top=2' => Http::response([
                'value' => [['id' => 'workspace_123', 'name' => 'Finance']],
            ], 200),
            'https://powerbi.example.test/v1.0/myorg/groups/workspace_123/datasets/dataset_123' => Http::response([
                'id' => 'dataset_123',
                'name' => 'Revenue',
            ], 200),
        ]);

        $service = new PowerBiService('powerbi-test-token', 'https://powerbi.example.test');

        $workspaces = (new PowerBiListWorkspaces($service))->execute(['top' => 2]);
        $dataset = (new PowerBiGetDataset($service))->execute([
            'workspace_id' => 'workspace_123',
            'dataset_id' => 'dataset_123',
        ]);
        $missingDataset = (new PowerBiGetDataset($service))->execute(['workspace_id' => 'workspace_123']);
        $missingWorkspace = (new PowerBiListReports($service))->execute([]);
        $invalidTop = (new PowerBiListWorkspaces($service))->execute(['top' => 0]);
        $unconfigured = (new PowerBiListWorkspaces(new PowerBiService('', 'https://powerbi.example.test')))->execute([]);

        self::assertTrue($workspaces->succeeded());
        self::assertSame('workspace_123', $workspaces->data['value'][0]['id']);
        self::assertTrue($dataset->succeeded());
        self::assertSame('dataset_123', $dataset->data['id']);
        self::assertFalse($missingDataset->succeeded());
        self::assertStringContainsString('dataset_id is required', (string) $missingDataset->error);
        self::assertFalse($missingWorkspace->succeeded());
        self::assertStringContainsString('workspace_id is required', (string) $missingWorkspace->error);
        self::assertFalse($invalidTop->succeeded());
        self::assertStringContainsString('top must be greater than 0', (string) $invalidTop->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new PowerBiToolProvider;

        self::assertFalse($provider->testConnection([])['success']);

        Http::fake([
            'https://powerbi.example.test/v1.0/myorg/groups?%24top=1' => Http::sequence()
                ->push(['value' => [['id' => 'workspace_123']]], 200)
                ->push(['error' => ['message' => 'Invalid token']], 401),
            'https://powerbi.internal.test/v1.0/myorg/groups?%24top=3' => Http::response(['value' => []], 200),
        ]);

        $result = $provider->testConnection([
            'access_token' => 'powerbi-test-token',
            'url' => 'https://powerbi.example.test/v1.0/myorg',
        ]);
        $badResult = $provider->testConnection([
            'access_token' => 'bad-token',
            'url' => 'https://powerbi.example.test',
        ]);

        self::assertTrue($result['success']);
        self::assertStringContainsString('Workspace probe returned 1 item', (string) $result['message']);
        self::assertFalse($badResult['success']);
        self::assertStringContainsString('Invalid token', (string) $badResult['error']);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                $values = [
                    'access_token' => $account === 'work' ? 'powerbi-work-token' : 'powerbi-default-token',
                    'url' => 'https://powerbi.internal.test',
                ];

                return $values[$key] ?? $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return true;
            }

            public function getAccounts(string $integration): array
            {
                return ['work'];
            }
        });

        $tool = $provider->createTool(PowerBiListWorkspaces::class, ['account' => 'work']);
        self::assertTrue($tool->execute(['top' => 3])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://powerbi.example.test/v1.0/myorg/groups?%24top=1'
            && $request->hasHeader('Authorization', 'Bearer powerbi-test-token'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://powerbi.internal.test/v1.0/myorg/groups?%24top=3'
            && $request->hasHeader('Authorization', 'Bearer powerbi-work-token'));
    }
}
