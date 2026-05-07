<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Bubble;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Bubble\BubbleService;
use OpenCompany\Integrations\Bubble\BubbleToolProvider;
use OpenCompany\Integrations\Bubble\Tools\BubbleListRecords;
use OpenCompany\Integrations\Bubble\Tools\BubbleReplaceRecord;
use OpenCompany\Integrations\Bubble\Tools\BubbleTriggerWorkflow;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Bubble Data API and Workflow API endpoint mappings.
 */
final class BubbleServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_to_documented_api_root_data_api_workflow_api_and_swagger(): void
    {
        Http::fake([
            'https://app.example.test/api/1.1/meta' => Http::response(['swagger' => '2.0'], 200),
            'https://app.example.test/api/1.1/obj/User*' => Http::response(['response' => ['results' => []], 'remaining' => 0], 200),
            'https://app.example.test/api/1.1/obj/User/1704982345123x456789' => Http::response(['response' => ['_id' => '1704982345123x456789']], 200),
            'https://app.example.test/api/1.1/wf/sync_order' => Http::response(['status' => 'ok'], 200),
            'https://app.example.test/api/1.1/wf/sync_order/initialize' => Http::response(['status' => 'initialized'], 200),
            'https://app.example.test/api/1.1/wf/status_check*' => Http::response(['status' => 'ok'], 200),
        ]);

        $service = new BubbleService('key_test', 'https://app.example.test/api/1.1');
        $service->getSwagger();
        $service->listRecords('User', [['key' => 'email', 'constraint_type' => 'contains', 'value' => '@example.test']], 50, 10, 'Created Date', true);
        $service->getRecord('User', '1704982345123x456789');
        $service->createRecord('User', ['email' => 'reader@example.test']);
        $service->updateRecord('User', '1704982345123x456789', ['role' => 'admin']);
        $service->replaceRecord('User', '1704982345123x456789', ['email' => 'reader@example.test']);
        $service->deleteRecord('User', '1704982345123x456789');
        $service->triggerWorkflow('sync_order', ['order_id' => 'ord_123']);
        $service->triggerWorkflow('sync_order', ['order_id' => 'ord_123'], true);
        $service->triggerWorkflowGet('status_check', ['order_id' => 'ord_123']);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer key_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://app.example.test/api/1.1/meta');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://app.example.test/api/1.1/obj/User?')
            && $request->data()['limit'] === 50
            && $request->data()['sort_field'] === 'Created Date');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://app.example.test/api/1.1/obj/User' && $request['email'] === 'reader@example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://app.example.test/api/1.1/obj/User/1704982345123x456789' && $request['role'] === 'admin');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://app.example.test/api/1.1/obj/User/1704982345123x456789' && $request['email'] === 'reader@example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://app.example.test/api/1.1/obj/User/1704982345123x456789');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://app.example.test/api/1.1/wf/sync_order' && $request['order_id'] === 'ord_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://app.example.test/api/1.1/wf/sync_order/initialize');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://app.example.test/api/1.1/wf/status_check?') && str_contains($request->url(), 'order_id=ord_123'));
    }

    public function test_tools_map_agent_arguments_to_data_and_workflow_payloads(): void
    {
        Http::fake([
            'https://app.example.test/version-test/api/1.1/obj/User*' => Http::response(['response' => ['results' => []]], 200),
            'https://app.example.test/version-test/api/1.1/obj/User/record_123' => Http::response(['response' => ['_id' => 'record_123']], 200),
            'https://app.example.test/version-test/api/1.1/wf/sync_order' => Http::response(['status' => 'ok'], 200),
        ]);

        $service = new BubbleService('key_test', 'https://app.example.test', '/version-test/api/1.1');
        self::assertNull((new BubbleListRecords($service))->execute([
            'type' => 'User',
            'constraints' => [['key' => 'email', 'constraint_type' => 'contains', 'value' => '@example.test']],
            'sort_field' => 'Created Date',
            'descending' => true,
        ])->error);
        self::assertNull((new BubbleReplaceRecord($service))->execute([
            'type' => 'User',
            'id' => 'record_123',
            'fields' => ['email' => 'reader@example.test'],
        ])->error);
        self::assertNull((new BubbleTriggerWorkflow($service))->execute([
            'workflow' => 'sync_order',
            'payload' => ['order_id' => 'ord_123'],
        ])->error);

        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://app.example.test/version-test/api/1.1/obj/User?') && str_contains($request->url(), 'descending=1'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://app.example.test/version-test/api/1.1/obj/User/record_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://app.example.test/version-test/api/1.1/wf/sync_order' && $request['order_id'] === 'ord_123');
    }

    public function test_provider_exposes_workflow_surface_and_allowed_category(): void
    {
        $provider = new BubbleToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://manual.bubble.io/core-resources/api', $provider->integrationMeta()['docs_url']);
        self::assertArrayHasKey('bubble_get_swagger', $tools);
        self::assertArrayHasKey('bubble_replace_record', $tools);
        self::assertArrayHasKey('bubble_trigger_workflow', $tools);
        self::assertArrayHasKey('bubble_trigger_workflow_get', $tools);
        self::assertSame(9, count($tools));
    }
}
