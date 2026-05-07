<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Braintrust;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Braintrust\BraintrustService;
use OpenCompany\Integrations\Braintrust\BraintrustToolProvider;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustCreateDataset;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustGetProject;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustListExperiments;
use OpenCompany\Integrations\Braintrust\Tools\BraintrustQueryBtql;
use PHPUnit\Framework\TestCase;

final class BraintrustServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_provider_exposes_every_tool_file_and_docs(): void
    {
        $provider = new BraintrustToolProvider;

        foreach ($provider->tools() as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], '\\') + 1);
            self::assertFileExists(__DIR__ . '/../../packages/braintrust/src/Tools/' . $shortName . '.php');
        }

        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertSame('Braintrust', $provider->integrationMeta()['name']);
        self::assertSame('analytics', $provider->integrationMeta()['category']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertTrue($provider->integrationCapabilities()['host_availability']['cli']['runtime_supported']);
        self::assertArrayHasKey('braintrust_query_btql', $provider->tools());
        self::assertArrayHasKey('braintrust_proxy_chat_completions', $provider->tools());
        self::assertGreaterThanOrEqual(50, count($provider->tools()));
    }

    public function test_endpoint_mappings_and_bearer_auth(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new BraintrustService('bt-test', 'https://api.braintrust.dev');
        $service->request('GET', '/v1/project', ['limit' => 1]);
        $service->request('POST', '/v1/project', [], ['name' => 'Example']);
        $service->request('PATCH', '/v1/project/project-1', [], ['description' => 'Updated']);
        $service->request('DELETE', '/v1/project/project-1');
        $service->request('POST', '/v1/project_logs/project-1/insert', [], ['events' => []]);
        $service->request('POST', '/v1/experiment/experiment-1/fetch', [], ['limit' => 10]);
        $service->request('GET', '/v1/experiment/experiment-1/summarize');
        $service->request('PUT', '/v1/prompt', [], ['slug' => 'summarizer']);
        $service->request('POST', '/v1/function/function-1/invoke', [], ['input' => ['text' => 'Hello']]);
        $service->request('POST', '/btql', [], ['query' => 'SELECT 1', 'fmt' => 'json']);
        $service->request('POST', '/v1/proxy/chat/completions', [], ['model' => 'openai/gpt-4o-mini', 'messages' => []]);

        $expected = [
            ['GET', 'https://api.braintrust.dev/v1/project?limit=1'],
            ['POST', 'https://api.braintrust.dev/v1/project'],
            ['PATCH', 'https://api.braintrust.dev/v1/project/project-1'],
            ['DELETE', 'https://api.braintrust.dev/v1/project/project-1'],
            ['POST', 'https://api.braintrust.dev/v1/project_logs/project-1/insert'],
            ['POST', 'https://api.braintrust.dev/v1/experiment/experiment-1/fetch'],
            ['GET', 'https://api.braintrust.dev/v1/experiment/experiment-1/summarize'],
            ['PUT', 'https://api.braintrust.dev/v1/prompt'],
            ['POST', 'https://api.braintrust.dev/v1/function/function-1/invoke'],
            ['POST', 'https://api.braintrust.dev/btql'],
            ['POST', 'https://api.braintrust.dev/v1/proxy/chat/completions'],
        ];

        foreach ($expected as [$method, $url]) {
            Http::assertSent(static fn (Request $request): bool => $request->method() === $method
                && $request->url() === $url
                && $request->hasHeader('Authorization', 'Bearer bt-test'));
        }
    }

    public function test_tools_validate_ids_bodies_and_metadata_query_encoding(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $list = new BraintrustListExperiments(new BraintrustService('bt-test'));
        $listResult = $list->execute(['query' => ['metadata' => ['env' => 'test']]]);
        self::assertTrue($listResult->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.braintrust.dev/v1/experiment?metadata=%7B%22env%22%3A%22test%22%7D');

        $missingId = (new BraintrustGetProject(new BraintrustService('bt-test')))->execute([]);
        self::assertFalse($missingId->succeeded());
        self::assertStringContainsString('project_id must be', (string) $missingId->error);

        $missingBody = (new BraintrustCreateDataset(new BraintrustService('bt-test')))->execute([]);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be', (string) $missingBody->error);

        $btql = new BraintrustQueryBtql(new BraintrustService('bt-test'));
        $btqlResult = $btql->execute(['body' => ['query' => 'SELECT 1', 'fmt' => 'json']]);
        self::assertTrue($btqlResult->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.braintrust.dev/btql');
    }
}
