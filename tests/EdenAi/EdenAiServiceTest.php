<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\EdenAi;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\EdenAi\EdenAiService;
use OpenCompany\Integrations\EdenAi\EdenAiToolProvider;
use OpenCompany\Integrations\EdenAi\Tools\EdenAiChatCompletions;
use OpenCompany\Integrations\EdenAi\Tools\EdenAiUniversalAi;
use OpenCompany\Integrations\EdenAi\Tools\EdenAiV3ApiGet;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Eden AI V3 and legacy V2 coverage.
 */
final class EdenAiServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_v3_and_legacy_helpers(): void
    {
        Http::fake([
            'https://api.edenai.run/v2/*' => Http::response(['ok' => true], 200),
            'https://api.edenai.run/v3/*' => Http::response(['ok' => true, 'object' => 'list'], 200),
        ]);

        $service = new EdenAiService('eden_test');

        $service->generateText(['providers' => 'openai', 'text' => 'Hello']);
        $service->chatCompletions([
            'model' => 'openai/gpt-4o',
            'messages' => [['role' => 'user', 'content' => 'Hello']],
        ]);
        $service->listModels();
        $service->universalAi(['model' => 'text/moderation/openai', 'input' => ['text' => 'Hello']]);
        $service->universalAiAsync(['model' => 'ocr/ocr_async/amazon', 'input' => ['file' => 'https://example.test/doc.pdf']]);
        $service->getUniversalAiJob('job_123');
        $service->listFeatures();
        $service->getFeatureInfo('text/moderation');
        $service->deleteAllUploadedFiles();
        $service->apiGet('/user');
        $service->apiPost('/text/sentiment_analysis', ['providers' => 'openai', 'text' => 'Hello']);
        $service->v3ApiGet('/models');
        $service->v3ApiPost('/universal-ai', ['model' => 'text/moderation/openai', 'input' => ['text' => 'Hello']]);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer eden_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.edenai.run/v3/chat/completions');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.edenai.run/v3/models');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.edenai.run/v3/universal-ai');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.edenai.run/v3/universal-ai/async');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.edenai.run/v3/universal-ai/async/job_123');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.edenai.run/v3/info/text/moderation');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.edenai.run/v2/text/generation');
    }

    public function test_new_tools_delegate_and_validate_required_arguments(): void
    {
        Http::fake([
            'https://api.edenai.run/v3/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new EdenAiService('eden_test');

        self::assertTrue((new EdenAiChatCompletions($service))->execute([
            'model' => 'openai/gpt-4o',
            'messages' => [['role' => 'user', 'content' => 'Hello']],
        ])->succeeded());
        self::assertTrue((new EdenAiUniversalAi($service))->execute([
            'model' => 'text/moderation/openai',
            'input' => ['text' => 'Hello'],
        ])->succeeded());
        self::assertTrue((new EdenAiV3ApiGet($service))->execute([
            'path' => '/models',
        ])->succeeded());
        self::assertFalse((new EdenAiChatCompletions($service))->execute([
            'model' => 'openai/gpt-4o',
            'messages' => [],
        ])->succeeded());
    }

    public function test_provider_exposes_expanded_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://api.edenai.run/v3/models' => Http::response(['object' => 'list', 'data' => []], 200),
        ]);

        $provider = new EdenAiToolProvider();
        $tools = $provider->tools();

        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertArrayHasKey('edenai_chat_completions', $tools);
        self::assertArrayHasKey('edenai_universal_ai', $tools);
        self::assertArrayHasKey('edenai_universal_ai_async', $tools);
        self::assertArrayHasKey('edenai_upload_file', $tools);
        self::assertArrayHasKey('edenai_v3_api_post', $tools);
        self::assertSame(19, count($tools));
        self::assertTrue($provider->testConnection([
            'api_key' => 'eden_test',
        ])['success']);
    }
}
