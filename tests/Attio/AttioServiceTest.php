<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Attio;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Attio\AttioService;
use OpenCompany\Integrations\Attio\AttioToolProvider;
use OpenCompany\Integrations\Attio\Tools\AttioApiGet;
use OpenCompany\Integrations\Attio\Tools\AttioCreateEntry;
use OpenCompany\Integrations\Attio\Tools\AttioUpdateRecord;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Attio endpoint coverage and metadata.
 */
final class AttioServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(AttioService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(AttioService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_service_supports_raw_attio_methods_and_token_auth(): void
    {
        Http::fake(['*' => Http::response(['data' => []], 200)]);

        $service = new AttioService('attio-token');
        $service->apiGet('/v2/lists', ['limit' => 10]);
        $service->apiPost('/v2/lists/list-123/entries', ['data' => ['parent_object' => 'people']]);
        $service->apiPatch('/v2/objects/people/records/record-123', ['data' => ['values' => ['name' => 'Ada']]]);
        $service->apiPut('/v2/lists/list-123/entries/entry-123', ['data' => ['entry_values' => []]]);
        $service->apiDelete('/v2/tasks/task-123');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer attio-token'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.attio.com/v2/lists?limit=10');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.attio.com/v2/lists/list-123/entries'
            && $request['data']['parent_object'] === 'people');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH'
            && $request['data']['values']['name'] === 'Ada');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://api.attio.com/v2/lists/list-123/entries/entry-123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://api.attio.com/v2/tasks/task-123');
    }

    public function test_endpoint_tools_wrap_data_payloads(): void
    {
        $service = new AttioService('attio-token');

        Http::fake(['*' => Http::response(['data' => []], 200)]);
        self::assertTrue((new AttioApiGet($service))->execute([
            'path' => '/v2/lists',
            'query' => ['limit' => 5],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.attio.com/v2/lists?limit=5');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => []], 200)]);
        self::assertTrue((new AttioUpdateRecord($service))->execute([
            'object_id' => 'people',
            'record_id' => 'record-123',
            'values' => ['name' => 'Ada Lovelace'],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.attio.com/v2/objects/people/records/record-123'
            && $request['data']['values']['name'] === 'Ada Lovelace');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => []], 200)]);
        self::assertTrue((new AttioCreateEntry($service))->execute([
            'list_id' => 'sales-prospects',
            'parent_object' => 'people',
            'parent_record_id' => 'record-123',
            'entry_values' => ['status' => 'New'],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request['data']['parent_object'] === 'people'
            && $request['data']['entry_values']['status'] === 'New');
    }

    public function test_provider_metadata_connection_and_multi_account(): void
    {
        $provider = new AttioToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertGreaterThanOrEqual(34, count($tools));
        self::assertArrayHasKey('attio_api_get', $tools);
        self::assertArrayHasKey('attio_list_attributes', $tools);
        self::assertArrayHasKey('attio_list_entries', $tools);
        self::assertArrayHasKey('attio_list_tasks', $tools);

        $names = [];
        foreach ($tools as $tool) {
            $instance = new $tool['class'](new AttioService('attio-token'));
            $names[] = $instance->name();
        }
        self::assertCount(count($names), array_unique($names));

        self::assertSame(['success' => false, 'error' => 'No access token provided.'], $provider->testConnection([]));

        Http::fake(['*' => Http::response(['data' => ['first_name' => 'Ada']], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Attio API as Ada.'], $provider->testConnection([
            'access_token' => 'attio-token',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['attio', 'access_token', 'sales'] => 'account-token',
                    ['attio', 'base_url', 'sales'] => 'https://attio.example.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'attio' && $account === 'sales';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'attio' ? ['sales'] : [];
            }
        });

        $tool = $provider->createTool(AttioApiGet::class, ['account' => 'sales']);
        self::assertTrue($tool->execute(['path' => '/v2/lists'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://attio.example.test/v2/lists'
            && $request->hasHeader('Authorization', 'Bearer account-token'));
    }
}
