<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\FireworksAi;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\FireworksAi\FireworksAiService;
use OpenCompany\Integrations\FireworksAi\FireworksAiToolProvider;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiCreateDataset;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiGetModel;
use OpenCompany\Integrations\FireworksAi\Tools\FireworksAiPostChatcompletions;
use PHPUnit\Framework\TestCase;

final class FireworksAiServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_provider_exposes_every_tool_file_and_docs(): void
    {
        $provider = new FireworksAiToolProvider;

        foreach ($provider->tools() as $class) {
            $shortName = substr((string) $class, strrpos((string) $class, '\\') + 1);
            self::assertFileExists(__DIR__ . '/../../packages/fireworks-ai/src/Tools/' . $shortName . '.php');
        }

        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertSame('Fireworks AI', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertTrue($provider->integrationCapabilities()['host_availability']['cli']['runtime_supported']);
        self::assertCount(103, $provider->tools());
        self::assertArrayHasKey('fireworks_ai_chat_completions', $provider->tools());
        self::assertArrayHasKey('fireworks_ai_create_embeddings', $provider->tools());
    }

    public function test_endpoint_mappings_and_bearer_auth(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new FireworksAiService('fw-test');
        $service->request('GET', '/v1/accounts');
        $service->request('POST', '/inference/v1/chat/completions', [], ['model' => 'accounts/fireworks/models/deepseek-v3p1', 'messages' => []]);
        $service->request('POST', '/inference/v1/embeddings', [], ['model' => 'nomic-ai/nomic-embed-text-v1.5', 'input' => ['hello']]);
        $service->request('GET', '/v1/accounts/account-1/models/model-1');
        $service->request('PATCH', '/v1/accounts/account-1/deployments/deployment-1:scale', [], ['replicaCount' => 0]);
        $service->request('DELETE', '/inference/v1/responses/response-1');

        $expected = [
            ['GET', 'https://api.fireworks.ai/v1/accounts'],
            ['POST', 'https://api.fireworks.ai/inference/v1/chat/completions'],
            ['POST', 'https://api.fireworks.ai/inference/v1/embeddings'],
            ['GET', 'https://api.fireworks.ai/v1/accounts/account-1/models/model-1'],
            ['PATCH', 'https://api.fireworks.ai/v1/accounts/account-1/deployments/deployment-1:scale'],
            ['DELETE', 'https://api.fireworks.ai/inference/v1/responses/response-1'],
        ];

        foreach ($expected as [$method, $url]) {
            Http::assertSent(static fn (Request $request): bool => $request->method() === $method
                && $request->url() === $url
                && $request->hasHeader('Authorization', 'Bearer fw-test'));
        }
    }

    public function test_tools_validate_required_ids_and_bodies(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $chat = new FireworksAiPostChatcompletions(new FireworksAiService('fw-test'));
        $chatResult = $chat->execute(['body' => ['model' => 'accounts/fireworks/models/deepseek-v3p1', 'messages' => []]]);
        self::assertTrue($chatResult->succeeded());

        $missingBody = $chat->execute([]);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be', (string) $missingBody->error);

        $missingId = (new FireworksAiGetModel(new FireworksAiService('fw-test')))->execute(['account_id' => 'account-1']);
        self::assertFalse($missingId->succeeded());
        self::assertStringContainsString('model_id must be', (string) $missingId->error);

        $createDataset = new FireworksAiCreateDataset(new FireworksAiService('fw-test'));
        $datasetResult = $createDataset->execute([
            'account_id' => 'account-1',
            'body' => ['datasetId' => 'dataset-1', 'dataset' => ['displayName' => 'Dataset']],
        ]);
        self::assertTrue($datasetResult->succeeded());
    }
}
