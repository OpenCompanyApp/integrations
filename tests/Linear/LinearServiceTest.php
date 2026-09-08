<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Linear;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Linear\LinearService;
use OpenCompany\Integrations\Linear\LinearToolProvider;
use OpenCompany\Integrations\Linear\Tools\LinearCreateIssue;
use OpenCompany\Integrations\Linear\Tools\LinearListIssues;
use OpenCompany\Integrations\Linear\Tools\LinearRawQuery;
use OpenCompany\Integrations\Linear\Tools\LinearUpdateIssue;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Linear GraphQL API mapping.
 */
final class LinearServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(LinearService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(LinearService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_docs_and_connection(): void
    {
        $provider = new LinearToolProvider;

        self::assertSame('linear', $provider->appName());
        self::assertSame('Linear', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertCount(20, $provider->tools());
        self::assertArrayHasKey('linear_create_issue', $provider->tools());
        self::assertArrayHasKey('linear_raw_query', $provider->tools());
        self::assertFileExists((string) $provider->scriptDocsPath());

        Http::fake(['https://api.linear.app/graphql' => Http::response(['data' => ['viewer' => ['id' => 'user_1', 'name' => 'Agent']]], 200)]);
        $result = $provider->testConnection(['api_key' => 'lin_api_test']);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.linear.app/graphql'
            && $request->hasHeader('Authorization', 'Bearer lin_api_test')
            && str_contains((string) $request['query'], 'viewer'));
    }

    public function test_service_maps_core_graphql_queries_and_mutations(): void
    {
        Http::fake(['https://api.linear.app/graphql' => Http::response(['data' => ['ok' => true]], 200)]);

        $service = new LinearService('lin_api_test');

        $service->createIssue(['teamId' => 'team_1', 'title' => 'Fix login']);
        $service->getIssue('issue_1');
        $service->updateIssue('issue_1', ['title' => 'Fix login now']);
        $service->deleteIssue('issue_1');
        $service->createComment('issue_1', 'Looks good');
        $service->listComments('issue_1');
        $service->getTeams();
        $service->listProjects(10, 'cursor_1');
        $service->createProject(['name' => 'Launch', 'teamIds' => ['team_1']]);
        $service->updateProject('project_1', ['name' => 'Launch v2']);
        $service->listInitiatives(5);
        $service->createInitiative(['name' => 'Growth']);
        $service->listLabels('team_1');
        $service->listWorkflowStates('team_1');
        $service->getCurrentUser();
        $service->rawQuery('query Custom($id: String!) { issue(id: $id) { id } }', ['id' => 'issue_1']);

        Http::assertSent(static fn (Request $request): bool => str_contains((string) $request['query'], 'mutation IssueCreate')
            && $request['variables']['input'] === ['teamId' => 'team_1', 'title' => 'Fix login']);
        Http::assertSent(static fn (Request $request): bool => str_contains((string) $request['query'], 'query Issue($id')
            && ($request['variables']['id'] ?? null) === 'issue_1');
        Http::assertSent(static fn (Request $request): bool => str_contains((string) $request['query'], 'mutation IssueUpdate')
            && $request['variables']['input'] === ['title' => 'Fix login now']);
        Http::assertSent(static fn (Request $request): bool => str_contains((string) $request['query'], 'mutation IssueDelete'));
        Http::assertSent(static fn (Request $request): bool => str_contains((string) $request['query'], 'mutation CommentCreate')
            && $request['variables']['input'] === ['issueId' => 'issue_1', 'body' => 'Looks good']);
        Http::assertSent(static fn (Request $request): bool => str_contains((string) $request['query'], 'query Teams')
            && $request->hasHeader('Authorization', 'Bearer lin_api_test'));
        Http::assertSent(static fn (Request $request): bool => str_contains((string) $request['query'], 'query Projects')
            && $request['variables'] === ['first' => 10, 'after' => 'cursor_1']);
        Http::assertSent(static fn (Request $request): bool => str_contains((string) $request['query'], 'mutation ProjectCreate')
            && $request['variables']['input'] === ['name' => 'Launch', 'teamIds' => ['team_1']]);
        Http::assertSent(static fn (Request $request): bool => str_contains((string) $request['query'], 'query IssueLabels')
            && $request['variables']['filter'] === ['team' => ['id' => ['eq' => 'team_1']]]);
        Http::assertSent(static fn (Request $request): bool => str_contains((string) $request['query'], 'query Custom')
            && $request['variables'] === ['id' => 'issue_1']);
    }

    public function test_graphql_errors_are_normalized(): void
    {
        Http::fake(['https://api.linear.app/graphql' => Http::response([
            'errors' => [
                ['message' => 'Not authorized'],
                ['message' => 'Invalid team id'],
            ],
        ], 200)]);

        $result = (new LinearRawQuery(new LinearService('lin_api_test')))->execute([
            'query' => 'query Viewer { viewer { id } }',
        ]);

        self::assertFalse($result->succeeded());
        self::assertSame('Linear API error: Not authorized; Invalid team id', $result->error);
    }

    public function test_tools_shape_issue_payloads_and_validate_inputs(): void
    {
        Http::fake(['https://api.linear.app/graphql' => Http::response([
            'data' => [
                'issueCreate' => ['success' => true, 'issue' => ['id' => 'issue_1', 'title' => 'Fix login']],
                'issueUpdate' => ['success' => true, 'issue' => ['id' => 'issue_1', 'title' => 'Fix login now']],
                'issues' => ['nodes' => [['id' => 'issue_1']], 'pageInfo' => ['hasNextPage' => false]],
            ],
        ], 200)]);

        $service = new LinearService('lin_api_test');

        $created = (new LinearCreateIssue($service))->execute([
            'team_id' => 'team_1',
            'title' => 'Fix login',
            'description' => 'OAuth callback fails',
            'label_ids' => 'label_1',
            'priority' => 2,
        ]);
        self::assertTrue($created->succeeded());

        $missing = (new LinearCreateIssue($service))->execute(['team_id' => 'team_1']);
        self::assertFalse($missing->succeeded());
        self::assertSame('title is required.', $missing->error);

        $updated = (new LinearUpdateIssue($service))->execute([
            'id' => 'issue_1',
            'title' => 'Fix login now',
            'state_id' => 'state_done',
        ]);
        self::assertTrue($updated->succeeded());

        $listed = (new LinearListIssues($service))->execute([
            'team_id' => 'team_1',
            'limit' => 5,
            'after' => 'cursor_1',
            'status' => 'Todo',
            'assignee_id' => 'user_1',
        ]);
        self::assertTrue($listed->succeeded());

        Http::assertSent(static fn (Request $request): bool => str_contains((string) $request['query'], 'mutation IssueCreate')
            && $request['variables']['input']['teamId'] === 'team_1'
            && $request['variables']['input']['labelIds'] === ['label_1']
            && $request['variables']['input']['priority'] === 2);
        Http::assertSent(static fn (Request $request): bool => str_contains((string) $request['query'], 'mutation IssueUpdate')
            && $request['variables']['input']['stateId'] === 'state_done');
        Http::assertSent(static fn (Request $request): bool => str_contains((string) $request['query'], 'query Issues')
            && $request['variables']['filter']['team'] === ['id' => ['eq' => 'team_1']]
            && $request['variables']['filter']['state'] === ['name' => ['eq' => 'Todo']]
            && $request['variables']['filter']['assignee'] === ['id' => ['eq' => 'user_1']]
            && $request['variables']['first'] === 5
            && $request['variables']['after'] === 'cursor_1');
    }

    public function test_multi_account_resolution_uses_account_api_key(): void
    {
        Http::fake(['https://api.linear.app/graphql' => Http::response(['data' => ['viewer' => ['id' => 'user_1']]], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['linear', 'api_key', 'workspace'] => 'account-linear-key',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'linear' && $account === 'workspace';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'linear' ? ['workspace'] : [];
            }
        });

        $tool = (new LinearToolProvider)->createTool(\OpenCompany\Integrations\Linear\Tools\LinearGetCurrentUser::class, ['account' => 'workspace']);
        self::assertTrue($tool->execute([])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.linear.app/graphql'
            && $request->hasHeader('Authorization', 'Bearer account-linear-key'));
    }
}
