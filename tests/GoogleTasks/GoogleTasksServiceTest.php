<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\GoogleTasks;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\GoogleTasks\GoogleTasksService;
use OpenCompany\Integrations\GoogleTasks\GoogleTasksToolProvider;
use OpenCompany\Integrations\GoogleTasks\Tools\GoogleTasksTasklistsGet;
use OpenCompany\Integrations\GoogleTasks\Tools\GoogleTasksTasksInsert;
use OpenCompany\Integrations\GoogleTasks\Tools\GoogleTasksTasksList;
use PHPUnit\Framework\TestCase;

final class GoogleTasksServiceTest extends TestCase
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

    public function test_provider_matches_discovery_manifest_and_docs(): void
    {
        $provider = new GoogleTasksToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__ . '/../../packages/google-tasks/google-tasks-discovery-manifest.json'), true);

        self::assertSame(14, $manifest['method_count']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Google Tasks', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertContains('google_tasks_tasks_insert', array_keys($provider->tools()));
        self::assertContains('google_tasks_tasks_move', array_keys($provider->tools()));
        self::assertContains('google_tasks_tasklists_update', array_keys($provider->tools()));
    }

    public function test_service_maps_paths_query_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new GoogleTasksService('token-test', 'https://example.test');
        $service->request('GET', '/tasks/v1/lists/{tasklist}/tasks', ['tasklist' => 'list one'], [], ['maxResults' => 5]);
        $service->request('POST', '/tasks/v1/lists/{tasklist}/tasks', ['tasklist' => 'list one'], [], ['parent' => 'task-parent'], ['title' => 'Follow up']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/tasks/v1/lists/list%20one/tasks?maxResults=5'
            && $request->hasHeader('Authorization', 'Bearer token-test'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/tasks/v1/lists/list%20one/tasks?parent=task-parent'
            && $request['title'] === 'Follow up');
    }

    public function test_tools_filter_query_require_path_params_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);
        $service = new GoogleTasksService('token-test');

        $list = new GoogleTasksTasksList($service);
        $result = $list->execute(['tasklist' => 'list-1', 'maxResults' => 10, 'unknown' => 'ignored']);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://tasks.googleapis.com/tasks/v1/lists/list-1/tasks?maxResults=10');

        $missingPath = (new GoogleTasksTasklistsGet($service))->execute([]);
        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('tasklist must be', (string) $missingPath->error);

        $missingBody = (new GoogleTasksTasksInsert($service))->execute(['tasklist' => 'list-1']);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be', (string) $missingBody->error);
    }
}
