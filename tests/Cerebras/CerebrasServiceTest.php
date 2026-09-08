<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Cerebras;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Cerebras\CerebrasService;
use OpenCompany\Integrations\Cerebras\CerebrasToolProvider;
use OpenCompany\Integrations\Cerebras\Tools\CerebrasChatCompletions;
use OpenCompany\Integrations\Cerebras\Tools\CerebrasRetrieveModel;
use OpenCompany\Integrations\Cerebras\Tools\CerebrasUploadFile;
use PHPUnit\Framework\TestCase;

final class CerebrasServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_provider_exposes_every_tool_file_and_docs(): void
    {
        $provider = new CerebrasToolProvider;

        foreach ($provider->tools() as $class) {
            $shortName = substr((string) $class, strrpos((string) $class, '\\') + 1);
            self::assertFileExists(__DIR__ . '/../../packages/cerebras/src/Tools/' . $shortName . '.php');
        }

        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertSame('Cerebras', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertTrue($provider->integrationCapabilities()['host_availability']['cli']['runtime_supported']);
        self::assertCount(25, $provider->tools());
        self::assertArrayHasKey('cerebras_chat_completions', $provider->tools());
        self::assertArrayHasKey('cerebras_deploy_model_to_endpoint', $provider->tools());
    }

    public function test_endpoint_mappings_and_bearer_auth(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new CerebrasService('cb-test');
        $service->request('GET', '/v1/models');
        $service->request('POST', '/v1/chat/completions', [], ['model' => 'gpt-oss-120b', 'messages' => []]);
        $service->request('GET', '/public/v1/models/llama3.1-8b');
        $service->request('DELETE', '/v1/batches/batch-1');
        $service->request('GET', 'https://cloud.cerebras.ai/api/v1/metrics/organizations/org-1');
        $service->request('POST', '/management/v1/endpoints/endpoint-1:deployModel', [], ['model_version' => 'v1']);

        $expected = [
            ['GET', 'https://api.cerebras.ai/v1/models'],
            ['POST', 'https://api.cerebras.ai/v1/chat/completions'],
            ['GET', 'https://api.cerebras.ai/public/v1/models/llama3.1-8b'],
            ['DELETE', 'https://api.cerebras.ai/v1/batches/batch-1'],
            ['GET', 'https://cloud.cerebras.ai/api/v1/metrics/organizations/org-1'],
            ['POST', 'https://api.cerebras.ai/management/v1/endpoints/endpoint-1:deployModel'],
        ];

        foreach ($expected as [$method, $url]) {
            Http::assertSent(static fn (Request $request): bool => $request->method() === $method
                && $request->url() === $url
                && $request->hasHeader('Authorization', 'Bearer cb-test'));
        }
    }

    public function test_tools_validate_required_ids_bodies_and_upload_paths(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $chat = new CerebrasChatCompletions(new CerebrasService('cb-test'));
        $chatResult = $chat->execute(['body' => ['model' => 'gpt-oss-120b', 'messages' => []]]);
        self::assertTrue($chatResult->succeeded());

        $missingBody = $chat->execute([]);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be', (string) $missingBody->error);

        $missingId = (new CerebrasRetrieveModel(new CerebrasService('cb-test')))->execute([]);
        self::assertFalse($missingId->succeeded());
        self::assertStringContainsString('model_id must be', (string) $missingId->error);

        $badUpload = (new CerebrasUploadFile(new CerebrasService('cb-test')))->execute(['body' => ['purpose' => 'batch']]);
        self::assertFalse($badUpload->succeeded());
        self::assertStringContainsString('file_path must be', (string) $badUpload->error);
    }
}
