<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\LangSmith;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\LangSmith\LangSmithService;
use OpenCompany\Integrations\LangSmith\LangSmithToolProvider;
use OpenCompany\Integrations\LangSmith\Tools\LangSmithCreateFeedback;
use OpenCompany\Integrations\LangSmith\Tools\LangSmithPostRunsMultipart;
use OpenCompany\Integrations\LangSmith\Tools\LangSmithReadRun;
use OpenCompany\Integrations\LangSmith\Tools\LangSmithReadTracerSessions;
use PHPUnit\Framework\TestCase;

final class LangSmithServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_provider_matches_generated_openapi_manifest_and_docs(): void
    {
        $provider = new LangSmithToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__ . '/../../packages/langsmith/langsmith-openapi-manifest.json'), true);

        self::assertSame(540, $manifest['operation_count']);
        self::assertCount($manifest['operation_count'], $provider->tools());
        self::assertSame('LangSmith', $provider->integrationMeta()['name']);
        self::assertSame('analytics', $provider->integrationMeta()['category']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());

        foreach ($provider->tools() as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], '\\') + 1);
            self::assertFileExists(__DIR__ . '/../../packages/langsmith/src/Tools/' . $shortName . '.php');
        }

        $manifestTools = array_column($manifest['operations'], 'tool');
        $providerTools = array_keys($provider->tools());
        sort($manifestTools);
        sort($providerTools);
        self::assertSame($manifestTools, $providerTools);
        self::assertContains('langsmith_post_runs', $manifestTools);
        self::assertContains('langsmith_create_feedback', $manifestTools);
        self::assertContains('langsmith_list_workspaces', $manifestTools);
        self::assertContains('langsmith_post_runs_multipart', $manifestTools);
    }

    public function test_service_maps_headers_query_path_body_and_non_v1_paths(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new LangSmithService(
            apiKey: 'ls-test',
            bearerToken: 'bearer-test',
            tenantId: 'tenant-1',
            organizationId: 'org-1',
            baseUrl: 'https://example.test',
        );

        $service->request('GET', '/api/v1/runs/run-1', ['select' => ['id', 'name']]);
        $service->request('POST', '/api/v1/feedback', [], ['run_id' => 'run-1', 'key' => 'quality', 'score' => 1]);
        $service->request('PATCH', '/runs/run-1', ['sync' => true], ['outputs' => ['answer' => 'ok']]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/api/v1/runs/run-1?select%5B0%5D=id&select%5B1%5D=name'
            && $request->hasHeader('x-api-key', 'ls-test')
            && $request->hasHeader('Authorization', 'Bearer bearer-test')
            && $request->hasHeader('x-tenant-id', 'tenant-1')
            && $request->hasHeader('x-organization-id', 'org-1'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/api/v1/feedback'
            && $request['run_id'] === 'run-1'
            && $request['key'] === 'quality');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH'
            && $request->url() === 'https://example.test/runs/run-1?sync=1'
            && $request['outputs']['answer'] === 'ok');
    }

    public function test_tools_filter_query_require_ids_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);
        $service = new LangSmithService(apiKey: 'ls-test');

        $list = new LangSmithReadTracerSessions($service);
        $result = $list->execute([
            'limit' => 5,
            'offset' => 10,
            'unknown' => 'ignored',
        ]);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://api.smith.langchain.com/api/v1/sessions?')
            && str_contains($request->url(), 'limit=5')
            && str_contains($request->url(), 'offset=10'));

        $missingId = (new LangSmithReadRun($service))->execute([]);
        self::assertFalse($missingId->succeeded());
        self::assertStringContainsString('run_id must be', (string) $missingId->error);

        $missingBody = (new LangSmithCreateFeedback($service))->execute([]);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be', (string) $missingBody->error);
    }

    public function test_multipart_operation_uses_multipart_form_payload(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $tool = new LangSmithPostRunsMultipart(new LangSmithService(apiKey: 'ls-test'));
        $result = $tool->execute(['body' => ['post' => [['id' => 'run-1']], 'patch' => []]]);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.smith.langchain.com/runs/multipart'
            && str_contains($request->header('Content-Type')[0] ?? '', 'multipart/form-data'));
    }
}
