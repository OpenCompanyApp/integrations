<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Phantombuster;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Phantombuster\PhantombusterService;
use OpenCompany\Integrations\Phantombuster\PhantombusterToolProvider;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterApiGet;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterLaunchAgent;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterListContainers;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterSaveScript;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for expanded Phantombuster API coverage.
 */
final class PhantombusterServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_agents_containers_scripts_org_and_generic_endpoints(): void
    {
        Http::fake([
            'https://api.phantombuster.com/api/v2/containers/fetch-output*' => Http::response('raw-output', 200, ['Content-Type' => 'text/plain']),
            'https://api.phantombuster.com/api/v2/*' => Http::response(['ok' => true, 'agents' => [], 'containers' => []], 200),
        ]);

        $service = new PhantombusterService('pb_test');

        $service->getCurrentUser();
        $service->listAgents(['withArgument' => true]);
        $service->getAgent('agent_1', ['withManifest' => true]);
        $service->saveAgent(['name' => 'Example']);
        $service->launchAgent('agent_1', ['bonusArgument' => ['url' => 'https://example.test']]);
        $service->stopAgent('agent_1');
        $service->deleteAgent('agent_1');
        $service->listDeletedAgents();
        $service->fetchAgentOutput('agent_1', ['fromOutputPos' => 10]);
        $service->listContainers('agent_1', ['limit' => 10, 'mode' => 'finalized']);
        $service->getContainer('container_1', ['withOutput' => true]);
        $service->fetchContainerOutput('container_1', 'raw');
        $service->fetchContainerResultObject('container_1');
        $service->listScripts();
        $service->getScript('script_1');
        $service->saveScript(['name' => 'Script']);
        $service->deleteScript('script_1');
        $service->listBranches();
        $service->getOrganization(['withProxies' => true]);
        $service->getIpLocation('203.0.113.10');
        $service->apiGet('/agents/fetch-all');
        $service->apiPost('/agents/save', ['name' => 'Example']);
        $service->apiPut('/custom/endpoint', ['ok' => true]);
        $service->apiDelete('/custom/endpoint');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('X-Phantombuster-Key', 'pb_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.phantombuster.com/api/v2/user');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.phantombuster.com/api/v2/agents/fetch-all?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.phantombuster.com/api/v2/agents/fetch?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.phantombuster.com/api/v2/agents/save');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.phantombuster.com/api/v2/agents/launch');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.phantombuster.com/api/v2/agents/stop');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.phantombuster.com/api/v2/agents/delete');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.phantombuster.com/api/v2/agents/fetch-deleted');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.phantombuster.com/api/v2/agents/fetch-output?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.phantombuster.com/api/v2/containers/fetch-all?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.phantombuster.com/api/v2/containers/fetch?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.phantombuster.com/api/v2/containers/fetch-output?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.phantombuster.com/api/v2/containers/fetch-result-object?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.phantombuster.com/api/v2/scripts/fetch-all');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.phantombuster.com/api/v2/scripts/fetch?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.phantombuster.com/api/v2/scripts/save');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.phantombuster.com/api/v2/scripts/delete');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.phantombuster.com/api/v2/branches/fetch-all');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.phantombuster.com/api/v2/orgs/fetch?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.phantombuster.com/api/v2/location/ip?'));
    }

    public function test_new_tools_delegate_and_validate_required_arguments(): void
    {
        Http::fake([
            'https://api.phantombuster.com/api/v2/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new PhantombusterService('pb_test');

        self::assertTrue((new PhantombusterLaunchAgent($service))->execute([
            'id' => 'agent_1',
            'bonus_argument' => ['url' => 'https://example.test'],
        ])->succeeded());
        self::assertTrue((new PhantombusterListContainers($service))->execute([
            'agent_id' => 'agent_1',
        ])->succeeded());
        self::assertTrue((new PhantombusterSaveScript($service))->execute([
            'payload' => ['name' => 'Script'],
        ])->succeeded());
        self::assertTrue((new PhantombusterApiGet($service))->execute([
            'path' => '/agents/fetch-all',
        ])->succeeded());
        self::assertFalse((new PhantombusterLaunchAgent($service))->execute([])->succeeded());
        self::assertFalse((new PhantombusterListContainers($service))->execute([])->succeeded());
        self::assertFalse((new PhantombusterSaveScript($service))->execute([])->succeeded());
        self::assertFalse((new PhantombusterApiGet($service))->execute([
            'path' => 'https://example.test/agents/fetch-all',
        ])->succeeded());
    }

    public function test_provider_exposes_expanded_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://api.phantombuster.com/api/v2/user' => Http::response(['email' => 'person@example.test'], 200),
        ]);

        $provider = new PhantombusterToolProvider();
        $tools = $provider->tools();

        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertArrayHasKey('phantombuster_save_agent', $tools);
        self::assertArrayHasKey('phantombuster_fetch_agent_output', $tools);
        self::assertArrayHasKey('phantombuster_fetch_container_output', $tools);
        self::assertArrayHasKey('phantombuster_list_scripts', $tools);
        self::assertArrayHasKey('phantombuster_get_organization', $tools);
        self::assertArrayHasKey('phantombuster_api_delete', $tools);
        self::assertSame(24, count($tools));
        self::assertTrue($provider->testConnection([
            'api_key' => 'pb_test',
        ])['success']);
    }
}
