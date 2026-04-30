<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Todoist;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Todoist\TodoistService;
use OpenCompany\Integrations\Todoist\TodoistToolProvider;
use PHPUnit\Framework\TestCase;

final class TodoistServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_provider_exposes_every_tool_file(): void
    {
        $toolFiles = glob(__DIR__.'/../../packages/todoist/src/Tools/Todoist*.php') ?: [];
        $provider = new TodoistToolProvider;

        self::assertCount(count($toolFiles), $provider->tools());
    }

    public function test_official_v1_endpoint_mappings_for_exposed_tools(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new TodoistService('token');
        $service->createProject(['name' => 'Demo']);
        $service->updateProject('project-1', ['name' => 'Renamed']);
        $service->deleteProject('project-1');
        $service->listSections('project-1');
        $service->getSection('section-1');
        $service->createSection(['name' => 'Backlog', 'project_id' => 'project-1']);
        $service->deleteSection('section-1');
        $service->updateTask('task-1', ['content' => 'Updated']);
        $service->deleteTask('task-1');
        $service->closeTask('task-1');
        $service->reopenTask('task-1');
        $service->quickAdd('Buy milk tomorrow', note: 'Organic');
        $service->listComments(taskId: 'task-1');
        $service->createComment(['task_id' => 'task-1', 'content' => 'Note']);

        $expected = [
            ['POST', 'https://api.todoist.com/api/v1/projects'],
            ['POST', 'https://api.todoist.com/api/v1/projects/project-1'],
            ['DELETE', 'https://api.todoist.com/api/v1/projects/project-1'],
            ['GET', 'https://api.todoist.com/api/v1/sections?project_id=project-1'],
            ['GET', 'https://api.todoist.com/api/v1/sections/section-1'],
            ['POST', 'https://api.todoist.com/api/v1/sections'],
            ['DELETE', 'https://api.todoist.com/api/v1/sections/section-1'],
            ['POST', 'https://api.todoist.com/api/v1/tasks/task-1'],
            ['DELETE', 'https://api.todoist.com/api/v1/tasks/task-1'],
            ['POST', 'https://api.todoist.com/api/v1/tasks/task-1/close'],
            ['POST', 'https://api.todoist.com/api/v1/tasks/task-1/reopen'],
            ['POST', 'https://api.todoist.com/api/v1/tasks/quick'],
            ['GET', 'https://api.todoist.com/api/v1/comments?task_id=task-1'],
            ['POST', 'https://api.todoist.com/api/v1/comments'],
        ];

        foreach ($expected as [$method, $url]) {
            Http::assertSent(static fn (Request $request): bool => $request->method() === $method && $request->url() === $url);
        }
    }
}
