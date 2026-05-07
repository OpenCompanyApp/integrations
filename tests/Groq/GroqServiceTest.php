<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Groq;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Groq\GroqService;
use OpenCompany\Integrations\Groq\GroqToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Groq endpoint coverage and metadata.
 */
final class GroqServiceTest extends TestCase
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

    public function test_official_openai_compatible_endpoints_are_mapped(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new GroqService('groq-token', 'https://groq.example.test/openai/v1');

        $service->getModel('llama-3.3-70b-versatile');
        $service->createResponse(['model' => 'openai/gpt-oss-20b', 'input' => 'Hello']);
        $service->createTranscription(['model' => 'whisper-large-v3', 'url' => 'https://example.test/audio.wav']);
        $service->createTranslation(['model' => 'whisper-large-v3', 'url' => 'https://example.test/audio.wav']);
        $service->createSpeech(['model' => 'playai-tts', 'voice' => 'Fritz-PlayAI', 'input' => 'Hello']);
        $service->createBatch(['input_file_id' => 'file_123', 'endpoint' => '/v1/chat/completions', 'completion_window' => '24h']);
        $service->getBatch('batch_123');
        $service->listBatches(['limit' => 10]);
        $service->cancelBatch('batch_123');
        $service->downloadFile('file_123');
        $service->deleteFile('file_123');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://groq.example.test/openai/v1/models/llama-3.3-70b-versatile');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://groq.example.test/openai/v1/responses'
            && $request->hasHeader('Authorization', 'Bearer groq-token'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://groq.example.test/openai/v1/audio/transcriptions'
            && $request['model'] === 'whisper-large-v3');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://groq.example.test/openai/v1/audio/translations');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://groq.example.test/openai/v1/audio/speech');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://groq.example.test/openai/v1/batches'
            && $request['completion_window'] === '24h');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://groq.example.test/openai/v1/batches/batch_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://groq.example.test/openai/v1/batches?limit=10');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://groq.example.test/openai/v1/batches/batch_123/cancel');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://groq.example.test/openai/v1/files/file_123/content');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://groq.example.test/openai/v1/files/file_123');
    }

    public function test_fine_tuning_uses_platform_api_base_url(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new GroqService('groq-token', 'https://groq.example.test/openai/v1');

        $service->listFineTunings();
        $service->createFineTuning(['input_file_id' => 'file_123', 'name' => 'test-1']);
        $service->getFineTuning('ft_123');
        $service->deleteFineTuning('ft_123');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://groq.example.test/v1/fine_tunings');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://groq.example.test/v1/fine_tunings'
            && $request['input_file_id'] === 'file_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://groq.example.test/v1/fine_tunings/ft_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://groq.example.test/v1/fine_tunings/ft_123');
    }

    public function test_provider_registers_documented_tools_only(): void
    {
        $provider = new GroqToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertGreaterThanOrEqual(20, count($tools));
        self::assertArrayHasKey('groq_create_response', $tools);
        self::assertArrayHasKey('groq_create_transcription', $tools);
        self::assertArrayHasKey('groq_create_batch', $tools);
        self::assertArrayHasKey('groq_download_file', $tools);
        self::assertArrayHasKey('groq_create_fine_tuning', $tools);
        self::assertArrayNotHasKey('groq_list_messages', $tools);
        self::assertArrayNotHasKey('groq_get_current_user', $tools);

        $names = [];
        foreach ($tools as $tool) {
            $instance = new $tool['class'](new GroqService('groq-token'));
            $names[] = $instance->name();
        }

        self::assertCount(count($names), array_unique($names));
    }
}
