<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\GitLab;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\GitLab\GitLabService;
use OpenCompany\Integrations\GitLab\GitLabToolProvider;
use OpenCompany\Integrations\GitLab\Tools\GitLabCreateIssue;
use OpenCompany\Integrations\GitLab\Tools\GitLabGetFile;
use OpenCompany\Integrations\GitLab\Tools\GitLabListProjects;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the GitLab REST API v4 integration.
 */
final class GitLabServiceTest extends TestCase
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
        $provider = new GitLabToolProvider;
        $tools = $provider->tools();

        self::assertSame('gitlab', $provider->appName());
        self::assertSame('GitLab', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://docs.gitlab.com/ee/api/rest/', $provider->integrationMeta()['docs_url']);
        self::assertSame('api_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());

        self::assertCount(20, $tools);
        self::assertArrayHasKey('gitlab_create_issue', $tools);
        self::assertArrayHasKey('gitlab_accept_merge_request', $tools);
        self::assertArrayHasKey('gitlab_get_file', $tools);

        foreach ($tools as $tool) {
            self::assertTrue(class_exists($tool['class']), $tool['class'].' should exist.');
        }
    }

    public function test_service_maps_gitlab_v4_paths_queries_bodies_and_self_hosted_url(): void
    {
        Http::fake(['*' => Http::response(['id' => 123, 'username' => 'agent'], 200)]);

        $service = new GitLabService('glpat-test-token', 'https://gitlab.example.test/api/v4');

        $service->getCurrentUser();
        $service->listProjects(['membership' => true, 'search' => 'agent']);
        $service->getProject('group/project');
        $service->listGroups(['search' => 'platform']);
        $service->listProjectMembers('group/project', ['per_page' => 50]);
        $service->listLabels('group/project');
        $service->listIssues('group/project', ['state' => 'opened']);
        $service->getIssue('group/project', 7);
        $service->createIssue('group/project', ['title' => 'Bug', 'labels' => 'bug']);
        $service->updateIssue('group/project', 7, ['state_event' => 'close']);
        $service->createIssueNote('group/project', 7, 'Looks good.');
        $service->listMergeRequests('group/project', ['state' => 'opened']);
        $service->getMergeRequest('group/project', 8);
        $service->createMergeRequest('group/project', ['source_branch' => 'feature', 'target_branch' => 'main', 'title' => 'Feature']);
        $service->updateMergeRequest('group/project', 8, ['title' => 'Updated']);
        $service->acceptMergeRequest('group/project', 8, ['should_remove_source_branch' => true]);
        $service->listBranches('group/project', ['search' => 'main']);
        $service->createBranch('group/project', 'feature', 'main');
        $service->listCommits('group/project', ['ref_name' => 'main']);
        $service->getFile('group/project', 'src/App.php', 'main');

        Http::assertSentCount(20);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://gitlab.example.test/api/v4/user'
            && $request->hasHeader('Authorization', 'Bearer glpat-test-token'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://gitlab.example.test/api/v4/projects?membership=1&search=agent');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://gitlab.example.test/api/v4/projects/group%2Fproject');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://gitlab.example.test/api/v4/projects/group%2Fproject/issues'
            && $request->data()['title'] === 'Bug');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://gitlab.example.test/api/v4/projects/group%2Fproject/issues/7'
            && $request->data()['state_event'] === 'close');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://gitlab.example.test/api/v4/projects/group%2Fproject/issues/7/notes'
            && $request->data()['body'] === 'Looks good.');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://gitlab.example.test/api/v4/projects/group%2Fproject/merge_requests/8/merge'
            && $request->data()['should_remove_source_branch'] === true);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://gitlab.example.test/api/v4/projects/group%2Fproject/repository/branches'
            && $request->data()['branch'] === 'feature'
            && $request->data()['ref'] === 'main');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://gitlab.example.test/api/v4/projects/group%2Fproject/repository/files/src%2FApp.php?ref=main');
    }

    public function test_service_normalizes_gitlab_api_errors(): void
    {
        Http::fake([
            'https://gitlab.example.test/api/v4/projects' => Http::response(['message' => '403 Forbidden'], 403),
        ]);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('GitLab API error (403): 403 Forbidden');

        (new GitLabService('glpat-test-token', 'https://gitlab.example.test/api/v4'))->listProjects();
    }

    public function test_tools_validate_configuration_and_decode_file_content(): void
    {
        Http::fake([
            'https://gitlab.example.test/api/v4/projects/group%2Fproject/issues' => Http::response(['iid' => 7, 'title' => 'Bug'], 200),
            'https://gitlab.example.test/api/v4/projects/group%2Fproject/repository/files/README.md?ref=main' => Http::response([
                'file_name' => 'README.md',
                'encoding' => 'base64',
                'content' => base64_encode('Hello GitLab'),
            ], 200),
        ]);

        $service = new GitLabService('glpat-test-token', 'https://gitlab.example.test/api/v4');

        $created = (new GitLabCreateIssue($service))->execute([
            'project_id' => 'group/project',
            'title' => 'Bug',
            'labels' => 'bug',
        ]);
        $file = (new GitLabGetFile($service))->execute([
            'project_id' => 'group/project',
            'file_path' => 'README.md',
            'ref' => 'main',
        ]);
        $missingTitle = (new GitLabCreateIssue($service))->execute(['project_id' => 'group/project']);
        $unconfigured = (new GitLabListProjects(new GitLabService('', 'https://gitlab.example.test/api/v4')))->execute([]);

        self::assertTrue($created->succeeded());
        self::assertTrue($file->succeeded());
        self::assertSame('Hello GitLab', $file->data['decoded_content']);
        self::assertFalse($missingTitle->succeeded());
        self::assertStringContainsString('Issue title is required', (string) $missingTitle->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('Missing API token', (string) $unconfigured->error);
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new GitLabToolProvider;

        self::assertFalse($provider->testConnection([])['success']);

        Http::fake([
            'https://gitlab.example.test/api/v4/user' => Http::response(['username' => 'agent'], 200),
            'https://gitlab.internal.test/api/v4/projects?per_page=5' => Http::response([], 200),
        ]);

        $result = $provider->testConnection([
            'api_token' => 'glpat-test-token',
            'base_url' => 'https://gitlab.example.test/api/v4',
        ]);

        self::assertTrue($result['success']);
        self::assertStringContainsString('@agent', (string) $result['message']);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                $values = [
                    'api_token' => $account === 'work' ? 'glpat-work-token' : 'glpat-default-token',
                    'base_url' => 'https://gitlab.internal.test/api/v4',
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

        $tool = $provider->createTool(GitLabListProjects::class, ['account' => 'work']);
        self::assertTrue($tool->execute(['per_page' => 5])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://gitlab.example.test/api/v4/user'
            && $request->hasHeader('Authorization', 'Bearer glpat-test-token'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://gitlab.internal.test/api/v4/projects?per_page=5'
            && $request->hasHeader('Authorization', 'Bearer glpat-work-token'));
    }
}
