<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\SmartRecruiters;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\SmartRecruiters\SmartRecruitersService;
use OpenCompany\Integrations\SmartRecruiters\SmartRecruitersToolProvider;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersCandidatesCandidatesAll;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersJobsJobsCreate;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersJobsJobsGet;
use OpenCompany\Integrations\SmartRecruiters\Tools\SmartRecruitersPostingV1ListPostings;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the generated SmartRecruiters OpenAPI registry integration.
 */
final class SmartRecruitersServiceTest extends TestCase
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
        parent::tearDown();
    }

    public function test_provider_matches_openapi_registry_manifest_and_docs(): void
    {
        $provider = new SmartRecruitersToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/smartrecruiters/smartrecruiters-openapi-manifest.json'), true);

        self::assertSame(31, $manifest['registry_count']);
        self::assertSame(312, $manifest['method_count']);
        self::assertContains('3.1.0', $manifest['openapi_versions']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('SmartRecruiters', $provider->integrationMeta()['name']);
        self::assertSame('api_key_or_oauth', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertSame('x-smarttoken', $provider->integrationCapabilities()['auth']['header']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertContains('smartrecruiters_jobs_jobs_all', array_keys($provider->tools()));
        self::assertContains('smartrecruiters_candidates_candidates_all', array_keys($provider->tools()));
        self::assertContains('smartrecruiters_webhooks_subscriptions_create', array_keys($provider->tools()));
        self::assertContains('smartrecruiters_posting_v1_list_postings', array_keys($provider->tools()));
    }

    public function test_service_maps_smarttoken_path_headers_query_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new SmartRecruitersService(apiKey: 'sr_test_key', baseUrl: 'https://sr.example.test');
        $service->request('GET', '', '/jobs/{jobId}', ['jobId' => 'job 123'], [], ['Accept-Language' => 'en']);
        $service->request('GET', '', '/candidates', [], ['updated_after' => '2026-01-01T00:00:00Z', 'tag' => ['sales', 'support']]);
        $service->request('POST', '', '/jobs', [], [], [], ['title' => 'Engineer']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://sr.example.test/jobs/job%20123'
            && $request->hasHeader('x-smarttoken', 'sr_test_key')
            && $request->hasHeader('Accept-Language', 'en'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://sr.example.test/candidates?updated_after=2026-01-01T00%3A00%3A00Z&tag=sales&tag=support');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://sr.example.test/jobs'
            && $request->data()['title'] === 'Engineer');
    }

    public function test_service_can_fetch_runtime_bearer_token_from_client_credentials(): void
    {
        Http::fake([
            'sr.example.test/oauth/token' => Http::response(['access_token' => 'runtime-token'], 200),
            'sr.example.test/partner/config' => Http::response(['partner' => 'ok'], 200),
        ]);

        $service = new SmartRecruitersService(clientId: 'client', clientSecret: 'secret', baseUrl: 'https://sr.example.test', tokenUrl: 'https://sr.example.test/oauth/token');
        $result = $service->request('GET', '', '/partner/config', [], [], [], [], 'bearer');

        self::assertSame(['partner' => 'ok'], $result);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://sr.example.test/oauth/token'
            && $request->data()['grant_type'] === 'client_credentials'
            && $request->data()['client_id'] === 'client'
            && $request->data()['client_secret'] === 'secret');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://sr.example.test/partner/config'
            && $request->hasHeader('Authorization', 'Bearer runtime-token'));
    }

    public function test_tools_validate_and_map_parameters(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new SmartRecruitersService(apiKey: 'sr_test_key', baseUrl: 'https://sr.example.test');

        self::assertTrue((new SmartRecruitersJobsJobsGet($service))->execute(['job_id' => 'job-123', 'accept_language' => 'en'])->succeeded());
        self::assertTrue((new SmartRecruitersCandidatesCandidatesAll($service))->execute(['limit' => 25, 'updated_after' => '2026-01-01T00:00:00Z'])->succeeded());
        self::assertTrue((new SmartRecruitersJobsJobsCreate($service))->execute(['body' => ['title' => 'Engineer']])->succeeded());

        $missingPath = (new SmartRecruitersJobsJobsGet($service))->execute([]);
        $badBody = (new SmartRecruitersJobsJobsCreate($service))->execute(['body' => 'not-object']);
        $unconfigured = (new SmartRecruitersJobsJobsGet(new SmartRecruitersService(baseUrl: 'https://sr.example.test')))->execute(['job_id' => 'job-123']);

        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('job_id must be a non-empty parameter', (string) $missingPath->error);
        self::assertFalse($badBody->succeeded());
        self::assertStringContainsString('body must be an object', (string) $badBody->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('API key, access token, or client credentials', (string) $unconfigured->error);
    }

    public function test_public_posting_tool_works_without_credentials(): void
    {
        Http::fake(['*' => Http::response(['content' => [['id' => 'posting-1']]], 200)]);

        $result = (new SmartRecruitersPostingV1ListPostings(new SmartRecruitersService(baseUrl: 'https://sr.example.test')))
            ->execute(['company_identifier' => 'example-company', 'limit' => 10, 'accept_language' => 'en']);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.smartrecruiters.com/v1/companies/example-company/postings?limit=10'
            && ! $request->hasHeader('x-smarttoken')
            && ! $request->hasHeader('Authorization')
            && $request->hasHeader('accept-language', 'en'));
    }

    public function test_connection_uses_lightweight_jobs_request_with_smarttoken(): void
    {
        Http::fake(['sr.example.test/jobs?limit=1' => Http::response(['content' => []], 200)]);

        $result = (new SmartRecruitersToolProvider)->testConnection([
            'api_key' => 'sr_test_key',
            'url' => 'https://sr.example.test',
        ]);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://sr.example.test/jobs?limit=1'
            && $request->hasHeader('x-smarttoken', 'sr_test_key'));
    }

    public function test_create_tool_resolves_account_specific_credentials(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                $values = [
                    'api_key' => $account === 'work' ? 'sr_work_key' : 'sr_default_key',
                    'url' => 'https://sr.example.test',
                    'token_url' => 'https://sr.example.test/oauth/token',
                ];

                return $values[$key] ?? $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return true;
            }

            public function getAccounts(string $integration): array
            {
                return ['work'];
            }
        });

        $tool = (new SmartRecruitersToolProvider)->createTool(SmartRecruitersJobsJobsGet::class, ['account' => 'work']);
        self::assertTrue($tool->execute(['job_id' => 'job-123'])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('x-smarttoken', 'sr_work_key'));
    }
}
