<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\VoyageAi;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\VoyageAi\Tools\VoyageAiCreateBatch;
use OpenCompany\Integrations\VoyageAi\Tools\VoyageAiCreateEmbedding;
use OpenCompany\Integrations\VoyageAi\VoyageAiService;
use OpenCompany\Integrations\VoyageAi\VoyageAiToolProvider;
use PHPUnit\Framework\TestCase;

final class VoyageAiServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_provider_exposes_every_tool_file_and_docs(): void
    {
        $provider = new VoyageAiToolProvider;

        foreach ($provider->tools() as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], '\\') + 1);
            self::assertFileExists(__DIR__ . '/../../packages/voyage-ai/src/Tools/' . $shortName . '.php');
        }

        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertSame('Voyage AI', $provider->integrationMeta()['name']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertTrue($provider->integrationCapabilities()['host_availability']['cli']['runtime_supported']);
    }

    public function test_official_endpoint_mappings_for_json_apis(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new VoyageAiService('voyage-key');
        $service->createEmbedding(['input' => 'hello', 'model' => 'voyage-4']);
        $service->createContextualizedEmbeddings(['inputs' => [['a', 'b']], 'model' => 'voyage-context-3']);
        $service->createMultimodalEmbeddings(['inputs' => [['content' => [['type' => 'text', 'text' => 'hello']]]], 'model' => 'voyage-multimodal-3.5']);
        $service->rerank(['query' => 'hello', 'documents' => ['a', 'b'], 'model' => 'rerank-2.5']);
        $service->listFiles(['purpose' => 'batch', 'limit' => 1, 'order' => 'desc']);
        $service->retrieveFile('file-1');
        $service->deleteFile('file-1');
        $service->bulkDeleteFiles(['file-1', 'file-2']);
        $service->createBatch(['endpoint' => 'v1/embeddings', 'input_file_id' => 'file-1', 'completion_window' => '12h', 'request_params' => ['model' => 'voyage-4']]);
        $service->listBatches(['limit' => 20]);
        $service->retrieveBatch('batch-1');
        $service->cancelBatch('batch-1');

        $expected = [
            ['POST', 'https://api.voyageai.com/v1/embeddings'],
            ['POST', 'https://api.voyageai.com/v1/contextualizedembeddings'],
            ['POST', 'https://api.voyageai.com/v1/multimodalembeddings'],
            ['POST', 'https://api.voyageai.com/v1/rerank'],
            ['GET', 'https://api.voyageai.com/v1/files?purpose=batch&limit=1&order=desc'],
            ['GET', 'https://api.voyageai.com/v1/files/file-1'],
            ['DELETE', 'https://api.voyageai.com/v1/files/file-1'],
            ['POST', 'https://api.voyageai.com/v1/files/delete'],
            ['POST', 'https://api.voyageai.com/v1/batches'],
            ['GET', 'https://api.voyageai.com/v1/batches?limit=20'],
            ['GET', 'https://api.voyageai.com/v1/batches/batch-1'],
            ['POST', 'https://api.voyageai.com/v1/batches/batch-1/cancel'],
        ];

        foreach ($expected as [$method, $url]) {
            Http::assertSent(static fn (Request $request): bool => $request->method() === $method
                && $request->url() === $url
                && $request->hasHeader('Authorization', 'Bearer voyage-key'));
        }
    }

    public function test_upload_file_uses_multipart_files_endpoint(): void
    {
        Http::fake(['*' => Http::response(['id' => 'file-1'], 200)]);

        $service = new VoyageAiService('voyage-key');
        $service->uploadFile('input.jsonl', "{\"custom_id\":\"1\"}\n");

        Http::assertSent(static function (Request $request): bool {
            $parts = $request->data();
            $hasPurpose = false;
            $hasFile = false;

            foreach ($parts as $part) {
                if (($part['name'] ?? null) === 'purpose' && ($part['contents'] ?? null) === 'batch') {
                    $hasPurpose = true;
                }

                if (($part['name'] ?? null) === 'file' && ($part['filename'] ?? null) === 'input.jsonl') {
                    $hasFile = true;
                }
            }

            return $request->method() === 'POST'
                && $request->url() === 'https://api.voyageai.com/v1/files'
                && $request->hasHeader('Authorization', 'Bearer voyage-key')
                && $hasPurpose
                && $hasFile;
        });
    }

    public function test_embedding_tool_filters_payload_and_validates_enums(): void
    {
        Http::fake([
            'https://api.voyageai.com/v1/embeddings' => Http::response(['data' => []], 200),
        ]);

        $tool = new VoyageAiCreateEmbedding(new VoyageAiService('voyage-key'));
        $result = $tool->execute([
            'input' => ['hello'],
            'model' => 'voyage-4',
            'input_type' => 'document',
            'output_dtype' => 'float',
            'unknown' => 'ignored',
        ]);

        self::assertTrue($result->succeeded());
        Http::assertSent(static function (Request $request): bool {
            return $request->url() === 'https://api.voyageai.com/v1/embeddings'
                && $request->data()['input'] === ['hello']
                && $request->data()['model'] === 'voyage-4'
                && $request->data()['input_type'] === 'document'
                && !array_key_exists('unknown', $request->data());
        });

        $invalid = $tool->execute([
            'input' => 'hello',
            'model' => 'voyage-4',
            'input_type' => 'passage',
        ]);

        self::assertFalse($invalid->succeeded());
        self::assertStringContainsString('input_type must be one of', (string) $invalid->error);
    }

    public function test_create_batch_rejects_unsupported_endpoint_and_window(): void
    {
        $tool = new VoyageAiCreateBatch(new VoyageAiService('voyage-key'));

        $badEndpoint = $tool->execute([
            'endpoint' => 'v1/chat',
            'input_file_id' => 'file-1',
            'completion_window' => '12h',
            'request_params' => ['model' => 'voyage-4'],
        ]);

        self::assertFalse($badEndpoint->succeeded());
        self::assertStringContainsString('endpoint must be one of', (string) $badEndpoint->error);

        $badWindow = $tool->execute([
            'endpoint' => 'v1/embeddings',
            'input_file_id' => 'file-1',
            'completion_window' => '24h',
            'request_params' => ['model' => 'voyage-4'],
        ]);

        self::assertFalse($badWindow->succeeded());
        self::assertStringContainsString('completion_window must be "12h"', (string) $badWindow->error);
    }
}
