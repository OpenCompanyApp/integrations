<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\AssemblyAI;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\AssemblyAI\AssemblyAIService;
use OpenCompany\Integrations\AssemblyAI\AssemblyAIToolProvider;
use OpenCompany\Integrations\AssemblyAI\Tools\AssemblyAILlmGatewayChat;
use OpenCompany\Integrations\AssemblyAI\Tools\AssemblyAITranscribe;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for AssemblyAI endpoint mappings and catalog metadata.
 */
final class AssemblyAIServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_transcript_endpoints_use_documented_singular_paths(): void
    {
        Http::fake([
            'https://api.assemblyai.test/v2/transcript' => Http::response(['id' => 'transcript-test'], 200),
            'https://api.assemblyai.test/v2/transcript?*' => Http::response(['transcripts' => []], 200),
            'https://api.assemblyai.test/v2/transcript/transcript-test' => Http::sequence()
                ->push(['id' => 'transcript-test', 'status' => 'completed'], 200)
                ->push(['id' => 'transcript-test', 'text' => 'Deleted by user.'], 200),
            'https://api.assemblyai.test/v2/transcript/transcript-test/paragraphs' => Http::response(['paragraphs' => []], 200),
            'https://api.assemblyai.test/v2/transcript/transcript-test/sentences' => Http::response(['sentences' => []], 200),
            'https://api.assemblyai.test/v2/transcript/transcript-test/redacted-audio' => Http::response(['redacted_audio_url' => 'https://example.test/redacted.mp3'], 200),
            'https://api.assemblyai.test/v2/transcript/transcript-test/vtt*' => Http::response("WEBVTT\n", 200),
        ]);

        $service = new AssemblyAIService('key-test', 'https://api.assemblyai.test/v2');
        $service->transcribe(['audio_url' => 'https://example.test/audio.mp3']);
        $service->listTranscripts(['limit' => 2]);
        $service->getTranscript('transcript-test');
        $service->deleteTranscript('transcript-test');
        $service->getParagraphs('transcript-test');
        $service->getSentences('transcript-test');
        $service->getRedactedAudio('transcript-test');
        $subtitles = $service->getSubtitles('transcript-test', 'vtt', ['chars_per_caption' => 40]);

        self::assertSame('vtt', $subtitles['format']);
        self::assertSame("WEBVTT\n", $subtitles['content']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.assemblyai.test/v2/transcript' && $request->hasHeader('Authorization', 'key-test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.assemblyai.test/v2/transcript?') && $request->data()['limit'] === 2);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.assemblyai.test/v2/transcript/transcript-test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.assemblyai.test/v2/transcript/transcript-test');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.assemblyai.test/v2/transcript/transcript-test/paragraphs');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.assemblyai.test/v2/transcript/transcript-test/sentences');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.assemblyai.test/v2/transcript/transcript-test/redacted-audio');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.assemblyai.test/v2/transcript/transcript-test/vtt'));
    }

    public function test_streaming_token_and_llm_gateway_use_their_own_hosts(): void
    {
        Http::fake([
            'https://streaming.assemblyai.test/v3/token*' => Http::response(['token' => 'token-test'], 200),
            'https://llm-gateway.assemblyai.test/v1/chat/completions' => Http::response(['choices' => []], 200),
        ]);

        $service = new AssemblyAIService(
            apiKey: 'key-test',
            baseUrl: 'https://api.assemblyai.test/v2',
            streamingBaseUrl: 'https://streaming.assemblyai.test',
            llmGatewayBaseUrl: 'https://llm-gateway.assemblyai.test/v1',
        );
        $service->createStreamingToken(60, 3600);
        $service->chatCompletion([
            'model' => 'claude-sonnet-4-5-20250929',
            'prompt' => 'Summarize this.',
        ]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://streaming.assemblyai.test/v3/token') && $request->data()['expires_in_seconds'] === 60);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://llm-gateway.assemblyai.test/v1/chat/completions' && $request->data()['model'] === 'claude-sonnet-4-5-20250929');
    }

    public function test_tools_and_provider_expose_current_surface_without_generated_account_tools(): void
    {
        Http::fake([
            'https://api.assemblyai.test/v2/transcript' => Http::response(['id' => 'transcript-test', 'status' => 'queued'], 200),
            'https://llm-gateway.assemblyai.com/v1/chat/completions' => Http::response(['choices' => []], 200),
        ]);

        $service = new AssemblyAIService('key-test', 'https://api.assemblyai.test/v2');
        $transcribe = (new AssemblyAITranscribe($service))->execute([
            'audio_url' => 'https://example.test/audio.mp3',
            'speech_models' => ['universal-3-pro', 'universal-2'],
            'keyterms_prompt' => ['OpenCompany'],
        ]);
        $chat = (new AssemblyAILlmGatewayChat($service))->execute([
            'model' => 'claude-sonnet-4-5-20250929',
            'prompt' => 'Hello',
        ]);

        self::assertNull($transcribe->error);
        self::assertNull($chat->error);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.assemblyai.test/v2/transcript' && $request->data()['speech_models'] === ['universal-3-pro', 'universal-2']);

        $provider = new AssemblyAIToolProvider();
        $tools = $provider->tools();
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertArrayNotHasKey('assemblyai_get_current_user', $tools);
        self::assertArrayNotHasKey('assemblyai_get_lemons', $tools);
        self::assertArrayHasKey('assemblyai_create_streaming_token', $tools);
        self::assertArrayHasKey('assemblyai_llm_gateway_chat', $tools);
        self::assertSame(11, count($tools));
    }
}
