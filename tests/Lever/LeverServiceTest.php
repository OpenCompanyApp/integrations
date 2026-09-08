<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Lever;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Lever\LeverService;
use OpenCompany\Integrations\Lever\LeverToolProvider;
use OpenCompany\Integrations\Lever\Tools\LeverApplyToPosting;
use OpenCompany\Integrations\Lever\Tools\LeverCreateOpportunity;
use OpenCompany\Integrations\Lever\Tools\LeverDataApiGet;
use OpenCompany\Integrations\Lever\Tools\LeverGetPosting;
use OpenCompany\Integrations\Lever\Tools\LeverListPostings;
use OpenCompany\Integrations\Lever\Tools\LeverUpdateOpportunityStage;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Lever Postings API integration.
 */
final class LeverServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(LeverService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(LeverService::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_and_docs(): void
    {
        $provider = new LeverToolProvider;

        self::assertSame('lever', $provider->appName());
        self::assertSame('Lever', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('api_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertCount(113, $provider->tools());
        self::assertSame('lever_list_postings', array_key_first($provider->tools()));
        self::assertArrayHasKey('lever_list_data_opportunities', $provider->tools());
        self::assertArrayHasKey('lever_create_opportunity', $provider->tools());
        self::assertArrayHasKey('lever_list_users', $provider->tools());
        self::assertArrayHasKey('lever_list_requisitions', $provider->tools());
        self::assertArrayHasKey('lever_apply_data_posting', $provider->tools());
        self::assertArrayHasKey('lever_update_webhooks', $provider->tools());
        self::assertArrayHasKey('lever_data_api_get', $provider->tools());
    }

    public function test_service_maps_public_reads_filters_and_application_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new LeverService('key-test', 'https://example.test/v0/postings');
        $service->listPostings('example-site', ['mode' => 'json', 'team' => ['Engineering', 'Product'], 'limit' => 10, 'unknown' => 'ignored']);
        $service->getPosting('example-site', 'posting-123');
        $service->applyToPosting('example-site', 'posting-123', ['name' => 'Ada', 'email' => 'ada@example.test']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/v0/postings/example-site?mode=json&team=Engineering&team=Product&limit=10'
            && $request->hasHeader('Accept', 'application/json'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/v0/postings/example-site/posting-123?mode=json');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/v0/postings/example-site/posting-123?key=key-test'
            && $request['name'] === 'Ada'
            && $request['email'] === 'ada@example.test');
    }

    public function test_tools_validate_arguments_and_api_key_requirement(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);
        $service = new LeverService('key-test', 'https://example.test/v0/postings');

        $list = (new LeverListPostings($service))->execute(['site' => 'example-site', 'team' => ['Engineering']]);
        self::assertTrue($list->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.test/v0/postings/example-site?team=Engineering&mode=json');

        $detail = (new LeverGetPosting($service))->execute(['site' => 'example-site', 'posting_id' => 'posting-123']);
        self::assertTrue($detail->succeeded());

        $missingPath = (new LeverGetPosting($service))->execute(['site' => 'example-site']);
        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('posting_id must be', (string) $missingPath->error);

        $missingBody = (new LeverApplyToPosting($service))->execute(['site' => 'example-site', 'posting_id' => 'posting-123']);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be', (string) $missingBody->error);

        $missingEmail = (new LeverApplyToPosting($service))->execute(['site' => 'example-site', 'posting_id' => 'posting-123', 'body' => ['name' => 'Ada']]);
        self::assertFalse($missingEmail->succeeded());
        self::assertStringContainsString('body.email', (string) $missingEmail->error);

        $unconfiguredApply = (new LeverApplyToPosting(new LeverService('', 'https://example.test/v0/postings')))->execute([
            'site' => 'example-site',
            'posting_id' => 'posting-123',
            'body' => ['name' => 'Ada', 'email' => 'ada@example.test'],
        ]);
        self::assertFalse($unconfiguredApply->succeeded());
        self::assertStringContainsString('API key is required', (string) $unconfiguredApply->error);
    }

    public function test_data_api_methods_use_basic_auth_and_safe_relative_paths(): void
    {
        Http::fake(['*' => Http::response(['data' => [['id' => 'opp-123']]], 200)]);

        $service = new LeverService('key-test', 'https://example.test/v0/postings', 'https://data.example.test/v1');
        $list = $service->apiGet('/opportunities', [
            'limit' => 25,
            'expand' => ['owner', 'stage'],
            'ignored_empty' => '',
        ]);
        $created = $service->apiPost('/opportunities', ['name' => 'Ada'], ['perform_as' => 'user-123']);
        $updated = $service->apiPut('/opportunities/opp-123/stage', ['stage' => 'stage-123'], ['perform_as' => 'user-123']);
        $deleted = $service->apiDelete('/opportunities/opp-123/notes/note-123', ['perform_as' => 'user-123']);

        self::assertSame('opp-123', $list['data'][0]['id']);
        self::assertSame('opp-123', $created['data'][0]['id']);
        self::assertSame('opp-123', $updated['data'][0]['id']);
        self::assertSame('opp-123', $deleted['data'][0]['id']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://data.example.test/v1/opportunities?limit=25&expand=owner&expand=stage'
            && $request->hasHeader('Authorization', 'Basic a2V5LXRlc3Q6'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://data.example.test/v1/opportunities?perform_as=user-123'
            && $request['name'] === 'Ada');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://data.example.test/v1/opportunities/opp-123/stage?perform_as=user-123'
            && $request['stage'] === 'stage-123');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://data.example.test/v1/opportunities/opp-123/notes/note-123?perform_as=user-123');
    }

    public function test_data_api_tools_expand_paths_merge_query_and_require_api_key(): void
    {
        Http::fake(['*' => Http::response(['data' => ['id' => 'opp-123']], 200)]);

        $service = new LeverService('key-test', 'https://example.test/v0/postings', 'https://data.example.test/v1');
        $raw = (new LeverDataApiGet($service))->execute([
            'path' => '/users',
            'limit' => 10,
            'params' => ['expand' => ['roles']],
        ]);
        self::assertTrue($raw->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://data.example.test/v1/users?expand=roles&limit=10');

        $create = (new LeverCreateOpportunity($service))->execute([
            'perform_as' => 'user-123',
            'payload' => ['name' => 'Ada Lovelace', 'emails' => ['ada@example.test']],
        ]);
        self::assertTrue($create->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://data.example.test/v1/opportunities?perform_as=user-123'
            && $request['name'] === 'Ada Lovelace');

        $stage = (new LeverUpdateOpportunityStage($service))->execute([
            'opportunity' => 'opp-123',
            'perform_as' => 'user-123',
            'payload' => ['stage' => 'stage-123'],
        ]);
        self::assertTrue($stage->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://data.example.test/v1/opportunities/opp-123/stage?perform_as=user-123'
            && $request['stage'] === 'stage-123');

        $missingPath = (new LeverUpdateOpportunityStage($service))->execute(['payload' => ['stage' => 'stage-123']]);
        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('Missing required argument: opportunity', (string) $missingPath->error);

        $unconfigured = (new LeverDataApiGet(new LeverService('', 'https://example.test/v0/postings', 'https://data.example.test/v1')))->execute(['path' => '/users']);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('API key is required', (string) $unconfigured->error);
    }

    public function test_connection_and_multi_account_credentials(): void
    {
        Http::fake(['*' => Http::response([['id' => 'posting-123']], 200)]);

        $provider = new LeverToolProvider;
        $ok = $provider->testConnection(['site' => 'example-site', 'url' => 'https://example.test/v0/postings']);

        self::assertTrue($ok['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/v0/postings/example-site?mode=json&limit=1');

        $missingSite = $provider->testConnection([]);
        self::assertFalse($missingSite['success']);
        self::assertStringContainsString('site', (string) $missingSite['error']);

        $resolver = new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['lever', 'api_key', 'acct_1'] => 'key-account',
                    ['lever', 'url', 'acct_1'] => 'https://account.example.test/v0/postings',
                    ['lever', 'data_url', 'acct_1'] => 'https://data-account.example.test/v1',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'lever' && $account === 'acct_1';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'lever' ? ['acct_1'] : [];
            }
        };

        Container::getInstance()->instance(CredentialResolver::class, $resolver);
        $tool = $provider->createTool(LeverApplyToPosting::class, ['account' => 'acct_1']);
        $result = $tool->execute(['site' => 'example-site', 'posting_id' => 'posting-123', 'body' => ['name' => 'Ada', 'email' => 'ada@example.test']]);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://account.example.test/v0/postings/example-site/posting-123?key=key-account');
    }
}
