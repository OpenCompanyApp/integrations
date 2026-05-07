<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\ServiceM8;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\ServiceM8\ServiceM8Service;
use OpenCompany\Integrations\ServiceM8\ServiceM8ToolProvider;
use OpenCompany\Integrations\ServiceM8\Tools\ServiceM8ListJobs;
use PHPUnit\Framework\TestCase;

final class ServiceM8ServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        Container::getInstance()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_uses_package_aligned_app_name_and_official_metadata(): void
    {
        $provider = new ServiceM8ToolProvider;

        self::assertSame('service-m8', $provider->appName());
        self::assertSame('ServiceM8', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://developer.servicem8.com/docs', $provider->integrationMeta()['docs_url']);
        self::assertCount(7, $provider->tools());
        self::assertArrayHasKey('servicem8_list_jobs', $provider->tools());
        self::assertSame('https://api.servicem8.com/api_1.0', $provider->credentialFields()[1]['default']);
    }

    public function test_service_maps_official_api_1_object_endpoints_and_bearer_auth(): void
    {
        Http::fake([
            'https://servicem8.example.test/api_1.0/job/job%2F1.json' => Http::response(['uuid' => 'job/1'], 200),
            'https://servicem8.example.test/api_1.0/job.json*' => Http::response([['uuid' => 'job/1']], 200),
            'https://servicem8.example.test/api_1.0/company/company%2F1.json' => Http::response(['uuid' => 'company/1'], 200),
            'https://servicem8.example.test/api_1.0/company.json*' => Http::response([['uuid' => 'company/1']], 200),
            'https://servicem8.example.test/api_1.0/jobactivity.json*' => Http::response([['uuid' => 'activity/1']], 200),
            'https://servicem8.example.test/api_1.0/staff.json' => Http::response([['uuid' => 'staff/1']], 200),
        ]);

        $service = new ServiceM8Service('service-token', 'https://servicem8.example.test/api_1.0');

        self::assertSame([['uuid' => 'job/1']], $service->listJobs(['status' => 'Quote', 'limit' => 20]));
        self::assertSame(['uuid' => 'job/1'], $service->getJob('job/1'));
        self::assertSame([['uuid' => 'job/1']], $service->createJob(['job_status' => 'Quote']));
        self::assertSame([['uuid' => 'company/1']], $service->listClients(['limit' => 10]));
        self::assertSame(['uuid' => 'company/1'], $service->getClient('company/1'));
        self::assertSame([['uuid' => 'activity/1']], $service->listActivities(['job_uuid' => 'job/1']));
        self::assertSame([['uuid' => 'staff/1']], $service->getCurrentUser());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://servicem8.example.test/api_1.0/job.json?status=Quote&limit=20'
            && $request->hasHeader('Authorization', 'Bearer service-token'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://servicem8.example.test/api_1.0/job/job%2F1.json');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://servicem8.example.test/api_1.0/job.json'
            && $request['job_status'] === 'Quote');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://servicem8.example.test/api_1.0/company.json?limit=10');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://servicem8.example.test/api_1.0/company/company%2F1.json');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://servicem8.example.test/api_1.0/jobactivity.json?job_uuid=job%2F1');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://servicem8.example.test/api_1.0/staff.json');
    }

    public function test_provider_falls_back_to_legacy_service_m8_credentials_for_named_accounts(): void
    {
        Http::fake([
            'https://legacy-servicem8.example.test/api_1.0/job.json*' => Http::response([['uuid' => 'legacy-job']], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration === 'service-m8') {
                    return '';
                }

                if ($integration === 'service_m8' && $account === 'field') {
                    return match ($key) {
                        'access_token' => 'legacy-service-token',
                        'url' => 'https://legacy-servicem8.example.test/api_1.0',
                        default => $default,
                    };
                }

                return $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'service_m8' && $account === 'field';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'service_m8' ? ['field'] : [];
            }
        });

        $tool = (new ServiceM8ToolProvider)->createTool(ServiceM8ListJobs::class, ['account' => 'field']);
        $result = $tool->execute(['status' => 'Quote']);

        self::assertTrue($result->succeeded());
        self::assertSame('legacy-job', $result->data[0]['uuid']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://legacy-servicem8.example.test/api_1.0/job.json?status=Quote'
            && $request->hasHeader('Authorization', 'Bearer legacy-service-token'));
    }
}
