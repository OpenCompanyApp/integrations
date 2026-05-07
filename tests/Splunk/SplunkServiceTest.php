<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Splunk;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Splunk\SplunkService;
use OpenCompany\Integrations\Splunk\SplunkToolProvider;
use OpenCompany\Integrations\Splunk\Tools\SplunkApiGet;
use OpenCompany\Integrations\Splunk\Tools\SplunkGetSearchJob;
use OpenCompany\Integrations\Splunk\Tools\SplunkSearch;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Splunk REST API integration.
 */
final class SplunkServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(SplunkService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(SplunkService::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_category_and_docs(): void
    {
        $provider = new SplunkToolProvider;

        self::assertSame('splunk', $provider->appName());
        self::assertSame('Splunk', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertCount(28, $provider->tools());
        self::assertArrayHasKey('splunk_export_search', $provider->tools());
        self::assertArrayHasKey('splunk_create_index', $provider->tools());
        self::assertArrayHasKey('splunk_dispatch_saved_search', $provider->tools());
        self::assertArrayHasKey('splunk_list_apps', $provider->tools());
        self::assertArrayHasKey('splunk_api_get', $provider->tools());
    }

    public function test_service_maps_search_indexes_saved_searches_apps_users_and_raw_paths(): void
    {
        Http::fake(['*' => Http::response(['entry' => [['name' => 'ok']]], 200)]);

        $service = new SplunkService('token-test', 'https://example.test/services');
        $service->search('search index=main error', '-1h', 'now', 'normal', ['max_count' => 500]);
        $service->getSearchResults('sid-123', 5, 10);
        $service->getSearchEvents('sid-123');
        $service->getSearchLog('sid-123');
        $service->createIndex('example_test', ['maxTotalDataSizeMB' => 1024]);
        $service->updateSavedSearch('Daily errors', ['description' => 'Updated']);
        $service->dispatchSavedSearch('Daily errors', ['dispatch.earliest_time' => '-24h']);
        $service->listApps(10);
        $service->getUser('admin');
        $service->apiGet('/server/info', ['fields' => ['version', 'build']]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/services/search/jobs?output_mode=json'
            && $request['search'] === 'search index=main error'
            && $request['earliest_time'] === '-1h'
            && $request['max_count'] === 500
            && $request->hasHeader('Authorization', 'Bearer token-test'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/services/search/jobs/sid-123/results?output_mode=json&offset=5&count=10');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/services/search/jobs/sid-123/search.log?output_mode=raw');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/services/data/indexes?output_mode=json'
            && $request['name'] === 'example_test');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/services/saved/searches/Daily%20errors/dispatch?output_mode=json'
            && $request['dispatch.earliest_time'] === '-24h');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/services/server/info?output_mode=json&fields=version&fields=build');

        $this->expectException(\RuntimeException::class);
        $service->apiGet('https://evil.example.test/server/info');
    }

    public function test_tools_validate_arguments_and_use_safe_raw_helpers(): void
    {
        Http::fake(['*' => Http::response(['sid' => 'sid-123'], 200)]);

        $service = new SplunkService('token-test', 'https://example.test/services');
        $search = (new SplunkSearch($service))->execute(['query' => 'search index=main | head 1']);
        $job = (new SplunkGetSearchJob($service))->execute(['sid' => 'sid-123']);
        $raw = (new SplunkApiGet($service))->execute(['path' => '/server/info']);

        self::assertTrue($search->succeeded());
        self::assertTrue($job->succeeded());
        self::assertTrue($raw->succeeded());

        $missing = (new SplunkGetSearchJob($service))->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('sid is required', (string) $missing->error);

        $unconfigured = (new SplunkApiGet(new SplunkService('', 'https://example.test/services')))->execute(['path' => '/server/info']);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_uses_current_context_endpoint(): void
    {
        Http::fake(['*' => Http::response(['username' => 'admin'], 200)]);

        $result = (new SplunkToolProvider)->testConnection([
            'access_token' => 'token-test',
            'url' => 'https://example.test/services',
        ]);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/services/authentication/current-context?output_mode=json'
            && $request->hasHeader('Authorization', 'Bearer token-test'));
    }
}
