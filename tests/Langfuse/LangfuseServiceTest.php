<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Langfuse;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Langfuse\LangfuseService;
use OpenCompany\Integrations\Langfuse\LangfuseToolProvider;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseCreateScore;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseGetTrace;
use OpenCompany\Integrations\Langfuse\Tools\LangfuseListTraces;
use PHPUnit\Framework\TestCase;

final class LangfuseServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_provider_exposes_every_tool_file_and_docs(): void
    {
        $provider = new LangfuseToolProvider;

        foreach ($provider->tools() as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], '\\') + 1);
            self::assertFileExists(__DIR__ . '/../../packages/langfuse/src/Tools/' . $shortName . '.php');
        }

        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertSame('Langfuse', $provider->integrationMeta()['name']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertTrue($provider->integrationCapabilities()['host_availability']['cli']['runtime_supported']);
        self::assertArrayHasKey('langfuse_ingest_batch', $provider->tools());
        self::assertArrayHasKey('langfuse_update_prompt_version', $provider->tools());
    }

    public function test_core_endpoint_mappings_and_basic_auth(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new LangfuseService('pk-test', 'sk-test', 'https://example.test');
        $service->health();
        $service->ingest(['batch' => []]);
        $service->listTraces(['page' => 1, 'limit' => 10]);
        $service->getTrace('trace-1');
        $service->deleteTrace('trace-1');
        $service->listObservations(['traceId' => 'trace-1']);
        $service->getObservation('obs-1');
        $service->createScore(['traceId' => 'trace-1', 'name' => 'quality', 'value' => 1]);
        $service->listScores(['traceId' => 'trace-1']);
        $service->getScore('score-1');
        $service->deleteScore('score-1');
        $service->listSessions(['userId' => 'user-1']);
        $service->getSession('session-1');
        $service->listDatasets(['page' => 1]);
        $service->createDataset(['name' => 'evals']);
        $service->getDataset('evals');
        $service->createDatasetItem(['datasetName' => 'evals', 'input' => 'Q']);
        $service->listDatasetItems(['datasetName' => 'evals']);
        $service->getDatasetItem('item-1');
        $service->deleteDatasetItem('item-1');
        $service->createDatasetRunItem(['runName' => 'run-1']);
        $service->listDatasetRunItems(['runName' => 'run-1']);
        $service->listPrompts(['name' => 'support']);
        $service->createPrompt(['name' => 'support', 'prompt' => 'Hello']);
        $service->getPrompt('support', ['label' => 'production']);
        $service->updatePromptVersion('support', 3, ['labels' => ['production']]);
        $service->deletePrompt('support');
        $service->createComment(['objectType' => 'TRACE', 'objectId' => 'trace-1', 'content' => 'Check']);
        $service->listComments(['objectId' => 'trace-1']);
        $service->getComment('comment-1');
        $service->metrics(['view' => 'traces']);
        $service->listModels(['page' => 1]);
        $service->createModel(['modelName' => 'gpt-test']);
        $service->getModel('model-1');
        $service->deleteModel('model-1');

        $auth = 'Basic ' . base64_encode('pk-test:sk-test');
        $expected = [
            ['GET', 'https://example.test/api/public/health'],
            ['POST', 'https://example.test/api/public/ingestion'],
            ['GET', 'https://example.test/api/public/traces?page=1&limit=10'],
            ['GET', 'https://example.test/api/public/traces/trace-1'],
            ['DELETE', 'https://example.test/api/public/traces/trace-1'],
            ['GET', 'https://example.test/api/public/v2/observations?traceId=trace-1'],
            ['GET', 'https://example.test/api/public/observations/obs-1'],
            ['POST', 'https://example.test/api/public/scores'],
            ['GET', 'https://example.test/api/public/v2/scores?traceId=trace-1'],
            ['GET', 'https://example.test/api/public/v2/scores/score-1'],
            ['DELETE', 'https://example.test/api/public/scores/score-1'],
            ['GET', 'https://example.test/api/public/sessions?userId=user-1'],
            ['GET', 'https://example.test/api/public/sessions/session-1'],
            ['GET', 'https://example.test/api/public/v2/datasets?page=1'],
            ['POST', 'https://example.test/api/public/v2/datasets'],
            ['GET', 'https://example.test/api/public/v2/datasets/evals'],
            ['POST', 'https://example.test/api/public/dataset-items'],
            ['GET', 'https://example.test/api/public/dataset-items?datasetName=evals'],
            ['GET', 'https://example.test/api/public/dataset-items/item-1'],
            ['DELETE', 'https://example.test/api/public/dataset-items/item-1'],
            ['POST', 'https://example.test/api/public/dataset-run-items'],
            ['GET', 'https://example.test/api/public/dataset-run-items?runName=run-1'],
            ['GET', 'https://example.test/api/public/v2/prompts?name=support'],
            ['POST', 'https://example.test/api/public/v2/prompts'],
            ['GET', 'https://example.test/api/public/v2/prompts/support?label=production'],
            ['PATCH', 'https://example.test/api/public/v2/prompts/support/versions/3'],
            ['DELETE', 'https://example.test/api/public/v2/prompts/support'],
            ['POST', 'https://example.test/api/public/comments'],
            ['GET', 'https://example.test/api/public/comments?objectId=trace-1'],
            ['GET', 'https://example.test/api/public/comments/comment-1'],
            ['POST', 'https://example.test/api/public/v2/metrics'],
            ['GET', 'https://example.test/api/public/models?page=1'],
            ['POST', 'https://example.test/api/public/models'],
            ['GET', 'https://example.test/api/public/models/model-1'],
            ['DELETE', 'https://example.test/api/public/models/model-1'],
        ];

        foreach ($expected as [$method, $url]) {
            Http::assertSent(static fn (Request $request): bool => $request->method() === $method
                && $request->url() === $url
                && $request->hasHeader('Authorization', $auth));
        }
    }

    public function test_tool_filters_query_and_requires_ids_and_body(): void
    {
        Http::fake([
            'https://cloud.langfuse.com/api/public/traces*' => Http::response(['data' => []], 200),
            'https://cloud.langfuse.com/api/public/scores' => Http::response(['id' => 'score-1'], 200),
        ]);

        $list = new LangfuseListTraces(new LangfuseService('pk-test', 'sk-test'));
        $result = $list->execute([
            'page' => 1,
            'limit' => 5,
            'sessionId' => 'session-1',
            'unknown' => 'ignored',
        ]);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://cloud.langfuse.com/api/public/traces?page=1&limit=5&sessionId=session-1');

        $missingId = (new LangfuseGetTrace(new LangfuseService('pk-test', 'sk-test')))->execute([]);
        self::assertFalse($missingId->succeeded());
        self::assertStringContainsString('trace_id must be', (string) $missingId->error);

        $missingBody = (new LangfuseCreateScore(new LangfuseService('pk-test', 'sk-test')))->execute([]);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be', (string) $missingBody->error);
    }
}
