<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\AzureDevOps;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\AzureDevOps\AzureDevOpsService;
use OpenCompany\Integrations\AzureDevOps\AzureDevOpsToolProvider;
use OpenCompany\Integrations\AzureDevOps\Tools\AzureDevOpsCoreProjectsList;
use OpenCompany\Integrations\AzureDevOps\Tools\AzureDevOpsGitRepositoriesCreate;
use OpenCompany\Integrations\AzureDevOps\Tools\AzureDevOpsGitRepositoriesList;
use OpenCompany\Integrations\AzureDevOps\Tools\AzureDevOpsWitWorkItemsCreate;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the generated Azure DevOps REST API integration.
 */
final class AzureDevOpsServiceTest extends TestCase
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

    public function test_provider_matches_swagger_manifest_and_docs(): void
    {
        $provider = new AzureDevOpsToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/azure-devops/azure-devops-swagger-manifest.json'), true);

        self::assertSame(56, $manifest['spec_file_count']);
        self::assertSame(1083, $manifest['method_count']);
        self::assertSame('7.2', $manifest['version']);
        self::assertSame('2.0', $manifest['swagger']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Azure DevOps', $provider->integrationMeta()['name']);
        self::assertSame('pat_or_bearer', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertContains('azure_devops_core_projects_list', array_keys($provider->tools()));
        self::assertContains('azure_devops_git_repositories_list', array_keys($provider->tools()));
        self::assertContains('azure_devops_wit_work_items_get_work_items_batch', array_keys($provider->tools()));
        self::assertContains('azure_devops_build_builds_list', array_keys($provider->tools()));
    }

    public function test_service_maps_pat_auth_path_query_api_version_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new AzureDevOpsService(personalAccessToken: 'azdo-pat', baseUrl: 'https://azdo.example.test');
        $service->request('GET', 'dev.azure.com', '/{organization}/{project}/_apis/git/repositories', ['organization' => 'contoso', 'project' => 'Web App'], ['includeLinks' => true], [], [], 'json', '7.2-preview.2');
        $service->request('POST', 'dev.azure.com', '/{organization}/{project}/_apis/git/repositories', ['organization' => 'contoso', 'project' => 'Web App'], [], [], ['name' => 'repo-one'], 'json', '7.2-preview.2');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://azdo.example.test/contoso/Web%20App/_apis/git/repositories?includeLinks=true&api-version=7.2-preview.2'
            && $request->hasHeader('Authorization', 'Basic ' . base64_encode(':azdo-pat')));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://azdo.example.test/contoso/Web%20App/_apis/git/repositories?api-version=7.2-preview.2'
            && $request->data()['name'] === 'repo-one');
    }

    public function test_service_maps_bearer_auth_and_dollar_path_placeholders(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new AzureDevOpsService(accessToken: 'bearer-token', baseUrl: 'https://azdo.example.test');
        $service->request('POST', 'dev.azure.com', '/{organization}/{project}/_apis/wit/workitems/${type}', ['organization' => 'contoso', 'project' => 'Web App', 'type' => 'Bug'], [], [], [['op' => 'add', 'path' => '/fields/System.Title', 'value' => 'Fix login']], 'json', '7.2-preview.3');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://azdo.example.test/contoso/Web%20App/_apis/wit/workitems/Bug?api-version=7.2-preview.3'
            && $request->hasHeader('Authorization', 'Bearer bearer-token')
            && $request->data()[0]['path'] === '/fields/System.Title');
    }

    public function test_tools_validate_and_map_parameters(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new AzureDevOpsService(personalAccessToken: 'azdo-pat', baseUrl: 'https://azdo.example.test');

        self::assertTrue((new AzureDevOpsCoreProjectsList($service))->execute(['organization' => 'contoso', 'top' => 10])->succeeded());
        self::assertTrue((new AzureDevOpsGitRepositoriesList($service))->execute(['organization' => 'contoso', 'project' => 'Web App', 'include_links' => true])->succeeded());
        self::assertTrue((new AzureDevOpsGitRepositoriesCreate($service))->execute(['organization' => 'contoso', 'project' => 'Web App', 'body' => ['name' => 'repo-one']])->succeeded());
        self::assertTrue((new AzureDevOpsWitWorkItemsCreate($service))->execute(['organization' => 'contoso', 'project' => 'Web App', 'type' => 'Bug', 'body' => [['op' => 'add', 'path' => '/fields/System.Title', 'value' => 'Fix login']]])->succeeded());

        $missingPath = (new AzureDevOpsGitRepositoriesList($service))->execute(['organization' => 'contoso']);
        $badBody = (new AzureDevOpsGitRepositoriesCreate($service))->execute(['organization' => 'contoso', 'project' => 'Web App', 'body' => 'not-object']);
        $missingBody = (new AzureDevOpsGitRepositoriesCreate($service))->execute(['organization' => 'contoso', 'project' => 'Web App']);
        $unconfigured = (new AzureDevOpsCoreProjectsList(new AzureDevOpsService(baseUrl: 'https://azdo.example.test')))->execute(['organization' => 'contoso']);

        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('project must be a non-empty parameter', (string) $missingPath->error);
        self::assertFalse($badBody->succeeded());
        self::assertStringContainsString('body must be an object', (string) $badBody->error);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be a non-empty object', (string) $missingBody->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('personal access token or access token is required', (string) $unconfigured->error);
    }

    public function test_connection_uses_projects_probe_with_pat(): void
    {
        Http::fake(['dev.azure.com/contoso/_apis/projects?api-version=7.2' => Http::response(['value' => []], 200)]);

        $result = (new AzureDevOpsToolProvider)->testConnection([
            'personal_access_token' => 'azdo-pat',
            'organization' => 'contoso',
        ]);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://dev.azure.com/contoso/_apis/projects?api-version=7.2'
            && $request->hasHeader('Authorization', 'Basic ' . base64_encode(':azdo-pat')));
    }

    public function test_create_tool_resolves_account_specific_credentials(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                $values = [
                    'personal_access_token' => $account === 'work' ? 'work-pat' : 'default-pat',
                    'access_token' => '',
                    'base_url' => 'https://azdo.example.test',
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

        $tool = (new AzureDevOpsToolProvider)->createTool(AzureDevOpsCoreProjectsList::class, ['account' => 'work']);
        self::assertTrue($tool->execute(['organization' => 'contoso'])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Basic ' . base64_encode(':work-pat')));
    }
}
