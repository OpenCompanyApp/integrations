<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Ashby;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Ashby\AshbyService;
use OpenCompany\Integrations\Ashby\AshbyToolProvider;
use OpenCompany\Integrations\Ashby\Tools\AshbyApiPost;
use OpenCompany\Integrations\Ashby\Tools\AshbyCreateApplication;
use OpenCompany\Integrations\Ashby\Tools\AshbySearchCandidates;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Ashby endpoint coverage and metadata.
 */
final class AshbyServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(AshbyService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(AshbyService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_service_uses_root_rpc_endpoints_and_basic_auth(): void
    {
        Http::fake(['*' => Http::response(['success' => true, 'results' => []], 200)]);

        $service = new AshbyService('ashby-key');
        $service->listCandidates(['limit' => 25]);
        $service->getApplication('application-123');
        $service->getJob('job-123');
        $service->apiPost('/offer.list', ['applicationId' => 'application-123']);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Basic ' . base64_encode('ashby-key:')));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.ashbyhq.com/candidate.list'
            && $request['limit'] === 25);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.ashbyhq.com/application.info'
            && $request['applicationId'] === 'application-123');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.ashbyhq.com/job.info'
            && $request['jobId'] === 'job-123');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.ashbyhq.com/offer.list'
            && $request['applicationId'] === 'application-123');
    }

    public function test_endpoint_tools_map_bodies(): void
    {
        $service = new AshbyService('ashby-key');

        Http::fake(['*' => Http::response(['success' => true], 200)]);
        self::assertTrue((new AshbyApiPost($service))->execute([
            'endpoint' => '/candidate.list',
            'body' => ['limit' => 10],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.ashbyhq.com/candidate.list'
            && $request['limit'] === 10);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['success' => true], 200)]);
        self::assertTrue((new AshbySearchCandidates($service))->execute([
            'email' => 'person@example.test',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.ashbyhq.com/candidate.search'
            && $request['email'] === 'person@example.test');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['success' => true], 200)]);
        self::assertTrue((new AshbyCreateApplication($service))->execute([
            'candidateId' => 'candidate-123',
            'jobId' => 'job-123',
            'sourceId' => 'source-123',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.ashbyhq.com/application.create'
            && $request['candidateId'] === 'candidate-123'
            && $request['jobId'] === 'job-123'
            && $request['sourceId'] === 'source-123');
    }

    public function test_provider_metadata_connection_and_multi_account(): void
    {
        $provider = new AshbyToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://developers.ashbyhq.com/reference', $provider->integrationMeta()['docs_url']);
        self::assertGreaterThanOrEqual(44, count($tools));
        self::assertArrayHasKey('ashby_api_post', $tools);
        self::assertArrayHasKey('ashby_search_candidates', $tools);
        self::assertArrayHasKey('ashby_list_offers', $tools);
        self::assertArrayHasKey('ashby_create_webhook', $tools);

        $names = [];
        foreach ($tools as $tool) {
            $instance = new $tool['class'](new AshbyService('ashby-key'));
            $names[] = $instance->name();
        }
        self::assertCount(count($names), array_unique($names));

        self::assertSame(['success' => false, 'error' => 'No API key provided.'], $provider->testConnection([]));

        Http::fake(['*' => Http::response(['results' => ['email' => 'person@example.test']], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Ashby API. Logged in as person@example.test.'], $provider->testConnection([
            'access_token' => 'ashby-key',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['success' => true], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['ashby', 'access_token', 'recruiting'] => 'account-key',
                    ['ashby', 'url', 'recruiting'] => 'https://ashby.example.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'ashby' && $account === 'recruiting';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'ashby' ? ['recruiting'] : [];
            }
        });

        $tool = $provider->createTool(AshbyApiPost::class, ['account' => 'recruiting']);
        self::assertTrue($tool->execute(['endpoint' => '/candidate.list'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://ashby.example.test/candidate.list'
            && $request->hasHeader('Authorization', 'Basic ' . base64_encode('account-key:')));
    }
}
