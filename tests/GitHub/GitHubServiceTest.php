<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\GitHub;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\GitHub\GitHubService;
use OpenCompany\Integrations\GitHub\GitHubToolProvider;
use OpenCompany\Integrations\GitHub\Tools\GitHubCreateIssue;
use OpenCompany\Integrations\GitHub\Tools\GitHubCreateOrUpdateFile;
use OpenCompany\Integrations\GitHub\Tools\GitHubDispatchWorkflow;
use OpenCompany\Integrations\GitHub\Tools\GitHubGetFileContent;
use OpenCompany\Integrations\GitHub\Tools\GitHubListRepos;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the GitHub REST API integration.
 */
final class GitHubServiceTest extends TestCase
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
        $provider = new GitHubToolProvider;
        $tools = $provider->tools();

        self::assertSame('github', $provider->appName());
        self::assertSame('GitHub', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://docs.github.com/en/rest', $provider->integrationMeta()['docs_url']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());

        self::assertCount(30, $tools);
        self::assertArrayHasKey('github_create_issue', $tools);
        self::assertArrayHasKey('github_create_or_update_file', $tools);
        self::assertArrayHasKey('github_dispatch_workflow', $tools);

        foreach ($tools as $tool) {
            self::assertTrue(class_exists($tool['class']), $tool['class'].' should exist.');
        }
    }

    public function test_service_maps_github_rest_paths_headers_queries_and_bodies(): void
    {
        Http::fake(['*' => Http::response(['id' => 123, 'login' => 'agent'], 200)]);

        $service = new GitHubService('ghp_test_token');

        $service->listRepos(['type' => 'owner', 'per_page' => 10]);
        $service->getRepo('octo-org', 'demo');
        $service->createRepo(['name' => 'demo', 'private' => true]);
        $service->searchRepos(['q' => 'topic:agents', 'sort' => 'stars']);
        $service->listIssues('octo-org', 'demo', ['state' => 'open']);
        $service->getIssue('octo-org', 'demo', 7);
        $service->createIssue('octo-org', 'demo', ['title' => 'Bug', 'labels' => ['bug']]);
        $service->updateIssue('octo-org', 'demo', 7, ['state' => 'closed']);
        $service->addLabels('octo-org', 'demo', 7, ['triaged']);
        $service->createIssueComment('octo-org', 'demo', 7, 'Looks good.');
        $service->listPullRequests('octo-org', 'demo', ['state' => 'open']);
        $service->getPullRequest('octo-org', 'demo', 8);
        $service->createPullRequest('octo-org', 'demo', ['title' => 'Feature', 'head' => 'feature', 'base' => 'main']);
        $service->updatePullRequest('octo-org', 'demo', 8, ['title' => 'Updated']);
        $service->mergePullRequest('octo-org', 'demo', 8, ['merge_method' => 'squash']);
        $service->listPullRequestReviews('octo-org', 'demo', 8);
        $service->createReview('octo-org', 'demo', 8, ['event' => 'APPROVE']);
        $service->listCommits('octo-org', 'demo', ['sha' => 'main']);
        $service->getCommit('octo-org', 'demo', 'abc123');
        $service->getFileContent('octo-org', 'demo', 'src/App.php', ['ref' => 'main']);
        $service->createOrUpdateFile('octo-org', 'demo', 'README.md', ['message' => 'Update', 'content' => base64_encode('Hello')]);
        $service->createBranch('octo-org', 'demo', ['ref' => 'refs/heads/feature', 'sha' => 'abc123']);
        $service->listBranches('octo-org', 'demo', ['per_page' => 10]);
        $service->listReleases('octo-org', 'demo');
        $service->createRelease('octo-org', 'demo', ['tag_name' => 'v1.0.0']);
        $service->searchIssues(['q' => 'repo:octo-org/demo bug']);
        $service->getCurrentUser();
        $service->createGist(['description' => 'Note', 'files' => ['note.txt' => ['content' => 'Hello']]]);
        $service->listWorkflowRuns('octo-org', 'demo', ['status' => 'completed']);
        $service->dispatchWorkflow('octo-org', 'demo', 'ci.yml', ['ref' => 'main']);

        Http::assertSentCount(30);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.github.com/user/repos?type=owner&per_page=10'
            && $request->hasHeader('Authorization', 'Bearer ghp_test_token')
            && $request->hasHeader('Accept', 'application/vnd.github+json')
            && $request->hasHeader('X-GitHub-Api-Version', '2022-11-28'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.github.com/user/repos'
            && $request->data()['name'] === 'demo'
            && $request->data()['private'] === true);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.github.com/search/repositories?q=topic%3Aagents&sort=stars');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.github.com/repos/octo-org/demo/issues'
            && $request->data()['title'] === 'Bug'
            && $request->data()['labels'][0] === 'bug');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH'
            && $request->url() === 'https://api.github.com/repos/octo-org/demo/issues/7'
            && $request->data()['state'] === 'closed');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://api.github.com/repos/octo-org/demo/pulls/8/merge'
            && $request->data()['merge_method'] === 'squash');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.github.com/repos/octo-org/demo/contents/src/App.php?ref=main');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://api.github.com/repos/octo-org/demo/contents/README.md'
            && $request->data()['message'] === 'Update');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.github.com/repos/octo-org/demo/actions/workflows/ci.yml/dispatches'
            && $request->data()['ref'] === 'main');
    }

    public function test_service_normalizes_github_errors_and_empty_successes(): void
    {
        Http::fake([
            'https://api.github.com/repos/octo-org/demo/actions/workflows/ci.yml/dispatches' => Http::response('', 204),
            'https://api.github.com/user/repos' => Http::response(['message' => 'Requires authentication'], 401),
        ]);

        $service = new GitHubService('ghp_test_token');

        self::assertSame(['success' => true], $service->dispatchWorkflow('octo-org', 'demo', 'ci.yml', ['ref' => 'main']));

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('GitHub API error (401): Requires authentication');

        $service->listRepos();
    }

    public function test_tools_validate_configuration_and_encode_file_content(): void
    {
        Http::fake([
            'https://api.github.com/repos/octo-org/demo/issues' => Http::response(['number' => 7, 'title' => 'Bug'], 200),
            'https://api.github.com/repos/octo-org/demo/contents/README.md?ref=main' => Http::response([
                'type' => 'file',
                'encoding' => 'base64',
                'content' => base64_encode('Hello GitHub'),
            ], 200),
            'https://api.github.com/repos/octo-org/demo/contents/README.md' => Http::response(['content' => ['path' => 'README.md']], 200),
            'https://api.github.com/repos/octo-org/demo/actions/workflows/ci.yml/dispatches' => Http::response('', 204),
        ]);

        $service = new GitHubService('ghp_test_token');

        $created = (new GitHubCreateIssue($service))->execute([
            'owner' => 'octo-org',
            'repo' => 'demo',
            'title' => 'Bug',
            'labels' => ['bug'],
        ]);
        $file = (new GitHubGetFileContent($service))->execute([
            'owner' => 'octo-org',
            'repo' => 'demo',
            'path' => 'README.md',
            'ref' => 'main',
        ]);
        $write = (new GitHubCreateOrUpdateFile($service))->execute([
            'owner' => 'octo-org',
            'repo' => 'demo',
            'path' => 'README.md',
            'message' => 'Update README',
            'content' => 'Hello GitHub',
        ]);
        $dispatch = (new GitHubDispatchWorkflow($service))->execute([
            'owner' => 'octo-org',
            'repo' => 'demo',
            'workflow_id' => 'ci.yml',
            'ref' => 'main',
        ]);
        $missingTitle = (new GitHubCreateIssue($service))->execute(['owner' => 'octo-org', 'repo' => 'demo']);
        $unconfigured = (new GitHubListRepos(new GitHubService('')))->execute([]);

        self::assertTrue($created->succeeded());
        self::assertTrue($file->succeeded());
        self::assertSame('Hello GitHub', $file->data['decoded_content']);
        self::assertTrue($write->succeeded());
        self::assertTrue($dispatch->succeeded());
        self::assertFalse($missingTitle->succeeded());
        self::assertStringContainsString('Issue title is required', (string) $missingTitle->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('Missing API key', (string) $unconfigured->error);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://api.github.com/repos/octo-org/demo/contents/README.md'
            && $request->data()['content'] === base64_encode('Hello GitHub'));
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new GitHubToolProvider;

        self::assertFalse($provider->testConnection([])['success']);

        Http::fake([
            'https://api.github.com/user' => Http::response(['login' => 'agent'], 200),
            'https://api.github.com/user/repos?per_page=5' => Http::response([], 200),
        ]);

        $result = $provider->testConnection(['api_key' => 'ghp_test_token']);

        self::assertTrue($result['success']);
        self::assertStringContainsString('@agent', (string) $result['message']);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return $key === 'api_key' && $account === 'work' ? 'ghp_work_token' : $default;
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

        $tool = $provider->createTool(GitHubListRepos::class, ['account' => 'work']);
        self::assertTrue($tool->execute(['per_page' => 5])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.github.com/user'
            && $request->hasHeader('Authorization', 'Bearer ghp_test_token'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.github.com/user/repos?per_page=5'
            && $request->hasHeader('Authorization', 'Bearer ghp_work_token'));
    }
}
