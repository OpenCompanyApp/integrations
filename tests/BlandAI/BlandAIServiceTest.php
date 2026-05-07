<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\BlandAI;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\BlandAI\BlandAIService;
use OpenCompany\Integrations\BlandAI\BlandAIToolProvider;
use OpenCompany\Integrations\BlandAI\Tools\BlandAIAnalyzeCall;
use OpenCompany\Integrations\BlandAI\Tools\BlandAIMakeCall;
use OpenCompany\Integrations\BlandAI\Tools\BlandAIUpdateKnowledgeBase;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Bland AI documented v1/v2 API endpoint mappings.
 */
final class BlandAIServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_to_documented_v1_and_v2_paths_with_plain_authorization_header(): void
    {
        Http::fake([
            'https://api.bland.test/v1/calls*' => Http::response(['status' => 'success', 'calls' => []], 200),
            'https://api.bland.test/v1/calls/call_123' => Http::response(['call_id' => 'call_123'], 200),
            'https://api.bland.test/v1/calls/call_123/stop' => Http::response(['status' => 'success'], 200),
            'https://api.bland.test/v1/calls/active/stop' => Http::response(['status' => 'success', 'num_calls' => 2], 200),
            'https://api.bland.test/v1/calls/call_123/analyze' => Http::response(['answers' => [true]], 200),
            'https://api.bland.test/v2/batches' => Http::response(['batch_id' => 'batch_123'], 200),
            'https://api.bland.test/v2/batches/list*' => Http::response(['data' => []], 200),
            'https://api.bland.test/v1/voices' => Http::response(['voices' => []], 200),
            'https://api.bland.test/v1/voices/maya' => Http::response(['name' => 'maya'], 200),
            'https://api.bland.test/v1/knowledge*' => Http::response(['data' => ['kbs' => []]], 200),
            'https://api.bland.test/v1/knowledge/learn' => Http::response(['data' => ['id' => 'kb_123']], 200),
            'https://api.bland.test/v1/knowledge/kb_123' => Http::response(['data' => ['id' => 'kb_123']], 200),
            'https://api.bland.test/v1/knowledge/chat' => Http::response(['data' => ['answer' => 'Yes']], 200),
            'https://api.bland.test/v1/tools' => Http::response(['tool_id' => 'tool_123'], 200),
        ]);

        $service = new BlandAIService('key_test', 'https://api.bland.test/v1');
        $service->sendCall(['phone_number' => '+12223334444', 'task' => 'Confirm appointment']);
        $service->getCall('call_123');
        $service->listCalls(['limit' => 20, 'batch_id' => 'batch_123']);
        $service->stopCall('call_123');
        $service->stopAllActiveCalls();
        $service->analyzeCall('call_123', 'Check outcome', [['Confirmed?', 'boolean']]);
        $service->createBatch(['name' => 'Batch', 'phone_numbers' => [['phone_number' => '+12223334444']]]);
        $service->listBatches(['take' => 10, 'skip' => 5]);
        $service->listVoices();
        $service->getVoice('maya');
        $service->listKnowledgeBases(['limit' => 10]);
        $service->createTextKnowledgeBase('FAQ', 'Policy text', 'Support policies');
        $service->updateKnowledgeBase('kb_123', ['name' => 'Updated FAQ']);
        $service->chatKnowledgeBase('kb_123', [['role' => 'user', 'content' => 'Refund policy?']]);
        $service->createTool(['name' => 'lookup_order', 'url' => 'https://example.test/orders', 'method' => 'GET']);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('authorization', 'key_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.bland.test/v1/calls' && $request['task'] === 'Confirm appointment');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.bland.test/v1/calls/call_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.bland.test/v1/calls?') && str_contains($request->url(), 'batch_id=batch_123'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.bland.test/v1/calls/call_123/stop');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.bland.test/v1/calls/active/stop');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.bland.test/v1/calls/call_123/analyze' && $request['goal'] === 'Check outcome' && $request['questions'][0][1] === 'boolean');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.bland.test/v2/batches' && $request['name'] === 'Batch');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.bland.test/v2/batches/list?') && str_contains($request->url(), 'take=10'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.bland.test/v1/voices');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.bland.test/v1/voices/maya');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.bland.test/v1/knowledge?') && str_contains($request->url(), 'limit=10'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.bland.test/v1/knowledge/learn' && $request['type'] === 'text');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://api.bland.test/v1/knowledge/kb_123' && $request['name'] === 'Updated FAQ');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.bland.test/v1/knowledge/chat' && $request['knowledge_base_id'] === 'kb_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.bland.test/v1/tools' && $request['method'] === 'GET');
    }

    public function test_tools_map_agent_arguments_to_current_payloads(): void
    {
        Http::fake([
            'https://api.bland.test/v1/calls' => Http::response(['call_id' => 'call_123'], 200),
            'https://api.bland.test/v1/calls/call_123/analyze' => Http::response(['answers' => [true]], 200),
            'https://api.bland.test/v1/knowledge/kb_123' => Http::response(['data' => ['id' => 'kb_123']], 200),
        ]);

        $service = new BlandAIService('key_test', 'https://api.bland.test');
        self::assertNull((new BlandAIMakeCall($service))->execute([
            'phone_number' => '+12223334444',
            'pathway_id' => 'path_123',
            'request_data' => ['name' => 'Ada'],
            'record' => true,
        ])->error);
        self::assertNull((new BlandAIAnalyzeCall($service))->execute([
            'call_id' => 'call_123',
            'goal' => 'Check outcome',
            'questions' => [['Confirmed?', 'boolean']],
        ])->error);
        self::assertNull((new BlandAIUpdateKnowledgeBase($service))->execute([
            'knowledge_base_id' => 'kb_123',
            'description' => 'Updated',
        ])->error);

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.bland.test/v1/calls' && $request['pathway_id'] === 'path_123' && $request['request_data']['name'] === 'Ada');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.bland.test/v1/calls/call_123/analyze' && $request['questions'][0][0] === 'Confirmed?');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.bland.test/v1/knowledge/kb_123' && $request['description'] === 'Updated');
    }

    public function test_provider_exposes_expanded_surface_and_allowed_category(): void
    {
        $provider = new BlandAIToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://docs.bland.ai/', $provider->integrationMeta()['docs_url']);
        self::assertSame('https://api.bland.ai', $provider->credentialFields()[1]['default']);
        self::assertArrayHasKey('blandai_stop_call', $tools);
        self::assertArrayHasKey('blandai_create_batch', $tools);
        self::assertArrayHasKey('blandai_list_voices', $tools);
        self::assertArrayHasKey('blandai_list_knowledge_bases', $tools);
        self::assertArrayHasKey('blandai_create_tool', $tools);
        self::assertSame(16, count($tools));
    }
}
