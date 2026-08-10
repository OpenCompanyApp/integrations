<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\TeamCity;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\TeamCity\TeamCityService;
use OpenCompany\Integrations\TeamCity\TeamCityToolProvider;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityApiGet;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityListBuilds;
use OpenCompany\Integrations\TeamCity\Tools\TeamCityQueueBuild;
use OpenCompany\Integrations\TeamCity\Tools\TeamCitySetQueuePaused;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the TeamCity REST API integration.
 */
final class TeamCityServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(TeamCityService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(TeamCityService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_credentials_and_tools(): void
    {
        $provider = new TeamCityToolProvider();

        self::assertSame('teamcity', $provider->appName());
        self::assertSame('TeamCity', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertCount(35, $provider->tools());
        self::assertArrayHasKey('teamcity_list_projects', $provider->tools());
        self::assertArrayHasKey('teamcity_queue_build', $provider->tools());
        self::assertArrayHasKey('teamcity_list_agents', $provider->tools());
        self::assertArrayHasKey('teamcity_api_get', $provider->tools());
    }

    public function test_service_maps_core_teamcity_rest_endpoints(): void
    {
        Http::fake([
            'https://teamcity.example.test/app/rest/*' => Http::response(['id' => 'ok', 'name' => 'Example'], 200),
        ]);

        $service = new TeamCityService('tc-token', 'https://teamcity.example.test');
        $service->getServerInfo();
        $service->listProjects(['locator' => 'archived:false', 'fields' => 'project(id,name)']);
        $service->getProject('id:Project');
        $service->createProject(['parentProject' => ['id' => '_Root'], 'name' => 'Example']);
        $service->deleteProject('id:OldProject');
        $service->listBuildTypes(['locator' => 'project:id:Project']);
        $service->getBuildType('id:Project_Build');
        $service->listBuildTypeBuilds('id:Project_Build', ['locator' => 'status:SUCCESS']);
        $service->listBuilds(['locator' => 'buildType:id:Project_Build,count:10']);
        $service->getBuild('id:12345');
        $service->queueBuild(['buildType' => ['id' => 'Project_Build'], 'branchName' => 'main']);
        $service->cancelQueuedBuild('id:12345', ['comment' => 'Stop', 'readdIntoQueue' => false]);
        $service->cancelBuild('id:23456', ['comment' => 'Stop', 'readdIntoQueue' => false]);
        $service->deleteBuild('id:34567');
        $service->listBuildArtifacts('id:12345', 'dist/app.zip', ['fields' => 'file(name,size)']);
        $service->getBuildStatistics('id:12345');
        $service->getBuildTags('id:12345');
        $service->addBuildTags('id:12345', ['tag' => [['name' => 'release']]]);
        $service->setBuildPinInfo('id:12345', ['comment' => ['text' => 'Keep release']]);
        $service->listBuildQueue(['locator' => 'buildType:id:Project_Build']);
        $service->setQueuePaused(['paused' => true, 'reason' => 'Maintenance']);
        $service->listAgents(['locator' => 'connected:true']);
        $service->getAgent('id:7');
        $service->listUsers(['locator' => 'username:ada']);
        $service->getUser('username:ada');
        $service->listGroups(['locator' => 'key:ALL_USERS_GROUP']);
        $service->listInvestigations(['locator' => 'state:taken']);
        $service->listProblems(['locator' => 'currentlyFailing:true']);
        $service->listChanges(['locator' => 'build:(id:12345)']);
        $service->listVcsRoots(['locator' => 'project:id:Project']);
        $service->apiGet('/projects', ['fields' => 'project(id)']);
        $service->apiPost('/buildQueue', ['buildType' => ['id' => 'Project_Build']]);
        $service->apiPut('/buildQueue/pausedState', ['paused' => false]);
        $service->apiPatch('/projects/id:Project', ['description' => 'Updated']);
        $service->apiDelete('/builds/id:12345/tags/obsolete', ['fields' => 'tag(name)']);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer tc-token'));
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Accept', 'application/json'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://teamcity.example.test/app/rest/server');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://teamcity.example.test/app/rest/projects?locator=archived%3Afalse&fields=project%28id%2Cname%29');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://teamcity.example.test/app/rest/projects/id:Project');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://teamcity.example.test/app/rest/projects' && $request->data()['name'] === 'Example');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://teamcity.example.test/app/rest/projects/id:OldProject');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://teamcity.example.test/app/rest/buildTypes?locator=project%3Aid%3AProject');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://teamcity.example.test/app/rest/buildTypes/id:Project_Build/builds?locator=status%3ASUCCESS');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://teamcity.example.test/app/rest/builds?locator=buildType%3Aid%3AProject_Build%2Ccount%3A10');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://teamcity.example.test/app/rest/buildQueue' && ($request->data()['branchName'] ?? null) === 'main');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://teamcity.example.test/app/rest/buildQueue/id:12345' && $request->data()['comment'] === 'Stop');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://teamcity.example.test/app/rest/builds/id:23456' && $request->data()['readdIntoQueue'] === false);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://teamcity.example.test/app/rest/builds/id:12345/artifacts/dist/app.zip?fields=file%28name%2Csize%29');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://teamcity.example.test/app/rest/buildQueue/pausedState' && $request->data()['paused'] === true);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://teamcity.example.test/app/rest/users/username:ada');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://teamcity.example.test/app/rest/builds/id:12345/tags/obsolete?fields=tag%28name%29');
    }

    public function test_tools_map_agent_arguments_validate_paths_and_report_errors(): void
    {
        Http::fake([
            'https://teamcity.example.test/app/rest/*' => Http::response(['id' => 'ok'], 200),
        ]);

        $service = new TeamCityService('tc-token', 'https://teamcity.example.test/app/rest');

        self::assertTrue((new TeamCityListBuilds($service))->execute([
            'locator' => 'status:SUCCESS,count:5',
        ])->succeeded());
        self::assertTrue((new TeamCityQueueBuild($service))->execute([
            'payload' => ['buildType' => ['id' => 'Project_Build']],
        ])->succeeded());
        self::assertTrue((new TeamCitySetQueuePaused($service))->execute([
            'paused' => false,
            'reason' => 'Done',
        ])->succeeded());

        $badRaw = (new TeamCityApiGet($service))->execute(['path' => 'https://evil.example.test/projects']);
        self::assertFalse($badRaw->succeeded());
        self::assertStringContainsString('relative path', (string) $badRaw->error);

        $unconfigured = (new TeamCityApiGet(new TeamCityService('', 'https://teamcity.example.test')))->execute(['path' => '/server']);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://teamcity.example.test/app/rest/builds?locator=status%3ASUCCESS%2Ccount%3A5');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://teamcity.example.test/app/rest/buildQueue/pausedState' && $request->data()['reason'] === 'Done');
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new TeamCityToolProvider();

        self::assertSame(['success' => false, 'error' => 'TeamCity URL and access token are required.'], $provider->testConnection([]));

        Http::fake(['https://teamcity.example.test/app/rest/server' => Http::response(['version' => '2026.1'], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to TeamCity 2026.1.'], $provider->testConnection([
            'url' => 'https://teamcity.example.test',
            'access_token' => 'tc-token',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['https://teamcity.internal.test/app/rest/server' => Http::response(['version' => '2026.1'], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['teamcity', 'access_token', 'ops'] => 'account-token',
                    ['teamcity', 'url', 'ops'] => 'https://teamcity.internal.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'teamcity' && $account === 'ops';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'teamcity' ? ['ops'] : [];
            }
        });

        $tool = $provider->createTool(TeamCityApiGet::class, ['account' => 'ops']);
        self::assertTrue($tool->execute(['path' => '/server'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://teamcity.internal.test/app/rest/server'
            && $request->hasHeader('Authorization', 'Bearer account-token'));
    }
}
