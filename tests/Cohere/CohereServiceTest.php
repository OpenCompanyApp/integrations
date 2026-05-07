<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Cohere;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Cohere\CohereService;
use OpenCompany\Integrations\Cohere\CohereToolProvider;
use OpenCompany\Integrations\Cohere\Tools\CohereChat;
use OpenCompany\Integrations\Cohere\Tools\CohereEmbed;
use OpenCompany\Integrations\Cohere\Tools\CohereRerank;
use PHPUnit\Framework\TestCase;

final class CohereServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_provider_exposes_every_tool_file_and_docs(): void
    {
        $provider = new CohereToolProvider;

        foreach ($provider->tools() as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], '\\') + 1);
            self::assertFileExists(__DIR__ . '/../../packages/cohere/src/Tools/' . $shortName . '.php');
        }

        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertSame('Cohere', $provider->integrationMeta()['name']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertTrue($provider->integrationCapabilities()['host_availability']['cli']['runtime_supported']);
        self::assertArrayHasKey('cohere_create_audio_transcription', $provider->tools());
        self::assertArrayHasKey('cohere_classify', $provider->tools());
    }

    public function test_official_json_endpoint_mappings_and_client_header(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new CohereService('co-test', clientName: 'opencompany-test');
        $service->chat(['model' => 'command-a-03-2025', 'messages' => [['role' => 'user', 'content' => 'Hi']], 'stream' => false]);
        $service->embed(['model' => 'embed-v4.0', 'input_type' => 'search_document', 'texts' => ['Hello']]);
        $service->rerank(['model' => 'rerank-v4.0-pro', 'query' => 'capital', 'documents' => ['A']]);
        $service->tokenize(['text' => 'hello', 'model' => 'command-a-03-2025']);
        $service->detokenize(['tokens' => [1, 2], 'model' => 'command-a-03-2025']);
        $service->listModels(['page_size' => 1]);
        $service->getModel('command-a-03-2025');
        $service->classify(['inputs' => ['hello'], 'examples' => [['text' => 'hello', 'label' => 'Greeting']]]);
        $service->createEmbedJob(['model' => 'embed-english-v3.0', 'dataset_id' => 'dataset-1', 'input_type' => 'search_document']);
        $service->listEmbedJobs();
        $service->getEmbedJob('job-1');
        $service->cancelEmbedJob('job-1');
        $service->listDatasets(['datasetType' => 'embed-input']);
        $service->getDataset('dataset-1');
        $service->getDatasetUsage();
        $service->deleteDataset('dataset-1');

        $expected = [
            ['POST', 'https://api.cohere.com/v2/chat'],
            ['POST', 'https://api.cohere.com/v2/embed'],
            ['POST', 'https://api.cohere.com/v2/rerank'],
            ['POST', 'https://api.cohere.com/v1/tokenize'],
            ['POST', 'https://api.cohere.com/v1/detokenize'],
            ['GET', 'https://api.cohere.com/v1/models?page_size=1'],
            ['GET', 'https://api.cohere.com/v1/models/command-a-03-2025'],
            ['POST', 'https://api.cohere.com/v1/classify'],
            ['POST', 'https://api.cohere.com/v1/embed-jobs'],
            ['GET', 'https://api.cohere.com/v1/embed-jobs'],
            ['GET', 'https://api.cohere.com/v1/embed-jobs/job-1'],
            ['POST', 'https://api.cohere.com/v1/embed-jobs/job-1/cancel'],
            ['GET', 'https://api.cohere.com/v1/datasets?datasetType=embed-input'],
            ['GET', 'https://api.cohere.com/v1/datasets/dataset-1'],
            ['GET', 'https://api.cohere.com/v1/datasets/usage'],
            ['DELETE', 'https://api.cohere.com/v1/datasets/dataset-1'],
        ];

        foreach ($expected as [$method, $url]) {
            Http::assertSent(static fn (Request $request): bool => $request->method() === $method
                && $request->url() === $url
                && $request->hasHeader('Authorization', 'Bearer co-test')
                && $request->hasHeader('X-Client-Name', 'opencompany-test'));
        }
    }

    public function test_multipart_endpoint_mappings(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new CohereService('co-test');
        $service->createDataset('docs.jsonl', '{"text":"hello"}' . "\n", [
            'name' => 'docs',
            'type' => 'embed-input',
            'keep_original_file' => true,
        ]);
        $service->createAudioTranscription('sample.wav', 'audio-bytes', 'cohere-transcribe-03-2026', 'en', 0.2);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.cohere.com/v1/datasets?name=docs&type=embed-input&keep_original_file=1'
            && $request->hasHeader('Authorization', 'Bearer co-test'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.cohere.com/v2/audio/transcriptions'
            && $request->hasHeader('Authorization', 'Bearer co-test'));
    }

    public function test_chat_tool_filters_payload_and_rejects_streaming(): void
    {
        Http::fake([
            'https://api.cohere.com/v2/chat' => Http::response([
                'id' => 'chat-1',
                'finish_reason' => 'COMPLETE',
            ], 200),
        ]);

        $tool = new CohereChat(new CohereService('co-test'));
        $result = $tool->execute([
            'model' => 'command-a-03-2025',
            'messages' => [['role' => 'user', 'content' => 'Hello']],
            'safety_mode' => 'STRICT',
            'max_tokens' => 50,
            'unknown' => 'ignored',
        ]);

        self::assertTrue($result->succeeded());
        Http::assertSent(static function (Request $request): bool {
            return $request->url() === 'https://api.cohere.com/v2/chat'
                && $request->data()['model'] === 'command-a-03-2025'
                && $request->data()['stream'] === false
                && $request->data()['safety_mode'] === 'STRICT'
                && !array_key_exists('unknown', $request->data());
        });

        $streaming = $tool->execute([
            'model' => 'command-a-03-2025',
            'messages' => [['role' => 'user', 'content' => 'Hello']],
            'stream' => true,
        ]);

        self::assertFalse($streaming->succeeded());
        self::assertStringContainsString('stream=true is not supported', (string) $streaming->error);
    }

    public function test_embed_and_rerank_tools_validate_required_payload_shape(): void
    {
        Http::fake([
            'https://api.cohere.com/v2/embed' => Http::response(['embeddings' => []], 200),
            'https://api.cohere.com/v2/rerank' => Http::response(['results' => []], 200),
        ]);

        $embed = new CohereEmbed(new CohereService('co-test'));
        $missingInput = $embed->execute([
            'model' => 'embed-v4.0',
            'input_type' => 'search_document',
        ]);
        self::assertFalse($missingInput->succeeded());
        self::assertStringContainsString('Provide at least one', (string) $missingInput->error);

        $embedResult = $embed->execute([
            'model' => 'embed-v4.0',
            'input_type' => 'search_document',
            'texts' => ['Billing docs'],
            'truncate' => 'END',
        ]);
        self::assertTrue($embedResult->succeeded());

        $rerank = new CohereRerank(new CohereService('co-test'));
        $rerankResult = $rerank->execute([
            'model' => 'rerank-v4.0-pro',
            'query' => 'billing',
            'documents' => ['Billing docs', 'API docs'],
            'top_n' => 1,
        ]);
        self::assertTrue($rerankResult->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.cohere.com/v2/embed'
            && $request->data()['input_type'] === 'search_document');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.cohere.com/v2/rerank'
            && $request->data()['documents'] === ['Billing docs', 'API docs']);
    }
}
