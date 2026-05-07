<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Asana;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Asana\AsanaService;
use OpenCompany\Integrations\Asana\AsanaToolProvider;
use OpenCompany\Integrations\Asana\Tools\AsanaAddComment;
use OpenCompany\Integrations\Asana\Tools\AsanaCreateTask;
use OpenCompany\Integrations\Asana\Tools\AsanaListTasks;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for Asana REST API request and response mapping.
 */
final class AsanaServiceTest extends TestCase
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

    public function test_provider_metadata_credentials_and_tools(): void
    {
        Http::fake(['https://app.asana.com/api/1.0/users/me' => Http::response(['data' => ['name' => 'Jane Example', 'email' => 'jane@example.test']], 200)]);

        $provider = new AsanaToolProvider;

        self::assertSame('asana', $provider->appName());
        self::assertSame('Asana', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertSame(['access_token'], $provider->integrationCapabilities()['auth']['token_keys']);
        self::assertSame(['access_token'], array_column($provider->credentialFields(), 'key'));
        self::assertCount(20, $provider->tools());
        self::assertArrayHasKey('asana_create_task', $provider->tools());
        self::assertArrayHasKey('asana_list_workspaces', $provider->tools());
        self::assertFileExists((string) $provider->luaDocsPath());

        $connection = $provider->testConnection(['access_token' => 'asana_test']);
        self::assertTrue($connection['success']);
        self::assertStringContainsString('Jane Example', (string) $connection['message']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://app.asana.com/api/1.0/users/me'
            && $request->hasHeader('Authorization', 'Bearer asana_test'));
    }

    public function test_service_preserves_asana_response_envelope_and_maps_methods(): void
    {
        Http::fake(['*' => Http::response([
            'data' => [['gid' => 'task_123', 'name' => 'Draft launch plan']],
            'next_page' => ['offset' => 'next_cursor'],
        ], 200)]);

        $service = new AsanaService('asana_test');

        $created = $service->createTask(['name' => 'Draft launch plan', 'projects' => ['project_123']]);
        $listed = $service->listTasks(['project' => 'project_123', 'limit' => 50]);
        $updated = $service->updateTask('task_123', ['completed' => true]);
        $service->deleteTask('task_123');
        $service->addComment('task_123', 'Ready for review');
        $service->getUserTaskList('me', 'workspace_123');

        self::assertSame('task_123', $created['data'][0]['gid']);
        self::assertSame('next_cursor', $listed['next_page']['offset']);
        self::assertSame('task_123', $updated['data'][0]['gid']);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer asana_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://app.asana.com/api/1.0/tasks'
            && $request['data']['name'] === 'Draft launch plan'
            && $request['data']['projects'] === ['project_123']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://app.asana.com/api/1.0/tasks?')
            && str_contains($request->url(), 'project=project_123')
            && str_contains($request->url(), 'limit=50')
            && str_contains($request->url(), 'opt_fields='));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://app.asana.com/api/1.0/tasks/task_123'
            && $request['data']['completed'] === true);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://app.asana.com/api/1.0/tasks/task_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://app.asana.com/api/1.0/tasks/task_123/stories'
            && $request['data']['text'] === 'Ready for review');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://app.asana.com/api/1.0/users/me/user_task_list?')
            && str_contains($request->url(), 'workspace=workspace_123'));
    }

    public function test_tools_validate_inputs_and_return_preserved_envelope(): void
    {
        Http::fake(['*' => Http::response(['data' => ['gid' => 'task_123', 'name' => 'Draft launch plan']], 200)]);

        $service = new AsanaService('asana_test');

        $created = (new AsanaCreateTask($service))->execute([
            'name' => 'Draft launch plan',
            'workspace' => 'workspace_123',
            'assignee' => 'me',
        ]);
        $listed = (new AsanaListTasks($service))->execute(['workspace' => 'workspace_123', 'assignee' => 'me']);
        $comment = (new AsanaAddComment($service))->execute(['task_id' => 'task_123', 'text' => 'Ready']);

        self::assertTrue($created->succeeded());
        self::assertSame('task_123', $created->data['data']['gid']);
        self::assertTrue($listed->succeeded());
        self::assertTrue($comment->succeeded());

        $missingName = (new AsanaCreateTask($service))->execute([]);
        self::assertFalse($missingName->succeeded());
        self::assertStringContainsString('name is required', (string) $missingName->error);

        $unconfigured = (new AsanaCreateTask(new AsanaService('')))->execute(['name' => 'Draft launch plan']);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }
}
