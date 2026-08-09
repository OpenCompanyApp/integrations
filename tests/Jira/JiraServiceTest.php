<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Jira;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Jira\JiraService;
use OpenCompany\Integrations\Jira\JiraToolProvider;
use OpenCompany\Integrations\Jira\Tools\JiraAddAttachment;
use OpenCompany\Integrations\Jira\Tools\JiraCreateIssue;
use OpenCompany\Integrations\Jira\Tools\JiraListProjects;
use OpenCompany\Integrations\Jira\Tools\JiraSearchIssues;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Jira Cloud REST and Agile API integration.
 */
final class JiraServiceTest extends TestCase
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
        $provider = new JiraToolProvider;
        $tools = $provider->tools();

        self::assertSame('jira', $provider->appName());
        self::assertSame('Jira', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://developer.atlassian.com/cloud/jira/platform/rest/v3/', $provider->integrationMeta()['docs_url']);
        self::assertSame('api_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());

        self::assertCount(20, $tools);
        self::assertArrayHasKey('jira_create_issue', $tools);
        self::assertArrayHasKey('jira_list_boards', $tools);
        self::assertArrayHasKey('jira_add_attachment', $tools);

        foreach ($tools as $tool) {
            self::assertTrue(class_exists($tool['class']), $tool['class'].' should exist.');
        }
    }

    public function test_service_maps_rest_v3_agile_and_attachment_requests(): void
    {
        Http::fake(['*' => Http::response(['id' => '10001', 'displayName' => 'Agent'], 200)]);

        $service = new JiraService('jira-test-token', 'https://jira.example.test');

        $service->createIssue(['project' => ['key' => 'OPS'], 'summary' => 'Bug', 'issuetype' => ['name' => 'Task']]);
        $service->getIssue('OPS-7');
        $service->updateIssue('OPS-7', ['summary' => 'Updated']);
        $service->searchIssues(['jql' => 'project = OPS', 'maxResults' => 5]);
        $service->deleteIssue('OPS-7');
        $service->addComment('OPS-7', 'Looks good.');
        $service->listComments('OPS-7');
        $service->getTransitions('OPS-7');
        $service->transitionIssue('OPS-7', '31');
        $service->assignIssue('OPS-7', 'acct-123');
        $service->addAttachment('OPS-7', 'report.txt', 'hello');
        $service->listProjects(['startAt' => 0, 'maxResults' => 10]);
        $service->getIssueTypes();
        $service->listPriorities();
        $service->getUser('acct-123');
        $service->searchUsers(['query' => 'agent', 'maxResults' => 2]);
        $service->createVersion(['project' => 'OPS', 'name' => 'v1.0.0']);
        $service->listBoards(['projectKeyOrId' => 'OPS']);
        $service->listSprints(42, ['state' => 'active']);
        $service->listSprintIssues(77, ['maxResults' => 10]);
        $service->testConnection();

        Http::assertSentCount(21);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://jira.example.test/rest/api/3/issue'
            && $request->hasHeader('Authorization', 'Bearer jira-test-token')
            && $request->hasHeader('Accept', 'application/json')
            && $request->data()['fields']['project']['key'] === 'OPS');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://jira.example.test/rest/api/3/issue/OPS-7'
            && $request->data()['fields']['summary'] === 'Updated');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://jira.example.test/rest/api/3/search'
            && $request->data()['jql'] === 'project = OPS'
            && $request->data()['maxResults'] === 5);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://jira.example.test/rest/api/3/issue/OPS-7/comment'
            && $request->data()['body']['content'][0]['content'][0]['text'] === 'Looks good.');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://jira.example.test/rest/api/3/issue/OPS-7/transitions'
            && $request->data()['transition']['id'] === '31');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://jira.example.test/rest/api/3/issue/OPS-7/assignee'
            && $request->data()['accountId'] === 'acct-123');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://jira.example.test/rest/api/3/issue/OPS-7/attachments'
            && $request->hasHeader('X-Atlassian-Token', 'no-check'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://jira.example.test/rest/api/3/project/search?startAt=0&maxResults=10');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://jira.example.test/rest/agile/1.0/board?projectKeyOrId=OPS');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://jira.example.test/rest/agile/1.0/board/42/sprint?state=active');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://jira.example.test/rest/api/3/myself');
    }

    public function test_service_normalizes_errors_and_empty_successes(): void
    {
        Http::fake([
            'https://jira.example.test/rest/api/3/issue/OPS-7' => Http::sequence()
                ->push('', 204)
                ->push(['errorMessages' => ['Issue does not exist']], 404),
        ]);

        $service = new JiraService('jira-test-token', 'https://jira.example.test');

        self::assertSame(['success' => true], $service->deleteIssue('OPS-7'));

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Jira API error (404): Issue does not exist');

        $service->getIssue('OPS-7');
    }

    public function test_tools_validate_configuration_and_shape_agent_payloads(): void
    {
        Http::fake([
            'https://jira.example.test/rest/api/3/issue' => Http::response(['key' => 'OPS-7'], 200),
            'https://jira.example.test/rest/api/3/search' => Http::response(['issues' => []], 200),
            'https://jira.example.test/rest/api/3/issue/OPS-7/attachments' => Http::response([['filename' => 'report.txt']], 200),
        ]);

        $service = new JiraService('jira-test-token', 'https://jira.example.test');

        $created = (new JiraCreateIssue($service))->execute([
            'project_key' => 'OPS',
            'summary' => 'Bug',
            'description' => 'Broken flow',
            'priority' => 'High',
            'assignee' => 'acct-123',
            'labels' => ['bug'],
        ]);
        $searched = (new JiraSearchIssues($service))->execute([
            'jql' => 'project = OPS',
            'start_at' => 0,
            'max_results' => 5,
            'fields' => 'summary,status',
        ]);
        $attached = (new JiraAddAttachment($service))->execute([
            'issue_key' => 'OPS-7',
            'filename' => 'report.txt',
            'content' => 'hello',
        ]);
        $missingSummary = (new JiraCreateIssue($service))->execute(['project_key' => 'OPS']);
        $unconfigured = (new JiraListProjects(new JiraService('', 'https://jira.example.test')))->execute([]);

        self::assertTrue($created->succeeded());
        self::assertTrue($searched->succeeded());
        self::assertTrue($attached->succeeded());
        self::assertFalse($missingSummary->succeeded());
        self::assertStringContainsString('Issue summary is required', (string) $missingSummary->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('Missing API token', (string) $unconfigured->error);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://jira.example.test/rest/api/3/issue'
            && $request->data()['fields']['description']['content'][0]['content'][0]['text'] === 'Broken flow'
            && $request->data()['fields']['priority']['name'] === 'High'
            && $request->data()['fields']['assignee']['accountId'] === 'acct-123'
            && $request->data()['fields']['labels'][0] === 'bug');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://jira.example.test/rest/api/3/search'
            && $request->data()['startAt'] === 0
            && $request->data()['maxResults'] === 5
            && $request->data()['fields'] === 'summary,status');
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new JiraToolProvider;

        self::assertFalse($provider->testConnection([])['success']);
        self::assertFalse($provider->testConnection(['api_token' => 'jira-test-token'])['success']);

        Http::fake([
            'https://jira.example.test/rest/api/3/myself' => Http::response(['displayName' => 'Agent'], 200),
            'https://jira.internal.test/rest/api/3/project/search?maxResults=5' => Http::response(['values' => []], 200),
        ]);

        $result = $provider->testConnection([
            'api_token' => 'jira-test-token',
            'base_url' => 'https://jira.example.test',
        ]);

        self::assertTrue($result['success']);
        self::assertStringContainsString('Agent', (string) $result['message']);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                $values = [
                    'api_token' => $account === 'work' ? 'jira-work-token' : 'jira-default-token',
                    'base_url' => 'https://jira.internal.test',
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

        $tool = $provider->createTool(JiraListProjects::class, ['account' => 'work']);
        self::assertTrue($tool->execute(['max_results' => 5])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://jira.example.test/rest/api/3/myself'
            && $request->hasHeader('Authorization', 'Bearer jira-test-token'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://jira.internal.test/rest/api/3/project/search?maxResults=5'
            && $request->hasHeader('Authorization', 'Bearer jira-work-token'));
    }
}
