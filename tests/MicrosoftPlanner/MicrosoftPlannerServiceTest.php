<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\MicrosoftPlanner;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\MicrosoftPlanner\MicrosoftPlannerService;
use OpenCompany\Integrations\MicrosoftPlanner\MicrosoftPlannerToolProvider;
use OpenCompany\Integrations\MicrosoftPlanner\Tools\MicrosoftPlannerGetTasks;
use OpenCompany\Integrations\MicrosoftPlanner\Tools\MicrosoftPlannerGroupsPlannerListPlans;
use OpenCompany\Integrations\MicrosoftPlanner\Tools\MicrosoftPlannerListTasks;
use OpenCompany\Integrations\MicrosoftPlanner\Tools\MicrosoftPlannerUpdateTasks;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the generated Microsoft Planner integration.
 */
final class MicrosoftPlannerServiceTest extends TestCase
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
        parent::tearDown();
    }

    public function test_provider_matches_openapi_manifest_and_docs(): void
    {
        $provider = new MicrosoftPlannerToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/microsoft-planner/microsoft-planner-openapi-manifest.json'), true);

        self::assertSame(293, $manifest['method_count']);
        self::assertSame('v1.0', $manifest['version']);
        self::assertSame(['/planner', '/me/planner', '/groups/{group-id}/planner', '/users/{user-id}/planner'], $manifest['path_prefixes']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Microsoft Planner', $provider->integrationMeta()['name']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertContains('microsoft_planner_list_tasks', array_keys($provider->tools()));
        self::assertContains('microsoft_planner_get_tasks', array_keys($provider->tools()));
        self::assertContains('microsoft_planner_groups_planner_list_plans', array_keys($provider->tools()));
        self::assertContains('microsoft_planner_users_planner_list_tasks', array_keys($provider->tools()));
    }

    public function test_service_maps_bearer_path_odata_query_headers_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new MicrosoftPlannerService('graph-token', 'https://graph.example.test/v1.0');
        $service->request('GET', '/planner/tasks/{plannerTask-id}', ['plannerTask-id' => 'task 1'], ['$select' => 'id,title,percentComplete']);
        $service->request('PATCH', '/planner/tasks/{plannerTask-id}', ['plannerTask-id' => 'task 1'], [], ['If-Match' => 'W/"etag"', 'Prefer' => 'return=representation'], ['percentComplete' => 100]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/planner/tasks/task%201?%24select=id%2Ctitle%2CpercentComplete'
            && $request->hasHeader('Authorization', 'Bearer graph-token'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH'
            && $request->url() === 'https://graph.example.test/v1.0/planner/tasks/task%201'
            && $request->hasHeader('If-Match', 'W/"etag"')
            && $request->hasHeader('Prefer', 'return=representation')
            && $request->data()['percentComplete'] === 100);
    }

    public function test_tools_validate_and_map_parameters(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new MicrosoftPlannerService('graph-token', 'https://graph.example.test/v1.0');

        self::assertTrue((new MicrosoftPlannerListTasks($service))->execute(['top' => 5])->succeeded());
        self::assertTrue((new MicrosoftPlannerGetTasks($service))->execute(['planner_task_id' => 'task-123', 'select' => 'id,title'])->succeeded());
        self::assertTrue((new MicrosoftPlannerUpdateTasks($service))->execute(['planner_task_id' => 'task-123', 'if_match' => 'W/"etag"', 'body' => ['percentComplete' => 50]])->succeeded());
        self::assertTrue((new MicrosoftPlannerGroupsPlannerListPlans($service))->execute(['group_id' => 'group-123'])->succeeded());

        $missingPath = (new MicrosoftPlannerGetTasks($service))->execute([]);
        $badBody = (new MicrosoftPlannerUpdateTasks($service))->execute(['planner_task_id' => 'task-123', 'body' => 'not-object']);
        $missingBody = (new MicrosoftPlannerUpdateTasks($service))->execute(['planner_task_id' => 'task-123']);
        $unconfigured = (new MicrosoftPlannerGetTasks(new MicrosoftPlannerService('', 'https://graph.example.test/v1.0')))->execute(['planner_task_id' => 'task-123']);

        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('planner_task_id must be a non-empty parameter', (string) $missingPath->error);
        self::assertFalse($badBody->succeeded());
        self::assertStringContainsString('body must be an object', (string) $badBody->error);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be a non-empty object', (string) $missingBody->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('access token is required', (string) $unconfigured->error);
    }

    public function test_connection_uses_tasks_probe(): void
    {
        Http::fake(['graph.example.test/v1.0/planner/tasks*' => Http::response(['value' => []], 200)]);

        $result = (new MicrosoftPlannerToolProvider)->testConnection([
            'access_token' => 'graph-token',
            'base_url' => 'https://graph.example.test/v1.0',
        ]);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/planner/tasks?%24top=1'
            && $request->hasHeader('Authorization', 'Bearer graph-token'));
    }

    public function test_create_tool_resolves_account_specific_credentials(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                $values = [
                    'access_token' => $account === 'work' ? 'work-token' : 'default-token',
                    'base_url' => 'https://graph.example.test/v1.0',
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

        $tool = (new MicrosoftPlannerToolProvider)->createTool(MicrosoftPlannerGetTasks::class, ['account' => 'work']);
        self::assertTrue($tool->execute(['planner_task_id' => 'task-123'])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer work-token'));
    }
}
