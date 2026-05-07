<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\CloudConvert;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\CloudConvert\CloudConvertService;
use OpenCompany\Integrations\CloudConvert\CloudConvertToolProvider;
use OpenCompany\Integrations\CloudConvert\Tools\CloudConvertCreateJob;
use OpenCompany\Integrations\CloudConvert\Tools\CloudConvertCreateSignedUrl;
use OpenCompany\Integrations\CloudConvert\Tools\CloudConvertListJobs;
use OpenCompany\Integrations\CloudConvert\Tools\CloudConvertVerifyWebhookSignature;
use OpenCompany\Integrations\CloudConvert\Tools\CloudConvertWaitJob;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for CloudConvert endpoint mapping and metadata.
 */
final class CloudConvertServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(CloudConvertService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(CloudConvertService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_service_uses_bearer_auth_filters_and_sync_host(): void
    {
        Http::fake(['*' => Http::response(['data' => []], 200)]);

        $service = new CloudConvertService(apiKey: 'key-test');
        $service->apiGet('/jobs', ['filter[status]' => 'finished']);
        $service->apiPost('/jobs', ['tasks' => ['convert' => ['operation' => 'convert', 'input' => 'import', 'output_format' => 'pdf']]]);
        $service->apiGet('/jobs/job_123', sync: true);
        $service->apiDelete('/tasks/task_123');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer key-test'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.cloudconvert.com/v2/jobs?filter%5Bstatus%5D=finished');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.cloudconvert.com/v2/jobs'
            && $request['tasks']['convert']['output_format'] === 'pdf');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://sync.api.cloudconvert.com/v2/jobs/job_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://api.cloudconvert.com/v2/tasks/task_123');
    }

    public function test_tools_shape_filters_sync_requests_and_local_signing(): void
    {
        $service = new CloudConvertService(apiKey: 'key-test');

        Http::fake(['*' => Http::response(['data' => []], 200)]);
        self::assertTrue((new CloudConvertListJobs($service))->execute(['status' => 'finished', 'tag' => 'demo'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.cloudconvert.com/v2/jobs?filter%5Bstatus%5D=finished&filter%5Btag%5D=demo');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => ['id' => 'task_123']], 200)]);
        self::assertTrue((new CloudConvertCreateJob($service))->execute([
            'tasks' => [
                'convert_file' => [
                    'operation' => 'convert',
                    'input' => 'import_file',
                    'output_format' => 'pdf',
                    'engine' => 'libreoffice',
                ],
            ],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.cloudconvert.com/v2/jobs'
            && $request['tasks']['convert_file']['engine'] === 'libreoffice');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => ['id' => 'job_123']], 200)]);
        self::assertTrue((new CloudConvertWaitJob($service))->execute(['job_id' => 'job_123'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://sync.api.cloudconvert.com/v2/jobs/job_123');

        $signed = (new CloudConvertCreateSignedUrl($service))->execute([
            'signed_url_base' => 'https://s.cloudconvert.com/test',
            'signing_secret' => 'secret',
            'job' => ['tasks' => ['export' => ['operation' => 'export/url']]],
        ])->data;
        self::assertStringStartsWith('https://s.cloudconvert.com/test?job=', $signed['url']);

        $payload = '{"event":"job.finished"}';
        $signature = hash_hmac('sha256', $payload, 'secret');
        $verified = (new CloudConvertVerifyWebhookSignature($service))->execute([
            'payload' => $payload,
            'signature' => $signature,
            'signing_secret' => 'secret',
        ])->data;
        self::assertTrue($verified['valid']);
    }

    public function test_provider_metadata_connection_and_multi_account(): void
    {
        $provider = new CloudConvertToolProvider;
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://cloudconvert.com/api/v2', $provider->integrationMeta()['docs_url']);
        self::assertGreaterThanOrEqual(23, count($tools));
        self::assertArrayHasKey('cloudconvert_create_job_sync', $tools);
        self::assertArrayHasKey('cloudconvert_list_operations', $tools);
        self::assertArrayHasKey('cloudconvert_create_signed_url', $tools);

        self::assertSame(['success' => false, 'error' => 'API key is required.'], $provider->testConnection([]));

        Http::fake(['*' => Http::response(['data' => ['email' => 'user@example.test']], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to CloudConvert as user@example.test.'], $provider->testConnection([
            'api_key' => 'key-test',
        ]));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.cloudconvert.com/v2/users/me');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['cloudconvert', 'api_key', 'files'] => 'account-key',
                    ['cloudconvert', 'url', 'files'] => 'https://api.example.test/v2',
                    ['cloudconvert', 'sync_url', 'files'] => 'https://sync.example.test/v2',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'cloudconvert' && $account === 'files';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'cloudconvert' ? ['files'] : [];
            }
        });

        $tool = $provider->createTool(CloudConvertListJobs::class, ['account' => 'files']);
        self::assertTrue($tool->execute(['status' => 'finished'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.example.test/v2/jobs?filter%5Bstatus%5D=finished'
            && $request->hasHeader('Authorization', 'Bearer account-key'));
    }
}
