<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\MicrosoftTodo;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\MicrosoftTodo\MicrosoftTodoService;
use OpenCompany\Integrations\MicrosoftTodo\MicrosoftTodoToolProvider;
use OpenCompany\Integrations\MicrosoftTodo\Tools\TodoCreateList;
use OpenCompany\Integrations\MicrosoftTodo\Tools\TodoCreateTask;
use OpenCompany\Integrations\MicrosoftTodo\Tools\TodoListLists;
use OpenCompany\Integrations\MicrosoftTodo\Tools\TodoListTasks;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Microsoft To Do Graph API integration.
 */
final class MicrosoftTodoServiceTest extends TestCase
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
        $provider = new MicrosoftTodoToolProvider;
        $tools = $provider->tools();

        self::assertSame('microsoft-todo', $provider->appName());
        self::assertSame('Microsoft To Do', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://learn.microsoft.com/en-us/graph/api/resources/todo-overview', $provider->integrationMeta()['docs_url']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());

        self::assertCount(7, $tools);
        self::assertArrayHasKey('todo_list_lists', $tools);
        self::assertArrayHasKey('todo_create_task', $tools);
        self::assertArrayHasKey('todo_get_current_user', $tools);

        foreach ($tools as $tool) {
            self::assertTrue(class_exists($tool['class']), $tool['class'].' should exist.');
        }
    }

    public function test_service_maps_graph_todo_list_task_and_user_requests(): void
    {
        Http::fake(['*' => Http::response(['id' => 'task_123', 'value' => []], 200)]);

        $service = new MicrosoftTodoService('todo-test-token', 'https://graph.example.test/v1.0');

        $service->listLists();
        $service->getList('list 123');
        $service->createList('Launch Tasks');
        $service->listTasks('list 123');
        $service->getTask('list 123', 'task 123');
        $service->createTask('list 123', 'Review PR', 'Check changes', ['dateTime' => '2026-06-01T10:00:00', 'timeZone' => 'UTC']);
        $service->getCurrentUser();

        Http::assertSentCount(7);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/me/todo/lists'
            && $request->hasHeader('Authorization', 'Bearer todo-test-token')
            && $request->hasHeader('Content-Type', 'application/json'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/me/todo/lists/list%20123');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://graph.example.test/v1.0/me/todo/lists'
            && $request->data()['displayName'] === 'Launch Tasks');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/me/todo/lists/list%20123/tasks');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/me/todo/lists/list%20123/tasks/task%20123');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://graph.example.test/v1.0/me/todo/lists/list%20123/tasks'
            && $request->data()['title'] === 'Review PR'
            && $request->data()['body']['content'] === 'Check changes'
            && $request->data()['dueDateTime']['timeZone'] === 'UTC');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/me');
    }

    public function test_service_normalizes_json_and_html_errors(): void
    {
        Http::fake([
            'https://graph.example.test/v1.0/me' => Http::response([
                'error' => ['message' => 'Access token has expired'],
            ], 401),
        ]);

        $service = new MicrosoftTodoService('todo-test-token', 'https://graph.example.test/v1.0');

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Microsoft Graph API error (401): Access token has expired');

        $service->getCurrentUser();
    }

    public function test_tools_validate_configuration_and_map_agent_parameters(): void
    {
        Http::fake([
            'https://graph.example.test/v1.0/me/todo/lists' => Http::response(['id' => 'list_123', 'displayName' => 'Work'], 201),
            'https://graph.example.test/v1.0/me/todo/lists/list_123/tasks' => Http::response(['id' => 'task_123', 'title' => 'Review PR'], 201),
        ]);

        $service = new MicrosoftTodoService('todo-test-token', 'https://graph.example.test/v1.0');

        $list = (new TodoCreateList($service))->execute(['display_name' => 'Work']);
        $legacyList = (new TodoCreateList($service))->execute(['displayName' => 'Legacy']);
        $task = (new TodoCreateTask($service))->execute([
            'list_id' => 'list_123',
            'title' => 'Review PR',
            'body' => 'Check changes',
            'due_date' => '2026-06-01T10:00:00',
            'due_timezone' => 'UTC',
        ]);
        $missingListName = (new TodoCreateList($service))->execute([]);
        $missingTaskTitle = (new TodoCreateTask($service))->execute(['list_id' => 'list_123']);
        $unconfigured = (new TodoListLists(new MicrosoftTodoService('', 'https://graph.example.test/v1.0')))->execute([]);

        self::assertTrue($list->succeeded());
        self::assertTrue($legacyList->succeeded());
        self::assertTrue($task->succeeded());
        self::assertFalse($missingListName->succeeded());
        self::assertStringContainsString('display_name', (string) $missingListName->error);
        self::assertFalse($missingTaskTitle->succeeded());
        self::assertStringContainsString('title', (string) $missingTaskTitle->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://graph.example.test/v1.0/me/todo/lists'
            && $request->data()['displayName'] === 'Work');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://graph.example.test/v1.0/me/todo/lists/list_123/tasks'
            && $request->data()['dueDateTime']['dateTime'] === '2026-06-01T10:00:00');
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new MicrosoftTodoToolProvider;

        self::assertFalse($provider->testConnection([])['success']);

        Http::fake([
            'https://graph.example.test/v1.0/me' => Http::sequence()
                ->push(['displayName' => 'Agent User', 'userPrincipalName' => 'agent@example.test'], 200)
                ->push(['error' => ['message' => 'InvalidAuthenticationToken']], 401),
            'https://graph.internal.test/v1.0/me/todo/lists/list_123/tasks' => Http::response(['value' => []], 200),
        ]);

        $result = $provider->testConnection([
            'access_token' => 'todo-test-token',
            'url' => 'https://graph.example.test/v1.0',
        ]);
        $badResult = $provider->testConnection([
            'access_token' => 'bad-token',
            'url' => 'https://graph.example.test/v1.0',
        ]);

        self::assertTrue($result['success']);
        self::assertStringContainsString('Agent User', (string) $result['message']);
        self::assertFalse($badResult['success']);
        self::assertStringContainsString('InvalidAuthenticationToken', (string) $badResult['error']);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration === 'microsoft-todo') {
                    return '';
                }

                if ($integration !== 'microsoft_todo') {
                    return $default;
                }

                $values = [
                    'access_token' => $account === 'work' ? 'todo-work-token' : 'todo-default-token',
                    'url' => 'https://graph.internal.test/v1.0',
                ];

                return $values[$key] ?? $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'microsoft_todo';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'microsoft_todo' ? ['work'] : [];
            }
        });

        $tool = $provider->createTool(TodoListTasks::class, ['account' => 'work']);
        self::assertTrue($tool->execute(['list_id' => 'list_123'])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/me'
            && $request->hasHeader('Authorization', 'Bearer todo-test-token'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.internal.test/v1.0/me/todo/lists/list_123/tasks'
            && $request->hasHeader('Authorization', 'Bearer todo-work-token'));
    }
}
