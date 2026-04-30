<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\ClickUp;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\ClickUp\ClickUpService;
use OpenCompany\Integrations\ClickUp\ClickUpToolProvider;
use OpenCompany\Integrations\ClickUp\Tools\ClickUpUpdateTask;
use PHPUnit\Framework\TestCase;

final class ClickUpServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_provider_registers_every_tool_file(): void
    {
        $toolFiles = glob(__DIR__.'/../../packages/clickup/src/Tools/ClickUp*.php') ?: [];
        $provider = new ClickUpToolProvider;

        self::assertCount(count($toolFiles), $provider->tools());
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertSame('required|string', $provider->validationRules()['api_token']);
    }

    public function test_custom_task_id_query_params_are_not_embedded_in_path(): void
    {
        Http::fake([
            'https://api.clickup.com/api/v2/task/DEV-42*' => Http::response([
                'id' => 'task-1',
                'name' => 'Fix bug',
                'status' => ['status' => 'open'],
            ], 200),
        ]);

        $tool = new ClickUpUpdateTask(new ClickUpService('token', '123456'));
        $result = $tool->execute([
            'task_id' => 'DEV-42',
            'status' => 'in progress',
        ]);

        self::assertTrue($result->succeeded());
        Http::assertSent(static function (Request $request): bool {
            return $request->method() === 'PUT'
                && $request->url() === 'https://api.clickup.com/api/v2/task/DEV-42?custom_task_ids=true&team_id=123456'
                && $request->data() === ['status' => 'in progress'];
        });
    }

    public function test_custom_task_id_detector_accepts_non_uppercase_prefixes(): void
    {
        $service = new ClickUpService('token', '123456');

        self::assertTrue($service->isCustomTaskId('Dev-42'));
        self::assertTrue($service->isCustomTaskId('OPS-WEB-17'));
        self::assertFalse($service->isCustomTaskId('86a75dcd'));
        self::assertFalse($service->isCustomTaskId('123456'));
    }

    public function test_missing_official_endpoint_mappings_are_covered_in_service(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new ClickUpService('token', '123456');
        $service->getAuthorizedUser();
        $service->getCustomFields('list', 'list-1');
        $service->setCustomFieldValue('task-1', 'field-1', ['value' => 'High']);
        $service->createChecklist('task-1', ['name' => 'QA']);
        $service->createChecklistItem('checklist-1', ['name' => 'Run tests']);
        $service->deleteList('list-1');
        $service->deleteFolder('folder-1');
        $service->getSpace('space-1');
        $service->getSharedHierarchy('123456');
        $service->updateWebhook('webhook-1', ['events' => ['taskCreated']]);
        $service->getTimeEntries('123456', ['start_date' => '1', 'end_date' => '2']);
        $service->getTimeEntryHistory('123456', 'timer-1');
        $service->searchDocuments('123456', ['limit' => 10]);
        $service->getDocument('123456', 'doc-1');
        $service->getDocumentPageListing('123456', 'doc-1');
        $service->getDocumentPage('123456', 'doc-1', 'page-1');
        $service->getChatChannelMessages('123456', 'channel-1');
        $service->createChatMessageReply('123456', 'message-1', ['content' => 'Reply']);
        $service->createChatMessageReaction('123456', 'message-1', ['reaction' => 'thumbs_up']);

        $expected = [
            ['GET', 'https://api.clickup.com/api/v2/user'],
            ['GET', 'https://api.clickup.com/api/v2/list/list-1/field'],
            ['POST', 'https://api.clickup.com/api/v2/task/task-1/field/field-1'],
            ['POST', 'https://api.clickup.com/api/v2/task/task-1/checklist'],
            ['POST', 'https://api.clickup.com/api/v2/checklist/checklist-1/checklist_item'],
            ['DELETE', 'https://api.clickup.com/api/v2/list/list-1'],
            ['DELETE', 'https://api.clickup.com/api/v2/folder/folder-1'],
            ['GET', 'https://api.clickup.com/api/v2/space/space-1'],
            ['GET', 'https://api.clickup.com/api/v2/team/123456/shared'],
            ['PUT', 'https://api.clickup.com/api/v2/webhook/webhook-1'],
            ['GET', 'https://api.clickup.com/api/v2/team/123456/time_entries?start_date=1&end_date=2'],
            ['GET', 'https://api.clickup.com/api/v2/team/123456/time_entries/timer-1/history'],
            ['GET', 'https://api.clickup.com/api/v3/workspaces/123456/docs?limit=10'],
            ['GET', 'https://api.clickup.com/api/v3/workspaces/123456/docs/doc-1'],
            ['GET', 'https://api.clickup.com/api/v3/workspaces/123456/docs/doc-1/page_listing'],
            ['GET', 'https://api.clickup.com/api/v3/workspaces/123456/docs/doc-1/pages/page-1'],
            ['GET', 'https://api.clickup.com/api/v3/workspaces/123456/chat/channels/channel-1/messages'],
            ['POST', 'https://api.clickup.com/api/v3/workspaces/123456/chat/messages/message-1/replies'],
            ['POST', 'https://api.clickup.com/api/v3/workspaces/123456/chat/messages/message-1/reactions'],
        ];

        foreach ($expected as [$method, $url]) {
            Http::assertSent(static fn (Request $request): bool => $request->method() === $method && $request->url() === $url);
        }
    }
}
